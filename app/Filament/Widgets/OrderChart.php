<?php

namespace App\Filament\Widgets;

// use Filament\Widgets\ChartWidget;
use EightyNine\FilamentAdvancedWidget\AdvancedChartWidget;

class OrderChart extends AdvancedChartWidget
{
    protected static ?string $heading = '1992';
    protected static ?string $label = 'Orders';
    protected static string $color = 'primary';
    protected static ?string $icon = 'ri-truck-line';
    protected static ?string $iconColor = 'primary';
    protected static ?string $iconBackgroundColor = 'primary-50';


    public ?string $filter = 'today';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Orders placed',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
