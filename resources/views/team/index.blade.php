@extends('layouts.landing')

@section('content')
<div class="container mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold mb-8 text-center">Our Team</h1>
    <div class="grid md:grid-cols-3 gap-8">
        @foreach($members as $member)
            <div class="text-center">
                @if($member->photo)
                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="w-32 h-32 rounded-full mx-auto mb-4">
                @endif
                <h3 class="text-xl font-semibold">{{ $member->name }}</h3>
                @if($member->title)
                    <p class="text-gray-600">{{ $member->title }}</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
