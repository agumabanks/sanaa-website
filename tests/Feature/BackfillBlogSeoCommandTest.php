<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BackfillBlogSeoCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_backfills_missing_seo_fields_from_blog_content(): void
    {
        $category = BlogCategory::create([
            'name' => 'Digital Growth',
            'is_active' => true,
        ]);

        $tag = BlogTag::create(['name' => 'Content Marketing']);

        $blog = Blog::factory()->create([
            'title' => 'Practical content systems for ambitious Uganda brands',
            'category_id' => $category->id,
            'excerpt' => null,
            'body' => '<p>Content marketing helps Uganda brands build trust, win qualified leads, and improve search visibility.</p><p>These practical systems turn editorial planning into repeatable growth for ambitious teams.</p>',
            'meta_title' => null,
            'meta_description' => null,
            'keywords' => null,
            'reading_time' => null,
        ]);

        $blog->tags()->attach($tag->id);

        $this->artisan('blog:backfill-seo')
            ->expectsOutputToContain('SEO backfill complete. 1 blog(s) updated.')
            ->assertSuccessful();

        $blog->refresh();

        $this->assertNotEmpty($blog->meta_title);
        $this->assertNotEmpty($blog->meta_description);
        $this->assertNotEmpty($blog->keywords);
        $this->assertNotEmpty($blog->excerpt);
        $this->assertNotNull($blog->reading_time);
        $this->assertStringContainsString('Content Marketing', $blog->keywords);
        $this->assertLessThanOrEqual(60, strlen($blog->meta_title));
        $this->assertLessThanOrEqual(160, strlen($blog->meta_description));
    }

    public function test_it_keeps_existing_seo_data_unless_forced(): void
    {
        $blog = Blog::factory()->create([
            'title' => 'Original title for a product launch',
            'body' => '<p>This launch story explains how teams improve distribution and audience reach with structured content.</p>',
            'meta_title' => 'Hand written SEO title',
            'meta_description' => 'Hand written meta description that should remain exactly in place without overwrite.',
            'keywords' => 'manual, keywords',
            'excerpt' => 'Manual excerpt',
            'reading_time' => 9,
        ]);

        $this->artisan('blog:backfill-seo')
            ->expectsOutputToContain('No blogs require SEO backfill.')
            ->assertSuccessful();

        $blog->refresh();

        $this->assertSame('Hand written SEO title', $blog->meta_title);
        $this->assertSame('Hand written meta description that should remain exactly in place without overwrite.', $blog->meta_description);
        $this->assertSame('manual, keywords', $blog->keywords);
        $this->assertSame('Manual excerpt', $blog->excerpt);
        $this->assertSame(9, $blog->reading_time);
    }

    public function test_it_overwrites_existing_seo_when_force_is_used(): void
    {
        $category = BlogCategory::create([
            'name' => 'Operations',
            'is_active' => true,
        ]);

        $blog = Blog::factory()->create([
            'title' => 'Operational discipline for scaling service teams',
            'category_id' => $category->id,
            'body' => '<p>Operational discipline helps service teams standardize delivery, improve response times, and increase margin.</p><p>Documented workflows make scaling less chaotic and more predictable.</p>',
            'meta_title' => 'Old title',
            'meta_description' => 'Old description',
            'keywords' => 'old, keywords',
            'excerpt' => 'Old excerpt',
            'reading_time' => 1,
        ]);

        $this->artisan('blog:backfill-seo --force')
            ->expectsOutputToContain('SEO backfill complete. 1 blog(s) updated.')
            ->assertSuccessful();

        $blog->refresh();

        $this->assertNotSame('Old title', $blog->meta_title);
        $this->assertNotSame('Old description', $blog->meta_description);
        $this->assertNotSame('old, keywords', $blog->keywords);
        $this->assertNotSame('Old excerpt', $blog->excerpt);
        $this->assertGreaterThanOrEqual(1, $blog->reading_time);
        $this->assertStringContainsString('Operations', $blog->keywords);
    }
}
