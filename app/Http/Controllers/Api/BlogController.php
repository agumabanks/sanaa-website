<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return Blog::select('id','title','slug','excerpt','created_at','views','likes','shares','saves')->orderByDesc('created_at')->get();
    }

    public function show(Blog $blog)
    {
        $blog->increment('views');
        return $blog;
    }

    public function like(Blog $blog)
    {
        $blog->increment('likes');
        return response()->json(['likes' => $blog->likes]);
    }

    public function share(Blog $blog)
    {
        $blog->increment('shares');
        return response()->json(['shares' => $blog->shares]);
    }

    public function save(Blog $blog)
    {
        $blog->increment('saves');
        return response()->json(['saves' => $blog->saves]);
    }
}
