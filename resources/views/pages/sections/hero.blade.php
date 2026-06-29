<section id="hero" class="sn-hero">
    <video id="hero-video" autoplay muted loop playsinline webkit-playsinline preload="auto"
           class="sn-hero__video"
           poster="{{ asset('storage/images/sanaa-sky.png') }}">
        <source src="{{ asset('storage/images/live.mp4') }}" type="video/mp4">
    </video>
    <div class="sn-hero__overlay" aria-hidden="true"></div>
    <div class="sn-hero__glow" aria-hidden="true"></div>

    <div class="sn-hero__content">
        <div class="sn-hero__badge" aria-label="Building since 2021">
            <span class="sn-hero__badge-dot" aria-hidden="true"></span>
            <span>{{ __('messages.hero.eyebrow') }}</span>
        </div>

        <h1 class="sn-hero__h1">
            {{ __('messages.hero.line_1') }}<br>
            {{ __('messages.hero.line_2') }}<br>
            <em>{{ __('messages.hero.line_3_emphasis') }}</em>
        </h1>

        <p class="sn-hero__deck">{{ __('messages.hero.deck') }}</p>

        <div class="sn-hero__buttons">
            <a href="{{ route('contact') }}" class="sn-btn-primary">
                {{ __('messages.hero.explore') }}
            </a>
            <a href="{{ route('investor-relations') }}" class="sn-btn-outline">
                {{ __('messages.hero.shop') }}
            </a>
        </div>

        <div class="sn-hero__meta" aria-label="Sanaa ecosystem pillars">
            <span>{{ __('messages.hero.meta_1') }}</span>
            <span>{{ __('messages.hero.meta_2') }}</span>
            <span>{{ __('messages.hero.meta_3') }}</span>
            <span>{{ __('messages.hero.meta_4') }}</span>
        </div>
    </div>
</section>
