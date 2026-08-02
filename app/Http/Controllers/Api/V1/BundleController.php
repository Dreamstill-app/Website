<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BundleResource;
use App\Models\Bundle;
use App\Models\Sort;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BundleController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $bundles = $request->user()->bundles()
            ->with('partnerLocation')
            ->withCount('sorts')
            ->latest()
            ->get();

        return BundleResource::collection($bundles);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'decision' => ['nullable', 'in:resell,donate,repair,recycle'],
            'partner_location_id' => ['nullable', 'integer', 'exists:partner_locations,id'],
        ]);

        $bundle = $request->user()->bundles()->create($validated);

        return (new BundleResource($bundle->loadCount('sorts')))->response()->setStatusCode(201);
    }

    public function update(Request $request, Bundle $bundle): BundleResource
    {
        $this->authorize('update', $bundle);

        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:100'],
            'decision' => ['sometimes', 'nullable', 'in:resell,donate,repair,recycle'],
            'partner_location_id' => ['sometimes', 'nullable', 'integer', 'exists:partner_locations,id'],
            'completed_at' => ['sometimes', 'nullable', 'date'],
        ]);

        $bundle->update($validated);

        return new BundleResource($bundle->fresh(['partnerLocation'])->loadCount('sorts'));
    }

    public function destroy(Request $request, Bundle $bundle): JsonResponse
    {
        $this->authorize('delete', $bundle);

        $bundle->delete();

        return response()->json(null, 204);
    }

    public function addItem(Request $request, Bundle $bundle): JsonResponse
    {
        $this->authorize('update', $bundle);

        $validated = $request->validate([
            'sort_id' => ['required', 'uuid', 'exists:sorts,id'],
        ]);

        $sort = Sort::findOrFail($validated['sort_id']);
        $this->authorize('view', $sort);

        $bundle->sorts()->syncWithoutDetaching([$sort->id]);

        return response()->json(['message' => 'Added to bundle.'], 201);
    }

    public function removeItem(Request $request, Bundle $bundle, Sort $sort): JsonResponse
    {
        $this->authorize('update', $bundle);

        $bundle->sorts()->detach($sort->id);

        return response()->json(null, 204);
    }
}
