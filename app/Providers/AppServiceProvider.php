<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\SiteSetting;
use App\Support\Cms\SiteDefaults;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
}
