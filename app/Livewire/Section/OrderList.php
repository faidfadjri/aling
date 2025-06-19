<?php

namespace App\Livewire\Section;

use Livewire\Component;

class OrderList extends Component
{
    public $selectedstatus = '';
    public array $orders = [];
    public $search = '';

    public function mount()
    {
        $this->loadOrder();
    }

    public function loadOrder()
    {
        $this->orders = collect(range(1, 3))->map(function ($i) {
            return (object)[
                'date' => '23 Juni 2025',
                'product_name' => 'Ayam Potong 5KG',
                'qty' => 2,
                'price' => 309_680,
                'status' => 'Dipesan',
                'image' => 'https://img.pikbest.com/png-images/20241022/chicken-meat-png-isolated-on-transparent-background-high-resolution_10991407.png!bw700',
            ];
        })->toArray();
    }

    public function selectStatus($status)
    {
        $this->selectedstatus = $status;
        $this->loadOrder();
    }

    public function render()
    {
        return view('livewire.section.order-list');
    }
}
