<?php

namespace App\Filament\Resources;

use App\Models\Media\Banner;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Storage;

class MediaBannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationLabel = 'Banner';
    protected static ?string $navigationIcon  = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Kelola Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')
                    ->default(auth()->id()),

                TextInput::make('title')->maxLength(255),
                Textarea::make('description')->maxLength(1000),

                FileUpload::make('content')
                    ->label('Banner Image')
                    ->helperText('Upload gambar banner dengan resolusi minimal 1000x400 pixel untuk kualitas terbaik.')
                    ->disk('public')
                    ->directory('media-banners')
                    ->required()
                    ->preserveFilenames()
                    ->visibility('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(5120) // 5MB
                    ->afterStateUpdated(function ($state, \Filament\Forms\Set $set, \Filament\Forms\Get $get, $record) {
                        // Handle jika $state adalah array, ambil elemen pertama
                        $fileName = is_array($state) ? ($state[0] ?? null) : $state;

                        // Hapus file lama jika ada record (update mode) dan file berubah
                        if ($record && $record->content && $record->content !== $fileName) {
                            if (Storage::disk('public')->exists($record->content)) {
                                Storage::disk('public')->delete($record->content);
                            }
                        }

                        if ($fileName) {
                            $path = storage_path("app/public/{$fileName}");
                            if (file_exists($path)) {
                                $mime = mime_content_type($path);
                                $set('mime_type', $mime);

                                // Get image dimensions
                                $imageInfo = getimagesize($path);
                                if ($imageInfo) {
                                    $width = $imageInfo[0];
                                    $height = $imageInfo[1];
                                    $set('image_width', $width);
                                    $set('image_height', $height);
                                    $set('image_resolution', "{$width}x{$height}");
                                }
                            }
                        }
                    })
                    ->hint(function ($state) {
                        // Handle jika $state adalah array, ambil elemen pertama
                        $fileName = is_array($state) ? ($state[0] ?? null) : $state;

                        if ($fileName) {
                            $path = storage_path("app/public/{$fileName}");
                            if (file_exists($path)) {
                                $imageInfo = getimagesize($path);
                                if ($imageInfo) {
                                    $width = $imageInfo[0];
                                    $height = $imageInfo[1];
                                    $fileSize = number_format(filesize($path) / 1024, 2);
                                    return "Resolusi: {$width}x{$height} px | Ukuran: {$fileSize} KB";
                                }
                            }
                        }
                        return null;
                    }),

                Toggle::make('is_active')->default(true),
                TextInput::make('position')->numeric()->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('content')->disk('public')->height(60)->square()->label('Konten'),
                TextColumn::make('title')->limit(25)->label('Judul'),
                TextColumn::make('user.name')->label('Pengguna'),
                TextColumn::make('position')->label('Posisi'),
                ToggleColumn::make('is_active')->label('Aktif'),
                TextColumn::make('created_at')->dateTime('d M Y H:i'),
            ])
            ->filters([
                TernaryFilter::make('is_active')->label('Status'),
                SelectFilter::make('user_id')->relationship('user', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => MediaBannerResource\Pages\ListMediaBanners::route('/'),
            'create' => MediaBannerResource\Pages\CreateMediaBanner::route('/create'),
            'edit' => MediaBannerResource\Pages\EditMediaBanner::route('/{record}/edit'),
        ];
    }
}
