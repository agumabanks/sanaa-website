<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sanaa Co.') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <x-banner />

        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside class="hidden md:block w-64 bg-gray-800 text-white">
                <div class="p-6 text-xl font-semibold border-b border-gray-700">
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-300">
                        {{ config('app.name', 'Sanaa Co.') }}
                    </a>
                </div>
                <nav class="p-6 space-y-2">
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Dashboard</a>
                    <a href="{{ route('blog.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Blog</a>
                    <a href="{{ route('team.index') }}" class="block px-3 py-2 rounded hover:bg-gray-700">Team</a>
                </nav>
            </aside>

            <div class="flex-1 flex flex-col">
                <!-- Header -->
                <header class="bg-white border-b p-4 flex items-center justify-between">
                    <div>
                        @isset($header)
                            {{ $header }}
                        @endisset
                    </div>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('profile.show') }}">Profile</x-dropdown-link>
                            <div class="border-t border-gray-200"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">Log Out</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </header>

                <!-- Page Content -->
                <main class="p-6 flex-1">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')

        @livewireScripts

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
