@extends('layouts.landing')

@section('title', 'About Sanaa — ' . config('app.name'))
@section('seo_title', 'About Sanaa — Founded by Aguma Banks Ibrahim')
@section('seo_description', 'Sanaa was founded on Nasser Road, Kampala, in 2021. We build finance, commerce, logistics, and infrastructure for African business.')
@section('seo_keywords', 'Aguma Banks Ibrahim, Sanaa founder, Sanaa Co, Sanaa Uganda, Sanaa Finance, Soko 24, African fintech, Uganda technology, SACCO software')

@section('content')
{{-- Structured Data for SEO --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Sanaa Co.",
    "alternateName": "Sanaa",
    "url": "https://sanaa.ug",
    "logo": "https://sanaa.ug/storage/images/sanaa.png",
    "foundingDate": "2021",
    "founder": {
        "@type": "Person",
        "name": "Aguma Banks Ibrahim",
        "alternateName": "Aguma Banks",
        "jobTitle": "Founder & CEO",
        "worksFor": {
            "@type": "Organization",
            "name": "Sanaa Co."
        }
    },
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "Nasser Road",
        "addressLocality": "Kampala",
        "addressCountry": "UG"
    },
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+256200903222",
        "contactType": "customer support",
        "areaServed": ["UG", "CD"]
    },
    "sameAs": [
        "https://media.sanaa.co",
        "https://soko24.sanaa.co"
    ],
    "description": "Sanaa builds finance, commerce, logistics, and infrastructure for African business. Founded on Nasser Road, Kampala, in 2021.",
    "numberOfEmployees": {
        "@type": "QuantitativeValue",
        "value": 6
    },
    "areaServed": {
        "@type": "GeoCircle",
        "geoMidpoint": {
            "@type": "GeoCoordinates",
            "latitude": 0.3476,
            "longitude": 32.5825
        },
        "geoRadius": "2000 km"
    }
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Person",
    "name": "Aguma Banks Ibrahim",
    "alternateName": "Aguma Banks",
    "jobTitle": "Founder & CEO",
    "worksFor": {
        "@type": "Organization",
        "name": "Sanaa Co.",
        "url": "https://sanaa.ug"
    },
    "knowsAbout": ["Fintech", "African Technology", "SACCO Software", "E-commerce", "Digital Infrastructure"],
    "nationality": {
        "@type": "Country",
        "name": "Uganda"
    }
}
</script>

{{-- Hero Section --}}
<section class="relative min-h-[70vh] flex items-center bg-black text-white">
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/30 to-transparent"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <p class="text-emerald-400 font-medium tracking-wide uppercase text-sm mb-4">About</p>
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight max-w-4xl leading-[1.1] text-white">
            Founded on Nasser Road.
        </h1>
        <p class="mt-8 text-xl md:text-2xl text-gray-300 max-w-2xl leading-relaxed">
            That street taught the founder things no outside investor or competitor knows.
        </p>
    </div>
</section>

{{-- Origin Story --}}
<section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-emerald-600 font-medium tracking-wide uppercase text-sm mb-4">Our Story</p>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-8">
            Nasser Road is where Sanaa started.
        </h2>
        <div class="prose prose-lg text-gray-600 max-w-none">
            <p>
                Nasser Road in Kampala is not a venture capital address. It is a street of print shops, repair stalls, and small traders who have been running businesses for decades without software, without credit, and without anyone from the outside paying attention. Aguma Banks Ibrahim founded Sanaa there in 2021 because that is where the real information was. He watched how shop owners managed stock on paper, how SACCOs tracked loans in WhatsApp groups, how delivery riders paid for fuel out of pocket and waited weeks for reimbursement. He saw that the tools built in San Francisco or Nairobi did not fit these businesses. They were too expensive, too complex, or simply invisible to the people who needed them.
            </p>
            <p>
                That proximity gave him something no competitor has: five years of direct observation across every layer of African business operations. He knows what a loan officer in Kisoro actually needs at 6 AM. He knows why a courier company in Kinshasa will adopt one platform and ignore another. He knows the exact moment in a sales cycle when a SACCO manager decides whether to trust software with her members' money. This is not market research. It is lived experience. And it is the reason Sanaa builds differently from every other company in this space.
            </p>
            <p>
                Sanaa was founded with a simple conviction: if Africans are given tools built for our realities, they do not catch up. They lead.
            </p>
        </div>
        <div class="mt-12 pt-12 border-t border-gray-200">
            <blockquote class="text-2xl md:text-3xl font-medium text-gray-900 leading-snug">
                "Nasser Road taught me that the people who know the most about African business are the ones no one interviews."
            </blockquote>
            <p class="mt-4 text-gray-500">— Aguma Banks Ibrahim, Founder</p>
        </div>
    </div>
