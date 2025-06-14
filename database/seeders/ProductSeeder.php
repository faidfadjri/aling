<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Ayam Potong Segar',
                'image' => 'ayam-potong.jpg',
                'description' => 'Ayam potong segar siap masak, berat sekitar 1kg.',
                'category_id' => 1, // Ayam Potong
                'price' => 38000,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ayam Kampung Hidup',
                'image' => 'ayam-kampung.jpg',
                'description' => 'Ayam kampung asli, cocok untuk gulai dan sop.',
                'category_id' => 2, // Ayam Kampung
                'price' => 70000,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paha Ayam Potong',
                'image' => 'paha-ayam.jpg',
                'description' => 'Paha ayam potong segar, cocok untuk digoreng.',
                'category_id' => 3, // Bagian Ayam
                'price' => 20000,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Telur Ayam Kampung',
                'image' => 'telur-ayam.jpg',
                'description' => 'Telur ayam kampung segar, isi 10 butir.',
                'category_id' => 4, // Telur Ayam
                'price' => 25000,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sate Ayam Bumbu Kacang',
                'image' => 'sate-ayam.jpg',
                'description' => 'Sate ayam siap santap dengan bumbu kacang khas.',
                'category_id' => 5, // Olahan Ayam
                'price' => 20000,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
