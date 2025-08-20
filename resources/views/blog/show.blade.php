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
            <span>•</span>
            <span><span id="saves-count">{{ $post->saves }}</span> saves</span>
        </div>
        <div class="flex items-center space-x-4 mb-6">
            <button id="like-button" class="text-primary transition transform">Like</button>
            <button id="share-button" class="text-primary transition transform">Share</button>
            <button id="save-button" class="text-primary transition transform">Save</button>
            <div class="relative">
                <button id="more-button" class="text-primary transition">More</button>
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
document.addEventListener('DOMContentLoaded', () => {
    async function post(path) {
        const res = await fetch(path, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
        if (!res.ok) throw new Error('Request failed');
        return res.json();
    }

    const animate = el => {
        el.classList.add('scale-110');
        setTimeout(() => el.classList.remove('scale-110'), 150);
    };

    const likeBtn = document.getElementById('like-button');
    if (likeBtn) {
        likeBtn.addEventListener('click', async () => {
            likeBtn.disabled = true;
            try {
                const data = await post('/api/blogs/{{ $post->id }}/like');
                document.getElementById('likes-count').innerText = data.likes;
                animate(likeBtn);
            } catch (err) {
                console.error(err);
            } finally {
                likeBtn.disabled = false;
            }
        });
    }

    const shareBtn = document.getElementById('share-button');
    if (shareBtn) {
        shareBtn.addEventListener('click', async () => {
            shareBtn.disabled = true;
            try {
                const data = await post('/api/blogs/{{ $post->id }}/share');
                document.getElementById('shares-count').innerText = data.shares;
                animate(shareBtn);
            } catch (err) {
                console.error(err);
            } finally {
                shareBtn.disabled = false;
            }
        });
    }

    const saveBtn = document.getElementById('save-button');
    if (saveBtn) {
        saveBtn.addEventListener('click', async () => {
            saveBtn.disabled = true;
            try {
                const data = await post('/api/blogs/{{ $post->id }}/save');
                document.getElementById('saves-count').innerText = data.saves;
                saveBtn.textContent = 'Saved';
                animate(saveBtn);
            } catch (err) {
                console.error(err);
            } finally {
                saveBtn.disabled = false;
            }
        });
    }

    const moreBtn = document.getElementById('more-button');
    const moreMenu = document.getElementById('more-menu');
    moreBtn.addEventListener('click', () => {
        moreMenu.classList.toggle('hidden');
    });
    document.addEventListener('click', (e) => {
        if (!moreMenu.contains(e.target) && e.target !== moreBtn) {
            moreMenu.classList.add('hidden');
        }
    });
});
</script>
@endpush
