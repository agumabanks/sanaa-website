@php
    $products = [
        [
            'title' => 'Sanaa Finance Cooperative',
            'badge' => 'Finance | Cooperative',
            'description' => 'Member-owned financial institution for businesses that work with Sanaa. Cash loans and motorbike asset financing are already running, with BNPL for Soko 24 members on the way.',
            'link' => '#cooperative',
            'target' => null,
        ],
        [
            'title' => 'Sanaa Finance SaaS',
            'badge' => 'SaaS | Finance',
            'description' => 'SaaS financial management platform for SACCOs, MFIs, and money lenders. Loan tracking, member management, repayment schedules, and reporting — built for African financial institutions. If you run a SACCO or lending institution, this is your operating system.',
            'link' => route('finance.index'),
            'target' => null,
        ],
        [
            'title' => 'Soko 24',
            'badge' => 'Commerce',
            'description' => 'East African marketplace and services platform with path-based multi-tenant routing. Sellers list stock and services in one place, with cooperative-linked trade flows coming next.',
            'link' => 'https://soko24.co',
            'target' => '_blank',
        ],
        [
            'title' => 'Sanaa Media',
            'badge' => 'Print | Branding',
            'description' => 'Print and branding services from Nasser Road, Kampala. Business cards, rubber stamps, banners, branded merchandise, and marketing materials — produced and delivered. Also the anchor shop on Soko 24.',
            'link' => 'https://soko24.co',
            'target' => '_blank',
        ],
        [
            'title' => 'Baraka 24',
            'badge' => 'SaaS | Logistics',
            'description' => 'A complete logistics operating system for courier and delivery companies. POS terminal, shipment tracking, dispatch management, rider cash accounts, COD reconciliation, and automated WhatsApp and SMS alerts — all on your own branded subdomain. Currently powering logistics operations in Uganda and DRC.',
            'link' => 'https://baraka.sanaa.ug',
            'target' => '_blank',
        ],
        [
            'title' => 'Sanaa POS',
            'badge' => 'Infrastructure | POS',
            'description' => 'Point-of-sale hardware and software for businesses that need checkout, stock movement, and sales visibility on the same stack that powers the rest of Sanaa.',
            'link' => route('prices'),
            'target' => null,
        ],
        [
            'title' => 'Sanaa Cards',
            'badge' => 'Infrastructure | Payments',
            'description' => 'Corporate payment cards for businesses that need tighter spending control, better tracking, and a direct connection to the wider Sanaa rails.',
            'link' => route('sanaa-cards.index'),
            'target' => null,
        ],
        [
            'title' => 'Sanaa Cloud',
            'badge' => 'Infrastructure',
            'description' => 'Managed cloud hosting and storage for businesses on Soko 24 and Baraka 24. Buy more space, more compute, more capacity — without managing servers. Sanaa handles the infrastructure so you focus on the business.',
            'link' => route('sanaa-cloud'),
            'target' => null,
        ],
        [
            'title' => 'Sanaa API',
            'badge' => 'Developer Access',
            'description' => 'Developer access to Soko 24 commerce, Sanaa Finance, and Baraka 24 logistics data. Documentation is in progress. Contact us for early access.',
            'link' => route('contact'),
            'target' => null,
        ],
    ];
@endphp

<section id="products" class="services-premium">
    <div class="section-header">
        <div class="section-eyebrow mb-3">Products</div>
        <h2 class="section-title reveal-element">The Sanaa Stack</h2>
        <p class="section-subtitle reveal-element" style="color: var(--light-gray); margin-top: 1rem; max-width: 760px; margin-left: auto; margin-right: auto;">Finance comes first. Commerce, logistics, and infrastructure sit on top of it.</p>
    </div>

    <div class="services-grid">
        @foreach($products as $index => $product)
            <article class="service-card" style="--delay: {{ $index + 1 }}">
                <div class="service-card-head">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                    </div>
                    <span class="service-badge">{{ $product['badge'] }}</span>
                </div>

                <h3 class="service-title">{{ $product['title'] }}</h3>
                <p class="service-description">{{ $product['description'] }}</p>

                <div class="service-actions">
                    <a href="{{ $product['link'] }}" class="service-link" @if($product['target']) target="{{ $product['target'] }}" rel="noopener noreferrer" @endif>Open →</a>
                </div>
            </article>
        @endforeach
    </div>
</section>
