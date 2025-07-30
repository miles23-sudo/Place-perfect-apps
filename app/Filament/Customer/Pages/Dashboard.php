<?php

namespace App\Filament\Customer\Pages;


use Filament\Pages\Dashboard as BasePage;
use App\Filament\Customer\Widgets\ProfileForm;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'ri-dashboard-line';

    protected static ?string $navigationLabel = "My Dashboard";

    protected ?string $heading = 'My Dashboard';

    public function getWidgets(): array
    {
        return [
            ProfileForm::class
        ];
    }
}
