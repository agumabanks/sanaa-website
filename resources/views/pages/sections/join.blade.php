<section class="join-section" id="join-sanaa">
    <div class="join-card">
        <div class="join-eyebrow">{{ $section->getTranslation('eyebrow') }}</div>
        <h2 class="join-title">
            {!! $section->getTranslation('title') !!}
        </h2>
        <p class="join-subtitle">
            {{ $section->getTranslation('subtitle') }}
        </p>

        <div class="join-grid">
            <div class="join-cta-panel">
                <div class="join-actions">
                    <a href="{{ route('register') }}" class="btn-cta">
                        <span>{{ $section->getTranslation('cta_primary') }}</span>
                    </a>
                    <a href="{{ route('contact') }}" class="btn-cta-outline">
                        {{ $section->getTranslation('cta_secondary') }}
                    </a>
                </div>
                @if(! empty($settings['join_meta_1']) || ! empty($settings['join_meta_2']))
                <div class="join-meta">
                    @if(! empty($settings['join_meta_1']))
                    <span>{{ __($settings['join_meta_1']) }}</span>
                    @endif
                    @if(! empty($settings['join_meta_2']))
                    <span>{{ __($settings['join_meta_2']) }}</span>
                    @endif
                </div>
                @endif
                @if(! empty($settings['join_footnote']))
                <p class="text-xs uppercase tracking-[0.35em] text-gray-500 mt-2">
                    {{ __($settings['join_footnote']) }}
                </p>
                @endif
            </div>

            <div class="join-stats">
                @forelse($stats as $stat)
                <div class="join-stat-card">
                    <div class="join-stat-value">{{ $stat->value }}</div>
                    <div class="join-stat-label">{{ __($stat->label) }}</div>
                </div>
                @empty
                {{-- TODO: Add live conversion metrics here if this section is reused. --}}
                @endforelse
            </div>
        </div>

        <div class="join-logos">
            {!! $section->getTranslation('trust_text') !!}
        </div>
    </div>
</section>
