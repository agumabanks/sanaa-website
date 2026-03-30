@php($page = $page ?? null)
<label class="block text-sm">Title
    <input name="title" value="{{ old('title', $page->title ?? '') }}" required class="mt-1 w-full rounded border-gray-300">
    @error('title')<div class="text-red-700 text-sm">{{ $message }}</div>@enderror
</label>
<label class="block text-sm">Slug
    <input name="slug" value="{{ old('slug', $page->slug ?? '') }}" required class="mt-1 w-full rounded border-gray-300">
    @error('slug')<div class="text-red-700 text-sm">{{ $message }}</div>@enderror
</label>
<label class="block text-sm">Status
    <select name="status" class="mt-1 w-full rounded border-gray-300">
        @foreach(['draft','review','published'] as $s)
            <option value="{{ $s }}" @selected(old('status', $page->status ?? 'draft')==$s)>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
</label>
<div class="grid grid-cols-2 gap-4">
    <label class="block text-sm">SEO Title
        <input name="seo_title" value="{{ old('seo_title', $page->seo_title ?? '') }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="block text-sm">Canonical URL
        <input name="canonical_url" value="{{ old('canonical_url', $page->canonical_url ?? '') }}" class="mt-1 w-full rounded border-gray-300" placeholder="https://...">
    </label>
</div>
<label class="block text-sm">Meta Description
    <textarea name="meta_description" rows="2" class="mt-1 w-full rounded border-gray-300">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
</label>
<div class="grid grid-cols-2 gap-4">
    <label class="block text-sm">OG Image (path or URL)
        <input name="og_image" value="{{ old('og_image', $page->og_image ?? '') }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="block text-sm">Schema Type
        <input name="schema_type" value="{{ old('schema_type', $page->schema_type ?? '') }}" class="mt-1 w-full rounded border-gray-300" placeholder="Article, WebPage...">
    </label>
</div>
<div class="grid grid-cols-2 gap-4">
    <label class="block text-sm">Scheduled At
        <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at', optional($page?->scheduled_at)->format('Y-m-d\TH:i')) }}" class="mt-1 w-full rounded border-gray-300">
    </label>
    <label class="block text-sm">Indexing
        <select name="is_indexed" class="mt-1 w-full rounded border-gray-300">
            <option value="1" @selected(old('is_indexed', ($page->is_indexed ?? true))==true)>Index</option>
            <option value="0" @selected(old('is_indexed', ($page->is_indexed ?? true))==false)>Noindex</option>
        </select>
    </label>
    
</div>
<label class="block text-sm">Content (HTML)
    <textarea name="content_html" rows="10" class="mt-1 w-full rounded border-gray-300">{{ old('content_html', collect($page->content['blocks'] ?? [])->map(fn($b)=>$b['html'] ?? '')->implode("\n\n")) }}</textarea>
</label>
