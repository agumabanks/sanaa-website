@php
    $pricingPaths = [
        [
            'title' => 'Soko 24',
            'badge' => 'Commerce',
            'description' => 'Marketplace pricing is handled on Soko 24 based on what a seller or service business needs.',
            'link' => 'https://soko24.co',
            'target' => '_blank',
        ],
        [
            'title' => 'Sanaa Finance SaaS',
            'badge' => 'Finance SaaS',
            'description' => 'Pricing depends on institution size, workflow needs, and deployment scope for SACCOs and lenders.',
            'link' => route('finance.pricing'),
            'target' => null,
        ],
        [
            'title' => 'Baraka 24',
            'badge' => 'Logistics SaaS',
            'description' => 'Courier and delivery operators are priced by the operating stack they need, from dispatch to rider accounts.',
            'link' => 'https://baraka.sanaa.ug',
            'target' => '_blank',
        ],
        [
            'title' => 'Sanaa POS',
            'badge' => 'POS',
            'description' => 'Hardware and software pricing for point-of-sale is separate from the rest of the stack.',
            'link' => route('prices'),
            'target' => null,
        ],
    ];
@endphp

<section id="pricing" class="pricing-premium py-24">
    <div class="relative max-w-6xl mx-auto px-4">
        <div class="section-header text-center mb-10">
            <div class="section-eyebrow mb-2">Product Paths</div>
            <h2 class="section-title visible">Find the Right Sanaa Product</h2>
            <p class="text-gray-400 mt-4 max-w-2xl mx-auto">Each product has its own pricing. Start with the product that matches how your business operates.</p>
        </div>

        <div class="pricing-wrap selector-grid">
            @foreach($pricingPaths as $path)
                <article class="pricing-card selector-card">
                    <span class="badge">{{ $path['badge'] }}</span>
                    <h3>{{ $path['title'] }}</h3>
                    <p>{{ $path['description'] }}</p>
                    <a href="{{ $path['link'] }}" class="btn-ghost" @if($path['target']) target="{{ $path['target'] }}" rel="noopener noreferrer" @endif>View pricing</a>
                </article>
            @endforeach
        </div>
    </div>
</section>
