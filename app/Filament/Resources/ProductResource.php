<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
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

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Product List';
    protected static ?string $navigationGroup = 'Product';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('image')
                    ->label('Product Image')
                    ->image()
                    ->directory('products')
                    ->imagePreviewHeight('200')
                    ->maxSize(2048) // 2MB
                    ->required(),


                Forms\Components\RichEditor::make('description')
                    ->required(),

                Select::make('category_id')
                    ->label('Category')
                    ->required()
                    ->options(ProductCategory::all()->pluck('name', 'id')->toArray())
                    ->searchable(),

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
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                ImageColumn::make('image')->label('Photo')->circular(),
                TextColumn::make('category.name')->label('Category')->sortable(),
                TextColumn::make('price')->money('idr', true),
                IconColumn::make('status')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('created_at')->label('Created')->dateTime('d M Y'),
            ])
            ->filters([
                //
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
        return [
            //
        ];
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
