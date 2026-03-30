<x-admin-dashboard-layout title="Blog Management">
    <x-slot name="header">Blog Management</x-slot>

    @php
        $categories = \App\Models\BlogCategory::orderBy('name')->get();
        $totalPosts = $posts->total();
        $publishedCount = \App\Models\Blog::where('status', 'published')->count();
        $draftCount = \App\Models\Blog::where('status', 'draft')->count();
        $totalViews = \App\Models\Blog::sum('views');
    @endphp

    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500">Create, edit, and manage your blog posts</p>
            </div>
            <a href="{{ route('dashboard.blog.compose') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Post
            </a>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalPosts) }}</p>
                        <p class="text-sm text-gray-500">Total Posts</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($publishedCount) }}</p>
                        <p class="text-sm text-gray-500">Published</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($draftCount) }}</p>
                        <p class="text-sm text-gray-500">Drafts</p>
                    </div>
                </div>
            </div>
            <div class="stat-card">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($totalViews) }}</p>
                        <p class="text-sm text-gray-500">Total Views</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="content-card p-4">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="relative flex-1">
                    <input type="text" id="post-search" placeholder="Search posts..." class="input-field pl-10">
                    <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <select id="status-filter" class="input-field w-full md:w-40">
                    <option value="">All Status</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
                <select id="category-filter" class="input-field w-full md:w-48">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Posts List -->
        <div class="content-card">
            @if($posts->count())
                <div class="divide-y divide-gray-100" id="posts-list">
                    @foreach($posts as $post)
                        <div class="p-5 hover:bg-gray-50 apple-transition post-item" 
                             data-title="{{ strtolower($post->title) }}" 
                             data-status="{{ $post->status }}" 
                             data-category="{{ $post->category_id }}">
                            <div class="flex items-start gap-5">
                                @if($post->featured_image)
                                    <img src="{{ cdn_storage($post->featured_image) }}" class="w-24 h-16 rounded-xl object-cover flex-shrink-0" alt="">
                                @else
                                    <div class="w-24 h-16 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="badge {{ $post->status === 'published' ? 'badge-success' : 'badge-warning' }}">
                                                    {{ ucfirst($post->status) }}
                                                </span>
                                                @if($post->featured)
                                                    <span class="badge bg-amber-50 text-amber-700">Featured</span>
                                                @endif
                                            </div>
                                            <h3 class="font-semibold text-gray-900 truncate pr-4">{{ $post->title }}</h3>
                                            <p class="text-sm text-gray-500 mt-1 line-clamp-1">{{ Str::limit(strip_tags($post->excerpt), 100) }}</p>
                                        </div>
                                        <div class="flex items-center gap-2 flex-shrink-0">
                                            <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="p-2 rounded-lg hover:bg-gray-100 text-gray-500 hover:text-gray-700 apple-transition" title="View">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('dashboard.blog.edit', $post) }}" class="p-2 rounded-lg hover:bg-blue-50 text-gray-500 hover:text-blue-600 apple-transition" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('dashboard.blog.toggle-status', $post) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="p-2 rounded-lg hover:bg-{{ $post->status === 'published' ? 'orange' : 'green' }}-50 text-gray-500 hover:text-{{ $post->status === 'published' ? 'orange' : 'green' }}-600 apple-transition" title="{{ $post->status === 'published' ? 'Unpublish' : 'Publish' }}">
                                                    @if($post->status === 'published')
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                    @endif
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('dashboard.blog.destroy', $post) }}" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-lg hover:bg-red-50 text-gray-500 hover:text-red-600 apple-transition" title="Delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            {{ $post->author->name ?? 'Unknown' }}
                                        </span>
                                        @if($post->category)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                                {{ $post->category->name }}
                                            </span>
                                        @endif
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            {{ number_format($post->views) }} views
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                            {{ number_format($post->likes) }} likes
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $post->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="px-5 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">No posts yet</h3>
                    <p class="text-gray-500 mt-1">Get started by creating your first blog post</p>
                    <a href="{{ route('dashboard.blog.compose') }}" class="btn-primary mt-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Post
                    </a>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        const searchInput = document.getElementById('post-search');
        const statusFilter = document.getElementById('status-filter');
        const categoryFilter = document.getElementById('category-filter');
        const postsList = document.getElementById('posts-list');

        function filterPosts() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusValue = statusFilter.value;
            const categoryValue = categoryFilter.value;

            postsList?.querySelectorAll('.post-item').forEach(item => {
                const title = item.dataset.title || '';
                const status = item.dataset.status || '';
                const category = item.dataset.category || '';

                const matchesSearch = title.includes(searchTerm);
                const matchesStatus = !statusValue || status === statusValue;
                const matchesCategory = !categoryValue || category === categoryValue;

                item.style.display = matchesSearch && matchesStatus && matchesCategory ? '' : 'none';
            });
        }

        searchInput?.addEventListener('input', filterPosts);
        statusFilter?.addEventListener('change', filterPosts);
        categoryFilter?.addEventListener('change', filterPosts);
    </script>
    @endpush
</x-admin-dashboard-layout>
