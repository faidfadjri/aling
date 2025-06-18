<?php

namespace App\Livewire\Section;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProductList extends Component
{
    public bool $loading = true;
    public string $selectedCity = '';


    public function selectCity(string $city)
    {
        $this->selectedCity = $city;
        $this->loading = true;

        Log::debug("Selected city: {$this->selectedCity}");

        // Simulasi data fetch
        sleep(1);

        $this->loading = false;
    }


    public function loadProducts()
    {
        $this->loading = true;
        sleep(1); // simulasi fetch data
        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.section.product-list');
    }
}
