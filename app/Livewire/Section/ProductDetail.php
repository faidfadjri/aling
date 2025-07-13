<?php

namespace App\Livewire\Section;

use App\Models\Order\Cart;
use App\Models\Order\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function addToCart($productID)
    {
        $user        = Auth::user();
        if (!$user) return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
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
                Log::critical("gagal menambahkan produk ke keranjang");
            }
        }

        $this->dispatch('add-to-cart', ['productID' => $productID]);
    }

    public function render()
    {
        return view('livewire.section.product-detail');
    }
}
