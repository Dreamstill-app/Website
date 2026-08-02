<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * Public mini-profile for clickable usernames under Community Tips.
 * Deliberately minimal — no email, no activity history.
 */
class UserProfileController extends Controller
{
    public function show(User $user): JsonResponse
    {
        abort_if($user->is_guest, 404);

        return response()->json([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'city' => $user->city,
                'occupation' => $user->occupation,
                'social_links' => $user->social_links ?? [],
                'tips_count' => $user->communityTips()->approved()->count(),
                'member_since' => $user->created_at?->format('F Y'),
            ],
        ]);
    }
}
