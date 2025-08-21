<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_published_posts_without_published_date()
    {
        $post = Blog::factory()->create([
            'title' => 'Missing Date Post',
            'status' => 'published',
            'published_at' => null,
        ]);

        $response = $this->get(route('blog.index'));

        $response->assertOk();
        $response->assertSee('Missing Date Post');
    }
}
