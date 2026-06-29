<section id="cooperative" class="sn-section sn-coop" aria-labelledby="coop-heading">
    <style>
        .sn-coop {
            background: var(--paper-soft);
            border-top: 1px solid var(--stone-200);
        }

        .sn-coop__grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: start;
        }

        .sn-coop__eyebrow {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 1rem;
        }

        .sn-coop__h2 {
            font-family: var(--font-sans);
            font-weight: 300;
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            letter-spacing: -0.03em;
            line-height: 1.1;
            color: var(--ink);
            margin-bottom: 1.75rem;
        }

        .sn-coop__prose p {
            font-size: 1rem;
            line-height: 1.75;
            color: var(--stone-600);
            margin-bottom: 1.1rem;
        }

        .sn-coop__prose p:last-child {
            margin-bottom: 0;
        }

        .sn-coop__card {
            background: #ffffff;
            border: 1px solid var(--stone-200);
            border-radius: 18px;
            box-shadow: var(--shadow-1);
            padding: 2rem 2.25rem;
        }

        .sn-coop__card-title {
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--stone-500);
            margin-bottom: 1.25rem;
        }

        .sn-coop__list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .sn-coop__list li {
            display: flex;
            gap: 0.85rem;
            align-items: flex-start;
            font-size: 0.97rem;
            line-height: 1.65;
            color: var(--stone-600);
        }

        .sn-coop__list li::before {
            content: '';
            flex-shrink: 0;
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: var(--emerald-500);
            margin-top: 0.55rem;
        }

        @media (max-width: 800px) {
            .sn-coop__grid {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }
        }
    </style>

    <div class="sn-container">
        <div class="sn-coop__grid">
            <div>
                <p class="sn-coop__eyebrow">Member-owned, not VC-owned</p>
                <h2 class="sn-coop__h2" id="coop-heading">Built on Ownership,<br>Not Just Access</h2>
                <div class="sn-coop__prose">
                    <p>Most technology companies sell tools to African businesses. Sanaa is different. We built a financial institution first.</p>
                    <p>The Sanaa Finance Cooperative was registered in Uganda in 2022 and is fully operational. It is a member-owned cooperative, not a fintech product. Members are businesses that work within the Sanaa ecosystem. Sellers on Soko 24, logistics operators on Baraka 24, and clients of Sanaa Media are not just customers. They are owners.</p>
                    <p>The cooperative does not offer loans to the general public. It is not a bank. It is not a lending app. It is a member institution. If you work with Sanaa, you can become a member and access what your business needs to grow.</p>
                    <p>This is the structure that makes Sanaa different from every other African startup. The software matters. The cooperative makes it permanent.</p>
                </div>
            </div>

            <div>
                <div class="sn-coop__card">
                    <div class="sn-coop__card-title">What members access today</div>
                    <ul class="sn-coop__list">
                        <li>Cash credit facilities for working capital and daily business operations.</li>
                        <li>Asset financing, with motorbike financing already running for delivery and logistics members.</li>
                        <li>Financial literacy that shapes how members manage money, stock, and growth.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
