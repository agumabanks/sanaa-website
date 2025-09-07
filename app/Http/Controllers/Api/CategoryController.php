<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogCategory::query();

        if ($request->boolean('active', true)) {
            $query->where('is_active', true);
        }

        // Count only published blogs per category
        $query->withCount(['blogs as blogs_count' => function ($q) {
            $q->published();
        }])->orderByDesc('blogs_count')->orderBy('name');

        $categories = $query->get();
        return CategoryResource::collection($categories);
    }
}

