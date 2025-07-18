<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class OrderCard extends Component
{
    public object $item;

    public function review()
    {
        $this->dispatch('review', $this->item->id);
    }

    public function confirmCancel()
    {
        $this->dispatch('confirm-cancel');
    }

    #[On('cancelConfirmed')]
    public function cancelConfirmed()
    {
        Log::debug("proses pembatalan");
    }

    public function render()
    {
        return view('livewire.components.order-card');
    }
}
