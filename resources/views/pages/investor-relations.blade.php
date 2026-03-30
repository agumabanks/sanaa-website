@extends('layouts.landing')

@section('title', 'Investor Relations — Sanaa Co.')
@section('seo_title', 'Investor Relations — Sanaa Co.')
@section('seo_description', 'Sanaa Co. has been building since 2021 without external funding. Learn about our cooperative model, live products, legal structure, and how to get in touch.')
@section('seo_image', asset('storage/images/sanaa-logo-b.svg'))

@section('content')
<section class="bg-black text-white">
    <div class="relative overflow-hidden border-b border-white/10">
        <div class="absolute inset-0 opacity-5">
            <img src="{{ asset('storage/images/sanaa-logo-b.svg') }}" alt="" class="absolute right-0 top-8 h-48 md:h-72 w-auto">
        </div>

        <div class="relative max-w-5xl mx-auto px-6 py-28 md:py-32">
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Investor Relations — Sanaa Co.</p>
            <h1 class="mt-6 text-4xl md:text-6xl font-light tracking-tight">We Are Not Looking for Investors. We Are Open to the Right Partners.</h1>
            <p class="mt-8 max-w-4xl text-lg md:text-xl text-gray-300 leading-8">Sanaa has been building since 2021 without external funding. That is not a gap in the story. It is the story. Every product you see is real, tested, and in active use. The Sanaa Finance Cooperative has been operational since 2022 with real members, real credit, and real assets financed. Baraka 24 is live in DRC. Soko 24 is running. Sanaa Finance SaaS has paying clients.</p>
            <p class="mt-6 max-w-4xl text-lg md:text-xl text-gray-300 leading-8">We are at approximately 70% of the full product vision. What we need now is not validation. We have that. What we need is capital to close the remaining 30% and reach the scale where the flywheel is self-sustaining.</p>
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
                        <li>Sanaa Finance Ltd — registered Uganda 2021. SaaS product entity, registered but not yet active as an operating company.</li>
                        <li>Sanaa Finance Cooperative — registered Uganda 2022. Member-owned financial institution. Fully operational.</li>
                    </ul>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                    <h3 class="text-sm uppercase tracking-[0.2em] text-gray-500">Products live</h3>
                    <ul class="mt-4 space-y-3 text-gray-300 leading-7">
                        <li>Soko 24 — East African marketplace and services platform</li>
                        <li>Sanaa Finance SaaS — financial management for SACCOs and MFIs</li>
                        <li>Sanaa Finance Cooperative — member loans and asset financing operational</li>
                        <li>Sanaa Media — print and branding, Nasser Road Kampala</li>
                        <li>Baraka 24 — logistics OS SaaS, live in Uganda and DRC</li>
                        <li>Sanaa POS — point-of-sale system</li>
                        <li>Sanaa Cards — corporate payment cards</li>
                        <li>Sanaa Cloud — managed hosting for SaaS clients</li>
                    </ul>
                </div>
                <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                    <h3 class="text-sm uppercase tracking-[0.2em] text-gray-500">In development</h3>
                    <ul class="mt-4 space-y-3 text-gray-300 leading-7">
                        <li>BNPL on Soko 24 for cooperative members</li>
                        <li>fx.sanaa.co — FX trading platform</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="space-y-6">
            <h2 class="text-3xl md:text-4xl font-light">What We Are Building Toward</h2>
            <p class="text-gray-300 text-lg leading-8">The vision has five layers. Finance is the foundation. Commerce builds demand on top of it. Logistics moves the goods. Infrastructure keeps the rails stable. OS and devices are the long horizon.</p>
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
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-500">5. OS and Devices</p>
                    <p class="mt-3 text-gray-300 leading-7">The long horizon. African businesses running on African-built technology.</p>
                </div>
            </div>
        </section>

        <section class="space-y-6 border-t border-white/10 pt-16">
            <h2 class="text-3xl md:text-4xl font-light">If You Want to Know More</h2>
            <p class="text-gray-300 text-lg leading-8">We do not publish a pitch deck on this page. We have conversations.</p>
            <p class="text-gray-300 text-lg leading-8">If you have read this far and you see what we are building, reach out directly.</p>
            <div class="grid md:grid-cols-3 gap-6">
                <a href="https://wa.me/256706272481" target="_blank" rel="noopener noreferrer" class="rounded-2xl border border-white/10 bg-white/5 p-6 hover:border-emerald-400/40 transition-colors">
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-500">WhatsApp</p>
                    <p class="mt-3 text-xl text-white">+256 706 272 481</p>
                </a>
                <a href="mailto:info@sanaa.co" class="rounded-2xl border border-white/10 bg-white/5 p-6 hover:border-emerald-400/40 transition-colors">
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-500">Email</p>
                    <p class="mt-3 text-xl text-white">info@sanaa.co</p>
                </a>
                <a href="{{ route('contact') }}" class="rounded-2xl border border-white/10 bg-white/5 p-6 hover:border-emerald-400/40 transition-colors">
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-500">Contact form</p>
                    <p class="mt-3 text-xl text-white">Open /contact</p>
                </a>
            </div>
            <p class="text-sm uppercase tracking-[0.2em] text-gray-500 pt-2">We respond to everyone who is serious. We do not respond to templated investor outreach.</p>
        </section>
    </div>
</section>
@endsection
