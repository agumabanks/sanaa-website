@php
use Illuminate\Support\Facades\Route;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">

        <title>{{ $title ?? config('app.name', 'Sanaa Co.') }}</title>

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
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <x-banner />

        <div class="min-h-screen flex" id="dashboard-root">
            <!-- Sidebar - Sticky and non-scrolling -->
            <aside class="hidden md:flex md:flex-col w-64 bg-black text-white border-r border-white/10 sticky top-0 h-screen shrink-0 overflow-y-auto">
                @php
                    $navItem = function($route, $label, $icon, $exact = false) {
                        if (!Route::has($route)) {
                            return '';
                        }

                        $isActive = request()->routeIs($route) || (!$exact && request()->routeIs($route.'.*'));
                        $base = 'group flex items-center gap-3 px-3 py-2 rounded-lg transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-white/20';
                        $active = $isActive ? 'bg-white/10 text-white border border-white/10' : 'text-white/70 hover:text-white hover:bg-white/5';
                        $aria = $isActive ? "aria-current='page'" : '';
                        $iconSpan = Auth::user() && Auth::user()->isAdmin() ? "<span class='opacity-70 group-hover:opacity-100'>$icon</span>" : '';

                        return "<a href='".route($route)."' $aria class='$base $active'>".
                               $iconSpan.
                               "<span class='text-sm font-medium tracking-tight'>$label</span>".
                               "</a>";
                    };

                    $user = Auth::user();
                    $financeRoles = ['FinanceEditor','FinancePublisher','FinanceAdmin'];
                    $isFinance = false;
                    if ($user) {
                        if (method_exists($user, 'hasAnyRole') && $user->hasAnyRole($financeRoles)) {
                            $isFinance = true;
                        } elseif (isset($user->roles)) {
                            $roles = is_string($user->roles) ? (json_decode($user->roles, true) ?: [$user->roles]) : $user->roles;
                            if (is_array($roles)) {
                                $isFinance = count(array_intersect($financeRoles, $roles)) > 0;
                            }
                        } elseif (isset($user->role) && in_array($user->role, $financeRoles, true)) {
                            $isFinance = true;
                        }
                    }

                    $adminQuickJumpItems = collect([
                        ['label' => 'Dashboard', 'route' => 'dashboard'],
                        ['label' => 'Blog', 'route' => 'dashboard.blog'],
                        ['label' => 'New Post', 'route' => Route::has('dashboard.blog.compose') ? 'dashboard.blog.compose' : 'dashboard.blog'],
                        ['label' => 'Pages', 'route' => 'dashboard.pages.index'],
                        ['label' => 'Categories', 'route' => 'dashboard.categories'],
                        ['label' => 'Products', 'route' => 'dashboard.offerings'],
                        ['label' => 'Services', 'route' => 'dashboard.services.index'],
                        ['label' => 'Pricing', 'route' => 'dashboard.prices'],
                        ['label' => 'Team', 'route' => 'dashboard.team'],
                        ['label' => 'Careers', 'route' => 'dashboard.careers'],
                        ['label' => 'Partners', 'route' => 'dashboard.partners'],
                        ['label' => 'Users', 'route' => 'dashboard.users'],
                        ['label' => 'Domains', 'route' => 'dashboard.domains.index'],
                        ['label' => 'Footer', 'route' => 'dashboard.footer.edit'],
                        ['label' => 'Policies', 'route' => 'dashboard.policies'],
                    ])->filter(fn ($item) => Route::has($item['route']))
                      ->map(fn ($item) => [
                          'label' => $item['label'],
                          'url' => route($item['route']),
                      ])
                      ->values();
                @endphp

                @include('layouts.partials.dashboard-sidebar')
            </aside>

            <!-- Content - With margin to account for fixed sidebar -->
                <div class="flex-1 flex flex-col">
                    <!-- Header -->
                    <header class="bg-white border-b border-gray-200 p-4 flex items-center justify-between sticky top-0 z-10 shadow-sm">
                    <div class="flex items-center gap-3 min-w-0">
                        <button id="mobile-menu-button" class="md:hidden inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-400" aria-label="Open menu">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor"><path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z"/></svg>
                        </button>
                        @isset($header)
                            <div class="min-w-0">{{ $header }}</div>
                        @endisset
                    </div>
                    <div class="flex items-center gap-3">
                        @if($user?->isAdmin())
                            <form id="dashboardQuickJumpForm" class="hidden lg:block">
                                <label class="sr-only" for="dashboardQuickJumpInput">Quick jump</label>
                                <div class="relative">
                                    <input id="dashboardQuickJumpInput" type="text" list="dashboardQuickJumpList" placeholder="Jump to blog, pages, users..." autocomplete="off" class="w-64 rounded-lg border border-gray-300 bg-white text-sm py-2 pl-9 pr-3 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400" />
                                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" viewBox="0 0 24 24" fill="currentColor"><path d="M10 18a8 8 0 115.293-2.707l4.707 4.707-1.414 1.414-4.707-4.707A7.963 7.963 0 0110 18z"/></svg>
                                    <datalist id="dashboardQuickJumpList">
                                        @foreach($adminQuickJumpItems as $item)
                                            <option value="{{ $item['label'] }}"></option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </form>
                        @endif
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('profile.show') }}">Profile</x-dropdown-link>
                                @if(Route::has('home'))
                                    <x-dropdown-link href="{{ route('home') }}">View Site</x-dropdown-link>
                                @endif
                                <div class="border-t border-gray-200"></div>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">Log Out</x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-6 flex-1">
                    @if(session('success') || session('status'))
                        <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-900 px-4 py-3">
                            {{ session('success') ?: session('status') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 text-red-900 px-4 py-3">
                            {{ session('error') }}
                        </div>
                    @endif

                    @hasSection('content')
                        @yield('content')
                    @else
                        {{ $slot ?? '' }}
                    @endif
                </main>
            </div>
        </div>

        <!-- Mobile Sidebar Overlay -->
        <div id="mobile-sidebar" class="fixed inset-0 z-40 hidden md:hidden" aria-hidden="true">
            <div id="mobile-backdrop" class="absolute inset-0 bg-black/40"></div>
            <div class="absolute inset-y-0 left-0 w-72 bg-black text-white border-r border-white/10 p-3 overflow-y-auto">
                @include('layouts.partials.dashboard-sidebar', ['mobile' => true])
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
                if (e.key === '/' && !['INPUT', 'TEXTAREA', 'SELECT'].includes(document.activeElement?.tagName)) {
                  const quickJump = document.getElementById('dashboardQuickJumpInput');
                  if (quickJump) {
                    e.preventDefault();
                    quickJump.focus();
                    quickJump.select();
                    return;
                  }
                }

	            if ((e.altKey || e.metaKey) && (e.key === 'n' || e.key === 'N')) {
	              e.preventDefault();
	              @if(Route::has('dashboard.blog'))
	              const dest = "{{ Route::has('dashboard.blog.compose') ? route('dashboard.blog.compose') : route('dashboard.blog') }}#create-post";
	              if (location.pathname.startsWith('/dashboard/blog') && !location.pathname.endsWith('/compose')) {
	                const target = document.getElementById('create-post');
	                target?.scrollIntoView({behavior: 'smooth', block: 'start'});
	              } else {
	                window.location.href = dest;
	              }
	              @endif
	            }
	          });

              const quickJumpForm = document.getElementById('dashboardQuickJumpForm');
              const quickJumpInput = document.getElementById('dashboardQuickJumpInput');
              const quickJumpItems = @json($adminQuickJumpItems);

              quickJumpForm?.addEventListener('submit', (event) => {
                event.preventDefault();
                const query = (quickJumpInput?.value || '').trim().toLowerCase();
                if (!query) {
                  return;
                }

                const exactMatch = quickJumpItems.find((item) => item.label.toLowerCase() === query);
                if (exactMatch) {
                  window.location.href = exactMatch.url;
                  return;
                }

                const partialMatch = quickJumpItems.find((item) => item.label.toLowerCase().includes(query) || query.includes(item.label.toLowerCase()));
                if (partialMatch) {
                  window.location.href = partialMatch.url;
                }
              });
	        </script>
    </body>
</html>
