<x-dashboard-layout title="Library">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">Library</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            @if($posts->count() === 0)
                <div class="bg-white rounded-2xl border border-gray-200 p-8 text-center">
                    <p class="text-gray-600">Your library is empty. Bookmark stories to save them here.</p>
                    <div class="mt-4">
                        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-black text-white hover:bg-gray-900 transition">
                            Browse Stories
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($posts as $post)
                        <article class="bg-white rounded-2xl border border-gray-200 p-5 flex gap-4">
                            <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-24 h-16 rounded object-cover border border-gray-200" />
                            <div class="flex-1 min-w-0">
                                <a href="{{ $post->url }}" target="_blank" class="font-semibold text-gray-900 hover:underline line-clamp-1">{{ $post->title }}</a>
                                <p class="text-sm text-gray-600 line-clamp-2 mt-1">{{ $post->excerpt }}</p>
                                <div class="mt-2 text-xs text-gray-500 flex items-center gap-2">
                                    <span>{{ $post->author->name ?? 'Sanaa Team' }}</span>
                                    <span>•</span>
                                    <time datetime="{{ ($post->published_at ?? $post->created_at)->toDateString() }}">{{ $post->formatted_date }}</time>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div>
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>

