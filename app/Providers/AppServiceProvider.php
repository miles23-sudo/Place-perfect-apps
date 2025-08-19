<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\View\PanelsRenderHook;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Support\Facades\FilamentView;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Enums\Alignment;
use Filament\Support\Colors\Color;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Page;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
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
        $this->getFilamentRegisterColor();

        $this->getFilamentRegisterIcon();

        $this->getFilamentDefaultFormAlignment();

        $this->getFilamentDefaultActions();
    }

    public function getFilamentRegisterColor()
    {
        return FilamentColor::register([
            'primary' => '#BB976D',
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
    }

    public function getFilamentRegisterIcon()
    {
        FilamentIcon::register([
            // ==== Sidebar Icons ====
            'panels::sidebar.collapse-button' => 'phosphor-sidebar-duotone',
            'panels::sidebar.collapse-button.rtl' => 'phosphor-sidebar-duotone',
            'panels::sidebar.expand-button' => 'phosphor-sidebar-simple-duotone',
            'panels::sidebar.expand-button.rtl' => 'phosphor-sidebar-duotone',
            'panels::user-menu.profile-item' => 'phosphor-user-circle-dashed-duotone',
            'panels::topbar.open-database-notifications-button' => 'phosphor-bell-duotone',

            // ==== Notifications Icons ====
            'notifications::database.modal.empty-state' => 'phosphor-bell-slash-duotone',
            'notifications::notification.close-button' => 'phosphor-x-circle-duotone',
            'notifications::notification.danger' => 'phosphor-warning-circle-duotone',
            'notifications::notification.info' => 'phosphor-info-circle-duotone',
            'notifications::notification.success' => 'phosphor-check-circle-duotone',
            'notifications::notification.warning' => 'phosphor-warning-circle-duotone',

            // ==== Action Icons ====
            'actions::action-group' => 'phosphor-dots-three-outline-duotone',
            'actions::edit-action' => 'phosphor-pencil-duotone',
            'actions::view-action' => 'phosphor-eye-duotone',
        ]);
    }

    public function getFilamentDefaultFormAlignment()
    {
        return Page::formActionsAlignment(Alignment::Right);
    }

    public function getFilamentDefaultActions()
    {
        CreateRecord::disableCreateAnother();
        CreateAction::configureUsing(fn(CreateAction $action) => $action
            ->icon('phosphor-plus-duotone')
            ->createAnother(false)
            ->closeModalByClickingAway(false));

        EditAction::make()
            ->closeModalByClickingAway(false);

        ViewAction::make()
            ->closeModalByClickingAway(false);
    }
}
