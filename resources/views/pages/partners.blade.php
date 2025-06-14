@extends('layouts.landing')

@section('content')
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold">Partners</h1>
            @if($items->count())
                <ul class="mt-4 space-y-2">
                    @foreach($items as $partner)
                        <li class="border-b pb-2">
                            <h2 class="font-semibold">{{ $partner->name }}</h2>
                            <p class="text-gray-600">{{ $partner->description }}</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mt-4 text-gray-600">Information for partners will be added soon.</p>
            @endif
        </div>
    </section>
@endsection
