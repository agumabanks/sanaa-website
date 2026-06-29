<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BusinessCategory;
use Illuminate\Http\Request;

class BusinessCategoryController extends Controller
{
    public function store(Request $request)
    {
        $type = $request->input('type', 'business');

        if ($type === 'blog') {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
                'color' => ['nullable', 'string', 'max:20'],
                'is_active' => ['nullable', 'boolean'],
            ]);

            BlogCategory::create([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'color' => $data['color'] ?? null,
                'is_active' => (bool) ($data['is_active'] ?? true),
            ]);
        } else {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
            ]);

            BusinessCategory::create($data);
        }

        return redirect()->route('dashboard.categories')->with('success', 'Category created');
    }

    public function update(Request $request, string $type, int $category)
    {
        if ($type === 'blog') {
            $model = BlogCategory::findOrFail($category);
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
                'color' => ['nullable', 'string', 'max:20'],
                'is_active' => ['nullable', 'boolean'],
            ]);

            $model->update([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'color' => $data['color'] ?? null,
                'is_active' => (bool) ($data['is_active'] ?? false),
            ]);
        } else {
            $model = BusinessCategory::findOrFail($category);
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
            ]);

            $model->update($data);
        }

        return redirect()->route('dashboard.categories')->with('success', 'Category updated');
    }
}
