<x-pages-layout title="Services | {{ config('app.name') }}">
    <x-slot name="metaDescription">
        Implementation and deployment services for Sanaa Finance, Soko24 POS, EduOS, and Baraka logistics. From SACCO digitisation to SME commerce enablement across Uganda and East Africa.
    </x-slot>

    @push('styles')
    <style>
        .page-footer { margin-top: 0 !important; }
    </style>
    @endpush

    <!-- Hero Section -->
    <section class="relative min-h-[80vh] flex items-center bg-black text-white overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/20 via-transparent to-emerald-950/30"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-32">
            <div class="max-w-3xl">
                <p class="text-emerald-400 font-medium tracking-widest uppercase text-xs mb-6">
                    {{ $settings['hero_eyebrow'] ?? 'Implementation & Deployment' }}
                </p>
                
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight leading-[1.05] text-white mb-8">
                    {{ $settings['hero_title'] ?? 'Turning Products into Real Change' }}
                </h1>
                
                <p class="text-lg md:text-xl text-gray-400 leading-relaxed mb-12 max-w-xl">
                    {{ $settings['hero_subtitle'] ?? 'From SACCO digitisation to SME POS deployments, we provide hands-on services that bring our products to life on the ground in Uganda, DRC, and beyond.' }}
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-emerald-500 text-white px-8 py-4 rounded-full text-base font-semibold hover:bg-emerald-400 transition-all duration-300 shadow-lg shadow-emerald-500/20">
                        {{ $settings['hero_cta_primary_text'] ?? 'Book a Consultation' }}
                        <svg class="ml-3 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="#services" class="inline-flex items-center justify-center border border-white/20 text-white px-8 py-4 rounded-full text-base font-semibold hover:bg-white/5 hover:border-white/30 transition-all duration-300">
                        {{ $settings['hero_cta_secondary_text'] ?? 'View Services' }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200">
                <div class="py-12 px-6 text-center">
                    <p class="text-4xl font-bold text-gray-900">{{ $settings['stat_1_value'] ?? '2018' }}</p>
                    <p class="mt-2 text-gray-500 text-sm">{{ $settings['stat_1_label'] ?? 'Founded' }}</p>
                </div>
                <div class="py-12 px-6 text-center">
                    <p class="text-4xl font-bold text-gray-900">{{ $settings['stat_2_value'] ?? '134' }}</p>
                    <p class="mt-2 text-gray-500 text-sm">{{ $settings['stat_2_label'] ?? 'Districts Covered' }}</p>
                </div>
                <div class="py-12 px-6 text-center">
                    <p class="text-4xl font-bold text-gray-900">{{ $settings['stat_3_value'] ?? '37+' }}</p>
                    <p class="mt-2 text-gray-500 text-sm">{{ $settings['stat_3_label'] ?? 'Financial Institutions' }}</p>
                </div>
                <div class="py-12 px-6 text-center">
                    <p class="text-4xl font-bold text-gray-900">{{ $settings['stat_4_value'] ?? '5' }}</p>
                    <p class="mt-2 text-gray-500 text-sm">{{ $settings['stat_4_label'] ?? 'Countries' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section id="services" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <p class="text-emerald-600 font-medium tracking-wide uppercase text-sm mb-4">{{ $settings['services_eyebrow'] ?? 'What We Do' }}</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $settings['services_title'] ?? 'Implementation Services' }}</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    {{ $settings['services_subtitle'] ?? "We don't just sell software — we deploy, configure, train, and support your team until you're running confidently." }}
                </p>
            </div>

            @if($services->isEmpty())
                <div class="text-center py-16">
                    <div class="bg-white rounded-2xl shadow-lg p-12 max-w-lg mx-auto">
                        <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Contact Us for Services</h3>
                        <p class="text-gray-600 mb-6">Tell us about your SACCO, school, SME, or logistics operation, and we'll recommend the right mix of Sanaa products and services.</p>
                        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-emerald-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-emerald-700 transition-all">
                            Book a Consultation
                        </a>
                    </div>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $service)
                        <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-emerald-200 group">
                            <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center mb-6 group-hover:bg-emerald-600 transition-colors">
                                @if($service->icon)
                                    <i class="{{ $service->icon }} text-2xl text-emerald-600 group-hover:text-white transition-colors"></i>
                                @else
                                    <svg class="w-7 h-7 text-emerald-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $service->name }}</h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">{{ $service->description }}</p>
                            <div class="pt-6 border-t border-gray-100">
                                <a href="{{ route('contact') }}" class="inline-flex items-center text-emerald-600 font-semibold hover:text-emerald-700 transition-colors">
                                    Learn More
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Why Sanaa Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <p class="text-emerald-600 font-medium tracking-wide uppercase text-sm mb-4">{{ $settings['why_eyebrow'] ?? 'Why Sanaa' }}</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $settings['why_title'] ?? 'Built for African Realities' }}</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    {{ $settings['why_subtitle'] ?? 'We design around your power, network, and staff constraints — not against them.' }}
                </p>
            </div>

            @php
                $whyFeatures = $settings['why_features'] ?? [
                    ['title' => 'Built for Africa', 'description' => 'We design around your power, network, and staff constraints — not against them.', 'color' => 'emerald'],
                    ['title' => 'Local + Global Expertise', 'description' => 'Teams in Uganda & DRC, with partners in Europe, North America, China and across Africa.', 'color' => 'blue'],
                    ['title' => 'End-to-End Ecosystem', 'description' => 'Software, devices, finance and logistics that work together — not standalone tools.', 'color' => 'purple'],
                    ['title' => 'Training & Long-term Support', 'description' => "We don't just deploy and disappear; we train your people and stay available.", 'color' => 'orange'],
                ];
                $colorClasses = [
                    'emerald' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-600'],
                    'blue' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600'],
                    'purple' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-600'],
                    'orange' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-600'],
                ];
            @endphp

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($whyFeatures as $index => $feature)
                @php $color = $colorClasses[$feature['color'] ?? 'emerald']; @endphp
                <div class="text-center p-6">
                    <div class="w-16 h-16 {{ $color['bg'] }} rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 {{ $color['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($index == 0)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            @elseif($index == 1)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            @elseif($index == 2)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            @endif
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600">{{ $feature['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Who We Serve -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <p class="text-emerald-600 font-medium tracking-wide uppercase text-sm mb-4">{{ $settings['sectors_eyebrow'] ?? 'Who We Serve' }}</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $settings['sectors_title'] ?? 'Trusted Across Sectors' }}</h2>
            </div>

            @php
                $sectors = $settings['sectors'] ?? [
                    ['name' => 'SACCOs & MFIs', 'color' => 'emerald'],
                    ['name' => 'SMEs & Retailers', 'color' => 'blue'],
                    ['name' => 'Schools', 'color' => 'purple'],
                    ['name' => 'Logistics', 'color' => 'orange'],
                    ['name' => 'Agriculture', 'color' => 'teal'],
                    ['name' => 'NGOs', 'color' => 'pink'],
                ];
                $sectorColors = [
                    'emerald' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-600'],
                    'blue' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600'],
                    'purple' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-600'],
                    'orange' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-600'],
                    'teal' => ['bg' => 'bg-teal-100', 'text' => 'text-teal-600'],
                    'pink' => ['bg' => 'bg-pink-100', 'text' => 'text-pink-600'],
                ];
                $sectorIcons = [
                    'SACCOs & MFIs' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                    'SMEs & Retailers' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                    'Schools' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z',
                    'Logistics' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4',
                    'Agriculture' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    'NGOs' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9',
                ];
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($sectors as $sector)
                @php $color = $sectorColors[$sector['color'] ?? 'emerald']; @endphp
                <div class="bg-white rounded-xl p-6 text-center shadow-sm hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 {{ $color['bg'] }} rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 {{ $color['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sectorIcons[$sector['name']] ?? $sectorIcons['NGOs'] }}"/>
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-900 text-sm">{{ $sector['name'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-32 bg-black text-white">
        <div class="max-w-3xl mx-auto px-6 sm:px-8 lg:px-12 text-center">
            <p class="text-emerald-400 font-medium tracking-widest uppercase text-xs mb-6">
                {{ $settings['cta_eyebrow'] ?? "Let's Talk" }}
            </p>
            
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-8 text-white leading-tight">
                {{ $settings['cta_title'] ?? 'Ready to Get Started?' }}
            </h2>
            
            <p class="text-lg text-gray-400 mb-12 max-w-xl mx-auto leading-relaxed">
                {{ $settings['cta_subtitle'] ?? "Tell us about your SACCO, school, SME, or logistics operation. We'll recommend the right mix of Sanaa products and services for your needs." }}
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-emerald-500 text-white px-8 py-4 rounded-full text-base font-semibold hover:bg-emerald-400 transition-all duration-300 shadow-lg shadow-emerald-500/20">
                    {{ $settings['cta_primary_text'] ?? 'Book a Consultation' }}
                    <svg class="ml-3 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ $settings['cta_secondary_link'] ?? '/finance' }}" class="inline-flex items-center justify-center border border-white/20 text-white px-8 py-4 rounded-full text-base font-semibold hover:bg-white/5 hover:border-white/30 transition-all duration-300">
                    {{ $settings['cta_secondary_text'] ?? 'Explore Sanaa Finance' }}
                </a>
            </div>
            
            <p class="mt-12 text-gray-600 text-sm">
                {{ $settings['cta_footer'] ?? 'Serving businesses across Uganda, Kenya, Tanzania, Rwanda, and DRC' }}
            </p>
        </div>
    </section>
</x-pages-layout>
