<?php

namespace App\Filament\Resources\MediaBannerResource\Pages;

use App\Filament\Resources\MediaBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaBanners extends ListRecords
{
    protected static string $resource = MediaBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
