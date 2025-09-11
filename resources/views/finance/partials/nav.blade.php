<nav class="hidden md:flex items-center gap-6" aria-label="Finance primary">
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
    @foreach($items as $item)
        <a class="text-sm text-gray-700 hover:text-gray-900 focus-visible:focus" href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
    @endforeach
</nav>

