<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardShellTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_pages_use_the_shared_dashboard_shell(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->actingAs($admin)
            ->get(route('dashboard.categories'))
            ->assertOk()
            ->assertSee('id="dashboard-root"', false)
            ->assertSee('Jump to blog, pages, users...', false)
            ->assertSee('id="mobile-menu-button"', false);
    }

    public function test_regular_dashboard_pages_still_use_the_shared_dashboard_shell_without_admin_quick_jump(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('id="dashboard-root"', false)
            ->assertDontSee('Jump to blog, pages, users...', false)
            ->assertSee('id="mobile-menu-button"', false);
    }
}
