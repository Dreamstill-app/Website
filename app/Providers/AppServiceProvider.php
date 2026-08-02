<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\SiteSetting;
use App\Support\Cms\SiteDefaults;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

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
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        $this->configureRateLimiting();
        View::composer(['layouts.site', 'layouts.site-page'], function ($view): void {
            $siteSettings = SiteDefaults::settings();
            $navigationPages = collect();

            if (Schema::hasTable('site_settings')) {
                $siteSettings = array_merge(
                    $siteSettings,
                    SiteSetting::query()->firstOrCreate([], SiteDefaults::settings())->only(array_keys(SiteDefaults::settings()))
                );
            }

            if (Schema::hasTable('pages')) {
                $navigationPages = Page::query()
                    ->where('show_in_nav', true)
                    ->where('status', 'published')
                    ->orderByRaw('CASE WHEN is_homepage = 1 THEN 0 ELSE 1 END')
                    ->orderBy('title')
                    ->get();
            }

            $view->with('siteSettings', $siteSettings)
                ->with('navigationPages', $navigationPages);
        });
    }

    /**
     * API rate limits (docs/SECURITY.md §2).
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('api-auth', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        RateLimiter::for('api-analyze', function (Request $request) {
            return [
                Limit::perMinute(10)->by($request->user()?->id ?: $request->ip()),
                Limit::perDay((int) config('sorty.analyze_daily_quota'))
                    ->by('daily:'.($request->user()?->id ?: $request->ip())),
            ];
        });

        RateLimiter::for('api-chat', function (Request $request) {
            return Limit::perMinute(20)->by($request->user()?->id ?: $request->ip());
        });
    }
}
