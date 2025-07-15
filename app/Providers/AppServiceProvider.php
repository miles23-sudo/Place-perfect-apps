<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Colors\Color;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\CreateAction;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set the default pagination view for Filament
        FilamentColor::register([
            'primary' => Color::Zinc,
            'danger' => Color::Rose,
            'gray' => Color::Gray,
            'info' => Color::Blue,
            'success' => Color::Emerald,
            'warning' => Color::Orange,
            'pink' => Color::Pink,
            'blue' => Color::Blue,
            'red' => Color::Red,
            'orange' => Color::Orange,
            'purple' => Color::Purple,
            'indigo' => Color::Indigo,
            'teal' => Color::Teal,
            'cyan' => Color::Cyan,
            'lime' => Color::Lime,
            'amber' => Color::Amber,
            'green' => Color::Green,
            'yellow' => Color::Yellow,
        ]);

        // Register custom icons for Filament
        FilamentIcon::register([

            // Panel Builder
            'panels::user-menu.profile-item' => 'gmdi-person-o',
            // 'panels::topbar.open-database-notifications-button' => 'phosphor-bell-duotone',

            // 'notifications::database.modal.empty-state' => 'phosphor-bell-slash-duotone',
            // 'notifications::notification.close-button' => 'phosphor-x-circle-duotone',
            // 'notifications::notification.danger' => 'phosphor-warning-circle-duotone',
            // 'notifications::notification.info' => 'phosphor-info-circle-duotone',
            // 'notifications::notification.success' => 'phosphor-check-circle-duotone',
            // 'notifications::notification.warning' => 'phosphor-warning-circle-duotone',
        ]);

        CreateRecord::disableCreateAnother();
        CreateAction::configureUsing(fn(CreateAction $action) => $action->createAnother(false));
    }
}
