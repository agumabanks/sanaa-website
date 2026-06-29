<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeveloperPlatformsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_developer_platforms_page_includes_blog_api_docs(): void
    {
        $this->get(route('developer-platforms'))
            ->assertOk()
            ->assertSeeText('Sanaa Blog Syndication API')
            ->assertSee('/api/v1/insights', false)
            ->assertSee('/api/v1/insights/latest', false)
            ->assertSee('/api/v1/insights/manifest', false)
            ->assertSeeText('Query Parameters')
            ->assertSeeText('Sample Payload');
    }
}
