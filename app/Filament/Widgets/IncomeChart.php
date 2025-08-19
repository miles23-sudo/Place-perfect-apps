<?php

namespace App\Filament\Widgets;

// use Filament\Widgets\ChartWidget;
use EightyNine\FilamentAdvancedWidget\AdvancedChartWidget;

class IncomeChart extends AdvancedChartWidget
{
    protected static ?string $heading = '19.9k';

    protected static ?string $label = 'Income';
    protected static string $color = 'primary';
    protected static ?string $icon = 'phosphor-receipt-duotone';
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
                    'label' => 'Income generated',
                    'data' => [0, 1000, 500, 200, 2100, 3200, 4500, 7400, 6500, 4500, 7700, 8900],
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
