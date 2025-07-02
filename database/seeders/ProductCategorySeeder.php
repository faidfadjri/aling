<?php

namespace Database\Seeders;

use App\Models\Product\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::insert([
            ['name' => 'Ayam Potong', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ayam Kampung', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bagian Ayam', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Telur Ayam', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Olahan Ayam', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
