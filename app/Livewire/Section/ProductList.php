<?php

namespace App\Livewire\Section;

use App\Models\Outlet;
use App\Models\Product\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public ?string  $search = '';
    public          $cities = [];
    public string   $selectedCity = '';
    public int      $perPage = 12;

    public function selectCity(string $city)
    {
        $this->selectedCity = $city;
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query();

        if ($this->selectedCity) {
            $query->whereHas('outlet', function ($q) {
                $q->where('name', $this->selectedCity);
            });
        }

        if ($this->search && $this->search != '') {
            $query->where('name', 'like', "%$this->search%");
        }
        $query->where('status', true);

        $this->cities = Outlet::with('village.district.regency')
            ->get()
            ->pluck('village.district.regency.name')
            ->unique()
            ->values()
            ->toArray();

        return view('livewire.section.product-list', [
            'products' => $query->paginate($this->perPage),
        ]);
    }
}
