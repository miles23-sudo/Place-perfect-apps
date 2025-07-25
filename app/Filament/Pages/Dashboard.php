<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\OrderChart;
use App\Filament\Widgets\IncomeChart;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'ri-dashboard-line';

    protected static ?string $navigationGroup = 'Overview';

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            OrderChart::class,
            IncomeChart::class
        ];
    }
}
