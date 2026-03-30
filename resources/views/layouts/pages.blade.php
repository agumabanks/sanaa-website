<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Sanaa Co.') }}</title>
    
    @isset($metaDescription)
        <meta name="description" content="{{ $metaDescription }}">
    @endisset

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Favicon --}}
    <link rel="icon" href="{{ cdn_asset('storage/images/sanaa.png') }}">
    <link rel="apple-touch-icon" href="{{ cdn_asset('storage/images/sanaa.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <style>
        :root {
            --primary: #0f172a;
            --secondary: #1e293b;
            --accent: #10b981;
            --accent-light: #34d399;
            --white: #ffffff;
            --emerald: #10b981;
            --emerald-light: #34d399;
        }

        /* Content area */
        .page-content {
            margin-top: 64px; /* Account for fixed navigation */
            min-height: calc(100vh - 64px);
        }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <x-header />

    <!-- Page Content -->
    <main class="page-content">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="page-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Products & Services</h4>
                <ul>
                    <li><a href="{{ route('services') }}">Services</a></li>
                    <li><a href="{{ route('products') }}">Products</a></li>
                    <li><a href="{{ route('sanaa-cards.index') }}">Sanaa Cards</a></li>
                    <li><a href="https://soko.sanaa.co">Soko 24</a></li>
                    <li><a href="{{ route('prices') }}">Pricing</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('careers') }}">Careers</a></li>
                    <li><a href="{{ route('partners') }}">Partners</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Resources</h4>
                <ul>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('support') }}">Support</a></li>
                    <li><a href="{{ route('why-sanaa') }}">Why Sanaa</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Legal</h4>
                <ul>
                    <li><a href="{{ route('policies.privacy-notice') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}">Terms of Service</a></li>
                    <li><a href="{{ route('policies.security') }}">Security</a></li>
                    <li><a href="{{ route('policies.seller-policies') }}">Seller Policies</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>

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