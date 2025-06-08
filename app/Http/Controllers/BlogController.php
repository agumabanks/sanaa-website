<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'excerpt' => 'nullable',
            'body' => 'required',
            'image' => 'nullable|image',
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        Blog::create($data);

        return redirect()->route('dashboard')->with('status', 'Blog post created');
    }
}
