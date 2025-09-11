<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class PolicyController extends Controller
{
    public function show(Request $request, string $key)
    {
        $policy = Cache::remember("policy_{$key}", 3600, function () use ($key) {
            return Policy::where('key', $key)->where('status', true)->firstOrFail();
        });

        // SEO data
        $seoData = [
            'title' => $policy->meta_title ?: ($policy->title . ' | Sanaa'),
            'description' => $policy->meta_description ?: $policy->excerpt,
            'keywords' => $policy->meta_keywords,
            'url' => $policy->url,
            'last_modified' => $policy->updated_at->toISOString()
        ];

        return view('pages.policy_show', compact('policy', 'seoData'));
    }

    public function index(Request $request)
    {
        $category = $request->get('category');
        $search = $request->get('search');

        $query = Policy::active();

        if ($category) {
            $query->byCategory($category);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $policies = $query->ordered()->get()->groupBy('category');
        $categories = Policy::getCategories();

        return view('pages.policies_index', compact('policies', 'categories', 'category', 'search'));
    }

    // Admin methods
    public function adminIndex(Request $request)
    {
        $category = $request->get('category');
        $search = $request->get('search');

        $query = Policy::query();

        if ($category) {
            $query->byCategory($category);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $policies = $query->ordered()->paginate(15);
        $categories = Policy::getCategories();

        return view('dashboard.policies', compact('policies', 'categories', 'category', 'search'));
    }

    public function adminCreate()
    {
        $categories = Policy::getCategories();
        return view('dashboard.policy-create', compact('categories'));
    }

    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:policies,key',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category' => 'required|string|in:' . implode(',', array_keys(Policy::getCategories())),
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'boolean',
            'order' => 'nullable|integer|min:1'
        ]);

        $validated['last_updated_by'] = Auth::id();

        Policy::create($validated);

        // Clear cache
        Cache::forget("policy_{$validated['key']}");

        return redirect()->route('dashboard.policies')->with('success', 'Policy created successfully');
    }

    public function adminEdit(Policy $policy)
    {
        $categories = Policy::getCategories();
        return view('dashboard.policy-edit', compact('policy', 'categories'));
    }

    public function adminUpdate(Request $request, Policy $policy)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:policies,key,' . $policy->id,
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category' => 'required|string|in:' . implode(',', array_keys(Policy::getCategories())),
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'boolean',
            'order' => 'nullable|integer|min:1'
        ]);

        $validated['last_updated_by'] = Auth::id();

        $policy->update($validated);

        // Clear cache
        Cache::forget("policy_{$policy->key}");
        if ($policy->key !== $validated['key']) {
            Cache::forget("policy_{$validated['key']}");
        }

        return redirect()->route('dashboard.policies')->with('success', 'Policy updated successfully');
    }

    public function adminDestroy(Policy $policy)
    {
        // Clear cache
        Cache::forget("policy_{$policy->key}");

        $policy->delete();

        return redirect()->route('dashboard.policies')->with('success', 'Policy deleted successfully');
    }

    public function adminBulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'policies' => 'required|array',
            'policies.*.id' => 'required|exists:policies,id',
            'policies.*.order' => 'nullable|integer|min:1',
            'policies.*.status' => 'boolean'
        ]);

        foreach ($validated['policies'] as $policyData) {
            Policy::where('id', $policyData['id'])->update([
                'order' => $policyData['order'] ?? null,
                'status' => $policyData['status'] ?? true,
                'last_updated_by' => Auth::id()
            ]);
        }

        // Clear all policy caches
        // Policy count is modest (<100), cache the list of keys for an hour
        $policyKeys = Cache::remember('policy_keys', 3600, fn() => Policy::pluck('key'));
        foreach ($policyKeys as $key) {
            Cache::forget("policy_{$key}");
        }
        Cache::forget('policy_keys');

        return response()->json(['success' => true, 'message' => 'Policies updated successfully']);
    }

    // Legacy method for backward compatibility
    public function update(Request $request, string $key)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'title' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255'
        ]);

        $policy = Policy::updateOrCreate(
            ['key' => $key],
            array_merge($validated, [
                'title' => $validated['title'] ?? ucwords(str_replace('-', ' ', $key)),
                'last_updated_by' => Auth::id()
            ])
        );

        // Clear cache
        Cache::forget("policy_{$key}");

        return redirect()->route('dashboard.policies')->with('success', 'Policy updated successfully');
    }
}
