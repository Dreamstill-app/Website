<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Nightly platform-impact rollup (dashboard + /impact/global freshness).
Schedule::command('sorty:rollup-impact')->dailyAt('03:10');

// PIPEDA 30-day retention: purge accounts past the soft-delete window.
Schedule::command('sorty:purge-deleted-users')->dailyAt('03:30');
