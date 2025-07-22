<?php

namespace App\Livewire\Admin;

use App\Models\Order\OrderOutlet;
use App\Models\Outlet;
use App\Static\OrderStatus;
use Livewire\Component;
use Livewire\WithPagination;

class Order extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $outlet = '';
    public $perPage = 10;
    public $date;
    public $selectedOrder;
    public $showModal = false;

    protected $queryString = ['search', 'status', 'outlet', 'date', 'perPage'];

    public function updating($property)
    {
        if (in_array($property, ['search', 'status', 'outlet', 'date', 'perPage'])) {
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
    public function deleteOrder($id)
    {
        $orderOutlet = OrderOutlet::find($id);

        if (!$orderOutlet) {
            return response()->json([
                'message' => 'Order tidak ditemukan.'
            ], 404);
        }

        $deleted = $orderOutlet->delete();

        $this->showModal = false;
        $this->reset();
        $this->resetPage();

        if ($deleted) {
            return response()->json([
                'message' => 'Order berhasil dihapus.'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Gagal menghapus order.'
            ], 500);
        }
    }


    public function render()
    {
        $orders = OrderOutlet::with(['order.user', 'outlet'])
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->whereHas('order', function ($q) {
                        $q->where('order_number', 'like', '%' . $this->search . '%');
                    })->orWhereHas('order.user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
                });
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->outlet, function ($query) {
                $query->where('outlet_id', $this->outlet);
            })
            ->when($this->date, function ($query) {
                $query->whereDate('created_at', $this->date);
            })
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.admin.order', [
            'orderOutlets'   => $orders,
            'outlets'        => Outlet::all(),
            'statuses'       => OrderStatus::all(),
            'completeStatus' => OrderStatus::completeStatus()
        ]);
    }
}
