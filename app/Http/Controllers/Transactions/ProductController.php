<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
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
        $product = Product::find($productID);

        return view('pages.client.product.product-detail', [
            'active' => 'product',
            'product' => $product,
        ]);
    }
}
