<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsightApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_insights_index_returns_only_published_posts(): void
    {
        $published = Blog::factory()->create([
            'title' => 'Published Insight',
            'status' => 'published',
            'published_at' => now()->subHour(),
        ]);

        Blog::factory()->create([
            'title' => 'Draft Insight',
            'status' => 'draft',
        ]);

        $response = $this->getJson('/api/v1/insights');

        $response->assertOk();
        $response->assertJsonPath('meta.total', 1);
        $response->assertJsonPath('data.0.slug', $published->slug);
    }

    public function test_insight_detail_can_return_plain_text_body(): void
    {
        $post = Blog::factory()->create([
            'status' => 'published',
            'published_at' => now()->subDay(),
            'body' => '<h2>Hello</h2><p>Insights body.</p>',
        ]);

        $response = $this->getJson("/api/v1/insights/{$post->slug}?include=body&format=text");

        $response->assertOk();
        $response->assertJsonPath('data.slug', $post->slug);
        $response->assertJsonPath('data.body', 'Hello Insights body.');
    }

    public function test_latest_endpoint_respects_limit(): void
    {
        Blog::factory()->count(3)->create([
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        $response = $this->getJson('/api/v1/insights/latest?limit=2');

        $response->assertOk();
        $response->assertJsonCount(2, 'data');
    }

    public function test_manifest_includes_documentation_url(): void
    {
        $response = $this->getJson('/api/v1/insights/manifest');

        $response->assertOk();
        $response->assertJsonPath('documentation', route('developer-platforms'));
        $response->assertJsonPath('endpoints.feed_json', route('blog.feed.json'));
        $response->assertJsonPath('endpoints.feed_xml', route('blog.feed'));
    }
}
