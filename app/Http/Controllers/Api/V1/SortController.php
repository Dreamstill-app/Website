<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SortResource;
use App\Models\DamageMarker;
use App\Models\Sort;
use App\Services\Gamification\ChallengeService;
use App\Services\Media\ImageStorage;
use App\Services\Sorting\AnalysisEngine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class SortController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $sorts = $request->user()->sorts()
            ->with(['images'])
            ->when($request->query('decision'), fn ($q, $decision) => $q->where('decision', $decision))
            ->latest()
            ->paginate(20);

        return SortResource::collection($sorts);
    }

    /**
     * Create a sort from uploaded images + survey + markers, then run the
     * analysis pipeline synchronously (vision → decision tree → price).
     */
    public function store(
        Request $request,
        ImageStorage $images,
        AnalysisEngine $engine,
        ChallengeService $challenges,
    ): JsonResponse {
        $maxKb = (int) (config('sorty.uploads.max_bytes') / 1024);

        $validated = $request->validate([
            'front' => ['required', 'image', 'mimes:jpeg,png,webp,heic', "max:{$maxKb}"],
            'back' => ['nullable', 'image', 'mimes:jpeg,png,webp,heic', "max:{$maxKb}"],
            'tag' => ['nullable', 'image', 'mimes:jpeg,png,webp,heic', "max:{$maxKb}"],
            'brand' => ['nullable', 'string', 'max:100'],
            'survey' => ['nullable', 'json'],
            'markers' => ['nullable', 'json'],
        ]);

        $user = $request->user();

        $sort = DB::transaction(function () use ($request, $validated, $images, $user): Sort {
            $sort = $user->sorts()->create([
                'status' => Sort::STATUS_PENDING,
                'brand' => $validated['brand'] ?? null,
            ]);

            foreach (['front', 'back', 'tag'] as $type) {
                if ($request->hasFile($type)) {
                    $stored = $images->storePrivate($request->file($type), "sorts/{$user->id}/{$sort->id}");
                    $sort->images()->create(['type' => $type] + $stored);
                }
            }

            $this->persistSurvey($sort, $validated['survey'] ?? null);
            $this->persistMarkers($sort, $validated['markers'] ?? null);

            return $sort;
        });

        $sort = $engine->analyze($sort);

        if ($sort->decision !== null) {
            $challenges->recordSort($user, $sort->decision);
        }

        return (new SortResource($sort->load(['images'])))->response()->setStatusCode(201);
    }

    public function show(Request $request, Sort $sort): SortResource
    {
        $this->authorize('view', $sort);

        return new SortResource($sort->load(['images']));
    }

    /**
     * Accept or correct the recommendation — corrections become training labels.
     */
    public function update(Request $request, Sort $sort): SortResource
    {
        $this->authorize('update', $sort);

        $validated = $request->validate([
            'accepted' => ['sometimes', 'boolean'],
            'corrected_decision' => ['sometimes', 'nullable', 'in:resell,donate,repair,recycle'],
            'feedback' => ['sometimes', 'nullable', 'string', 'max:500'],
        ]);

        if (array_key_exists('accepted', $validated)) {
            $sort->status = $validated['accepted'] ? Sort::STATUS_ACCEPTED : Sort::STATUS_REJECTED;
            $sort->accepted_at = $validated['accepted'] ? now() : null;
        }

        if (array_key_exists('corrected_decision', $validated)) {
            $sort->corrected_decision = $validated['corrected_decision'];
        }

        if (array_key_exists('feedback', $validated)) {
            $sort->feedback = $validated['feedback'];
        }

        $sort->save();

        return new SortResource($sort->load(['images']));
    }

    public function destroy(Request $request, Sort $sort, ImageStorage $images): JsonResponse
    {
        $this->authorize('delete', $sort);

        $images->deleteDirectory("sorts/{$sort->user_id}/{$sort->id}");
        $sort->delete();

        return response()->json(null, 204);
    }

    private function persistSurvey(Sort $sort, ?string $surveyJson): void
    {
        if ($surveyJson === null) {
            return;
        }

        $survey = json_decode($surveyJson, true);

        if (! is_array($survey)) {
            return;
        }

        $sort->surveyResponse()->create([
            'reason' => $survey['reason'] ?? null,
            'time_owned' => $survey['time_owned'] ?? null,
            'thrifted' => isset($survey['thrifted']) ? (bool) $survey['thrifted'] : null,
            'style' => $survey['style'] ?? null,
            'times_worn' => $survey['times_worn'] ?? null,
            'purchase_price' => isset($survey['purchase_price']) && is_numeric($survey['purchase_price'])
                ? $survey['purchase_price'] : null,
        ]);
    }

    private function persistMarkers(Sort $sort, ?string $markersJson): void
    {
        if ($markersJson === null) {
            return;
        }

        $markers = json_decode($markersJson, true);

        if (! is_array($markers)) {
            return;
        }

        foreach (array_slice($markers, 0, 30) as $marker) {
            if (! is_array($marker)
                || ! in_array($marker['image_type'] ?? '', ['front', 'back'], true)
                || ! in_array($marker['damage_type'] ?? '', DamageMarker::TYPES, true)) {
                continue;
            }

            $sort->damageMarkers()->create([
                'image_type' => $marker['image_type'],
                'damage_type' => $marker['damage_type'],
                'severity' => isset($marker['severity']) ? min(3, max(1, (int) $marker['severity'])) : null,
                'x' => min(1, max(0, (float) ($marker['x'] ?? 0.5))),
                'y' => min(1, max(0, (float) ($marker['y'] ?? 0.5))),
                'source' => 'user',
            ]);
        }
    }
}
