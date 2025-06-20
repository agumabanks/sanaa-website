@extends('layouts.landing')

@section('content')
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold">{{ $policy->title }}</h1>
        <div class="mt-4 prose">
            {!! $policy->content !!}
        </div>
    </div>
</section>
@endsection
