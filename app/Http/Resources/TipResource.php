<?php

namespace App\Http\Resources;

use App\Models\CommunityTip;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin CommunityTip */
class TipResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'status' => $this->when($request->user()?->id === $this->user_id, $this->status),
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
