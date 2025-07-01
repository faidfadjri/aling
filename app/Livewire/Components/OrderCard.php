<?php

namespace App\Livewire\Components;

use Livewire\Component;

class OrderCard extends Component
{
    public object $item;

    public function confirm()
    {
        $this->dispatch('orderConfirmed', order: $this->item);
    }

    public function render()
    {
        return view('livewire.components.order-card');
    }
}
