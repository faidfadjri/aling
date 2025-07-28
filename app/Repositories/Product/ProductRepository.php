<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepository
{
    function getCount(): ?int;
    static function getPagination(?string $keyword = null, ?string $city = null, $limit = 6): array|LengthAwarePaginator|null;

    static function searchByName(?string $keyword = '', ?int $limit = 6);
    static function get(int $productID): array|Product|null;
    function getDiscountedProducts(int $limit = 10): array|Collection|null;
}
