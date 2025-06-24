<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return view('pages.client.order.order', [
            'active' => 'order'
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
        if (!empty($user->addresses)) {
            if ($selectedAddress) {
                $address = collect($user->addresses)->firstWhere('id', $selectedAddress) ?? $user->addresses[0];
            } else {
                $address = $user->addresses[0];
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
