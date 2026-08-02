<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerLocationResource;
use App\Models\PartnerLocation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LocationController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $validated = $request->validate([
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
            'type' => ['nullable', 'in:thrift,repair,donation,recycler,retail_takeback'],
            'decision' => ['nullable', 'in:resell,donate,repair,recycle'],
            'radius_km' => ['nullable', 'numeric', 'min:1', 'max:100'],
        ]);

        $query = PartnerLocation::query()
            ->published()
            ->near((float) $validated['lat'], (float) $validated['lng'], (float) ($validated['radius_km'] ?? 15));

        if (isset($validated['type'])) {
            $query->where('type', $validated['type']);
        } elseif (isset($validated['decision'])) {
            $query->whereIn('type', PartnerLocation::typesForDecision($validated['decision']));
        }

        return PartnerLocationResource::collection($query->limit(50)->get());
    }
}
