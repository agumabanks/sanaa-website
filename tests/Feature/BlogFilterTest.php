<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_filters_posts_by_category()
    {
        $categoryOne = BlogCategory::create(['name' => 'Tech', 'is_active' => true]);
        $categoryTwo = BlogCategory::create(['name' => 'Health', 'is_active' => true]);

        $postInCategory = Blog::factory()->create([
            'status' => 'published',
            'category_id' => $categoryOne->id,
        ]);

        $postNotInCategory = Blog::factory()->create([
            'status' => 'published',
            'category_id' => $categoryTwo->id,
        ]);

        $response = $this->withHeaders(['X-Requested-With' => 'XMLHttpRequest'])
            ->getJson(route('blog.index', ['category' => $categoryOne->slug]));

        $response->assertOk();
        $response->assertJsonFragment(['title' => $postInCategory->title]);
        $response->assertJsonMissing(['title' => $postNotInCategory->title]);
    }

    /** @test */
    public function it_filters_posts_by_tag()
    {
        $tagOne = BlogTag::create(['name' => 'Laravel']);
        $tagTwo = BlogTag::create(['name' => 'Vue']);

        $postWithTag = Blog::factory()->create(['status' => 'published']);
        $postWithoutTag = Blog::factory()->create(['status' => 'published']);

        $postWithTag->tags()->attach($tagOne->id);
        $postWithoutTag->tags()->attach($tagTwo->id);

        $response = $this->withHeaders(['X-Requested-With' => 'XMLHttpRequest'])
            ->getJson(route('blog.index', ['tag' => $tagOne->slug]));

        $response->assertOk();
        $response->assertJsonFragment(['title' => $postWithTag->title]);
        $response->assertJsonMissing(['title' => $postWithoutTag->title]);
    }
}
