@php
    $title = $title ?? ($page->seo_title ?? ($page->title ?? 'Sanaa Finance'));
    $metaDescription = $metaDescription ?? ($page->meta_description ?? 'Sanaa Finance — modern banking & payments infrastructure.');
    $breadcrumbs = $breadcrumbs ?? [];
    $accent = 'emerald';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        /* Minimal critical tweaks */
        .focus-visible:focus { outline: 2px solid; outline-offset: 2px; }
        @media (prefers-reduced-motion: reduce) { * { animation: none !important; transition: none !important; } }
    </style>
    @stack('head')
</head>
<body class="antialiased text-gray-900 bg-white">
    <header class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/finance" class="flex items-center gap-2 font-semibold">
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
                <p>© {{ date('Y') }} Sanaa. Finance.</p>
                <a class="text-{{ $accent }}-600 hover:underline" href="/contact">Contact</a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

