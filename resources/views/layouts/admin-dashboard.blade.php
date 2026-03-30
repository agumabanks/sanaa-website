@php
use Illuminate\Support\Facades\Route;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} - {{ config('app.name', 'Sanaa') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{ cdn_asset('storage/images/sanaa.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        * { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'SF Pro Display', sans-serif; }
        
        body { background: #f5f5f7; }
        
        /* Sidebar */
        .admin-sidebar {
            background: linear-gradient(180deg, #1d1d1f 0%, #161617 100%);
            width: 240px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 40;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255,255,255,0.06);
        }
        
        .sidebar-logo {
            height: 52px;
            padding: 0 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        
        .sidebar-logo img { height: 28px; width: auto; }
        .sidebar-logo span { color: rgba(255,255,255,0.9); font-weight: 600; font-size: 15px; }
        
        .sidebar-nav { flex: 1; overflow-y: auto; padding: 12px 8px; }
        
        .nav-group { margin-bottom: 20px; }
        .nav-group-title {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(255,255,255,0.35);
            padding: 6px 12px;
            margin-bottom: 4px;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            color: rgba(255,255,255,0.65);
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s ease;
            margin-bottom: 2px;
        }
        .nav-link:hover { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.9); }
        .nav-link.active { background: rgba(255,255,255,0.12); color: #fff; }
        .nav-link svg { width: 18px; height: 18px; opacity: 0.7; flex-shrink: 0; }
        .nav-link.active svg { opacity: 1; }
        
        .sidebar-user {
            padding: 12px 16px;
            border-top: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar-user img { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; }
        .sidebar-user-info { flex: 1; min-width: 0; }
        .sidebar-user-name { font-size: 13px; font-weight: 500; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-user-email { font-size: 11px; color: rgba(255,255,255,0.5); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        
        /* Main Content */
        .admin-main { margin-left: 240px; min-height: 100vh; }
        
        .admin-header {
            height: 52px;
            background: rgba(245,245,247,0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 30;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
        }
        
        .header-title { font-size: 15px; font-weight: 600; color: #1d1d1f; }
        
        .header-actions { display: flex; align-items: center; gap: 12px; }
        
        .search-box {
            position: relative;
            width: 220px;
        }
        .search-box input {
            width: 100%;
            height: 32px;
            padding: 0 12px 0 32px;
            background: rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 8px;
            font-size: 13px;
            color: #1d1d1f;
            outline: none;
            transition: all 0.15s ease;
        }
        .search-box input:focus { background: #fff; border-color: #0071e3; box-shadow: 0 0 0 3px rgba(0,113,227,0.15); }
        .search-box input::placeholder { color: #86868b; }
        .search-box svg { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; color: #86868b; }
        
        .btn-blue {
            height: 32px;
            padding: 0 14px;
            background: #0071e3;
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: background 0.15s ease;
        }
        .btn-blue:hover { background: #0077ed; }
        .btn-blue svg { width: 14px; height: 14px; }
        
        .user-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
            border: none;
            padding: 0;
            background: none;
        }
        .user-btn img { width: 100%; height: 100%; object-fit: cover; }
        
        .admin-content { padding: 24px; max-width: 1400px; }
        
        /* Cards */
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.04);
        }
        
        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-title { font-size: 15px; font-weight: 600; color: #1d1d1f; }
        
        .card-body { padding: 20px; }
        
        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 4px 12px rgba(0,0,0,0.04);
        }
        .stat-value { font-size: 28px; font-weight: 600; color: #1d1d1f; margin-bottom: 4px; }
        .stat-label { font-size: 13px; color: #86868b; }
        
        /* Table */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 12px 16px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #86868b; border-bottom: 1px solid rgba(0,0,0,0.06); }
        td { padding: 14px 16px; font-size: 14px; color: #1d1d1f; border-bottom: 1px solid rgba(0,0,0,0.04); }
        tr:hover td { background: rgba(0,0,0,0.02); }
        
        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-green { background: #e8f5e9; color: #2e7d32; }
        .badge-orange { background: #fff3e0; color: #ef6c00; }
        .badge-blue { background: #e3f2fd; color: #1565c0; }
        .badge-gray { background: #f5f5f5; color: #616161; }
        
        /* Buttons */
        .btn {
            height: 36px;
            padding: 0 16px;
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.15s ease;
        }
        .btn-primary { background: #0071e3; color: #fff; }
        .btn-primary:hover { background: #0077ed; }
        .btn-secondary { background: #f5f5f7; color: #1d1d1f; }
        .btn-secondary:hover { background: #e8e8ed; }
        
        /* Form */
        .form-label { display: block; font-size: 13px; font-weight: 500; color: #1d1d1f; margin-bottom: 6px; }
        .form-input {
            width: 100%;
            height: 40px;
            padding: 0 12px;
            background: #f5f5f7;
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 8px;
            font-size: 14px;
            color: #1d1d1f;
            outline: none;
            transition: all 0.15s ease;
        }
        .form-input:focus { background: #fff; border-color: #0071e3; box-shadow: 0 0 0 3px rgba(0,113,227,0.15); }
        
        /* Alert */
        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: #e8f5e9; color: #2e7d32; }
        .alert-error { background: #ffebee; color: #c62828; }
        .alert svg { width: 18px; height: 18px; flex-shrink: 0; }
        
        /* Mobile */
        .mobile-menu-btn { display: none; }
        
        @media (max-width: 1024px) {
            .admin-sidebar { transform: translateX(-100%); transition: transform 0.3s ease; }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
            .mobile-menu-btn { display: flex; }
            .search-box { display: none; }
        }
        
        /* Sidebar Backdrop */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 35;
        }
        .sidebar-backdrop.open { display: block; }
    </style>
</head>
<body>
    @php
    $navItems = [
        ['section' => 'Overview', 'items' => [
            ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'home'],
        ]],
        ['section' => 'Content', 'items' => [
            ['route' => 'admin.landing-sections.index', 'label' => 'Landing Page', 'icon' => 'layout'],
            ['route' => 'dashboard.blog', 'label' => 'Blog', 'icon' => 'document'],
            ['route' => 'dashboard.pages.index', 'label' => 'Pages', 'icon' => 'page'],
            ['route' => 'dashboard.categories', 'label' => 'Categories', 'icon' => 'tag'],
        ]],
        ['section' => 'Business', 'items' => [
            ['route' => 'dashboard.offerings', 'label' => 'Products', 'icon' => 'cube'],
            ['route' => 'dashboard.services.index', 'label' => 'Services', 'icon' => 'briefcase'],
            ['route' => 'dashboard.prices', 'label' => 'Pricing', 'icon' => 'currency'],
        ]],
        ['section' => 'Organization', 'items' => [
            ['route' => 'dashboard.team', 'label' => 'Team', 'icon' => 'users'],
            ['route' => 'dashboard.careers', 'label' => 'Careers', 'icon' => 'briefcase'],
            ['route' => 'dashboard.partners', 'label' => 'Partners', 'icon' => 'handshake'],
        ]],
        ['section' => 'Settings', 'items' => [
            ['route' => 'dashboard.users', 'label' => 'Users', 'icon' => 'user'],
            ['route' => 'dashboard.domains.index', 'label' => 'Domains', 'icon' => 'globe'],
            ['route' => 'dashboard.footer.edit', 'label' => 'Footer', 'icon' => 'layout'],
            ['route' => 'dashboard.policies', 'label' => 'Policies', 'icon' => 'shield'],
        ]],
    ];
    
    $icons = [
        'home' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
        'document' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
        'page' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>',
        'tag' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>',
        'cube' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>',
        'briefcase' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
        'currency' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
        'handshake' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>',
        'user' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
        'globe' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>',
        'layout' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>',
        'shield' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
    ];
    @endphp

    <!-- Sidebar Backdrop (Mobile) -->
    <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="closeSidebar()"></div>

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-logo">
            <img src="{{ cdn_storage('images/sanaa-side-bar-logo.png') }}" alt="Sanaa">
            <span>Admin</span>
        </div>
        
        <nav class="sidebar-nav">
            @foreach($navItems as $section)
                <div class="nav-group">
                    <div class="nav-group-title">{{ $section['section'] }}</div>
                    @foreach($section['items'] as $item)
                        @if(Route::has($item['route']))
                            <a href="{{ route($item['route']) }}" class="nav-link {{ request()->routeIs($item['route']) || request()->routeIs($item['route'].'.*') ? 'active' : '' }}">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icons[$item['icon']] ?? '' !!}</svg>
                                <span>{{ $item['label'] }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </nav>
        
        <div class="sidebar-user">
            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ Auth::user()->name }}</div>
                <div class="sidebar-user-email">{{ Auth::user()->email }}</div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="admin-main">
        <header class="admin-header">
            <div style="display: flex; align-items: center; gap: 12px;">
                <button class="mobile-menu-btn" onclick="toggleSidebar()" style="background: none; border: none; padding: 8px; cursor: pointer;">
                    <svg width="20" height="20" fill="none" stroke="#1d1d1f" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                @isset($header)
                    <div class="header-title">{{ $header }}</div>
                @endisset
            </div>
            
            <div class="header-actions">
                <div class="search-box">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" placeholder="Search...">
                </div>
                
                @if(Route::has('dashboard.blog.compose'))
                <a href="{{ route('dashboard.blog.compose') }}" class="btn-blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>New Post</span>
                </a>
                @endif
                
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="user-btn">
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div style="padding: 12px 16px; border-bottom: 1px solid #f0f0f0;">
                            <div style="font-size: 14px; font-weight: 500; color: #1d1d1f;">{{ Auth::user()->name }}</div>
                            <div style="font-size: 12px; color: #86868b;">{{ Auth::user()->email }}</div>
                        </div>
                        <x-dropdown-link href="{{ route('profile.show') }}">Profile</x-dropdown-link>
                        <x-dropdown-link href="{{ route('home') }}">View Site</x-dropdown-link>
                        <div style="border-top: 1px solid #f0f0f0;"></div>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();" style="color: #ff3b30;">Sign Out</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>
        
        <main class="admin-content">
            @if(session('success'))
                <div class="alert alert-success">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <ul style="margin: 0; padding-left: 16px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    @stack('modals')
    @livewireScripts
    @stack('scripts')

    <script>
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('open');
            document.getElementById('sidebarBackdrop').classList.toggle('open');
        }
        function closeSidebar() {
            document.getElementById('adminSidebar').classList.remove('open');
            document.getElementById('sidebarBackdrop').classList.remove('open');
        }
    </script>
</body>
</html>
