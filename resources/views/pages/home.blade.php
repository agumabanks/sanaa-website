@extends('layouts.landing')

@section('title', 'Sanaa Co. — Finance, Commerce, and Logistics for African Business')

@section('hide_header', true)

@section('seo_title', 'Sanaa Co. — Finance, Commerce, and Logistics for African Business')
@section('seo_description', 'Sanaa builds finance, commerce, logistics, and infrastructure for African business. Registered in Uganda. Active in Uganda, DRC, and South Africa. Expanding to Ethiopia. 100% founder-owned. Building since 2021.')
@section('seo_keywords', 'Sanaa Co,African business Uganda,Soko 24,Baraka 24,Sanaa Finance Cooperative,Sanaa Finance SaaS,Sanaa Cloud,Sanaa POS')
@section('seo_image', asset('storage/images/sanaa-logo-b.svg'))

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Sanaa Co.",
  "url": "https://sanaa.ug",
  "logo": "https://sanaa.ug/storage/images/sanaa-logo-b.svg",
  "foundingDate": "2021",
  "foundingLocation": "Kampala, Uganda",
  "description": "Member-owned technology ecosystem providing finance, commerce, logistics, and digital infrastructure for African business.",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+256706272481",
    "contactType": "customer support",
    "areaServed": ["UG", "CD"],
    "availableLanguage": ["English", "French", "Swahili"]
  },
  "sameAs": [
    "https://twitter.com/sanaa_co",
    "https://www.linkedin.com/company/sanaa",
    "https://www.instagram.com/sanaa_co"
  ],
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "Sanaa Product Stack",
    "itemListElement": [
      {"@type": "Offer", "itemOffered": {"@type": "SoftwareApplication", "name": "Sanaa Finance SaaS", "url": "https://sanaa.ug/finance"}},
      {"@type": "Offer", "itemOffered": {"@type": "SoftwareApplication", "name": "Baraka 24", "url": "https://baraka.sanaa.ug"}},
      {"@type": "Offer", "itemOffered": {"@type": "WebApplication", "name": "Soko 24", "url": "https://soko24.co"}}
    ]
  }
}
</script>
@endpush

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&family=Source+Serif+4:ital,opsz,wght@0,8..60,300;0,8..60,400;0,8..60,600;1,8..60,300;1,8..60,400&display=swap" rel="stylesheet">

