<?php

namespace App\Http\Resources;

use App\Models\Bundle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Bundle */
class BundleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'decision' => $this->decision,
            'partner_location' => new PartnerLocationResource($this->whenLoaded('partnerLocation')),
            'items_count' => $this->whenCounted('sorts'),
            'sorts' => SortResource::collection($this->whenLoaded('sorts')),
            'completed_at' => $this->completed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
