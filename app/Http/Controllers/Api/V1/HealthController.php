<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Ai\AzureOpenAi;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HealthController extends Controller
{
    public function __invoke(AzureOpenAi $ai): JsonResponse
    {
        $checks = [
            'db' => $this->check(fn () => DB::select('SELECT 1') !== []),
            'storage' => $this->check(fn () => Storage::disk('local')->put('.health', 'ok')),
            'ai' => $ai->isConfigured(),
        ];

        return response()->json([
            'status' => ($checks['db'] && $checks['storage']) ? 'ok' : 'degraded',
            'checks' => $checks,
            'version' => '1.0',
        ]);
    }

    private function check(callable $probe): bool
    {
        try {
            return (bool) $probe();
        } catch (\Throwable) {
            return false;
        }
    }
}
