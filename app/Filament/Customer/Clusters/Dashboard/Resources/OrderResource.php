<?php

namespace App\Filament\Customer\Clusters\Dashboard\Resources;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Pages\SubNavigationPosition;
use Filament\Forms\Form;
use Filament\Forms;
use App\Services\PaymongoCheckout;
use App\Models\Product;
use App\Models\Order;
use App\Filament\Customer\Clusters\Dashboard\Resources\OrderResource\RelationManagers;
use App\Filament\Customer\Clusters\Dashboard\Resources\OrderResource\Pages;
use App\Filament\Customer\Clusters\Dashboard;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationIcon = 'phosphor-shopping-cart-duotone';

    protected static ?int $navigationSort = 1;

    protected static ?string $cluster = Dashboard::class;

    public static function table(Table $table): Table
    {
        return $table
            ->query(fn() => Order::query()->whereCustomerId(auth('customer')->id()))
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
            'view' => Pages\ViewOrder::route('/{record}'),
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
}
