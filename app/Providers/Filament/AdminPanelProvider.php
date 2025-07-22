<?php

namespace App\Providers\Filament;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Filament\Support\Colors\Color;
use Filament\PanelProvider;
use Filament\Panel;
use Filament\Navigation\NavigationGroup;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\Authenticate;
use Filament\FontProviders\GoogleFontProvider;
use DiogoGPinto\AuthUIEnhancer\AuthUIEnhancerPlugin;
use App\Providers\Filament\AvatarProvider;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')

            // Authentication
            // ->login()
            ->login(\App\Filament\Pages\Auth\Login::class)

            // Themes
            ->brandLogo(asset('sites/images/logo/logo.png'))
            ->brandLogoHeight('3.5rem')
            ->favicon(asset('sites/images/favicon/favicon.ico'))
            ->viteTheme('resources/css/filament/theme.css')
            ->font('Montserrat', provider: GoogleFontProvider::class)
            ->darkMode(false)
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('16rem')

            // Plugins
            ->plugins([
                AuthUIEnhancerPlugin::make()
                    ->formPanelPosition('right')
                    ->mobileFormPanelPosition('bottom')
                    ->formPanelWidth('40%')
                    ->formPanelBackgroundColor(Color::Slate, '50')
                    ->emptyPanelBackgroundImageUrl(asset('sites/images/banner/main-bg-auth.png')),
            ])

            // Discoveries
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')

            // Navigation
            ->navigationGroups([
                NavigationGroup::make('Overview')
                    ->collapsible(false),
                NavigationGroup::make('Catalog')
                    ->collapsible(false),
                NavigationGroup::make('Customers')
                    ->collapsible(false),
                NavigationGroup::make('User Management')
                    ->collapsible(false),
            ])

            // Profile
            ->defaultAvatarProvider(AvatarProvider::class)

            // Middleware
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])

            // SPA
            ->spa()

            // Notifications
            ->databaseNotifications();
    }
}
