<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Sanaa Co.') }}</title>
    
    @if($metaDescription)
        <meta name="description" content="{{ $metaDescription }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Favicon --}}
    <link rel="icon" href="{{ cdn_asset('storage/images/sanaa.png') }}">
    <link rel="apple-touch-icon" href="{{ cdn_asset('storage/images/sanaa.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/layout-conflicts-fix.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="pages-nav">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-logo" aria-label="Go to homepage">
                <img src="{{ asset('storage/images/sanaa-logo-b.svg') }}" alt="{{ config('app.name') }}">
            </a>
            
            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">HOME</a></li>
                <li><a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">SERVICES</a></li>
                <li><a href="{{ route('products') }}" class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}">PRODUCTS</a></li>
                <li><a href="{{ route('careers') }}" class="nav-link {{ request()->routeIs('careers') ? 'active' : '' }}">CAREERS</a></li>
                <li><a href="{{ route('partners') }}" class="nav-link {{ request()->routeIs('partners') ? 'active' : '' }}">PARTNERS</a></li>
                <li><a href="{{ route('investor-relations') }}" class="nav-link {{ request()->routeIs('investor-relations') ? 'active' : '' }}">INVESTORS</a></li>
                <li><a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">BLOG</a></li>
                <li><a href="https://soko.sanaa.co" target="_blank" rel="noopener noreferrer" class="nav-link">SOKO 24</a></li>
            </ul>

            <div class="nav-actions">
                <a href="{{ route('contact') }}" class="btn-nav-outline">Contact Sales</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-nav">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-nav-outline">Sign In</a>
                    <a href="{{ route('register') }}" class="btn-nav">Get Started</a>
                @endauth
            </div>

            <button class="mobile-menu-button" id="mobile-menu-button" aria-label="Toggle mobile menu" aria-expanded="false">
                <span class="menu-line"></span>
                <span class="menu-line"></span>
                <span class="menu-line"></span>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <div class="mobile-nav" id="mobile-nav">
            <ul class="mobile-nav-links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">HOME</a></li>
                <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">SERVICES</a></li>
                <li><a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'active' : '' }}">PRODUCTS</a></li>
                <li><a href="{{ route('careers') }}" class="{{ request()->routeIs('careers') ? 'active' : '' }}">CAREERS</a></li>
                <li><a href="{{ route('partners') }}" class="{{ request()->routeIs('partners') ? 'active' : '' }}">PARTNERS</a></li>
                <li><a href="{{ route('investor-relations') }}" class="{{ request()->routeIs('investor-relations') ? 'active' : '' }}">INVESTORS</a></li>
                <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">BLOG</a></li>
                <li><a href="https://soko.sanaa.co" target="_blank" rel="noopener noreferrer">SOKO 24</a></li>
                
                <li class="mobile-actions">
                    <a href="{{ route('contact') }}" class="btn-nav-outline">Contact Sales</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-nav">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-nav-outline">Sign In</a>
                        <a href="{{ route('register') }}" class="btn-nav">Get Started</a>
                    @endauth
                </li>
            </ul>
        </div>
    </nav>

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
                    <li><a href="https://soko.sanaa.co" target="_blank" rel="noopener noreferrer">Soko 24</a></li>
                    <li><a href="{{ route('prices') }}">Pricing</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('careers') }}">Careers</a></li>
                    <li><a href="{{ route('partners') }}">Partners</a></li>
                    <li><a href="{{ route('investor-relations') }}">Investor Relations</a></li>
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

    <!-- Navigation JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileNav = document.getElementById('mobile-nav');

            if (mobileMenuButton && mobileNav) {
                mobileMenuButton.addEventListener('click', function() {
                    const isExpanded = this.classList.contains('active');
                    
                    this.classList.toggle('active');
                    mobileNav.classList.toggle('active');
                    
                    // Update ARIA attribute
                    this.setAttribute('aria-expanded', !isExpanded);
                    
                    // Prevent body scroll when menu is open
                    document.body.style.overflow = !isExpanded ? 'hidden' : '';
                });

                // Close mobile menu when clicking on a link
                const mobileLinks = mobileNav.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenuButton.classList.remove('active');
                        mobileNav.classList.remove('active');
                        mobileMenuButton.setAttribute('aria-expanded', 'false');
                        document.body.style.overflow = '';
                    });
                });

                // Close mobile menu when clicking outside
                document.addEventListener('click', (e) => {
                    if (!mobileNav.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                        mobileMenuButton.classList.remove('active');
                        mobileNav.classList.remove('active');
                        mobileMenuButton.setAttribute('aria-expanded', 'false');
                        document.body.style.overflow = '';
                    }
                });

                // Close mobile menu on escape key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && mobileNav.classList.contains('active')) {
                        mobileMenuButton.classList.remove('active');
                        mobileNav.classList.remove('active');
                        mobileMenuButton.setAttribute('aria-expanded', 'false');
                        document.body.style.overflow = '';
                        mobileMenuButton.focus();
                    }
                });
            }

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    // Reset mobile menu on larger screens
                    if (mobileMenuButton && mobileNav) {
                        mobileMenuButton.classList.remove('active');
                        mobileNav.classList.remove('active');
                        mobileMenuButton.setAttribute('aria-expanded', 'false');
                        document.body.style.overflow = '';
                    }
                }
            });
        });
    </script>
</body>
</html>