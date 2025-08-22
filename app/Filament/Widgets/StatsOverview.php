<?php

namespace App\Filament\Widgets;

use App\Filament\Customer\Resources\OrderResource;
use App\Filament\Resources\CustomerResource;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\UserResource;
// use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget as BaseWidget;
// use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->icon(UserResource::getNavigationIcon()),
            Stat::make('Total Customer', Customer::count())
                ->icon(CustomerResource::getNavigationIcon()),
            Stat::make('Available Products', Product::isActive()->count())
                ->icon(ProductResource::getNavigationIcon()),
            Stat::make('Placed Orders', Order::count())
                ->icon(OrderResource::getNavigationIcon()),
        ];
    }
}
