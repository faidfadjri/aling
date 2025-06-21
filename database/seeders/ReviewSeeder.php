<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product\Review;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Review::create([
                'product_id' => rand(1, 20),
                'rating' => rand(1, 5),
                'description' => $faker->paragraph(),
                'name' => $faker->name(),
            ]);
        }
    }
}
