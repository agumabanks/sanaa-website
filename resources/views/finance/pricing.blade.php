@extends('layouts.finance', [
    'title' => 'Pricing — Sanaa Finance',
    'breadcrumbs' => [ ['name' => 'Pricing'] ],
])
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-semibold mb-6">Pricing</h1>
    <div class="grid gap-6 md:grid-cols-3">
        @forelse($plans as $plan)
            <div class="border rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-medium">{{ $plan->name }}</h2>
                    @if($plan->badge)
                        <span class="text-xs px-2 py-1 rounded-full bg-gray-100">{{ $plan->badge }}</span>
                    @endif
                </div>
                <p class="text-gray-600 mt-2">{{ $plan->summary }}</p>
                <div class="mt-4">
                    @if($plan->monthly_price)
                        <div><span class="text-2xl font-semibold">${{ number_format($plan->monthly_price, 2) }}</span> <span class="text-gray-500">/mo</span></div>
                    @endif
                    @if($plan->annual_price)
                        <div class="text-gray-500">${{ number_format($plan->annual_price, 2) }} /yr</div>
                    @endif
                </div>
                @if($plan->features)
                    <ul class="mt-4 space-y-1 text-sm text-gray-700">
                        @foreach($plan->features as $f)
                            <li>• {{ $f }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="mt-6">
                    <a href="{{ $plan->cta_link ?: route('finance.contact-sales') }}" class="inline-flex rounded-md bg-emerald-600 text-white px-3 py-2 text-sm hover:bg-emerald-700">Choose</a>
                </div>
            </div>
        @empty
            <p>No plans yet.</p>
        @endforelse
    </div>
</section>
@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'SoftwareApplication',
    'name' => 'Sanaa Finance',
    'applicationCategory' => 'FinTech',
    'offers' => $plans->map(function($p){
        return [
            '@type' => 'Offer',
            'price' => (string)($p->monthly_price ?? $p->annual_price ?? 0),
            'priceCurrency' => 'USD',
            'name' => $p->name,
            'description' => $p->summary,
        ];
    })->values(),
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endpush
@endsection

