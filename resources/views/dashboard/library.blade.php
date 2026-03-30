<x-dashboard-layout title="My Library">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            My Library
        </h2>
    </x-slot>

    @php
        $bookmarks = \App\Models\Blog::whereHas('bookmarks', function($q) {
            $q->where('user_id', auth()->id());
        })->with('author', 'category')->orderByDesc('created_at')->paginate(12);

        $recentlyRead = \App\Models\Blog::whereHas('readingHistory', function($q) {
            $q->where('user_id', auth()->id());
        })->with('author', 'category')->orderByDesc('created_at')->take(6)->get();
    @endphp

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Tabs -->
            <div class="bg-white rounded-xl border border-gray-200 p-1 inline-flex gap-1">
                <button data-tab="saved" class="tab-btn  px-6 py-2.5 rounded-lg text-sm font-medium bg-emerald-100 text-emerald-700">
                    Saved Stories
                </button>
                <button data-tab="history" class="tab-btn px-6 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100">
                    Reading History
                </button>
                <button data-tab="lists" class="tab-btn px-6 py-2.5 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100">
                    My Lists
                </button>
            </div>

            <!-- Saved Stories Tab -->
            <div id="saved" class="tab-content">
                @if($bookmarks->count() === 0)
                    <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
                        <svg class="mx-auto w-16 h-16 text-gray-300 mb-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No saved stories yet</h3>
                        <p class="text-gray-600 mb-6">Start saving stories you love to read them later</p>
                        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition font-medium">
                            Explore Stories
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($bookmarks as $post)
                            <div class="bg-white rounded-xl border border-gray-200 hover:border-emerald-200 hover:shadow-lg transition-all overflow-hidden group">
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover" />
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-emerald-50 to-blue-50 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-300" viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z"/></svg>
                                    </div>
                                @endif
                                <div class="p-5">
                                    @if($post->category)
                                        <span class="inline-block px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 mb-2">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                    <h4 class="font-bold text-gray-900 line-clamp-2 group-hover:text-emerald-600 mb-2 text-lg">
                                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h4>
                                    @if($post->excerpt)
                                        <p class="text-sm text-gray-600 line-clamp-3 mb-3">{{ $post->excerpt }}</p>
                                    @endif
                                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                                        <img src="{{ $post->author->profile_photo_url }}" alt="{{ $post->author->name }}" class="w-6 h-6 rounded-full" />
                                        <span>{{ $post->author->name }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center gap-3 text-gray-500">
                                            <span>{{ number_format($post->views) }} views</span>
                                            <span>{{ $post->reading_time }} min read</span>
                                        </div>
                                        <button class="text-emerald-600 hover:text-emerald-700">
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6">
                        {{ $bookmarks->links() }}
                    </div>
                @endif
            </div>

            <!-- Reading History Tab -->
            <div id="history" class="tab-content hidden">
                @if($recentlyRead->count() === 0)
                    <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
                        <svg class="mx-auto w-16 h-16 text-gray-300 mb-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13 3a9 9 0 009 9 9 9 0 00-9-9zM4 12a9 9 0 009 9 9 9 0 00-9-9z"/>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No reading history</h3>
                        <p class="text-gray-600 mb-6">Your recently read stories will appear here</p>
                        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition font-medium">
                            Start Reading
                        </a>
                    </div>
                @else
                    <div class="bg-white rounded-xl border border-gray-200 divide-y divide-gray-100">
                        @foreach($recentlyRead as $post)
                            <div class="p-5 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    @if($post->featured_image)
                                        <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="w-24 h-16 rounded-lg object-cover flex-shrink-0" />
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-gray-900 hover:text-emerald-600 mb-1">
                                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                        </h4>
                                        <p class="text-sm text-gray-600 line-clamp-2 mb-2">{{ $post->excerpt }}</p>
                                        <div class="flex items-center gap-3 text-xs text-gray-500">
                                            <span>{{ $post->author->name }}</span>
                                            <span>•</span>
                                            <span>{{ $post->formatted_date }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- My Lists Tab -->
            <div id="lists" class="tab-content hidden">
                <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
                    <svg class="mx-auto w-16 h-16 text-gray-300 mb-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Reading Lists Coming Soon</h3>
                    <p class="text-gray-600">Create custom reading lists to organize your favorite stories</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Tab functionality
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const tabName = btn.dataset.tab;
                
                // Update active button
                tabBtns.forEach(b => {
                    b.classList.remove('bg-emerald-100', 'text-emerald-700');
                    b.classList.add('text-gray-600', 'hover:bg-gray-100');
                });
                btn.classList.remove('text-gray-600', 'hover:bg-gray-100');
                btn.classList.add('bg-emerald-100', 'text-emerald-700');

                // Show active tab content
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                    if (content.id === tabName) {
                        content.classList.remove('hidden');
                    }
                });
            });
        });
    </script>
    @endpush
</x-dashboard-layout>
