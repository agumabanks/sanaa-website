<x-dashboard-layout title="Write a Story">
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">Write</h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard.my-posts') }}" class="inline-flex items-center gap-2 rounded-lg bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium py-2 px-3">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M3 6h18v2H3V6zm0 5h12v2H3v-2zm0 5h18v2H3v-2z"/></svg>
                    My Posts
                </a>
            </div>
        </div>
    </x-slot>

    @php(
        $categories = $categories ?? \App\Models\BlogCategory::orderBy('name')->get()
    )

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 text-red-900 px-4 py-3">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                <form method="POST" action="{{ route('dashboard.posts.store') }}" enctype="multipart/form-data" class="xl:col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm">
                    @csrf
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Compose</h3>
                        <p class="text-sm text-gray-500 mt-1">Write your story. Keep it clear and focused.</p>
                    </div>

                    <div class="p-6 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input id="title" name="title" type="text" required value="{{ old('title') }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700">Slug (optional)</label>
                                <input id="slug" name="slug" type="text" placeholder="auto-generated if empty" value="{{ old('slug') }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                            </div>
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="category_id" name="category_id" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">
                                    <option value="">None</option>
                                    @foreach($categories as $c)
                                        <option value="{{ $c->id }}" @selected(old('category_id') == $c->id)>{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt</label>
                            <textarea id="excerpt" name="excerpt" rows="3" placeholder="Short summary (max 160 characters for SEO)" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">{{ old('excerpt') }}</textarea>
                        </div>

                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                            <textarea id="body" name="body" rows="12" required placeholder="Write your story here..." class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 p-3">{{ old('body') }}</textarea>
                            <div class="mt-2 flex items-center gap-3 text-xs text-gray-500">
                                <span><span id="bodyWords">0</span> words</span>
                                <span>•</span>
                                <span><span id="bodyMinutes">1</span> min read</span>
                            </div>
                        </div>

                        <div>
                            <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                            <input id="featured_image" name="featured_image" type="file" accept="image/*" class="mt-2 block w-full text-sm text-gray-900 file:mr-3 file:py-2.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">
                                    <option value="draft" @selected(old('status') === 'draft')>Draft</option>
                                    <option value="published" @selected(old('status') === 'published')>Published</option>
                                </select>
                            </div>
                            <div>
                                <label for="published_at" class="block text-sm font-medium text-gray-700">Publish Date (optional)</label>
                                <input id="published_at" name="published_at" type="datetime-local" value="{{ old('published_at') }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                                <input id="meta_title" name="meta_title" type="text" value="{{ old('meta_title') }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                            </div>
                            <div>
                                <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                                <input id="meta_description" name="meta_description" type="text" value="{{ old('meta_description') }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-100 bg-gray-50 flex items-center justify-end gap-3">
                        <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-black hover:bg-gray-900 text-white text-sm font-medium py-2 px-3">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            Publish / Save
                        </button>
                    </div>
                </form>

                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Live Preview</h3>
                    <div class="space-y-3">
                        <div class="text-2xl font-semibold text-gray-900" id="previewTitle">Your title appears here</div>
                        <div class="text-sm text-gray-500" id="previewExcerpt">A short summary of your article.</div>
                        <div class="aspect-video rounded-lg border border-gray-200 bg-gray-50 overflow-hidden" id="previewImageWrap">
                            <img id="previewImage" class="w-full h-full object-cover hidden" alt="Preview" />
                        </div>
                        <div class="prose max-w-none" id="previewBody"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const excerpt = document.getElementById('excerpt');
        const titleEl = document.getElementById('title');
        const bodyEl = document.getElementById('body');
        const wordsEl = document.getElementById('bodyWords');
        const minsEl = document.getElementById('bodyMinutes');
        const previewTitle = document.getElementById('previewTitle');
        const previewExcerpt = document.getElementById('previewExcerpt');
        const previewBody = document.getElementById('previewBody');
        function updateBodyStats() {
            const text = (bodyEl?.value || '').replace(/<[^>]*>?/gm, ' ');
            const wc = text.trim() ? text.trim().split(/\s+/).length : 0;
            if (wordsEl) wordsEl.textContent = wc;
            if (minsEl) minsEl.textContent = Math.max(1, Math.ceil(wc/200));
        }
        function updatePreview() {
            if (previewTitle && titleEl) previewTitle.textContent = titleEl.value || 'Your title appears here';
            if (previewExcerpt && excerpt) previewExcerpt.textContent = excerpt.value || 'A short summary of your article.';
            if (previewBody && bodyEl) {
                const text = bodyEl.value || '';
                previewBody.innerHTML = text ? text.replace(/\n/g, '<br>') : '';
            }
        }
        bodyEl?.addEventListener('input', () => { updateBodyStats(); updatePreview(); });
        titleEl?.addEventListener('input', updatePreview);
        excerpt?.addEventListener('input', updatePreview);
        updateBodyStats();
        updatePreview();

        // Featured image preview
        const fi = document.getElementById('featured_image');
        const previewImg = document.getElementById('previewImage');
        if (fi && previewImg) {
            fi.addEventListener('change', (e) => {
                const file = e.target.files?.[0];
                if (!file) return;
                const url = URL.createObjectURL(file);
                previewImg.src = url;
                previewImg.classList.remove('hidden');
            });
        }
    </script>
    @endpush
</x-dashboard-layout>

