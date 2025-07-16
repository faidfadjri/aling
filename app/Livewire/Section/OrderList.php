<?php

namespace App\Livewire\Section;

use App\Models\Order\OrderItem;
use App\Models\Product\Review;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;

    public $selectedstatus = '';
    public $search = '';

    // Review Modal
    public $activeItemId = null;
    public bool $showModal = false;
    public int $rating = 5;
    public string $description = '';
    public string $name = '';

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->name = Auth::user()->name ?? '';
    }

    public function selectStatus($status)
    {
        $this->selectedstatus = $status;
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[On('review')]
    public function review($itemId)
    {
        $this->activeItemId = $itemId;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->reset(['showModal', 'rating', 'description', 'activeItemId']);
    }

    public function saveReview()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'required|string|min:5',
        ]);

        DB::beginTransaction();

        try {
            $item = OrderItem::find($this->activeItemId);

            Review::create([
                'product_id'  => $item->product_id,
                'rating'      => $this->rating,
                'description' => $this->description,
                'name'        => $this->name,
            ]);

            $item->update(['review' => true]);

            DB::commit();
        } catch (Exception $err) {
            Log::critical($err);
            DB::rollBack();
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function render()
    {
        $user = Auth::user();
        $addressIds = $user->addresses->pluck('id');

        $query = OrderItem::query()
            ->with(['orderOutlet.order', 'product'])
            ->whereHas('orderOutlet.order', function ($q) use ($addressIds) {
                $q->whereIn('address_id', $addressIds);

                if ($this->selectedstatus && $this->selectedstatus !== 'Semua') {
                    $q->where('status', $this->selectedstatus);
                }

                if ($this->search) {
                    $q->where('order_number', 'like', '%' . $this->search . '%');
                }
            });

        return view('livewire.section.order-list', [
            'items' => $query->orderByDesc('created_at')->paginate(5),
        ]);
    }
}
