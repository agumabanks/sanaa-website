@extends('layouts.landing')

@section('title', 'Investor Relations — Sanaa Co.')
@section('seo_title', 'Investor Relations — Sanaa Co.')
@section('seo_description', 'Sanaa has been building since 2021. We are not actively fundraising. If you are evaluating African digital infrastructure, we are open to a conversation.')
@section('seo_image', asset('storage/images/sanaa-logo-b.svg'))

@section('content')
<section class="bg-black text-white">
    <div class="relative overflow-hidden border-b border-white/10">
        <div class="absolute inset-0 opacity-5">
            <img src="{{ asset('storage/images/sanaa-logo-b.svg') }}" alt="" class="absolute right-0 top-8 h-48 md:h-72 w-auto">
        </div>

        <div class="relative max-w-5xl mx-auto px-6 py-28 md:py-32">
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Investor Relations</p>
            <h1 class="mt-6 text-4xl md:text-6xl font-light tracking-tight">We Are Not Fundraising. We Are Building.</h1>
            <p class="mt-8 max-w-4xl text-lg md:text-xl text-gray-300 leading-8">Sanaa has been building since 2021 without external funding. Every product you see is real, tested, and in active use. The Sanaa Finance Cooperative has been operational since 2022 with real members, real credit, and real assets financed. Baraka 24 is live in DRC. Soko 24 is running. Sanaa Finance SaaS has paying clients.</p>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-6 py-20 space-y-16">
        <section class="space-y-6">
            <h2 class="text-3xl md:text-4xl font-light">What Sanaa Is</h2>
            <p class="text-gray-300 text-lg leading-8">Sanaa Co. is an African economic ecosystem built on a cooperative financial model. We finance businesses, connect them to commerce, move their goods, and run their software. Every layer feeds the next. The cooperative creates the lock-in that no competitor can replicate, because our members are owners, not just customers.</p>

            <div class="grid md:grid-cols-3 gap-6 pt-4">
                <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                    <h3 class="text-sm uppercase tracking-[0.2em] text-gray-500">Legal structure</h3>
                    <ul class="mt-4 space-y-3 text-gray-300 leading-7">
                        <li>Sanaa Brands Ltd — registered Uganda 2020, URSB active. Primary operating entity.</li>
                        <li>Sanaa Finance Ltd — registered Uganda 2021. SaaS product entity.</li>
                        <li>Sanaa Finance Cooperative — registered Uganda 2022. Member-owned financial institution. Fully operational.</li>
                    </ul>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                    <h3 class="text-sm uppercase tracking-[0.2em] text-gray-500">Products live</h3>
                    <ul class="mt-4 space-y-3 text-gray-300 leading-7">
                        <li>Soko 24 — East African marketplace</li>
                        <li>Sanaa Finance SaaS — financial management for SACCOs and MFIs</li>
                        <li>Sanaa Finance Cooperative — member loans and asset financing operational</li>
                        <li>Sanaa Media — print and branding, Nasser Road Kampala</li>
                        <li>Baraka 24 — logistics platform, live in Uganda, DRC, and South Africa. Expanding to Ethiopia.</li>
                        <li>Sanaa POS — point-of-sale system</li>
                        <li>Sanaa Cards — corporate payment cards</li>
                        <li>Sanaa Cloud — managed hosting for SaaS clients</li>
                    </ul>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                    <h3 class="text-sm uppercase tracking-[0.2em] text-gray-500">Ownership</h3>
                    <ul class="mt-4 space-y-3 text-gray-300 leading-7">
                        <li>100% founder-owned.</li>
                        <li>Zero external investors to date.</li>
                        <li>Three registered legal entities.</li>
                        <li>Team of six.</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="space-y-6">
            <h2 class="text-3xl md:text-4xl font-light">What We Are Building Toward</h2>
            <p class="text-gray-300 text-lg leading-8">The vision has five layers. Finance is the foundation. Commerce builds demand on top of it. Logistics moves the goods. Infrastructure keeps the rails stable. A fifth layer is in progress. We will talk about it when it is ready.</p>
            <div class="grid md:grid-cols-5 gap-4">
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-500">1. Finance</p>
                    <p class="mt-3 text-gray-300 leading-7">The cooperative is the foundation. Member-owned, not investor-extracted.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-500">2. Commerce</p>
                    <p class="mt-3 text-gray-300 leading-7">Soko 24 connects sellers to buyers across East and Central Africa.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-500">3. Logistics</p>
                    <p class="mt-3 text-gray-300 leading-7">Baraka 24 moves the goods.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-500">4. Infrastructure</p>
                    <p class="mt-3 text-gray-300 leading-7">Sanaa Cloud, POS, and Cards run the rails.</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-500">5. In Progress</p>
                    <p class="mt-3 text-gray-300 leading-7">A fifth layer. We will talk about it when it is ready.</p>
                </div>
            </div>
        </section>

        <section class="space-y-6 border-t border-white/10 pt-16">
            <h2 class="text-3xl md:text-4xl font-light">If You Want to Know More</h2>
            <p class="text-gray-300 text-lg leading-8">Sanaa is not actively fundraising. We are building toward a point where the business speaks for itself before we open any conversation about capital.</p>
            <p class="text-gray-300 text-lg leading-8">If you are an investor with a long view on African digital infrastructure and you want to follow this build, you can reach us here. We will respond when the time is right.</p>
            <div class="grid md:grid-cols-3 gap-6">
                <a href="mailto:info@sanaa.co" class="rounded-2xl border border-white/10 bg-white/5 p-6 hover:border-emerald-400/40 transition-colors">
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-500">Email</p>
                    <p class="mt-3 text-xl text-white">info@sanaa.co</p>
                </a>
                <a href="{{ route('contact') }}" class="rounded-2xl border border-white/10 bg-white/5 p-6 hover:border-emerald-400/40 transition-colors">
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-500">Contact form</p>
                    <p class="mt-3 text-xl text-white">Open /contact</p>
                </a>
            </div>
        </section>
    </div>
</section>
@endsection
