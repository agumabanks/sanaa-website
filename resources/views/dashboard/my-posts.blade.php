<x-dashboard-layout title="My Posts">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">My Posts</h2>
            <a href="{{ route('dashboard.write') }}" class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium py-2 px-4">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                Write New Story
            </a>
        </div>
    </x-slot>

    @php
        $stats = [
            'total' => $posts->total(),
            'published' => \App\Models\Blog::where('author_id', auth()->id())->where('status', 'published')->count(),
            'drafts' => \App\Models\Blog::where('author_id', auth()->id())->where('status', 'draft')->count(),
            'total_views' => \App\Models\Blog::where('author_id', auth()->id())->sum('views'),
            'total_likes' => \App\Models\Blog::where('author_id', auth()->id())->sum('likes'),
        ];
    @endphp

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <div class="text-sm text-gray-500">Total Posts</div>
                    <div class="mt-1 text-3xl font-bold text-gray-900">{{ number_format($stats['total']) }}</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <div class="text-sm text-gray-500">Published</div>
                    <div class="mt-1 text-3xl font-bold text-emerald-600">{{ number_format($stats['published']) }}</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <div class="text-sm text-gray-500">Drafts</div>
                    <div class="mt-1 text-3xl font-bold text-amber-600">{{ number_format($stats['drafts']) }}</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <div class="text-sm text-gray-500">Total Views</div>
                    <div class="mt-1 text-3xl font-bold text-blue-600">{{ number_format($stats['total_views']) }}</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <div class="text-sm text-gray-500">Total Likes</div>
                    <div class="mt-1 text-3xl font-bold text-pink-600">{{ number_format($stats['total_likes']) }}</div>
                </div>
            </div>

            @if($posts->count() === 0)
                <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
                    <svg class="mx-auto w-16 h-16 text-gray-300 mb-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm4 18H6V4h7v5h5v11z"/>
                        <path d="M8 15h8v2H8v-2zm0-3h8v2H8v-2z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No stories yet</h3>
                    <p class="text-gray-600 mb-6">Start writing your first story and share it with the world</p>
                    <div class="flex items-center justify-center gap-3">
                        <a href="{{ route('dashboard.write') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition font-medium">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 000-1.42l-2.34-2.34a1.003 1.003 0 00-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/></svg>
                            Write Your First Story
                        </a>
                        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-900 hover:bg-gray-50 transition font-medium">
                            Browse Stories
                        </a>
                    </div>
                </div>
            @else
                <!-- Filters and Search -->
                <div class="bg-white rounded-xl border border-gray-200 p-4 flex flex-wrap items-center gap-3">
                    <div class="flex items-center gap-2">
                        <button data-filter="all" class="filter-btn px-4 py-2 rounded-lg text-sm font-medium bg-emerald-100 text-emerald-700 border border-emerald-200">
                            All ({{ $stats['total'] }})
                        </button>
                        <button data-filter="published" class="filter-btn px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100">
                            Published ({{ $stats['published'] }})
                        </button>
                        <button data-filter="draft" class="filter-btn px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100">
                            Drafts ({{ $stats['drafts'] }})
                        </button>
                    </div>
                    <div class="ml-auto flex items-center gap-3">
                        <div class="relative">
                            <input type="text" id="searchPosts" placeholder="Search posts..." class="pl-9 pr-4 py-2 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400" />
                            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" viewBox="0 0 20 20" fill="currentColor"><path fillRule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clipRule="evenodd"/></svg>
                        </div>
                        <select id="sortPosts" class="px-4 py-2 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400">
                            <option value="recent">Most Recent</option>
                            <option value="popular">Most Popular</option>
                            <option value="views">Most Views</option>
                            <option value="likes">Most Likes</option>
                        </select>
                        <button id="viewToggle" class="p-2 rounded-lg border border-gray-300 hover:bg-gray-50" title="Toggle view">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 5h8v8H3V5zm10 0h8v8h-8V5zM3 15h8v4H3v-4zm10 0h8v4h-8v-4z"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Posts List -->
                <div id="postsList" class="space-y-4">
                    @foreach($posts as $post)
                        <div class="post-item bg-white rounded-xl border border-gray-200 hover:border-emerald-200 hover:shadow-md transition-all" 
                             data-status="{{ $post->status }}" 
                             data-title="{{ strtolower($post->title) }}"
                             data-views="{{ $post->views }}"
                             data-likes="{{ $post->likes }}"
                             data-date="{{ $post->created_at->timestamp }}">
                            <div class="p-6">
                                <div class="flex items-start gap-5">
                                    @if($post->featured_image)
                                        <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="w-32 h-20 rounded-lg object-cover border border-gray-200 flex-shrink-0" />
                                    @else
                                        <div class="w-32 h-20 rounded-lg bg-gradient-to-br from-emerald-50 to-blue-50 border border-gray-200 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-8 h-8 text-gray-300" viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/></svg>
                                        </div>
                                    @endif
                                    
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $post->status === 'published' ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : 'bg-amber-100 text-amber-700 border border-amber-200' }}">
                                                {{ ucfirst($post->status) }}
                                            </span>
                                            @if($post->featured)
                                                <span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700 border border-purple-200">★ Featured</span>
                                            @endif
                                            @if($post->category)
                                                <span class="text-xs text-gray-500">{{ $post->category->name }}</span>
                                            @endif
                                            <span class="text-xs text-gray-400">•</span>
                                            <time class="text-xs text-gray-500" datetime="{{ $post->created_at->toDateString() }}">{{ $post->formatted_date }}</time>
                                        </div>
                                        
                                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 hover:text-emerald-600">
                                            <a href="{{ route('blog.show', $post->slug) }}" target="_blank">{{ $post->title }}</a>
                                        </h3>
                                        
                                        @if($post->excerpt)
                                            <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ $post->excerpt }}</p>
                                        @endif
                                        
                                        <div class="flex items-center gap-5 text-sm text-gray-500">
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                                <span class="font-medium">{{ number_format($post->views) }}</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                                <span class="font-medium">{{ number_format($post->likes) }}</span>
                                            </div>
                                            @if($post->comments_count > 0)
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
                                                    <span class="font-medium">{{ number_format($post->comments_count) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col gap-2 flex-shrink-0">
                                        <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 text-sm font-medium">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"/></svg>
                                            View
                                        </a>
                                        <a href="{{ route('dashboard.blog.edit', $post) }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-lg border border-emerald-300 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 text-sm font-medium">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 000-1.42l-2.34-2.34a1.003 1.003 0 00-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/></svg>
                                            Edit
                                        </a>
                                        <button onclick="if(confirm('Delete this post?')) document.getElementById('delete-{{ $post->id }}').submit();" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-lg border border-red-300 text-red-700 hover:bg-red-50 text-sm font-medium">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
                                            Delete
                                        </button>
                                        <form id="delete-{{ $post->id }}" action="{{ route('dashboard.blog.destroy', $post) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="bg-white rounded-xl border border-gray-200 p-4">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Filter functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        const postItems = document.querySelectorAll('.post-item');
        const searchInput = document.getElementById('searchPosts');
        const sortSelect = document.getElementById('sortPosts');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Update active button
                filterBtns.forEach(b => {
                    b.classList.remove('bg-emerald-100', 'text-emerald-700', 'border-emerald-200');
                    b.classList.add('text-gray-600', 'hover:bg-gray-100');
                });
                btn.classList.remove('text-gray-600', 'hover:bg-gray-100');
                btn.classList.add('bg-emerald-100', 'text-emerald-700', 'border-emerald-200');

                const filter = btn.dataset.filter;
                applyFilters();
            });
        });

        function applyFilters() {
            const activeFilter = document.querySelector('.filter-btn.bg-emerald-100').dataset.filter;
            const searchTerm = searchInput?.value.toLowerCase() || '';

            postItems.forEach(item => {
                const status = item.dataset.status;
                const title = item.dataset.title;
                
                const matchesFilter = activeFilter === 'all' || status === activeFilter;
                const matchesSearch = !searchTerm || title.includes(searchTerm);
                
                item.style.display = matchesFilter && matchesSearch ? '' : 'none';
            });
        }

        searchInput?.addEventListener('input', applyFilters);

        // Sort functionality
        sortSelect?.addEventListener('change', () => {
            const sortBy = sortSelect.value;
            const postsList = document.getElementById('postsList');
            const items = Array.from(postItems);

            items.sort((a, b) => {
                switch(sortBy) {
                    case 'recent':
                        return parseInt(b.dataset.date) - parseInt(a.dataset.date);
                    case 'popular':
                        const popA = parseInt(a.dataset.views) + parseInt(a.dataset.likes);
                        const popB = parseInt(b.dataset.views) + parseInt(b.dataset.likes);
                        return popB - popA;
                    case 'views':
                        return parseInt(b.dataset.views) - parseInt(a.dataset.views);
                    case 'likes':
                        return parseInt(b.dataset.likes) - parseInt(a.dataset.likes);
                    default:
                        return 0;
                }
            });

            items.forEach(item => postsList.appendChild(item));
        });

        // Keyboard shortcut: N for new post
        document.addEventListener('keydown', (e) => {
            if (e.key === 'n' && !e.ctrlKey && !e.metaKey && document.activeElement.tagName !== 'INPUT') {
                window.location.href = '{{ route('dashboard.write') }}';
            }
        });
    </script>
    @endpush
</x-dashboard-layout>
