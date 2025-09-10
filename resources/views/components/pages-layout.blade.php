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
    <link rel="stylesheet" href="{{ asset('resources/css/layout-conflicts-fix.css') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Favicon --}}
    <link rel="icon" href="{{ cdn_asset('storage/images/sanaa.png') }}">
    <link rel="apple-touch-icon" href="{{ cdn_asset('storage/images/sanaa.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <style>
        /* CSS Custom Properties */
        :root {
            --nav-height: 80px;
            --emerald-50: #ecfdf5;
            --emerald-100: #d1fae5;
            --emerald-500: #10b981;
            --emerald-600: #059669;
            --emerald-700: #047857;
        }

        /* Update the nav height variable */
:root {
    --nav-height: 80px; /* Make this consistent across all layouts */
}


        /* Base Styles */
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Navigation Styles */
        .pages-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            height: var(--nav-height);
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            z-index: 51;
        }

        .nav-logo img {
            height: 32px;
            width: auto;
            filter: invert(1);
            transition: filter 0.3s ease;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            letter-spacing: 0.025rem;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--emerald-500);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -0.25rem;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--emerald-500);
            border-radius: 1px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-nav {
            background: linear-gradient(135deg, var(--emerald-600), var(--emerald-500));
            color: white;
            padding: 0.625rem 1.25rem;
            border-radius: 9999px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }

        .btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-nav-outline {
            background: transparent;
            color: rgba(255, 255, 255, 0.8);
            padding: 0.625rem 1.25rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 9999px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        .btn-nav-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--emerald-500);
            color: var(--emerald-500);
            text-decoration: none;
        }

        /* Mobile Menu */
        .mobile-menu-button {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 0.5rem;
            z-index: 51;
            background: none;
            border: none;
        }

        .menu-line {
            width: 25px;
            height: 2px;
            background: white;
            margin: 3px 0;
            transition: 0.3s;
            border-radius: 2px;
        }

        .mobile-nav {
            display: none;
            position: fixed;
            top: var(--nav-height);
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(20px);
            z-index: 40;
            padding: 2rem;
            overflow-y: auto;
        }

        .mobile-nav.active {
            display: block;
        }

        .mobile-nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mobile-nav-links li {
            margin: 1rem 0;
        }

        .mobile-nav-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
            display: block;
            padding: 1rem 0;
            transition: color 0.3s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .mobile-nav-links a:hover,
        .mobile-nav-links a.active {
            color: var(--emerald-500);
        }

        /* Content Spacing */
        .page-content {
            margin-top: var(--nav-height);
            min-height: calc(100vh - var(--nav-height));
        }

        /* Footer */
        .page-footer {
            background: #0f172a;
            color: white;
            padding: 3rem 2rem 1.5rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-section h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--emerald-500);
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section ul li a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 0.875rem;
        }

        .footer-section ul li a:hover {
            color: var(--emerald-500);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 2rem;
            padding-top: 1.5rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.875rem;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-container {
                padding: 0 1rem;
            }

            .nav-links {
                display: none;
            }

            .nav-actions {
                display: none;
            }

            .mobile-menu-button {
                display: flex;
            }

            .mobile-menu-button.active .menu-line:nth-child(1) {
                transform: rotate(-45deg) translate(-5px, 6px);
            }

            .mobile-menu-button.active .menu-line:nth-child(2) {
                opacity: 0;
            }

            .mobile-menu-button.active .menu-line:nth-child(3) {
                transform: rotate(45deg) translate(-5px, -6px);
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .mobile-nav-links .mobile-actions {
                margin-top: 2rem;
                padding-top: 2rem;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }

            .mobile-nav-links .mobile-actions a {
                display: block;
                text-align: center;
                margin: 1rem 0;
                padding: 0.75rem 1rem;
                border-radius: 9999px;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .mobile-nav-links .mobile-actions .btn-nav {
                background: linear-gradient(135deg, var(--emerald-600), var(--emerald-500));
                border: none;
                color: white;
            }
        }

        /* Utility Classes */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* Smooth animations */
        @media (prefers-reduced-motion: no-preference) {
            * {
                scroll-behavior: smooth;
            }
        }
    </style>

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