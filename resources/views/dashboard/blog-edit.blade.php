<x-dashboard-layout title="Edit Blog Post">
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <div>
                <h2 class="font-semibold text-xl text-gray-900 leading-tight">Edit Blog Post</h2>
                <p class="text-sm text-gray-500 mt-1">Refine your insight with Medium-style editing and live optimization.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard.blog.manage') }}" class="inline-flex items-center gap-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium py-2 px-3">
                    Back to Manage
                </a>
                <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="inline-flex items-center gap-2 rounded-lg bg-gray-800 hover:bg-black text-white text-sm font-medium py-2 px-3">
                    View Live
                </a>
            </div>
        </div>
    </x-slot>

    @php
        $categories = $categories ?? \App\Models\BlogCategory::orderBy('name')->get();
        $tags = \App\Models\BlogTag::orderBy('name')->get();
        $selectedTags = collect(old('tags', $blog->tags->pluck('id')->all()))->map(fn ($id) => (int) $id)->all();
    @endphp

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-900 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 text-red-900 px-4 py-3">
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                id="editorForm"
                method="POST"
                action="{{ route('dashboard.blog.update', $blog) }}"
                enctype="multipart/form-data"
                class="grid grid-cols-1 xl:grid-cols-3 gap-6"
                data-blog-editor-form
                data-draft-key="sanaa_blog_edit_{{ $blog->id }}"
                data-autosave-url="{{ route('api.blogs.autosave', $blog) }}"
                data-ai-url="{{ route('api.blogs.ai', $blog) }}"
                data-seo-url="{{ route('api.blogs.seo', $blog) }}"
                data-image-upload-url="{{ route('dashboard.blog.media') }}"
            >
                @csrf
                @method('PUT')
                <input type="hidden" name="content_json" id="content_json" value="{{ old('content_json', $blog->content_json ? json_encode($blog->content_json) : '') }}">

                <section class="xl:col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 space-y-4">
                        <div>
                            <label for="title" class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Title</label>
                            <input
                                id="title"
                                name="title"
                                type="text"
                                required
                                value="{{ old('title', $blog->title) }}"
                                class="mt-2 w-full border-0 p-0 text-3xl font-semibold text-gray-900 placeholder:text-gray-300 focus:ring-0"
                            >
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="slug" class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Slug</label>
                                <input
                                    id="slug"
                                    name="slug"
                                    type="text"
                                    value="{{ old('slug', $blog->slug) }}"
                                    class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 text-sm focus:ring-emerald-400 focus:border-emerald-400"
                                >
                            </div>
                            <div>
                                <label for="excerpt" class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Excerpt</label>
                                <textarea
                                    id="excerpt"
                                    name="excerpt"
                                    rows="2"
                                    class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-sm text-gray-900 focus:ring-emerald-400 focus:border-emerald-400"
                                >{{ old('excerpt', $blog->excerpt) }}</textarea>
                                <p id="excerpt-count" class="mt-1 text-xs text-gray-500">0/180</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <div id="tiptap-editor-mount" class="tiptap-editor-wrapper"></div>
                        <textarea id="body" name="body" class="hidden">{{ old('body', $blog->body) }}</textarea>

                        <div class="flex flex-wrap items-center justify-between gap-3 text-xs text-gray-500">
                            <div class="flex items-center gap-3">
                                <span><strong id="editor-word-count">0</strong> words</span>
                                <span class="w-1 h-1 rounded-full bg-gray-400"></span>
                                <span><strong id="editor-read-time">1</strong> min read</span>
                            </div>
                            <span id="editor-autosave-status">Autosave active</span>
                        </div>
                    </div>
                </section>

                <aside class="space-y-6">
                    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 space-y-4">
                        <h3 class="font-semibold text-gray-900">Publishing</h3>

                        <div>
                            <label for="status" class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Status</label>
                            <select id="status" name="status" class="mt-2 w-full rounded-lg border border-gray-300 text-sm focus:ring-emerald-400 focus:border-emerald-400">
                                <option value="draft" @selected(old('status', $blog->status) === 'draft')>Draft</option>
                                <option value="published" @selected(old('status', $blog->status) === 'published')>Published</option>
                            </select>
                        </div>

                        <div>
                            <label for="published_at" class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Schedule</label>
                            <input
                                type="datetime-local"
                                id="published_at"
                                name="published_at"
                                value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d\TH:i')) }}"
                                class="mt-2 w-full rounded-lg border border-gray-300 text-sm focus:ring-emerald-400 focus:border-emerald-400"
                            >
                        </div>

                        <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" name="featured" value="1" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-400" @checked(old('featured', $blog->featured))>
                            Feature this insight
                        </label>
                    </section>

                    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 space-y-4">
                        <h3 class="font-semibold text-gray-900">Taxonomy</h3>

                        <div>
                            <label for="category_id" class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Category</label>
                            <select id="category_id" name="category_id" class="mt-2 w-full rounded-lg border border-gray-300 text-sm focus:ring-emerald-400 focus:border-emerald-400">
                                <option value="">No category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $blog->category_id) == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="tags" class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Tags</label>
                            <select id="tags" name="tags[]" multiple class="mt-2 w-full rounded-lg border border-gray-300 text-sm min-h-[130px] focus:ring-emerald-400 focus:border-emerald-400">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" @selected(in_array($tag->id, $selectedTags, true))>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Use Ctrl/Cmd to select multiple tags.</p>
                        </div>
                    </section>

                    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 space-y-4">
                        <h3 class="font-semibold text-gray-900">Featured Image</h3>
                        <input id="featured_image" name="featured_image" type="file" accept="image/*" class="block w-full text-sm text-gray-700">
                        <img
                            id="featured-image-preview"
                            alt="Featured preview"
                            src="{{ $blog->featured_image ? cdn_storage($blog->featured_image) : '' }}"
                            class="{{ $blog->featured_image ? '' : 'hidden' }} w-full h-40 object-cover rounded-lg border border-gray-200"
                        >
                    </section>

                    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 space-y-4">
                        <h3 class="font-semibold text-gray-900">Writing Tools</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="button" data-editor-command="heading" class="rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Section Heading</button>
                            <button type="button" data-editor-command="quote" class="rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Pull Quote</button>
                            <button type="button" data-editor-command="divider" class="rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Divider</button>
                            <button type="button" data-editor-command="image" class="rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Insert Photo</button>
                        </div>
                        <p class="text-xs text-gray-500">Drop images into the editor, paste screenshots, or upload from the image tool to update the story inline.</p>
                    </section>

                    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 space-y-4">
                        <h3 class="font-semibold text-gray-900">SEO</h3>

                        <div>
                            <label for="meta_title" class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Meta Title</label>
                            <input
                                id="meta_title"
                                name="meta_title"
                                type="text"
                                value="{{ old('meta_title', $blog->meta_title) }}"
                                class="mt-2 w-full rounded-lg border border-gray-300 text-sm focus:ring-emerald-400 focus:border-emerald-400"
                            >
                            <p id="meta-title-count" class="mt-1 text-xs text-gray-500">0/60</p>
                        </div>

                        <div>
                            <label for="meta_description" class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Meta Description</label>
                            <textarea
                                id="meta_description"
                                name="meta_description"
                                rows="3"
                                class="mt-2 w-full rounded-lg border border-gray-300 text-sm focus:ring-emerald-400 focus:border-emerald-400"
                            >{{ old('meta_description', $blog->meta_description) }}</textarea>
                            <p id="meta-description-count" class="mt-1 text-xs text-gray-500">0/160</p>
                        </div>

                        <div>
                            <label for="keywords" class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Keywords</label>
                            <input
                                id="keywords"
                                name="keywords"
                                type="text"
                                value="{{ old('keywords', $blog->keywords) }}"
                                class="mt-2 w-full rounded-lg border border-gray-300 text-sm focus:ring-emerald-400 focus:border-emerald-400"
                            >
                        </div>

                        <div class="rounded-lg border border-gray-200 p-3 bg-gray-50">
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-medium text-gray-700">SEO Score</span>
                                <span id="seo-score-value" class="font-semibold text-gray-900">0/100</span>
                            </div>
                            <div class="mt-2 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div id="seo-score-bar" class="h-full bg-emerald-500" style="width: 0%"></div>
                            </div>
                            <ul id="seo-recommendations" class="mt-3 list-disc list-inside text-xs text-gray-600 space-y-1">
                                <li>Start writing to get recommendations.</li>
                            </ul>
                        </div>
                    </section>

                    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold text-gray-900">AI Suggestions</h3>
                            <button type="button" id="refresh-ai-suggestions" class="text-xs px-2 py-1 rounded bg-gray-900 text-white">Refresh</button>
                        </div>
                        <div id="ai-suggestions-panel" class="text-sm text-gray-700 space-y-2">
                            <p>No suggestions loaded yet.</p>
                        </div>
                    </section>

                    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold text-gray-900">Server SEO Analysis</h3>
                            <button type="button" id="refresh-seo-analysis" class="text-xs px-2 py-1 rounded bg-gray-900 text-white">Run</button>
                        </div>
                        <div id="seo-analysis-panel" class="text-sm text-gray-700 space-y-2">
                            <p>Run analysis to view backend recommendations.</p>
                        </div>
                    </section>
                </aside>

                <div class="xl:col-span-3 bg-white rounded-2xl border border-gray-200 shadow-sm p-4 flex flex-wrap items-center justify-between gap-3">
                    <p class="text-sm text-gray-500">Autosave keeps snapshots while you edit.</p>
                    <div class="flex items-center gap-2">
                        <button type="button" data-set-status="draft" class="inline-flex items-center rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium py-2 px-4">
                            Save as Draft
                        </button>
                        <button type="button" data-set-status="published" class="inline-flex items-center rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium py-2 px-4">
                            Update & Publish
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @vite(['resources/css/tiptap-editor.css', 'resources/js/tiptap-editor.js', 'resources/js/blog-admin-editor.js'])
</x-dashboard-layout>
