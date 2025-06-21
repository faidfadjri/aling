<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;

class PageController extends Controller
{
    function index()
    {
        $disc = Product::where('discount', '>', 0)
            ->orderBy('stock', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('pages.client.index', [
            'active'     => 'home',
            'disc'       => $disc,
        ]);
    }
}
