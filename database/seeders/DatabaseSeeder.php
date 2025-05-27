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
                'email' => 'admin@bsi.ac.id',
                'role' => '1',
                'status' => true,
                'password' => bcrypt('123'),
                'hp' => '08123456789',
                'photo' => null,
            ],
            [
                'name' => 'Mohamad Faid Fadjri',
                'email' => 'faidfadjri@gmail.com',
                'role' => '0',
                'status' => true,
                'password' => bcrypt('123'),
                'hp' => '08123456789',
                'photo' => null,
            ],
        ]);
    }
}
