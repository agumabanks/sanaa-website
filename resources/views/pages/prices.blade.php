@extends('layouts.landing')

@section('title', 'Prices | ' . config('app.name'))

@section('content')
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold">Pricing</h1>
            @if($items->count())
                <ul class="mt-4 space-y-2">
                    @foreach($items as $item)
                        <li class="border-b pb-2">
                            <h2 class="font-semibold">{{ $item->name }} - {{ $item->price }}</h2>
                            <p class="text-gray-600">{{ $item->description }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mt-4 text-gray-600">Pricing details will be published soon.</p>
            @endif
        </div>
    </section>
@endsection
