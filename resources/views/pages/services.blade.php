@extends('layouts.landing')

@section('title', 'Services | ' . config('app.name'))

@section('content')
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold">Services</h1>
            @if($items->count())
                <ul class="mt-4 space-y-2">
                    @foreach($items as $item)
                        <li class="border-b pb-2">
                            <h2 class="font-semibold">{{ $item->title }}</h2>
                            <p class="text-gray-600">{{ $item->description }}</p>
                            @if($item->link)
                                <a href="{{ $item->link }}" class="text-primary underline" target="_blank">Learn more</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mt-4 text-gray-600">Service information will be added soon.</p>
            @endif
        </div>
    </section>
@endsection
