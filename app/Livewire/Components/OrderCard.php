<?php

namespace App\Livewire\Components;

use App\Models\Order\OrderOutlet;
use App\Static\OrderStatus;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class OrderCard extends Component
{
    public object $item;

    public function mount()
    {
        $this->listeners = [
            'cancelConfirmed-' . $this->item->id => 'cancelConfirmed',
        ];
    }

    public function review()
    {
        $this->dispatch('review', $this->item->id);
    }

    public function confirmCancel()
    {
        $this->dispatch('confirm-cancel', ['id' => $this->item->id]);
    }

    #[On('cancelConfirmed-{item.id}')]
    public function cancelConfirmed()
    {
        Log::debug('OrderCard: cancelConfirmed', ['item' => $this->item]);
        $orderOutlet = OrderOutlet::find($this->item->id);
        $orderOutlet->status = OrderStatus::REQ_CANCEL;
        $orderOutlet->save();

        return redirect()->route('order');
    }

    public function render()
    {
        return view('livewire.components.order-card');
    }
}
