{{-- Blog Section Partial --}}
@php
    try {
        $featuredBlog = \App\Models\Blog::published()
            ->with(['author', 'category'])
            ->where('slug', 'i-dont-know-if-i-can-do-this-anymore')
            ->first();

        $otherBlogs = \App\Models\Blog::published()
            ->with(['author', 'category'])
            ->when($featuredBlog, fn ($query) => $query->where('id', '!=', $featuredBlog->id))
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->take(6)
            ->get();
    } catch (\Throwable $e) {
        $featuredBlog = null;
        $otherBlogs = collect();
    }
    $featuredImage = $featuredBlog && $featuredBlog->featured_image
        ? ($featuredBlog->featured_image_url ?? asset('storage/' . $featuredBlog->featured_image))
        : null;
@endphp

@push('styles')
<style>
  .insights-shell {
    position: relative;
    z-index: 1;
  }

  .insights-header {
    display: grid;
    gap: 1.5rem;
    margin-bottom: 2.75rem;
  }

  .insights-kicker {
    margin: 0 0 1rem;
    color: rgba(52, 211, 153, 0.92);
    font-size: 0.72rem;
    letter-spacing: 0.34em;
    text-transform: uppercase;
  }

  .insights-title {
    margin: 0;
    color: #ffffff;
    font-size: clamp(2.8rem, 5vw, 4.4rem);
    font-weight: 300;
    line-height: 0.95;
    letter-spacing: -0.05em;
  }

  .insights-title span {
    color: #34d399;
    font-weight: 400;
  }

  .insights-summary {
    margin: 0;
    max-width: 36rem;
    color: rgba(255, 255, 255, 0.68);
    font-size: 1.05rem;
    line-height: 1.7;
  }

  .insights-header-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 1.5rem;
  }

  .insights-header-line {
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, rgba(52, 211, 153, 0.55), rgba(52, 211, 153, 0));
  }

  .insights-header-tools {
    display: inline-flex;
    align-items: center;
    gap: 0.9rem;
  }

  .insights-link {
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    color: #34d399;
    text-decoration: none !important;
    font-size: 0.92rem;
    font-weight: 500;
    transition: color 0.25s ease, transform 0.25s ease;
  }

  .insights-link:hover {
    color: #ffffff;
  }

  .insights-link svg {
    transition: transform 0.25s ease;
  }

  .insights-link:hover svg {
    transform: translateX(4px);
  }

  .insights-rail-wrap {
    position: relative;
    padding-inline: 0.35rem;
  }

  .insights-rail-wrap::before,
  .insights-rail-wrap::after {
    content: '';
    position: absolute;
    top: 0;
    bottom: 1rem;
    width: 4rem;
    z-index: 3;
    pointer-events: none;
  }

  .insights-rail-wrap::before {
    left: 0;
    background: linear-gradient(90deg, rgba(0, 0, 0, 0.96), rgba(0, 0, 0, 0));
  }

  .insights-rail-wrap::after {
    right: 0;
    background: linear-gradient(270deg, rgba(0, 0, 0, 0.96), rgba(0, 0, 0, 0));
  }

  .insights-rail {
    display: flex;
    align-items: stretch;
    gap: 0.95rem;
    overflow-x: auto;
    overflow-y: hidden;
    padding: 0.2rem 0.15rem 1rem;
    scroll-snap-type: x mandatory;
    scroll-padding-inline: 1rem;
    overscroll-behavior-x: contain;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    cursor: grab;
  }

  .insights-rail::-webkit-scrollbar {
    display: none;
  }

  .insights-rail.is-dragging {
    cursor: grabbing;
  }

  .insights-card {
    --card-width: 15rem;
    --card-width-active: 19rem;
    position: relative;
    flex: 0 0 var(--card-width);
    min-height: 34rem;
    border-radius: 2rem;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.12);
    background: #07090b;
    scroll-snap-align: start;
    transition:
      flex-basis 0.55s cubic-bezier(0.16, 1, 0.3, 1),
      transform 0.55s cubic-bezier(0.16, 1, 0.3, 1),
      border-color 0.35s ease,
      box-shadow 0.35s ease,
      filter 0.35s ease;
    will-change: flex-basis, transform;
  }

  .insights-card.is-active {
    flex-basis: var(--card-width-active);
    border-color: rgba(52, 211, 153, 0.28);
    box-shadow: 0 28px 90px rgba(0, 0, 0, 0.36);
    transform: translateY(-0.45rem);
  }

  .insights-rail:hover .insights-card:not(.is-active) {
    filter: saturate(0.76) brightness(0.82);
  }

  .insights-card-link {
    position: relative;
    display: block;
    width: 100%;
    height: 100%;
    color: inherit;
    text-decoration: none !important;
  }

  .insights-card-link,
  .insights-card-link:hover,
  .insights-card-link:focus,
  .insights-card-link:active,
  .insights-card-link:visited,
  .insights-card-link *,
  .insights-card-link:hover *,
  .insights-card-link:focus *,
  .insights-card-link:active * {
    text-decoration: none !important;
    box-shadow: none !important;
  }

  .insights-media,
  .insights-tint,
  .insights-gradient {
    position: absolute;
    inset: 0;
  }

  .insights-media {
    background-size: cover;
    background-position: center;
    transform: scale(1.02) translate3d(calc(var(--mx, 0.5) * -10px + 5px), calc(var(--my, 0.5) * -10px + 5px), 0);
    transition: transform 0.9s cubic-bezier(0.16, 1, 0.3, 1), filter 0.35s ease;
    will-change: transform;
  }

  .insights-card.is-active .insights-media,
  .insights-card:hover .insights-media {
    transform: scale(1.07) translate3d(calc(var(--mx, 0.5) * -18px + 9px), calc(var(--my, 0.5) * -18px + 9px), 0);
  }

  .insights-card::after {
    content: '';
    position: absolute;
    inset: auto auto 12% 50%;
    width: 10rem;
    height: 10rem;
    border-radius: 999px;
    background: radial-gradient(circle, rgba(52, 211, 153, 0.2), transparent 68%);
    opacity: 0;
    transform: translate(-50%, -50%) scale(0.8);
    transition: opacity 0.35s ease, transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
    pointer-events: none;
    z-index: 1;
  }

  .insights-card.is-active::after,
  .insights-card:hover::after {
    opacity: 1;
    transform: translate(calc(var(--mx, 0.5) * 30%), calc(var(--my, 0.5) * -15%)) scale(1);
  }

  .insights-tint {
    background:
      linear-gradient(180deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0)),
      radial-gradient(circle at top right, rgba(52, 211, 153, 0.14), transparent 34%);
    mix-blend-mode: screen;
  }

  .insights-gradient {
    background:
      linear-gradient(180deg, rgba(0, 0, 0, 0.12) 0%, rgba(0, 0, 0, 0.08) 24%, rgba(0, 0, 0, 0.82) 100%),
      linear-gradient(90deg, rgba(0, 0, 0, 0.12), transparent 42%, rgba(0, 0, 0, 0.24));
  }

  .insights-copy {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 100%;
    padding: 1.35rem;
  }

  .insights-meta {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 0.75rem;
  }

  .insights-pill-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.55rem;
  }

  .insights-pill {
    display: inline-flex;
    align-items: center;
    padding: 0.42rem 0.85rem;
    border-radius: 999px;
    background: rgba(0, 0, 0, 0.42);
    border: 1px solid rgba(255, 255, 255, 0.14);
    color: #ffffff;
    font-size: 0.68rem;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    backdrop-filter: blur(14px);
  }

  .insights-pill--accent {
    background: #34d399;
    border-color: transparent;
    color: #04120d;
  }

  .insights-label,
  .insights-date {
    color: rgba(255, 255, 255, 0.54);
    font-size: 0.7rem;
    letter-spacing: 0.22em;
    text-transform: uppercase;
  }

  .insights-date {
    text-align: right;
    line-height: 1.45;
  }

  .insights-content {
    margin-top: auto;
    transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
  }

  .insights-card:not(.is-active) .insights-content {
    transform: translateY(0.65rem);
  }

  .insights-featured {
    --card-width: min(34rem, 72vw);
    --card-width-active: min(44rem, 80vw);
  }

  .insights-featured .insights-copy {
    padding: 1.55rem;
  }

  .insights-eyebrow {
    margin-bottom: 0.9rem;
    color: rgba(167, 243, 208, 0.82);
    font-size: 0.72rem;
    letter-spacing: 0.3em;
    text-transform: uppercase;
  }

  .insights-feature-line {
    margin: 0;
    max-width: 8.1ch;
    color: #ffffff;
    font-size: clamp(2.95rem, 4.8vw, 5rem);
    font-weight: 300;
    line-height: 0.88;
    letter-spacing: -0.07em;
    text-wrap: balance;
    text-decoration: none !important;
    border-bottom: 0 !important;
  }

  .insights-feature-subline {
    margin: 0.95rem 0 0;
    max-width: 20ch;
    color: rgba(255, 255, 255, 0.84);
    font-size: 1rem;
    line-height: 1.45;
    text-decoration: none !important;
    border-bottom: 0 !important;
  }

  .insights-feature-divider,
  .insights-side-divider {
    width: 100%;
    height: 1px;
    margin: 1.4rem 0 1rem;
    background: linear-gradient(90deg, rgba(255, 255, 255, 0.26), rgba(255, 255, 255, 0.05));
  }

  .insights-story-title {
    color: rgba(255, 255, 255, 0.94);
    font-size: 1rem;
    line-height: 1.45;
  }

  .insights-story-actions,
  .insights-story-meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.9rem 1rem;
  }

  .insights-story-actions {
    justify-content: space-between;
    margin-top: 0.9rem;
  }

  .insights-story-meta {
    color: rgba(255, 255, 255, 0.64);
    font-size: 0.9rem;
  }

  .insights-cta {
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    color: #34d399;
    font-size: 0.95rem;
    font-weight: 500;
    transition: color 0.25s ease;
  }

  .insights-cta svg {
    transition: transform 0.25s ease;
  }

  .insights-card:hover .insights-cta,
  .insights-card.is-active .insights-cta {
    color: #ffffff;
  }

  .insights-card:hover .insights-cta svg,
  .insights-card.is-active .insights-cta svg {
    transform: translateX(5px);
  }

  .insights-side {
    --card-width: 13.5rem;
    --card-width-active: 22rem;
  }

  .insights-side-title {
    margin: 0;
    max-width: 5.4ch;
    color: #ffffff;
    font-size: clamp(1.85rem, 2.5vw, 2.9rem);
    font-weight: 300;
    line-height: 0.9;
    letter-spacing: -0.065em;
    text-transform: uppercase;
    text-wrap: balance;
    transition: max-width 0.45s cubic-bezier(0.16, 1, 0.3, 1), font-size 0.45s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .insights-side.is-active .insights-side-title {
    max-width: 7.8ch;
    font-size: clamp(2.35rem, 3.35vw, 3.85rem);
  }

  .insights-side-footer {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 0.9rem;
    margin-top: 1rem;
  }

  .insights-side-readtime {
    color: rgba(255, 255, 255, 0.62);
    font-size: 0.86rem;
    line-height: 1.5;
  }

  .insights-info {
    --card-width: 13.5rem;
    --card-width-active: 16.75rem;
    background: linear-gradient(160deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.015));
  }

  .insights-info-copy {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 100%;
    padding: 1.4rem;
  }

  .insights-info-label {
    margin-bottom: 1rem;
    color: rgba(255, 255, 255, 0.46);
    font-size: 0.68rem;
    letter-spacing: 0.26em;
    text-transform: uppercase;
  }

  .insights-info-title {
    margin: 0;
    color: #ffffff;
    font-size: clamp(1.3rem, 2vw, 2.05rem);
    font-weight: 300;
    line-height: 1.02;
    letter-spacing: -0.04em;
    text-transform: none;
    max-width: 10ch;
  }

  .insights-info-footer {
    margin-top: 1.35rem;
  }

  .insights-info-footer p {
    margin: 0 0 1rem;
    color: rgba(255, 255, 255, 0.62);
    font-size: 0.94rem;
    line-height: 1.65;
    max-width: 18ch;
  }

  .insights-rail-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-top: 0.9rem;
  }

  .insights-scroll-hint {
    color: rgba(255, 255, 255, 0.34);
    font-size: 0.68rem;
    letter-spacing: 0.28em;
    text-transform: uppercase;
  }

  .insights-progress {
    position: relative;
    flex: 1;
    max-width: 12rem;
    height: 2px;
    background: rgba(255, 255, 255, 0.12);
    overflow: hidden;
  }

  .insights-progress-bar {
    position: absolute;
    inset: 0 auto 0 0;
    width: 28%;
    background: linear-gradient(90deg, #34d399, rgba(52, 211, 153, 0.32));
    transition: width 0.25s ease, transform 0.25s ease;
  }

  .insights-nav {
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
  }

  .insights-nav-button {
    width: 2.8rem;
    height: 2.8rem;
    border-radius: 999px;
    border: 1px solid rgba(255, 255, 255, 0.18);
    background: rgba(255, 255, 255, 0.04);
    color: rgba(255, 255, 255, 0.72);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.25s ease, border-color 0.25s ease, color 0.25s ease, background 0.25s ease;
  }

  .insights-nav-button:hover {
    transform: translateY(-2px);
    border-color: rgba(52, 211, 153, 0.42);
    color: #ffffff;
    background: rgba(52, 211, 153, 0.08);
  }

  .insights-nav-button:disabled {
    opacity: 0.35;
    cursor: default;
  }

  @media (min-width: 980px) {
    .insights-header {
      grid-template-columns: minmax(0, 0.8fr) minmax(0, 1fr);
      align-items: end;
    }

    .insights-header-right {
      justify-self: end;
    }
  }

  @media (max-width: 1279px) {
    .insights-rail-wrap::before,
    .insights-rail-wrap::after {
      width: 2rem;
    }

    .insights-info {
      display: none;
    }

    .insights-card {
      min-height: 31rem;
    }

    .insights-featured {
      --card-width: min(31rem, 82vw);
      --card-width-active: min(36rem, 88vw);
    }

    .insights-side {
      --card-width: min(15rem, 64vw);
      --card-width-active: min(19rem, 76vw);
    }
  }

  @media (max-width: 767px) {
    .insights-header {
      margin-bottom: 2.2rem;
    }

    .insights-header-actions {
      justify-content: space-between;
    }

    .insights-header-tools {
      width: 100%;
      justify-content: space-between;
    }

    .insights-header-line {
      display: none;
    }

    .insights-nav {
      display: none;
    }

    .insights-card {
      min-height: 28rem;
    }

    .insights-copy {
      padding: 1.25rem;
    }

    .insights-feature-line {
      max-width: 8.2ch;
      font-size: clamp(2.3rem, 10vw, 3.55rem);
    }

    .insights-feature-subline {
      font-size: 0.98rem;
      max-width: 18ch;
    }

    .insights-side-title {
      max-width: 7.4ch;
      font-size: clamp(2rem, 9vw, 3rem);
    }

    .insights-rail-meta {
      align-items: flex-start;
      flex-direction: column;
    }

    .insights-progress {
      width: 100%;
      max-width: none;
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .insights-card,
    .insights-media,
    .insights-link svg,
    .insights-cta svg,
    .insights-progress-bar {
      transition: none !important;
      animation: none !important;
    }
  }
</style>
@endpush

<div class="insights-shell" id="founder-journal">
    <div class="insights-header">
        <div>
            <p class="insights-kicker">Founder Journal</p>
            <h2 class="insights-title">Latest <span>Insights</span></h2>
        </div>

        <div class="insights-header-right">
            <p class="insights-summary">
                Writing from inside the build. Founder notes, operating lessons, and the thinking behind the stack.
            </p>
            <div class="insights-header-actions">
                <div class="insights-header-line"></div>
                <div class="insights-header-tools">
                    <a href="{{ route('blog.index') }}" class="insights-link">
                        <span>See all articles</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <div class="insights-nav" aria-label="Scroll founder journal">
                        <button type="button" class="insights-nav-button" data-rail-nav="prev" aria-label="Scroll left">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L8.414 10l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <button type="button" class="insights-nav-button" data-rail-nav="next" aria-label="Scroll right">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 4.293a1 1 0 011.414 0l5 5a1 1 0 010 1.414l-5 5a1 1 0 11-1.414-1.414L11.586 10 7.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="insights-rail-wrap">
        <div class="insights-rail" id="insightsRail">
            <article class="insights-card insights-info" data-insights-focus="info">
                <div class="insights-info-copy">
                    <div>
                        <div class="insights-info-label">Inside Sanaa</div>
                        <h3 class="insights-info-title">Notes from inside the build.</h3>
                    </div>

                    <div class="insights-info-footer">
                        <p>Founder notes, product calls, and field lessons while they still have rough edges.</p>
                        <a href="{{ route('blog.index') }}" class="insights-link">
                            <span>Open the archive</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>

            @if($featuredBlog)
                <article class="insights-card insights-featured" data-insights-focus="featured">
                    <a href="{{ $featuredBlog->url ?? route('blog.show', $featuredBlog->slug ?? $featuredBlog->id) }}" class="insights-card-link">
                        <div class="insights-media"
                             @if($featuredImage)
                                 style="background-image:url('{{ $featuredImage }}')"
                             @endif></div>
                        <div class="insights-tint"></div>
                        <div class="insights-gradient"></div>

                        <div class="insights-copy">
                            <div class="insights-meta">
                                <div class="insights-pill-row">
                                    <span class="insights-pill insights-pill--accent">Featured</span>
                                    @if($featuredBlog->category)
                                        <span class="insights-pill">{{ $featuredBlog->category->name }}</span>
                                    @endif
                                </div>
                                <div class="insights-label">Founder note</div>
                            </div>

                            <div class="insights-content">
                                <div class="insights-eyebrow">{{ $featuredBlog->author->name ?? 'Sanaa Team' }}</div>
                                <h3 class="insights-feature-line">It's 3:47 AM and I'm still at my desk.</h3>
                                <p class="insights-feature-subline">Not because I have to be, because I can't stop.</p>

                                <div class="insights-feature-divider"></div>

                                <div class="insights-story-title">{{ $featuredBlog->title }}</div>
                                <div class="insights-story-actions">
                                    <div class="insights-story-meta">
                                        <span>{{ $featuredBlog->author->name ?? 'Sanaa Team' }}</span>
                                        <span>{{ $featuredBlog->formatted_date ?? optional($featuredBlog->created_at)->format('M d, Y') }}</span>
                                        <span>{{ $featuredBlog->reading_time ?? 6 }} min read</span>
                                    </div>
                                    <div class="insights-cta">
                                        <span>Read the full note</span>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>
            @endif

            @foreach($otherBlogs as $index => $blog)
                @php
                    $focus = 'side-' . ($index + 1);
                @endphp
                @php
                    $blogUrl = $blog->url ?? route('blog.show', $blog->slug ?? $blog->id);
                    $blogImage = $blog->featured_image
                        ? ($blog->featured_image_url ?? asset('storage/' . $blog->featured_image))
                        : null;
                @endphp

                <article class="insights-card insights-side" data-insights-focus="{{ $focus }}">
                    <a href="{{ $blogUrl }}" class="insights-card-link">
                        <div class="insights-media"
                             @if($blogImage)
                                 style="background-image:url('{{ $blogImage }}')"
                             @endif></div>
                        <div class="insights-tint"></div>
                        <div class="insights-gradient"></div>

                        <div class="insights-copy">
                            <div class="insights-meta">
                                <div class="insights-label">{{ $blog->category->name ?? 'Journal' }}</div>
                                <div class="insights-date">{{ $blog->formatted_date ?? optional($blog->created_at)->format('M d, Y') }}</div>
                            </div>

                            <div class="insights-content">
                                <h3 class="insights-side-title">{{ \Illuminate\Support\Str::limit($blog->title, 32) }}</h3>
                                <div class="insights-side-divider"></div>
                                <div class="insights-side-footer">
                                    <div class="insights-side-readtime">{{ $blog->reading_time ?? 5 }} min read</div>
                                    <div class="insights-cta">
                                        <span>Read</span>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    </div>

    <div class="insights-rail-meta">
        <div class="insights-scroll-hint">Drag, swipe, or use the arrows</div>
        <div class="insights-progress" aria-hidden="true">
            <span class="insights-progress-bar" id="insightsProgressBar"></span>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const shell = document.getElementById('founder-journal');
    const rail = document.getElementById('insightsRail');
    if (!shell || !rail) return;

    const cards = Array.from(rail.querySelectorAll('.insights-card'));
    const interactiveCards = cards.filter((card) => card.dataset.insightsFocus);
    const progressBar = document.getElementById('insightsProgressBar');
    const navPrev = shell.querySelector('[data-rail-nav="prev"]');
    const navNext = shell.querySelector('[data-rail-nav="next"]');
    let resetTimer;
    let isPointerDown = false;
    let startX = 0;
    let startScrollLeft = 0;

    const setActive = (focus) => {
        interactiveCards.forEach((card) => {
            card.classList.toggle('is-active', card.dataset.insightsFocus === focus);
        });
    };

    setActive('featured');

    const updateProgress = () => {
        const maxScroll = rail.scrollWidth - rail.clientWidth;
        const ratio = maxScroll > 0 ? rail.scrollLeft / maxScroll : 0;
        if (progressBar) {
            progressBar.style.width = `${Math.max(18, Math.min(100, (rail.clientWidth / rail.scrollWidth) * 100 || 18))}%`;
            progressBar.style.transform = `translateX(${ratio * 100}%)`;
        }
        if (navPrev) navPrev.disabled = rail.scrollLeft <= 8;
        if (navNext) navNext.disabled = rail.scrollLeft >= maxScroll - 8;
    };

    const setMediaPosition = (card, event) => {
        const rect = card.getBoundingClientRect();
        const x = (event.clientX - rect.left) / rect.width;
        const y = (event.clientY - rect.top) / rect.height;
        card.style.setProperty('--mx', Math.max(0, Math.min(1, x)).toFixed(3));
        card.style.setProperty('--my', Math.max(0, Math.min(1, y)).toFixed(3));
    };

    const getNearestCard = (clientX) => {
        let nearest = interactiveCards[0];
        let nearestDistance = Number.POSITIVE_INFINITY;

        interactiveCards.forEach((card) => {
            const rect = card.getBoundingClientRect();
            const center = rect.left + rect.width / 2;
            const distance = Math.abs(clientX - center);
            if (distance < nearestDistance) {
                nearest = card;
                nearestDistance = distance;
            }
        });

        return nearest;
    };

    if (window.matchMedia('(pointer: fine)').matches) {
        rail.addEventListener('mousemove', (event) => {
            const nearest = getNearestCard(event.clientX);
            if (nearest) {
                setActive(nearest.dataset.insightsFocus);
                setMediaPosition(nearest, event);
            }
        });

        rail.addEventListener('mouseleave', () => {
            clearTimeout(resetTimer);
            resetTimer = setTimeout(() => setActive('featured'), 120);
        });
    }

    interactiveCards.forEach((card) => {
        card.addEventListener('mouseenter', () => {
            clearTimeout(resetTimer);
            setActive(card.dataset.insightsFocus);
        });

        card.addEventListener('focusin', () => {
            clearTimeout(resetTimer);
            setActive(card.dataset.insightsFocus);
        });

        card.addEventListener('touchstart', () => {
            setActive(card.dataset.insightsFocus);
            card.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        }, { passive: true });
    });

    rail.addEventListener('wheel', (event) => {
        if (Math.abs(event.deltaY) <= Math.abs(event.deltaX)) return;
        event.preventDefault();
        rail.scrollLeft += event.deltaY;
        updateProgress();
    }, { passive: false });

    rail.addEventListener('pointerdown', (event) => {
        if (event.pointerType !== 'mouse') return;
        isPointerDown = true;
        rail.classList.add('is-dragging');
        startX = event.clientX;
        startScrollLeft = rail.scrollLeft;
    });

    window.addEventListener('pointermove', (event) => {
        if (!isPointerDown) return;
        const delta = event.clientX - startX;
        rail.scrollLeft = startScrollLeft - delta;
        updateProgress();
    });

    const stopDragging = () => {
        isPointerDown = false;
        rail.classList.remove('is-dragging');
    };

    window.addEventListener('pointerup', stopDragging);
    window.addEventListener('pointercancel', stopDragging);

    rail.addEventListener('scroll', updateProgress, { passive: true });

    [navPrev, navNext].forEach((button) => {
        if (!button) return;
        button.addEventListener('click', () => {
            const direction = button.dataset.railNav === 'next' ? 1 : -1;
            rail.scrollBy({ left: direction * rail.clientWidth * 0.62, behavior: 'smooth' });
        });
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                shell.classList.add('is-visible');
                observer.disconnect();
            }
        });
    }, { threshold: 0.2 });

    observer.observe(shell);
    updateProgress();
});
</script>
@endpush
