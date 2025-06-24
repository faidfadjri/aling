<?php

namespace App\Livewire\Components;

use App\Models\Order\Order;
use Livewire\Component;
use Illuminate\Support\Str;

class CheckoutProduct extends Component
{
    public $product;
    public $quantity = 1;
    public $biayaAdmin = 5000;
    public $isEditing = false;
    public $note;

    public function mount($product)
    {
        $this->product = (object) $product;
        $this->quantity = $this->product->quantity ?? 1;
    }

    public function increment()
    {
        $this->quantity++;
        $this->isEditing = false;
    }

    public function decrement()
    {
        $this->isEditing = false;
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function startEditing()
    {
        $this->isEditing = true;
    }

    public function stopEditing()
    {
        $this->quantity = max(1, (int) $this->quantity);
        $this->isEditing = false;
    }

    public function proceedOrder()
    {
        $this->validate([
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string|max:1000',
        ]);
        $addressId = auth()->user()?->default_address_id ?? 1;

        $totalHarga = $this->product->price * $this->quantity;
        $totalTagihan = $totalHarga + $this->biayaAdmin;

        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'address_id' => $addressId,
            'total_price' => $totalTagihan,
            'note' => $this->note,
        ]);

        $order->items()->create([
            'product_id' => $this->product->id,
            'quantity' => $this->quantity,
            'subtotal' => $totalHarga,
        ]);

        session()->flash('success', 'Order berhasil diproses!');
        return redirect()->route('/');
    }

    public function render()
    {
        $totalHarga = $this->product->price * $this->quantity;
        $totalTagihan = $totalHarga + $this->biayaAdmin;

        return view('livewire.components.checkout-product', [
            'totalHarga' => $totalHarga,
            'totalTagihan' => $totalTagihan,
        ]);
    }
}
