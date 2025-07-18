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
            'photo'         => 'https://media.istockphoto.com/id/1351443957/id/vektor/megafon-dengan-spanduk-gelembung-pidato-outlet-pengeras-suara-label-untuk-bisnis-pemasaran.jpg?s=612x612&w=0&k=20&c=mj8B4CJdGtVTuaKEq0lpwsx6yGR3gyQrcVXiTiyWd_M=',
            'description'   => 'This is the main outlet located in Purwokerto, serving a wide range of products to local customers.',
            'coordinates'   => '7.4246,109.2272',
        ]);
    }
}
