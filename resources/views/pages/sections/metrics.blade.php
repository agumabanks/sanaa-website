@php
    $facts = [
        ['label' => 'Founded',        'value' => 'Building since 2021.'],
        ['label' => 'Cooperative',    'value' => 'Registered and operational since 2022.'],
        ['label' => 'Geography',      'value' => 'Active in Uganda, DRC, and South Africa. Expanding to Addis Ababa, Ethiopia.'],
        ['label' => 'Logistics',      'value' => 'Live B2B client running cross-border operations.'],
        ['label' => 'Fintech',        'value' => 'Financial software deployed with institutions.'],
        ['label' => 'Ownership',      'value' => '100% founder-owned.'],
        ['label' => 'Entities',       'value' => 'Three registered legal entities.'],
        ['label' => 'Team',           'value' => 'Team of six.'],
    ];
@endphp

<section id="build-so-far" class="sn-section sn-build" aria-label="Where we are">
    <style>
        .sn-build {
            background: var(--paper);
            border-top: 1px solid var(--stone-200);
        }

        .sn-build__header {
            margin-bottom: 3rem;
        }

        .sn-build__h2 {
            font-family: var(--font-sans);
            font-weight: 300;
            font-size: clamp(1.7rem, 3.5vw, 2.5rem);
            letter-spacing: -0.03em;
            color: var(--ink);
        }

        .sn-build__grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            border-top: 1px solid var(--stone-200);
            border-left: 1px solid var(--stone-200);
        }

        .sn-build__item {
            padding: 1.75rem 1.5rem;
            border-right: 1px solid var(--stone-200);
            border-bottom: 1px solid var(--stone-200);
        }

        .sn-build__item-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--stone-400);
            margin-bottom: 0.6rem;
        }

        .sn-build__item-value {
            font-size: 0.98rem;
            line-height: 1.55;
            color: var(--ink);
            font-weight: 400;
        }

        @media (max-width: 900px) {
            .sn-build__grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .sn-build__grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="sn-container">
        <div class="sn-build__header">
            <p class="sn-eyebrow">The Build So Far</p>
            <h2 class="sn-build__h2">Where we are, in plain numbers.</h2>
        </div>

        <div class="sn-build__grid">
            @foreach($facts as $fact)
                <div class="sn-build__item">
                    <div class="sn-build__item-label">{{ $fact['label'] }}</div>
                    <div class="sn-build__item-value">{{ $fact['value'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
