<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogTag::query();

        // Count only published blogs per tag via pivot
        $query->withCount(['blogs as blogs_count' => function ($q) {
            $q->published();
        }])->orderByDesc('blogs_count')->orderBy('name');

        $tags = $query->get();
        return TagResource::collection($tags);
    }
}

