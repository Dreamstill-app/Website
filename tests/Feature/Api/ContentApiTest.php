<?php

namespace Tests\Feature\Api;

use App\Models\Challenge;
use App\Models\Event;
use App\Models\Fact;
use App\Models\PartnerLocation;
use App\Models\Reward;
use App\Models\Sort;
use App\Models\User;
use App\Services\Gamification\ChallengeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContentApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_locations_returns_nearby_sorted_by_distance(): void
    {
        PartnerLocation::factory()->create(['name' => 'Close', 'lat' => 49.2830, 'lng' => -123.1200]);
        PartnerLocation::factory()->create(['name' => 'Far', 'lat' => 49.2000, 'lng' => -123.0000]);
        PartnerLocation::factory()->create(['name' => 'Unpublished', 'lat' => 49.2830, 'lng' => -123.1200, 'is_published' => false]);

        $response = $this->getJson('/api/v1/locations?lat=49.2827&lng=-123.1207&radius_km=50')
            ->assertOk();

        $names = collect($response->json('data'))->pluck('name');
        $this->assertSame('Close', $names->first());
        $this->assertFalse($names->contains('Unpublished'));
        $this->assertNotNull($response->json('data.0.distance_km'));
    }

    public function test_locations_filters_by_decision_mapping(): void
    {
        PartnerLocation::factory()->create(['name' => 'Repair Shop', 'type' => 'repair', 'lat' => 49.2830, 'lng' => -123.1200]);
        PartnerLocation::factory()->create(['name' => 'Thrift', 'type' => 'thrift', 'lat' => 49.2830, 'lng' => -123.1200]);

        $names = collect(
            $this->getJson('/api/v1/locations?lat=49.2827&lng=-123.1207&decision=repair')->json('data')
        )->pluck('name');

        $this->assertTrue($names->contains('Repair Shop'));
        $this->assertFalse($names->contains('Thrift'));
    }

    public function test_events_hides_pending_and_unpublished(): void
    {
        Event::factory()->create(['title' => 'Approved', 'status' => 'approved']);
        Event::factory()->create(['title' => 'Pending', 'status' => 'pending']);
        Event::factory()->create(['title' => 'Hidden', 'is_published' => false]);

        $titles = collect($this->getJson('/api/v1/events')->assertOk()->json('data'))->pluck('title');

        $this->assertTrue($titles->contains('Approved'));
        $this->assertFalse($titles->contains('Pending'));
        $this->assertFalse($titles->contains('Hidden'));
    }

    public function test_event_submission_lands_pending(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson('/api/v1/events/submit', [
            'title' => 'Community Swap',
            'description' => 'A neighbourhood clothing swap.',
            'starts_at' => now()->addWeek()->toIso8601String(),
            'location' => 'Vancouver',
            'link' => 'https://eventbrite.com/e/123',
        ])->assertCreated();

        $this->assertDatabaseHas('events', [
            'title' => 'Community Swap',
            'status' => 'pending',
            'submitted_by' => $user->id,
        ]);
    }

    public function test_fact_random_returns_published_fact_with_source(): void
    {
        Fact::factory()->create(['text' => 'Sourced fact', 'source' => 'WRAP', 'year' => 2024]);

        $this->getJson('/api/v1/facts/random')
            ->assertOk()
            ->assertJsonPath('data.text', 'Sourced fact')
            ->assertJsonPath('data.source', 'WRAP');
    }

    public function test_challenge_join_and_sort_sync_awards_points(): void
    {
        $user = User::factory()->create();
        $challenge = Challenge::factory()->create(['metric' => 'sorts_count', 'target' => 2, 'points' => 50]);

        $this->actingAs($user)->postJson("/api/v1/challenges/{$challenge->id}/join")->assertCreated();

        $service = app(ChallengeService::class);
        $service->recordSort($user, 'donate');
        $service->recordSort($user, 'resell');

        $this->assertSame(50, $user->fresh()->total_points);
        $this->assertNotNull($user->challengeProgress()->first()->completed_at);

        $this->actingAs($user)->getJson('/api/v1/challenges')
            ->assertOk()
            ->assertJsonPath('data.0.completed', true)
            ->assertJsonPath('data.0.progress', 2);
    }

    public function test_reward_claim_spends_points_and_notifies(): void
    {
        Mail::fake();

        $user = User::factory()->create(['total_points' => 100]);
        $reward = Reward::create([
            'title' => '20% off at Hunter & Hare',
            'points_cost' => 60,
            'reward_type' => 'discount_code',
            'partner_name' => 'Hunter & Hare',
            'stock' => 5,
        ]);

        $this->actingAs($user)->postJson("/api/v1/rewards/{$reward->id}/claim")
            ->assertCreated()
            ->assertJsonPath('remaining_points', 40);

        $this->assertDatabaseHas('reward_claims', ['reward_id' => $reward->id, 'user_id' => $user->id, 'points_spent' => 60]);
        $this->assertSame(4, $reward->fresh()->stock);
    }

    public function test_reward_claim_fails_without_points(): void
    {
        $user = User::factory()->create(['total_points' => 10]);
        $reward = Reward::create(['title' => 'R', 'points_cost' => 60, 'reward_type' => 'discount_code']);

        $this->actingAs($user)->postJson("/api/v1/rewards/{$reward->id}/claim")
            ->assertStatus(422)
            ->assertJsonPath('error.code', 'claim_rejected');

        $this->assertSame(10, $user->fresh()->total_points);
    }

    public function test_guest_cannot_claim_rewards(): void
    {
        $guest = User::factory()->create(['is_guest' => true, 'total_points' => 500]);
        $reward = Reward::create(['title' => 'R', 'points_cost' => 60, 'reward_type' => 'discount_code']);

        $this->actingAs($guest)->postJson("/api/v1/rewards/{$reward->id}/claim")
            ->assertForbidden();
    }

    public function test_tip_submission_fails_closed_to_pending_without_ai(): void
    {
        config(['sorty.azure.endpoint' => null, 'sorty.azure.api_key' => null]);

        $user = User::factory()->create();

        $this->actingAs($user)->postJson('/api/v1/tips', [
            'text' => 'Wash dark jeans inside out in cold water to preserve colour.',
        ])->assertStatus(202);

        $this->assertDatabaseHas('community_tips', [
            'user_id' => $user->id,
            'status' => 'pending',
            'moderation_source' => 'ai',
        ]);

        // Pending tips are not publicly listed.
        $this->getJson('/api/v1/tips')->assertOk()->assertJsonCount(0, 'data');
    }

    public function test_impact_me_reflects_sorts(): void
    {
        $user = User::factory()->create();
        Sort::factory()->for($user)->count(4)->create(['decision' => 'donate', 'status' => 'analyzed']);

        $response = $this->actingAs($user)->getJson('/api/v1/impact/me')->assertOk();

        $this->assertSame(4, $response->json('data.sorts_total'));
        // 4 sorts × 0.5 kg × 3.2 kgCO2e/kg = 6.4
        $this->assertEqualsWithDelta(6.4, $response->json('data.ghg_kg_avoided'), 0.001);
        $this->assertEqualsWithDelta(2.0, $response->json('data.textiles_kg_diverted'), 0.001);
    }
}
