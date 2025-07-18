<?php

namespace App\Livewire\Section;

use App\Models\Order\OrderOutlet;
use App\Static\OrderStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;

    public $selectedstatus = '';
    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function selectStatus($status)
    {
        $this->selectedstatus = $status;
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = Auth::user();
        $addressIds = $user->addresses->pluck('id');

        $query = OrderOutlet::query()
            ->with(['order', 'items.product'])
            ->whereHas('order', function ($q) use ($addressIds) {
                $q->whereIn('address_id', $addressIds);

                if ($this->selectedstatus && $this->selectedstatus !== 'Semua') {
                    $q->where('status', $this->selectedstatus);
                }

                if ($this->search) {
                    $q->where('order_number', 'like', '%' . $this->search . '%');
                }
            });

        $orderStatuses = OrderStatus::all();

        return view('livewire.section.order-list', [
            'items'         => $query->orderByDesc('created_at')->paginate(5),
            'orderStatuses' => $orderStatuses,
        ]);
    }
}
