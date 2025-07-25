<?php

namespace App\Filament\Widgets;

use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget as BaseWidget;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Stat;
// use Filament\Widgets\StatsOverviewWidget\Stat;
// use Filament\Widgets\StatsOverviewWidget as BaseWidget;
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
                ->icon('ri-group-line')
                ->iconColor('primary')
                ->iconBackgroundColor('primary-50'),
            Stat::make('Total Users', Customer::count())
                ->icon('ri-shopping-bag-line')
                ->iconColor('primary')
                ->iconBackgroundColor('primary-50'),
            Stat::make('Available Products', Product::isActive()->count())
                ->icon('ri-sofa-line')
                ->iconColor('primary')
                ->iconBackgroundColor('primary-50'),
            Stat::make('Placed Orders', Order::count())
                ->icon('ri-truck-line')
                ->iconColor('primary')
                ->iconBackgroundColor('primary-50'),
        ];
    }
}
