<?php

namespace App\Filament\Resources;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Forms;
use App\Settings\Payment;
use App\Models\Order;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\Pages;
use App\Enums\PaymentMode;
use App\Enums\OrderStatus;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'phosphor-shopping-bag-duotone';

    protected static ?string $navigationGroup = 'Customers';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Customer & Order Details')
                    ->schema([
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Order Date & Time')
                            ->required(),
                        Forms\Components\DateTimePicker::make('paid_at')
                            ->label('Paid Date & Time')
                            ->hidden(fn($state) => blank($state)),
                        Forms\Components\ToggleButtons::make('payment_method')
                            ->label('Payment Method')
                            ->hintIconTooltip('phosphor-hand-coins-duotone')
                            ->inline()
                            ->required()
                            ->options(array_column(PaymentMode::casesWithout(PaymentMode::OnlinePayment, PaymentMode::UNFILLED), 'name', 'value')),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Statuses')
                    ->schema([
                        Forms\Components\ToggleButtons::make('status')
                            ->inline()
                            ->required()
                            ->options(OrderStatus::class)
                            ->disableOptionWhen(fn($state) => $state === OrderStatus::ToPay),
                    ]),
            ]);
    }

    public static function infolist(Infolists\Infolist $infolist): Infolists\Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Order Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('order_number')
                            ->label('Order Number'),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Order Date & Time')
                            ->dateTime('F j, Y, g:i A'),
                        Infolists\Components\TextEntry::make('paid_at')
                            ->label('Paid Date & Time')
                            ->dateTime('F j, Y, g:i A'),
                        Infolists\Components\TextEntry::make('payment_method')
                            ->label('Payment Method')
                            ->formatStateUsing(fn($state) => ucwords(str_replace('_', ' ', $state))),
                        Infolists\Components\TextEntry::make('overall_total')
                            ->label('Total Amount')
                            ->money('PHP', true)
                            ->extraAttributes([
                                'class' => 'text-2xl font-bold text-green-600 dark:text-green-400',
                            ]),
                        Infolists\Components\TextEntry::make('status')
                            ->badge(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Order #')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime('F j, Y, g:i A')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('overall_total')
                    ->label('Total')
                    ->money('PHP', true),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->formatStateUsing(fn($state) => ucwords(str_replace('_', ' ', $state))),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(query: fn(Builder $query) => $query->orderBy('status', 'asc')),
                Tables\Columns\TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items'),
            ])
            ->actions([
                self::getViewAction(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }

    // Custom Actions

    // View Action
    public static function getViewAction(): Tables\Actions\ViewAction
    {
        return Tables\Actions\ViewAction::make()
            ->button();
    }
}
