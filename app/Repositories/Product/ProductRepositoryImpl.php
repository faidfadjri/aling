<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public static function getPagination(?string $keyword = null, ?string $city = null, $limit = 6): array|LengthAwarePaginator|null
    {
        $query = Product::query();

        if ($city) {
            $query->whereHas('outlet.village.district.regency', function ($q) use ($city) {
                $q->where('name', $city);
            });
        }

        if ($keyword && $keyword != '') {
            $query->where('name', 'like', "%$keyword%");
        }
        $query->where('status', true);
        return $query->paginate($limit);
    }

    public static function searchByName(?string $keyword = '', ?int $limit = 6)
    {
        return Product::where("name", "like", "%$keyword%")->limit($limit)->get();
    }

    public static function get(int $productID): ?Product
    {
        return Product::find($productID);
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
