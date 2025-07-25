<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(Request $request)
    {
        $keyword = $request->input('search');

        return view('pages.client.product.product', [
            'active'  => 'product',
            'keyword' => $keyword
        ]);
    }

    public function detail($productID)
    {
        $product        = Product::find($productID);
        $city           = $product?->outlet?->village?->district?->regency?->name;

        $closestOutlet  = Outlet::whereHas("village.district.regency", function ($query) use ($city) {
            $query->where("name", $city);
        })->get();

        return view('pages.client.product.product-detail', [
            'active'        => 'product',
            'product'       => $product,
            'closestOutlet' => $closestOutlet
        ]);
    }
}
