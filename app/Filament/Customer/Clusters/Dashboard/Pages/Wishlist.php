<?php

namespace App\Filament\Customer\Clusters\Dashboard\Pages;

use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\Order;
use App\Filament\Customer\Clusters\Dashboard\Pages\MyOrder;
use App\Filament\Customer\Clusters\Dashboard;

class Wishlist extends Page implements HasForms, HasTable
{
    use InteractsWithTable;

    use InteractsWithForms;
    protected static ?string $navigationIcon = 'ri-heart-line';

    protected static string $view = 'filament.customer.clusters.dashboard.pages.wishlist';

    protected static ?string $cluster = Dashboard::class;

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(Order::query()->where('customer_id', 123))
            ->columns([
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->actions([])
            ->emptyStateIcon('ri-shopping-bag-line')
            ->emptyStateHeading('No Wishlist Items Found')
            ->emptyStateDescription('You have not added any items to your wishlist yet.')
            ->emptyStateActions([
                MyOrder::getGoShoppingAction()
            ]);
    }
}
