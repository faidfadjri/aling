<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin123'), // atau gunakan hash bawaanmu
                'hp' => '08123456789',
                'role' => 'admin',
                'status' => 1,
                'photo' => null
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User',
                'username' => 'user',
                'password' => Hash::make('user123'),
                'hp' => '08123456789',
                'role' => 'user',
                'status' => 1,
                'photo' => null
            ]
        );
    }
}
