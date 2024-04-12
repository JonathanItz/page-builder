<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Support\HtmlString;
use Filament\Navigation\NavigationItem;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use App\Filament\Website\Widgets\DashboardSubscriptionStatus;
use Filament\Pages\Auth\EmailVerification\EmailVerificationPrompt;

class WebsitePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('website')
            ->path('builder')
            ->brandName('Igloo Pages')
            ->brandName(function() {
                return new HtmlString('
                    <div class="flex gap-3 items-center">
                        <img class="w-8 h-8 inline" src="'.asset('assets/images/logo-cyan.svg').'" /> Igloo Pages
                    </div>
                ');
            })
            // ->login()
            // ->registration()
            // ->passwordReset()
            ->emailVerification(EmailVerificationPrompt::class)
            ->navigationItems([
                // NavigationItem::make('Page Settings')
                //     ->url(url('/builder/pages/settings'))
                //     ->icon('heroicon-o-adjustments-horizontal')
                //     ->group('Pages')
                //     ->sort(2)
                //     ->isActiveWhen(fn () => request()->routeIs('filament.website.resources.pages.settings')),
            ])
            ->profile(isSimple: false)
            ->sidebarCollapsibleOnDesktop()
            ->colors([
                'primary' => Color::Cyan,
            ])
            ->discoverResources(in: app_path('Filament/Website/Resources'), for: 'App\\Filament\\Website\\Resources')
            ->discoverPages(in: app_path('Filament/Website/Pages'), for: 'App\\Filament\\Website\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Website/Widgets'), for: 'App\\Filament\\Website\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                DashboardSubscriptionStatus::class,
                // Widgets\FilamentInfoWidget::class,
            ])
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
            ->viteTheme('resources/css/filament/website/theme.css')
            ->darkMode(false);
    }
}
