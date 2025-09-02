<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">

        <title>@yield('title', 'Sign In | ' . config('app.name', 'Sanaa'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-black text-white selection:bg-green-500/30 selection:text-white">
        <!-- Background Image -->
        <div aria-hidden="true" class="fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute inset-0">
                <div class="w-full h-full bg-center bg-cover" style="background-image:url('https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2067&auto=format&fit=crop'); filter:saturate(1.1) contrast(1.05);"></div>
                <div class="absolute inset-0 bg-black/55"></div>
                <!-- Vignette -->
                <div class="pointer-events-none absolute inset-0" style="background:radial-gradient(1200px 600px at 50% 0%, rgba(0,0,0,0) 20%, rgba(0,0,0,0.55) 70%, rgba(0,0,0,0.8) 100%);"></div>
            </div>
            <!-- Soft lights -->
            <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[900px] h-[900px] rounded-full blur-[120px] opacity-25" style="background: conic-gradient(from 180deg at 50% 50%, #00ffa3, #00e5ff, #b3ff00, #00ffa3);"></div>
        </div>

        <!-- Content -->
        <div class="relative min-h-screen grid place-items-center p-6">
            {{ $slot }}
        </div>
    </body>
</html>
