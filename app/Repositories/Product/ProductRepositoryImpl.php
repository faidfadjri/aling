<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepositoryImpl implements ProductRepository
{
    protected Product $model;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function getCount(): ?int
    {
        return $this->model->count();
    }

    public function searchByName(?string $keyword = '', ?int $limit = 6)
    {
        return $this->model->where("name", "like", "%$keyword%")->limit($limit)->get();
    }

    public function get(int $productID): ?Product
    {
        return $this->model->find($productID);
    }

    public function getDiscountedProducts(int $limit = 10): ?Collection
    {
        return $this->model->where('discount', '>', 0)
            ->orderBy('stock', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
