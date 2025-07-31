<?php

namespace App\Filament\Customer\Clusters\Dashboard\Pages;

use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Infolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\Order;
use App\Filament\Customer\Clusters\Dashboard;
use Filament\Support\Enums\MaxWidth;

class MyOrder extends Page implements HasForms, HasTable, HasInfolists
{
    use InteractsWithTable, InteractsWithForms, InteractsWithInfolists;

    protected static ?string $navigationIcon = 'ri-armchair-line';

    protected static string $view = 'filament.customer.clusters.dashboard.pages.my-order';

    protected static ?string $cluster = Dashboard::class;

    public function infolist(Infolists\Infolist $infolist): Infolists\Infolist
    {
        return $infolist
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
            ->columns(2);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(Order::query()->where('customer_id', auth('customer')->id()))
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime('F j, Y, g:i A')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_number'),
                Tables\Columns\TextColumn::make('overall_total')
                    ->money('PHP', true),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                $this->getViewAction()
            ])
            ->emptyStateIcon('ri-shopping-bag-line')
            ->emptyStateHeading('No Orders Found')
            ->emptyStateDescription('You have not placed any orders yet.')
            ->emptyStateActions([
                self::getGoShoppingAction()
            ]);
    }

    // Custom Method

    // View Order Details

    public function getViewAction(): Tables\Actions\ViewAction
    {
        return Tables\Actions\ViewAction::make()
            ->modalHeading('Order Confirmation')
            ->modalSubheading('Thank you for your purchase!')
            ->infolist(fn(Infolists\Infolist $infolist) => $this->infolist($infolist))
            ->modalWidth(MaxWidth::TwoExtraLarge)
            ->closeModalByClickingAway(false);
    }

    // goShopping
    public static function getGoShoppingAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('goShopping')
            ->label('Shop Now')
            ->icon('ri-shopping-cart-line')
            ->url(route('home'));
    }
}
