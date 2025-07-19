<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class OrderResource extends Resource
{
    protected static ?string $model             = Order::class;
    protected static ?string $navigationIcon    = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel   = 'Order List';
    protected static ?string $navigationGroup   = 'Orders';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('order_number')
                ->disabled()
                ->label('Order Number'),

            Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'delivered' => 'Delivered',
                ])
                ->label('Order Status')
                ->required(),

            TextInput::make('total_price')
                ->disabled()
                ->label('Total Price'),

            Forms\Components\Textarea::make('note')
                ->label('Note'),
        ]);
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()?->role === 'master') {
            return parent::getEloquentQuery();
        }

        $outletIds = auth()->user()?->outlets->pluck('id');

        if ($outletIds === null || $outletIds->isEmpty()) {
            return parent::getEloquentQuery()->whereRaw('1 = 0');
        }

        return parent::getEloquentQuery()
            ->whereHas('items.product.outlet', function (Builder $query) use ($outletIds) {
                $query->whereIn('id', $outletIds);
            });
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('address.user.name')->label('Pelanggan'),
                TextColumn::make('order_number')->searchable(),
                TextColumn::make('status')->badge(),
                TextColumn::make('total_price')->money('IDR'),
                TextColumn::make('address.village.district.regency.province.name')->label('Provinsi')->sortable()->searchable(),
                TextColumn::make('address.village.district.regency.name')->label('Kabupaten/Kota')->sortable()->searchable(),
                TextColumn::make('address.village.district.name')->label('Kecamatan')->sortable()->searchable(),
                TextColumn::make('address.village.name')->label('Desa')->sortable()->searchable(),
                TextColumn::make('address.description')->label('Deskripsi')->wrap(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'delivered' => 'Delivered',
                    ])
                    ->label('Order Status'),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make()
                //     ->modalHeading('Detail Pesanan')
                //     ->modalContent(fn($record) => view('filament.orders.view-items', [
                //         'order' => $record,
                //         'items' => $record->items()->with('product')->get(),
                //     ])),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
        ];
    }
}
