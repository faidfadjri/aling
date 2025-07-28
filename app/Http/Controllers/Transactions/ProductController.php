<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Product\Product;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryImpl;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepositoryImpl $productRepositoryImpl)
    {
        $this->productRepository = $productRepositoryImpl;
    }

    public function index(Request $request)
    {
        $keyword = $request->input('search');

        return view('pages.client.product.product', [
            'active'  => 'product',
            'keyword' => $keyword
        ]);
    }

    public function detail($productID)
    {
        $product        = $this->productRepository->get($productID);
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
