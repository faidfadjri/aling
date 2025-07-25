<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutletResource\Pages;
use App\Models\Outlet;
use App\Models\Region\Village;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class OutletResource extends Resource
{
    protected static ?string $model = Outlet::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationLabel = 'Outlet';
    protected static ?string $navigationGroup = 'Kelola Pengguna';

    public static function canAccess(): bool
    {
        $role = auth()->user()?->role;
        return  $role === 'master' && $role !== 'user';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name')
                ->searchable()
                ->default(fn() => auth()->id())
                ->disabled(fn() => auth()->user()->role !== 'master')
                ->required(),

            Select::make('village_id')
                ->label('Desa/Kelurahan')
                ->searchable()
                ->getSearchResultsUsing(function (string $search) {
                    return Village::query()
                        ->with('district.regency')
                        ->where('name', 'like', "%{$search}%")
                        ->orWhereHas(
                            'district',
                            fn($q) =>
                            $q->where('name', 'like', "%{$search}%")
                                ->orWhereHas(
                                    'regency',
                                    fn($qr) =>
                                    $qr->where('name', 'like', "%{$search}%")
                                )
                        )
                        ->limit(50)
                        ->get()
                        ->mapWithKeys(function ($village) {
                            $villageName = $village->name;
                            $districtName = $village->district->name ?? '-';
                            $regencyName = $village->district->regency->name ?? '-';
                            return [$village->id => "{$villageName} - {$districtName} - {$regencyName}"];
                        })
                        ->toArray();
                })
                ->getOptionLabelUsing(function ($value) {
                    $village = Village::with('district.regency')->find($value);
                    if (!$village) return $value;
                    $villageName = $village->name;
                    $districtName = $village->district->name ?? '-';
                    $regencyName = $village->district->regency->name ?? '-';
                    return "{$villageName} - {$districtName} - {$regencyName}";
                })
                ->required(),


            TextInput::make('phone')
                ->label('Nomor Telepon')
                ->required()
                ->tel()
                ->prefix('+62')
                ->maxLength(15),

            TextInput::make('name')
                ->label('Nama Outlet')
                ->required()
                ->maxLength(255),

            RichEditor::make('description')
                ->label('Deskripsi')
                ->required(),

            TextInput::make('coordinates')
                ->label('Koordinat Lokasi')
                ->required()
                ->default(fn($record) => $record?->coordinates),

            FileUpload::make('photo')
                ->label('Foto Outlet')
                ->image()
                ->directory('outlet-photos')
                ->maxSize(2048) // maksimal 2MB sebelum dikompres
                ->getUploadedFileNameForStorageUsing(function ($file) {
                    return (string) Str::uuid() . '.' . $file->getClientOriginalExtension();
                })
                ->afterStateUpdated(function ($state, callable $set) {
                    if ($state && Storage::disk('public')->exists($state)) {
                        $path = Storage::disk('public')->path($state);

                        $image = Image::make($path)
                            ->resize(800, null, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            })
                            ->encode(null, 75);

                        file_put_contents($path, $image);
                    }
                }),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Outlet')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi')
                    ->getStateUsing(function ($record) {
                        $village = $record->village->name ?? '-';
                        $district = $record->village->district->name ?? '-';
                        $regency = $record->village->district->regency->name ?? '-';

                        return "{$regency}, {$district}, {$village}";
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->getStateUsing(fn($record) => '+62' . ltrim($record->phone, '0'))
                    ->copyable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('products_count')
                    ->label('Jumlah Produk')
                    ->counts('products')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Filter User')
                    ->relationship('user', 'name')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultPaginationPageOption(25);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Filament::auth()->user();

        return parent::getEloquentQuery()
            ->when($user->role !== 'master', fn($q) => $q->where('user_id', $user->id))
            ->with('user');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOutlets::route('/'),
            'create' => Pages\CreateOutlet::route('/create'),
            'edit' => Pages\EditOutlet::route('/{record}/edit'),
        ];
    }
}
