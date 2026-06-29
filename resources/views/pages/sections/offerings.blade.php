@php
    $products = [
        [
            'title'       => 'Sanaa Finance Cooperative',
            'badge'       => 'Finance — Cooperative',
            'description' => 'Member-owned financial institution for businesses inside the Sanaa network.',
            'link'        => '#cooperative',
            'target'      => null,
        ],
        [
            'title'       => 'Sanaa Finance SaaS',
            'badge'       => 'SaaS — Finance',
            'description' => 'Financial management platform for SACCOs, MFIs, and money lenders in Uganda.',
            'link'        => route('finance.index'),
            'target'      => null,
        ],
        [
            'title'       => 'Soko 24',
            'badge'       => 'Commerce',
            'description' => 'Online marketplace for Ugandan sellers to reach buyers across East Africa.',
            'link'        => 'https://soko24.co',
            'target'      => '_blank',
        ],
        [
            'title'       => 'Sanaa Media',
            'badge'       => 'Print — Branding',
            'description' => 'Print and branding services from Nasser Road, Kampala. Produced and delivered.',
            'link'        => 'https://soko24.co',
            'target'      => '_blank',
        ],
        [
            'title'       => 'Baraka 24',
            'badge'       => 'SaaS — Logistics',
            'description' => 'Logistics management platform for courier and delivery companies in Uganda, DRC, and South Africa. Expanding to Ethiopia.',
            'link'        => 'https://baraka.sanaa.ug',
            'target'      => '_blank',
        ],
        [
            'title'       => 'Sanaa POS',
            'badge'       => 'Infrastructure — POS',
            'description' => 'Point-of-sale hardware and software for checkout, stock, and sales visibility.',
            'link'        => route('prices'),
            'target'      => null,
        ],
        [
            'title'       => 'Sanaa Cards',
            'badge'       => 'Infrastructure — Payments',
            'description' => 'Corporate payment cards for businesses with spending control and tracking.',
            'link'        => 'https://cards.sanaa.ug/',
            'target'      => '_blank',
        ],
        [
            'title'       => 'Sanaa Cloud',
            'badge'       => 'Infrastructure',
            'description' => 'Managed cloud hosting and storage for businesses on Sanaa platforms.',
            'link'        => route('sanaa-cloud'),
            'target'      => null,
        ],
        [
            'title'       => 'Sanaa API',
            'badge'       => 'Developer Access',
            'description' => 'Public developer documentation for the Sanaa Blog Syndication API.',
            'link'        => route('developer-platforms'),
            'target'      => null,
        ],
    ];
@endphp

<section id="products" class="sn-section sn-products" aria-labelledby="products-heading">
    <style>
        .sn-products {
            background: var(--paper);
            border-top: 1px solid var(--stone-200);
        }

        .sn-products__header {
            max-width: 54ch;
            margin-bottom: 3rem;
        }

        .sn-products__subtext {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--stone-500);
            margin-top: 0.75rem;
        }

        .sn-products__grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
        }

        .sn-product-card {
            background: #ffffff;
            border: 1px solid var(--stone-200);
            border-radius: 18px;
            box-shadow: var(--shadow-1);
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.15s ease;
        }

        .sn-product-card:hover {
            box-shadow: var(--shadow-2);
        }

        .sn-product-card--placeholder {
            opacity: 0.48;
        }

        .sn-product-card__badge {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--emerald-600);
            margin-bottom: 0.9rem;
        }

        .sn-product-card__title {
            font-family: var(--font-sans);
            font-size: 1rem;
            font-weight: 600;
            color: var(--ink);
            line-height: 1.3;
            margin-bottom: 0.65rem;
        }

        .sn-product-card__body {
            font-size: 0.9rem;
            line-height: 1.65;
            color: var(--stone-500);
            flex: 1;
            margin-bottom: 1.25rem;
        }

        .sn-product-card__link {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--ink);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: color 0.15s ease;
            margin-top: auto;
        }

        .sn-product-card__link:hover {
            color: var(--emerald-600);
        }

        .sn-product-card--placeholder .sn-product-card__title {
            color: var(--stone-400);
        }

        @media (max-width: 1100px) {
            .sn-products__grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 760px) {
            .sn-products__grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .sn-products__grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="sn-container">
        <div class="sn-products__header">
            <p class="sn-eyebrow sn-eyebrow--emerald">Products</p>
            <h2 class="sn-h2" id="products-heading">What we run.</h2>
            <p class="sn-products__subtext">Finance comes first. Commerce, logistics, and infrastructure sit on top.</p>
        </div>

        <div class="sn-products__grid">
            @foreach($products as $product)
                <article class="sn-product-card">
                    <div class="sn-product-card__badge">{{ $product['badge'] }}</div>
                    <h3 class="sn-product-card__title">{{ $product['title'] }}</h3>
                    <p class="sn-product-card__body">{{ $product['description'] }}</p>
                    <a href="{{ $product['link'] }}"
                       class="sn-product-card__link"
                       @if($product['target']) target="{{ $product['target'] }}" rel="noopener noreferrer" @endif>
                        Open &rarr;
                    </a>
                </article>
            @endforeach

            <article class="sn-product-card sn-product-card--placeholder" aria-hidden="true">
                <div class="sn-product-card__badge">&nbsp;</div>
                <h3 class="sn-product-card__title">One more thing is coming. Not yet.</h3>
                <p class="sn-product-card__body">&nbsp;</p>
                <span class="sn-product-card__link" style="cursor: default;">&nbsp;</span>
            </article>
        </div>
    </div>
</section>
