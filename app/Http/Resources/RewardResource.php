<?php

namespace App\Http\Resources;

use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Reward */
class RewardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'points_cost' => $this->points_cost,
            'reward_type' => $this->reward_type,
            'partner_name' => $this->partner_name,
            'stock' => $this->stock,
            'expires_at' => $this->expires_at?->toIso8601String(),
        ];
    }
}
