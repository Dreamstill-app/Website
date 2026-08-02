<?php

namespace Tests\Feature\Api;

use App\Models\Sort;
use App\Models\User;
use Database\Seeders\BrandTierSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SortApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        // Azure unconfigured in tests → engine takes the rules-only path.
        config(['sorty.azure.endpoint' => null, 'sorty.azure.api_key' => null]);
        // Brand tiers drive price bands (and the $20 resell/donate threshold).
        $this->seed(BrandTierSeeder::class);
    }

    public function test_sort_with_clean_garment_resells_or_donates(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/sorts', [
            'front' => UploadedFile::fake()->image('front.jpg', 800, 800),
            'back' => UploadedFile::fake()->image('back.jpg', 800, 800),
            'brand' => 'Lululemon',
        ]);

        $response->assertCreated()
            ->assertJsonPath('data.status', 'analyzed')
            ->assertJsonPath('data.condition_score', 4)
            ->assertJsonPath('data.decision', 'resell')
            ->assertJsonPath('data.engine.analysis_source', 'rules-only');

        // Premium brand shirt-tier price must clear the $20 threshold.
        $this->assertNotNull($response->json('data.price_estimate'));
        $this->assertGreaterThanOrEqual(20, $response->json('data.price_estimate.high'));

        // Images stored privately and served through the authorized route.
        $this->assertNotEmpty($response->json('data.images.front'));
        $sortId = $response->json('data.id');
        $this->actingAs($user)->get("/api/v1/sorts/{$sortId}/images/front")->assertOk();
    }

    public function test_sort_with_small_tear_marker_recommends_repair(): void
    {
        $user = User::factory()->create();

        $markers = json_encode([
            ['image_type' => 'front', 'damage_type' => 'tear', 'severity' => 1, 'x' => 0.4, 'y' => 0.6],
        ]);

        $this->actingAs($user)->postJson('/api/v1/sorts', [
            'front' => UploadedFile::fake()->image('front.jpg'),
            'markers' => $markers,
        ])->assertCreated()
            ->assertJsonPath('data.decision', 'repair')
            ->assertJsonPath('data.condition_score', 2);
    }

    public function test_unknown_cheap_brand_clean_item_routes_to_donate(): void
    {
        $user = User::factory()->create();

        // Unknown brand accessory: base 10 × 0.8 × 1.0 = 8 → high ≈ 10 < $20 threshold.
        $response = $this->actingAs($user)->postJson('/api/v1/sorts', [
            'front' => UploadedFile::fake()->image('front.jpg'),
            'survey' => json_encode(['style' => 'fast_fashion']),
        ]);

        // Category defaults to null → 'other' base 15 × 0.8 = 12 → high 16 < 20.
        $response->assertCreated()->assertJsonPath('data.decision', 'donate');
    }

    public function test_user_cannot_access_another_users_sort(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();
        $sort = Sort::factory()->for($owner)->create();

        $this->actingAs($intruder)->getJson("/api/v1/sorts/{$sort->id}")->assertForbidden();
        $this->actingAs($intruder)->patchJson("/api/v1/sorts/{$sort->id}", ['accepted' => true])->assertForbidden();
        $this->actingAs($intruder)->deleteJson("/api/v1/sorts/{$sort->id}")->assertForbidden();
        $this->actingAs($intruder)->get("/api/v1/sorts/{$sort->id}/images/front")->assertForbidden();
    }

    public function test_accept_and_correction_are_recorded(): void
    {
        $user = User::factory()->create();
        $sort = Sort::factory()->for($user)->create(['decision' => 'donate']);

        $this->actingAs($user)->patchJson("/api/v1/sorts/{$sort->id}", [
            'accepted' => false,
            'corrected_decision' => 'repair',
            'feedback' => 'It only needs a button.',
        ])->assertOk()
            ->assertJsonPath('data.status', 'rejected')
            ->assertJsonPath('data.corrected_decision', 'repair');

        $this->assertDatabaseHas('sorts', [
            'id' => $sort->id,
            'corrected_decision' => 'repair',
            'status' => Sort::STATUS_REJECTED,
        ]);
    }

    public function test_sort_history_is_paginated_and_own_only(): void
    {
        $user = User::factory()->create();
        Sort::factory()->for($user)->count(3)->create();
        Sort::factory()->count(2)->create(); // other users

        $this->actingAs($user)->getJson('/api/v1/sorts')
            ->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_non_image_upload_is_rejected(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson('/api/v1/sorts', [
            'front' => UploadedFile::fake()->create('payload.php', 100, 'text/php'),
        ])->assertStatus(422)
            ->assertJsonPath('error.code', 'validation_failed');
    }
}
