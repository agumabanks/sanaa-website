@extends('layouts.landing')

@section('title', $post->title . ' | ' . config('app.name'))

@section('content')
<div class="container mx-auto py-12 px-4 max-w-4xl">
    <article class="prose lg:prose-lg">
        <h1>{{ $post->title }}</h1>
        <div class="text-sm text-gray-500 mb-4 flex items-center space-x-2">
            <span>{{ $post->created_at->format('M d') }}</span>
            <span>•</span>
            <span><span id="views-count">{{ $post->views }}</span> views</span>
            <span>•</span>
            <span><span id="likes-count">{{ $post->likes }}</span> likes</span>
            <span>•</span>
            <span><span id="shares-count">{{ $post->shares }}</span> shares</span>
        </div>
        <div class="flex items-center space-x-4 mb-6">
            <button id="like-button" class="text-primary">Like</button>
            <button id="share-button" class="text-primary">Share</button>
            <button id="save-button" class="text-primary">Save</button>
            <div class="relative">
                <button id="more-button" class="text-primary">More</button>
                <div id="more-menu" class="hidden absolute right-0 mt-2 bg-white border rounded shadow-lg text-sm">
                    <a href="#" class="block px-4 py-2">Follow author</a>
                    <a href="#" class="block px-4 py-2">Follow publication</a>
                    <a href="#" class="block px-4 py-2">Mute author</a>
                    <a href="#" class="block px-4 py-2">Mute publication</a>
                    <a href="#" class="block px-4 py-2">Report story</a>
                </div>
            </div>
        </div>
        @if($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" class="rounded-lg mb-6">
        @endif
        {!! Illuminate\Support\Str::markdown($post->body) !!}
    </article>
</div>
@endsection

@push('scripts')
<script>
async function post(path) {
    const res = await fetch(path, {method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
    return res.json();
}

document.getElementById('like-button').addEventListener('click', async () => {
    const data = await post('/api/blogs/{{ $post->id }}/like');
    document.getElementById('likes-count').innerText = data.likes;
});

document.getElementById('share-button').addEventListener('click', async () => {
    const data = await post('/api/blogs/{{ $post->id }}/share');
    document.getElementById('shares-count').innerText = data.shares;
});

document.getElementById('save-button').addEventListener('click', async () => {
    await post('/api/blogs/{{ $post->id }}/save');
});

document.getElementById('more-button').addEventListener('click', () => {
    document.getElementById('more-menu').classList.toggle('hidden');
});
</script>
@endpush
