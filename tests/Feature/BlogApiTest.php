<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_endpoint_increments_views(): void
    {
        $post = Blog::factory()->create();

        $this->getJson("/api/blogs/{$post->slug}")->assertOk();

        $this->assertEquals(1, $post->fresh()->views);
    }

    public function test_like_endpoint_increments_likes(): void
    {
        $post = Blog::factory()->create();

        $this->postJson("/api/blogs/{$post->slug}/like")->assertOk()->assertJson(['likes' => 1]);

        $this->assertEquals(1, $post->fresh()->likes);
    }
}
