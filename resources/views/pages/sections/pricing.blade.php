@php
    $pricingPaths = [
        [
            'title'       => 'Soko 24',
            'badge'       => 'Commerce',
            'description' => 'Marketplace pricing is handled on Soko 24 based on what a seller or service business needs.',
            'link'        => 'https://soko24.co',
            'target'      => '_blank',
        ],
        [
            'title'       => 'Sanaa Finance SaaS',
            'badge'       => 'Finance SaaS',
            'description' => 'Pricing depends on institution size, workflow needs, and deployment scope for SACCOs and lenders.',
            'link'        => route('finance.pricing'),
            'target'      => null,
        ],
        [
            'title'       => 'Baraka 24',
            'badge'       => 'Logistics SaaS',
            'description' => 'Courier and delivery operators are priced by the operating stack they need, from dispatch to rider accounts.',
            'link'        => 'https://baraka.sanaa.ug',
            'target'      => '_blank',
        ],
        [
            'title'       => 'Sanaa POS',
            'badge'       => 'POS',
            'description' => 'Hardware and software pricing for point-of-sale is separate from the rest of the stack.',
            'link'        => route('prices'),
            'target'      => null,
        ],
    ];
@endphp

<section id="pricing" class="sn-section sn-pricing" aria-labelledby="pricing-heading">
    <style>
        .sn-pricing {
            background: var(--paper-soft);
            border-top: 1px solid var(--stone-200);
        }

        .sn-pricing__header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2.5rem;
        }

        .sn-pricing__header-left {
            flex: 1;
            min-width: 220px;
        }

        .sn-pricing__see-all {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--stone-500);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: color 0.15s ease;
            flex-shrink: 0;
        }

        .sn-pricing__see-all:hover {
            color: var(--ink);
        }

        .sn-pricing__grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
        }

        .sn-pricing-card {
            background: #ffffff;
            border: 1px solid var(--stone-200);
            border-radius: 18px;
            box-shadow: var(--shadow-1);
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.15s ease;
        }

        .sn-pricing-card:hover {
            box-shadow: var(--shadow-2);
        }

        .sn-pricing-card__badge {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--stone-400);
            margin-bottom: 0.9rem;
        }

        .sn-pricing-card__title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 0.65rem;
            line-height: 1.3;
        }

        .sn-pricing-card__body {
            font-size: 0.9rem;
            line-height: 1.65;
            color: var(--stone-500);
            flex: 1;
            margin-bottom: 1.5rem;
        }

        .sn-pricing-card__link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.6rem 1.25rem;
            border-radius: 999px;
            border: 1px solid var(--stone-200);
            background: transparent;
            color: var(--ink);
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: border-color 0.15s ease, background 0.15s ease;
            align-self: flex-start;
        }

        .sn-pricing-card__link:hover {
            border-color: var(--stone-400);
            background: var(--paper);
        }

        @media (max-width: 1000px) {
            .sn-pricing__grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .sn-pricing__grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="sn-container">
        <div class="sn-pricing__header">
            <div class="sn-pricing__header-left">
                <p class="sn-eyebrow">Product Paths</p>
                <h2 class="sn-h2" id="pricing-heading">Find the right Sanaa product.</h2>
            </div>
            <a href="{{ route('prices') }}" class="sn-pricing__see-all">See all pricing &rarr;</a>
        </div>

        <div class="sn-pricing__grid">
            @foreach($pricingPaths as $path)
                <article class="sn-pricing-card">
                    <div class="sn-pricing-card__badge">{{ $path['badge'] }}</div>
                    <h3 class="sn-pricing-card__title">{{ $path['title'] }}</h3>
                    <p class="sn-pricing-card__body">{{ $path['description'] }}</p>
                    <a href="{{ $path['link'] }}"
                       class="sn-pricing-card__link"
                       @if($path['target']) target="{{ $path['target'] }}" rel="noopener noreferrer" @endif>
                        View pricing
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>
