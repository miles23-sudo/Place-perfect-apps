<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use NumberFormatter;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\Product;
use App\Models\Order;
use App\Enums\OrderStatus;

class StatsOverview extends BaseWidget
{
    protected function getHeading(): ?string
    {
        return 'Analytics';
    }

    protected function getDescription(): ?string
    {
        return 'An overview of some analytics.';
    }

    protected function getStats(): array
    {
        return [
            Stat::make('No. of Orders', $this->getTotalOrders())
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Total Revenue', $this->getTotalRevenue())
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            Stat::make('Orders Requiring Action', $this->getOrdersRequiringAction())
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }


    public function getTotalOrders(): int
    {
        return Order::whereIn('status', [
            OrderStatus::ToPay->value,
            OrderStatus::ToShip->value,
            OrderStatus::ToReceive->value,
            OrderStatus::Completed->value,
        ])->count();
    }

    public function getTotalRevenue($order = new Order()): string
    {
        return $order->getTotalRevenueWithCurrencySymbolAttribute();
    }

    public function getOrdersRequiringAction(): string
    {
        return Order::whereIn('status', [
            OrderStatus::ToPay->value,
            OrderStatus::ToShip->value,
            OrderStatus::ReturnRefund->value,
        ])->count();
    }
}
