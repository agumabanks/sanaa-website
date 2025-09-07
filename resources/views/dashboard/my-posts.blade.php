<x-dashboard-layout title="My Blog Posts">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">My Blog Posts</h2>
            <a href="{{ route('dashboard.write') }}" class="inline-flex items-center gap-2 rounded-lg bg-black hover:bg-gray-900 text-white text-sm font-medium py-2 px-3">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 0 0 0-1.42l-2.34-2.34a1.003 1.003 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/></svg>
                Write
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if($posts->count() === 0)
                <div class="bg-white rounded-2xl border border-gray-200 p-8 text-center">
                    <p class="text-gray-600">You haven't written any posts yet.</p>
                    <div class="mt-4">
                        <a href="{{ route('dashboard.stats') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-black text-white hover:bg-gray-900 transition">
                            View My Blog Stats
                        </a>
                        <a href="{{ route('blog.index') }}" class="ml-3 inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white border border-gray-300 text-gray-900 hover:bg-gray-50 transition">
                            Browse Stories
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl border border-gray-200">
                    <div class="p-5 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Posts</h3>
                        <p class="text-sm text-gray-500">{{ $posts->total() }} total</p>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($posts as $post)
                            <div class="p-5 flex items-start gap-4">
                                <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-20 h-12 rounded object-cover border border-gray-200" />
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-gray-100 text-gray-700 border border-gray-200">{{ ucfirst($post->status) }}</span>
                                        @if($post->category)
                                            <span>•</span>
                                            <span>{{ $post->category->name }}</span>
                                        @endif
                                        <span>•</span>
                                        <time datetime="{{ ($post->published_at ?? $post->created_at)->toDateString() }}">{{ $post->formatted_date }}</time>
                                    </div>
                                    <h4 class="mt-1 font-semibold text-gray-900 truncate">
                                        <a href="{{ $post->url }}" target="_blank" class="hover:underline">{{ $post->title }}</a>
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-600 line-clamp-2">{{ $post->excerpt }}</p>
                                </div>
                                <div class="text-right text-sm text-gray-600 shrink-0">
                                    <div>{{ number_format($post->views) }} views</div>
                                    <div>{{ number_format($post->likes) }} likes</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="p-5 border-t border-gray-200">
                        {{ $posts->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
