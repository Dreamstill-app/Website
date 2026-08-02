<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->is_guest ? null : $this->email,
            'is_guest' => (bool) $this->is_guest,
            'account_type' => $this->account_type ?? 'personal',
            'avatar_url' => $this->avatar_path ? url('/api/v1/me/avatar') : null,
            'city' => $this->city,
            'total_points' => $this->total_points,
            'social_links' => $this->social_links,
            'occupation' => $this->occupation,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
