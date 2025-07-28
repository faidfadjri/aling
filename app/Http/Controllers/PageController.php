<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Repositories\Banner\BannerRepository;
use App\Repositories\Banner\BannerRepositoryImpl;

class PageController extends Controller
{
    protected BannerRepository $bannerRepository;

    public function __construct(BannerRepositoryImpl $bannerRepositoryImpl)
    {
        $this->bannerRepository = $bannerRepositoryImpl;
    }

    function index()
    {
        $disc = Product::where('discount', '>', 0)
            ->orderBy('stock', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $banners = $this->bannerRepository->getBanners();

        return view('pages.client.index', [
            'active'     => 'home',
            'disc'       => $disc,
            'banners'    => $banners
        ]);
    }
}
