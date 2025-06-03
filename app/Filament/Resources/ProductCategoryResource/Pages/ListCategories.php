<?php

namespace App\Filament\Resources\ProductCategoryResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ProductCategoryResource;

class ListCategories extends ListRecords
{
    protected static string $resource = ProductCategoryResource::class;
}
