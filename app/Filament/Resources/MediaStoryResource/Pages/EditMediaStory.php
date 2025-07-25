<?php

namespace App\Filament\Resources\MediaStoryResource\Pages;

use App\Filament\Resources\MediaStoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMediaStory extends EditRecord
{
    protected static string $resource = MediaStoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
