<?php

namespace App\Livewire\Section;

use App\Models\Order\Cart;
use App\Models\Order\CartItem;
use App\Repositories\Cart\CartRepositoryImpl;
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
        $cart        = CartRepositoryImpl::getByUserId($user->id);
        if (!$cart) {
            $cart = CartRepositoryImpl::save([
                'user_id' => $user->id
            ]);
        }

        $existingCartItem = CartRepositoryImpl::getValidatedItem($cart->id, $productID);

        if ($existingCartItem) {
            $existingCartItem->quantity += 1;
            $existingCartItem->save();
        } else {
            $cartItem = CartRepositoryImpl::saveItem([
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
