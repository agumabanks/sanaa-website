<section id="team" class="team-premium">
    @php
        $bioOverrides = [
            'Aguma I. Banks' => 'Founded Sanaa in 2021 from Nasser Road, Kampala. Has built the full product stack — marketplace, cooperative, logistics SaaS, fintech ERP — without external funding. Founder of Sanaa Brands Ltd (2020) and the Sanaa Finance Cooperative (2022).',
            'NICOLE ARAME' => 'Chief Legal Officer. Governance, compliance, and legal structure across Sanaa\'s entities and regions.',
            'Nuwagaba Felix' => 'Chief Operating Officer. Keeps execution moving across the commercial and operational parts of Sanaa.',
            'Elie Le Potier' => 'Senior Developer. Builds and maintains the systems behind Soko 24, Baraka 24, and the wider Sanaa software stack.',
            'Allen Mutabazi' => 'Assistant Finance. Handles records, reporting, and day-to-day financial coordination across the business.',
            'MpinDu Jp B.' => 'International Relations. Manages regional relationships, cross-border coordination, and partner communication.',
        ];
    @endphp

    <div class="section-header">
        <div class="section-eyebrow mb-3">People</div>
        <h2 class="section-title reveal-element">The Team</h2>
    </div>

    <div class="team-grid">
        @foreach($teamMembers as $index => $member)
            @php
                $displayName = $member->name === 'NICOLE ARAME' ? 'Nicole Arame' : $member->name;
                $displayBio = $bioOverrides[$member->name] ?? $member->bio;
            @endphp

            <div class="team-member" style="--delay: {{ $index + 1 }}">
                <div class="member-image-container">
                    @if($member->photo)
                        <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $displayName }}" class="member-image" loading="lazy">
                    @else
                        <div class="member-image" style="background: linear-gradient(135deg, var(--dark-gray), var(--emerald));"></div>
                    @endif
                </div>

                <div class="member-name">{{ $displayName }}</div>
                @if($member->title)
                    <div class="member-title">{{ $member->title }}</div>
                @endif
                @if($displayBio)
                    <p class="member-summary">{{ $displayBio }}</p>
                @endif
            </div>
        @endforeach
    </div>
</section>
