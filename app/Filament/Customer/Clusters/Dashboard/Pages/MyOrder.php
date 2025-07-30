<?php

namespace App\Filament\Customer\Clusters\Dashboard\Pages;

use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\Order;
use App\Filament\Customer\Clusters\Dashboard;

class MyOrder extends Page implements HasForms, HasTable
{
    use InteractsWithTable;

    use InteractsWithForms;

    protected static ?string $navigationIcon = 'ri-armchair-line';

    protected static string $view = 'filament.customer.clusters.dashboard.pages.my-order';

    protected static ?string $cluster = Dashboard::class;

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(Order::query()->where('customer_id', auth('customer')->id()))
            ->columns([
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->actions([
                // ...
            ])
            ->emptyStateIcon('ri-shopping-bag-line')
            ->emptyStateHeading('No Orders Found')
            ->emptyStateDescription('You have not placed any orders yet.')
            ->emptyStateActions([
                self::getGoShoppingAction()
            ]);
    }

    // Custom Method

    // goShopping
    public static function getGoShoppingAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('goShopping')
            ->label('Shop Now')
            ->icon('ri-shopping-cart-line')
            ->url(route('home'));
    }
}
