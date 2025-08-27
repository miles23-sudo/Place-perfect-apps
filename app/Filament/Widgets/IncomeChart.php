<?php

namespace App\Filament\Widgets;

// use Filament\Widgets\ChartWidget;
use Flowframe\Trend\TrendValue;
use Flowframe\Trend\Trend;
use EightyNine\FilamentAdvancedWidget\AdvancedChartWidget;
use App\Models\Order;

class IncomeChart extends AdvancedChartWidget
{
    protected static ?string $heading = 'Income';
    protected static string $color = 'primary';
    protected static ?string $icon = 'phosphor-receipt-duotone';
    protected static ?string $iconColor = 'primary';
    protected static ?string $iconBackgroundColor = 'primary-50';

    public ?string $filter = 'perDay';

    protected function getFilters(): ?array
    {
        return [
            'perDay' => 'Daily',
            'perWeek' => 'Weekly',
            'perMonth' => 'Monthly',
            'perYear' => 'Yearly',
        ];
    }

    protected function getData(): array
    {
        $data = Trend::query(Order::query()->delivered())
            ->between(now()->subDays(29), now())
            ->{$this->filter}()
            ->sum('overall_total');

        return [
            'datasets' => [
                [
                    'label' => 'Income generated',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
            'responsive' => true,
            'elements' => [
                'point' => [
                    'radius' => 4,
                    'hoverRadius' => 6,
                ],
            ],
        ];
    }
}
