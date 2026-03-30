<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\FinancePage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('finance');
    }

    public function index()
    {
        $pages = FinancePage::orderByDesc('created_at')->paginate(15);
        return view('admin.finance.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.finance.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|alpha_dash|unique:finance_pages,slug',
            'status' => 'required|in:draft,review,published',
            'seo_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'canonical_url' => 'nullable|url',
            'og_image' => 'nullable|string|max:255',
            'schema_type' => 'nullable|string|max:255',
            'is_indexed' => 'boolean',
            'scheduled_at' => 'nullable|date',
            'content_html' => 'nullable|string',
        ]);

        $content = null;
        if (!empty($validated['content_html'])) {
            $content = ['blocks' => [ ['type' => 'richtext', 'html' => $validated['content_html']] ]];
        }

        $page = FinancePage::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'status' => $validated['status'],
            'seo_title' => $validated['seo_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'canonical_url' => $validated['canonical_url'] ?? null,
            'og_image' => $validated['og_image'] ?? null,
            'schema_type' => $validated['schema_type'] ?? null,
            'is_indexed' => $validated['is_indexed'] ?? true,
            'scheduled_at' => $validated['scheduled_at'] ?? null,
            'content' => $content,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('admin.finance.pages.edit', $page)->with('success', 'Finance page created.');
    }

    public function show(FinancePage $page)
    {
        return view('admin.finance.pages.show', compact('page'));
    }

    public function edit(FinancePage $page)
    {
        return view('admin.finance.pages.edit', compact('page'));
    }

    public function update(Request $request, FinancePage $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|alpha_dash|unique:finance_pages,slug,' . $page->id,
            'status' => 'required|in:draft,review,published',
            'seo_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'canonical_url' => 'nullable|url',
            'og_image' => 'nullable|string|max:255',
            'schema_type' => 'nullable|string|max:255',
            'is_indexed' => 'boolean',
            'scheduled_at' => 'nullable|date',
            'content_html' => 'nullable|string',
        ]);

        $content = $page->content;
        if (array_key_exists('content_html', $validated)) {
            $html = $validated['content_html'] ?? '';
            $content = $html !== '' ? ['blocks' => [ ['type' => 'richtext', 'html' => $html] ]] : null;
        }

        $page->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'status' => $validated['status'],
            'seo_title' => $validated['seo_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'canonical_url' => $validated['canonical_url'] ?? null,
            'og_image' => $validated['og_image'] ?? null,
            'schema_type' => $validated['schema_type'] ?? null,
            'is_indexed' => $validated['is_indexed'] ?? true,
            'scheduled_at' => $validated['scheduled_at'] ?? null,
            'content' => $content,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('admin.finance.pages.edit', $page)->with('success', 'Finance page updated.');
    }

    public function destroy(FinancePage $page)
    {
        $page->delete();
        return redirect()->route('admin.finance.pages.index')->with('success', 'Finance page deleted.');
    }
}
