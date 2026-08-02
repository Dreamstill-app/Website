<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChallengeResource;
use App\Models\Challenge;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ChallengeController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $challenges = Challenge::query()
            ->active()
            ->with(['progress' => fn ($q) => $q->where('user_id', $request->user()->id)])
            ->orderBy('points')
            ->get();

        return ChallengeResource::collection($challenges);
    }

    public function join(Request $request, Challenge $challenge): JsonResponse
    {
        abort_unless($challenge->is_published, 404);

        $challenge->progress()->firstOrCreate(
            ['user_id' => $request->user()->id],
            ['progress' => 0]
        );

        return response()->json(['message' => 'Challenge joined.'], 201);
    }
}
