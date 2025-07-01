<?php

namespace App\Livewire\Section;

use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderList extends Component
{
    public $selectedstatus = '';
    public $items  = [];
    public $search = '';

    public function mount()
    {
        $user = Auth::user();
        $addressIds = $user->addresses->pluck('id');

        $items = OrderItem::whereHas('order', function ($query) use ($addressIds) {
            $query->whereIn('address_id', $addressIds);
        })->get();
        $this->items  = $items;
    }

    public function selectStatus($status)
    {
        $this->selectedstatus = $status;
        $this->loadOrder();
    }

    public function loadOrder()
    {
        $query = Order::query();

        if ($this->selectedstatus && $this->selectedstatus !== 'Semua') {
            $query->where('status', $this->selectedstatus);
        }

        if ($this->search) {
            $query->where('order_number', 'like', '%' . $this->search . '%');
        }
    }

    public function updatedSearch()
    {
        $this->loadOrder();
    }

    public function render()
    {
        return view('livewire.section.order-list');
    }
}
