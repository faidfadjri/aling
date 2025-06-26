<?php

namespace App\Livewire\Section;

use App\Models\Order\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class OrderList extends Component
{
    public $selectedstatus = '';
    public $orders = [];
    public $search = '';

    public function mount()
    {
        $user = Auth::user();
        $addresses = $user->addresses;
        $orders = Order::whereIn('address_id', $addresses->pluck('id'))->get();
        $this->orders = $orders;
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

        $this->orders = $query->latest()->get();
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
