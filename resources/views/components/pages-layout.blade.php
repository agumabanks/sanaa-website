<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials.seo')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Favicon --}}
    <link rel="icon" href="{{ cdn_asset('storage/images/sanaa.png') }}">
    <link rel="apple-touch-icon" href="{{ cdn_asset('storage/images/sanaa.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/layout-conflicts-fix.css', 'resources/css/premium-nav.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    @include('components.header')

    <!-- Page Content -->
    <main class="page-content pt-16">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer />

    @stack('modals')
    @livewireScripts
    @stack('scripts')

    <!-- Firebase Analytics -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.4.0/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.4.0/firebase-analytics.js";
        const firebaseConfig = {
            apiKey: "{{ config('services.firebase.api_key') }}",
            authDomain: "{{ config('services.firebase.auth_domain') }}",
            projectId: "{{ config('services.firebase.project_id') }}",
            storageBucket: "{{ config('services.firebase.storage_bucket') }}",
            messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
            appId: "{{ config('services.firebase.app_id') }}",
            measurementId: "{{ config('services.firebase.measurement_id') }}"
        };
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
    </script>
</body>
</html>