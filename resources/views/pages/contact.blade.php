@extends('layouts.landing')

@section('content')
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold">Contact Us</h1>
            <p class="mt-4 text-gray-600">Reach out to us at <a href="mailto:info@sanaa.co" class="text-green-600 underline">info@sanaa.co</a>.</p>
            @if($items->count())
                <ul class="mt-4 space-y-2">
                    @foreach($items as $msg)
                        <li class="border-b pb-2">
                            <p class="font-semibold">{{ $msg->name }} ({{ $msg->email }})</p>
                            <p class="text-gray-600">{{ $msg->message }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </section>
@endsection
