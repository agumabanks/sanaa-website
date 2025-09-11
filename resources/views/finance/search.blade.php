@extends('layouts.finance', [
    'title' => 'Search — Sanaa Finance',
    'breadcrumbs' => [ ['name' => 'Search'] ],
])
@section('content')
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <form method="get" action="{{ route('finance.search') }}" class="mb-6">
        <label class="block text-sm">Search Finance
            <input name="q" value="{{ $q }}" class="mt-1 w-full rounded-md border-gray-300 focus:ring-emerald-600 focus:border-emerald-600" placeholder="Search pages">
        </label>
    </form>
    @if($q)
        <h2 class="text-sm text-gray-600 mb-3">Results for “{{ $q }}”</h2>
    @endif
    <div class="space-y-3">
        @forelse($pages as $p)
            <a href="{{ route('finance.show', ['page' => $p->slug]) }}" class="block border rounded-lg p-4 hover:border-gray-300">
                <h3 class="font-medium">{{ $p->title }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ $p->meta_description }}</p>
            </a>
        @empty
            <p class="text-gray-600">No results.</p>
        @endforelse
    </div>
</section>
@endsection

