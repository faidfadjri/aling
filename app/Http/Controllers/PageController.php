<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Repositories\Banner\BannerRepository;
use App\Repositories\Banner\BannerRepositoryImpl;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryImpl;

class PageController extends Controller
{
    protected BannerRepository $bannerRepository;
    protected ProductRepository $productRepository;

    public function __construct(
        BannerRepositoryImpl $bannerRepositoryImpl,
        ProductRepositoryImpl $productRepositoryImpl
    ) {
        $this->bannerRepository = $bannerRepositoryImpl;
        $this->productRepository = $productRepositoryImpl;
    }

    function index()
    {
        $banners            = $this->bannerRepository->getBanners();
        $discountedProducts = $this->productRepository->getDiscountedProducts();

        return view('pages.client.index', [
            'active'     => 'home',
            'disc'       => $discountedProducts,
            'banners'    => $banners
        ]);
    }
}
