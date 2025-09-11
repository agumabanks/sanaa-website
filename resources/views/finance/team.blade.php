@extends('layouts.finance', [
    'title' => 'Team — Sanaa Finance',
    'breadcrumbs' => [ ['name' => 'Team'] ],
])
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-semibold mb-6">Team</h1>
    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
        @forelse($members as $m)
            <div class="border rounded-lg p-5">
                <div class="font-medium">{{ $m->name }}</div>
                <div class="text-gray-600">{{ $m->role }}</div>
                @if($m->bio)
                    <p class="text-gray-600 mt-2">{{ $m->bio }}</p>
                @endif
            </div>
        @empty
            <p class="text-gray-600">No team members yet.</p>
        @endforelse
    </div>
</section>
@endsection

