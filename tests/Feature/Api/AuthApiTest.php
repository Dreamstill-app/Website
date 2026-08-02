<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        RateLimiter::clear('api-auth');
    }

    public function test_register_creates_user_and_returns_token(): void
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'Khushi',
            'email' => 'khushi@example.com',
            'password' => 'a-very-long-unique-passphrase-9',
            'device_name' => 'pixel-9',
            'accepts_terms' => true,
            'city' => 'Vancouver',
        ]);

        $response->assertCreated()
            ->assertJsonStructure(['token', 'token_type', 'expires_at', 'user' => ['id', 'name', 'email']])
            ->assertJsonPath('user.email', 'khushi@example.com')
            ->assertJsonPath('user.is_guest', false);

        $this->assertDatabaseHas('users', ['email' => 'khushi@example.com', 'role' => 'user']);
    }

    public function test_register_requires_terms_acceptance_and_strong_password(): void
    {
        $this->postJson('/api/v1/auth/register', [
            'name' => 'X',
            'email' => 'x@example.com',
            'password' => 'short',
            'device_name' => 'd',
            'accepts_terms' => false,
        ])->assertStatus(422)
            ->assertJsonPath('error.code', 'validation_failed')
            ->assertJsonStructure(['error' => ['details' => ['password', 'accepts_terms']]]);
    }

    public function test_login_with_wrong_credentials_is_generic_401(): void
    {
        User::factory()->create(['email' => 'real@example.com']);

        $this->postJson('/api/v1/auth/login', [
            'email' => 'real@example.com',
            'password' => 'wrong-password-entirely',
            'device_name' => 'd',
        ])->assertStatus(401)
            ->assertJsonPath('error.code', 'invalid_credentials');
    }

    public function test_login_returns_token_and_protected_route_works(): void
    {
        $user = User::factory()->create(['password' => 'a-very-long-unique-passphrase-9']);

        $token = $this->postJson('/api/v1/auth/login', [
            'email' => $user->email,
            'password' => 'a-very-long-unique-passphrase-9',
            'device_name' => 'd',
        ])->assertOk()->json('token');

        $this->withToken($token)->getJson('/api/v1/me')
            ->assertOk()
            ->assertJsonPath('data.id', $user->id);
    }

    public function test_guest_session_and_upgrade_preserves_data(): void
    {
        $guestResponse = $this->postJson('/api/v1/auth/guest', ['device_name' => 'd'])->assertCreated();
        $token = $guestResponse->json('token');
        $guestId = $guestResponse->json('user.id');

        $this->assertTrue((bool) $guestResponse->json('user.is_guest'));

        $upgrade = $this->withToken($token)->postJson('/api/v1/auth/guest/upgrade', [
            'name' => 'Now Registered',
            'email' => 'upgraded@example.com',
            'password' => 'a-very-long-unique-passphrase-9',
            'accepts_terms' => true,
        ])->assertOk();

        $this->assertSame($guestId, $upgrade->json('user.id'));
        $this->assertFalse((bool) $upgrade->json('user.is_guest'));
        $this->assertDatabaseHas('users', ['id' => $guestId, 'email' => 'upgraded@example.com', 'is_guest' => false]);
    }

    public function test_unauthenticated_request_gets_envelope_401(): void
    {
        $this->getJson('/api/v1/me')
            ->assertStatus(401)
            ->assertJsonPath('error.code', 'unauthenticated');
    }

    public function test_logout_revokes_token(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('d')->plainTextToken;

        $this->withToken($token)->postJson('/api/v1/auth/logout')->assertNoContent();

        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    public function test_auth_endpoints_are_rate_limited(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/api/v1/auth/login', [
                'email' => 'nobody@example.com', 'password' => 'x', 'device_name' => 'd',
            ]);
        }

        $this->postJson('/api/v1/auth/login', [
            'email' => 'nobody@example.com', 'password' => 'x', 'device_name' => 'd',
        ])->assertStatus(429)
            ->assertJsonPath('error.code', 'rate_limited');
    }
}
