<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Sanaa Co.') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <x-banner />

        <div class="min-h-screen flex" id="dashboard-root">
            <!-- Sidebar -->
            <aside class="hidden md:flex md:flex-col w-64 bg-black text-white border-r border-white/10">
                <div class="h-16 flex items-center px-6 border-b border-white/10">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-white/90 hover:text-white transition-colors">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 12l9-9 9 9-1.5 1.5L12 5.5 4.5 13.5 3 12z"/></svg>
                        <span class="text-lg font-semibold tracking-tight">{{ config('app.name', 'Sanaa Admin') }}</span>
                    </a>
                </div>
                <nav class="flex-1 p-3 space-y-1">
                    @php($navItem = function($route, $label, $icon, $exact = false) {
                        $isActive = request()->routeIs($route) || (!$exact && request()->routeIs($route.'.*'));
                        $base = 'group flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-white/20';
                        $active = $isActive ? 'bg-white/10 text-white border border-white/10' : 'text-white/70 hover:text-white hover:bg-white/5';
                        $aria = $isActive ? "aria-current='page'" : '';
                        return "<a href='".route($route)."' $aria class='$base $active'>".
                               "<span class='opacity-70 group-hover:opacity-100'>$icon</span>".
                               "<span class='text-sm font-medium tracking-tight'>$label</span>".
                               "</a>";
                    })
                    {!! $navItem('dashboard', 'Dashboard', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z'/></svg>", true) !!}
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <div class="px-3 pt-3 pb-1 text-[11px] uppercase tracking-wider text-white/50">Management</div>
                        {!! $navItem('dashboard.blog', 'Blog', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M4 4h16v2H4V4zm0 4h10v2H4V8zm0 4h16v2H4v-2zm0 4h10v2H4v-2z'/></svg>") !!}
                        <div class="pl-9 pr-3 space-y-1">
                            <a href="{{ route('dashboard.blog') }}" class="block text-xs text-white/60 hover:text-white">All Posts</a>
                            <a href="{{ route('dashboard.blog') }}#create-post" class="block text-xs text-white/60 hover:text-white">New Post</a>
                        </div>
                        {!! $navItem('dashboard.categories', 'Categories', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 5h8v8H3V5zm10 0h8v8h-8V5zM3 15h8v4H3v-4zm10 0h8v4h-8v-4z'/></svg>") !!}
                        {!! $navItem('dashboard.team', 'Team', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z'/></svg>") !!}
                        {!! $navItem('dashboard.careers', 'Careers', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M20 6h-4V4H8v2H4v2h16V6zm-1 4H5l-1 10h18L19 10zM9 6h6v2H9V6z'/></svg>") !!}
                        {!! $navItem('dashboard.partners', 'Partners', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h10v-2.5c0-1.1.9-2 2-2h2.03C15.45 13.4 11.33 13 8 13zm8 0c-.34 0-.67.02-.99.05 1.72.45 2.99 1.26 3.68 2.45H23v-1c0-2.33-4.67-3.5-7-3.5z'/></svg>") !!}
                        {!! $navItem('dashboard.users', 'Users', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/></svg>") !!}
                        {!! $navItem('dashboard.offerings', 'Offerings', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 13h8V3H3v10zm10 8h8v-6h-8v6zm0-18v6h8V3h-8zM3 21h8v-6H3v6z'/></svg>") !!}
                        {!! $navItem('dashboard.developer-platforms', 'Developers', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M8 5l-6 7 6 7v-4h8v4l6-7-6-7v4H8V5z'/></svg>") !!}
                        {!! $navItem('dashboard.hardware-rentals', 'Hardware Rentals', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M20 8h-3V4H7v4H4l-2 3v9h2v-2h16v2h2v-9l-2-3zM9 6h6v2H9V6zm11 10H4v-5h16v5z'/></svg>") !!}
                        {!! $navItem('dashboard.prices', 'Prices', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 2.18L18.56 6 12 8.82 5.44 6 12 3.18zM5 8.1l7 2.8 7-2.8V11c0 4.09-2.63 7.89-7 9-4.37-1.11-7-4.91-7-9V8.1z'/></svg>") !!}
                        {!! $navItem('dashboard.policies', 'Policies', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M6 2h9l5 5v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm8 7V3.5L19.5 9H14z'/></svg>") !!}
                    @endif
                </nav>
                @if(Auth::check() && Auth::user()->isAdmin())
                    <div class="p-3 border-t border-white/10 mt-3">
                        <a href="{{ route('dashboard.blog') }}#create-post" class="inline-flex items-center justify-center w-full gap-2 rounded-lg bg-white hover:bg-gray-200 text-black text-sm font-medium py-2 transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13H13v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                            New Post
                        </a>
                    </div>
                @endif
            </aside>

            <!-- Content -->
            <div class="flex-1 flex flex-col">
                <!-- Header -->
                <header class="bg-white/80 backdrop-blur supports-[backdrop-filter]:bg-white/60 border-b border-gray-200 p-4 flex items-center justify-between sticky top-0 z-10">
                    <div class="flex items-center gap-3">
                        <button id="mobile-menu-button" class="md:hidden inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-400" aria-label="Open menu">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z"/></svg>
                        </button>
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

        <!-- Mobile Sidebar Overlay -->
        <div id="mobile-sidebar" class="fixed inset-0 z-40 hidden md:hidden" aria-hidden="true">
            <div id="mobile-backdrop" class="absolute inset-0 bg-black/40"></div>
            <div class="absolute inset-y-0 left-0 w-72 bg-black text-white border-r border-white/10 p-3 overflow-y-auto">
                <div class="h-14 flex items-center px-3 mb-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-white/90 hover:text-white transition-colors">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 12l9-9 9 9-1.5 1.5L12 5.5 4.5 13.5 3 12z"/></svg>
                        <span class="text-base font-semibold tracking-tight">{{ config('app.name', 'Sanaa Admin') }}</span>
                    </a>
                    <button id="mobile-menu-close" class="ml-auto inline-flex items-center justify-center rounded-md p-2 text-gray-300 hover:bg-white/5" aria-label="Close menu">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                @php($navItem = function($route, $label, $icon, $exact = false) {
                    $isActive = request()->routeIs($route) || (!$exact && request()->routeIs($route.'.*'));
                    $base = 'group flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-white/20';
                    $active = $isActive ? 'bg-white/10 text-white border border-white/10' : 'text-white/70 hover:text-white hover:bg-white/5';
                    $aria = $isActive ? "aria-current='page'" : '';
                    return "<a href='".route($route)."' $aria class='$base $active'>".
                           "<span class='opacity-70 group-hover:opacity-100'>$icon</span>".
                           "<span class='text-sm font-medium tracking-tight'>$label</span>".
                           "</a>";
                })
                <nav class="space-y-1">
                    {!! $navItem('dashboard', 'Dashboard', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z'/></svg>", true) !!}
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <div class="px-3 pt-3 pb-1 text-[11px] uppercase tracking-wider text-white/50">Management</div>
                        {!! $navItem('dashboard.blog', 'Blog', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M4 4h16v2H4V4zm0 4h10v2H4V8zm0 4h16v2H4v-2zm0 4h10v2H4v-2z'/></svg>") !!}
                        <div class="pl-9 pr-3 space-y-1">
                            <a href="{{ route('dashboard.blog') }}" class="block text-xs text-white/60 hover:text-white">All Posts</a>
                            <a href="{{ route('dashboard.blog') }}#create-post" class="block text-xs text-white/60 hover:text-white">New Post</a>
                        </div>
                        {!! $navItem('dashboard.categories', 'Categories', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 5h8v8H3V5zm10 0h8v8h-8V5zM3 15h8v4H3v-4zm10 0h8v4h-8v-4z'/></svg>") !!}
                        {!! $navItem('dashboard.team', 'Team', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0c-.34 0-.67.02-.99.05 1.72.45 2.99 1.26 3.68 2.45H23v-1c0-2.33-4.67-3.5-7-3.5z'/></svg>") !!}
                        {!! $navItem('dashboard.careers', 'Careers', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M20 6h-4V4H8v2H4v2h16V6zm-1 4H5l-1 10h18L19 10zM9 6h6v2H9V6z'/></svg>") !!}
                        {!! $navItem('dashboard.partners', 'Partners', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h10v-2.5c0-1.1.9-2 2-2h2.03C15.45 13.4 11.33 13 8 13zm8 0c-.34 0-.67.02-.99.05 1.72.45 2.99 1.26 3.68 2.45H23v-1c0-2.33-4.67-3.5-7-3.5z'/></svg>") !!}
                        {!! $navItem('dashboard.users', 'Users', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/></svg>") !!}
                        {!! $navItem('dashboard.offerings', 'Offerings', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 13h8V3H3v10zm10 8h8v-6h-8v6zm0-18v6h8V3h-8zM3 21h8v-6H3v6z'/></svg>") !!}
                        {!! $navItem('dashboard.developer-platforms', 'Developers', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M8 5l-6 7 6 7v-4h8v4l6-7-6-7v4H8V5z'/></svg>") !!}
                        {!! $navItem('dashboard.hardware-rentals', 'Hardware Rentals', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M20 8h-3V4H7v4H4l-2 3v9h2v-2h16v2h2v-9l-2-3zM9 6h6v2H9V6zm11 10H4v-5h16v5z'/></svg>") !!}
                        {!! $navItem('dashboard.prices', 'Prices', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 2.18L18.56 6 12 8.82 5.44 6 12 3.18zM5 8.1l7 2.8 7-2.8V11c0 4.09-2.63 7.89-7 9-4.37-1.11-7-4.91-7-9V8.1z'/></svg>") !!}
                        {!! $navItem('dashboard.policies', 'Policies', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M6 2h9l5 5v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm8 7V3.5L19.5 9H14z'/></svg>") !!}
                    @endif
                </nav>
                @if(Auth::check() && Auth::user()->isAdmin())
                    <div class="p-3 border-t border-white/10 mt-3">
                        <a href="{{ route('dashboard.blog') }}#create-post" class="inline-flex items-center justify-center w-full gap-2 rounded-lg bg-white hover:bg-gray-200 text-black text-sm font-medium py-2 transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13H13v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                            New Post
                        </a>
                    </div>
                @endif
            </div>
        </div>

        @stack('modals')

        @livewireScripts
        @stack('scripts')

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
        <script>
          // Mobile sidebar toggling
          const btn = document.getElementById('mobile-menu-button');
          const closeBtn = document.getElementById('mobile-menu-close');
          const overlay = document.getElementById('mobile-sidebar');
          const backdrop = document.getElementById('mobile-backdrop');
          function openSidebar(){ overlay?.classList.remove('hidden'); document.body.style.overflow='hidden'; }
          function closeSidebar(){ overlay?.classList.add('hidden'); document.body.style.overflow=''; }
          btn?.addEventListener('click', openSidebar);
          closeBtn?.addEventListener('click', closeSidebar);
          backdrop?.addEventListener('click', closeSidebar);
          // Close on route change via Turbolinks/Inertia (if used)
          window.addEventListener('hashchange', closeSidebar);

          // Quick shortcut: Alt+N to create a new post
          document.addEventListener('keydown', (e) => {
            if ((e.altKey || e.metaKey) && (e.key === 'n' || e.key === 'N')) {
              e.preventDefault();
              const dest = "{{ route('dashboard.blog') }}#create-post";
              if (location.pathname.startsWith('/dashboard/blog')) {
                const target = document.getElementById('create-post');
                target?.scrollIntoView({behavior: 'smooth', block: 'start'});
              } else {
                window.location.href = dest;
              }
            }
          });
        </script>
    </body>
    </html>

