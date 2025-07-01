<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Order\Cart;
use App\Models\Order\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function cart()
    {
        return view('pages.client.order.cart');
    }

    public function addToCart(Request $request)
    {
        $key       = 'productID';
        if (!$request->has($key)) {
            return redirect()->back()->with('error', 'Gagal menambahkan produk');
        }

        $productID = $request->input($key, null);


        $user        = Auth::user();
        $cart        = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id
            ]);
        }
        $existingCartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productID)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
        } else {
            $cartItem = CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $productID,
                'quantity'   => 1
            ]);
            if (!$cartItem) {
                return redirect()->back()->with('error', 'Gagal menambahkan produk');
            }
        }

        return redirect()->back()->with('success', 'Berhasil menambahkan keranjang');
    }
}
