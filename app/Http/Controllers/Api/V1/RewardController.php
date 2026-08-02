<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RewardResource;
use App\Models\Reward;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RewardController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return RewardResource::collection(
            Reward::query()->available()->orderBy('points_cost')->get()
        );
    }

    /**
     * Claim a reward: spend points, decrement stock, notify DreamStill by email.
     */
    public function claim(Request $request, Reward $reward): JsonResponse
    {
        $user = $request->user();

        abort_unless($reward->is_published, 404);

        if ($user->is_guest) {
            return response()->json([
                'error' => ['code' => 'guest_not_allowed', 'message' => 'Create an account to claim rewards.'],
            ], 403);
        }

        try {
            DB::transaction(function () use ($user, $reward): void {
                $lockedUser = $user->newQuery()->lockForUpdate()->findOrFail($user->id);
                $lockedReward = Reward::query()->lockForUpdate()->findOrFail($reward->id);

                if ($lockedReward->stock !== null && $lockedReward->stock < 1) {
                    throw new \DomainException('This reward is out of stock.');
                }

                if ($lockedUser->total_points < $lockedReward->points_cost) {
                    throw new \DomainException('Not enough points for this reward.');
                }

                $lockedUser->decrement('total_points', $lockedReward->points_cost);

                if ($lockedReward->stock !== null) {
                    $lockedReward->decrement('stock');
                }

                $lockedReward->claims()->create([
                    'user_id' => $lockedUser->id,
                    'points_spent' => $lockedReward->points_cost,
                ]);
            });
        } catch (\DomainException $e) {
            return response()->json([
                'error' => ['code' => 'claim_rejected', 'message' => $e->getMessage()],
            ], 422);
        }

        // Notify DreamStill (requirement: email to info@dreamstill.ca with
        // the user's email + reward type). Failure must not break the claim.
        try {
            Mail::raw(
                "Reward claimed on Sorty\n\nUser: {$user->name} <{$user->email}>\nReward: {$reward->title} ({$reward->reward_type})\nPartner: {$reward->partner_name}\nPoints spent: {$reward->points_cost}",
                fn ($message) => $message->to('info@dreamstill.ca')->subject('Sorty reward claimed: '.$reward->title)
            );
        } catch (\Throwable $e) {
            report($e);
        }

        return response()->json([
            'message' => 'Reward claimed! DreamStill will email you the details.',
            'remaining_points' => $user->fresh()->total_points,
        ], 201);
    }
}
