<?php

namespace App\Filament\Resources\MediaStoryResource\Pages;

use App\Filament\Resources\MediaStoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMediaStories extends ListRecords
{
    protected static string $resource = MediaStoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
