<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Sanaa Co.'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

         {{-- Favicon --}}
    <link rel="icon" href="{{ cdn_asset('storage/images/sanaa.png') }}">
    <link rel="apple-touch-icon" href="{{ cdn_asset('storage/images/sanaa.png') }}">


        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <!-- Firebase Analytics -->
        @hasSection('analytics')
            <script defer>
                window.addEventListener('DOMContentLoaded', async () => {
                    const { initializeApp } = await import('https://www.gstatic.com/firebasejs/11.4.0/firebase-app.js');
                    const { getAnalytics } = await import('https://www.gstatic.com/firebasejs/11.4.0/firebase-analytics.js');

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
                    getAnalytics(app);
                });
            </script>
        @endif
    </body>
</html>
