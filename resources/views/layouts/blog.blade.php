{{-- resources/views/layouts/blog.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <title>{{ $seoData['title'] ?? 'Sanaa Blog - Minimalist Thoughts' }}</title>
    <meta name="description" content="{{ $seoData['description'] ?? 'Discover minimalist insights and profound thoughts on technology, design, and innovation.' }}">
    <meta name="keywords" content="{{ $seoData['keywords'] ?? 'sanaa, blog, minimalism, technology, design, innovation' }}">
    <meta name="author" content="{{ $seoData['author'] ?? 'Sanaa Team' }}">
    <link rel="canonical" href="{{ $seoData['url'] ?? url()->current() }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $seoData['title'] ?? 'Sanaa Blog' }}">
    <meta property="og:description" content="{{ $seoData['description'] ?? '' }}">
    <meta property="og:image" content="{{ $seoData['image'] ?? asset('images/sanaa-blog-og.jpg') }}">
    <meta property="og:url" content="{{ $seoData['url'] ?? url()->current() }}">
    <meta property="og:site_name" content="Sanaa Blog">
    @isset($seoData['published_time'])
        <meta property="article:published_time" content="{{ $seoData['published_time'] }}">
    @endisset
    @isset($seoData['modified_time'])
        <meta property="article:modified_time" content="{{ $seoData['modified_time'] }}">
    @endisset
    @isset($seoData['author'])
        <meta property="article:author" content="{{ $seoData['author'] }}">
    @endisset

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoData['title'] ?? 'Sanaa Blog' }}">
    <meta name="twitter:description" content="{{ $seoData['description'] ?? '' }}">
    <meta name="twitter:image" content="{{ $seoData['image'] ?? asset('images/sanaa-blog-og.jpg') }}">
    <meta name="twitter:site" content="@sanaa_co">

    {{-- Structured Data --}}
    @isset($blog)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "headline": "{{ $blog->title }}",
        "description": "{{ $blog->excerpt }}",
        "image": "{{ $blog->featured_image_url }}",
        "author": {
            "@type": "Person",
            "name": "{{ $blog->author->name ?? 'Sanaa Team' }}"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Sanaa",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('images/sanaa-logo.png') }}"
            }
        },
        "datePublished": "{{ $blog->published_at ? $blog->published_at->toISOString() : $blog->created_at->toISOString() }}",
        "dateModified": "{{ $blog->updated_at->toISOString() }}",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ $blog->url }}"
        }
    }
    </script>
    @endisset

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Charter:ital,wght@0,400;0,700;1,400;1,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/css/blog.css'])

    {{-- PWA Meta --}}
    <meta name="theme-color" content="#000000">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Sanaa Blog">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

    <style>
        /* Critical CSS for immediate load */
        :root {
            --bg-primary: #000000;
            --text-primary: #ffffff;
            --text-secondary: #a0a0a0;
            --accent-green: #00ff00;
            --accent-green-hover: #00cc00;
            --border-color: #333333;
            --reading-width: 680px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: var(--accent-green);
            z-index: 9999;
            transition: width 0.1s ease;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .loading-skeleton {
            background: linear-gradient(90deg, #1a1a1a 25%, #2a2a2a 50%, #1a1a1a 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>

<body class="antialiased">
    {{-- Reading Progress Bar --}}
    <div class="reading-progress" id="reading-progress"></div>

    {{-- Navigation --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-black/80 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('blog.index') }}" class="text-xl font-bold text-white hover:text-green-400 transition-colors">
                        Sanaa
                    </a>
                    <div class="hidden md:flex space-x-6">
                        <a href="{{ route('blog.index') }}" class="text-gray-300 hover:text-white transition-colors">All Posts</a>
                        <a href="{{ route('blog.index', ['category' => 'technology']) }}" class="text-gray-300 hover:text-white transition-colors">Technology</a>
                        <a href="{{ route('blog.index', ['category' => 'design']) }}" class="text-gray-300 hover:text-white transition-colors">Design</a>
                        <a href="{{ route('blog.index', ['category' => 'business']) }}" class="text-gray-300 hover:text-white transition-colors">Business</a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    {{-- Reading Controls (only on article pages) --}}
                    @isset($blog)
                        <div class="hidden md:flex items-center space-x-2 bg-gray-900 rounded-full px-3 py-1">
                            <button id="decrease-font" class="text-gray-400 hover:text-white p-1 rounded transition-colors" title="Decrease font size">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 16a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"/>
                                </svg>
                            </button>
                            <span class="text-xs text-gray-400">Aa</span>
                            <button id="increase-font" class="text-gray-400 hover:text-white p-1 rounded transition-colors" title="Increase font size">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 16a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"/>
                                </svg>
                            </button>
                        </div>

                        <button id="text-to-speech" class="text-gray-400 hover:text-white p-2 rounded transition-colors" title="Listen to article">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.617.824L4.168 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.168l4.215-3.824a1 1 0 011.617.824z"/>
                                <path d="M11.293 5.293a1 1 0 011.414 1.414L11.414 8l1.293 1.293a1 1 0 01-1.414 1.414L10 9.414l-1.293 1.293a1 1 0 01-1.414-1.414L8.586 8 7.293 6.707a1 1 0 011.414-1.414L10 6.586l1.293-1.293z"/>
                            </svg>
                        </button>
                    @endisset

                    {{-- Search --}}
                    <button class="text-gray-400 hover:text-white p-2 rounded transition-colors" title="Search">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    {{-- Mobile Menu --}}
                    <button class="md:hidden text-gray-400 hover:text-white p-2" id="mobile-menu-button">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-gray-900 border-t border-gray-800">
                <a href="{{ route('blog.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">All Posts</a>
                <a href="{{ route('blog.index', ['category' => 'technology']) }}" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">Technology</a>
                <a href="{{ route('blog.index', ['category' => 'design']) }}" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">Design</a>
                <a href="{{ route('blog.index', ['category' => 'business']) }}" class="block px-3 py-2 text-gray-300 hover:text-white transition-colors">Business</a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="pt-16 min-h-screen">
        @yield('content')
    </main>

    {{-- Keyboard Shortcuts Help --}}
    <div id="shortcuts-help" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden items-center justify-center">
        <div class="bg-gray-900 rounded-lg p-6 max-w-md mx-4">
            <h3 class="text-lg font-semibold mb-4">Keyboard Shortcuts</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-400">Like article</span>
                    <kbd class="bg-gray-800 px-2 py-1 rounded">L</kbd>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Bookmark article</span>
                    <kbd class="bg-gray-800 px-2 py-1 rounded">S</kbd>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Share article</span>
                    <kbd class="bg-gray-800 px-2 py-1 rounded">H</kbd>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Text to speech</span>
                    <kbd class="bg-gray-800 px-2 py-1 rounded">T</kbd>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Increase font</span>
                    <kbd class="bg-gray-800 px-2 py-1 rounded">+</kbd>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Decrease font</span>
                    <kbd class="bg-gray-800 px-2 py-1 rounded">-</kbd>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Show shortcuts</span>
                    <kbd class="bg-gray-800 px-2 py-1 rounded">?</kbd>
                </div>
            </div>
            <button onclick="hideShortcuts()" class="mt-4 w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded transition-colors">
                Close
            </button>
        </div>
    </div>

    {{-- Scripts --}}
    @vite(['resources/js/app.js', 'resources/js/blog.js'])
    
    {{-- Service Worker Registration --}}
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js')
                    .then(function(registration) {
                        console.log('ServiceWorker registration successful');
                    })
                    .catch(function(err) {
                        console.log('ServiceWorker registration failed');
                    });
            });
        }
    </script>

    @stack('scripts')
</body>
</html>