@props(['theme' => 'dark', 'transparent' => false])

{{-- Skip to Content Link (Accessibility) --}}
<a href="#main-content" class="fixed -top-full left-1/2 -translate-x-1/2 z-[200] bg-emerald-500 text-white px-6 py-3 rounded-full font-semibold focus:top-4 transition-all duration-300">
    Skip to main content
</a>

<header
    x-data="{
        mobileMenuOpen: false,
        isScrolled: false,
        searchOpen: false,
        activeDropdown: null,
        dropdownTimeout: null,

        init() {
            this.isScrolled = window.scrollY > 20;
            window.addEventListener('scroll', () => {
                this.isScrolled = window.scrollY > 20;
            });
            this.loadIcons();
            this.$watch('mobileMenuOpen', () => setTimeout(() => this.loadIcons(), 50));
            this.$watch('searchOpen', () => setTimeout(() => this.loadIcons(), 50));
            this.$watch('mobileMenuOpen', value => {
                document.body.classList.toggle('overflow-hidden', value);
            });
        },

        loadIcons() {
            if (window.lucide) {
                window.lucide.createIcons();
            } else {
                setTimeout(() => this.loadIcons(), 100);
            }
        },

        openDropdown(id) {
            clearTimeout(this.dropdownTimeout);
            this.activeDropdown = id;
        },

        closeDropdown() {
            this.activeDropdown = null;
        },

        scheduleClose() {
            this.dropdownTimeout = setTimeout(() => this.closeDropdown(), 200);
        }
    }"
    @keydown.escape.window="mobileMenuOpen = false; searchOpen = false; activeDropdown = null"
    class="fixed top-0 left-0 right-0 z-[100] transition-all duration-500 ease-out"
    :class="isScrolled ? 'py-3' : 'py-5'"
    role="banner"
