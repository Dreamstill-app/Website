<?php

namespace Tests\Feature;

use App\Models\Sort;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminSortViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_sort_view_page_renders_with_analysis_array(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $sort = Sort::factory()->create([
            'decision' => 'repair',
            'analysis' => [
                'reasons' => ['1 tear (repairable)', 'no other damage'],
                'damages' => [
                    ['type' => 'tear', 'severity' => 2, 'source' => 'vision', 'location' => 'left sleeve'],
                ],
                'colours' => ['navy'],
            ],
        ]);

        $this->actingAs($admin)
            ->get("/admin/sorts/{$sort->id}")
            ->assertOk();
    }

    public function test_admin_guide_page_renders(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get('/admin/admin-guide')
            ->assertOk()
            ->assertSee('Admin Guide');
    }

    public function test_admin_sort_image_route_requires_admin(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('sorts/1/x/test.jpg', 'fake');

        $sort = Sort::factory()->create();
        $sort->images()->create(['type' => 'front', 'path' => 'sorts/1/x/test.jpg']);

        $user = User::factory()->create(['role' => 'user']);
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($user)->get("/admin/sort-image/{$sort->id}/front")->assertForbidden();
        $this->actingAs($admin)->get("/admin/sort-image/{$sort->id}/front")->assertOk();
    }
}
