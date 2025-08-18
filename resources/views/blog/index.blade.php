@extends('layouts.landing')

@section('title', 'Blog | ' . config('app.name'))

@section('content')
<div class="container mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold mb-8">Blog</h1>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
            <div class="bg-white rounded-lg shadow hover:shadow-md transition">
                @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" class="w-full h-48 object-cover rounded-t-lg" alt="{{ $post->title }}">
                @endif
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">
                        <a href="{{ route('blog.show', $post->slug) }}" class="hover:underline">{{ $post->title }}</a>
                    </h2>
                    <p class="text-gray-700 text-sm">{{ $post->excerpt }}</p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-primary hover:underline mt-2 inline-block">Read More</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
@endsection
