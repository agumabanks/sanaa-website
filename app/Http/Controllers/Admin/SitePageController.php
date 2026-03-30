<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SitePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SitePageController extends Controller
{
    public function index(Request $request)
    {
        $query = SitePage::query();

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->published();
            } elseif ($request->status === 'draft') {
                $query->draft();
            }
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        $pages = $query->orderByDesc('updated_at')->paginate(15)->withQueryString();

        // Stats
        $stats = [
            'total' => SitePage::count(),
            'published' => SitePage::published()->count(),
            'draft' => SitePage::draft()->count(),
        ];

        $templates = SitePage::templates();

        return view('admin.pages.index', compact('pages', 'stats', 'templates'));
    }

    public function create()
    {
        $templates = SitePage::templates();
        $blockTypes = SitePage::blockTypes();

        return view('admin.pages.create', compact('templates', 'blockTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|regex:/^[a-z0-9\-]+$/|unique:site_pages,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'blocks' => 'nullable|json',
            'template' => 'nullable|string|in:default,full-width,landing,sidebar',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_image' => 'nullable|image|max:2048',
            'status' => 'boolean',
            'show_header' => 'boolean',
            'show_footer' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Parse blocks JSON
        if (!empty($validated['blocks'])) {
            $validated['blocks'] = json_decode($validated['blocks'], true);
        }

        if ($request->hasFile('meta_image')) {
            $path = $request->file('meta_image')->store('seo-images', 'public');
            $validated['meta_image'] = '/storage/' . $path;
        }

        $validated['created_by'] = Auth::id();
        $validated['last_updated_by'] = Auth::id();

        if ($validated['status'] ?? false) {
            $validated['published_at'] = now();
        }

        $page = SitePage::create($validated);

        Cache::forget("site_page_{$page->slug}");

        return redirect()->route('dashboard.pages.index')->with('success', 'Page created successfully');
    }

    public function edit(SitePage $page)
    {
        $templates = SitePage::templates();
        $blockTypes = SitePage::blockTypes();

        return view('admin.pages.edit', compact('page', 'templates', 'blockTypes'));
    }

    public function builder(SitePage $page)
    {
        $templates = SitePage::templates();
        $blockTypes = SitePage::blockTypes();

        return view('admin.pages.builder', compact('page', 'templates', 'blockTypes'));
    }

    public function update(Request $request, SitePage $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|regex:/^[a-z0-9\-]+$/|unique:site_pages,slug,' . $page->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'blocks' => 'nullable|json',
            'template' => 'nullable|string|in:default,full-width,landing,sidebar',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_image' => 'nullable|image|max:2048',
            'status' => 'boolean',
            'show_header' => 'boolean',
            'show_footer' => 'boolean',
        ]);

        $oldSlug = $page->slug;

        // Parse blocks JSON
        if (!empty($validated['blocks'])) {
            $validated['blocks'] = json_decode($validated['blocks'], true);
        }

        if ($request->hasFile('meta_image')) {
            if ($page->meta_image && file_exists(public_path(str_replace('/storage', 'storage', $page->meta_image)))) {
                unlink(public_path(str_replace('/storage', 'storage', $page->meta_image)));
            }

            $path = $request->file('meta_image')->store('seo-images', 'public');
            $validated['meta_image'] = '/storage/' . $path;
        }

        $validated['last_updated_by'] = Auth::id();

        // Set published_at if transitioning to published
        if (($validated['status'] ?? false) && !$page->status) {
            $validated['published_at'] = now();
        }

        $page->update($validated);

        Cache::forget("site_page_{$oldSlug}");
        Cache::forget("site_page_{$page->slug}");

        $redirectRoute = $request->input('redirect_to', 'dashboard.pages.index');
        if ($redirectRoute === 'builder') {
            return redirect()->route('dashboard.pages.builder', $page)->with('success', 'Page updated successfully');
        }

        return redirect()->route('dashboard.pages.index')->with('success', 'Page updated successfully');
    }

    public function updateBlocks(Request $request, SitePage $page)
    {
        $validated = $request->validate([
            'blocks' => 'required|array',
        ]);

        $page->update([
            'blocks' => $validated['blocks'],
            'last_updated_by' => Auth::id(),
        ]);

        Cache::forget("site_page_{$page->slug}");

        return response()->json(['success' => true, 'message' => 'Blocks updated successfully']);
    }

    public function destroy(SitePage $page)
    {
        Cache::forget("site_page_{$page->slug}");
        $page->delete();
        return redirect()->route('dashboard.pages.index')->with('success', 'Page deleted successfully');
    }

    public function duplicate(SitePage $page)
    {
        $newPage = $page->duplicate();

        return redirect()->route('dashboard.pages.edit', $newPage)->with('success', 'Page duplicated successfully');
    }

    public function toggleStatus(SitePage $page)
    {
        if ($page->status) {
            $page->unpublish();
            $message = "Page \"{$page->title}\" has been unpublished.";
        } else {
            $page->publish();
            $message = "Page \"{$page->title}\" has been published.";
        }

        Cache::forget("site_page_{$page->slug}");

        return back()->with('success', $message);
    }
}
