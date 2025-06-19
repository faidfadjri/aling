<?php

namespace App\Livewire\Section;

use Livewire\Component;

class ProductList extends Component
{
    public string $selectedCity = '';
    public array $products = [];

    public function mount()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $this->products = collect(range(1, 10))->map(function ($i) {
            return (object)[
                'id' => $i,
                'title' => 'Ayam Potong 5KG',
                'price' => 50000,
                'rating' => 4.6,
                'sold' => 500,
                'outlet' => 'Outlet Purwokerto',
                'image' => 'https://www.sinarpahalautama.com/image-product/img61-1581762923.jpg',
            ];
        })->toArray();
    }

    public function selectCity(string $city)
    {
        $this->selectedCity = $city;
        $this->loadProducts();
    }

    public function render()
    {
        return view('livewire.section.product-list');
    }
}
