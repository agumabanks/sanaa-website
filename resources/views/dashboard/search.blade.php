<x-dashboard-layout title="Search">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">Search</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <form method="GET" action="{{ route('dashboard.search') }}" class="bg-white rounded-2xl border border-gray-200 p-5 flex items-center gap-3">
                <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="currentColor"><path d="M10 18a8 8 0 115.293-2.707l4.707 4.707-1.414 1.414-4.707-4.707A7.963 7.963 0 0110 18zm0-2a6 6 0 100-12 6 6 0 000 12z"/></svg>
                <input type="text" name="q" value="{{ $q }}" placeholder="Search stories..." class="flex-1 outline-none bg-transparent" />
                <button class="rounded-lg bg-black text-white px-3 py-2 text-sm">Search</button>
            </form>

            @if($q)
                <div class="text-sm text-gray-600">Results for "{{ $q }}"</div>
                @if($results->count() === 0)
                    <div class="bg-white rounded-2xl border border-gray-200 p-8 text-center text-gray-600">No results found.</div>
                @else
                    <div class="bg-white rounded-2xl border border-gray-200 divide-y">
                        @foreach($results as $post)
                            <a href="{{ $post->url }}" target="_blank" class="block p-5 hover:bg-gray-50">
                                <div class="font-medium text-gray-900">{{ $post->title }}</div>
                                <div class="text-sm text-gray-600 line-clamp-1">{{ $post->excerpt }}</div>
                                <div class="mt-1 text-xs text-gray-500">{{ $post->formatted_date }} • {{ $post->author->name ?? 'Sanaa Team' }}</div>
                            </a>
                        @endforeach
                    </div>
                    <div class="pt-4">{{ $results->links() }}</div>
                @endif
            @endif
        </div>
    </div>
</x-dashboard-layout>

