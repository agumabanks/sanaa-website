<x-dashboard-layout title="Blog">
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">Blog</h2>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input id="postSearch" type="text" placeholder="Search posts" class="w-64 rounded-lg border border-gray-300 bg-white text-sm py-2 pl-9 pr-3 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400" />
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
                </div>
                <a href="#create-post" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium py-2 px-3">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13H13v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    New Post
                </a>
            </div>
        </div>
    </x-slot>

    @php(
        $categories = \App\Models\BlogCategory::orderBy('name')->get()
    )
    @php($posts = \App\Models\Blog::orderByDesc('created_at')->get())

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if(session('success'))
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-900 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

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
                <!-- Composer -->
                <form id="create-post" method="POST" action="{{ route('dashboard.blog.store') }}" enctype="multipart/form-data" class="xl:col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm">
                    @csrf
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Create Blog Post</h3>
                        <p class="text-sm text-gray-500 mt-1">Minimal, focused, and precise. Keep it simple.</p>
                    </div>

                    <div class="p-6 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input id="title" name="title" type="text" required placeholder="A clear, concise title" value="{{ old('title') }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
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
                            <div class="mt-1 text-xs text-gray-500"><span id="excerptCount">0</span>/160</div>
                        </div>

                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
                            <textarea id="body" name="body" rows="12" required placeholder="Write beautifully. Supports HTML." class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-3 px-3 leading-7">{{ old('body') }}</textarea>
                            <div class="mt-1 text-xs text-gray-500"><span id="bodyWords">0</span> words • <span id="bodyMinutes">1</span> min read</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Featured Image</label>
                            <div class="mt-2 flex items-center gap-4">
                                <input type="file" name="featured_image" id="featured_image" accept="image/*" class="block w-full text-sm text-gray-700" />
                            </div>
                            <div id="featuredPreview" class="mt-3 hidden">
                                <img src="" alt="Preview" class="h-40 rounded-lg border border-gray-200 object-cover">
                            </div>
                        </div>

                        <input type="hidden" name="author_id" value="{{ auth()->id() }}" />

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">
                                    <option value="draft" @selected(old('status')==='draft')>Draft</option>
                                    <option value="published" @selected(old('status')==='published')>Published</option>
                                </select>
                            </div>
                            <div>
                                <label for="published_at" class="block text-sm font-medium text-gray-700">Publish At</label>
                                <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at') }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                            </div>
                            <div class="flex items-end">
                                <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                                    <input type="checkbox" name="featured" value="1" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-400" @checked(old('featured')) />
                                    Featured
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-3">
                                <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                                <input id="meta_title" name="meta_title" type="text" value="{{ old('meta_title') }}" placeholder="Defaults to post title" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                            </div>
                            <div class="md:col-span-3">
                                <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                                <textarea id="meta_description" name="meta_description" rows="2" placeholder="Up to 160 characters" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">{{ old('meta_description') }}</textarea>
                            </div>
                            <div class="md:col-span-3">
                                <label for="keywords" class="block text-sm font-medium text-gray-700">Keywords</label>
                                <input id="keywords" name="keywords" type="text" value="{{ old('keywords') }}" placeholder="comma,separated,keywords" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3 rounded-b-2xl">
                        <button type="submit" class="inline-flex items-center rounded-lg bg-emerald-600 text-white px-4 py-2.5 text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400">Save</button>
                    </div>
                </form>

                <!-- Live Preview -->
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

            @if($posts->count())
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm">
                    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Manage Posts</h3>
                        <span class="text-sm text-gray-500">{{ $posts->count() }} total</span>
                    </div>
                    <div class="divide-y divide-gray-100" id="postsList">
                        @foreach($posts as $post)
                        <div class="p-6" data-title="{{ strtolower($post->title) }}">
                            <div class="flex items-start gap-4">
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/'.$post->featured_image) }}" class="w-24 h-16 rounded-lg object-cover border border-gray-200" alt="">
                                @endif
                                <div class="flex-1">
                                    <div class="flex items-center justify-between gap-2 mb-2">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs px-2 py-1 rounded-full border {{ $post->status === 'published' ? 'border-emerald-300 text-emerald-700 bg-emerald-50' : 'border-gray-300 text-gray-700 bg-gray-50' }}">{{ ucfirst($post->status) }}</span>
                                            @if($post->featured)
                                                <span class="text-xs px-2 py-1 rounded-full border border-amber-300 text-amber-700 bg-amber-50">Featured</span>
                                            @endif
                                            <span class="text-xs text-gray-500">{{ $post->formatted_date }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="text-xs px-2 py-1 rounded border border-gray-300 text-gray-700 hover:text-black hover:border-gray-400">View</a>
                                        </div>
                                    </div>

                                    <form method="POST" action="{{ route('dashboard.blog.update', $post) }}" enctype="multipart/form-data" class="space-y-4">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <label for="title-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Title</label>
                                            <input id="title-{{ $post->id }}" name="title" value="{{ $post->title }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="slug-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Slug</label>
                                                <input id="slug-{{ $post->id }}" name="slug" value="{{ $post->slug }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                                            </div>
                                            <div>
                                                <label for="category_id-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Category</label>
                                                <select id="category_id-{{ $post->id }}" name="category_id" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">
                                                    <option value="">None</option>
                                                    @foreach($categories as $c)
                                                        <option value="{{ $c->id }}" @selected($post->category_id == $c->id)>{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="excerpt-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Excerpt</label>
                                            <textarea id="excerpt-{{ $post->id }}" name="excerpt" rows="2" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">{{ $post->excerpt }}</textarea>
                                        </div>
                                        <div>
                                            <label for="body-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Body</label>
                                            <textarea id="body-{{ $post->id }}" name="body" rows="8" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">{{ $post->body }}</textarea>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label for="status-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Status</label>
                                                <select id="status-{{ $post->id }}" name="status" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">
                                                    <option value="draft" @selected($post->status==='draft')>Draft</option>
                                                    <option value="published" @selected($post->status==='published')>Published</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="published_at-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Publish At</label>
                                                <input type="datetime-local" id="published_at-{{ $post->id }}" name="published_at" value="{{ optional($post->published_at)->format('Y-m-d\TH:i') }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                                            </div>
                                            <div class="flex items-end">
                                                <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                                                    <input type="checkbox" name="featured" value="1" class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-400" @checked($post->featured) />
                                                    Featured
                                                </label>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="featured_image-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Replace Featured Image</label>
                                            <input type="file" name="featured_image" id="featured_image-{{ $post->id }}" accept="image/*" class="mt-2 block w-full text-sm text-gray-700" />
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div class="md:col-span-3">
                                                <label for="meta_title-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Meta Title</label>
                                                <input id="meta_title-{{ $post->id }}" name="meta_title" value="{{ $post->meta_title }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                                            </div>
                                            <div class="md:col-span-3">
                                                <label for="meta_description-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Meta Description</label>
                                                <textarea id="meta_description-{{ $post->id }}" name="meta_description" rows="2" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3">{{ $post->meta_description }}</textarea>
                                            </div>
                                            <div class="md:col-span-3">
                                                <label for="keywords-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Keywords</label>
                                                <input id="keywords-{{ $post->id }}" name="keywords" value="{{ $post->keywords }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                                            </div>
                                        </div>
                                        <input type="hidden" name="author_id" value="{{ $post->author_id ?? auth()->id() }}" />
                                        <div class="flex items-center justify-end gap-3">
                                            <button class="inline-flex items-center rounded-lg bg-gray-900 text-white px-4 py-2.5 text-sm font-medium hover:bg-black focus:outline-none focus:ring-2 focus:ring-gray-300">Update</button>
                                        </div>
                                    </form>

                                    <div class="flex items-center gap-3 mt-3">
                                    <form method="POST" action="{{ route('dashboard.blog.toggle-status', $post) }}">
                                        @csrf
                                        @method('PATCH')
                                        @if($post->status === 'published')
                                            <button type="submit" onclick="return confirm('Unpublish this post? It will no longer be visible publicly.')" class="inline-flex items-center rounded-lg bg-yellow-500 text-black px-3 py-2 text-xs font-medium hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300">Unpublish</button>
                                        @else
                                            <button type="submit" onclick="return confirm('Publish this post? It will be visible publicly.')" class="inline-flex items-center rounded-lg bg-emerald-600 text-white px-3 py-2 text-xs font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-300">Publish</button>
                                        @endif
                                    </form>
                                    <form method="POST" action="{{ route('dashboard.blog.destroy', $post) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-flex items-center rounded-lg bg-red-600 text-white px-3 py-2 text-xs font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">Delete</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Simple search for Manage Posts list
        const postSearch = document.getElementById('postSearch');
        const postsList = document.getElementById('postsList');
        if (postSearch && postsList) {
            postSearch.addEventListener('input', () => {
                const q = (postSearch.value || '').toLowerCase().trim();
                postsList.querySelectorAll('[data-title]')?.forEach(el => {
                    const t = el.getAttribute('data-title') || '';
                    el.style.display = t.includes(q) ? '' : 'none';
                });
            });
        }

        // Excerpt counter
        const excerpt = document.getElementById('excerpt');
        const excerptCount = document.getElementById('excerptCount');
        if (excerpt && excerptCount) {
            const updateExcerpt = () => {
                const len = (excerpt.value || '').trim().length;
                excerptCount.textContent = Math.min(len, 160);
            };
            excerpt.addEventListener('input', updateExcerpt);
            updateExcerpt();
        }

        // Body counters and preview
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
            wordsEl && (wordsEl.textContent = wc);
            minsEl && (minsEl.textContent = Math.max(1, Math.ceil(wc/200)));
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
        const previewWrap = document.getElementById('featuredPreview');
        const previewImg = document.getElementById('previewImage');
        if (fi && previewWrap && previewImg) {
            fi.addEventListener('change', (e) => {
                const file = e.target.files?.[0];
                if (!file) return;
                const url = URL.createObjectURL(file);
                previewImg.src = url;
                previewImg.classList.remove('hidden');
                previewWrap.classList.remove('hidden');
            });
        }
    </script>
    @endpush
</x-dashboard-layout>
