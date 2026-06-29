<section id="team" class="sn-section sn-team" aria-labelledby="team-heading">
    @php
        $teamData = [
            'Aguma I. Banks' => [
                'summary' => 'Founder & CEO. Built Sanaa from Nasser Road with zero external funding, constructing the full product stack from direct observation of African business operations.',
                'detail'  => 'Founded Sanaa in 2021 from Nasser Road, Kampala — a street of print shops, repair stalls, and small traders who have run businesses for decades without software or credit. Five years of direct observation across every layer of African business operations. He knows what a loan officer in Kisoro needs at 6 AM. He knows why a courier company in Kinshasa adopts one platform and ignores another. He knows the exact moment a SACCO manager decides whether to trust software with her members\' money. Built the full product stack — marketplace, cooperative, logistics SaaS, fintech ERP — without external funding. Founder of Sanaa Brands Ltd (2020) and the Sanaa Finance Cooperative (2022).',
            ],
            'NICOLE ARAME' => [
                'summary' => 'Chief Legal Officer. Architect of governance, compliance, and legal structure across all Sanaa entities and operating regions.',
                'detail'  => 'Chief Legal Officer. Oversees governance, compliance, and legal structure across Sanaa\'s entities and regions. Ensures every product, partnership, and expansion is built on solid legal ground.',
            ],
            'Nuwagaba Felix' => [
                'summary' => 'Chief Operating Officer. Drives execution across commercial strategy, operations, and cross-functional delivery.',
                'detail'  => 'Chief Operating Officer. Keeps execution moving across the commercial and operational parts of Sanaa. Responsible for turning strategy into daily outcomes across finance, commerce, and logistics.',
            ],
            'Elie Le Potier' => [
                'summary' => 'Senior Developer. Core architect of Soko 24, Baraka 24, and the wider Sanaa software infrastructure.',
                'detail'  => 'Senior Developer. Builds and maintains the systems behind Soko 24, Baraka 24, and the wider Sanaa software stack. Translates complex operational requirements into reliable, scalable infrastructure.',
            ],
            'Allen Mutabazi' => [
                'summary' => 'Assistant Finance. Manages records, reporting, and day-to-day financial coordination across the Sanaa ecosystem.',
                'detail'  => 'Assistant Finance. Handles records, reporting, and day-to-day financial coordination across the business. Ensures accuracy and transparency in every transaction and report.',
            ],
            'MpinDu Jp B.' => [
                'summary' => 'International Relations. Leads regional partnerships, cross-border coordination, and strategic partner communication.',
                'detail'  => 'International Relations. Manages regional relationships, cross-border coordination, and partner communication across Uganda, DRC, South Africa, and emerging markets.',
            ],
        ];

        $avatarColors = [
            '#047857', // emerald-700
            '#b85c3c', // clay
            '#c89b3c', // gold
            '#44403c', // stone-700
            '#065f46', // emerald-800
            '#57534e', // stone-600
        ];
    @endphp

    <style>
        .sn-team {
            background: var(--paper);
            border-top: 1px solid var(--stone-200);
        }

        .sn-team__header {
            margin-bottom: 3rem;
        }

        .sn-team__grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem 2.5rem;
        }

        .sn-team-member {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            position: relative;
            cursor: pointer;
            z-index: 1;
        }

        .sn-team-member:hover {
            z-index: 50;
        }

        .sn-team-member__avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 1rem;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }

        .sn-team-member:hover .sn-team-member__avatar {
            transform: scale(1.05);
        }

        .sn-team-member__avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sn-team-member__initials {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-sans);
            font-size: 1.1rem;
            font-weight: 600;
            color: #ffffff;
            letter-spacing: 0.04em;
        }

        .sn-team-member__name {
            font-size: 0.97rem;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 0.2rem;
        }

        .sn-team-member__role {
            font-size: 0.82rem;
            color: var(--stone-500);
            margin-bottom: 0.75rem;
        }

        .sn-team-member__summary {
            font-size: 0.88rem;
            line-height: 1.7;
            color: var(--stone-500);
        }

        /* Hover reveal panel */
        .sn-team-member__detail {
            position: absolute;
            inset: -0.75rem -1rem auto -1rem;
            z-index: 10;
            background: #ffffff;
            border: 1px solid var(--stone-200);
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
            padding: 1.5rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(4px);
            transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
            pointer-events: none;
            max-height: 360px;
            overflow-y: auto;
        }

        .sn-team-member:hover .sn-team-member__detail {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            pointer-events: auto;
        }

        .sn-team-member__detail-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .sn-team-member__detail-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }

        .sn-team-member__detail-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sn-team-member__detail-initials {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-sans);
            font-size: 0.9rem;
            font-weight: 600;
            color: #ffffff;
        }

        .sn-team-member__detail-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--ink);
        }

        .sn-team-member__detail-role {
            font-size: 0.78rem;
            color: var(--stone-500);
        }

        .sn-team-member__detail-body {
            font-size: 0.85rem;
            line-height: 1.7;
            color: var(--stone-600);
        }

        /* Dark mode overrides for hover card */
        .dark .sn-team-member__detail {
            background: #171717;
            border-color: rgba(255,255,255,0.08);
        }
        .dark .sn-team-member__detail-name {
            color: #f5f5f4;
        }
        .dark .sn-team-member__detail-role {
            color: #a8a29e;
        }
        .dark .sn-team-member__detail-body {
            color: #a8a29e;
        }

        @media (max-width: 860px) {
            .sn-team__grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 520px) {
            .sn-team__grid {
                grid-template-columns: 1fr;
            }

            .sn-team-member__detail {
                position: fixed;
                inset: auto;
                left: 1rem;
                right: 1rem;
                bottom: 1rem;
                top: auto;
                transform: translateY(20px);
                max-height: 70vh;
                overflow-y: auto;
            }

            .sn-team-member:hover .sn-team-member__detail {
                transform: translateY(0);
            }

            .sn-team-member__detail::before {
                content: '';
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: -1;
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.25s ease, visibility 0.25s;
            }

            .sn-team-member:hover .sn-team-member__detail::before {
                opacity: 1;
                visibility: visible;
            }
        }
    </style>

    <div class="sn-container">
        <div class="sn-team__header">
            <p class="sn-eyebrow">People</p>
            <h2 class="sn-h2" id="team-heading">The team.</h2>
        </div>

        <div class="sn-team__grid">
            @foreach($teamMembers as $index => $member)
                @php
                    $displayName = $member->name === 'NICOLE ARAME' ? 'Nicole Arame' : $member->name;
                    $info        = $teamData[$member->name] ?? ['summary' => $member->bio, 'detail' => $member->bio];
                    $bgColor     = $avatarColors[$index % count($avatarColors)];

                    $nameParts = preg_split('/\s+/', trim($displayName));
                    $initials  = mb_strtoupper(mb_substr($nameParts[0], 0, 1));
                    if (count($nameParts) > 1) {
                        $initials .= mb_strtoupper(mb_substr(end($nameParts), 0, 1));
                    }
                @endphp

                <div class="sn-team-member">
                    <div class="sn-team-member__avatar" aria-hidden="true">
                        @if($member->photo)
                            <img src="{{ asset('storage/' . $member->photo) }}"
                                 alt="{{ $displayName }}"
                                 loading="lazy">
                        @else
                            <div class="sn-team-member__initials" style="background: {{ $bgColor }};">
                                {{ $initials }}
                            </div>
                        @endif
                    </div>
                    <div class="sn-team-member__name">{{ $displayName }}</div>
                    @if($member->title)
                        <div class="sn-team-member__role">{{ $member->title }}</div>
                    @endif
                    <p class="sn-team-member__summary">{{ $info['summary'] }}</p>

                    <!-- Hover detail panel -->
                    <div class="sn-team-member__detail">
                        <div class="sn-team-member__detail-header">
                            <div class="sn-team-member__detail-avatar" aria-hidden="true">
                                @if($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}"
                                         alt="{{ $displayName }}">
                                @else
                                    <div class="sn-team-member__detail-initials" style="background: {{ $bgColor }};">
                                        {{ $initials }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="sn-team-member__detail-name">{{ $displayName }}</div>
                                <div class="sn-team-member__detail-role">{{ $member->title }}</div>
                            </div>
                        </div>
                        <p class="sn-team-member__detail-body">{{ $info['detail'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
