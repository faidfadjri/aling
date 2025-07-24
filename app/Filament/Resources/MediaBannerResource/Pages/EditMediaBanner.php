<?php

namespace App\Filament\Resources\MediaBannerResource\Pages;

use App\Filament\Resources\MediaBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaBanner extends EditRecord
{
    protected static string $resource = MediaBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