>
    <!-- Background Layer -->
    <div
        class="absolute inset-0 transition-all duration-500"
        :class="isScrolled
            ? 'bg-black/90 backdrop-blur-2xl border-b border-white/[0.08] shadow-[0_4px_30px_rgba(0,0,0,0.3)]'
            : '{{ $transparent ? 'bg-transparent' : 'bg-black/60 backdrop-blur-xl' }}'"
    ></div>

    <!-- Navigation Content -->
    <div class="relative max-w-[1400px] mx-auto px-6 lg:px-8">
        <nav class="flex items-center justify-between h-14" role="navigation" aria-label="Main navigation">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="relative z-10 flex items-center group" aria-label="Sanaa Home">
                <img
                    src="{{ asset('storage/images/sanaa-logo-b.svg') }}"
                    alt="Sanaa"
                    class="h-8 w-auto brightness-0 invert transition-all duration-300 group-hover:scale-105"
                >
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-1">
                @foreach($mainMenu as $menuItem)
                    @if(!in_array(strtolower($menuItem->label), ['developers', 'home']))
                        @php
                            $hasChildren = $menuItem->children->isNotEmpty();
                            $isActive = $menuItem->route_name ? isActiveRoute($menuItem->route_name) : isActiveUrl($menuItem->url ?? '');
                        @endphp

                        @if($hasChildren)
                            <!-- Dropdown Item -->
                            <div
                                class="relative"
                                @mouseenter="openDropdown('{{ $menuItem->id }}')"
                                @mouseleave="scheduleClose()"
                            >
                                <button
                                    class="relative flex items-center gap-1.5 px-4 py-2 text-[15px] font-medium transition-colors duration-200 rounded-lg group"
                                    :class="activeDropdown === '{{ $menuItem->id }}' ? 'text-white' : 'text-gray-300 hover:text-white'"
                                    @click="activeDropdown = activeDropdown === '{{ $menuItem->id }}' ? null : '{{ $menuItem->id }}'"
                                    aria-haspopup="true"
                                    :aria-expanded="activeDropdown === '{{ $menuItem->id }}'"
                                >
                                    <span>{{ $menuItem->label }}</span>
                                    <svg
                                        class="w-3.5 h-3.5 transition-transform duration-300"
                                        :class="activeDropdown === '{{ $menuItem->id }}' ? 'rotate-180' : ''"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>

                                    <!-- Hover pill background -->
                                    <span class="absolute inset-0 rounded-lg bg-white/[0.08] opacity-0 group-hover:opacity-100 transition-opacity duration-200"></span>
                                </button>

                                <!-- Mega Menu Dropdown -->
                                <div
                                    x-show="activeDropdown === '{{ $menuItem->id }}'"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 -translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 -translate-y-2"
                                    @mouseenter="openDropdown('{{ $menuItem->id }}')"
                                    @mouseleave="scheduleClose()"
                                    class="absolute top-full left-1/2 -translate-x-1/2 pt-4 z-50"
                                    x-cloak
                                >
                                    <div class="bg-[#0a0a0a] border border-white/[0.08] rounded-2xl shadow-2xl shadow-black/50 overflow-hidden min-w-[520px]">
                                        <div class="grid grid-cols-12">
                                            <!-- Menu Items -->
                                            <div class="col-span-7 p-6">
                                                <div class="grid gap-1">
                                                    @foreach($menuItem->children as $child)
                                                        <a
                                                            href="{{ $child->resolved_url }}"
                                                            class="flex items-start gap-4 p-3 rounded-xl transition-all duration-200 hover:bg-white/[0.05] group/item no-underline hover:no-underline"
                                                        >
                                                            <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-white/[0.05] flex items-center justify-center text-gray-400 group-hover/item:bg-emerald-500/20 group-hover/item:text-emerald-400 transition-all duration-200">
                                                                @if($child->icon)
                                                                    <i data-lucide="{{ $child->icon }}" class="w-5 h-5"></i>
                                                                @else
                                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                                                @endif
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <div class="flex items-center gap-2">
                                                                    <span class="text-[14px] font-semibold text-white group-hover/item:text-emerald-400 transition-colors">{{ $child->label }}</span>
                                                                    @if($child->badge)
                                                                        <span class="px-1.5 py-0.5 text-[10px] font-bold uppercase tracking-wide rounded bg-emerald-500/20 text-emerald-400">{{ $child->badge }}</span>
                                                                    @endif
                                                                </div>
                                                                @if($child->description)
                                                                    <p class="text-[13px] text-gray-500 mt-0.5 leading-relaxed">{{ $child->description }}</p>
                                                                @endif
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Featured Section -->
                                            <div class="col-span-5 bg-gradient-to-br from-emerald-500/10 to-transparent border-l border-white/[0.05] p-6 flex flex-col justify-end relative overflow-hidden">
                                                <div class="absolute inset-0 opacity-30">
                                                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/30 rounded-full blur-3xl"></div>
                                                </div>
                                                <div class="relative">
                                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-400 bg-emerald-500/10 rounded-full mb-3">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                                        Featured
                                                    </span>
                                                    <h4 class="text-white font-semibold mb-2">Built in Uganda</h4>
                                                    <p class="text-gray-400 text-sm mb-4 leading-relaxed">Read the structure behind Sanaa, the cooperative base, and the long-term build plan.</p>
                                                    <a href="{{ route('investor-relations') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-400 hover:text-emerald-300 transition-colors group/link">
                                                        Read more
                                                        <svg class="w-4 h-4 transition-transform group-hover/link:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Simple Link -->
                            <a
                                href="{{ $menuItem->resolved_url }}"
                                class="relative px-4 py-2 text-[15px] font-medium transition-colors duration-200 rounded-lg group {{ $isActive ? 'text-white' : 'text-gray-300 hover:text-white' }}"
                                @if($menuItem->is_external) target="_blank" rel="noopener noreferrer" @endif
                            >
                                <span class="relative z-10">{{ $menuItem->label }}</span>
                                @if($menuItem->is_external)
                                    <svg class="inline-block w-3 h-3 ml-1 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                @endif
                                <span class="absolute inset-0 rounded-lg bg-white/[0.08] opacity-0 group-hover:opacity-100 transition-opacity duration-200"></span>
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>

            <!-- Right Actions -->
            <div class="hidden lg:flex items-center gap-2">
                <!-- Language Selector -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button
                        class="flex items-center gap-1.5 px-3 py-2 text-gray-400 hover:text-white rounded-lg hover:bg-white/[0.05] transition-all duration-200"
                        @click="open = !open"
                    >
                        @php $currentLocale = session('locale', config('app.locale', 'en')); @endphp
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                        <span class="text-[13px] font-medium uppercase">{{ $currentLocale }}</span>
                        <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute top-full right-0 mt-2 w-40 bg-[#0a0a0a] border border-white/[0.08] rounded-xl shadow-xl overflow-hidden py-1"
                        x-cloak
                    >
                        @php $currentLocale = session('locale', config('app.locale', 'en')); @endphp
                        <a href="{{ route('locale.set', 'en') }}" class="flex items-center gap-3 px-4 py-2.5 text-[13px] {{ $currentLocale === 'en' ? 'text-emerald-400 bg-white/[0.03]' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }} transition-colors">
                            <span>🇺🇸</span> English
                        </a>
                        <a href="{{ route('locale.set', 'fr') }}" class="flex items-center gap-3 px-4 py-2.5 text-[13px] {{ $currentLocale === 'fr' ? 'text-emerald-400 bg-white/[0.03]' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }} transition-colors">
                            <span>🇫🇷</span> French
                        </a>
                        <a href="{{ route('locale.set', 'sw') }}" class="flex items-center gap-3 px-4 py-2.5 text-[13px] {{ $currentLocale === 'sw' ? 'text-emerald-400 bg-white/[0.03]' : 'text-gray-400 hover:text-white hover:bg-white/[0.03]' }} transition-colors">
                            <span>🇺🇬</span> Swahili
                        </a>
                    </div>
                </div>

                <!-- Search Button -->
                <button
                    @click="searchOpen = true"
                    class="flex items-center justify-center w-10 h-10 text-gray-400 hover:text-white rounded-lg hover:bg-white/[0.05] transition-all duration-200"
                    aria-label="Search"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                    </svg>
                </button>

                <!-- Divider -->
                <div class="w-px h-6 bg-white/[0.1] mx-2"></div>

                <!-- Sign In -->
                <a
                    href="{{ route('login') }}"
                    class="px-4 py-2 text-[14px] font-semibold text-white hover:text-gray-200 transition-colors"
                >
                    Sign in
                </a>

                <!-- Contact Sales CTA -->
                <a
                    href="{{ route('contact') }}"
                    class="px-5 py-2.5 text-[14px] font-semibold text-black bg-emerald-400 rounded-full hover:bg-emerald-300 transition-all duration-200 shadow-[0_0_20px_rgba(52,211,153,0.25)] hover:shadow-[0_0_30px_rgba(52,211,153,0.4)] hover:scale-[1.02]"
                >
                    Contact Sales
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <button
                class="lg:hidden relative z-50 flex flex-col justify-center items-center w-10 h-10 rounded-lg"
                @click="mobileMenuOpen = !mobileMenuOpen"
                :aria-expanded="mobileMenuOpen"
                aria-label="Toggle menu"
            >
                <span class="w-5 h-0.5 bg-white rounded-full transition-all duration-300" :class="mobileMenuOpen ? 'rotate-45 translate-y-1' : ''"></span>
                <span class="w-5 h-0.5 bg-white rounded-full transition-all duration-300 my-1" :class="mobileMenuOpen ? 'opacity-0 scale-0' : ''"></span>
                <span class="w-5 h-0.5 bg-white rounded-full transition-all duration-300" :class="mobileMenuOpen ? '-rotate-45 -translate-y-1' : ''"></span>
            </button>
        </nav>
    </div>

    <!-- Mobile Menu -->
    <div
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="lg:hidden fixed inset-0 z-40 bg-black/98 backdrop-blur-xl"
        x-cloak
    >
        <div class="h-full overflow-y-auto pt-24 pb-8 px-6">
            <nav class="space-y-2">
                @foreach($mobileMenu as $item)
                    @php
                        $hasChildren = $item->children->isNotEmpty();
                        $isActive = $item->route_name ? isActiveRoute($item->route_name) : isActiveUrl($item->url ?? '');
                    @endphp

                    <div x-data="{ expanded: false }">
                        <div class="flex items-center justify-between">
                            <a
                                href="{{ $item->resolved_url }}"
                                class="flex-1 py-3 text-2xl font-semibold {{ $isActive ? 'text-emerald-400' : 'text-white' }}"
                            >
                                {{ $item->label }}
                            </a>
                            @if($hasChildren)
                                <button
                                    @click="expanded = !expanded"
                                    class="p-3 text-gray-400"
                                    :aria-expanded="expanded"
                                >
                                    <svg class="w-5 h-5 transition-transform duration-300" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                            @endif
                        </div>

                        @if($hasChildren)
                            <div x-show="expanded" x-collapse class="pl-4 pb-2 space-y-1 border-l border-white/10">
                                @foreach($item->children as $child)
                                    <a href="{{ $child->resolved_url }}" class="block py-2 text-gray-400 hover:text-emerald-400 transition-colors">
                                        {{ $child->label }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </nav>

            <div class="mt-8 pt-8 border-t border-white/10 space-y-3">
                <a href="{{ route('login') }}" class="block w-full py-4 text-center text-white border border-white/20 rounded-xl font-semibold hover:bg-white/5 transition-colors">
                    Sign in
                </a>
                <a href="{{ route('contact') }}" class="block w-full py-4 text-center text-black bg-emerald-400 rounded-xl font-semibold hover:bg-emerald-300 transition-colors">
                    Contact Sales
                </a>
            </div>
        </div>
    </div>

    <!-- Search Modal -->
    <div
        x-show="searchOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[150] flex items-start justify-center pt-[15vh] px-4"
        @keydown.escape.window="searchOpen = false"
        x-cloak
    >
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" @click="searchOpen = false"></div>
        <div
            x-show="searchOpen"
            x-transition:enter="transition ease-out duration-200 delay-75"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            class="relative w-full max-w-2xl bg-[#0a0a0a] border border-white/[0.08] rounded-2xl shadow-2xl overflow-hidden"
            @click.stop
        >
            <div class="flex items-center gap-3 px-5 border-b border-white/[0.05]">
                <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input
                    type="text"
                    placeholder="Search documentation, products, or help..."
                    class="flex-1 h-14 bg-transparent border-0 text-white placeholder-gray-500 text-base focus:outline-none focus:ring-0"
                    autofocus
                >
                <kbd class="px-2 py-1 text-[11px] font-medium text-gray-500 bg-white/[0.05] border border-white/[0.1] rounded">ESC</kbd>
            </div>
            <div class="p-4">
                <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-3">Quick Links</p>
                <div class="grid grid-cols-2 gap-2">
                    <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/[0.03] transition-colors">
                        <i data-lucide="book-open" class="w-4 h-4"></i>
                        <span class="text-sm">Documentation</span>
                    </a>
                    <a href="{{ route('prices') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/[0.03] transition-colors">
                        <i data-lucide="credit-card" class="w-4 h-4"></i>
                        <span class="text-sm">Pricing</span>
                    </a>
                    <a href="{{ route('contact') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/[0.03] transition-colors">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span class="text-sm">Contact</span>
                    </a>
                    <a href="{{ route('blog.index') }}" class="flex items-center gap-3 p-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/[0.03] transition-colors">
                        <i data-lucide="newspaper" class="w-4 h-4"></i>
                        <span class="text-sm">Blog</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
