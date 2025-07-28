<?php

namespace App\Repositories\Cart;

use App\Models\Order\Cart;
use App\Models\Order\CartItem;
use Illuminate\Database\Eloquent\Collection;

class CartRepositoryImpl implements CartRepository
{
    public static function getByUserId(int $userId): ?Cart
    {
        return Cart::with('items.product.outlet')->where('user_id', $userId)->first();
    }

    public static function save($cart)
    {
        return Cart::create($cart);
    }

    public static function getItem(int $cartItemId): ?CartItem
    {
        return CartItem::find($cartItemId);
    }

    public static function getValidatedItem(int $cartId, int $productId)
    {
        return CartItem::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->first();
    }

    public static function saveItem($cartItem)
    {
        return CartItem::create($cartItem);
    }

    public static function increase(int $cartItemId)
    {
        $item = self::getItem($cartItemId);
        if ($item) {
            $item->quantity++;
            $item->save();
        }
    }

    public static function decrease(int $cartItemId)
    {
        $item = self::getItem($cartItemId);
        if ($item) {
            $item->quantity--;
            $item->save();
        }
    }

    public static function getItemWithIds(array $cartItemIds): array|Collection|null
    {
        $cartItems = CartItem::with('product')
            ->whereIn('id', $cartItemIds)
            ->get();
        return $cartItems;
    }

    public static function deleteItemWithIds(array $cartItemIds)
    {
        CartItem::whereIn('id', $cartItemIds)->delete();
    }
}
