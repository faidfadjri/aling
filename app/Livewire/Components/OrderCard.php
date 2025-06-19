<?php

namespace App\Livewire\Components;

use Livewire\Component;

class OrderCard extends Component
{
    public object $order;

    public function confirm()
    {
        $this->dispatch('orderConfirmed', order: $this->order);
    }

    public function render()
    {
        return view('livewire.components.order-card');
    }
}
