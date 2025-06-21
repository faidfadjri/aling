<?php


namespace App\Policies;

use App\Models\User;
use App\Models\Product\ProductCategory;

class ProductCategoryPolicy
{
    public function viewAny(User $user)
    {
        return true; // user boleh lihat list
    }

    public function view(User $user, ProductCategory $category)
    {
        return true; // user boleh lihat detail
    }

    public function create(User $user)
    {
        // Contoh, cuma user dengan role admin boleh create
        return $user->role === 'admin';
    }

    public function update(User $user, ProductCategory $category)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, ProductCategory $category)
    {
        return $user->role === 'admin';
    }
}
