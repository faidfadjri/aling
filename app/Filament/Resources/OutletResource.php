<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutletResource\Pages;
use App\Models\Outlet;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
                ->relationship(
                    name: 'village',
                    titleAttribute: 'name',
                    modifyQueryUsing: fn($query) => $query->with('district.regency')
                )
                ->getOptionLabelFromRecordUsing(function ($record) {
                    $village = $record->name;
                    $district = $record->district->name ?? '-';
                    $regency = $record->district->regency->name ?? '-';

                    return "{$village} - {$district} - {$regency}";
                })
                ->searchable()
                ->unique()
                ->required(),

            Forms\Components\TextInput::make('phone')
                ->label('Nomor Telepon')
                ->required()
                ->tel()
                ->prefix('+62')
                ->maxLength(15),

            Forms\Components\TextInput::make('name')
                ->label('Nama Outlet')
                ->required()
                ->maxLength(255),

            RichEditor::make('description')
                ->label('Deskripsi')
                ->required(),
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

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama User')
                    ->sortable(),

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
