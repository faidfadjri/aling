<?php

namespace App\Repositories\Cart;

use App\Models\Order\Cart;
use App\Models\Order\CartItem;
use Illuminate\Database\Eloquent\Collection;

interface CartRepository
{
    static function save($cart);
    static function getByUserId(int $userId): ?Cart;

    static function getItem(int $cartItemId): ?CartItem;
    static function getValidatedItem(int $cartId, int $productId);
    static function saveItem($cartItem);

    static function increase(int $cartItemId);
    static function decrease(int $cartItemId);

    static function getItemWithIds(array $cartItemIds): array|Collection|null;
    static function deleteItemWithIds(array $cartItemIds);
}
