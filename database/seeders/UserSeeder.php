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
                'password' => Hash::make('admin123'),
                'hp' => '08123456789',
                'role' => 'master',
                'status' => 1,
                'photo' => null
            ]
        );

        User::firstOrCreate(
            ['email' => 'outlet@gmail.com'],
            [
                'name' => 'Outlet',
                'username' => 'outlet',
                'password' => Hash::make('outlet123'),
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


        User::firstOrCreate(
            ['email' => 'faidfadjri@gmail.com'],
            [
                'name' => 'Faid Fadjri',
                'username' => 'faidfadjri',
                'password' => Hash::make('password'),
                'hp' => '08123456789',
                'role' => 'user',
                'status' => 1,
                'photo' => null
            ]
        );
    }
}
