<x-pages-layout title="Sanaa Cards | The Complete Loyalty & Membership System">
    <x-slot name="metaDescription">
        {{ Str::limit(strip_tags($settings['hero_description'] ?? 'Transform customers into loyal members with Uganda\'s complete loyalty platform.'), 160) }}
    </x-slot>

    @push('styles')
    <style>
        body { background-color: #000 !important; color: #fff !important; font-family: 'Figtree', sans-serif !important; }
        .page-content { margin-top: 0 !important; min-height: 100vh !important; }
        .page-footer { display: none; }
        :root { --emerald: #10b981; --blue: #3b82f6; }
        .text-gradient-emerald { background: linear-gradient(135deg, var(--emerald) 0%, var(--blue) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .glass { background: rgba(255,255,255,0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.08); }
        .orb { position: absolute; border-radius: 50%; filter: blur(80px); pointer-events: none; }
        .orb-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(16,185,129,0.12) 0%, transparent 70%); top: -10%; left: -5%; animation: orb1 20s ease-in-out infinite; }
        .orb-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(59,130,246,0.08) 0%, transparent 70%); top: 20%; right: -5%; animation: orb2 25s ease-in-out infinite; }
        @keyframes orb1 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(40px,30px); } }
        @keyframes orb2 { 0%,100% { transform: translate(0,0); } 50% { transform: translate(-30px,-20px); } }
        .reveal { opacity: 0; transform: translateY(24px); transition: all 0.7s cubic-bezier(0.23,1,0.32,1); }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .bento { background: #0a0a0a; border: 1px solid #1a1a1a; transition: all 0.4s ease; }
        .bento:hover { border-color: rgba(16,185,129,0.4); transform: translateY(-4px); box-shadow: 0 20px 40px -15px rgba(16,185,129,0.15); }
        .industry-card { background: linear-gradient(180deg, #0a0a0a 0%, #050505 100%); border: 1px solid #1a1a1a; transition: all 0.4s ease; }
        .industry-card:hover { border-color: var(--emerald); }
        .pulse-glow { animation: pulse 2s ease-in-out infinite; }
        @keyframes pulse { 0%,100% { box-shadow: 0 0 20px rgba(16,185,129,0.3); } 50% { box-shadow: 0 0 40px rgba(16,185,129,0.5); } }
        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
        .float { animation: float 5s ease-in-out infinite; }
    </style>
    @endpush

    {{-- HERO --}}
    <section class="relative min-h-screen flex items-center pb-20 overflow-hidden bg-black" style="padding-top: 320px;">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full glass">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-xs font-bold tracking-widest text-gray-400 uppercase">{{ $settings['hero_badge'] ?? 'Uganda\'s Loyalty Platform' }}</span>
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-[1.1]">
                        <span class="text-white">Transform Customers Into</span><br>
                        <span class="text-gradient-emerald">Loyal Members</span>
                    </h1>
                    <p class="text-lg text-gray-400 leading-relaxed max-w-xl">{{ $settings['hero_description'] ?? 'Issue branded loyalty cards, automate rewards, and grow repeat business across Uganda.' }}</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-emerald-500 text-white rounded-full font-bold text-base hover:bg-emerald-400 transition-all pulse-glow text-center">{{ $settings['hero_cta_primary'] ?? 'Start Free Trial' }}</a>
                        <a href="{{ route('contact') }}" class="px-8 py-4 border border-white/20 text-white rounded-full font-semibold hover:bg-white/5 transition-all text-center">{{ $settings['hero_cta_secondary'] ?? 'Book a Demo' }} →</a>
                    </div>
                    <div class="flex items-center gap-4 pt-4">
                        <div class="flex -space-x-2">
                            @foreach(['JM','GN','SO','PA'] as $i => $init)
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-500 to-blue-500 flex items-center justify-center text-xs font-bold text-white ring-2 ring-black">{{ $init }}</div>
                            @endforeach
                        </div>
                        <span class="text-sm text-gray-500">Built for membership, loyalty, and repeat business in Uganda</span>
                    </div>
                </div>
                <div class="relative hidden lg:block">
                    <div class="relative">
                        <img src="{{ asset('storage/sanaa-cards/card1.png') }}" alt="Sanaa Loyalty Card" class="w-80 mx-auto rounded-2xl shadow-2xl float">
                        <div class="absolute -bottom-4 -left-4 glass p-4 rounded-xl float" style="animation-delay:-2s">
                            <div class="text-xs text-emerald-400 font-bold uppercase mb-1">Rewards</div>
                            <div class="text-2xl font-black text-white">Live</div>
                        </div>
                        <div class="absolute -top-4 -right-4 glass p-4 rounded-xl float" style="animation-delay:-4s">
                            <div class="text-xs text-blue-400 font-bold uppercase mb-1">Card Types</div>
                            <div class="text-2xl font-black text-white">Physical + Digital</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STATS --}}
    <section class="py-16 bg-[#030303] border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach([
                    ['value' => 'Branded cards', 'label' => 'Physical and digital membership cards'],
                    ['value' => 'Rewards engine', 'label' => 'Points, tiers, and redemption rules'],
                    ['value' => 'Member CRM', 'label' => 'Profiles, history, and campaign lists'],
                    ['value' => 'Analytics', 'label' => 'Usage, retention, and reward performance'],
                ] as $stat)
                <div class="reveal text-center">
                    <div class="text-2xl md:text-3xl font-black text-white mb-1">{{ $stat['value'] }}</div>
                    <div class="text-xs text-gray-500 uppercase tracking-wider">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section class="py-24 bg-black relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-emerald-500/5 via-transparent to-transparent pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="reveal text-center mb-20 max-w-3xl mx-auto">
                <span class="text-emerald-400 font-bold uppercase tracking-[0.2em] text-xs mb-4 block">Complete Platform</span>
                <h2 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tight">Everything You Need to Run a<br><span class="text-gradient-emerald">Membership Business</span></h2>
                <p class="text-lg text-gray-400">A complete operating system for customer loyalty and retention.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                $defaultFeatures = [
                    ['icon' => 'card', 'title' => 'Branded Loyalty Cards', 'description' => 'Issue custom physical NFC cards or digital wallet passes with your brand identity. Starting from UGX 5,000 per card.'],
                    ['icon' => 'gift', 'title' => 'Points & Rewards Engine', 'description' => 'Automated point accumulation on every transaction. Set redemption rules, bonus multipliers, and expiry dates.'],
                    ['icon' => 'users', 'title' => 'Member CRM Database', 'description' => 'Centralized customer profiles with purchase history, preferences, and contact details for targeted marketing.'],
                    ['icon' => 'chart', 'title' => 'Analytics Dashboard', 'description' => 'Real-time insights on retention, churn, lifetime value (LTV), and revenue per member.'],
                    ['icon' => 'mobile', 'title' => 'Mobile App Integration', 'description' => 'Members check balances, view rewards, and receive notifications via the Sanaa mobile app.'],
                    ['icon' => 'terminal', 'title' => 'POS Integration', 'description' => 'Works with existing point-of-sale systems. Card tap, scan, or manual entry at checkout.'],
                    ['icon' => 'crown', 'title' => 'VIP Tier System', 'description' => 'Create Bronze, Silver, Gold, Platinum tiers with escalating benefits and exclusive perks.'],
                    ['icon' => 'mail', 'title' => 'SMS & Email Campaigns', 'description' => 'Send targeted promotions, birthday rewards, and win-back campaigns to segmented members.'],
                ];
                $features = $settings['features_grid'] ?? $defaultFeatures;
                $icons = [
                    'card' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2" ry="2" stroke-width="1.5"/><line x1="1" y1="10" x2="23" y2="10" stroke-width="1.5"/></svg>',
                    'gift' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="20 12 20 22 4 22 4 12" stroke-width="1.5"/><rect x="2" y="7" width="20" height="5" stroke-width="1.5"/><line x1="12" y1="22" x2="12" y2="7" stroke-width="1.5"/><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z" stroke-width="1.5"/><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z" stroke-width="1.5"/></svg>',
                    'users' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke-width="1.5"/><circle cx="9" cy="7" r="4" stroke-width="1.5"/><path d="M23 21v-2a4 4 0 0 0-3-3.87" stroke-width="1.5"/><path d="M16 3.13a4 4 0 0 1 0 7.75" stroke-width="1.5"/></svg>',
                    'chart' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10" stroke-width="1.5"/><line x1="12" y1="20" x2="12" y2="4" stroke-width="1.5"/><line x1="6" y1="20" x2="6" y2="14" stroke-width="1.5"/></svg>',
                    'mobile' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2" ry="2" stroke-width="1.5"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="1.5"/></svg>',
                    'terminal' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="4 17 10 11 4 5" stroke-width="1.5"/><line x1="12" y1="19" x2="20" y2="19" stroke-width="1.5"/></svg>',
                    'crown' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M2 17l3-7 4 2 3-5 3 5 4-2 3 7H2zm0 0v2a2 2 0 002 2h16a2 2 0 002-2v-2" stroke-width="1.5"/></svg>',
                    'mail' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke-width="1.5"/><polyline points="22,6 12,13 2,6" stroke-width="1.5"/></svg>',
                    'default' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L3 12l5.714-2.143L11 3z"/></svg>',
                ];
                @endphp
                @foreach($features as $i => $f)
                <div class="reveal group relative bg-gradient-to-br from-gray-900/80 to-gray-900/40 border border-white/10 rounded-2xl p-8 transition-all duration-500 hover:border-emerald-500/50 hover:shadow-xl hover:shadow-emerald-500/10 hover:-translate-y-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500/20 to-emerald-600/10 text-emerald-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            {!! $icons[$f['icon'] ?? 'default'] ?? $icons['default'] !!}
                        </div>
                        <h3 class="text-lg font-bold text-white mb-3">{{ $f['title'] }}</h3>
                        <p class="text-sm text-gray-400 leading-relaxed">{{ $f['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="reveal mt-16 text-center">
                <a href="{{ route('sanaa-cards.features') }}" class="inline-flex items-center gap-2 text-emerald-400 font-semibold hover:text-emerald-300 transition-colors">
                    Explore All Platform Features
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- INDUSTRIES --}}
    <section class="py-24 bg-[#050505] border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="reveal text-center mb-16 max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-black text-white mb-4">Industries We Serve</h2>
                <p class="text-gray-400">From SACCOs to salons, restaurants to retail — Sanaa Cards works for any business that values repeat customers.</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($settings['industries'] ?? [] as $ind)
                <div class="reveal industry-card p-6 rounded-2xl">
                    <h3 class="text-lg font-bold text-white mb-3">{{ $ind['category'] }}</h3>
                    <ul class="text-sm text-gray-400 space-y-1 mb-4">
                        @foreach(array_slice($ind['businesses'], 0, 4) as $b)
                        <li class="flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-emerald-500"></span>{{ $b }}</li>
                        @endforeach
                    </ul>
                    <p class="text-xs text-gray-500 italic">{{ $ind['use_case'] }}</p>
                    <div class="mt-4 pt-4 border-t border-white/5">
                        <p class="text-xs text-emerald-400">{{ $ind['example_reward'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- TESTIMONIALS --}}
    <section class="py-24 bg-black border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="reveal text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-black text-white mb-4">Customer Success Stories</h2>
                <p class="text-gray-400">Real results from real Ugandan businesses</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($settings['testimonials'] ?? [] as $t)
                <div class="reveal glass p-6 rounded-2xl">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-500 to-blue-500 flex items-center justify-center text-sm font-bold text-white">{{ $t['avatar'] }}</div>
                        <div>
                            <div class="font-bold text-white">{{ $t['name'] }}</div>
                            <div class="text-xs text-gray-500">{{ $t['role'] }}, {{ $t['company'] }}</div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 italic mb-4">"{{ $t['quote'] }}"</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($t['stats'] ?? [] as $s)
                        <span class="px-2 py-1 text-xs bg-emerald-500/10 text-emerald-400 rounded-full">{{ $s }}</span>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 bg-[#050505] border-t border-white/5 relative overflow-hidden">
        <div class="orb orb-1" style="top:50%;left:50%;transform:translate(-50%,-50%)"></div>
        <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
            <h2 class="reveal text-3xl md:text-5xl font-black text-white mb-6">{{ $settings['cta_title'] ?? 'Start Building Customer Loyalty Today' }}</h2>
            <p class="reveal text-lg text-gray-400 mb-10">{{ $settings['cta_subtitle'] ?? 'Launch a branded loyalty and membership program with Sanaa Cards.' }}</p>
            <div class="reveal flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-10 py-5 bg-emerald-500 text-white rounded-full font-bold text-lg hover:bg-emerald-400 transition-all pulse-glow">Start Free Trial</a>
                <a href="{{ route('sanaa-cards.pricing') }}" class="px-8 py-4 border border-white/20 text-white rounded-full font-semibold hover:bg-white/5 transition-all">View Pricing</a>
            </div>
            <p class="reveal mt-6 text-sm text-gray-600">{{ $settings['cta_guarantee'] ?? 'No credit card required • 14-day free trial' }}</p>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="py-12 bg-black border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <img src="{{ asset('storage/images/sanaa-logo-b.svg') }}" alt="Sanaa" class="h-7 mx-auto opacity-50 invert mb-6">
            <div class="flex flex-wrap justify-center gap-6 mb-6 text-sm text-gray-500">
                <a href="{{ route('sanaa-cards.features') }}" class="hover:text-emerald-400">Features</a>
                <a href="{{ route('sanaa-cards.pricing') }}" class="hover:text-emerald-400">Pricing</a>
                <a href="{{ route('contact') }}" class="hover:text-emerald-400">Contact</a>
            </div>
            <p class="text-xs text-gray-600">&copy; {{ date('Y') }} Sanaa. All rights reserved.</p>
        </div>
    </footer>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
            }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
            document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
        });
    </script>
    @endpush
</x-pages-layout>