<style>
  /* ── Design Tokens ── */
  :root {
    --emerald-400: #34d399;
    --emerald-500: #10b981;
    --emerald-600: #059669;
    --emerald-700: #047857;
    --emerald-800: #065f46;
    --paper:       #fbfaf7;
    --paper-soft:  #f4f1ea;
    --stone-200:   #e7e5e4;
    --stone-300:   #d6d3d1;
    --stone-400:   #a8a29e;
    --stone-500:   #78716c;
    --stone-600:   #57534e;
    --stone-700:   #44403c;
    --ink:         #0a0a09;
    --gold:        #c89b3c;
    --clay:        #b85c3c;
    --font-sans:   "Geist", ui-sans-serif, system-ui, -apple-system, sans-serif;
    --font-serif:  "Source Serif 4", Georgia, serif;
    --shadow-1:    0 1px 0 rgba(20,20,18,0.04), 0 1px 2px rgba(20,20,18,0.05);
    --shadow-2:    0 1px 0 rgba(20,20,18,0.04), 0 4px 12px rgba(20,20,18,0.06);
  }

  /* ── Reset ── */
  *, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: var(--font-sans);
    background: var(--paper);
    color: var(--ink);
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  /* ── Hero Section ── */
  .sn-hero {
    position: relative;
    width: 100%;
    height: 100svh;
    min-height: 600px;
    background: var(--ink);
    overflow: hidden;
    display: flex;
    align-items: center;
  }

  .sn-hero__video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity 0.8s ease;
  }

  .sn-hero.hero-media-ready .sn-hero__video {
    opacity: 0.38;
  }

  .sn-hero__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
      to bottom,
      rgba(10,10,9,0.55) 0%,
      rgba(10,10,9,0.30) 40%,
      rgba(10,10,9,0.70) 100%
    );
    pointer-events: none;
  }

  .sn-hero__glow {
    position: absolute;
    inset: 0;
    background: radial-gradient(
      ellipse 60% 50% at 50% 60%,
      rgba(16,185,129,0.14) 0%,
      transparent 72%
    );
    pointer-events: none;
  }

  .sn-hero__content {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    padding-top: 5rem;
  }

  .sn-hero__badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.35rem 0.9rem;
    border-radius: 999px;
    border: 1px solid rgba(255,255,255,0.18);
    background: rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.72);
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    backdrop-filter: blur(8px);
    margin-bottom: 1.75rem;
  }

  .sn-hero__badge-dot {
    width: 6px;
    height: 6px;
    border-radius: 999px;
    background: var(--emerald-400);
  }

  .sn-hero__h1 {
    font-family: var(--font-sans);
    font-weight: 300;
    font-size: clamp(2.6rem, 6vw, 5.2rem);
    line-height: 1.05;
    letter-spacing: -0.04em;
    color: #ffffff;
    max-width: 14ch;
    margin-bottom: 1.5rem;
  }

  .sn-hero__h1 em {
    font-style: normal;
    color: var(--emerald-400);
  }

  .sn-hero__deck {
    font-size: clamp(1rem, 1.6vw, 1.18rem);
    line-height: 1.7;
    color: rgba(255,255,255,0.68);
    max-width: 44ch;
    margin-bottom: 2.25rem;
  }

  .sn-hero__buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-bottom: 3rem;
  }

  .sn-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.75rem;
    border-radius: 999px;
    background: var(--emerald-500);
    color: #ffffff;
    font-family: var(--font-sans);
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    transition: background 0.15s ease;
    border: none;
    cursor: pointer;
  }

  .sn-btn-primary:hover {
    background: var(--emerald-600);
  }

  .sn-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.75rem;
    border-radius: 999px;
    background: transparent;
    color: rgba(255,255,255,0.84);
    font-family: var(--font-sans);
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.28);
    transition: border-color 0.15s ease, color 0.15s ease;
    cursor: pointer;
  }

  .sn-btn-outline:hover {
    border-color: rgba(255,255,255,0.54);
    color: #ffffff;
  }

  .sn-hero__meta {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem 1.5rem;
  }

  .sn-hero__meta span {
    font-size: 0.72rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.42);
  }

  /* ── Shared Section Utilities ── */
  .sn-section {
    padding: 6rem 2rem;
  }

  .sn-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  .sn-eyebrow {
    font-family: var(--font-sans);
    font-size: 0.68rem;
    font-weight: 600;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--stone-500);
    margin-bottom: 1rem;
  }

  .sn-eyebrow--gold {
    color: var(--gold);
  }

  .sn-eyebrow--emerald {
    color: var(--emerald-500);
  }

  .sn-h2 {
    font-family: var(--font-sans);
    font-weight: 300;
    font-size: clamp(1.9rem, 4vw, 3rem);
    letter-spacing: -0.03em;
    line-height: 1.1;
    color: var(--ink);
    margin-bottom: 1rem;
  }

  .sn-h2--white {
    color: #ffffff;
  }

  .sn-card {
    background: #ffffff;
    border: 1px solid var(--stone-200);
    border-radius: 18px;
    box-shadow: var(--shadow-1);
    transition: box-shadow 0.15s ease;
  }

  .sn-card:hover {
    box-shadow: var(--shadow-2);
  }

  /* ── Dark Ink Button (for light backgrounds) ── */
  .sn-btn-ink {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.75rem;
    border-radius: 999px;
    background: var(--ink);
    color: #ffffff;
    font-family: var(--font-sans);
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    border: none;
    transition: background 0.15s ease;
    cursor: pointer;
  }

  .sn-btn-ink:hover {
    background: #1a1a18;
  }

  @media (max-width: 640px) {
    .sn-section {
      padding: 4rem 1.25rem;
    }

    .sn-hero__content {
      padding: 0 1.25rem;
      padding-top: 4.5rem;
    }
  }
</style>
@endpush

