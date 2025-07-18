<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
 

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

        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        Blog::create($data);

        return redirect()->route('dashboard.blog')->with('status', 'Blog post created');
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title' => 'required',
            'excerpt' => 'nullable',
            'body' => 'required',
            'image' => 'nullable|image',
        ]);

        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        $blog->update($data);

        return redirect()->route('dashboard.blog')->with('status', 'Blog post updated');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return redirect()->route('dashboard.blog')->with('status', 'Blog post deleted');
    }
}
