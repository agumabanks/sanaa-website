<x-dashboard-layout title="Manage Blog Posts">
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">Manage Blog Posts</h2>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input id="postSearch" type="text" placeholder="Search posts" class="w-64 rounded-lg border border-gray-300 bg-white text-sm py-2 pl-9 pr-3 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400" />
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
                </div>
                <a href="{{ route('dashboard.blog.compose') }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium py-2 px-3">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13H13v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                    Compose Post
                </a>
            </div>
        </div>
    </x-slot>

    @php(
        $categories = \App\Models\BlogCategory::orderBy('name')->get()
    )

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

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Posts</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $posts->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Published</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $posts->where('status', 'published')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Drafts</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $posts->where('status', 'draft')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Featured</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $posts->where('featured', true)->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Posts List -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">All Posts</h3>
                    <div class="flex items-center gap-4">
                        <select id="statusFilter" class="rounded-lg border border-gray-300 bg-white text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-emerald-400">
                            <option value="">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                        <select id="categoryFilter" class="rounded-lg border border-gray-300 bg-white text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-emerald-400">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if($posts->count())
                    <div class="divide-y divide-gray-100" id="postsList">
                        @foreach($posts as $post)
                        <div class="p-6 post-item" data-title="{{ strtolower($post->title) }}" data-status="{{ $post->status }}" data-category="{{ $post->category_id }}">
                            <div class="flex items-start gap-4">
                                @if($post->featured_image)
                                    <img src="{{ cdn_storage($post->featured_image) }}" class="w-24 h-16 rounded-lg object-cover border border-gray-200" alt="">
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
                                            <button onclick="toggleEdit({{ $post->id }})" class="text-xs px-2 py-1 rounded border border-gray-300 text-gray-700 hover:text-black hover:border-gray-400">Edit</button>
                                        </div>
                                    </div>

                                    <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $post->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit(strip_tags($post->excerpt), 100) }}</p>

                                    <div class="flex items-center gap-4 text-xs text-gray-500">
                                        <span>By {{ $post->author->name ?? 'Unknown' }}</span>
                                        @if($post->category)
                                            <span>•</span>
                                            <span>{{ $post->category->name }}</span>
                                        @endif
                                        <span>•</span>
                                        <span>{{ $post->views }} views</span>
                                        <span>•</span>
                                        <span>{{ $post->likes }} likes</span>
                                    </div>

                                    <!-- Inline Edit Form (Hidden by default) -->
                                    <div id="edit-form-{{ $post->id }}" class="mt-4 hidden">
                                        <form method="POST" action="{{ route('dashboard.blog.update', $post) }}" enctype="multipart/form-data" class="space-y-4 border-t border-gray-100 pt-4">
                                            @csrf
                                            @method('PUT')
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label for="title-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Title</label>
                                                    <input id="title-{{ $post->id }}" name="title" value="{{ $post->title }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                                                </div>
                                                <div>
                                                    <label for="slug-{{ $post->id }}" class="block text-sm font-medium text-gray-700">Slug</label>
                                                    <input id="slug-{{ $post->id }}" name="slug" value="{{ $post->slug }}" class="mt-2 w-full rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 py-2.5 px-3" />
                                                </div>
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
                                            <input type="hidden" name="author_id" value="{{ $post->author_id ?? auth()->id() }}" />
                                            <div class="flex items-center justify-end gap-3">
                                                <button type="button" onclick="toggleEdit({{ $post->id }})" class="inline-flex items-center rounded-lg bg-gray-600 text-white px-4 py-2.5 text-sm font-medium hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancel</button>
                                                <button type="submit" class="inline-flex items-center rounded-lg bg-emerald-600 text-white px-4 py-2.5 text-sm font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400">Update</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="flex items-center justify-end gap-3 mt-3">
                                        <form method="POST" action="{{ route('dashboard.blog.toggle-status', $post) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            @if($post->status === 'published')
                                                <button type="submit" onclick="return confirm('Unpublish this post? It will no longer be visible publicly.')" class="inline-flex items-center rounded-lg bg-yellow-500 text-black px-3 py-2 text-xs font-medium hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300">Unpublish</button>
                                            @else
                                                <button type="submit" onclick="return confirm('Publish this post? It will be visible publicly.')" class="inline-flex items-center rounded-lg bg-emerald-600 text-white px-3 py-2 text-xs font-medium hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-300">Publish</button>
                                            @endif
                                        </form>
                                        <form method="POST" action="{{ route('dashboard.blog.destroy', $post) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')" class="inline-flex items-center rounded-lg bg-red-600 text-white px-3 py-2 text-xs font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="p-12 text-center">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No posts yet</h3>
                        <p class="text-gray-500 mb-4">Get started by creating your first blog post.</p>
                        <a href="{{ route('dashboard.blog.compose') }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium py-2 px-3">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13H13v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                            Create Post
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Search functionality
        const postSearch = document.getElementById('postSearch');
        const postsList = document.getElementById('postsList');
        if (postSearch && postsList) {
            postSearch.addEventListener('input', () => {
                const q = (postSearch.value || '').toLowerCase().trim();
                postsList.querySelectorAll('.post-item')?.forEach(el => {
                    const t = el.getAttribute('data-title') || '';
                    el.style.display = t.includes(q) ? '' : 'none';
                });
            });
        }

        // Filter functionality
        const statusFilter = document.getElementById('statusFilter');
        const categoryFilter = document.getElementById('categoryFilter');

        function applyFilters() {
            const statusValue = statusFilter?.value || '';
            const categoryValue = categoryFilter?.value || '';

            postsList.querySelectorAll('.post-item')?.forEach(el => {
                const status = el.getAttribute('data-status') || '';
                const category = el.getAttribute('data-category') || '';
                const statusMatch = !statusValue || status === statusValue;
                const categoryMatch = !categoryValue || category === categoryValue;
                el.style.display = (statusMatch && categoryMatch) ? '' : 'none';
            });
        }

        statusFilter?.addEventListener('change', applyFilters);
        categoryFilter?.addEventListener('change', applyFilters);

        // Toggle edit form
        function toggleEdit(postId) {
            const form = document.getElementById(`edit-form-${postId}`);
            if (form) {
                form.classList.toggle('hidden');
            }
        }
    </script>
    @endpush
</x-dashboard-layout>
