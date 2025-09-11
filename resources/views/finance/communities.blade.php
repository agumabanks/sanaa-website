@extends('layouts.finance', [
    'title' => 'Communities — Sanaa Finance',
    'breadcrumbs' => [ ['name' => 'Communities'] ],
])
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-semibold mb-6">Communities</h1>
    <div class="grid gap-6 md:grid-cols-2">
        @forelse($items as $c)
            <div class="border rounded-lg p-5">
                <div class="font-medium">{{ $c->segment_name }}</div>
                @if($c->needs)
                    <p class="text-gray-600 mt-2">Needs: {{ implode(', ', (array)$c->needs) }}</p>
                @endif
                @if($c->value_props)
                    <p class="text-gray-600 mt-2">Value: {{ implode(', ', (array)$c->value_props) }}</p>
                @endif
            </div>
        @empty
            <p class="text-gray-600">No communities yet.</p>
        @endforelse
    </div>
</section>
@endsection

