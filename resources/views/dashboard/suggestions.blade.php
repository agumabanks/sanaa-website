<x-dashboard-layout title="Reading Suggestions">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">Reading Suggestions</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <section>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Trending</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach(($trending ?? collect()) as $post)
                        <a href="{{ $post->url }}" target="_blank" class="block bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-sm transition">
                            <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-40 object-cover" />
                            <div class="p-4">
                                <div class="font-semibold text-gray-900 line-clamp-1">{{ $post->title }}</div>
                                <div class="text-sm text-gray-600 line-clamp-2">{{ $post->excerpt }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

            <section>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Popular</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach(($popular ?? collect()) as $post)
                        <a href="{{ $post->url }}" target="_blank" class="block bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-sm transition">
                            <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-40 object-cover" />
                            <div class="p-4">
                                <div class="font-semibold text-gray-900 line-clamp-1">{{ $post->title }}</div>
                                <div class="text-sm text-gray-600 line-clamp-2">{{ $post->excerpt }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</x-dashboard-layout>

