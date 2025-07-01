<?php

namespace App\Livewire\Components;

use App\Models\Order\CartItem;
use App\Models\Order\Order;
use App\Models\Product\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

class CheckoutProduct extends Component
{
    public $productID;
    public $cartSelectedIDs = [];
    public Collection $products;

    public $mode = 'single';
    public $quantities = [];
    public $biayaAdmin = 5000;
    public $note;
    public $address = null;

    public function mount($productID = null, $cartSelectedIDs = [], $address)
    {
        $this->address = $address;

        if ($productID) {
            $this->mode = 'single';
            $this->productID = $productID;
            $product = Product::findOrFail($productID);
            $this->products = collect([$product]);
            $this->quantities[$product->id] = 1;
        } else {
            $this->mode = 'multiple';

            $cartItems = CartItem::with('product')
                ->whereIn('id', $cartSelectedIDs)
                ->get();

            $validCartItems = $cartItems->filter(function ($item) {
                return $item->product !== null;
            });

            $this->products = $validCartItems->pluck('product');

            foreach ($validCartItems as $item) {
                $this->quantities[$item->product_id] = $item->quantity;
            }
        }
    }

    public function increment($id)
    {
        $this->quantities[$id]++;
    }

    public function decrement($id)
    {
        if ($this->quantities[$id] > 1) {
            $this->quantities[$id]--;
        }
    }

    public function calculateTotalHarga()
    {
        return $this->products->sum(function ($product) {
            return $product->price * $this->quantities[$product->id];
        });
    }

    public function proceedOrder()
    {
        $this->validate([
            'quantities' => 'required|array',
            'note' => 'nullable|string|max:1000',
        ]);

        $totalHarga = $this->calculateTotalHarga();
        $totalTagihan = $totalHarga + $this->biayaAdmin;

        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'address_id' => $this->address->id,
            'total_price' => $totalTagihan,
            'note' => $this->note,
        ]);

        foreach ($this->products as $product) {
            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $this->quantities[$product->id],
                'subtotal' => $product->price * $this->quantities[$product->id],
            ]);
        }

        if ($this->mode === 'multiple') {
            CartItem::whereIn('id', $this->cartSelectedIDs)->delete();
        }

        session()->forget('checkout_cart_item_ids');

        return redirect()->route('order');
    }

    public function render()
    {
        $totalHarga = $this->calculateTotalHarga();
        $totalTagihan = $totalHarga + $this->biayaAdmin;

        return view('livewire.components.checkout-product', [
            'totalHarga' => $totalHarga,
            'totalTagihan' => $totalTagihan,
        ]);
    }
}
