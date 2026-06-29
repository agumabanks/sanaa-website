<?php

namespace Tests\Feature;

use App\Models\BlogCategory;
use App\Models\BusinessCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_blog_category_from_dashboard(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->actingAs($admin)
            ->post(route('dashboard.category.store'), [
                'type' => 'blog',
                'name' => 'Operations',
                'description' => 'Operational insights and execution notes.',
                'color' => '#0EA5E9',
                'is_active' => 1,
            ])
            ->assertRedirect(route('dashboard.categories'));

        $this->assertDatabaseHas('blog_categories', [
            'name' => 'Operations',
            'description' => 'Operational insights and execution notes.',
            'color' => '#0EA5E9',
            'is_active' => 1,
        ]);

        $this->assertDatabaseMissing('business_categories', [
            'name' => 'Operations',
        ]);
    }

    public function test_admin_can_create_a_business_category_from_dashboard(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $this->actingAs($admin)
            ->post(route('dashboard.category.store'), [
                'type' => 'business',
                'name' => 'Retail',
                'description' => 'Retail and merchant businesses.',
            ])
            ->assertRedirect(route('dashboard.categories'));

        $this->assertDatabaseHas('business_categories', [
            'name' => 'Retail',
            'description' => 'Retail and merchant businesses.',
        ]);

        $this->assertDatabaseMissing('blog_categories', [
            'name' => 'Retail',
        ]);
    }

    public function test_admin_can_update_blog_and_business_categories(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $blogCategory = BlogCategory::create([
            'name' => 'Growth',
            'description' => 'Original description',
            'color' => '#10B981',
            'is_active' => true,
        ]);

        $businessCategory = BusinessCategory::create([
            'name' => 'Wholesale',
            'description' => 'Original business description',
        ]);

        $this->actingAs($admin)
            ->put(route('dashboard.category.update', ['type' => 'blog', 'category' => $blogCategory->id]), [
                'name' => 'Growth Systems',
                'description' => 'Updated blog category copy.',
                'color' => '#F97316',
            ])
            ->assertRedirect(route('dashboard.categories'));

        $this->actingAs($admin)
            ->put(route('dashboard.category.update', ['type' => 'business', 'category' => $businessCategory->id]), [
                'name' => 'Wholesale Trade',
                'description' => 'Updated business type copy.',
            ])
            ->assertRedirect(route('dashboard.categories'));

        $this->assertDatabaseHas('blog_categories', [
            'id' => $blogCategory->id,
            'name' => 'Growth Systems',
            'description' => 'Updated blog category copy.',
            'color' => '#F97316',
            'is_active' => 0,
        ]);

        $this->assertDatabaseHas('business_categories', [
            'id' => $businessCategory->id,
            'name' => 'Wholesale Trade',
            'description' => 'Updated business type copy.',
        ]);
    }
}
