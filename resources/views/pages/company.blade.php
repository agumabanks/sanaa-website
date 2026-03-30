@extends('layouts.landing')

@section('title', 'About Sanaa | ' . config('app.name'))
@section('meta_description', 'Sanaa is building the digital backbone for Africa\'s next economy - modern tools for education, business, and finance for millions of Africans.')

@section('content')
{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-emerald-900 text-white overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%239C92AC\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
        <div class="max-w-4xl">
            <span class="inline-flex items-center rounded-full bg-emerald-500/20 px-4 py-1.5 text-sm font-medium text-emerald-300 mb-6">
                About Sanaa
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight mb-6 text-white">
                Building the Digital Backbone for Africa's Next Economy
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 max-w-3xl leading-relaxed">
                Where a student in a village, a market trader in Kampala, a SACCO in a small town, and an exporter in Kolwezi all have access to modern tools for education, business, and finance.
            </p>
        </div>
    </div>
</section>

{{-- Mission Statement --}}
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-2xl md:text-3xl font-medium text-gray-900 leading-relaxed">
                We started with software. We quickly realised it would never be enough.
            </p>
            <p class="mt-6 text-xl text-gray-600 leading-relaxed">
                So we expanded our vision: from apps to devices, from single products to a full ecosystem, and from local experiments to continental ambitions.
            </p>
            <div class="mt-10 h-1 w-24 bg-emerald-500 mx-auto rounded-full"></div>
            <p class="mt-10 text-lg text-gray-700">
                Today, Sanaa is a growing group of products, platforms and partnerships working together to unlock opportunity for millions of Africans.
            </p>
        </div>
    </div>
</section>

{{-- Our Story --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Our Story</h2>
                <p class="text-lg text-gray-700 mb-6">
                    Sanaa was founded by <strong>Aguma Banks Ibrahim</strong> with a simple conviction:
                </p>
                <blockquote class="border-l-4 border-emerald-500 pl-6 py-2 mb-8">
                    <p class="text-xl font-medium text-gray-900 italic">
                        "If Africans are given world-class tools built for our realities, they don't just catch up — they lead."
                    </p>
                </blockquote>
                <p class="text-gray-700 mb-4">We saw the gaps every day:</p>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Students sharing one computer between many</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>SACCOs, MFIs and money lenders using paper and WhatsApp to manage millions of shillings</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>SMEs running their shops without proper POS, inventory or digital channels</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Youth online all day with smartphones, but few pathways to real skills or income</span>
                    </li>
                </ul>
            </div>
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">Our Evolution</h3>
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center">
                            <span class="text-emerald-600 font-bold">1</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Started with Software</p>
                            <p class="text-sm text-gray-600">Building tools that could stand next to global products, but understand African realities</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center">
                            <span class="text-emerald-600 font-bold">2</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Built Partnerships</p>
                            <p class="text-sm text-gray-600">Partnered with universities, manufacturers, logistics partners and financial institutions across Europe, Canada, America, China and Africa</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center">
                            <span class="text-emerald-600 font-bold">3</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Expanded Our Mission</p>
                            <p class="text-sm text-gray-600">To design, build and localise the tools that will power Africa's digital economy for the next 50 years</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- What We Build --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">What We Build</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">A comprehensive ecosystem of products, platforms and services designed for African realities</p>
        </div>

        {{-- Product 1: Commerce & SME Tools --}}
        <div class="mb-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center rounded-full bg-blue-100 px-4 py-1.5 text-sm font-medium text-blue-700 mb-4">
                        Commerce & SME Tools
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Soko24 & Soko24 Business</h3>
                    <p class="text-lg text-gray-600 mb-6">We help small businesses operate like modern enterprises.</p>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Soko24 Marketplace</p>
                                <p class="text-sm text-gray-600">A hyper-local marketplace where shops, boutiques, pharmacies, salons and small traders can sell online and reach more customers</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Soko24 Business / POS</p>
                                <p class="text-sm text-gray-600">A POS + CRM + inventory manager that connects the physical shop to the digital world</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-6 text-emerald-600 font-medium">Our goal: give SMEs the same digital tools a large chain would have, at prices they can afford.</p>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 flex items-center justify-center min-h-[300px]">
                    <div class="text-center">
                        <svg class="h-24 w-24 text-blue-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <p class="text-blue-700 font-semibold">Empowering African SMEs</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product 2: Inclusive Finance --}}
        <div class="mb-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl p-8 flex items-center justify-center min-h-[300px]">
                    <div class="text-center">
                        <svg class="h-24 w-24 text-emerald-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-emerald-700 font-semibold">Democratising Finance</p>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="inline-flex items-center rounded-full bg-emerald-100 px-4 py-1.5 text-sm font-medium text-emerald-700 mb-4">
                        Inclusive Finance
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Sanaa Finance</h3>
                    <p class="text-lg text-gray-600 mb-6">Africa runs on SACCOs, MFIs, village groups and community lenders. We build the systems that help them run safely and sustainably.</p>
                    <p class="text-gray-700 mb-4">A core banking and lending platform for:</p>
                    <ul class="space-y-2 text-gray-700 mb-6">
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            SACCOs & cooperatives
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            MFIs & money lenders
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Community savings groups
                        </li>
                    </ul>
                    <p class="text-emerald-600 font-medium">We believe affordable, transparent finance is the foundation of any strong digital economy.</p>
                </div>
            </div>
        </div>

        {{-- Product 3: Devices & Hardware --}}
        <div class="mb-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center rounded-full bg-purple-100 px-4 py-1.5 text-sm font-medium text-purple-700 mb-4">
                        Devices & Hardware
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">From Users to Makers</h3>
                    <p class="text-lg text-gray-600 mb-6">To build Africa's digital future properly, we cannot stop at software. We also need to participate in hardware design, assembly, and eventually manufacturing.</p>
                    <div class="space-y-3 text-gray-700 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-purple-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>Affordable computers and tablets designed for African schools and offices</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-purple-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            <span>Long-term plans for phone design and assembly plants in Uganda</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-purple-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <span>Hardware tailored for education, SACCOs, SMEs, logistics and agriculture</span>
                        </div>
                    </div>
                    <p class="text-purple-600 font-medium">Our vision: Africa should not only import devices — we should design and build them.</p>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-8 flex items-center justify-center min-h-[300px]">
                    <div class="text-center">
                        <svg class="h-24 w-24 text-purple-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <p class="text-purple-700 font-semibold">Made in Africa</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product 4: Logistics & Trade --}}
        <div class="mb-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1 bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-8 flex items-center justify-center min-h-[300px]">
                    <div class="text-center">
                        <svg class="h-24 w-24 text-orange-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        <p class="text-orange-700 font-semibold">Connecting Markets</p>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="inline-flex items-center rounded-full bg-orange-100 px-4 py-1.5 text-sm font-medium text-orange-700 mb-4">
                        Logistics & Trade
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Baraka & Regional Corridors</h3>
                    <p class="text-lg text-gray-600 mb-6">Trade is the bloodstream of any economy. We are building tools that make it flow more efficiently.</p>
                    <div class="space-y-3 text-gray-700 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Digitised courier and shipment management for SMEs and traders</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Better visibility from Asia to Africa and across key corridors into the DRC</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-orange-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Tools that enable African businesses to participate confidently in cross-border trade</span>
                        </div>
                    </div>
                    <p class="text-orange-600 font-medium">We want the same tools that global logistics giants use — but optimised for our geography, our roads, our borders, our realities.</p>
                </div>
            </div>
        </div>

        {{-- Product 5: Education --}}
        <div class="mb-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center rounded-full bg-indigo-100 px-4 py-1.5 text-sm font-medium text-indigo-700 mb-4">
                        Education
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">EduOS</h3>
                    <p class="text-lg text-gray-600 mb-6">A comprehensive school management system designed for African educational institutions from kindergarten to university.</p>
                    <div class="space-y-3 text-gray-700 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-indigo-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Student information management and enrollment</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-indigo-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Fee collection integrated with Mobile Money</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-indigo-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Academic performance tracking and reporting</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-indigo-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Parent communication and engagement tools</span>
                        </div>
                    </div>
                    <p class="text-indigo-600 font-medium">Empowering schools to focus on education, not administration.</p>
                </div>
                <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl p-8 flex items-center justify-center min-h-[300px]">
                    <div class="text-center">
                        <svg class="h-24 w-24 text-indigo-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        <p class="text-indigo-700 font-semibold">Transforming Education</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product 6: Agriculture --}}
        <div>
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1 bg-gradient-to-br from-teal-50 to-teal-100 rounded-2xl p-8 flex items-center justify-center min-h-[300px]">
                    <div class="text-center">
                        <svg class="h-24 w-24 text-teal-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-teal-700 font-semibold">Empowering Farmers</p>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="inline-flex items-center rounded-full bg-teal-100 px-4 py-1.5 text-sm font-medium text-teal-700 mb-4">
                        Agriculture & Rural Modernisation
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Agriculture Solutions</h3>
                    <p class="text-lg text-gray-600 mb-6">Agriculture remains the backbone of our economies. We are gradually extending our technology into rural modernisation.</p>
                    <div class="space-y-3 text-gray-700 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-teal-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Farm & cooperative management systems</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-teal-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Market linkage tools that connect farmers to buyers</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-teal-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Data-driven decision support for yields, pricing and logistics</span>
                        </div>
                    </div>
                    <p class="text-teal-600 font-medium">Modernising agriculture without erasing its communities — using tech to increase income and resilience, not to replace people.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- How We Work --}}
<section class="py-20 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-white">How We Work</h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">Across everything we build, a few principles never change</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white/5 backdrop-blur rounded-xl p-8 border border-white/10">
                <div class="h-12 w-12 rounded-lg bg-emerald-500/20 flex items-center justify-center mb-6">
                    <svg class="h-6 w-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Built for Africa, at Global Standard</h3>
                <p class="text-gray-400">We refuse the idea that "African quality" should be lower. Our design, engineering and operations standards are set against global leaders.</p>
            </div>

            <div class="bg-white/5 backdrop-blur rounded-xl p-8 border border-white/10">
                <div class="h-12 w-12 rounded-lg bg-blue-500/20 flex items-center justify-center mb-6">
                    <svg class="h-6 w-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/></svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Ecosystem First</h3>
                <p class="text-gray-400">Our tools reinforce each other: hardware that runs our software, finance that powers SMEs using our POS, logistics that moves goods sold on our marketplaces.</p>
            </div>

            <div class="bg-white/5 backdrop-blur rounded-xl p-8 border border-white/10">
                <div class="h-12 w-12 rounded-lg bg-purple-500/20 flex items-center justify-center mb-6">
                    <svg class="h-6 w-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Partnerships Over Isolation</h3>
                <p class="text-gray-400">We actively work with governments, universities, banks, manufacturers and technology partners across Africa, Europe, North America and Asia.</p>
            </div>

            <div class="bg-white/5 backdrop-blur rounded-xl p-8 border border-white/10">
                <div class="h-12 w-12 rounded-lg bg-orange-500/20 flex items-center justify-center mb-6">
                    <svg class="h-6 w-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Affordability with Sustainability</h3>
                <p class="text-gray-400">We design pricing and financing models that make sense on the ground, while keeping the company strong enough to support customers for the long term.</p>
            </div>

            <div class="bg-white/5 backdrop-blur rounded-xl p-8 border border-white/10">
                <div class="h-12 w-12 rounded-lg bg-teal-500/20 flex items-center justify-center mb-6">
                    <svg class="h-6 w-6 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Skills & Capacity Building</h3>
                <p class="text-gray-400">Every deployment is an opportunity to train: staff, students, loan officers, traders, and youth — so that value stays in the community.</p>
            </div>

            <div class="bg-white/5 backdrop-blur rounded-xl p-8 border border-white/10">
                <div class="h-12 w-12 rounded-lg bg-pink-500/20 flex items-center justify-center mb-6">
                    <svg class="h-6 w-6 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Community & Youth Focus</h3>
                <p class="text-gray-400">Through initiatives like Sanaa Teenage Talk, we support the hearts and minds of the next generation — because a digital economy needs healthy, confident people.</p>
            </div>
        </div>
    </div>
</section>

{{-- Community Initiative --}}
<section class="py-20 bg-gradient-to-br from-pink-50 to-purple-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-flex items-center rounded-full bg-pink-100 px-4 py-1.5 text-sm font-medium text-pink-700 mb-4">
                    Community Initiative
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Sanaa Teenage Talk</h2>
                <p class="text-lg text-gray-700 mb-6">
                    As we grew, we realised something important: A powerful digital economy needs not just tools, but healthy, confident people — especially among the youth.
                </p>
                <p class="text-gray-700 mb-6">A safe, moderated space where teenagers can talk openly about:</p>
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-gray-700">School & friendships</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-gray-700">Love & identity</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-gray-700">Mental health</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-gray-700">Dreams & careers</span>
                    </div>
                </div>
                <p class="text-pink-600 font-medium italic">
                    "We want teens — regardless of background, finances, or ethnicity — to feel seen and to believe they have a place in building the Africa we all long for."
                </p>
            </div>
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="text-center">
                    <div class="h-20 w-20 rounded-full bg-pink-100 flex items-center justify-center mx-auto mb-6">
                        <svg class="h-10 w-10 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No judgment. No bullying.</h3>
                    <p class="text-gray-600 mb-6">Just respect, listening and guidance.</p>
                    <div class="space-y-3 text-left">
                        <div class="flex items-center gap-3 p-3 bg-pink-50 rounded-lg">
                            <span class="text-2xl">💬</span>
                            <span class="text-gray-700">Open conversations</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-pink-50 rounded-lg">
                            <span class="text-2xl">✨</span>
                            <span class="text-gray-700">Safe & moderated</span>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-pink-50 rounded-lg">
                            <span class="text-2xl">🌍</span>
                            <span class="text-gray-700">Building future leaders</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Vision for the Future --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Vision for the Future</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Looking ahead, Sanaa is focused on expanding impact across Africa</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
            <div class="bg-gray-50 rounded-xl p-6">
                <div class="h-10 w-10 rounded-lg bg-emerald-100 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-gray-700">Expanding our software suite for SMEs, SACCOs, schools, health and agriculture</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6">
                <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-gray-700">Deepening our device roadmap, including local assembly and future manufacturing in Uganda</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6">
                <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-gray-700">Scaling financial access through Sanaa Finance and partnerships with banks</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6">
                <div class="h-10 w-10 rounded-lg bg-orange-100 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-gray-700">Strengthening trade and logistics links across regional and global markets</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6">
                <div class="h-10 w-10 rounded-lg bg-pink-100 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-gray-700">Growing community initiatives to support mental health and youth leadership</p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6">
                <div class="h-10 w-10 rounded-lg bg-teal-100 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-gray-700">Modernising agriculture with data-driven tools for African farmers</p>
            </div>
        </div>

        <div class="bg-emerald-50 rounded-2xl p-8 md:p-12 text-center">
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Our North Star</h3>
            <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                Affordable finance, great tech skills for all, modern tools for agriculture, and world-class software and devices — <strong>designed in Africa, for Africa.</strong>
            </p>
        </div>
    </div>
</section>

{{-- Walk With Us CTA --}}
<section class="py-20 bg-gradient-to-br from-emerald-600 to-emerald-700 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-white">Walk With Us</h2>
        <p class="text-xl text-emerald-100 mb-10">
            Whether you are a student, a SACCO, a small business, a farmer, a partner from Africa or abroad, or a young person looking for a place to belong — Sanaa is being built for you, and with you.
        </p>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 mb-12 text-left">
            <div class="bg-white/10 backdrop-blur rounded-lg p-4 flex items-center gap-3">
                <svg class="h-6 w-6 text-emerald-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <span>Students & Teachers</span>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-lg p-4 flex items-center gap-3">
                <svg class="h-6 w-6 text-emerald-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>SACCOs & MFIs</span>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-lg p-4 flex items-center gap-3">
                <svg class="h-6 w-6 text-emerald-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <span>Small Businesses</span>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-lg p-4 flex items-center gap-3">
                <svg class="h-6 w-6 text-emerald-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Farmers & Cooperatives</span>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-lg p-4 flex items-center gap-3">
                <svg class="h-6 w-6 text-emerald-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                <span>Global Partners</span>
            </div>
            <div class="bg-white/10 backdrop-blur rounded-lg p-4 flex items-center gap-3">
                <svg class="h-6 w-6 text-emerald-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                <span>Young People</span>
            </div>
        </div>

        <blockquote class="text-xl md:text-2xl font-medium mb-10 italic">
            "We believe the next chapter of Africa's story will be written by those who dare to build. Our role is to provide the tools, platforms and spaces that make that possible."
        </blockquote>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="/contact" class="inline-flex items-center justify-center rounded-lg bg-white text-emerald-700 px-8 py-4 text-lg font-semibold hover:bg-gray-100 transition-colors">
                Get in Touch
                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="/investor-relations" class="inline-flex items-center justify-center rounded-lg border-2 border-white text-white px-8 py-4 text-lg font-semibold hover:bg-white/10 transition-colors">
                Investor Relations
            </a>
        </div>
    </div>
</section>

{{-- Stats --}}
<section class="py-16 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <p class="text-4xl md:text-5xl font-bold text-emerald-600">50K+</p>
                <p class="mt-2 text-gray-600">Devices Shipped</p>
            </div>
            <div class="text-center">
                <p class="text-4xl md:text-5xl font-bold text-emerald-600">37+</p>
                <p class="mt-2 text-gray-600">Financial Institutions</p>
            </div>
            <div class="text-center">
                <p class="text-4xl md:text-5xl font-bold text-emerald-600">134</p>
                <p class="mt-2 text-gray-600">Districts Covered</p>
            </div>
            <div class="text-center">
                <p class="text-4xl md:text-5xl font-bold text-emerald-600">5</p>
                <p class="mt-2 text-gray-600">Countries</p>
            </div>
        </div>
    </div>
</section>
@endsection
