<?php

namespace App\Services\Gamification;

use App\Models\Challenge;
use App\Models\User;

/**
 * Syncs challenge progress + points with sorting activity
 * ("Make sure challenges are syncing with the user sorting activity").
 */
class ChallengeService
{
    /**
     * Record a completed sort against all of the user's joined, active
     * challenges. Awards points on completion.
     */
    public function recordSort(User $user, string $decision): void
    {
        $metrics = ['sorts_count', "decision_{$decision}"];

        $progressRows = $user->challengeProgress()
            ->whereNull('completed_at')
            ->whereHas('challenge', function ($query) use ($metrics): void {
                $query->active()->whereIn('metric', $metrics);
            })
            ->with('challenge')
            ->get();

        foreach ($progressRows as $row) {
            /** @var Challenge $challenge */
            $challenge = $row->challenge;

            $row->progress++;

            if ($row->progress >= $challenge->target) {
                $row->completed_at = now();
                $user->increment('total_points', $challenge->points);
            }

            $row->save();
        }
    }
}
