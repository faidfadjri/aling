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
            ['name' => 'Ayam Potong', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ayam Kampung', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bagian Ayam', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Telur Ayam', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Olahan Ayam', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
