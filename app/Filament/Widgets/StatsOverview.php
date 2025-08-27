<?php

namespace App\Filament\Widgets;

use Flowframe\Trend\TrendValue;
use Flowframe\Trend\Trend;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\Order;
use App\Models\Customer;
use App\Enums\OrderStatus;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            $this->getCustomerStat(),
            $this->getOrderStat(),
            $this->getMonthlyRevenueStat(),
            $this->getWeeklyRevenueStat(),
        ];
    }

    private function getCustomerStat(): Stat
    {
        $currentCount = Customer::count();

        // Get trend data for last 7 days
        $trendData = Trend::model(Customer::class)
            ->between(
                start: now()->subDays(6),
                end: now(),
            )
            ->perDay()
            ->count();

        // Get previous period for comparison
        $previousPeriodCount = Customer::where('created_at', '<', now()->subDays(7))->count();

        $chartValues = $trendData->map(fn(TrendValue $value) => $value->aggregate)->toArray();
        $percentageChange = $this->calculatePercentageChange($currentCount, $previousPeriodCount);

        return Stat::make('No. of Customers', number_format($currentCount))
            ->description($this->getChangeDescription($percentageChange, 'customers'))
            ->descriptionIcon($this->getChangeIcon($percentageChange))
            ->chart($chartValues)
            ->color($this->getChangeColor($percentageChange));
    }

    private function getOrderStat(): Stat
    {
        $currentCount = Order::count();

        // Get trend data for last 7 days
        $trendData = Trend::model(Order::class)
            ->between(
                start: now()->subDays(6),
                end: now(),
            )
            ->perDay()
            ->count();

        // Get previous period for comparison (7-14 days ago)
        $previousPeriodCount = Order::whereBetween('created_at', [
            now()->subDays(14),
            now()->subDays(7)
        ])->count();

        $chartValues = $trendData->map(fn(TrendValue $value) => $value->aggregate)->toArray();
        $percentageChange = $this->calculatePercentageChange($currentCount - $previousPeriodCount, $previousPeriodCount);

        return Stat::make('No. of Orders', number_format($currentCount))
            ->description($this->getChangeDescription($percentageChange, 'orders'))
            ->descriptionIcon($this->getChangeIcon($percentageChange))
            ->chart($chartValues)
            ->color($this->getChangeColor($percentageChange));
    }

    private function getWeeklyRevenueStat(): Stat
    {
        $currentWeekRevenue = Order::delivered()
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()
            ])->sum('overall_total');

        // Get daily trend data for current week
        $trendData = Trend::model(Order::class)
            ->between(
                start: now()->startOfWeek(),
                end: now(),
            )
            ->perDay()
            ->sum('overall_total');

        // Get previous week revenue for comparison
        $previousWeekRevenue = Order::delivered()
            ->whereBetween('created_at', [
                now()->subWeek()->startOfWeek(),
                now()->subWeek()->endOfWeek()
            ])
            ->sum('overall_total');

        $chartValues = $trendData->map(fn(TrendValue $value) => $value->aggregate)->toArray();
        $percentageChange = $this->calculatePercentageChange($currentWeekRevenue, $previousWeekRevenue);

        return Stat::make('Weekly Revenue', '₱' . number_format($currentWeekRevenue, 2))
            ->description($this->getChangeDescription($percentageChange, 'from last week'))
            ->descriptionIcon($this->getChangeIcon($percentageChange))
            ->chart($chartValues)
            ->color($this->getChangeColor($percentageChange));
    }

    private function getMonthlyRevenueStat(): Stat
    {
        $currentMonthRevenue = Order::delivered()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('overall_total');

        // Get daily trend data for current month
        $trendData = Trend::model(Order::class)
            ->between(
                start: now()->startOfMonth(),
                end: now(),
            )
            ->perDay()
            ->sum('overall_total');

        // Get previous month revenue for comparison
        $previousMonthRevenue = Order::delivered()
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('overall_total');

        $chartValues = $trendData->map(fn(TrendValue $value) => $value->aggregate)->toArray();
        $percentageChange = $this->calculatePercentageChange($currentMonthRevenue, $previousMonthRevenue);

        return Stat::make('Monthly Revenue', '₱' . number_format($currentMonthRevenue, 2))
            ->description($this->getChangeDescription($percentageChange, 'from last month'))
            ->descriptionIcon($this->getChangeIcon($percentageChange))
            ->chart($chartValues)
            ->color($this->getChangeColor($percentageChange));
    }

    private function calculatePercentageChange($current, $previous): float
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        return (($current - $previous) / $previous) * 100;
    }

    private function getChangeDescription(float $percentageChange, string $context): string
    {
        $absChange = abs($percentageChange);
        $direction = $percentageChange >= 0 ? 'increase' : 'decrease';

        if ($absChange < 1) {
            return "No significant change {$context}";
        }

        return number_format($absChange, 1) . "% {$direction} {$context}";
    }

    private function getChangeIcon(float $percentageChange): string
    {
        if ($percentageChange > 5) {
            return 'heroicon-m-arrow-trending-up';
        } elseif ($percentageChange < -5) {
            return 'heroicon-m-arrow-trending-down';
        } else {
            return 'heroicon-m-minus';
        }
    }

    private function getChangeColor(float $percentageChange): string
    {
        if ($percentageChange > 10) {
            return 'success';
        } elseif ($percentageChange > 0) {
            return 'info';
        } elseif ($percentageChange > -10) {
            return 'warning';
        } else {
            return 'danger';
        }
    }
}
