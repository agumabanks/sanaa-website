@extends('layouts.landing')

@section('title', 'Sanaa Co. — Finance, Commerce, and Logistics for African Business')

@section('hide_header', true)

@section('seo_title', 'Sanaa Co. — Finance, Commerce, and Logistics for African Business')
@section('seo_description', 'Sanaa is a member-owned African economic ecosystem. We finance businesses through our cooperative, connect them to markets on Soko 24, move goods via Baraka 24, and run their software on Sanaa infrastructure. Built in Uganda since 2021.')
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
  "sameAs": [
    "https://twitter.com/sanaaco",
    "https://facebook.com/sanaaco"
  ],
  "description": "Sanaa finances, connects, moves, and powers African business through a cooperative, commerce, logistics, and infrastructure stack built in Uganda since 2021.",
  "foundingDate": "2021",
  "areaServed": [
    "Uganda",
    "Democratic Republic of the Congo"
  ]
}
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
@verbatim
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --pure-black: #000000;
        --soft-black: #0a0a0a;
        --dark-gray: #1a1a1a;
        --medium-gray: #2a2a2a;
        --light-gray: #8a8a8a;
        --white: #ffffff;
        --accent: #ffffff;
        --emerald: #10b981;
        --emerald-light: #34d399;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Inter', 'Segoe UI', sans-serif;
        background: var(--pure-black);
        color: var(--white);
        overflow-x: hidden;
        scroll-behavior: smooth;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* Custom Cursor */
    .cursor {
        width: 20px;
        height: 20px;
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        position: fixed;
        pointer-events: none;
        z-index: 9999;
        transition: all 0.1s ease;
        mix-blend-mode: difference;
    }

    .cursor-follower {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        position: fixed;
        pointer-events: none;
        z-index: 9998;
        transition: all 0.3s ease;
    }

    .cursor.hover {
        transform: scale(2);
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--emerald);
    }

    /* Premium Loading Screen */
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: var(--pure-black);
        z-index: 10000;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 1s cubic-bezier(0.4, 0, 0.2, 1), visibility 1s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .loader.hidden {
        opacity: 0;
        visibility: hidden;
    }

    .loader-content {
        text-align: center;
        position: relative;
    }

    .loader-logo {
        font-size: 5rem;
        font-weight: 100;
        letter-spacing: 0.8rem;
        opacity: 0;
        animation: fadeInUp 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        background: linear-gradient(90deg, var(--white), var(--emerald-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .progress-bar {
        width: 300px;
        height: 1px;
        background: rgba(255, 255, 255, 0.05);
        margin: 3rem auto 1rem;
        overflow: hidden;
        border-radius: 1px;
    }

    .progress {
        height: 100%;
        background: linear-gradient(90deg, var(--emerald), var(--emerald-light));
        width: 0;
        transition: width 2s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 0 20px rgba(16, 185, 129, 0.5);
    }

    .loader-text {
        font-size: 0.75rem;
        font-weight: 200;
        letter-spacing: 0.2rem;
        color: var(--light-gray);
        opacity: 0;
        animation: fadeIn 0.5s ease 0.5s forwards;
        text-transform: uppercase;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }


    /* Enhanced Hero Section */
    .hero-premium {
        min-height: 100svh;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.4;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(180deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.2) 40%, rgba(0, 0, 0, 0.85) 100%),
            radial-gradient(circle at 50% 35%, rgba(6, 8, 12, 0.55), transparent 60%);
    }

    .hero-particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        width: 2px;
        height: 2px;
        background: rgba(16, 185, 129, 0.5);
        border-radius: 50%;
        animation: float 20s infinite linear;
    }

    @keyframes float {
        from {
            transform: translateY(100vh) translateX(0);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        to {
            transform: translateY(-100vh) translateX(100px);
            opacity: 0;
        }
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        width: min(100%, 1120px);
        max-width: none;
        padding: 10.5rem 1.5rem 7rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.4rem;
        margin-top: 0;
    }

    .hero-eyebrow {
        font-size: 0.85rem;
        letter-spacing: 0.5em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 0.5rem;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
    }

    .hero-eyebrow::before,
    .hero-eyebrow::after {
        content: '';
        width: 40px;
        height: 1px;
        background: rgba(255, 255, 255, 0.2);
    }

    .hero-insight {
        margin: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.03);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 1.5rem;
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.05rem;
        line-height: 1.6;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        text-align: center;
        font-weight: 300;
    }

    .hero-insight span {
        font-size: 0.85rem;
        letter-spacing: 0.4em;
        color: rgba(255, 255, 255, 0.5);
        text-transform: uppercase;
    }

    .hero-title {
        max-width: 11ch;
        font-size: clamp(3.7rem, 8vw, 6.7rem);
        font-weight: 100;
        letter-spacing: -0.055em;
        line-height: 0.9;
        margin-bottom: 0;
        opacity: 0;
        animation: revealText 1s cubic-bezier(0.4, 0, 0.2, 1) 0.5s forwards;
        filter: drop-shadow(0 24px 42px rgba(0, 0, 0, 0.75));
    }

    .hero-title-gradient {
        background: linear-gradient(135deg, var(--white) 0%, var(--emerald-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 4px 25px rgba(0, 0, 0, 0.35);
    }

    @keyframes revealText {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-subtitle {
        font-size: 1.08rem;
        font-weight: 300;
        letter-spacing: 0.01em;
        color: rgba(255, 255, 255, 0.78);
        margin-bottom: 0;
        opacity: 0;
        animation: fadeInUp 1s ease 1s forwards;
        max-width: 60ch;
        margin-left: 0;
        margin-right: 0;
        line-height: 1.75;
        text-shadow: 0 8px 30px rgba(0, 0, 0, 0.8);
        position: relative;
    }

    .hero-subtitle::before {
        content: '';
        position: absolute;
        inset: -1rem -1.5rem;
        background: linear-gradient(120deg, rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.2));
        border-radius: 999px;
        filter: blur(30px);
        z-index: -1;
    }

    .hero-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: flex-start;
        flex-wrap: wrap;
        opacity: 0;
        animation: fadeInUp 1s ease 1.5s forwards;
    }

    .btn-cta {
        padding: 1rem 3rem;
        background: var(--emerald);
        color: var(--pure-black);
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 500;
        letter-spacing: 0.05rem;
        border-radius: 50px;
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        display: inline-block;
    }

    .btn-cta::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: var(--emerald-light);
        transition: left 0.5s ease;
    }

    .btn-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
    }

    .btn-cta:hover::before {
        left: 0;
    }

    .btn-cta span {
        position: relative;
        z-index: 1;
    }

    .btn-cta-outline {
        padding: 1rem 3rem;
        background: transparent;
        color: var(--white);
        border: 1px solid rgba(255, 255, 255, 0.3);
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 400;
        letter-spacing: 0.05rem;
        border-radius: 50px;
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        cursor: pointer;
        display: inline-block;
    }

    .btn-cta-outline:hover {
        background: var(--white);
        color: var(--pure-black);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
    }

    @media (max-width: 768px) {
        .hero-premium {
            height: auto;
            min-height: auto;
            padding: 7.25rem 0 3rem;
        }

        .hero-content {
            padding: 0 1.25rem;
            gap: 1.15rem;
        }

        .hero-title {
            max-width: 9ch;
            font-size: clamp(2.9rem, 13vw, 4.75rem);
            line-height: 0.96;
        }

        .hero-panel {
            padding: 1.5rem 1.35rem;
            border-radius: 24px;
            text-align: center;
            align-items: center;
        }

        .hero-insight {
            padding: 1rem 1.25rem;
        }

        .hero-subtitle {
            max-width: 100%;
            font-size: 1rem;
            text-align: center;
        }

        .hero-buttons {
            justify-content: center;
        }

        .hero-buttons .btn-cta,
        .hero-buttons .btn-cta-outline {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .hero-eyebrow {
            letter-spacing: 0.35em;
            font-size: 0.7rem;
        }

        .hero-subtitle {
            font-size: 1rem;
            letter-spacing: 0.05rem;
        }

        .hero-panel {
            margin: 1rem auto 0;
        }
    }

    /* Scroll Indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        animation: fadeInUp 1s ease 2s forwards, bounce 2s ease-in-out 3s infinite;
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateX(-50%) translateY(0);
        }
        50% {
            transform: translateX(-50%) translateY(-10px);
        }
    }

    .scroll-line {
        width: 1px;
        height: 60px;
        background: linear-gradient(to bottom, var(--emerald), transparent);
        margin: 0 auto;
    }

    /* Premium Services Section */
    .services-premium {
        padding: 8rem 2rem;
        background: var(--pure-black);
        position: relative;
        overflow: hidden;
    }

    .services-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 200%;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.3), transparent);
    }

    .section-header {
        text-align: center;
        margin-bottom: 5rem;
    }

    .section-title {
        font-size: 3rem;
        font-weight: 300; /* increased for better readability */
        letter-spacing: -0.02em;
        margin-bottom: 1rem;
        color: var(--white); /* ensure bright white */
        text-shadow: 0 1px 0 rgba(255, 255, 255, 0.05), 0 0 24px rgba(255, 255, 255, 0.08);
        opacity: 0;
        transform: translateY(30px);
    }

    .section-title.visible {
        animation: fadeInUp 1s ease forwards;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .service-card {
        padding: 3rem;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.01));
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        opacity: 0;
        transform: translateY(50px);
        cursor: pointer;
    }

    .service-card.visible {
        animation: fadeInUp 1s ease forwards;
        animation-delay: calc(var(--delay) * 0.1s);
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at var(--x) var(--y), rgba(16, 185, 129, 0.1), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .service-card:hover::before {
        opacity: 1;
    }

    .service-card:hover {
        transform: translateY(-10px);
        border-color: rgba(16, 185, 129, 0.3);
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), rgba(255, 255, 255, 0.02));
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.1);
    }

    .service-icon {
        width: 60px;
        height: 60px;
        margin-bottom: 2rem;
        color: var(--emerald);
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .service-card:hover .service-icon {
        transform: scale(1.1) rotate(5deg);
        opacity: 1;
    }

    .service-title {
        font-size: 1.5rem;
        font-weight: 400; /* clearer weight for readability */
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
        color: var(--white);
        text-shadow: 0 1px 0 rgba(255,255,255,0.05), 0 0 16px rgba(255,255,255,0.08);
    }

    .service-description {
        font-size: 0.95rem;
        line-height: 1.6;
        color: var(--light-gray);
        font-weight: 300;
    }

    .service-link {
        display: inline-block;
        margin-top: 1.5rem;
        color: var(--emerald);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 400;
        letter-spacing: 0.05rem;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .service-card:hover .service-link {
        opacity: 1;
        transform: translateX(5px);
    }

    .view-all-link:hover {
        background: rgba(255,255,255,0.05);
        border-color: rgba(255,255,255,0.4);
        transform: translateX(5px);
    }

    /* Premium Team Section */
    .team-premium {
        padding: 8rem 2rem;
        background: linear-gradient(180deg, var(--pure-black) 0%, var(--soft-black) 100%);
        position: relative;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 3rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .team-member {
        text-align: center;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.5s ease;
    }

    .team-member.visible {
        animation: fadeInUp 1s ease forwards;
        animation-delay: calc(var(--delay) * 0.15s);
    }

    .member-image-container {
        position: relative;
        width: 200px;
        height: 200px;
        margin: 0 auto 2rem;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid rgba(16, 185, 129, 0.2);
        transition: all 0.5s ease;
    }

    .member-image-container:hover {
        border-color: var(--emerald);
        transform: scale(1.05);
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.2);
    }

    .member-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: filter 0.5s ease;
    }

    .member-image-container:hover .member-image {
        filter: grayscale(0%);
    }

    .member-overlay {
        position: absolute;
        inset: 0;
        background: rgba(16, 185, 129, 0.9);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.5s ease;
        padding: 1rem;
    }

    .member-image-container:hover .member-overlay {
        opacity: 1;
    }

    .member-name {
        font-size: 1.5rem;
        font-weight: 400; /* boost contrast */
        margin-bottom: 0.5rem;
        letter-spacing: -0.02em;
        color: var(--white);
        text-shadow: 0 1px 0 rgba(255,255,255,0.05);
    }

    .member-title {
        font-size: 0.9rem;
        color: var(--light-gray);
        font-weight: 300;
        letter-spacing: 0.05rem;
    }

    .member-bio {
        color: var(--white);
        font-size: 0.85rem;
        line-height: 1.4;
        font-weight: 300;
    }

    /* Premium Products Section */
    .products-premium {
        padding: 8rem 2rem;
        background: var(--pure-black);
        position: relative;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .product-card-premium {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        cursor: pointer;
        opacity: 0;
        transform: translateY(30px);
    }

    .product-card-premium.visible {
        animation: fadeInUp 0.8s ease forwards;
        animation-delay: calc(var(--delay) * 0.1s);
    }

    .product-card-premium:hover {
        transform: translateY(-10px) scale(1.02);
        border-color: rgba(16, 185, 129, 0.3);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
    }

    .product-image-wrapper {
        position: relative;
        height: 250px;
        overflow: hidden;
        background: linear-gradient(135deg, var(--dark-gray), var(--soft-black));
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .product-card-premium:hover .product-image {
        transform: scale(1.1);
    }

    .product-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.5rem 1rem;
        background: var(--emerald);
        color: var(--pure-black);
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 50px;
        letter-spacing: 0.05rem;
    }

    .product-info {
        padding: 1.5rem;
        background: #ffffff; /* ensure readability for black text */
        color: var(--pure-black);
        border-top: 1px solid rgba(0,0,0,0.05);
    }

    .product-name {
        font-size: 1.1rem;
        font-weight: 500; /* clearer */
        margin-bottom: 0.5rem;
        letter-spacing: -0.02em;
        line-height: 1.3;
        color: var(--pure-black); /* keep names black */
        /* Clamp to 2 lines for consistent cards */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-word;
        min-height: calc(1.3em * 2);
    }

    .product-price {
        display: flex;
        align-items: center;
        justify-content: center; /* center prices horizontally */
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .price-current {
        font-size: 1.5rem;
        font-weight: 300;
        color: var(--emerald);
    }

    .price-original {
        font-size: 1rem;
        color: var(--light-gray);
        text-decoration: line-through;
        opacity: 0.6;
    }

    .product-action {
        padding: 0.75rem 1.5rem;
        background: transparent;
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: var(--emerald);
        text-align: center;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 400;
        letter-spacing: 0.05rem;
        transition: all 0.3s ease;
        cursor: pointer;
        width: 100%;
    }

    .product-action:hover {
        background: var(--emerald);
        color: var(--pure-black);
        transform: translateY(-2px);
    }

    /* Product Modal Premium */
    .modal-premium {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        backdrop-filter: blur(20px);
        z-index: 9000;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .modal-premium.show {
        display: flex;
        opacity: 1;
    }

    .modal-content-premium {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        max-width: 900px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        padding: 3rem;
    }

    .modal-close {
        position: absolute;
        top: 2rem;
        right: 2rem;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .modal-close:hover {
        background: var(--emerald);
        transform: rotate(90deg);
    }

    .modal-content-body {
        display: none;
    }

    .modal-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2.5rem;
        align-items: flex-start;
    }

    .modal-media {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 18px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #modalThumbnail {
        width: 100%;
        height: auto;
        border-radius: 14px;
        object-fit: cover;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
    }

    .modal-details {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        color: var(--white);
    }

    .modal-product-name {
        font-size: 2rem;
        letter-spacing: -0.02em;
        color: var(--white);
    }

    .modal-eyebrow {
        font-size: 0.75rem;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 0.5rem;
    }

    .modal-price-stack {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    #modalPrice {
        font-size: 1.75rem;
        font-weight: 600;
        color: var(--white);
    }

    .modal-discount {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.7);
    }

    #modalDiscountPrice {
        text-decoration: line-through;
        opacity: 0.75;
        color: rgba(255, 255, 255, 0.6);
    }

    #modalDiscountBadge {
        padding: 0.35rem 0.8rem;
        border-radius: 999px;
        background: rgba(16, 185, 129, 0.2);
        color: var(--emerald);
        font-size: 0.85rem;
        font-weight: 500;
    }

    #modalProductDescription {
        line-height: 1.7;
        color: var(--light-gray);
    }

    .modal-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .modal-error {
        display: none;
        text-align: center;
        padding: 2rem;
        border-radius: 18px;
        border: 1px solid rgba(239, 68, 68, 0.3);
        background: rgba(239, 68, 68, 0.05);
        color: #fecaca;
        margin-top: 1.5rem;
    }

    .modal-error p {
        margin-bottom: 1rem;
    }

    /* Join CTA */
    .join-section {
        position: relative;
        padding: 6rem 1rem 7rem;
        background: radial-gradient(circle at 20% 20%, rgba(16, 185, 129, 0.35), transparent 55%),
                    radial-gradient(circle at 80% 30%, rgba(6, 182, 212, 0.35), transparent 50%),
                    var(--pure-black);
    }

    .join-card {
        max-width: 1100px;
        margin: 0 auto;
        padding: 3.5rem;
        border-radius: 36px;
        border: 1px solid rgba(255, 255, 255, 0.06);
        background: rgba(12, 12, 12, 0.7);
        backdrop-filter: blur(30px);
        position: relative;
        overflow: hidden;
    }

    .join-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, rgba(16, 185, 129, 0.1), rgba(6, 182, 212, 0.08));
        mix-blend-mode: lighten;
        pointer-events: none;
    }

    .join-eyebrow {
        font-size: 0.85rem;
        letter-spacing: 0.45em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.45);
        margin-bottom: 1rem;
    }

    .join-title {
        font-size: clamp(2.75rem, 5vw, 4.5rem);
        line-height: 1.1;
        color: var(--white);
        margin-bottom: 1.5rem;
    }

    .join-title span {
        color: var(--emerald);
        font-weight: 500;
    }

    .join-subtitle {
        color: rgba(255, 255, 255, 0.68);
        font-size: 1.1rem;
        max-width: 620px;
    }

    .join-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
        position: relative;
        z-index: 1;
    }

    .join-cta-panel {
        border-radius: 26px;
        padding: 2.5rem;
        background: linear-gradient(135deg, rgba(16,185,129,0.15), rgba(6,182,212,0.05));
        border: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .join-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .join-actions .btn-cta,
    .join-actions .btn-cta-outline {
        flex: 1;
        min-width: 140px;
        justify-content: center;
    }

    .join-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .join-meta span {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .join-meta span::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--emerald);
    }

    .join-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
    }

    .join-stat-card {
        padding: 1.5rem;
        border-radius: 22px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        background: rgba(255, 255, 255, 0.02);
        display: flex;
        flex-direction: column;
        gap: 0.45rem;
    }

    .join-stat-value {
        font-size: 2rem;
        font-weight: 600;
        color: var(--white);
    }

    .join-stat-label {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.6);
    }

    .join-logos {
        margin-top: 2.5rem;
        padding-top: 2.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.45);
        font-size: 0.95rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
    }

    @media (max-width: 768px) {
        .join-card {
            padding: 2.25rem;
        }

        .join-actions .btn-cta,
        .join-actions .btn-cta-outline {
            flex: 1 1 100%;
        }

        .join-meta {
            flex-direction: column;
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-title {
            font-size: clamp(2.5rem, 8vw, 4rem);
        }

        .services-grid,
        .team-grid {
            grid-template-columns: 1fr;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }
    }

    /* Reveal Animation */
    .reveal-element {
        opacity: 0;
        transform: translateY(30px);
        transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .reveal-element.revealed {
        opacity: 1;
        transform: translateY(0);
    }

    /* Loading Skeleton */
    .skeleton {
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.05) 25%, rgba(255, 255, 255, 0.1) 50%, rgba(255, 255, 255, 0.05) 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
        border-radius: 10px;
    }

    @keyframes loading {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: -200% 0;
        }
    }

    .skeleton-img {
        width: 100%;
        height: 200px;
        border-radius: 10px;
    }

    .skeleton-title {
        height: 20px;
        width: 70%;
        margin-bottom: 10px;
    }

    .skeleton-price {
        height: 25px;
        width: 40%;
    }

    /* Disable decorative cursor on touch devices */
    @media (pointer: coarse) {
        .cursor,
        .cursor-follower { display: none; }
    }
