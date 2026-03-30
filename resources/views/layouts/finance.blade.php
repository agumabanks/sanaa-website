@php
    $title = $title ?? ($page->seo_title ?? ($page->title ?? 'Sanaa Finance'));
    $metaDescription = $metaDescription ?? ($page->meta_description ?? 'Sanaa Finance — digital banking, SACCO management, ERP systems, and mobile money integration for Ugandan businesses. Loans, savings, payments & SMS/WhatsApp alerts.');
    $breadcrumbs = $breadcrumbs ?? [];
    $accent = 'emerald';
    $ogImage = $ogImage ?? asset('storage/images/sanaa-finance-og.png');
    $canonicalUrl = $canonicalUrl ?? url()->current();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="Sanaa Finance, Uganda banking, SACCO management, ERP system, mobile money, MTN MoMo, Airtel Money, microfinance, business loans, SMS alerts, WhatsApp alerts, fintech Uganda, payment gateway, loan management, savings, investment clubs">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="icon" href="{{ asset('storage/images/sanaa.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/sanaa.png') }}">

    {{-- Open Graph / Facebook / WhatsApp --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Sanaa Finance">
    <meta property="og:locale" content="en_UG">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        /* Minimal critical tweaks */
        .focus-visible:focus { outline: 2px solid; outline-offset: 2px; }
        @media (prefers-reduced-motion: reduce) { * { animation: none !important; transition: none !important; } }
    </style>
    @stack('head')

    {{-- Structured Data --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FinancialService",
        "name": "Sanaa Finance",
        "description": "{{ $metaDescription }}",
        "url": "https://sanaa.ug/finance",
        "logo": "{{ asset('storage/images/sanaa.png') }}",
        "image": "{{ $ogImage }}",
        "areaServed": {
            "@type": "Country",
            "name": "Uganda"
        },
        "serviceType": ["Digital Banking", "SACCO Management", "Microfinance ERP", "Mobile Money Integration", "Business Loans"],
        "provider": {
            "@type": "Organization",
            "name": "Sanaa",
            "url": "https://sanaa.ug"
        },
        "offers": {
            "@type": "AggregateOffer",
            "priceCurrency": "UGX",
            "lowPrice": "0",
            "highPrice": "1200000",
            "offerCount": "4"
        }
    }
    </script>
</head>
<body class="antialiased text-gray-900 bg-white">
    <header class="relative bg-gray-900 border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/finance" class="flex items-center gap-2 font-semibold text-white">
                    <span class="inline-block h-2 w-2 rounded-full bg-{{ $accent }}-500"></span>
                    <span>Sanaa Finance</span>
                </a>
                @include('finance.partials.nav')
            </div>
        </div>
    </header>

    @if(!empty($breadcrumbs))
        <nav class="border-b border-gray-100" aria-label="Breadcrumb">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 text-sm">
                @include('finance.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
            </div>
        </nav>
    @endif

    <main id="main" class="min-h-[60vh]">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <footer class="border-t border-gray-100 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-sm text-gray-500">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-6">
                    <p>© {{ date('Y') }} Sanaa. Finance.</p>
                    <a class="hover:text-emerald-600" href="{{ route('sanaa-cards.index') }}">Sanaa Cards</a>
                </div>
                <a class="text-{{ $accent }}-600 hover:underline" href="/contact">Contact</a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
