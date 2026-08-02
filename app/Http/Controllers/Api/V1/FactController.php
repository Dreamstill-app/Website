<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FactResource;
use App\Models\Fact;
use Illuminate\Http\JsonResponse;

class FactController extends Controller
{
    public function random(): FactResource|JsonResponse
    {
        $fact = Fact::query()->published()->inRandomOrder()->first();

        if ($fact === null) {
            return response()->json(['data' => null]);
        }

        return new FactResource($fact);
    }
}
