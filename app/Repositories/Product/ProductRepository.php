<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepository
{
    function getCount(): ?int;
    static function searchByName(?string $keyword = '', ?int $limit = 6);
    function get(int $productID): array|Product|null;
    function getDiscountedProducts(int $limit = 10): array|Collection|null;
}
