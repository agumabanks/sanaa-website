@extends('layouts.landing')

@section('content')
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold">Developer Platforms</h1>
            @if($items->count())
                <ul class="mt-4 space-y-2">
                    @foreach($items as $platform)
                        <li class="border-b pb-2">
                            <h2 class="font-semibold">{{ $platform->name }}</h2>
                            <p class="text-gray-600">{{ $platform->description }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mt-4 text-gray-600">APIs and developer resources coming soon.</p>
            @endif
        </div>
    </section>
@endsection
