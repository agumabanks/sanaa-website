<x-pages-layout title="Features | Sanaa Cards - Complete Loyalty Platform">
    <x-slot name="metaDescription">
        Discover Sanaa Cards features: branded loyalty cards, points & rewards engine, member CRM, analytics dashboard, and more for your business.
    </x-slot>

    @push('styles')
    <style>
        body { background-color: #000 !important; color: #fff !important; }
        .page-content { margin-top: 0 !important; min-height: 100vh !important; }
        .page-footer { display: none; }
        :root { --emerald: #10b981; --blue: #3b82f6; --purple: #8b5cf6; }
        .text-gradient { background: linear-gradient(135deg, var(--emerald) 0%, var(--blue) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .glass { background: rgba(255,255,255,0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.08); }
        .orb { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; }
        .orb-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(16,185,129,0.12) 0%, transparent 70%); top: -10%; left: -5%; animation: orb1 20s ease-in-out infinite; }
        .orb-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, transparent 70%); top: 20%; right: -5%; animation: orb2 25s ease-in-out infinite; }
        @keyframes orb1 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(40px,30px); } }
        @keyframes orb2 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(-30px,-20px); } }
        .feature-card { background: linear-gradient(180deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.02) 100%); border: 1px solid rgba(255,255,255,0.08); transition: all 0.4s ease; }
        .feature-card:hover { border-color: var(--emerald); transform: translateY(-4px); box-shadow: 0 20px 40px -15px rgba(16,185,129,0.2); }
    </style>
    @endpush

    {{-- Hero --}}
    <section class="pb-20 bg-black relative overflow-hidden" style="padding-top: 384px;">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-emerald-500/10 via-transparent to-transparent"></div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold uppercase tracking-widest mb-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Platform Features
            </span>
            <h1 class="text-5xl md:text-7xl font-black tracking-tight text-white mb-6">
                Everything You Need to<br><span class="text-gradient">Build Loyalty</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                A complete operating system for customer loyalty, membership management, and repeat business growth.
            </p>
        </div>
    </section>

    {{-- Core Features Grid --}}
    <section class="py-24 bg-black">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                $features = [
                    ['icon' => 'card', 'color' => 'emerald', 'title' => 'Branded Loyalty Cards', 'description' => 'Issue custom physical NFC cards or digital wallet passes with your brand identity. Cards start from UGX 5,000 per unit with bulk discounts.'],
                    ['icon' => 'gift', 'color' => 'blue', 'title' => 'Points & Rewards Engine', 'description' => 'Automated point accumulation on every transaction. Set redemption rules, bonus multipliers, expiry dates, and special promotions.'],
                    ['icon' => 'users', 'color' => 'purple', 'title' => 'Member CRM Database', 'description' => 'Centralized customer profiles with purchase history, preferences, and contact details. Segment members for targeted marketing.'],
                    ['icon' => 'chart', 'color' => 'emerald', 'title' => 'Analytics Dashboard', 'description' => 'Real-time insights on retention rates, churn, lifetime value (LTV), revenue per member, and campaign performance.'],
                    ['icon' => 'mobile', 'color' => 'blue', 'title' => 'Mobile App Integration', 'description' => 'Members check balances, view rewards, and receive push notifications via the Sanaa mobile app. WhatsApp integration available.'],
                    ['icon' => 'terminal', 'color' => 'purple', 'title' => 'POS Integration', 'description' => 'Works with existing point-of-sale systems. Card tap, scan, or manual entry at checkout. Offline sync supported.'],
                    ['icon' => 'crown', 'color' => 'emerald', 'title' => 'VIP Tier System', 'description' => 'Create Bronze, Silver, Gold, Platinum tiers with escalating benefits, exclusive perks, and automatic tier upgrades.'],
                    ['icon' => 'mail', 'color' => 'blue', 'title' => 'SMS & Email Campaigns', 'description' => 'Send targeted promotions, birthday rewards, and win-back campaigns to segmented members. Automated drip sequences.'],
                    ['icon' => 'share', 'color' => 'purple', 'title' => 'Referral Programs', 'description' => 'Turn loyal customers into brand ambassadors. Multi-level referral rewards with trackable codes and instant payouts.'],
                ];
                $icons = [
                    'card' => '<rect x="1" y="4" width="22" height="16" rx="2" ry="2" stroke-width="1.5"/><line x1="1" y1="10" x2="23" y2="10" stroke-width="1.5"/>',
                    'gift' => '<polyline points="20 12 20 22 4 22 4 12" stroke-width="1.5"/><rect x="2" y="7" width="20" height="5" stroke-width="1.5"/><line x1="12" y1="22" x2="12" y2="7" stroke-width="1.5"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z" stroke-width="1.5"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z" stroke-width="1.5"/>',
                    'users' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke-width="1.5"/><circle cx="9" cy="7" r="4" stroke-width="1.5"/><path d="M23 21v-2a4 4 0 0 0-3-3.87" stroke-width="1.5"/><path d="M16 3.13a4 4 0 0 1 0 7.75" stroke-width="1.5"/>',
                    'chart' => '<line x1="18" y1="20" x2="18" y2="10" stroke-width="1.5"/><line x1="12" y1="20" x2="12" y2="4" stroke-width="1.5"/><line x1="6" y1="20" x2="6" y2="14" stroke-width="1.5"/>',
                    'mobile' => '<rect x="5" y="2" width="14" height="20" rx="2" ry="2" stroke-width="1.5"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2"/>',
                    'terminal' => '<polyline points="4 17 10 11 4 5" stroke-width="1.5"/><line x1="12" y1="19" x2="20" y2="19" stroke-width="1.5"/>',
                    'crown' => '<path d="M2 17l3-7 4 2 3-5 3 5 4-2 3 7H2zm0 0v2a2 2 0 002 2h16a2 2 0 002-2v-2" stroke-width="1.5"/>',
                    'mail' => '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke-width="1.5"/><polyline points="22,6 12,13 2,6" stroke-width="1.5"/>',
                    'share' => '<circle cx="18" cy="5" r="3" stroke-width="1.5"/><circle cx="6" cy="12" r="3" stroke-width="1.5"/><circle cx="18" cy="19" r="3" stroke-width="1.5"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49" stroke-width="1.5"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49" stroke-width="1.5"/>',
                ];
                $colors = ['emerald' => 'from-emerald-500/20 to-emerald-600/10 text-emerald-400', 'blue' => 'from-blue-500/20 to-blue-600/10 text-blue-400', 'purple' => 'from-purple-500/20 to-purple-600/10 text-purple-400'];
                @endphp
                
                @foreach($features as $f)
                <div class="feature-card rounded-2xl p-8">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br {{ $colors[$f['color']] }} flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icons[$f['icon']] !!}</svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">{{ $f['title'] }}</h3>
                    <p class="text-gray-400 leading-relaxed">{{ $f['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- How It Works --}}
    <section class="py-24 bg-gradient-to-b from-black via-gray-900/50 to-black">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-black text-white mb-6">How It Works</h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">Get your loyalty program running in three simple steps.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                    ['step' => '01', 'title' => 'Design Your Program', 'description' => 'Set up your reward rules, tier system, and card branding. Our team helps you configure the perfect loyalty structure.'],
                    ['step' => '02', 'title' => 'Enroll Members', 'description' => 'Issue cards at your location or let customers sign up digitally. Members get instant access to their rewards dashboard.'],
                    ['step' => '03', 'title' => 'Track & Optimize', 'description' => 'Monitor engagement, run campaigns, and watch retention grow. Real-time analytics help you make data-driven decisions.'],
                ] as $step)
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center mx-auto mb-6">
                        <span class="text-2xl font-black text-emerald-400">{{ $step['step'] }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">{{ $step['title'] }}</h3>
                    <p class="text-gray-400 leading-relaxed">{{ $step['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Industries --}}
    <section class="py-24 bg-black border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black text-white mb-6">Built For Every Industry</h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">From SACCOs to salons, restaurants to retail — Sanaa Cards works for any business that values repeat customers.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach(['Restaurants & Cafes', 'Retail Stores', 'Salons & Spas', 'Gyms & Fitness', 'SACCOs', 'Hotels', 'Pharmacies', 'Car Washes', 'Supermarkets', 'Clubs & Bars', 'Clinics', 'Fuel Stations'] as $industry)
                <div class="glass text-center py-4 px-3 rounded-xl">
                    <span class="text-sm text-gray-300">{{ $industry }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 bg-gradient-to-t from-emerald-500/10 to-black relative overflow-hidden">
        <div class="max-w-3xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-6">Ready to Build Customer Loyalty?</h2>
            <p class="text-xl text-gray-400 mb-10">Join 50+ Ugandan businesses using Sanaa Cards to grow repeat business.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-10 py-5 bg-emerald-500 text-white rounded-full font-bold text-lg hover:bg-emerald-400 transition-all shadow-lg shadow-emerald-500/30">Start Free Trial</a>
                <a href="{{ route('sanaa-cards.pricing') }}" class="px-8 py-4 border border-white/20 text-white rounded-full font-semibold hover:bg-white/5 transition-all">View Pricing →</a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-12 bg-black border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-500">
                <a href="{{ route('sanaa-cards.index') }}" class="hover:text-emerald-400">Home</a>
                <a href="{{ route('sanaa-cards.pricing') }}" class="hover:text-emerald-400">Pricing</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-400">Contact</a>
            </div>
            <p class="text-xs text-gray-600 mt-6">&copy; {{ date('Y') }} Sanaa. All rights reserved.</p>
        </div>
    </footer>
</x-pages-layout>
