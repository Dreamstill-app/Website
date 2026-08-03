<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\Media\ImageStorage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function show(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function update(Request $request): UserResource
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:100'],
            'city' => ['sometimes', 'nullable', 'string', 'max:100'],
            'postal_prefix' => ['sometimes', 'nullable', 'string', 'max:3'],
            'account_type' => ['sometimes', 'in:personal,donation_center,consignment'],
            'occupation' => ['sometimes', 'nullable', 'string', 'max:100'],
            'social_links' => ['sometimes', 'nullable', 'array', 'max:5'],
            'social_links.*' => ['string', 'max:255'],
            'preferences' => ['sometimes', 'nullable', 'array'],
        ]);

        $request->user()->update($validated);

        return new UserResource($request->user()->fresh());
    }

    /**
     * Account deletion (PIPEDA / app-store requirement): soft-delete now,
     * hard purge after the 30-day window via scheduled job.
     */
    public function destroy(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->tokens()->delete();
        $user->delete();

        return response()->json(null, 204);
    }

    public function avatar(Request $request, ImageStorage $images)
    {
        // GET serves the avatar; POST replaces it.
        if ($request->isMethod('GET')) {
            $path = $request->user()->avatar_path;
            abort_if($path === null, 404);

            $publicUrl = $images->publicUrl($path);
            if ($publicUrl !== null) {
                return redirect()->away($publicUrl);
            }

            return $images->response($path);
        }

        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,webp', 'max:4096'],
        ]);

        $user = $request->user();

        if ($user->avatar_path !== null) {
            $images->delete($user->avatar_path);
        }

        $stored = $images->storePrivate($request->file('avatar'), "avatars/{$user->id}");
        $user->update(['avatar_path' => $stored['path']]);

        return new UserResource($user->fresh());
    }
}
