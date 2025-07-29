<?php

namespace App\Providers\Filament;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Filament\Widgets;
use Filament\Support\Colors\Color;
use Filament\PanelProvider;
use Filament\Panel;
use Filament\Pages;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\Authenticate;
use Filament\FontProviders\GoogleFontProvider;
use DiogoGPinto\AuthUIEnhancer\AuthUIEnhancerPlugin;
use App\Providers\Filament\AvatarProvider;
use App\Http\Middleware\CustomerAuthenticate;

class CustomerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('customer')
            ->path('customer')
            ->authGuard('customer')

            // Authentication
            ->login()
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->registration()
            ->passwordReset()

            // Themes
            ->brandLogo(asset('images/logo.svg'))
            ->brandLogoHeight('3.5rem')
            ->favicon(asset('images/logo.svg'))
            ->viteTheme('resources/css/filament/theme.css')
            ->font('Montserrat', provider: GoogleFontProvider::class)
            ->darkMode(false)
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('16rem')

            // Dicoveries
            ->discoverResources(in: app_path('Filament/Customer/Resources'), for: 'App\\Filament\\Customer\\Resources')
            ->discoverPages(in: app_path('Filament/Customer/Pages'), for: 'App\\Filament\\Customer\\Pages')
            ->discoverWidgets(in: app_path('Filament/Customer/Widgets'), for: 'App\\Filament\\Customer\\Widgets')

            // Plugins
            ->plugins([
                AuthUIEnhancerPlugin::make()
                    ->formPanelPosition('right')
                    ->mobileFormPanelPosition('bottom')
                    ->formPanelWidth('40%')
                    ->formPanelBackgroundColor(Color::Slate, '50')
                    ->emptyPanelBackgroundImageUrl(asset('images/auth-bg.svg')),
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
                CustomerAuthenticate::class,
            ])

            // SPA
            ->spa()

            // Notifications
            ->databaseNotifications();
    }
}
