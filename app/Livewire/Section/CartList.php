<?php

namespace App\Livewire\Section;

use App\Models\Order\Cart;
use App\Models\Order\CartItem;
use App\Models\Product\Product;
use App\Repositories\Cart\CartRepositoryImpl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CartList extends Component
{
    public ?Cart $cart = null;
    public array $selectedItems = [];

    public function mount()
    {
        $this->cart = CartRepositoryImpl::getByUserId(Auth::id());
    }

    public function increase($itemId)
    {
        $item = CartRepositoryImpl::getItem($itemId);
        if ($item) {
            $item->quantity++;
            $item->save();
            $this->refreshCart();
        }
    }

    public function decrease($itemId)
    {
        $item = CartRepositoryImpl::getItem($itemId);
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
        CartRepositoryImpl::deleteItemWithIds($this->selectedItems);
        $this->selectedItems = [];
        $this->refreshCart();
    }

    public function orderSelected()
    {
        $items = CartRepositoryImpl::getItemWithIds($this->selectedItems)->pluck('id')->toArray();

        Cookie::queue(Cookie::forget('checkout_cart_item_ids'));
        Cookie::queue(Cookie::make('checkout_cart_item_ids', json_encode($items), 60));
        return redirect()->route('order.checkout');
    }

    private function refreshCart()
    {
        $this->cart = CartRepositoryImpl::getByUserId(Auth::id());
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.section.cart-list');
    }
}
