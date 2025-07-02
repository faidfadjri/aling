<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Outlet;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon  = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Daftar Produk';
    protected static ?string $navigationGroup = 'Kelola Produk';

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->with(['category', 'outlet']);

        $user = Auth::user();

        if ($user->role !== 'master') {
            $outletIds = $user->outlets->pluck('id');
            $query->whereIn('outlet_id', $outletIds);
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Select::make('outlet_id')
                    ->label('Outlet')
                    ->required()
                    ->searchable()
                    ->getSearchResultsUsing(function (string $search) {
                        $user = Auth::user();

                        $query = Outlet::query()
                            ->where('name', 'like', "%{$search}%");

                        if ($user->role !== 'master') {
                            $query->whereIn('id', $user->outlets->pluck('id'));
                        }

                        return $query->limit(15)->pluck('name', 'id');
                    })
                    ->getOptionLabelUsing(fn($value) => Outlet::find($value)?->name),

                FileUpload::make('image')
                    ->image()
                    ->directory('products')
                    ->imagePreviewHeight('200')
                    ->maxSize(2048)
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $path = storage_path("app/public/{$state}");
                        if (file_exists($path)) {
                            \Spatie\ImageOptimizer\OptimizerChainFactory::create()->optimize($path);
                        }
                    }),

                TextInput::make('discount')
                    ->label('Discount (%)')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%')
                    ->helperText('Enter discount percentage (0-100)')
                    ->lazy(),

                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->lazy(),

                Select::make('category_id')
                    ->label('Category')
                    ->required()
                    ->searchable()
                    ->getSearchResultsUsing(
                        fn(string $search) =>
                        ProductCategory::where('name', 'like', "%{$search}%")
                            ->limit(20)
                            ->pluck('name', 'id')
                    )
                    ->getOptionLabelUsing(
                        fn($value) =>
                        ProductCategory::find($value)?->name
                    ),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix('Rp')
                    ->rule('regex:/^\d+(\.\d{1,2})?$/')
                    ->helperText('Format: 0.00'),

                Toggle::make('status')
                    ->label('Active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                ImageColumn::make('image')->label('Photo')->circular(),
                TextColumn::make('category.name')->label('Category')->sortable(),
                TextColumn::make('price')->money('idr', true),
                IconColumn::make('status')->label('Aktif')->boolean(),
                TextColumn::make('created_at')->label('Created')->dateTime('d M Y'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
