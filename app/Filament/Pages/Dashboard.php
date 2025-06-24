<?php

namespace App\Filament\Pages;

use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
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
        $this->totalOrders = Order::count();
        $this->pendingOrders = Order::where('status', 'pending')->count();
        $this->confirmedOrders = Order::where('status', 'confirmed')->count();
        $this->deliveredOrders = Order::where('status', 'delivered')->count();

        $this->totalProducts = Product::count();
        $this->totalCategories = ProductCategory::count();
    }
}
