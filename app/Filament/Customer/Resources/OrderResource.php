<?php

namespace App\Filament\Customer\Resources;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms;
use App\Services\PaymongoCheckout;
use App\Models\Product;
use App\Models\Order;
use App\Filament\Customer\Resources\OrderResource\RelationManagers;
use App\Filament\Customer\Resources\OrderResource\Pages;
use App\Enums\OrderStatus;
use Filament\Infolists\Infolist;
use Filament\Infolists;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'phosphor-truck-duotone';


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('customer_id', '=', auth('customer')->id());
    }

    public static function infolist(Infolist $infolist): Infolist
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
                            ->badge(),
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
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime('F j, Y, g:i A')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_number'),
                Tables\Columns\TextColumn::make('overall_total')
                    ->money('PHP', true),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Payment')
                    ->badge()
                    ->formatStateUsing(fn($state) => ucwords(str_replace('_', ' ', $state))),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
            ])
            ->actions([
                self::getViewAction(),
                self::getPayNowAction(),
                self::getCompletedAction(),
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
        ];
    }

    // Custom Actions

    public static function getViewAction(): Tables\Actions\ViewAction
    {
        return Tables\Actions\ViewAction::make()
            ->button();
    }

    // Pay Now Action
    public static function getPayNowAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('payNow')
            ->icon(OrderStatus::ToPay->getIcon())
            ->button()
            ->color(fn($record) => $record->status->getColor())
            ->action(function ($record) {

                $checkout = PaymongoCheckout::create($record, $record->items->map(function ($item) {
                    return [
                        'name' => $item->product->name,
                        'currency' => Product::CURRENCY,
                        'amount' => intval($item->price * 100),
                        'quantity' => $item->quantity,
                    ];
                })->toArray());

                $record->update(['checkout_session_id' => $checkout->id]);

                return redirect()->away($checkout->checkout_url);
            })
            ->visible(fn($record) => $record->isToRetryPayment());
    }

    // Delivered
    public static function getCompletedAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('markAsCompleted')
            ->label('Mark as Delivered')
            ->action(function ($record) {
                $record->update(['status' => OrderStatus::Delivered]);
            })
            ->visible(fn($record) => $record->isToReceive());
    }
}
