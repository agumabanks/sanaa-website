<x-pages-layout title="Pricing | Sanaa Cards - Loyalty & Membership System">
    <x-slot name="metaDescription">
        Transparent pricing for Sanaa Cards loyalty system. Start free with 50 members, scale to Growth at UGX 75k/month, or contact us for Enterprise solutions.
    </x-slot>

    @push('styles')
    <style>
        body { background-color: #000 !important; color: #fff !important; }
        .page-content { margin-top: 0 !important; min-height: 100vh !important; }
        .page-footer { display: none; }
        :root { --emerald: #10b981; }
        .text-gradient { background: linear-gradient(135deg, var(--emerald) 0%, #3b82f6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .pricing-card { background: linear-gradient(180deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.02) 100%); border: 1px solid rgba(255,255,255,0.1); transition: all 0.4s ease; }
        .pricing-card:hover { border-color: rgba(255,255,255,0.2); transform: translateY(-4px); }
        .pricing-card.featured { background: linear-gradient(180deg, rgba(16,185,129,0.1) 0%, rgba(16,185,129,0.02) 100%); border-color: rgba(16,185,129,0.4); }
        .pricing-card.featured:hover { border-color: var(--emerald); box-shadow: 0 20px 60px -20px rgba(16,185,129,0.4); }
        .faq-item { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); transition: all 0.3s ease; }
        .faq-item:hover { border-color: rgba(255,255,255,0.15); }
        .orb { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; }
        .orb-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(16,185,129,0.12) 0%, transparent 70%); top: -10%; left: -5%; animation: orb1 20s ease-in-out infinite; }
        .orb-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, transparent 70%); top: 20%; right: -5%; animation: orb2 25s ease-in-out infinite; }
        @keyframes orb1 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(40px,30px); } }
        @keyframes orb2 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(-30px,-20px); } }
    </style>
    @endpush

    {{-- Hero --}}
    <section class="pb-16 bg-black relative overflow-hidden" style="padding-top: 384px;">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-emerald-500/10 via-transparent to-transparent"></div>
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold uppercase tracking-widest mb-8">
                Simple Pricing
            </span>
            <h1 class="text-5xl md:text-7xl font-black tracking-tight text-white mb-6">
                Plans That<br><span class="text-gradient">Scale With You</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                Start free, grow without limits. No hidden fees, no surprises.
            </p>
        </div>
    </section>

    {{-- Pricing Cards --}}
    <section class="py-16 bg-black">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8">
                
                {{-- Starter Plan --}}
                <div class="pricing-card rounded-3xl p-8 flex flex-col">
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-white mb-2">Starter</h3>
                        <p class="text-sm text-gray-500">Perfect for testing loyalty programs</p>
                    </div>
                    <div class="mb-8">
                        <span class="text-5xl font-black text-white">Free</span>
                    </div>
                    <a href="{{ route('register') }}" class="block w-full py-4 bg-white/10 border border-white/20 text-white font-bold rounded-xl text-center hover:bg-white/15 transition-all mb-8">
                        Get Started
                    </a>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Up to 50 members
                        </li>
                        <li class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            1 loyalty campaign
                        </li>
                        <li class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Digital wallet passes
                        </li>
                        <li class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Basic analytics
                        </li>
                        <li class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Email support
                        </li>
                    </ul>
                </div>

                {{-- Growth Plan --}}
                <div class="pricing-card featured rounded-3xl p-8 flex flex-col relative md:-mt-4 md:mb-[-16px]">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-emerald-500 text-black px-5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
                        Most Popular
                    </div>
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-emerald-400 mb-2">Growth</h3>
                        <p class="text-sm text-gray-400">For scaling membership systems</p>
                    </div>
                    <div class="mb-8">
                        <span class="text-5xl font-black text-white">UGX 75k</span>
                        <span class="text-gray-500 ml-1">/month</span>
                    </div>
                    <a href="{{ route('register') }}" class="block w-full py-4 bg-emerald-500 text-black font-bold rounded-xl text-center hover:bg-emerald-400 transition-all shadow-lg shadow-emerald-500/30 mb-8">
                        Start 14-Day Free Trial
                    </a>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-center gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Up to 2,000 members
                        </li>
                        <li class="flex items-center gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Unlimited campaigns
                        </li>
                        <li class="flex items-center gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            VIP tier system
                        </li>
                        <li class="flex items-center gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Advanced analytics
                        </li>
                        <li class="flex items-center gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Custom branding
                        </li>
                        <li class="flex items-center gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            SMS campaigns (pay-as-you-go)
                        </li>
                        <li class="flex items-center gap-3 text-gray-300">
                            <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Priority support
                        </li>
                    </ul>
                </div>

                {{-- Enterprise Plan --}}
                <div class="pricing-card rounded-3xl p-8 flex flex-col">
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-white mb-2">Enterprise</h3>
                        <p class="text-sm text-gray-500">For large-scale networks</p>
                    </div>
                    <div class="mb-8">
                        <span class="text-5xl font-black text-white">Custom</span>
                    </div>
                    <a href="{{ route('contact') }}" class="block w-full py-4 bg-white/10 border border-white/20 text-white font-bold rounded-xl text-center hover:bg-white/15 transition-all mb-8">
                        Contact Sales
                    </a>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Unlimited members
                        </li>
                        <li class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Multi-branch management
                        </li>
                        <li class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            API & POS integration
                        </li>
                        <li class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            White-label options
                        </li>
                        <li class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Dedicated account manager
                        </li>
                        <li class="flex items-center gap-3 text-gray-400">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            SLA guarantee
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Additional Costs --}}
    <section class="py-16 bg-black border-t border-white/5">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-white text-center mb-12">Additional Costs</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="text-center p-6">
                    <div class="text-3xl font-black text-white mb-2">UGX 5k-8k</div>
                    <div class="text-sm text-gray-400">Per physical NFC card</div>
                    <div class="text-xs text-gray-500 mt-1">Bulk discounts available</div>
                </div>
                <div class="text-center p-6">
                    <div class="text-3xl font-black text-white mb-2">UGX 35</div>
                    <div class="text-sm text-gray-400">Per SMS message</div>
                    <div class="text-xs text-gray-500 mt-1">Pay-as-you-go</div>
                </div>
                <div class="text-center p-6">
                    <div class="text-3xl font-black text-white mb-2">Free</div>
                    <div class="text-sm text-gray-400">Digital wallet passes</div>
                    <div class="text-xs text-gray-500 mt-1">Included in all plans</div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="py-24 bg-black">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-3xl font-black text-white text-center mb-16">Frequently Asked Questions</h2>
            <div class="space-y-4">
                @foreach([
                    ['q' => 'Can I switch plans later?', 'a' => 'Yes, upgrade or downgrade anytime. Your data and member balances migrate automatically with zero downtime.'],
                    ['q' => 'Is there a contract or commitment?', 'a' => 'No long-term contracts. Pay month-to-month and cancel anytime. Enterprise plans may have custom terms.'],
                    ['q' => 'What payment methods do you accept?', 'a' => 'We accept Mobile Money (MTN, Airtel), bank transfers, and card payments via Flutterwave.'],
                    ['q' => 'How secure is member data?', 'a' => 'We use bank-grade encryption for all PII and transaction records. Your data can be exported via secure CSV at any time.'],
                    ['q' => 'Do you support offline POS?', 'a' => 'Yes. Our platform supports sync-on-reconnect features for mobile and tablet POS systems.'],
                    ['q' => 'Can I get help setting up my program?', 'a' => 'Absolutely. Our team provides free onboarding assistance for all Growth and Enterprise customers.'],
                ] as $faq)
                <div class="faq-item rounded-xl p-6">
                    <h4 class="font-bold text-white mb-3">{{ $faq['q'] }}</h4>
                    <p class="text-gray-400">{{ $faq['a'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 bg-gradient-to-t from-emerald-500/10 to-black">
        <div class="max-w-3xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black text-white mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-gray-400 mb-10">Join 50+ Ugandan businesses building customer loyalty with Sanaa Cards.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-10 py-5 bg-emerald-500 text-white rounded-full font-bold text-lg hover:bg-emerald-400 transition-all shadow-lg shadow-emerald-500/30">Start Free Trial</a>
                <a href="{{ route('contact') }}" class="px-8 py-4 border border-white/20 text-white rounded-full font-semibold hover:bg-white/5 transition-all">Talk to Sales</a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-12 bg-black border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-500">
                <a href="{{ route('sanaa-cards.index') }}" class="hover:text-emerald-400">Home</a>
                <a href="{{ route('sanaa-cards.features') }}" class="hover:text-emerald-400">Features</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-400">Contact</a>
            </div>
            <p class="text-xs text-gray-600 mt-6">&copy; {{ date('Y') }} Sanaa. All rights reserved.</p>
        </div>
    </footer>
</x-pages-layout>
