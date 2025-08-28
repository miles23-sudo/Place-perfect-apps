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
        $current_count = Customer::count();
        
        $trend_data = Trend::model(Customer::class)
            ->between(
                start: now()->subDays(6),
                end: now(),
            )
            ->perDay()
            ->count();

        $previous_period_count = Customer::where('created_at', '<', now()->subDays(7))->count();

        $chart_values = $trend_data->map(fn(TrendValue $value) => $value->aggregate)->toArray();
        $percentage_change = $this->calculatePercentageChange($current_count, $previous_period_count);

        return Stat::make('No. of Customers', number_format($current_count))
            ->description($this->getChangeDescription($percentage_change, 'customers'))
            ->descriptionIcon($this->getChangeIcon($percentage_change))
            ->chart($chart_values)
            ->color($this->getChangeColor($percentage_change));
    }

    private function getOrderStat(): Stat
    {
        $current_count = Order::count();

        $trend_data = Trend::model(Order::class)
            ->between(
                start: now()->subDays(6),
                end: now(),
            )
            ->perDay()
            ->count();

        // Get previous period for comparison (7-14 days ago)
        $previous_period_count = Order::whereBetween('created_at', [
            now()->subDays(14),
            now()->subDays(7)
        ])->count();

        $chart_values = $trend_data->map(fn(TrendValue $value) => $value->aggregate)->toArray();
        $percentage_change = $this->calculatePercentageChange($current_count - $previous_period_count, $previous_period_count);

        return Stat::make('No. of Orders', number_format($current_count))
            ->description($this->getChangeDescription($percentage_change, 'orders'))
            ->descriptionIcon($this->getChangeIcon($percentage_change))
            ->chart($chart_values)
            ->color($this->getChangeColor($percentage_change));
    }

    private function getWeeklyRevenueStat(): Stat
    {
        $current_week_revenue = Order::IsConsiderAsIncome()
            ->whereBetween('created_at', [
                now()->startOfWeek(),
                now()
            ])->sum('overall_total');

        // Get daily trend data for current week
        $trend_data = Trend::model(Order::class)
            ->between(
                start: now()->startOfWeek(),
                end: now(),
            )
            ->perDay()
            ->sum('overall_total');

        // Get previous week revenue for comparison
        $previous_week_revenue = Order::IsConsiderAsIncome()
            ->whereBetween('created_at', [
                now()->subWeek()->startOfWeek(),
                now()->subWeek()->endOfWeek()
            ])
            ->sum('overall_total');

        $chart_values = $trend_data->map(fn(TrendValue $value) => $value->aggregate)->toArray();
        $percentage_change = $this->calculatePercentageChange($current_week_revenue, $previous_week_revenue);

        return Stat::make('Weekly Revenue', '₱' . number_format($current_week_revenue, 2))
            ->description($this->getChangeDescription($percentage_change, 'from last week'))
            ->descriptionIcon($this->getChangeIcon($percentage_change))
            ->chart($chart_values)
            ->color($this->getChangeColor($percentage_change));
    }

    private function getMonthlyRevenueStat(): Stat
    {
        $current_month_revenue = Order::IsConsiderAsIncome()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('overall_total');

        $trend_data = Trend::model(Order::class)
            ->between(
                start: now()->startOfMonth(),
                end: now(),
            )
            ->perDay()
            ->sum('overall_total');

        $previous_month_revenue = Order::IsConsiderAsIncome()
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('overall_total');

        $chart_values = $trend_data->map(fn(TrendValue $value) => $value->aggregate)->toArray();
        $percentage_change = $this->calculatePercentageChange($current_month_revenue, $previous_month_revenue);

        return Stat::make('Monthly Revenue', '₱' . number_format($current_month_revenue, 2))
            ->description($this->getChangeDescription($percentage_change, 'from last month'))
            ->descriptionIcon($this->getChangeIcon($percentage_change))
            ->chart($chart_values)
            ->color($this->getChangeColor($percentage_change));
    }

    private function calculatePercentageChange($current, $previous): float
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        return (($current - $previous) / $previous) * 100;
    }

    private function getChangeDescription(float $percentage_change, string $context): string
    {
        $absChange = abs($percentage_change);
        $direction = $percentage_change >= 0 ? 'increase' : 'decrease';

        if ($absChange < 1) {
            return "No significant change {$context}";
        }

        return number_format($absChange, 1) . "% {$direction} {$context}";
    }

    private function getChangeIcon(float $percentage_change): string
    {
        if ($percentage_change > 5) {
            return 'phosphor-trend-up-duotone';
        } elseif ($percentage_change < -5) {
            return 'phosphor-trend-down-duotone';
        } else {
            return 'phosphor-equals-duotone';
        }
    }

    private function getChangeColor(float $percentage_change): string
    {
        if ($percentage_change > 10) {
            return 'success';
        } elseif ($percentage_change > 0) {
            return 'info';
        } elseif ($percentage_change > -10) {
            return 'warning';
        } else {
            return 'danger';
        }
    }
}
