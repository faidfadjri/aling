<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $imageUrl = 'https://cdn.rri.co.id/berita/Palangkaraya/o/1727136526950-WhatsApp_Image_2024-09-24_at_07.05.34/dju4f310k9l3wam.jpeg';

        $names = [
            'Ayam Potong Segar',
            'Ayam Kampung Hidup',
            'Paha Ayam Potong',
            'Telur Ayam Kampung',
            'Sate Ayam Bumbu Kacang',
            'Fillet Dada Ayam',
            'Nugget Ayam Homemade',
            'Kulit Ayam Krispi',
            'Ceker Ayam Segar',
            'Sayap Ayam BBQ',
            'Daging Ayam Giling',
            'Sosis Ayam Homemade',
            'Ayam Ungkep Bumbu Kuning',
            'Ayam Fillet Pedas Manis',
            'Ayam Crispy Frozen',
            'Tulang Ayam Sup',
            'Ayam Potong Organik',
            'Telur Ayam Negeri',
            'Kepala Ayam Segar',
            'Ayam Bumbu Rujak'
        ];

        $products = [];

        foreach ($names as $name) {
            $products[] = [
                'name' => $name,
                'image' => $imageUrl,
                'description' => $name . ' berkualitas dan siap konsumsi.',
                'category_id' => rand(1, 5),
                'stock' => rand(20, 100),
                'discount' => rand(0, 20),
                'price' => rand(18000, 80000),
                'status' => true,
                'outlet_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Product::insert($products);
    }
}
