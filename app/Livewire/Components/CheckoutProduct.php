<?php

namespace App\Livewire\Components;

use Livewire\Component;

class CheckoutProduct extends Component
{
    public $product;
    public $quantity = 1;
    public $biayaAdmin = 5000;
    public $isEditing = false;

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
