<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
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
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'role' => 'user',
                'status' => true,
                'password' => bcrypt('123'),
                'hp' => '08123456789',
                'photo' => null,
            ],
        ]);
    }
}
