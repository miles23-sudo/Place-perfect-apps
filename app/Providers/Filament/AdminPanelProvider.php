<?php

namespace App\Providers\Filament;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Filament\Support\Enums\MaxWidth;
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
            ->login(\App\Filament\Pages\Auth\Login::class)

            // Themes
            ->brandLogo(asset('images/logo-light.png'))
            ->darkModeBrandLogo(asset('images/logo-dark.png'))
            ->brandLogoHeight('3.5rem')
            ->favicon(asset('images/logo.svg'))
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->font('Poppins', provider: GoogleFontProvider::class)
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('16rem')
            ->maxContentWidth(MaxWidth::ScreenTwoExtraLarge)

            // Discoveries
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')

            // Plugins
            ->plugins([
                AuthUIEnhancerPlugin::make()
                    ->formPanelPosition('right')
                    ->mobileFormPanelPosition('bottom')
                    ->formPanelWidth('40%')
                    ->emptyPanelBackgroundImageUrl(asset('images/auth-bg.svg')),
            ])

            // Navigation
            ->navigationGroups([
                NavigationGroup::make('Overview')
                    ->collapsible(false),
                NavigationGroup::make('Customers')
                    ->collapsible(false),
                NavigationGroup::make('Products')
                    ->collapsible(false),
                NavigationGroup::make('Administration')
                    ->collapsible(false),
            ])

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
