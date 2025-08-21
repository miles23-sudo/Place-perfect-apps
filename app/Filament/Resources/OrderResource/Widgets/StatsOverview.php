<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use Flowframe\Trend\TrendValue;
use Flowframe\Trend\Trend;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
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
            Stat::make('No. of Orders', $this->getOrderQuery()->count())
                ->description($this->getOrdersDescription())
                ->descriptionIcon($this->getOrdersIcon())
                ->chart($this->getOrdersChart())
                ->color($this->getOrdersColor()),

            Stat::make('Total Monthly Revenue', $this->getTotalRevenue())
                ->description($this->getRevenueDescription())
                ->descriptionIcon($this->getRevenueIcon())
                ->chart($this->getRevenueChart())
                ->color($this->getRevenueColor()),

            Stat::make('Orders Requiring Action', $this->getOrdersRequiringAction())
                ->description($this->getActionOrdersDescription())
                ->descriptionIcon($this->getActionOrdersIcon())
                ->chart($this->getActionOrdersChart())
                ->color($this->getActionOrdersColor()),
        ];
    }

    // Orders
    private function getOrderQuery()
    {
        return Order::whereIn('status', [
            OrderStatus::ToShip->value,
            OrderStatus::ToReceive->value,
            OrderStatus::Delivered->value,
        ]);
    }

    private function getWeeklyOrderSumAggregate(): array
    {
        $current = Trend::query($this->getOrderQuery())
            ->between(now()->startOfWeek(), now())
            ->perDay()
            ->count()
            ->sum('aggregate');

        $last = Trend::query($this->getOrderQuery())
            ->between(now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek())
            ->perDay()
            ->count()
            ->sum('aggregate');

        return ['current' => $current, 'last' => $last];
    }

    private function getOrdersDescription(): string
    {
        ['current' => $current, 'last' => $last] = $this->getWeeklyOrderSumAggregate();
        $diff = $current - $last;
        return ($diff >= 0 ? '+' : '') . "{$diff} orders this week";
    }

    private function getOrdersIcon(): string
    {
        ['current' => $current, 'last' => $last] = $this->getWeeklyOrderSumAggregate();
        return $current >= $last ? 'phosphor-trend-up-duotone' : 'phosphor-trend-down-duotone';
    }

    private function getOrdersChart(): array
    {
        return Trend::query($this->getOrderQuery())
            ->between(now()->subDays(6), now())
            ->perDay()
            ->count()
            ->map(fn(TrendValue $value) => $value->aggregate)
            ->toArray();
    }

    private function getOrdersColor(): string
    {
        ['current' => $current, 'last' => $last] = $this->getWeeklyOrderSumAggregate();
        return $current >= $last ? 'success' : 'danger';
    }

    // Revenue
    private function getTotalRevenue(): string
    {
        $revenue = $this->getOrderQuery()->sum('overall_total');
        return number_format($revenue, 2);
    }

    private function getMonthlyRevenueSumAggregate(): array
    {
        $current = Trend::query($this->getOrderQuery())
            ->between(now()->startOfMonth(), now())
            ->perDay()
            ->sum('overall_total')
            ->sum('aggregate');

        $last = Trend::query($this->getOrderQuery())
            ->between(now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth())
            ->perDay()
            ->sum('overall_total')
            ->sum('aggregate');

        return ['current' => $current, 'last' => $last];
    }

    private function getRevenueDescription(): string
    {
        ['current' => $current, 'last' => $last] = $this->getMonthlyRevenueSumAggregate();

        if ($last == 0) return 'No previous data';

        $percentage = round((($current - $last) / $last) * 100, 1);
        return ($percentage >= 0 ? '+' : '') . "{$percentage}% from last month";
    }

    private function getRevenueIcon(): string
    {
        ['current' => $current, 'last' => $last] = $this->getMonthlyRevenueSumAggregate();

        return $current >= $last ? 'phosphor-trend-up-duotone' : 'phosphor-trend-down-duotone';
    }

    private function getRevenueChart(): array
    {
        return Trend::query($this->getOrderQuery())
            ->between(now()->subDays(29), now())
            ->perDay()
            ->sum('overall_total')
            ->map(fn(TrendValue $value) => $value->aggregate)
            ->toArray();
    }

    private function getRevenueColor(): string
    {
        ['current' => $current, 'last' => $last] = $this->getMonthlyRevenueSumAggregate();
        return $current >= $last ? 'success' : 'danger';
    }

    // Orders Requiring Action
    private function getOrdersRequiringAction(): int
    {
        return Order::toPay()->count();
    }

    private function getActionOrdersDescription(): string
    {
        $pending = $this->getOrdersRequiringAction();
        return "+{$pending} orders pending payment";
    }

    private function getActionOrdersIcon(): string
    {
        return 'phosphor-trend-up-duotone';
    }

    private function getActionOrdersChart(): array
    {
        return Trend::query(Order::query()->toPay())
            ->between(now()->subDays(6), now())
            ->perDay()
            ->count()
            ->map(fn(TrendValue $value) => $value->aggregate)
            ->toArray();
    }

    private function getActionOrdersColor(): string
    {
        return 'warning';
    }
}
