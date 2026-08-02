<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->registerSqliteMathFunctions();
    }

    /**
     * SQLite (test driver) lacks the trig functions used by the Haversine
     * distance scope — map them to PHP's implementations.
     */
    private function registerSqliteMathFunctions(): void
    {
        if (DB::connection()->getDriverName() !== 'sqlite') {
            return;
        }

        $pdo = DB::connection()->getPdo();

        foreach (['acos', 'cos', 'sin', 'sqrt'] as $function) {
            $pdo->sqliteCreateFunction($function, $function, 1);
        }

        $pdo->sqliteCreateFunction('radians', fn ($degrees) => deg2rad((float) $degrees), 1);
        $pdo->sqliteCreateFunction('least', fn (...$values) => min($values), -1);
        $pdo->sqliteCreateFunction('pi', fn () => M_PI, 0);
    }
}
