@extends('layouts.landing')

@section('title', 'Sanaa POS Pricing — Sanaa Co.')
@section('seo_title', 'Sanaa POS Pricing — Sanaa Co.')
@section('seo_description', 'Sanaa POS pricing sits alongside separate pricing paths for Soko 24, Sanaa Finance SaaS, and Baraka 24.')
@section('seo_image', asset('storage/images/sanaa-logo-b.svg'))

@section('content')
@php
    $plans = [
        [
            'name' => 'Starter',
            'price' => 'UGX 0',
            'period' => 'per month',
            'description' => 'For small teams getting started with Sanaa POS.',
            'features' => [
                'Basic POS and catalogue',
                'Single location setup',
                'Sales tracking',
            ],
        ],
        [
            'name' => 'Plus',
            'price' => 'UGX 49,000',
            'period' => 'per month',
            'description' => 'For growing businesses that need staff controls and deeper reporting.',
            'features' => [
                'Advanced POS workflows',
                'Staff roles and permissions',
                'Priority support',
            ],
        ],
        [
            'name' => 'Premium',
            'price' => 'UGX 149,000',
            'period' => 'per month',
            'description' => 'For businesses running multiple counters, teams, or branches.',
            'features' => [
                'Multi-location support',
                'Exports and advanced reporting',
                'Deployment assistance',
            ],
        ],
    ];

    $otherProducts = [
        ['title' => 'Soko 24', 'link' => 'https://soko24.co', 'target' => '_blank'],
        ['title' => 'Sanaa Finance SaaS', 'link' => route('finance.pricing'), 'target' => null],
        ['title' => 'Baraka 24', 'link' => 'https://baraka.sanaa.ug', 'target' => '_blank'],
        ['title' => 'Sanaa Cloud', 'link' => route('sanaa-cloud'), 'target' => null],
    ];
@endphp

<section class="bg-black text-white min-h-screen">
    <div class="max-w-6xl mx-auto px-6 py-28">
        <div class="max-w-3xl">
            <p class="text-xs uppercase tracking-[0.25em] text-gray-500">Sanaa POS Pricing</p>
            <h1 class="mt-6 text-5xl font-light tracking-tight">Pricing for the POS layer, not the whole company.</h1>
            <p class="mt-6 text-lg text-gray-300 leading-8">Sanaa POS has its own pricing. Soko 24, Baraka 24, and Sanaa Finance SaaS are priced separately because they solve different operating problems.</p>
        </div>

        <div class="mt-14 grid md:grid-cols-3 gap-6">
            @foreach($plans as $plan)
                <article class="rounded-3xl border border-white/10 bg-white/5 p-8">
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-500">{{ $plan['name'] }}</p>
                    <h2 class="mt-4 text-4xl font-light">{{ $plan['price'] }}</h2>
                    <p class="mt-2 text-gray-400">{{ $plan['period'] }}</p>
                    <p class="mt-5 text-gray-300 leading-7">{{ $plan['description'] }}</p>
                    <ul class="mt-6 space-y-3 text-gray-300">
                        @foreach($plan['features'] as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </div>

        <div class="mt-16 rounded-3xl border border-white/10 bg-white/5 p-8">
            <h2 class="text-2xl font-light">Other products have separate pricing.</h2>
            <div class="mt-6 flex flex-wrap gap-4">
                @foreach($otherProducts as $product)
                    <a href="{{ $product['link'] }}" class="inline-flex items-center rounded-full border border-white/15 px-5 py-3 hover:bg-white/5 transition-colors" @if($product['target']) target="{{ $product['target'] }}" rel="noopener noreferrer" @endif>{{ $product['title'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
