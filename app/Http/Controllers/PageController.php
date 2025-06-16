<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function index()
    {
        return view('pages.client.index', [
            'active' => 'home'
        ]);
    }

    function search()
    {
        return view('pages.client.search');
    }

    function product()
    {
        return view('pages.client.product', [
            'active' => 'product'
        ]);
    }
}
