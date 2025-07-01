<?php

namespace App\Livewire\Components;

use Livewire\Component;

class OrderCard extends Component
{
    public object $item;

    public function review()
    {
        $this->dispatch('review', $this->item->id);
    }

    public function render()
    {
        return view('livewire.components.order-card');
    }
}
