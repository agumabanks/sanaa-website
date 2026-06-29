@extends('layouts.landing')

@section('title', 'Hardware Rentals | ' . config('app.name'))
@section('seo_title', 'Hardware Rentals | Sanaa Co. — POS & Tech Equipment')
@section('seo_description', 'Rent POS hardware, tablets, and technology equipment for your business in Uganda. Flexible rental options for Soko 24 and Sanaa Finance deployments.')
@section('seo_keywords', 'POS hardware rental Uganda, tablet rental, tech equipment rental, Sanaa hardware, business equipment Uganda')

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
