@extends('layouts.finance', [
    'title' => 'Pricing — Sanaa Finance',
    'metaDescription' => 'Simple, transparent pricing for Ugandan businesses. No hidden fees. Start free and scale as you grow with Sanaa Finance.',
    'breadcrumbs' => [ ['name' => 'Pricing'] ],
])
@section('content')
{{-- Hero --}}
<section class="bg-gradient-to-br from-emerald-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900">Simple, transparent pricing</h1>
        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">No hidden fees. No monthly minimums. Pay only for what you use. Start free and scale as you grow.</p>
    </div>
</section>

{{-- Transaction Fees --}}
<section class="border-b border-gray-100 bg-white py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold text-gray-900 text-center mb-8">Transaction Fees (All Plans)</h2>
        <div class="grid md:grid-cols-4 gap-6">
            <div class="text-center p-4 rounded-lg bg-gray-50">
                <p class="text-sm text-gray-600">Mobile Money Collection</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">1.5%</p>
                <p class="text-xs text-gray-500">MTN MoMo & Airtel Money</p>
            </div>
            <div class="text-center p-4 rounded-lg bg-gray-50">
                <p class="text-sm text-gray-600">Mobile Money Payout</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">UGX 500</p>
                <p class="text-xs text-gray-500">Flat fee per payout</p>
            </div>
            <div class="text-center p-4 rounded-lg bg-gray-50">
                <p class="text-sm text-gray-600">Bank Transfer (EFT)</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">UGX 3,000</p>
                <p class="text-xs text-gray-500">To any Ugandan bank</p>
            </div>
            <div class="text-center p-4 rounded-lg bg-gray-50">
                <p class="text-sm text-gray-600">Card Transactions</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">Free</p>
                <p class="text-xs text-gray-500">POS & Online purchases</p>
            </div>
        </div>
    </div>
</section>

{{-- Plans Grid --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid gap-6 lg:grid-cols-3 xl:grid-cols-5">
        @forelse($plans as $plan)
            <div class="relative border rounded-2xl p-6 {{ $plan->badge === 'Most Popular' ? 'border-emerald-500 ring-2 ring-emerald-500' : 'border-gray-200' }} bg-white flex flex-col">
                @if($plan->badge)
                    <span class="absolute -top-3 left-1/2 -translate-x-1/2 inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $plan->badge === 'Most Popular' ? 'bg-emerald-600 text-white' : ($plan->badge === 'For SACCOs' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700') }}">
                        {{ $plan->badge }}
                    </span>
                @endif
                
                <div class="mb-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ $plan->name }}</h2>
                    <p class="text-gray-600 text-sm mt-1">{{ $plan->summary }}</p>
                </div>
                
                <div class="mb-6">
                    @if($plan->monthly_price === null)
                        <p class="text-3xl font-bold text-gray-900">Custom</p>
                        <p class="text-sm text-gray-500">Contact us for pricing</p>
                    @elseif($plan->monthly_price == 0)
                        <p class="text-3xl font-bold text-gray-900">Free</p>
                        <p class="text-sm text-gray-500">Forever</p>
                    @else
                        <p class="text-3xl font-bold text-gray-900">UGX {{ number_format($plan->monthly_price, 0) }}</p>
                        <p class="text-sm text-gray-500">/month</p>
                        @if($plan->annual_price)
                            <p class="text-xs text-emerald-600 mt-1">UGX {{ number_format($plan->annual_price, 0) }}/year (save 2 months)</p>
                        @endif
                    @endif
                </div>
                
                @if($plan->features)
                    <ul class="space-y-3 text-sm text-gray-700 flex-grow">
                        @foreach($plan->features as $f)
                            <li class="flex items-start gap-2">
                                <svg class="h-5 w-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span>{{ $f }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
                
                <div class="mt-6">
                    <a href="{{ $plan->cta_link ?: route('finance.contact-sales') }}" 
                       class="block w-full text-center rounded-lg px-4 py-3 text-sm font-semibold transition-colors {{ $plan->badge === 'Most Popular' ? 'bg-emerald-600 text-white hover:bg-emerald-700' : 'bg-gray-100 text-gray-900 hover:bg-gray-200' }}">
                        {{ $plan->monthly_price === null ? 'Contact Sales' : ($plan->monthly_price == 0 ? 'Get Started Free' : 'Choose ' . $plan->name) }}
                    </a>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-600">No plans available.</p>
        @endforelse
    </div>
</section>

{{-- FAQ Section --}}
<section class="bg-gray-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 text-center mb-12">Frequently Asked Questions</h2>
        
        <div class="space-y-6">
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="font-semibold text-gray-900">Are there any hidden fees?</h3>
                <p class="mt-2 text-gray-600">No. Our pricing is completely transparent. You only pay the transaction fees listed above and your chosen plan's monthly fee (if any). No setup fees, no minimum balances, no surprise charges.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="font-semibold text-gray-900">Can I switch plans later?</h3>
                <p class="mt-2 text-gray-600">Yes! You can upgrade or downgrade your plan at any time. Upgrades take effect immediately, and downgrades take effect at the start of your next billing cycle.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="font-semibold text-gray-900">What payment methods do you accept for plan subscriptions?</h3>
                <p class="mt-2 text-gray-600">We accept MTN Mobile Money, Airtel Money, and bank transfers for monthly/annual plan payments. You can also set up automatic deductions from your Sanaa Finance balance.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="font-semibold text-gray-900">Is there a minimum transaction volume?</h3>
                <p class="mt-2 text-gray-600">No minimum transaction volume is required. The Starter plan includes 50 free transactions per month, and paid plans have unlimited transactions.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="font-semibold text-gray-900">What's included in the SACCO Pro plan?</h3>
                <p class="mt-2 text-gray-600">SACCO Pro includes everything you need to run a SACCO: member management, share capital tracking, loan origination and recovery, dividend distribution, AGM voting, member mobile app, and URBRA-compliant reporting.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="font-semibold text-gray-900">Do you offer discounts for annual billing?</h3>
                <p class="mt-2 text-gray-600">Yes! When you pay annually, you get 2 months free (effectively a ~17% discount). Annual billing is available for all paid plans.</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-emerald-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Ready to get started?</h2>
        <p class="text-emerald-100 mb-8">Join thousands of Ugandan businesses using Sanaa Finance. Open your free account in minutes.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('finance.contact-sales') }}" class="inline-flex items-center justify-center rounded-lg bg-white text-emerald-600 px-8 py-3 text-base font-semibold hover:bg-emerald-50 transition-colors">
                Get Started Free
            </a>
            <a href="{{ route('finance.contact-sales') }}" class="inline-flex items-center justify-center rounded-lg border-2 border-white text-white px-8 py-3 text-base font-semibold hover:bg-emerald-700 transition-colors">
                Talk to Sales
            </a>
        </div>
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
            'price' => (string)($p->monthly_price ?? 0),
            'priceCurrency' => 'UGX',
            'name' => $p->name,
            'description' => $p->summary,
        ];
    })->values(),
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endpush
@endsection

