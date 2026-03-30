@extends('layouts.dashboard', ['title' => $page->title])
@section('content')
<div class="p-6 max-w-4xl">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">{{ $page->title }}</h1>
        <a href="{{ route('admin.finance.pages.edit', $page) }}" class="inline-flex rounded-md bg-emerald-600 text-white px-3 py-2 text-sm">Edit</a>
    </div>
    <dl class="grid grid-cols-2 gap-4 text-sm">
        <div><dt class="text-gray-500">Slug</dt><dd>/finance/p/{{ $page->slug }}</dd></div>
        <div><dt class="text-gray-500">Status</dt><dd>{{ ucfirst($page->status) }}</dd></div>
        <div><dt class="text-gray-500">Indexed</dt><dd>{{ $page->is_indexed ? 'Yes' : 'No' }}</dd></div>
        <div><dt class="text-gray-500">Scheduled</dt><dd>{{ $page->scheduled_at?->toDayDateTimeString() ?: '—' }}</dd></div>
    </dl>
    <div class="prose mt-6">
        {!! collect($page->content['blocks'] ?? [])->map(fn($b)=>$b['html'] ?? '')->implode('') !!}
    </div>
</div>
@endsection
