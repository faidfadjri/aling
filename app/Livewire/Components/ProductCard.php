<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ProductCard extends Component
{
    public string $image;
    public int $productId;
    public string $title;
    public int $price;
    public float $rating;
    public int $sold;
    public string $outlet;

    public function render()
    {
        return view('livewire.components.product-card');
    }
}
