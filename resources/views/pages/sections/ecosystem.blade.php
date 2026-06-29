@php
    $layers = [
        [
            'number' => '1',
            'title'  => 'Finance',
            'body'   => 'The cooperative is the base layer. Member-owned. Built for businesses inside the network.',
        ],
        [
            'number' => '2',
            'title'  => 'Commerce',
            'body'   => 'Soko 24 connects buyers, sellers, and service providers across East and Central Africa.',
        ],
        [
            'number' => '3',
            'title'  => 'Logistics',
            'body'   => 'Baraka 24 moves orders, riders, COD, and dispatch operations through one logistics stack.',
        ],
        [
            'number' => '4',
            'title'  => 'Infrastructure',
            'body'   => 'Sanaa Cloud, POS, and Cards keep compute, hardware, and payments aligned.',
        ],
        [
            'number' => '5',
            'title'  => 'A fifth layer.',
            'body'   => 'We will talk about it when it is ready.',
        ],
    ];
@endphp

<section id="full-picture" class="sn-section sn-system" aria-labelledby="system-heading">
    <style>
        .sn-system {
            background: var(--ink);
            color: #ffffff;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .sn-system__header {
            max-width: 52ch;
            margin-bottom: 3.5rem;
        }

        .sn-system__intro {
            font-size: 1rem;
            line-height: 1.75;
            color: rgba(255,255,255,0.56);
            margin-top: 1rem;
        }

        .sn-system__grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 0;
            border-top: 1px solid rgba(255,255,255,0.1);
            border-left: 1px solid rgba(255,255,255,0.1);
        }

        .sn-system__item {
            padding: 2rem 1.75rem;
            border-right: 1px solid rgba(255,255,255,0.1);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sn-system__number {
            font-family: var(--font-sans);
            font-size: 2.4rem;
            font-weight: 300;
            letter-spacing: -0.04em;
            color: var(--emerald-400);
            line-height: 1;
            margin-bottom: 1rem;
        }

        .sn-system__item-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 0.6rem;
            line-height: 1.3;
        }

        .sn-system__item-body {
            font-size: 0.88rem;
            line-height: 1.7;
            color: rgba(255,255,255,0.48);
        }

        @media (max-width: 1100px) {
            .sn-system__grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 700px) {
            .sn-system__grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="sn-container">
        <div class="sn-system__header">
            <p class="sn-eyebrow" style="color: rgba(255,255,255,0.36);">System View</p>
            <h2 class="sn-h2 sn-h2--white" id="system-heading">How it fits.</h2>
            <p class="sn-system__intro">A business enters the Sanaa ecosystem at any point. Once inside, the connections compound. The infrastructure layer holds it together. This is one system, built in layers, with ownership at the centre.</p>
        </div>

        <div class="sn-system__grid" role="list">
            @foreach($layers as $layer)
                <div class="sn-system__item" role="listitem">
                    <div class="sn-system__number" aria-hidden="true">{{ $layer['number'] }}</div>
                    <div class="sn-system__item-title">{{ $layer['title'] }}</div>
                    <div class="sn-system__item-body">{{ $layer['body'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
