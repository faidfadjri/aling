<?php

namespace App\Livewire\Section;

use App\Models\Order\Cart;
use App\Models\Order\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class CartList extends Component
{
    public ?Cart $cart = null;
    public array $selectedItems = [];

    public function mount()
    {
        $this->cart = Cart::with('items.product.outlet')->where('user_id', Auth::id())->first();
    }

    public function increase($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item) {
            $item->quantity++;
            $item->save();
            $this->refreshCart();
        }
    }

    public function decrease($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item && $item->quantity > 1) {
            $item->quantity--;
            $item->save();
            $this->refreshCart();
        }
    }

    public function toggleSelect($itemId)
    {
        if (in_array($itemId, $this->selectedItems)) {
            $this->selectedItems = array_values(array_diff($this->selectedItems, [$itemId]));
        } else {
            $this->selectedItems[] = $itemId;
        }
    }

    public function deleteSelected()
    {
        CartItem::whereIn('id', $this->selectedItems)->delete();
        $this->selectedItems = [];
        $this->refreshCart();
    }

    public function orderSelected()
    {
        Cookie::queue(Cookie::forget('checkout_cart_item_ids'));
        Cookie::queue(Cookie::make('checkout_cart_item_ids', json_encode($this->selectedItems), 60));
        return redirect()->route('order.checkout');
    }

    private function refreshCart()
    {
        $this->cart = Cart::with('items.product.outlet')->where('user_id', Auth::id())->first();
    }

    public function render()
    {
        return view('livewire.section.cart-list');
    }
}
