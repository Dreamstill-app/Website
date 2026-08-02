<?php

namespace App\Http\Resources;

use App\Models\PartnerLocation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin PartnerLocation */
class PartnerLocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'address' => $this->address,
            'city' => $this->city,
            'distance_km' => isset($this->distance_km) ? round((float) $this->distance_km, 2) : null,
            'hours' => $this->hours,
            'accepted_categories' => $this->accepted_categories ?? [],
            'website' => $this->website,
            'phone' => $this->phone,
            'notes' => $this->notes,
            'verified' => $this->verified_at !== null,
        ];
    }
}
