<section id="investor-strip" class="sn-section sn-investor" aria-labelledby="investor-heading">
    <style>
        .sn-investor {
            background: var(--paper-soft);
            border-top: 1px solid var(--stone-200);
        }

        .sn-investor__inner {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 3rem;
            flex-wrap: wrap;
        }

        .sn-investor__left {
            flex: 1;
            min-width: 280px;
            max-width: 52ch;
        }

        .sn-investor__h3 {
            font-family: var(--font-sans);
            font-weight: 300;
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            letter-spacing: -0.03em;
            line-height: 1.15;
            color: var(--ink);
            margin-bottom: 1.25rem;
        }

        .sn-investor__body {
            font-size: 1rem;
            line-height: 1.75;
            color: var(--stone-600);
        }

        .sn-investor__right {
            flex-shrink: 0;
            display: flex;
            align-items: flex-start;
            padding-top: 0.25rem;
        }

        @media (max-width: 640px) {
            .sn-investor__inner {
                flex-direction: column;
                gap: 2rem;
            }
        }
    </style>

    <div class="sn-container">
        <div class="sn-investor__inner">
            <div class="sn-investor__left">
                <p class="sn-eyebrow sn-eyebrow--gold">For Investors</p>
                <h3 class="sn-investor__h3" id="investor-heading">Sanaa is not actively fundraising.</h3>
                <p class="sn-investor__body">We are building toward a point where the business speaks for itself before we open any conversation about capital. If you are an investor with a long view on African digital infrastructure and you want to follow this build, you can reach us here. We will respond when the time is right.</p>
            </div>
            <div class="sn-investor__right">
                <a href="mailto:ir@sanaa.ug" class="sn-btn-ink">
                    ir@sanaa.ug &rarr;
                </a>
            </div>
        </div>
    </div>
</section>
