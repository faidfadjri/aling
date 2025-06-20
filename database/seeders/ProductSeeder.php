<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $imageUrl = 'https://static.vecteezy.com/system/resources/previews/036/094/276/non_2x/ai-generated-whole-raw-chicken-on-a-transparent-background-free-png.png';

        Product::insert([
            [
                'name' => 'Ayam Potong Segar',
                'image' => $imageUrl,
                'description' => 'Ayam potong segar siap masak, berat sekitar 1kg.',
                'category_id' => 1,
                'stock' => 50,
                'discount' => 10,
                'price' => 38000,
                'status' => true,
                'outlet_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ayam Kampung Hidup',
                'image' => $imageUrl,
                'description' => 'Ayam kampung asli, cocok untuk gulai dan sop.',
                'category_id' => 2,
                'stock' => 30,
                'discount' => 0,
                'price' => 70000,
                'status' => true,
                'outlet_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paha Ayam Potong',
                'image' => $imageUrl,
                'description' => 'Paha ayam potong segar, cocok untuk digoreng.',
                'category_id' => 3,
                'stock' => 100,
                'discount' => 5,
                'price' => 20000,
                'status' => true,
                'outlet_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Telur Ayam Kampung',
                'image' => $imageUrl,
                'description' => 'Telur ayam kampung segar, isi 10 butir.',
                'category_id' => 4,
                'stock' => 80,
                'discount' => 0,
                'price' => 25000,
                'status' => true,
                'outlet_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sate Ayam Bumbu Kacang',
                'image' => $imageUrl,
                'description' => 'Sate ayam siap santap dengan bumbu kacang khas.',
                'category_id' => 5,
                'stock' => 40,
                'discount' => 15,
                'price' => 20000,
                'status' => true,
                'outlet_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fillet Dada Ayam',
                'image' => $imageUrl,
                'description' => 'Dada ayam fillet tanpa tulang, cocok untuk steak.',
                'category_id' => 3,
                'stock' => 70,
                'discount' => 7,
                'price' => 32000,
                'status' => true,
                'outlet_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nugget Ayam Homemade',
                'image' => $imageUrl,
                'description' => 'Nugget ayam buatan rumah tanpa pengawet.',
                'category_id' => 5,
                'stock' => 90,
                'discount' => 12,
                'price' => 30000,
                'status' => true,
                'outlet_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