</section>

{{-- Leadership & Partners Section --}}
<section class="py-20 bg-emerald-600">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-emerald-200 font-medium tracking-wide uppercase text-sm mb-4">Leadership</p>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Who Builds This</h2>
                <p class="text-lg text-emerald-100 leading-relaxed">
                    Founded by <strong class="text-white">Aguma Banks Ibrahim</strong>, Sanaa operates with a team of six across Uganda, the DRC, and South Africa. We work with financial institutions, logistics operators, and manufacturers who understand that infrastructure is built over years, not funding rounds.
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/10 backdrop-blur rounded-xl p-6 text-center">
                    <p class="text-3xl font-bold text-white mb-1">3</p>
                    <p class="text-emerald-200 text-sm">Countries Active</p>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-6 text-center">
                    <p class="text-3xl font-bold text-white mb-1">37+</p>
                    <p class="text-emerald-200 text-sm">Financial Partners</p>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-6 text-center">
                    <p class="text-3xl font-bold text-white mb-1">3</p>
                    <p class="text-emerald-200 text-sm">Legal Entities</p>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-6 text-center">
                    <p class="text-3xl font-bold text-white mb-1">6</p>
                    <p class="text-emerald-200 text-sm">People</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- What We Build - Clean Grid --}}
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-emerald-600 font-medium tracking-wide uppercase text-sm mb-4">Our Ecosystem</p>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">What We Build</h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Soko24 --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Soko 24</h3>
                <p class="text-gray-600 mb-4">Online marketplace for Ugandan sellers to reach buyers across East Africa.</p>
                <p class="text-sm text-blue-600 font-medium">Commerce</p>
            </div>

            {{-- Sanaa Finance --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Sanaa Finance</h3>
                <p class="text-gray-600 mb-4">Core banking platform for SACCOs, MFIs, and community savings groups.</p>
                <p class="text-sm text-emerald-600 font-medium">Inclusive Finance</p>
            </div>

            {{-- Baraka Logistics --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="w-14 h-14 rounded-xl bg-orange-100 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Baraka 24</h3>
                <p class="text-gray-600 mb-4">Logistics management for courier and delivery companies in Uganda, DRC, and South Africa. Expanding to Ethiopia.</p>
                <p class="text-sm text-orange-600 font-medium">Logistics</p>
            </div>

            {{-- Sanaa Media --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="w-14 h-14 rounded-xl bg-pink-100 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Sanaa Media</h3>
                <p class="text-gray-600 mb-4">Print and branding services from Nasser Road, Kampala. Produced and delivered.</p>
                <p class="text-sm text-pink-600 font-medium">Print & Branding</p>
            </div>

            {{-- Sanaa POS --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Sanaa POS</h3>
                <p class="text-gray-600 mb-4">Point-of-sale hardware and software for checkout, stock, and sales visibility.</p>
                <p class="text-sm text-purple-600 font-medium">Infrastructure</p>
            </div>

            {{-- Sanaa Cloud --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="w-14 h-14 rounded-xl bg-gray-100 flex items-center justify-center mb-6">
                    <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Sanaa Cloud</h3>
                <p class="text-gray-600 mb-4">Managed cloud hosting and storage for businesses on Sanaa platforms.</p>
                <p class="text-sm text-gray-600 font-medium">Infrastructure</p>
            </div>
        </div>
    </div>
</section>

{{-- Timeline Section --}}
<section class="py-32 bg-[#fafafa]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-semibold text-gray-900 tracking-tight">Our Journey</h2>
            <p class="mt-4 text-xl text-gray-500">What has happened so far</p>
        </div>

        <div class="relative">
            <div class="absolute top-8 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-0">
                {{-- 2018 --}}
                <div class="relative text-center px-4 group">
                    <div class="relative z-10 w-16 h-16 mx-auto mb-8 rounded-full bg-white border-2 border-gray-200 flex items-center justify-center group-hover:border-emerald-500 group-hover:shadow-lg transition-all duration-300">
                        <span class="text-lg font-bold text-gray-900">2018</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">The Beginning</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Sanaa Media founded on Nasser Road, Kampala. Direct observation of how African businesses actually operate.</p>
                </div>

                {{-- 2021 --}}
                <div class="relative text-center px-4 group">
                    <div class="relative z-10 w-16 h-16 mx-auto mb-8 rounded-full bg-white border-2 border-gray-200 flex items-center justify-center group-hover:border-emerald-500 group-hover:shadow-lg transition-all duration-300">
                        <span class="text-lg font-bold text-gray-900">2021</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Sanaa Co.</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Sanaa Co. registered. Sanaa Finance SaaS launched for SACCOs, MFIs, and community lenders.</p>
                </div>

                {{-- 2022 --}}
                <div class="relative text-center px-4 group">
                    <div class="relative z-10 w-16 h-16 mx-auto mb-8 rounded-full bg-white border-2 border-gray-200 flex items-center justify-center group-hover:border-emerald-500 group-hover:shadow-lg transition-all duration-300">
                        <span class="text-lg font-bold text-gray-900">2022</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Cooperative</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Sanaa Finance Cooperative registered and operational. Member-owned financial institution with real loans and real assets.</p>
                </div>

                {{-- 2023 --}}
                <div class="relative text-center px-4 group">
                    <div class="relative z-10 w-16 h-16 mx-auto mb-8 rounded-full bg-emerald-600 border-2 border-emerald-600 flex items-center justify-center shadow-lg">
                        <span class="text-lg font-bold text-white">Now</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Cross-Border</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Baraka 24 live in Uganda, DRC, and South Africa. Soko 24 running. Financial software deployed with institutions. Team of six. Zero external investors. Expanding to Ethiopia.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- How We Work --}}
<section class="py-24 bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-emerald-400 font-medium tracking-wide uppercase text-sm mb-4">Our Principles</p>
            <h2 class="text-3xl md:text-4xl font-bold text-white">How We Work</h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-px bg-gray-800">
            <div class="bg-black p-10">
                <h3 class="text-xl font-bold mb-4 text-white">Built for Africa, at Global Standard</h3>
                <p class="text-gray-400">We refuse the idea that quality here should be lower. Our standards match global leaders.</p>
            </div>
            <div class="bg-black p-10">
                <h3 class="text-xl font-bold mb-4 text-white">Ecosystem First</h3>
                <p class="text-gray-400">Our tools reinforce each other. Finance powers commerce. Commerce creates demand for logistics. Logistics needs infrastructure.</p>
            </div>
            <div class="bg-black p-10">
                <h3 class="text-xl font-bold mb-4 text-white">Partnerships Over Isolation</h3>
                <p class="text-gray-400">We work with governments, universities, banks, and manufacturers across Africa, Europe, and Asia.</p>
            </div>
            <div class="bg-black p-10">
                <h3 class="text-xl font-bold mb-4 text-white">Affordability with Sustainability</h3>
                <p class="text-gray-400">Pricing that makes sense on the ground, while keeping the company strong for the long term.</p>
            </div>
            <div class="bg-black p-10">
                <h3 class="text-xl font-bold mb-4 text-white">Skills & Capacity Building</h3>
                <p class="text-gray-400">Every deployment trains staff, students, loan officers, and traders. Value stays in the community.</p>
            </div>
            <div class="bg-black p-10">
                <h3 class="text-xl font-bold mb-4 text-white">Community & Youth Focus</h3>
                <p class="text-gray-400">Initiatives like Sanaa Teenage Talk support the next generation.</p>
            </div>
        </div>
    </div>
</section>

{{-- Community Initiative - Sanaa Teenage Talk --}}
<section class="py-24 bg-gradient-to-br from-pink-50 to-purple-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-pink-600 font-medium tracking-wide uppercase text-sm mb-4">Beyond Business</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Sanaa Teenage Talk</h2>
                <p class="text-lg text-gray-600 mb-6">
                    A powerful digital economy needs not just tools, but healthy, confident people. Sanaa Teenage Talk is a safe, moderated space where teens can talk openly about life, dreams, and challenges.
                </p>
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-gray-700">School & friendships</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-gray-700">Mental health</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-gray-700">Dreams & careers</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-gray-700">Identity & belonging</span>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://chat.whatsapp.com/IABR17uswC2413VRrg89Vr" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center bg-gradient-to-r from-pink-500 to-purple-600 text-white px-6 py-3 rounded-full font-semibold hover:from-pink-600 hover:to-purple-700 transition-all shadow-lg shadow-pink-500/25">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Join the Community
                    </a>
                    <a href="/contact" class="inline-flex items-center justify-center bg-white text-pink-600 border-2 border-pink-200 px-6 py-3 rounded-full font-semibold hover:bg-pink-50 hover:border-pink-300 transition-all">
                        Partner with Us
                    </a>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-10 shadow-xl">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No judgment. No bullying.</h3>
                    <p class="text-gray-600">Just respect, listening, and guidance.</p>
                </div>
                <div class="border-t border-gray-100 pt-6">
                    <p class="text-pink-600 font-medium italic text-center mb-6">
                        "We want every teen to feel seen and believe they have a place in building Africa's future."
                    </p>
                    <div class="bg-pink-50 rounded-xl p-4">
                        <p class="text-sm text-gray-600 text-center mb-3"><strong class="text-gray-900">For Schools, Parents & NGOs:</strong></p>
                        <p class="text-sm text-gray-500 text-center">Partner with Sanaa Teenage Talk to bring mental health support and guidance to your community. We work with schools, churches, and youth organisations.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Vision --}}
<section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-emerald-600 font-medium tracking-wide uppercase text-sm mb-4">Our North Star</p>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-8">
            Affordable finance, strong skills, modern tools for agriculture, and software built in Africa, for Africa.
        </h2>
        <p class="text-xl text-gray-600">
            We are still building. Each SACCO digitised, each SME equipped, each student with a computer, each teen given a safe space to speak, is one more step toward the future we see.
        </p>
    </div>
</section>

{{-- Walk With Us - Premium CTA Section --}}
<section class="relative py-32 bg-black overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/20 via-transparent to-emerald-900/10"></div>
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">Walk With Us</h2>
            <p class="text-xl md:text-2xl text-gray-400 max-w-3xl mx-auto leading-relaxed">
                The next chapter of Africa's story will be written by those who dare to build. Our role is to provide the tools, platforms and spaces that make that possible.
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-16">
            <div class="group bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-6 text-center hover:bg-white/10 hover:border-emerald-500/50 transition-all duration-300">
                <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-emerald-500/20 flex items-center justify-center group-hover:bg-emerald-500/30 transition-colors">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <p class="text-white font-medium text-sm">Students & Teachers</p>
            </div>
            <div class="group bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-6 text-center hover:bg-white/10 hover:border-emerald-500/50 transition-all duration-300">
                <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-emerald-500/20 flex items-center justify-center group-hover:bg-emerald-500/30 transition-colors">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <p class="text-white font-medium text-sm">SACCOs & MFIs</p>
            </div>
            <div class="group bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-6 text-center hover:bg-white/10 hover:border-emerald-500/50 transition-all duration-300">
                <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-emerald-500/20 flex items-center justify-center group-hover:bg-emerald-500/30 transition-colors">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <p class="text-white font-medium text-sm">Small Businesses</p>
            </div>
            <div class="group bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-6 text-center hover:bg-white/10 hover:border-emerald-500/50 transition-all duration-300">
                <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-emerald-500/20 flex items-center justify-center group-hover:bg-emerald-500/30 transition-colors">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-white font-medium text-sm">Farmers</p>
            </div>
            <div class="group bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-6 text-center hover:bg-white/10 hover:border-emerald-500/50 transition-all duration-300">
                <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-emerald-500/20 flex items-center justify-center group-hover:bg-emerald-500/30 transition-colors">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                </div>
                <p class="text-white font-medium text-sm">Global Partners</p>
            </div>
            <div class="group bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-6 text-center hover:bg-white/10 hover:border-emerald-500/50 transition-all duration-300">
                <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-emerald-500/20 flex items-center justify-center group-hover:bg-emerald-500/30 transition-colors">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <p class="text-white font-medium text-sm">Young People</p>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="/contact" class="group inline-flex items-center justify-center bg-emerald-500 text-white px-10 py-5 rounded-full text-lg font-semibold hover:bg-emerald-400 transition-all duration-300 shadow-lg shadow-emerald-500/25 hover:shadow-emerald-500/40">
                Get in Touch
                <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="/investor-relations" class="inline-flex items-center justify-center bg-white/10 backdrop-blur border border-white/20 text-white px-10 py-5 rounded-full text-lg font-semibold hover:bg-white/20 transition-all duration-300">
                Investor Relations
            </a>
        </div>

        <div class="mt-20 pt-12 border-t border-white/10 text-center">
            <p class="text-gray-500 text-lg italic max-w-2xl mx-auto">
                "Sanaa is being built for you, and with you."
            </p>
            <p class="mt-4 text-emerald-400 font-medium">— Aguma Banks Ibrahim, Founder</p>
        </div>
    </div>
</section>
@endsection
