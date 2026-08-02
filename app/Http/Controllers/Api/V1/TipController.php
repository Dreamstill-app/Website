<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TipResource;
use App\Models\CommunityTip;
use App\Services\Ai\AzureOpenAi;
use App\Services\Media\ImageStorage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TipController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return TipResource::collection(
            CommunityTip::query()->approved()->with('user')->latest()->paginate(20)
        );
    }

    /**
     * Share a tip: AI moderation gate before publish (PDF requirement).
     */
    public function store(Request $request, AzureOpenAi $ai, ImageStorage $images): JsonResponse
    {
        $validated = $request->validate([
            'text' => ['required', 'string', 'min:10', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:4096'],
        ]);

        $moderation = $ai->moderateTip($validated['text']);

        $tip = $request->user()->communityTips()->create([
            'text' => $validated['text'],
            'status' => $moderation['approved'] ? 'approved' : 'pending',
            'moderation_reason' => $moderation['reason'],
            'moderation_source' => 'ai',
        ]);

        if ($request->hasFile('image')) {
            $stored = $images->storePrivate($request->file('image'), "tips/{$request->user()->id}");
            $tip->update(['image_path' => $stored['path']]);
        }

        if (! $moderation['approved']) {
            return response()->json([
                'message' => $moderation['reason'] ?? 'Your tip needs a quick review before it appears.',
                'data' => new TipResource($tip->load('user')),
            ], 202);
        }

        return (new TipResource($tip->load('user')))->response()->setStatusCode(201);
    }
}
