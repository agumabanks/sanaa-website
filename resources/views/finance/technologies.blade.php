@extends('layouts.finance', [
    'title' => 'Technologies — Sanaa Finance',
    'breadcrumbs' => [ ['name' => 'Technologies'] ],
])
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-semibold mb-6">Technologies</h1>
    <ul class="grid gap-6 md:grid-cols-3">
        @forelse($items as $t)
            <li class="border rounded-lg p-5">
                <div class="font-medium">{{ $t->name }}</div>
                <p class="text-gray-600 mt-2">{{ $t->description }}</p>
                @if($t->link)
                    <a class="text-emerald-700 mt-3 inline-block hover:underline" href="{{ $t->link }}" rel="nofollow noopener" target="_blank">Learn more</a>
                @endif
            </li>
        @empty
            <li class="text-gray-600">No technologies yet.</li>
        @endforelse
    </ul>
</section>
@endsection

