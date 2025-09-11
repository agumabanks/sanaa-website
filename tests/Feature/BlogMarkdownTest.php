<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Support\Str;
use Tests\TestCase;

class BlogMarkdownTest extends TestCase
{
    public function test_blog_body_renders_markdown()
    {
        $post = new Blog([
            'body' => '**bold** _italic_',
        ]);

        $rendered = Str::markdown($post->body);

        $this->assertStringContainsString('<strong>bold</strong>', $rendered);
        $this->assertStringContainsString('<em>italic</em>', $rendered);
    }
}
