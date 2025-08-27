<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Enums\OrderStatus;
use EightyNine\FilamentAdvancedWidget\AdvancedChartWidget;

class OrderChart extends AdvancedChartWidget
{
    protected static ?string $heading = 'Orders';
    protected static string $color = 'primary';
    protected static ?string $icon = 'phosphor-truck-duotone';
    protected static ?string $iconColor = 'primary';
    protected static ?string $iconBackgroundColor = 'primary-50';

    public ?string $filter = 'perDay';

    /**
     * Available filter options for the chart.
     */
    protected function getFilters(): ?array
    {
        return [
            'perDay'   => 'Daily',
            'perWeek'  => 'Weekly',
            'perMonth' => 'Monthly',
            'perYear'  => 'Yearly',
        ];
    }

    /**
     * Fetch and prepare chart data.
     */
    protected function getData(): array
    {
        $data = Trend::query(Order::query()->delivered())
            ->between(
                start: now()->subDays(29),
                end: now()
            )
            ->{$this->filter}()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Orders Delivered',
                    'data'  => $data->map(fn(TrendValue $value): int => $value->aggregate)->toArray(),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value): string => $value->date)->toArray(),
        ];
    }

    /**
     * Chart type.
     */
    protected function getType(): string
    {
        return 'bar';
    }

    /**
     * Chart configuration options.
     */
    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'plugins'    => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
            'scales'     => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks'       => [
                        'stepSize' => 1,
                    ],
                ],
                'x' => [
                    'ticks' => [
                        'autoSkip' => true,
                        'maxRotation' => 45,
                        'minRotation' => 0,
                    ],
                ],
            ],
            'elements'   => [
                'point' => [
                    'radius'      => 4,
                    'hoverRadius' => 6,
                ],
            ],
        ];
    }
}
