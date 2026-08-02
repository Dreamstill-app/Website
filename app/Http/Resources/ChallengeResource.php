<?php

namespace App\Http\Resources;

use App\Models\Challenge;
use App\Models\ChallengeProgress;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Challenge */
class ChallengeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var ChallengeProgress|null $progress */
        $progress = $this->whenLoaded('progress', fn () => $this->progress->first(), null);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'points' => $this->points,
            'metric' => $this->metric,
            'target' => $this->target,
            'ends_at' => $this->ends_at?->toIso8601String(),
            'joined' => $progress !== null,
            'progress' => $progress?->progress ?? 0,
            'completed' => $progress?->completed_at !== null,
        ];
    }
}