@section('content')
    <x-header :transparent="true" />

    @include('pages.sections.hero')
    @include('pages.sections.metrics')
    @include('pages.sections.cooperative')
    @include('pages.sections.offerings')
    @include('pages.sections.ecosystem')
    @include('pages.sections.founder-quote')
    @include('pages.sections.pricing')
    @include('pages.sections.blog')
    @include('pages.sections.team')

@endsection

@push('scripts')
<style>
  /* ── Dark Mode Overrides ── */
  .dark body {
    background: #0a0a0a;
    color: #f5f5f4;
  }

  /* Section backgrounds */
  .dark .sn-blog-section,
  .dark .sn-coop,
  .dark .sn-build,
  .dark .sn-products,
  .dark .sn-pricing,
  .dark .sn-team,
  .dark .sn-investor {
    background: #0a0a0a;
    border-color: rgba(255,255,255,0.08);
  }

  /* Headings */
  .dark .sn-h2,
  .dark .sn-coop__h2,
  .dark .sn-build__h2,
  .dark .sn-investor__h3,
  .dark .sn-team-member__name,
  .dark .sn-product-card__title,
  .dark .sn-pricing-card__title,
  .dark .sn-blog-card__title {
    color: #f5f5f4;
  }

  /* Cards */
  .dark .sn-card,
  .dark .sn-coop__card,
  .dark .sn-product-card,
  .dark .sn-pricing-card,
  .dark .sn-blog-card {
    background: #171717;
    border-color: rgba(255,255,255,0.08);
  }

  .dark .sn-blog-featured:hover {
    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
  }

  /* Eyebrows & muted labels */
  .dark .sn-eyebrow {
    color: var(--stone-400);
  }

  .dark .sn-coop__card-title,
  .dark .sn-build__item-label,
  .dark .sn-pricing-card__badge,
  .dark .sn-blog-card__category,
  .dark .sn-blog-card__meta {
    color: #a8a29e;
  }

  /* Body / prose text */
  .dark .sn-coop__prose p,
  .dark .sn-coop__list li,
  .dark .sn-build__item-value,
  .dark .sn-investor__body,
  .dark .sn-team-member__role,
  .dark .sn-team-member__bio,
  .dark .sn-products__subtext,
  .dark .sn-product-card__body,
  .dark .sn-pricing-card__body,
  .dark .sn-blog__subtext {
    color: #a8a29e;
  }

  /* Links */
  .dark .sn-product-card__link,
  .dark .sn-pricing-card__link,
  .dark .sn-pricing__see-all,
  .dark .sn-blog__see-all {
    color: #f5f5f4;
  }

  .dark .sn-product-card__link:hover {
    color: var(--emerald-400);
  }

  .dark .sn-pricing-card__link:hover {
    background: rgba(255,255,255,0.05);
    border-color: rgba(255,255,255,0.15);
  }

  .dark .sn-pricing__see-all:hover,
  .dark .sn-blog__see-all:hover {
    color: #f5f5f4;
  }

  /* Grids & borders */
  .dark .sn-build__grid,
  .dark .sn-build__item {
    border-color: rgba(255,255,255,0.08);
  }

  /* Empty state */
  .dark .sn-blog__empty {
    color: #78716c;
  }

  /* Placeholder card */
  .dark .sn-product-card--placeholder .sn-product-card__title {
    color: #57534e;
  }
</style>
<script>
(function () {
    var hv = document.getElementById('hero-video');
    var hero = document.getElementById('hero');
    if (!hv) return;

    hv.muted = true;
    hv.setAttribute('playsinline', '');
    hv.setAttribute('webkit-playsinline', '');

    var markReady = function () {
        if (hero) hero.classList.add('hero-media-ready');
    };

    hv.addEventListener('playing', markReady, { once: true });
    hv.addEventListener('canplay', markReady, { once: true });

    var tryPlay = function () {
        try {
            var p = hv.play();
            if (p && typeof p.catch === 'function') p.catch(function () {});
        } catch (_) {}
    };

    if (hv.readyState >= 2) {
        tryPlay();
    } else {
        hv.addEventListener('canplay', tryPlay, { once: true });
    }

    window.addEventListener('touchstart', function onTouch() {
        tryPlay();
        window.removeEventListener('touchstart', onTouch);
    }, { once: true, passive: true });
}());
</script>
@endpush
