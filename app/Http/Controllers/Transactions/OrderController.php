<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $addresses = $user->addresses;
        $orders = Order::whereIn('address_id', $addresses->pluck('id'))->get();
        return view('pages.client.order.order', [
            'active' => 'order',
            'orders' => $orders
        ]);
    }

    public function checkout($productID = null)
    {
        $product    = Product::find($productID);
        $adminfee   = 5000;
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


        return response()
            ->view('pages.client.product.checkout', [
                'active'    => 'product',
                'product'   => $product,
                'fee'       => $adminfee,
                'address'   => $address
            ])
            ->cookie('last-visited-product', json_encode(['id' => $productID]), 60 * 24 * 30);
    }
}
