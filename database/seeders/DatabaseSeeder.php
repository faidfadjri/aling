<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            OutletSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
