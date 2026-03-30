@extends('layouts.finance', [
    'title' => 'Cards — Sanaa Finance',
    'breadcrumbs' => [ ['name' => 'Cards'] ],
])
@section('content')
{{-- Hero Section --}}
<section class="bg-gradient-to-br from-emerald-50 to-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 text-center">
        <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700 mb-4">
            Sanaa Card Systems
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900 mb-6">
            Drive Growth with <span class="text-emerald-600">Sanaa Card Systems</span>
        </h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-10">
            Build customer loyalty, automate rewards, and retain your best clients with Uganda's most flexible business card infrastructure. Designed for businesses looking to grow and reward.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('sanaa-cards.index') }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600 text-white px-8 py-3 text-base font-semibold hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-500/25">
                Explore Loyalty System
            </a>
            <a href="{{ route('finance.contact-sales') }}" class="inline-flex items-center justify-center rounded-lg border-2 border-emerald-200 px-8 py-3 text-base font-semibold text-emerald-700 hover:bg-emerald-50 transition-colors">
                Contact Sales
            </a>
        </div>
    </div>
</section>

{{-- Loyalty & Rewards Section --}}
<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Loyalty & Rewards Reimagined</h2>
                <div class="space-y-8">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">Instant Cashback</h3>
                            <p class="text-gray-600 text-sm">Reward customers instantly with cashback to their cards or mobile money when they shop at your business.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">Loyalty Points System</h3>
                            <p class="text-gray-600 text-sm">Launch custom point systems. Customers earn points for every UGX spent, redeemable for rewards or discounts.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">Tiered Membership</h3>
                            <p class="text-gray-600 text-sm">Retain your best clients with tiered membership levels (Silver, Gold, Platinum) and exclusive perks.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-video rounded-2xl bg-emerald-600 overflow-hidden shadow-2xl flex items-center justify-center text-white">
                    <div class="p-8 text-center">
                        <svg class="h-20 w-20 mx-auto mb-4 opacity-50" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
                        <p class="text-2xl font-bold">Your Client Cards</p>
                        <p class="text-emerald-100 text-sm mt-2">Custom Branded & Integrated</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Retain & Grow Section --}}
<section class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Retain and grow your clients</h2>
            <p class="text-lg text-gray-600">Powerful analytics and automation to help you understand your customers and drive repeat business.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
                <h3 class="font-bold text-gray-900 text-xl mb-3">Customer Insights</h3>
                <p class="text-gray-600 text-sm">See spending patterns, frequency of visits, and average order values for every cardholder.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
                <h3 class="font-bold text-gray-900 text-xl mb-3">Targeted Campaigns</h3>
                <p class="text-gray-600 text-sm">Export customer segments and launch targeted rewards for those who haven't visited in a while.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
                <h3 class="font-bold text-gray-900 text-xl mb-3">Automated Growth</h3>
                <p class="text-gray-600 text-sm">Set up automated birthday rewards or milestone bonuses to keep your clients engaged without manual work.</p>
            </div>
        </div>
    </div>
</section>

{{-- Card Products Table --}}
<section id="products" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
    <h2 class="text-3xl font-bold text-gray-900 mb-8">Available Card Products</h2>
    <div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow-sm">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-600 uppercase text-xs tracking-wider">
                <tr>
                    <th class="py-4 px-6 font-semibold">Product</th>
                    <th class="py-4 px-6 font-semibold">Fees</th>
                    <th class="py-4 px-6 font-semibold">Features</th>
                    <th class="py-4 px-6 font-semibold">Eligibility</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($cards as $c)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-6 px-6">
                            <div class="font-bold text-gray-900 text-base">{{ $c->name }}</div>
                        </td>
                        <td class="py-6 px-6 text-gray-700">
                            @if($c->fees)
                                <ul class="space-y-1">
                                    @foreach($c->fees as $k=>$v)
                                        <li class="flex items-center gap-2">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            <span class="font-medium">{{ $k }}:</span> {{ $v }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td class="py-6 px-6 text-gray-700">
                            @if($c->features)
                                <ul class="space-y-1">
                                    @foreach($c->features as $f)
                                        <li class="flex items-start gap-2">
                                            <svg class="h-4 w-4 text-emerald-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            {{ $f }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td class="py-6 px-6 text-gray-700 leading-relaxed">{!! nl2br(e($c->eligibility)) !!}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="py-12 text-center text-gray-500 italic">No cards published yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'itemListElement' => $cards->map(function($c, $i){
        return [
            '@type' => 'ListItem',
            'position' => $i+1,
            'item' => [
                '@type' => 'FinancialProduct',
                'name' => $c->name,
                'description' => $c->features ? implode(', ', (array) $c->features) : null,
            ],
        ];
    })->values(),
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) !!}
</script>
@endpush
@endsection
