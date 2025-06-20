<?php

namespace App\Livewire\Section;

use App\Models\ProductCategory;
use Livewire\Component;

class ProductCategoryList extends Component
{
    public $categories;
    public $activeCategoryId;

    public function mount()
    {
        $this->categories = ProductCategory::with('products.outlet')->limit(2)->orderBy('name')->get();
        $this->activeCategoryId = $this->categories->first()->id ?? null;
    }

    public function setActiveCategory($categoryId)
    {
        $this->activeCategoryId = $categoryId;
        $this->dispatch('reinit-swiper');
    }

    public function render()
    {
        $activeCategory = $this->categories->firstWhere('id', $this->activeCategoryId);
        return view('livewire.section.product-category-list', [
            'activeCategory' => $activeCategory,
        ]);
    }
}
