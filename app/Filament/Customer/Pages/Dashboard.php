<?php

namespace App\Filament\Customer\Pages;


use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'ri-dashboard-line';

    protected static ?string $navigationGroup = 'Welcome';

    public function getWidgets(): array
    {
        return [];
    }
}
