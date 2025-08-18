<?php

namespace Tests\Feature;

use App\Models\Blog;
use Tests\TestCase;

class BlogMarkdownTest extends TestCase
{
    public function test_blog_body_renders_markdown()
    {
        $post = new Blog([
            'title' => 'Markdown Post',
            'slug' => 'markdown-post',
            'body' => '**bold** _italic_',
        ]);

        $view = $this->view('blog.show', ['post' => $post]);

        $view->assertSee('<strong>bold</strong>', false);
        $view->assertSee('<em>italic</em>', false);
    }
}
