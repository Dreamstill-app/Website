<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', PasswordRule::min(10)->uncompromised()],
            'device_name' => ['required', 'string', 'max:60'],
            'accepts_terms' => ['required', 'accepted'],
            'city' => ['nullable', 'string', 'max:100'],
            'account_type' => ['nullable', 'in:personal,donation_center,consignment'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'city' => $validated['city'] ?? null,
            'account_type' => $validated['account_type'] ?? 'personal',
        ]);

        return $this->tokenResponse($user, $validated['device_name'], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['required', 'string', 'max:60'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if ($user === null || ! Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'error' => ['code' => 'invalid_credentials', 'message' => 'The provided credentials are incorrect.'],
            ], 401);
        }

        return $this->tokenResponse($user, $validated['device_name']);
    }

    /**
     * Guest session: a real user row with limited-ability token. Data created
     * as a guest survives the later upgrade to a full account.
     */
    public function guest(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'device_name' => ['required', 'string', 'max:60'],
        ]);

        $user = User::create([
            'name' => 'Guest',
            'email' => 'guest-'.Str::uuid().'@guest.sorty.internal',
            'password' => Str::password(32),
            'is_guest' => true,
        ]);

        return $this->tokenResponse($user, $validated['device_name'], 201, abilities: ['guest']);
    }

    public function guestUpgrade(Request $request): JsonResponse
    {
        $user = $request->user();

        if (! $user->is_guest) {
            return response()->json([
                'error' => ['code' => 'not_a_guest', 'message' => 'This account is already registered.'],
            ], 409);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', PasswordRule::min(10)->uncompromised()],
            'accepts_terms' => ['required', 'accepted'],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'is_guest' => false,
        ]);

        // Re-issue a full-ability token; revoke the guest ones.
        $deviceName = $user->currentAccessToken()->name ?? 'device';
        $user->tokens()->delete();

        return $this->tokenResponse($user->fresh(), $deviceName);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(null, 204);
    }

    public function logoutAll(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(null, 204);
    }

    public function forgotPassword(Request $request): JsonResponse
    {
        $request->validate(['email' => ['required', 'email']]);

        // Always 202 — no account enumeration.
        Password::sendResetLink($request->only('email'));

        return response()->json(['message' => 'If that email exists, a reset link has been sent.'], 202);
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', PasswordRule::min(10)->uncompromised()],
        ]);

        $status = Password::reset(
            $validated,
            function (User $user, string $password): void {
                $user->forceFill(['password' => $password])->save();
                $user->tokens()->delete();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return response()->json([
                'error' => ['code' => 'reset_failed', 'message' => __($status)],
            ], 422);
        }

        return response()->json(['message' => 'Password has been reset.']);
    }

    private function tokenResponse(User $user, string $deviceName, int $status = 200, array $abilities = ['*']): JsonResponse
    {
        $expiration = config('sanctum.expiration');
        $expiresAt = $expiration ? now()->addMinutes((int) $expiration) : null;

        $token = $user->createToken($deviceName, $abilities, $expiresAt);

        return response()->json([
            'token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'expires_at' => $expiresAt?->toIso8601String(),
            'user' => new UserResource($user),
        ], $status);
    }
}
