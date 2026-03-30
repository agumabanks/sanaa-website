@php
    $items = [
        ['route' => 'finance.overview', 'label' => 'Overview'],
        ['route' => 'finance.solutions', 'label' => 'Solutions'],
        ['route' => 'finance.pricing', 'label' => 'Pricing'],
        ['route' => 'finance.cards', 'label' => 'Cards'],
        ['route' => 'finance.team', 'label' => 'Team'],
        ['route' => 'finance.compliance', 'label' => 'Compliance'],
        ['route' => 'finance.resources', 'label' => 'Resources'],
        ['route' => 'finance.news-insights', 'label' => 'News & Insights'],
        ['route' => 'finance.contact-sales', 'label' => 'Contact Sales'],
    ];
@endphp

{{-- Desktop Navigation --}}
<nav class="hidden md:flex items-center gap-6" aria-label="Finance primary">
    @foreach($items as $item)
        <a class="text-sm text-white/80 hover:text-white transition-colors duration-200" href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
    @endforeach
</nav>

{{-- Mobile Menu Toggle --}}
<button
    id="finance-mobile-toggle"
    class="md:hidden flex flex-col justify-center items-center w-10 h-10 gap-1.5 focus:outline-none"
    aria-label="Toggle menu"
    aria-expanded="false"
    onclick="document.getElementById('finance-mobile-menu').classList.toggle('hidden'); this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');"
>
    <span class="block w-6 h-0.5 bg-white rounded-full transition-transform"></span>
    <span class="block w-6 h-0.5 bg-white rounded-full transition-opacity"></span>
    <span class="block w-6 h-0.5 bg-white rounded-full transition-transform"></span>
</button>

{{-- Mobile Menu Panel --}}
<nav id="finance-mobile-menu" class="hidden md:hidden absolute top-full left-0 right-0 bg-gray-900 border-t border-white/10 shadow-2xl z-50" aria-label="Finance mobile">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col gap-1">
        @foreach($items as $item)
            <a class="block px-4 py-3 text-sm text-white/80 hover:text-white hover:bg-white/10 rounded-lg transition-colors duration-200" href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
        @endforeach
    </div>
</nav>
