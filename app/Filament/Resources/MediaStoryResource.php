<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaStoryResource\Pages;
use App\Models\Media\Story;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class MediaStoryResource extends Resource
{
    protected static ?string $model = Story::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Kelola Konten';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Hidden::make('user_id')
                ->default(auth()->id()),

            FileUpload::make('content')
                ->label('Story Image')
                ->image()
                ->directory('stories')
                ->required()
                ->preserveFilenames()
                ->imagePreviewHeight('250')
                ->downloadable()
                ->openable()
                ->deleteUploadedFileUsing(function (string $file) {
                    // Custom handler untuk menghapus file
                    if (Storage::disk('public')->exists($file)) {
                        Storage::disk('public')->delete($file);
                    }
                }),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                ImageColumn::make('content')
                    ->disk('public')
                    ->height(60)
                    ->square()
                    ->label('Konten'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Is Active')
                    ->getStateUsing(fn($record) => !$record->is_expired)
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_expired')
                    ->label('Expired'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            // Hapus semua file sebelum bulk delete
                            foreach ($records as $record) {
                                if ($record->content && Storage::disk('public')->exists($record->content)) {
                                    Storage::disk('public')->delete($record->content);
                                }
                            }
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMediaStories::route('/'),
            'create' => Pages\CreateMediaStory::route('/create'),
            'edit' => Pages\EditMediaStory::route('/{record}/edit'),
        ];
    }
}
