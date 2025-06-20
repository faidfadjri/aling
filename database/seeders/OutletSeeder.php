<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Outlet::insert([
            'user_id'       => 1,
            'name'          => 'Outlet Purwokerto',
            'description'   => 'This is the main outlet located in Purwokerto, serving a wide range of products to local customers.'
        ]);
    }
}
