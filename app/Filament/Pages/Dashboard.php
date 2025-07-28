<?php

namespace App\Filament\Pages;

use App\Models\Order\OrderOutlet;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Repositories\Product\ProductRepositoryImpl;
use App\Static\OrderStatus;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static string $view = 'filament.pages.dashboard';

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $navigationGroup = null;
    public static ?string $slug = 'dashboard';

    public int $totalOrders;
    public int $pendingOrders;
    public int $confirmedOrders;
    public int $deliveredOrders;

    public int $totalProducts;
    public int $totalCategories;

    public function mount(): void
    {
        $this->totalOrders      = OrderOutlet::count();
        $this->pendingOrders    = OrderOutlet::where('status', OrderStatus::PENDING)->count();
        $this->confirmedOrders  = OrderOutlet::where('status', OrderStatus::IN_PROGRESS)->count();
        $this->deliveredOrders  = OrderOutlet::where('status', OrderStatus::COMPLETED)->count();

        $productRepository      = new ProductRepositoryImpl();

        $this->totalProducts    = $productRepository->getCount();
        $this->totalCategories  = ProductCategory::count();
    }
}
