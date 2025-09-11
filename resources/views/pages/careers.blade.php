@extends('layouts.landing')

@section('title', 'Careers | ' . config('app.name'))

@section('content')
    {{-- Career listings cached for 30 minutes in controller --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold">Careers</h1>
            @if($items->count())
                <ul class="mt-4 space-y-2">
                    @foreach($items as $career)
                        <li class="border-b pb-2">
                            <h2 class="font-semibold">{{ $career->title }}</h2>
                            <p class="text-gray-600">{{ $career->description }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mt-4 text-gray-600">Career opportunities will be posted soon.</p>
            @endif
        </div>
    </section>
@endsection
