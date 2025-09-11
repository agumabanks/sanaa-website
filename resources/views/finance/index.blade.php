@extends('layouts.finance', [
    'title' => 'Sanaa Finance',
    'breadcrumbs' => [ ['name' => 'Overview'] ],
])

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid gap-8 md:grid-cols-2 items-center">
        <div>
            <h1 class="text-3xl md:text-5xl font-semibold tracking-tight">Better Banking. Built for Africa.</h1>
            <p class="mt-4 text-gray-600 max-w-prose">Modern rails for cards, core banking, and digital channels—secure, compliant, and fast. Designed with a minimal, accessible interface.</p>
            <div class="mt-6 flex gap-3">
                <a href="{{ route('finance.contact-sales') }}" class="inline-flex items-center rounded-md bg-emerald-600 text-white px-4 py-2 text-sm font-medium hover:bg-emerald-700">Contact Sales</a>
                <a href="{{ route('finance.pricing') }}" class="inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-50">Pricing</a>
            </div>
        </div>
        <div class="rounded-lg border border-gray-200 p-6">
            <dl class="grid grid-cols-2 gap-6 text-sm">
                <div><dt class="text-gray-500">Active Plans</dt><dd class="text-xl font-semibold">{{ $pricingPlans->count() }}</dd></div>
                <div><dt class="text-gray-500">Card Products</dt><dd class="text-xl font-semibold">{{ $cards->count() }}</dd></div>
                <div><dt class="text-gray-500">Technologies</dt><dd class="text-xl font-semibold">{{ $technologies->count() }}</dd></div>
                <div><dt class="text-gray-500">Team</dt><dd class="text-xl font-semibold">{{ $team->count() }}</dd></div>
            </dl>
        </div>
    </div>
</section>

@if($pages->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-lg font-semibold mb-4">Latest Finance Pages</h2>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($pages as $p)
            <a href="{{ route('finance.show', ['page' => $p->slug]) }}" class="block border border-gray-200 rounded-lg p-4 hover:border-gray-300 focus-visible:focus">
                <h3 class="font-medium">{{ $p->title }}</h3>
                <p class="text-sm text-gray-600 line-clamp-2 mt-1">{{ $p->meta_description ?? 'Page' }}</p>
            </a>
        @endforeach
    </div>
</section>
@endif
@endsection

