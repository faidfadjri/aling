<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::insert([
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'status' => true,
                'password' => bcrypt('123'),
                'hp' => '08123456789',
                'photo' => null,
            ],
        ]);
        (new ProductCategorySeeder())->run();
        (new ProductSeeder())->run();
    }
}
