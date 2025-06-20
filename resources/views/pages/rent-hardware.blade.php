@extends('layouts.landing')

@section('title', 'Hardware Rentals | ' . config('app.name'))

@section('content')
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold">Rent Hardware</h1>
            @if($items->count())
                <ul class="mt-4 space-y-2">
                    @foreach($items as $hardware)
                        <li class="border-b pb-2">
                            <h2 class="font-semibold">{{ $hardware->name }}</h2>
                            <p class="text-gray-600">{{ $hardware->description }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mt-4 text-gray-600">Details on renting hardware will be available soon.</p>
            @endif
        </div>
    </section>
@endsection
