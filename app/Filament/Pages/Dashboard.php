<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;
use Awcodes\Overlook\Widgets\OverlookWidget;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'ri-dashboard-line';

    protected static ?string $navigationGroup = 'Overview';

    public function getWidgets(): array
    {
        return [];
    }
}