</style>
@endverbatim

<style>
  /* Industries + Pricing (Square-inspired, Sanaa colors) */
  .industry-premium, .pricing-premium { background: #000; position: relative; }

  .hero-panel {
    margin: 1rem auto 0;
    max-width: 760px;
    width: 100%;
    background: linear-gradient(160deg, rgba(10, 10, 10, 0.84), rgba(22, 22, 22, 0.62));
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 28px;
    padding: 2rem 2.15rem;
    backdrop-filter: blur(40px);
    -webkit-backdrop-filter: blur(40px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5), inset 0 0 0 1px rgba(255, 255, 255, 0.05);
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    align-items: flex-start;
    text-align: left;
    transform: translateY(0);
    transition: transform 0.5s ease, box-shadow 0.5s ease;
    position: relative;
  }

  .hero-panel::before {
    content: '';
    position: absolute;
    top: 0;
    left: 2rem;
    width: 88px;
    height: 1px;
    background: linear-gradient(90deg, rgba(16, 185, 129, 0.9), rgba(16, 185, 129, 0));
  }
  
  .hero-panel:hover {
      transform: translateY(-5px);
      box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6), inset 0 0 0 1px rgba(255, 255, 255, 0.1);
  }

  /* Mission Section */
  .mission-premium {
    padding: 6rem 2rem;
    background: #000;
    position: relative;
    text-align: center;
  }

  .mission-container {
    max-width: 800px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 3rem;
    align-items: center;
  }

  .mission-subtitle {
    font-size: 1.5rem;
    font-weight: 300;
    line-height: 1.5;
    color: #fff;
    letter-spacing: -0.02em;
  }

  .mission-insight {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 2rem;
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.1rem;
    line-height: 1.6;
    max-width: 700px;
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .mission-insight span {
    display: block;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    color: #10b981;
    margin-bottom: 0.5rem;
  }

  .section-eyebrow { color: #a3a3a3; font-size: .8rem; letter-spacing: .12em; text-transform: uppercase; }
  .industry-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px,1fr)); gap: 1.25rem; max-width: 1200px; margin: 0 auto; }
  .industry-card { position: relative; border: 1px solid #1f2937; border-radius: 16px; overflow: hidden; background: linear-gradient(135deg, rgba(16,185,129,.08), rgba(16,185,129,.02)); transition: transform .35s ease, border-color .35s ease, box-shadow .35s ease; }
  .industry-card:hover { transform: translateY(-6px); border-color: rgba(16,185,129,.35); box-shadow: 0 18px 40px rgba(16,185,129,.12); }
  .industry-media { height: 180px; background: #0b0b0b; display: grid; place-items: center; }
  .industry-title { color: #fff; font-weight: 600; font-size: 1.1rem; }
  .industry-meta { color: #9ca3af; font-size: .85rem; }
  .industry-body { padding: 1rem 1rem 1.25rem; display:flex; align-items:center; justify-content:space-between; gap: .75rem; }
  .industry-link { color: #10b981; font-weight: 500; text-decoration: none; }

  .pricing-wrap { max-width: 1200px; margin: 0 auto; display: grid; gap: 1.25rem; grid-template-columns: repeat(auto-fit, minmax(260px,1fr)); }
  .pricing-card { border: 1px solid #1f2937; border-radius: 18px; background: linear-gradient(135deg, rgba(255,255,255,.04), rgba(255,255,255,.02)); padding: 1.5rem; color: #fff; transition: transform .35s ease, border-color .35s ease, box-shadow .35s ease; }
  .pricing-card:hover { transform: translateY(-6px); border-color: rgba(16,185,129,.35); box-shadow: 0 18px 40px rgba(16,185,129,.12); }
  .price-big { font-size: 2.25rem; font-weight: 200; letter-spacing: -.02em; }
  .price-unit { color: #9ca3af; font-size: .9rem; }
  .feature { display:flex; align-items:center; gap:.5rem; color:#d1d5db; font-size: .95rem; }
  .dot { width: 6px; height: 6px; background:#10b981; border-radius: 999px; }
  .btn-ghost { display:inline-block; border:1px solid #2f3a46; color:#10b981; padding:.7rem 1.1rem; border-radius: 999px; text-decoration:none; font-weight:600; }
  .btn-solid { display:inline-block; background:#10b981; color:#000; padding:.7rem 1.1rem; border-radius: 999px; text-decoration:none; font-weight:700; }
  .badge { display:inline-block; font-size:.7rem; letter-spacing:.08em; text-transform:uppercase; color:#000; background:#10b981; padding:.25rem .5rem; border-radius:999px; }

  @media (max-width: 768px) {
    .industry-media { height: 140px; }
    .price-big { font-size: 1.75rem; }
  }

  .hero-stats-section {
    padding: 0 2rem 5rem;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.96), #050505 100%);
  }

  .hero-stats-wrap {
    max-width: 1200px;
    margin: -1rem auto 0;
    padding: 1.25rem;
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 30px;
    background: rgba(14, 14, 14, 0.9);
    backdrop-filter: blur(20px);
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 0.85rem;
    position: relative;
    z-index: 3;
    box-shadow: 0 24px 60px rgba(0, 0, 0, 0.35);
  }

  .hero-stats-wrap::before {
    content: '';
    position: absolute;
    top: 0;
    left: 2rem;
    right: 2rem;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.45), transparent);
  }

  .hero-stat {
    min-height: 108px;
    padding: 1.15rem 1.1rem;
    border-radius: 20px;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.045), rgba(255, 255, 255, 0.02));
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: transform 0.35s ease, border-color 0.35s ease, background 0.35s ease;
  }

  .hero-stat:hover {
    transform: translateY(-4px);
    border-color: rgba(16, 185, 129, 0.22);
    background: linear-gradient(180deg, rgba(16, 185, 129, 0.12), rgba(255, 255, 255, 0.03));
  }

  .hero-stat-value {
    color: var(--white);
    font-size: 1.5rem;
    font-weight: 600;
    line-height: 1.2;
    margin-bottom: 0.45rem;
  }

  .hero-stat-label {
    color: rgba(255, 255, 255, 0.62);
    font-size: 0.9rem;
    line-height: 1.45;
  }

  .institutional-section {
    padding: 7rem 2rem;
    background: linear-gradient(180deg, #040404 0%, #0b1110 100%);
  }

  .institutional-shell {
    max-width: 1200px;
    margin: 0 auto;
    padding: 3rem;
    border-radius: 32px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background:
      radial-gradient(circle at top right, rgba(16, 185, 129, 0.15), transparent 35%),
      linear-gradient(145deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
    box-shadow: 0 24px 80px rgba(0, 0, 0, 0.35);
  }

  .institutional-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.3fr) minmax(280px, 0.9fr);
    gap: 2rem;
    align-items: start;
  }

  .institutional-copy {
    display: flex;
    flex-direction: column;
    gap: 1.35rem;
  }

  .institutional-copy p {
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.75;
    font-size: 1rem;
  }

  .institutional-panel {
    padding: 1.5rem;
    border-radius: 24px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
  }

  .institutional-panel + .institutional-panel {
    margin-top: 1rem;
  }

  .institutional-panel h3 {
    font-size: 1rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.58);
    margin-bottom: 1rem;
  }

  .institutional-list {
    display: grid;
    gap: 0.85rem;
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .institutional-list li {
    color: rgba(255, 255, 255, 0.88);
    line-height: 1.55;
    padding-left: 1rem;
    position: relative;
  }

  .institutional-list li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0.7rem;
    width: 6px;
    height: 6px;
    border-radius: 999px;
    background: var(--emerald);
  }

  .service-card-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1rem;
  }

  .service-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.4rem 0.8rem;
    border-radius: 999px;
    background: rgba(16, 185, 129, 0.14);
    color: var(--emerald-light);
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
  }

  .service-actions {
    margin-top: auto;
    padding-top: 1.5rem;
  }

  .narrative-section {
    padding: 7rem 2rem;
    background: linear-gradient(180deg, #020202 0%, #08110f 100%);
  }

  .narrative-grid {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(0, 1.2fr) minmax(260px, 0.8fr);
    gap: 2.5rem;
    align-items: start;
  }

  .narrative-copy {
    display: flex;
    flex-direction: column;
    gap: 1.4rem;
  }

  .narrative-copy p {
    color: rgba(255, 255, 255, 0.78);
    line-height: 1.85;
    font-size: 1.02rem;
  }

  .layer-rail {
    padding: 1.75rem;
    border-radius: 28px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background: rgba(255, 255, 255, 0.03);
    display: grid;
    gap: 0.9rem;
    position: sticky;
    top: 6rem;
  }

  .layer-item {
    padding: 1rem 1.15rem;
    border-radius: 18px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.05);
  }

  .layer-title {
    display: block;
    color: var(--white);
    font-weight: 600;
    margin-bottom: 0.35rem;
  }

  .layer-item p {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.92rem;
    line-height: 1.5;
    margin: 0;
  }

  .selector-grid {
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  }

  .selector-card {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .selector-card h3 {
    font-size: 1.4rem;
    color: var(--white);
  }

  .selector-card p {
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.6;
    flex: 1;
  }

  .founder-quote-section {
    padding: 0 2rem 7rem;
    background: #000;
  }

  .founder-quote-card {
    max-width: 980px;
    margin: 0 auto;
    padding: 2.5rem;
    border-radius: 30px;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.04), rgba(16, 185, 129, 0.08));
    border: 1px solid rgba(255, 255, 255, 0.08);
  }

  .founder-quote-card blockquote {
    font-size: clamp(1.6rem, 4vw, 2.5rem);
    line-height: 1.4;
    color: var(--white);
    font-weight: 300;
  }

  .founder-quote-card p {
    margin-top: 1rem;
    color: rgba(255, 255, 255, 0.62);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    font-size: 0.85rem;
  }

  .member-summary {
    margin-top: 1rem;
    color: rgba(255, 255, 255, 0.72);
    line-height: 1.7;
    font-size: 0.95rem;
  }

  @media (max-width: 1024px) {
    .hero-stats-wrap,
    .institutional-grid,
    .narrative-grid {
      grid-template-columns: 1fr;
    }

    .layer-rail {
      position: static;
    }
  }

  @media (max-width: 768px) {
    .hero-stats-section,
    .institutional-section,
    .narrative-section,
    .founder-quote-section {
      padding-left: 1.25rem;
      padding-right: 1.25rem;
    }

    .hero-stats-wrap,
    .institutional-shell,
    .founder-quote-card {
      padding: 1.5rem;
    }

    .hero-stats-wrap {
      margin-top: 0.5rem;
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
  }

  @media (max-width: 540px) {
    .hero-stats-wrap {
      grid-template-columns: 1fr;
    }
  }
</style>
@endpush

@section('content')
    <!-- Custom Cursor -->
    <div class="cursor"></div>
    <div class="cursor-follower"></div>

    <!-- Premium Loading Screen -->
    <div class="loader" id="loader">
        <div class="loader-content">
            <div class="loader-logo">SANAA</div>
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
            </div>
            <p class="loader-text">Built in Uganda</p>
        </div>
    </div>

    <x-header :transparent="true" />

    <div class="menu-toggle-placeholder sm:hidden" id="menuToggle"></div>

    @include('pages.sections.hero')
    @include('pages.sections.metrics')
    @include('pages.sections.cooperative')
    @include('pages.sections.offerings')
    @include('pages.sections.ecosystem')
    @include('pages.sections.pricing')
    @include('pages.sections.blog')
    @include('pages.sections.founder-quote')
    @include('pages.sections.team')

@endsection

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Premium Loading Animation (real resource tracking)
    const progress = document.getElementById('progress');
    const loader = document.getElementById('loader');

    let resourcesLoaded = 0;
    const resourceNodes = document.querySelectorAll('img, video, script[src], link[rel="stylesheet"]');
    const totalResources = resourceNodes.length || 1; // prevent division by zero

    // Helper: play hero video once loader is done
    const playHeroVideo = () => {
        const hv = document.getElementById('hero-video');
        if (!hv) return;

        // Ensure best mobile compatibility
        hv.setAttribute('playsinline', '');
        hv.setAttribute('webkit-playsinline', '');
        hv.muted = true; // required by most mobile browsers for autoplay

        // Set the source now to start fetching only after loader is done
        const srcEl = document.getElementById('hero-video-source');
        if (srcEl && !srcEl.src && srcEl.dataset.src) {
            srcEl.src = srcEl.dataset.src;
        }
        // Kick off network request
        try { hv.load(); } catch (_) {}

        const tryPlay = () => {
            try {
                const p = hv.play();
                if (p && typeof p.catch === 'function') p.catch(() => {});
            } catch (_) {}
        };

        if (hv.readyState >= 2) tryPlay();
        else hv.addEventListener('canplay', tryPlay, { once: true });

        // As a safety net on some mobiles, trigger once on first touch
        const onFirstTouch = () => { tryPlay(); window.removeEventListener('touchstart', onFirstTouch, { capture: false }); };
        window.addEventListener('touchstart', onFirstTouch, { once: true, passive: true });
    };

    const updateProgress = () => {
        const percentage = Math.min(100, (resourcesLoaded / totalResources) * 100);
        if (progress) progress.style.width = percentage + '%';
        if (percentage >= 100 && loader) {
            setTimeout(() => {
                loader.style.opacity = '0';
                document.body.style.overflow = 'visible';
                setTimeout(() => {
                    loader.remove();
                    // Trigger hero video autoplay exactly after loader is gone
                    playHeroVideo();
                }, 500);
            }, 300);
        }
    };

    const markLoaded = (el) => {
        resourcesLoaded++;
        updateProgress();
        // cleanup listeners to avoid double counting
        if (!el) return;
        el.removeEventListener && el.removeEventListener('load', onAnyLoad);
        el.removeEventListener && el.removeEventListener('error', onAnyLoad);
        el.removeEventListener && el.removeEventListener('loadeddata', onAnyLoad);
        el.removeEventListener && el.removeEventListener('loadedmetadata', onAnyLoad);
    };

    const onAnyLoad = function() { markLoaded(this); };

    resourceNodes.forEach((el) => {
        const tag = el.tagName;
        if (tag === 'IMG') {
            if (el.complete) markLoaded(el);
            else { el.addEventListener('load', onAnyLoad); el.addEventListener('error', onAnyLoad); }
        } else if (tag === 'VIDEO') {
            // loadeddata fires when first frame is available
            if (el.readyState >= 2) markLoaded(el);
            else { el.addEventListener('loadeddata', onAnyLoad); el.addEventListener('error', onAnyLoad); }
        } else if (tag === 'SCRIPT') {
            // readyState for older browsers, load for modern
            if (el.readyState === 'complete' || el.readyState === 'loaded') markLoaded(el);
            else { el.addEventListener('load', onAnyLoad); el.addEventListener('error', onAnyLoad); }
        } else if (tag === 'LINK') {
            // stylesheet load event
            if (el.sheet) markLoaded(el);
            else { el.addEventListener('load', onAnyLoad); el.addEventListener('error', onAnyLoad); }
        } else {
            // unknown: count it anyway to avoid hang
            markLoaded(el);
        }
    });

    // Fallback: ensure we finish after window load in case of missing events
    window.addEventListener('load', () => {
        resourcesLoaded = totalResources;
        updateProgress();
        // autoplay is triggered by the loader completion handler above
    });

    // Custom Cursor
    const cursor = document.querySelector('.cursor');
    const follower = document.querySelector('.cursor-follower');
    const links = document.querySelectorAll('a, button, .service-card, .product-card-premium, input');

    document.addEventListener('mousemove', (e) => {
        cursor.style.left = e.clientX + 'px';
        cursor.style.top = e.clientY + 'px';
        
        setTimeout(() => {
            follower.style.left = e.clientX - 10 + 'px';
            follower.style.top = e.clientY - 10 + 'px';
        }, 100);
    });

    links.forEach(link => {
        link.addEventListener('mouseenter', () => {
            cursor.classList.add('hover');
            follower.style.transform = 'scale(2)';
        });
        
        link.addEventListener('mouseleave', () => {
            cursor.classList.remove('hover');
            follower.style.transform = 'scale(1)';
        });
    });

    // Parallax Particles
    const heroParticles = document.querySelector('.hero-particles');
    if (heroParticles) {
        for (let i = 0; i < 50; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 20 + 's';
            particle.style.animationDuration = (Math.random() * 20 + 20) + 's';
            heroParticles.appendChild(particle);
        }
    }

    // Intersection Observer for Animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                if (entry.target.classList.contains('service-card') || 
                    entry.target.classList.contains('team-member') ||
                    entry.target.classList.contains('product-card-premium')) {
                    entry.target.classList.add('visible');
                }
            }
        });
    }, observerOptions);

    // Observe elements
    document.querySelectorAll('.reveal-element, .service-card, .team-member, .product-card-premium').forEach(el => {
        observer.observe(el);
    });

    // Interactive Service Cards - Mouse Follow Effect
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            card.style.setProperty('--x', x + 'px');
            card.style.setProperty('--y', y + 'px');
        });
    });

    // Show products after loading
    setTimeout(() => {
        const loadingContainer = document.getElementById('products-loading');
        const productContainer = document.getElementById('product-container');
        
        if (loadingContainer && productContainer) {
            loadingContainer.style.display = 'none';
            productContainer.style.display = 'grid';
        }
    }, 1500);

    // Initialize Swiper for blog
    if (document.querySelector('.blog-swiper')) {
        new Swiper('.blog-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.blog-swiper-button-next',
                prevEl: '.blog-swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    }
});

// Page Visibility API - Pause animations when tab is not visible
document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        document.querySelectorAll('.particle').forEach(p => {
            p.style.animationPlayState = 'paused';
        });
    } else {
        document.querySelectorAll('.particle').forEach(p => {
            p.style.animationPlayState = 'running';
        });
    }
});
</script>
@endpush
