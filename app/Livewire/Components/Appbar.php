<?php

namespace App\Livewire\Components;

use App\Models\Order\Cart;
use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Repositories\Cart\CartRepositoryImpl;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryImpl;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Appbar extends Component
{
    public string $search = '';
    public string|null $keyword = '';
    public Collection|array $results;

    public bool   $searchOrder = false;
    public string $back;
    public string $title;
    public int $cartCount;

    public bool $isFocused = false;

    public function mount()
    {
        $user = Auth::user();
        if ($user) {
            $cart = CartRepositoryImpl::getByUserId($user->id);
            $cartCount = $cart ? $cart->items->count() : 0;
            $this->cartCount = $cartCount;
        }

        if ($this->keyword) {
            $this->search = $this->keyword;
            $this->doSearch();
            $this->isFocused = false;
        }
    }

    public function updatedSearch()
    {
        $this->results = [];
        $this->isFocused = true;
        $this->doSearch();
    }

    public function disableFocus()
    {
        $this->isFocused = false;
        $this->search = '';
        $this->results = [];
    }

    #[On('add-to-cart')]
    public function onProductAddtoCart($productID)
    {
        $user = Auth::user();
        if ($user) {
            $cart = CartRepositoryImpl::getByUserId($user->id);
            $this->cartCount = $cart ? $cart->items->count() : 0;
        }
    }

    public function doSearch()
    {
        if (!empty($this->search)) {

            $keyword = $this->search;

            $result = [];
            if ($this->searchOrder) {
                $result  = Order::where("order_number", "like", "%$keyword%")->limit(6)->get();
            } else {
                $result  = ProductRepositoryImpl::searchByName($keyword);
            }

            $this->results = $result;


            $history = json_decode(Cookie::get('search_history', '[]'), true);
            $history = array_filter($history, fn($item) => $item !== $this->search);
            array_unshift($history, $this->search);
            $history = array_slice($history, 0, 5);
            Cookie::queue('search_history', json_encode($history), 60 * 24 * 7);
        } else {
            $this->results = [];
            $this->isFocused = false;
        }
    }

    public function onEnter()
    {
        return redirect()->route('product', ['search' => $this->search]);
    }


    public function render()
    {
        $searchHistory = json_decode(Cookie::get('search_history', '[]'), true);

        return view('livewire.components.appbar', [
            'searchHistory' => $searchHistory,
        ]);
    }
}
