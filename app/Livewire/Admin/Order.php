<?php

namespace App\Livewire\Admin;

use App\Models\Order\OrderOutlet;
use App\Models\Outlet;
use App\Static\OrderStatus;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Order extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $outlet = '';
    public $perPage = 10;
    public $startDate;
    public $endDate;
    public $selectedOrder;
    public $showModal = false;

    protected $queryString = ['search', 'status', 'outlet', 'startDate', 'endDate', 'perPage'];

    public function updating($property)
    {
        if (in_array($property, ['search', 'status', 'outlet', 'startDate', 'endDate', 'perPage'])) {
            $this->resetPage();
        }
    }

    public function showDetail($id)
    {
        $this->selectedOrder = OrderOutlet::with(['items.product', 'order.user'])->find($id);
        $this->showModal = true;
    }

    public function updateStatus($id, $newStatus)
    {
        $order = OrderOutlet::find($id);
        $order->status = $newStatus;
        $order->save();
        $this->showModal = false;
    }

    public function render()
    {
        $orders = OrderOutlet::with(['order.user', 'outlet'])
            ->when($this->search, fn($q) => $q->whereHas('order', fn($q) => $q->where('invoice_number', 'like', "%{$this->search}%")))
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->when($this->outlet, fn($q) => $q->where('outlet_id', $this->outlet))
            ->when($this->startDate && $this->endDate, fn($q) => $q->whereBetween(DB::raw('DATE(created_at)'), [$this->startDate, $this->endDate]))
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.admin.order', [
            'orderOutlets'  => $orders,
            'outlets'       => Outlet::all(),
            'statuses'      => OrderStatus::all()
        ]);
    }
}
