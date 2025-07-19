<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Order extends Page
{
    protected static ?string $navigationIcon    = 'heroicon-o-clipboard-document-list';
    protected static string $view               = 'filament.pages.order';
    protected static ?string $navigationGroup   = "Transaksi";
    protected static ?string $navigationLabel   = "Pesanan";
    protected static ?string $title             = "Pesanan";
}
