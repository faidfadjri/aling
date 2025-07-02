<?php

namespace App\Livewire\Section;

use Livewire\Component;

class ProductDetail extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.section.product-detail');
    }
}
