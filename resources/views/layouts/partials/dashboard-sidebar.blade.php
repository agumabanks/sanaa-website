@php($mobile = $mobile ?? false)

<div class="{{ $mobile ? 'h-14 px-3 mb-2' : 'h-16 px-6 border-b border-white/10 flex-shrink-0' }} flex items-center">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-white/90 hover:text-white transition-colors">
        <img src="{{ cdn_storage('images/sanaa-side-bar-logo.png') }}" alt="{{ config('app.name', 'Sanaa Admin') }}" class="h-8 w-auto" />
        <span class="sr-only">{{ config('app.name', 'Sanaa Admin') }}</span>
    </a>
    @if($mobile)
        <button id="mobile-menu-close" class="ml-auto inline-flex items-center justify-center rounded-md p-2 text-gray-300 hover:bg-white/5" aria-label="Close menu">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    @endif
</div>

<nav class="{{ $mobile ? 'space-y-1' : 'flex-1 p-3 space-y-1' }}">
    {!! $navItem('dashboard', 'Dashboard', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z'/></svg>", true) !!}

    @if(Auth::check() && Auth::user()->isAdmin())
        <div class="px-3 pt-3 pb-1 text-[11px] uppercase tracking-wider text-white/50">Management</div>
        {!! $navItem('dashboard.blog', 'Blog', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M4 4h16v2H4V4zm0 4h10v2H4V8zm0 4h16v2H4v-2zm0 4h10v2H4v-2z'/></svg>") !!}

        @if(Route::has('dashboard.blog'))
            <div class="pl-9 pr-3 space-y-1">
                <a href="{{ route('dashboard.blog') }}" class="block text-xs text-white/60 hover:text-white">All Posts</a>
                <a href="{{ Route::has('dashboard.blog.compose') ? route('dashboard.blog.compose') : route('dashboard.blog') }}#create-post" class="block text-xs text-white/60 hover:text-white">New Post</a>
            </div>
        @endif

        {!! $navItem('dashboard.categories', 'Categories', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 5h8v8H3V5zm10 0h8v8h-8V5zM3 15h8v4H3v-4zm10 0h8v4h-8v-4z'/></svg>") !!}
        <div class="px-3 pt-3 pb-1 text-[11px] uppercase tracking-wider text-white/50">Site</div>
        {!! $navItem('dashboard.pages.index', 'Pages', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M6 2h9l5 5v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm8 7V3.5L19.5 9H14z'/></svg>") !!}
        {!! $navItem('dashboard.footer.edit', 'Footer', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 4h18v2H3V4zm0 4h18v2H3V8zm0 8h18v2H3v-2zm0 4h12v2H3v-2z'/></svg>") !!}
        {!! $navItem('dashboard.domains.index', 'Domains', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M12 2a10 10 0 100 20 10 10 0 000-20zm0 2c1.85 0 3.55.63 4.9 1.69L5.69 17.9A8 8 0 0112 4zm0 16a8 8 0 004.9-1.69L6.69 8.1A8 8 0 0012 20z'/></svg>") !!}
        {!! $navItem('dashboard.team', 'Team', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0c-.34 0-.67.02-.99.05 1.72.45 2.99 1.26 3.68 2.45H23v-1c0-2.33-4.67-3.5-7-3.5z'/></svg>") !!}
        {!! $navItem('dashboard.careers', 'Careers', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M20 6h-4V4H8v2H4v2h16V6zm-1 4H5l-1 10h18L19 10zM9 6h6v2H9V6z'/></svg>") !!}
        {!! $navItem('dashboard.partners', 'Partners', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h10v-2.5c0-1.1.9-2 2-2h2.03C15.45 13.4 11.33 13 8 13zm8 0c-.34 0-.67.02-.99.05 1.72.45 2.99 1.26 3.68 2.45H23v-1c0-2.33-4.67-3.5-7-3.5z'/></svg>") !!}
        {!! $navItem('dashboard.users', 'Users', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/></svg>") !!}
        {!! $navItem('dashboard.offerings', 'Offerings', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 13h8V3H3v10zm10 8h8v-6h-8v6zm0-18v6h8V3h-8zM3 21h8v-6H3v6z'/></svg>") !!}
        {!! $navItem('dashboard.developer-platforms', 'Developers', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M8 5l-6 7 6 7v-4h8v4l6-7-6-7v4H8V5z'/></svg>") !!}
        {!! $navItem('dashboard.hardware-rentals', 'Hardware Rentals', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M20 8h-3V4H7v4H4l-2 3v9h2v-2h16v2h2v-9l-2-3zM9 6h6v2H9V6zm11 10H4v-5h16v5z'/></svg>") !!}
        {!! $navItem('dashboard.prices', 'Prices', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 2.18L18.56 6 12 8.82 5.44 6 12 3.18zM5 8.1l7 2.8 7-2.8V11c0 4.09-2.63 7.89-7 9-4.37-1.11-7-4.91-7-9V8.1z'/></svg>") !!}
        {!! $navItem('dashboard.services', 'Services', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'/></svg>") !!}
        {!! $navItem('dashboard.policies', 'Policies', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M6 2h9l5 5v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm8 7V3.5L19.5 9H14z'/></svg>") !!}

        <div class="px-3 pt-3 pb-1 text-[11px] uppercase tracking-wider text-white/50">Finance</div>
        {!! $navItem('admin.finance.index', 'Finance', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 3h18v2H3V3zm4 6h14v2H7V9zM3 15h18v2H3v-2zm4 6h14v2H7v-2z'/></svg>") !!}
        @if(Route::has('admin.finance.index'))
            <div class="pl-9 pr-3 space-y-1">
                <a href="{{ route('admin.finance.pricing-plans.index') }}" class="block text-xs text-white/60 hover:text-white">Pricing Plans</a>
                <a href="{{ route('admin.finance.cards.index') }}" class="block text-xs text-white/60 hover:text-white">Cards</a>
                <a href="{{ route('admin.finance.technologies.index') }}" class="block text-xs text-white/60 hover:text-white">Technologies</a>
                <a href="{{ route('admin.finance.team-members.index') }}" class="block text-xs text-white/60 hover:text-white">Team</a>
                <a href="{{ route('admin.finance.communities.index') }}" class="block text-xs text-white/60 hover:text-white">Communities</a>
                <a href="{{ route('admin.finance.compliance-items.index') }}" class="block text-xs text-white/60 hover:text-white">Compliance</a>
                <a href="{{ route('admin.finance.pages.index') }}" class="block text-xs text-white/60 hover:text-white">Pages</a>
                <a href="{{ route('admin.finance.analytics') }}" class="block text-xs text-white/60 hover:text-white">Analytics</a>
            </div>
        @endif
    @else
        <div class="px-3 pt-3 pb-1 text-[11px] uppercase tracking-wider text-white/50">Stories</div>
        {!! $navItem('dashboard.write', 'Write', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 0 0 0-1.42l-2.34-2.34a1.003 1.003 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z'/></svg>") !!}
        {!! $navItem('dashboard.my-posts', 'My Posts', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 6h18v2H3V6zm0 5h12v2H3v-2zm0 5h18v2H3v-2z'/></svg>") !!}
        {!! $navItem('dashboard.stats', 'My Stats', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 17h2v-7H3v7zm4 0h2V7H7v10zm4 0h2v-4h-2v4zm4 0h2V4h-2v13z'/></svg>") !!}
        {!! $navItem('dashboard.library', 'Library', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M6 4h12v2H6V4zm0 4h12v12H6V8zm2 2v8h8v-8H8z'/></svg>") !!}
        {!! $navItem('blog.index', 'Stories', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M18 2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2V4a2 2 0 00-2-2z'/></svg>") !!}
        {!! $navItem('dashboard.suggestions', 'Suggestions', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M9 21h6v-2H9v2zm3-20C7.48 1 4 4.48 4 9c0 3.07 1.64 5.64 4.06 7.11L8 19h8l-.06-2.89C18.36 14.64 20 12.07 20 9c0-4.52-3.48-8-8-8z'/></svg>") !!}
        {!! $navItem('dashboard.followers', 'Followers', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zM16 13c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5z'/></svg>") !!}
        {!! $navItem('dashboard.notifications', 'Notifications', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M12 22c1.1 0 2-.9 2-2h-4a2 2 0 002 2zm6-6V9a6 6 0 10-12 0v7L4 18v2h16v-2l-2-2z'/></svg>") !!}
        {!! $navItem('dashboard.search', 'Search', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M10 18a8 8 0 115.293-2.707l4.707 4.707-1.414 1.414-4.707-4.707A7.963 7.963 0 0110 18zm0-2a6 6 0 100-12 6 6 0 000 12z'/></svg>") !!}
        {!! $navItem('dashboard.purchases', 'My Purchases', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M7 4V2C7 1.45 7.45 1 8 1s1 .45 1 1v2h4V2c0-.55.45-1 1-1s1 .45 1 1v2h2c1.1 0 2 .9 2 2v14c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2h2zM5 6v14h14V6H5zm4 8h6c.55 0 1-.45 1-1s-.45-1-1-1H9c-.55 0-1 .45-1 1s.45 1 1 1z'/></svg>") !!}
        {!! $navItem('dashboard.products', 'My Products', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 13h8V3H3v10zm10 8h8v-6h-8v6zm0-18v6h8V3h-8zM3 21h8v-6H3v6z'/></svg>") !!}
        {!! $navItem('dashboard.wallet', 'Sanaa Wallet', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M21 7h-2V5c0-.55-.45-1-1-1H6c-.55 0-1 .45-1 1v2H3c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zM6 5h12v2H6V5zm15 14H3V9h18v10zM7 11h2v2H7v-2zm4 0h2v2h-2v-2zm4 0h2v2h-2v-2z'/></svg>") !!}

        @if($isFinance && Route::has('admin.finance.index'))
            <div class="px-3 pt-3 pb-1 text-[11px] uppercase tracking-wider text-white/50">Finance</div>
            {!! $navItem('admin.finance.index', 'Finance', "<svg class='w-4 h-4' viewBox='0 0 24 24' fill='currentColor'><path d='M3 3h18v2H3V3zm4 6h14v2H7V9zM3 15h18v2H3v-2zm4 6h14v2H7v-2z'/></svg>") !!}
        @endif
    @endif
</nav>

@if(Auth::check() && Auth::user()->isAdmin() && Route::has('dashboard.blog'))
    <div class="p-3 border-t border-white/10 mt-3">
        <a href="{{ Route::has('dashboard.blog.compose') ? route('dashboard.blog.compose') : route('dashboard.blog') }}#create-post" class="inline-flex items-center justify-center w-full gap-2 rounded-lg bg-white hover:bg-gray-200 text-black text-sm font-medium py-2 transition-colors">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13H13v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
            New Post
        </a>
    </div>
@endif
