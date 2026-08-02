<?php

namespace Tests\Feature;

use App\Filament\Widgets\ImpactStatsOverview;
use App\Models\Sort;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_admin_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_non_admin_users_cannot_access_the_panel(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get('/admin')->assertForbidden();
    }

    public function test_admin_dashboard_renders(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get('/admin')->assertOk();
    }

    public function test_impact_widget_computes_from_sorts(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Sort::factory()->count(3)->create(['decision' => 'donate', 'status' => 'analyzed']);

        $this->actingAs($admin);

        Livewire::test(ImpactStatsOverview::class)
            ->assertSee('Garments sorted')
            ->assertSee('3')
            ->assertSee('GHG avoided');
    }

    public function test_admin_can_view_sorts_dataset(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Sort::factory()->create(['decision' => 'repair', 'brand' => 'Aritzia']);

        $this->actingAs($admin)->get('/admin/sorts')
            ->assertOk()
            ->assertSee('Aritzia');
    }
}
