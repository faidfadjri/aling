<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Order\OrderOutlet;
use App\Models\Product\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');

        return view('pages.client.order.order', [
            'active'  => 'order',
            'keyword' => $keyword
        ]);
    }

    public function checkout($productID = null)
    {
        if (empty($productID) || $productID === "0") {
            $inputID = request()->input('productID');

            $productID = (is_numeric($inputID) && (int) $inputID > 0) ? (int) $inputID : null;
        }

        $adminfee = 5000;
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        $selectedAddress = request()->cookie('selected-address');

        $address = null;
        if (!empty($user->addresses) && is_iterable($user->addresses)) {
            $addresses = is_array($user->addresses) ? $user->addresses : $user->addresses->all();
            if (!empty($addresses)) {
                if ($selectedAddress) {
                    $address = collect($addresses)->firstWhere('id', $selectedAddress) ?? $addresses[0];
                } else {
                    $address = $addresses[0];
                }
            }
        }

        $cartSelectedIDs = [];
        if ($cartSelectedIDs !== null) {
            $cartSelectedIDs = json_decode(request()->cookie('checkout_cart_item_ids'), true);
        }

        return response()
            ->view('pages.client.order.checkout', [
                'active'            => 'product',
                'productID'         => $productID,
                'fee'               => $adminfee,
                'address'           => $address,
                'cartSelectedIDs'   => $cartSelectedIDs
            ])
            ->cookie('last-visited-product', json_encode(['id' => $productID]), 60 * 24 * 30);
    }

    public function submitReview(Request $request)
    {
        DB::beginTransaction();
        try {
            $activeOrderOutletId = $request->input('activeOrderOutletId');
            $rating              = $request->input('rating');
            $description         = $request->input('description');
            $name                = auth()->user()->name;

            $orderOutlet = OrderOutlet::with('items.product')->find($activeOrderOutletId);
            if (!$orderOutlet) {
                throw new Exception("Order Outlet not found.");
            }

            foreach ($orderOutlet->items as $orderItem) {
                Review::create([
                    'product_id'  => $orderItem->product_id,
                    'rating'      => $rating,
                    'description' => $description,
                    'name'        => $name,
                ]);
                $orderItem->update(['review' => true]);
            }

            DB::commit();

            return redirect()->route('order')
                ->with('success', 'Ulasan berhasil ditambahkan.');
        } catch (Exception $err) {
            Log::critical($err);
            DB::rollBack();
            return redirect()->route('order')->with('error', 'Gagal menambahkan ulasan. Silakan coba lagi.')
                ->withInput();
        }
    }

    public function cart()
    {
        return view('pages.client.order.cart');
    }
}
