@extends('layouts.landing')

@section('title', 'Home | ' . config('app.name'))

@section('hide_header', true)

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
        cursor: none;
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
        cursor: none;
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

    /* Premium Navigation */
    nav.premium-nav {
        position: fixed;
        top: 0;
        width: 100%;
        padding: 2rem 4rem;
        z-index: 1000;
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        mix-blend-mode: difference;
    }

    nav.premium-nav.scrolled {
        background: rgba(0, 0, 0, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        padding: 1rem 4rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        mix-blend-mode: normal;
    }

    .nav-container {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 1.5rem;
        font-weight: 200;
        letter-spacing: 0.3rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .nav-links {
        display: flex;
        gap: 3rem;
        list-style: none;
    }

    .nav-link {
        color: var(--white);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 300;
        letter-spacing: 0.05rem;
        transition: all 0.3s ease;
        position: relative;
        cursor: pointer;
    }

    /* Header actions (auth + contact sales) */
    .nav-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .btn-nav {
        padding: 0.5rem 1rem;
        background: var(--emerald);
        color: var(--pure-black);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.02rem;
        border-radius: 999px;
        transition: transform 0.2s ease, box-shadow 0.3s ease, background 0.3s ease;
        white-space: nowrap;
    }

    .btn-nav:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
        background: var(--emerald-light);
    }

    .btn-nav-outline {
        padding: 0.5rem 1rem;
        background: transparent;
        color: var(--white);
        border: 1px solid rgba(255, 255, 255, 0.35);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        letter-spacing: 0.02rem;
        border-radius: 999px;
        transition: transform 0.2s ease, box-shadow 0.3s ease, background 0.3s ease, color 0.3s ease;
        white-space: nowrap;
    }

    .btn-nav-outline:hover {
        background: var(--white);
        color: var(--pure-black);
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(255, 255, 255, 0.15);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 1px;
        background: var(--emerald);
        transition: width 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    /* Enhanced Hero Section */
    .hero-premium {
        height: 100vh;
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
        background: radial-gradient(ellipse at center, transparent 0%, rgba(0, 0, 0, 0.6) 50%, rgba(0, 0, 0, 0.9) 100%);
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
        max-width: 1200px;
        padding: 0 2rem;
    }

    .hero-title {
        font-size: clamp(3rem, 10vw, 7rem);
        font-weight: 100;
        letter-spacing: -0.02em;
        line-height: 0.95;
        margin-bottom: 2rem;
        opacity: 0;
        animation: revealText 1s cubic-bezier(0.4, 0, 0.2, 1) 0.5s forwards;
    }

    .hero-title-gradient {
        background: linear-gradient(135deg, var(--white) 0%, var(--emerald-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    @keyframes revealText {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero-subtitle {
        font-size: 1.25rem;
        font-weight: 200;
        letter-spacing: 0.1rem;
        color: var(--black);
        margin-bottom: 3rem;
        opacity: 0;
        animation: fadeInUp 1s ease 1s forwards;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .hero-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
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

    /* Mobile Menu */
    .menu-toggle {
        display: none;
        flex-direction: column;
        gap: 4px;
        cursor: pointer;
    }

    .menu-line {
        width: 25px;
        height: 1px;
        background: var(--white);
        transition: all 0.3s ease;
    }

    .menu-toggle.active .menu-line:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .menu-toggle.active .menu-line:nth-child(2) {
        opacity: 0;
    }

    .menu-toggle.active .menu-line:nth-child(3) {
        transform: rotate(-45deg) translate(5px, -5px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .menu-toggle {
            display: flex;
        }

        .nav-actions {
            display: none;
        }

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
</style>
@endverbatim
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
            <p class="loader-text">Building the future</p>
        </div>
    </div>

    <!-- Premium Navigation -->
    <nav class="premium-nav" id="navbar">
        <div class="nav-container">
            <a href="{{ url()->current() }}" class="logo" id="home-logo" aria-label="Reload home">
                <img src="{{ asset('storage/images/sanaa-logo-b.svg') }}" alt="Sanaa" style="height: 28px; filter: invert(1);">
            </a>
            <ul class="nav-links">
                <li><a href="#hero" class="nav-link">HOME</a></li>
                <li><a href="#services" class="nav-link">SERVICES</a></li>
                <li><a href="#team" class="nav-link">TEAM</a></li>
                <li><a href="#products" class="nav-link">PRODUCTS</a></li>
                <li><a href="#blog" class="nav-link">BLOG</a></li>
                <li><a href="https://soko.sanaa.co" target="_blank" class="nav-link">SOKO 24</a></li>
            </ul>
            <div class="nav-actions">
                <a href="{{ route('contact') }}" class="btn-nav-outline">Contact Sales</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-nav">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-nav-outline">Sign In</a>
                    <a href="{{ route('register') }}" class="btn-nav">Create Account</a>
                @endauth
            </div>
            <div class="menu-toggle" id="menuToggle">
                <span class="menu-line"></span>
                <span class="menu-line"></span>
                <span class="menu-line"></span>
            </div>
        </div>
    </nav>

    <!-- Enhanced Hero Section -->
    <section id="hero" class="hero-premium">
        <video id="hero-video" autoplay muted loop playsinline webkit-playsinline preload="auto" class="hero-video" poster="{{ asset('storage/images/sanaa.png') }}">
            <source id="hero-video-source" data-src="{{ asset('storage/images/live.mp4') }}" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        <div class="hero-particles"></div>
        
        <div class="hero-content">
            <h1 class="hero-title">
                <span class="hero-title-gradient">Building the future<br>we want</span>
            </h1>
            <p class="hero-subtitle">
                Our mission is to empower businesses with modern digital infrastructure for payments, media and commerce.
            </p>
            <div class="hero-buttons">
                <a href="#services" class="btn-cta">
                    <span>Explore Sanaa</span>
                </a>
                <a href="https://soko.sanaa.co" target="_blank" class="btn-cta-outline">
                    Shop on Soko 24
                </a>
            </div>
        </div>
        
        <div class="scroll-indicator">
            <div class="scroll-line"></div>
        </div>
    </section>

    <!-- Premium Services Section -->
    <section id="services" class="services-premium">
        <div class="section-header">
            <h2 class="section-title reveal-element">Sanaa Products & Services</h2>
        </div>
        <div class="services-grid">
            @php
                try {
                    $offerings = \App\Models\Offering::latest()->take(6)->get();
                } catch (\Throwable $e) {
                    $offerings = collect();
                }
            @endphp
            @forelse($offerings as $index => $offering)
                <div class="service-card" style="--delay: {{ $index + 1 }}">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                    </div>
                    <h3 class="service-title">{{ $offering->title }}</h3>
                    <p class="service-description">{{ $offering->description }}</p>
                    @if($offering->link)
                        <a href="{{ $offering->link }}" target="_blank" class="service-link">Learn More →</a>
                    @endif
                </div>
            @empty
                @for($i = 1; $i <= 3; $i++)
                <div class="service-card" style="--delay: {{ $i }}">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        </svg>
                    </div>
                    <h3 class="service-title">Coming Soon</h3>
                    <p class="service-description">New innovative services are being developed to better serve your business needs.</p>
                </div>
                @endfor
            @endforelse
        </div>
    </section>

    <!-- Premium Team Section -->
    <section id="team" class="team-premium">
        <div class="section-header">
            <h2 class="section-title reveal-element">Meet the Team</h2>
        </div>
        <div class="team-grid">
            @foreach($teamMembers as $index => $member)
            <div class="team-member" style="--delay: {{ $index + 1 }}">
                <div class="member-image-container">
                    @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" class="member-image" loading="lazy">
                    @else
                        <div class="member-image" style="background: linear-gradient(135deg, var(--dark-gray), var(--emerald));"></div>
                    @endif
                    <div class="member-overlay">
                        @if($member->bio)
                            <p class="member-bio">{{ $member->bio }}</p>
                        @endif
                    </div>
                </div>
                <h3 class="member-name">{{ $member->name }}</h3>
                @if($member->title)
                    <p class="member-title">{{ $member->title }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </section>

    <!-- Premium Products Section -->
    <section id="products" class="products-premium">
        <div class="section-header">
            <h2 class="section-title reveal-element">Featured Products</h2>
            <p class="section-subtitle reveal-element" style="color: var(--light-gray); margin-top: 1rem;">Discover our selection of quality products from Soko 24</p>
        </div>
        
        <!-- Loading State -->
        <div id="products-loading" class="products-grid">
            @for ($i = 0; $i < 8; $i++)
                <div class="product-card-premium skeleton">
                    <div class="skeleton-img"></div>
                    <div style="padding: 1.5rem;">
                        <div class="skeleton-title"></div>
                        <div class="skeleton-price"></div>
                    </div>
                </div>
            @endfor
        </div>
        
        <!-- Products Container -->
        <div class="products-grid" id="product-container" style="display: none;">
            @if(isset($sokoProducts['data']) && count($sokoProducts['data']) > 0)
                @foreach(array_slice($sokoProducts['data'], 0, 8) as $index => $product)
                    <div class="product-card-premium" data-product-id="{{ $product['id'] }}" style="--delay: {{ $index + 1 }}">
                        <div class="product-image-wrapper">
                            <img src="{{ $product['thumbnail_image'] }}" alt="{{ $product['name'] }}" class="product-image" loading="lazy" onerror="this.src='/img/placeholder-product.jpg';">
                            @if($product['has_discount'])
                                <span class="product-badge">{{ $product['discount'] }}</span>
                            @endif
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">{{ $product['name'] }}</h3>
                            <div class="product-price">
                                <span class="price-current">{{ str_replace('/=', '', $product['main_price']) }}</span>
                                @if($product['has_discount'])
                                    <span class="price-original">{{ str_replace('/=', '', $product['stroked_price']) }}</span>
                                @endif
                            </div>
                            <button class="product-action quick-view-btn">Quick View</button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        
        <div style="text-align: center; margin-top: 4rem;">
            <a href="https://soko.sanaa.co" class="btn-cta" target="_blank">
                <span>Visit Soko 24</span>
            </a>
        </div>
    </section>

    <!-- Product Modal -->
    <div id="productModal" class="modal-premium">
        <div class="modal-content-premium">
            <button class="modal-close close-modal">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            
            <div id="modal-loading" class="text-center" style="padding: 3rem;">
                <div class="skeleton-img" style="height: 300px; margin-bottom: 2rem;"></div>
                <div class="skeleton-title" style="height: 30px; margin-bottom: 1rem;"></div>
                <div class="skeleton-price" style="height: 20px; width: 30%;"></div>
            </div>
            
            <div id="modal-content" style="display: none;">
                <!-- Modal content will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Premium Blog Section (Keep existing) -->
    <section id="blog" class="relative py-40 bg-black overflow-hidden">
        <!-- Keep the existing premium blog section HTML as is -->
        @includeIf('partials.blog-section')
    </section>


    <section class="relative py-32 bg-black overflow-hidden">
        <!-- Spacer Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-32 flex items-center justify-center">
                <div class="w-1 h-16 bg-gradient-to-b from-emerald-500/20 to-transparent"></div>
            </div>
        </div>
    </section>

    <!-- Join Section with Premium Style -->
    <section class="relative py-32  bg-black overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl aspect-square rounded-full blur-3xl opacity-10 bg-gradient-to-r from-emerald-400 to-cyan-400"></div>
        </div>
        
        <div class="relative max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-5xl md:text-6xl font-thin text-white mb-8 tracking-tight">
                Join the <span class="font-normal">400+</span> businesses<br>
                running with <span class="text-emerald-400">Sanaa</span>
            </h2>
            <div class="flex justify-center gap-4 mb-6">
                <a href="#" class="btn-cta">
                    <span>Get Started</span>
                </a>
                <a href="#" class="btn-cta-outline">
                    Contact Sales
                </a>
            </div>
            <p class="text-sm text-gray-400">*Source: Q1 2023 Earnings Report</p>
        </div>
    </section>


     <section class="relative py-32 bg-black overflow-hidden">
        <!-- Spacer Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-32 flex items-center justify-center">
                <div class="w-1 h-16 bg-gradient-to-b from-emerald-500/20 to-transparent"></div>
            </div>
        </div>
    </section>

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

    // Navbar Scroll Effect
    const navbar = document.getElementById('navbar');
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    });

    // Smooth Scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Mobile Menu Toggle
    const menuToggle = document.getElementById('menuToggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            // Add mobile menu logic here
        });
    }

    // Home logo reloads the page
    const homeLogo = document.getElementById('home-logo');
    if (homeLogo) {
        homeLogo.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.reload();
        });
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

    // Product Modal
    const modal = document.getElementById('productModal');
    const modalLoading = document.getElementById('modal-loading');
    const modalContent = document.getElementById('modal-content');
    
    // Quick View buttons
    document.querySelectorAll('.quick-view-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const card = this.closest('.product-card-premium');
            const productId = card.dataset.productId;
            
            // Show modal
            modal.classList.add('show');
            modalLoading.style.display = 'block';
            modalContent.style.display = 'none';
            
            // Simulate loading product details
            setTimeout(() => {
                modalLoading.style.display = 'none';
                modalContent.style.display = 'block';
                // Add product details here
            }, 1000);
        });
    });

    // Close modal
    document.querySelectorAll('.close-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            modal.classList.remove('show');
        });
    });

    // Close modal on outside click
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('show');
        }
    });

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
