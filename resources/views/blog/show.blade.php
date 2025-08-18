@extends('layouts.landing')

@section('title', $post->title . ' | ' . config('app.name'))

@section('content')
<div class="container mx-auto py-12 px-4 max-w-4xl">
    <article class="prose lg:prose-lg">
        <h1>{{ $post->title }}</h1>
        @if($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" class="rounded-lg mb-6">
        @endif
        {!! Illuminate\Support\Str::markdown($post->body) !!}
    </article>
</div>
@endsection
