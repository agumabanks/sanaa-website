@extends('layouts.finance', [
    'title' => ($page->seo_title ?? $page->title).' — Sanaa Finance',
    'breadcrumbs' => [ ['name' => $page->title] ],
])
@section('content')
<article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 prose prose-neutral">
    <h1 class="!mt-0">{{ $page->title }}</h1>
    @if(is_array($page->content))
        @foreach(($page->content['blocks'] ?? []) as $block)
            @if(($block['type'] ?? '') === 'richtext')
                <div>{!! $block['html'] ?? '' !!}</div>
            @elseif(($block['type'] ?? '') === 'faq')
                <details class="border rounded-md p-3">
                    <summary class="font-medium">{{ $block['q'] ?? '' }}</summary>
                    <div class="mt-2">{!! $block['a'] ?? '' !!}</div>
                </details>
            @endif
        @endforeach
    @else
        <p class="text-gray-600">This page has no content yet.</p>
    @endif
</article>
@if($page->canonical_url)
    @push('head')<link rel="canonical" href="{{ $page->canonical_url }}">@endpush
@endif
@if($page->og_image)
    @push('head')<meta property="og:image" content="{{ $page->og_image }}">@endpush
@endif
@push('head')
<meta name="robots" content="{{ $page->is_indexed ? 'index,follow' : 'noindex,nofollow' }}">
@endpush
@endsection

