<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::orderByDesc('created_at')->paginate(10);
        return view('blog.index', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Blog::where('slug', $slug)->firstOrFail();
        return view('blog.show', compact('post'));
    }
}
