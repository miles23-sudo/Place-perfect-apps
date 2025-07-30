<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Enums\Alignment;
use Filament\Support\Colors\Color;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Page;
use Filament\Actions\CreateAction;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;

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

        $this->getFilamentDisableCreateAnother();
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
            // ==== Full Panel Builder Icons ====
            'panels::global-search.field' => 'ri-search-line',
            'panels::pages.dashboard.actions.filter' => 'ri-filter-2-line',
            'panels::pages.dashboard.navigation-item' => 'ri-dashboard-line',
            'panels::pages.password-reset.request-password-reset.actions.login' => 'ri-login-circle-line',
            'panels::pages.password-reset.request-password-reset.actions.login.rtl' => 'ri-login-circle-line',
            'panels::resources.pages.edit-record.navigation-item' => 'ri-edit-line',
            'panels::resources.pages.manage-related-records.navigation-item' => 'ri-links-line',
            'panels::resources.pages.view-record.navigation-item' => 'ri-eye-line',


            'panels::sidebar.collapse-button' => 'ri-sidebar-fold-line',
            'panels::sidebar.collapse-button.rtl' => 'ri-sidebar-unfold-line',
            'panels::sidebar.expand-button' => 'ri-sidebar-unfold-line',
            'panels::sidebar.expand-button.rtl' => 'ri-sidebar-fold-line',


            'panels::sidebar.group.collapse-button' => 'ri-arrow-down-s-line',
            'panels::tenant-menu.billing-button' => 'ri-currency-line',
            'panels::tenant-menu.profile-button' => 'ri-user-settings-line',
            'panels::tenant-menu.registration-button' => 'ri-user-add-line',
            'panels::tenant-menu.toggle-button' => 'ri-menu-line',
            'panels::theme-switcher.light-button' => 'ri-sun-line',
            'panels::theme-switcher.dark-button' => 'ri-moon-line',
            'panels::theme-switcher.system-button' => 'ri-computer-line',
            'panels::topbar.open-database-notifications-button' => 'ri-notification-2-line',
            'panels::user-menu.logout-button' => 'ri-logout-box-r-line',
            'panels::widgets.account.logout-button' => 'ri-logout-box-r-line',
            'panels::widgets.filament-info.open-documentation-button' => 'ri-book-open-line',
            'panels::widgets.filament-info.open-github-button' => 'ri-github-line',

            // ==== Form Builder Icons ====
            'forms::components.builder.actions.clone' => 'ri-file-copy-line',
            'forms::components.builder.actions.collapse' => 'ri-arrow-down-s-line',
            'forms::components.builder.actions.delete' => 'ri-delete-bin-line',
            'forms::components.builder.actions.expand' => 'ri-arrow-up-s-line',
            'forms::components.builder.actions.move-down' => 'ri-arrow-down-line',
            'forms::components.builder.actions.move-up' => 'ri-arrow-up-line',
            'forms::components.builder.actions.reorder' => 'ri-drag-move-line',
            'forms::components.checkbox-list.search-field' => 'ri-search-line',
            'forms::components.file-upload.editor.actions.drag-crop' => 'ri-crop-line',
            'forms::components.file-upload.editor.actions.drag-move' => 'ri-drag-move-2-line',
            'forms::components.file-upload.editor.actions.flip-horizontal' => 'ri-focus-2-line',
            'forms::components.file-upload.editor.actions.flip-vertical' => 'ri-focus-3-line',
            'forms::components.file-upload.editor.actions.move-down' => 'ri-arrow-down-line',
            'forms::components.file-upload.editor.actions.move-left' => 'ri-arrow-left-line',
            'forms::components.file-upload.editor.actions.move-right' => 'ri-arrow-right-line',
            'forms::components.file-upload.editor.actions.move-up' => 'ri-arrow-up-line',
            'forms::components.file-upload.editor.actions.rotate-left' => 'ri-anticlockwise-line',
            'forms::components.file-upload.editor.actions.rotate-right' => 'ri-clockwise-line',
            'forms::components.file-upload.editor.actions.zoom-100' => 'ri-zoom-in-line',
            'forms::components.file-upload.editor.actions.zoom-in' => 'ri-zoom-in-line',
            'forms::components.file-upload.editor.actions.zoom-out' => 'ri-zoom-out-line',
            'forms::components.key-value.actions.delete' => 'ri-delete-bin-line',
            'forms::components.key-value.actions.reorder' => 'ri-drag-move-line',
            'forms::components.repeater.actions.clone' => 'ri-file-copy-line',
            'forms::components.repeater.actions.collapse' => 'ri-arrow-down-s-line',
            'forms::components.repeater.actions.delete' => 'ri-delete-bin-line',
            'forms::components.repeater.actions.expand' => 'ri-arrow-up-s-line',
            'forms::components.repeater.actions.move-down' => 'ri-arrow-down-line',
            'forms::components.repeater.actions.move-up' => 'ri-arrow-up-line',
            'forms::components.repeater.actions.reorder' => 'ri-drag-move-line',
            'forms::components.select.actions.create-option' => 'ri-add-line',
            'forms::components.select.actions.edit-option' => 'ri-pencil-line',
            'forms::components.text-input.actions.hide-password' => 'ri-eye-off-line',
            'forms::components.text-input.actions.show-password' => 'ri-eye-line',
            'forms::components.toggle-buttons.boolean.false' => 'ri-close-circle-line',
            'forms::components.toggle-buttons.boolean.true' => 'ri-checkbox-circle-line',
            'forms::components.wizard.completed-step' => 'ri-check-double-line',

            // ==== Table Builder Icons ====
            'tables::actions.disable-reordering' => 'ri-lock-line',
            'tables::actions.enable-reordering' => 'ri-drag-move-line',
            'tables::actions.filter' => 'ri-filter-2-line',
            'tables::actions.group' => 'ri-group-line',
            'tables::actions.open-bulk-actions' => 'ri-more-line',
            'tables::actions.toggle-columns' => 'ri-layout-column-line',
            'tables::columns.collapse-button' => 'ri-arrow-down-s-line',
            'tables::columns.icon-column.false' => 'ri-close-circle-line',
            'tables::columns.icon-column.true' => 'ri-checkbox-circle-line',
            'tables::empty-state' => 'ri-inbox-unarchive-line',
            'tables::filters.query-builder.constraints.boolean' => 'ri-toggle-line',
            'tables::filters.query-builder.constraints.date' => 'ri-calendar-line',
            'tables::filters.query-builder.constraints.number' => 'ri-numbers-line',
            'tables::filters.query-builder.constraints.relationship' => 'ri-links-line',
            'tables::filters.query-builder.constraints.select' => 'ri-list-check-2',
            'tables::filters.query-builder.constraints.text' => 'ri-text-line',
            'tables::filters.remove-all-button' => 'ri-delete-bin-2-line',
            'tables::grouping.collapse-button' => 'ri-arrow-down-s-line',
            'tables::header-cell.sort-asc-button' => 'ri-sort-asc',
            'tables::header-cell.sort-button' => 'ri-expand-up-down-line',
            'tables::header-cell.sort-desc-button' => 'ri-sort-desc',
            'tables::reorder.handle' => 'ri-drag-move-line',
            'tables::search-field' => 'ri-search-line',

            // ==== Notifications Icons ====
            'notifications::database.modal.empty-state' => 'ri-notification-off-line',
            'notifications::notification.close-button' => 'ri-close-line',
            'notifications::notification.danger' => 'ri-error-warning-line',
            'notifications::notification.info' => 'ri-information-line',
            'notifications::notification.success' => 'ri-checkbox-circle-line',
            'notifications::notification.warning' => 'ri-alert-line',

            // ==== Action Icons ====
            'actions::action-group' => 'ri-more-line',
            'actions::create-action.grouped' => 'ri-add-line',
            'actions::delete-action' => 'ri-delete-bin-line',
            'actions::delete-action.grouped' => 'ri-delete-bin-line',
            'actions::delete-action.modal' => 'ri-error-warning-line',
            'actions::detach-action' => 'ri-link-unlink-m',
            'actions::detach-action.modal' => 'ri-close-circle-line',
            'actions::dissociate-action' => 'ri-link-unlink-line',
            'actions::dissociate-action.modal' => 'ri-close-circle-line',
            'actions::edit-action' => 'ri-pencil-line',
            'actions::edit-action.grouped' => 'ri-edit-box-line',
            'actions::export-action.grouped' => 'ri-download-line',
            'actions::force-delete-action' => 'ri-delete-bin-2-line',
            'actions::force-delete-action.grouped' => 'ri-delete-bin-2-line',
            'actions::force-delete-action.modal' => 'ri-delete-bin-6-line',
            'actions::import-action.grouped' => 'ri-upload-line',
            'actions::modal.confirmation' => 'ri-question-line',
            'actions::replicate-action' => 'ri-file-copy-2-line',
            'actions::replicate-action.grouped' => 'ri-file-copy-2-line',
            'actions::restore-action' => 'ri-history-line',
            'actions::restore-action.grouped' => 'ri-history-line',
            'actions::restore-action.modal' => 'ri-history-line',
            'actions::view-action' => 'ri-eye-line',
            'actions::view-action.grouped' => 'ri-eye-line',

            // ==== Infolist Builder Icons ====
            'infolists::components.icon-entry.false' => 'ri-close-circle-line',
            'infolists::components.icon-entry.true' => 'ri-check-double-line',

            // ==== UI Components Icons ====
            'badge.delete-button' => 'ri-close-line',
            'breadcrumbs.separator' => 'ri-arrow-right-double-line',
            'breadcrumbs.separator.rtl' => 'ri-arrow-left-double-line',
            'modal.close-button' => 'ri-close-line',
            'pagination.first-button' => 'ri-skip-back-line',
            'pagination.first-button.rtl' => 'ri-skip-forward-line',
            'pagination.last-button' => 'ri-skip-forward-line',
            'pagination.last-button.rtl' => 'ri-skip-back-line',
            'pagination.next-button' => 'ri-arrow-right-line',
            'pagination.next-button.rtl' => 'ri-arrow-left-line',
            'pagination.previous-button' => 'ri-arrow-left-line',
            'pagination.previous-button.rtl' => 'ri-arrow-right-line',
            'section.collapse-button' => 'ri-arrow-down-s-line',
        ]);
    }

    public function getFilamentDefaultFormAlignment()
    {
        return Page::formActionsAlignment(Alignment::Right);
    }

    public function getFilamentDisableCreateAnother()
    {
        CreateRecord::disableCreateAnother();
        CreateAction::configureUsing(fn(CreateAction $action) => $action->createAnother(false));
    }
}
