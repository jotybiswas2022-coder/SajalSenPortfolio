@extends('frontend.app')

@section('content')
<style>
    :root {
        --bg-primary: #080b12;
        --bg-secondary: #111827;
        --bg-card: rgba(17, 24, 39, 0.8);
        --accent: #00d9ff;
        --accent-light: #7ce6ff;
        --accent-purple: #00ff88;
        --text-primary: #f1f5f9;
        --text-secondary: #94a3b8;
        --text-muted: #94a3b8;
        --border-color: #1e293b;
        --radius-lg: 20px;
        --radius-xl: 24px;
        --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    html.light-theme {
        --bg-primary: #f8fafc;
        --bg-secondary: #f1f5f9;
        --bg-card: rgba(255, 255, 255, 0.92);
        --text-primary: #111827;
        --text-secondary: #475569;
        --text-muted: #94a3b8;
        --border-color: #e2e8f0;
    }
    html.light-theme body { background: #f8fafc; }
    body {
        font-family: 'Poppins', 'Hind Siliguri', system-ui, -apple-system, sans-serif;
    }

    .gig-detail-page {
        padding-top: 80px;
        padding-bottom: 6rem;
        min-height: 100vh;
        background: var(--bg-primary);
        position: relative;
    }
    .gig-detail-page::before {
        content: ''; position: fixed; top: -30%; right: -15%;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(0,217,255,0.04) 0%, transparent 70%);
        pointer-events: none; z-index: 0;
    }

    .gd-container { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; position: relative; z-index: 1; }

    /* ===== Back bar ===== */
    .top-bar {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;
    }
    .back-link {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.55rem 1.3rem; background: var(--bg-card);
        border: 1px solid var(--border-color); border-radius: 50px;
        color: var(--text-secondary); text-decoration: none;
        font-size: 0.82rem; font-weight: 500;
        backdrop-filter: blur(12px); transition: var(--transition);
        position: relative; overflow: hidden;
    }
    .back-link::after {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(0,217,255,0.4) 0%, rgba(0,217,255,0.1) 30%, transparent 60%);
        opacity: 0; transition: opacity 0.4s; pointer-events: none; border-radius: inherit;
    }
    .back-link:hover::after { opacity: 1; }
    .back-link:hover {
        border-color: rgba(0,217,255,0.3); color: var(--accent-light);
        transform: translateX(-4px); box-shadow: 0 4px 20px rgba(0,217,255,0.08);
    }
    .back-link i, .back-link span { position: relative; z-index: 1; }

    /* ===== Hero image ===== */
    .gd-image-wrap {
        width: 100%; aspect-ratio: 16 / 9;
        border-radius: 24px; overflow: hidden;
        margin-bottom: 2.5rem;
        position: relative;
        box-shadow: 0 30px 100px rgba(0,0,0,0.35), 0 0 0 1px var(--border-color);
        background: var(--bg-secondary);
    }
    .gd-image-wrap::after {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(0,217,255,0.3) 0%, rgba(0,217,255,0.08) 30%, transparent 60%);
        pointer-events: none; z-index: 1;
        opacity: 0; transition: opacity 0.5s ease;
    }
    .gd-image-wrap:hover::after { opacity: 1; }
    .gd-image-wrap img {
        width: 100%; height: 100%; object-fit: cover;
        display: block; transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .gd-image-wrap:hover img { transform: scale(1.03); }
    .gd-image-wrap .img-fallback {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #1e293b 0%, #111827 50%, #0b1f28 100%);
        display: flex; align-items: center; justify-content: center;
    }
    .gd-image-wrap .img-fallback i { font-size: 5rem; opacity: 0.15; color: var(--accent); }


    /* ===== Hero content ===== */
    .gd-hero-content {
        margin-bottom: 3.5rem;
        padding: 0 0.5rem;
    }
    .gd-hero-content .hero-meta {
        display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;
        margin-bottom: 1rem;
    }
    .gd-hero-content .hero-category {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        color: #fff; padding: 0.35rem 1.2rem; border-radius: 50px;
        font-size: 0.78rem; font-weight: 700; letter-spacing: 0.3px;
        box-shadow: 0 4px 15px rgba(0,217,255,0.25);
    }
    .gd-hero-content .hero-category i { font-size: 0.7rem; }
    .gd-hero-content .hero-badge-meta {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.35rem 1.2rem; border-radius: 50px;
        font-size: 0.78rem; font-weight: 600;
        background: rgba(255,215,0,0.08); color: #fbbf24;
        border: 1px solid rgba(255,215,0,0.12);
    }
    html.light-theme .gd-hero-content .hero-badge-meta {
        background: rgba(255,215,0,0.06); color: #b8860b;
        border-color: rgba(255,215,0,0.15);
    }
    .gd-hero-content .hero-badge-meta i { font-size: 0.7rem; }
    .gd-hero-content h1 {
        font-size: clamp(2rem, 4.5vw, 3.5rem); font-weight: 900;
        color: var(--text-primary); margin: 0 0 0.5rem; letter-spacing: -1.5px;
        line-height: 1.1;
        background: linear-gradient(135deg, var(--text-primary) 0%, var(--accent-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    html.light-theme .gd-hero-content h1 {
        background: linear-gradient(135deg, #111827 0%, #00d9ff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .gd-hero-content .hero-sub {
        font-size: 1.05rem; color: var(--text-secondary);
        line-height: 1.6; max-width: 600px; margin: 0;
    }

    /* ===== Description ===== */
    .gd-description-wrap { max-width: 800px; margin: 0 auto 3.5rem; }
    .gd-description-card {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 20px; padding: 2.5rem;
        backdrop-filter: blur(12px); transition: var(--transition);
        position: relative; overflow: hidden;
    }
    .gd-description-card::after {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(0,217,255,0.5) 0%, rgba(0,217,255,0.15) 25%, rgba(0,217,255,0.04) 45%, transparent 65%);
        pointer-events: none; opacity: 0; transition: opacity 0.4s ease; z-index: 0; border-radius: inherit;
    }
    html.light-theme .gd-description-card::after {
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(0,217,255,0.3) 0%, rgba(0,217,255,0.1) 25%, rgba(0,217,255,0.03) 45%, transparent 65%);
    }
    .gd-description-card:hover::after { opacity: 1; }
    .gd-description-card:hover {
        border-color: rgba(0,217,255,0.2);
        box-shadow: 0 12px 40px rgba(0,217,255,0.06);
    }
    .gd-description-card .desc-accent {
        position: absolute; top: 0; left: 0; width: 4px; height: 100%;
        background: linear-gradient(180deg, #00d9ff, #00ff88);
        z-index: 1;
    }
    .gd-description-card .desc-label {
        font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 1px; color: var(--accent-light);
        margin-bottom: 0.75rem;
        display: flex; align-items: center; gap: 0.5rem;
        position: relative; z-index: 1;
    }
    .gd-description-card .desc-label i { font-size: 0.85rem; }
    .gd-description-card .desc-text {
        color: var(--text-secondary); font-size: 1rem;
        line-height: 1.85; margin: 0; white-space: pre-line;
        position: relative; z-index: 1;
    }

    /* ===== Pricing ===== */
    .pricing-section-title {
        text-align: center; margin-bottom: 2.5rem;
    }
    .pricing-section-title h2 {
        font-size: 1.8rem; font-weight: 800;
        color: var(--text-primary); margin-bottom: 0.4rem;
        letter-spacing: -0.5px;
    }
    .pricing-section-title p {
        color: var(--text-secondary); font-size: 0.95rem; margin: 0;
    }
    .pricing-section-title .title-line {
        width: 50px; height: 3px;
        background: linear-gradient(90deg, #00d9ff, #00ff88);
        margin: 0.8rem auto 0; border-radius: 2px;
    }

    .pricing-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.8rem;
        max-width: 1100px;
        margin: 0 auto;
    }

    .pricing-card {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: var(--radius-xl);
        padding: 2.2rem 1.8rem 2rem;
        text-align: center;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative; overflow: hidden;
        backdrop-filter: blur(12px);
        display: flex; flex-direction: column;
    }
    .pricing-card::before {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(0,217,255,0.5) 0%, rgba(0,217,255,0.15) 25%, rgba(0,217,255,0.04) 45%, transparent 65%);
        pointer-events: none; opacity: 0; transition: opacity 0.4s ease; border-radius: inherit;
    }
    .pricing-card:hover::before { opacity: 1; }
    .pricing-card:hover {
        border-color: rgba(0,217,255,0.25);
        box-shadow: 0 12px 40px rgba(0,217,255,0.08);
        transform: translateY(-6px);
    }
    .pricing-card.featured {
        border-color: rgba(0,217,255,0.3);
        box-shadow: 0 0 40px rgba(0,217,255,0.08), 0 10px 40px rgba(0,0,0,0.15);
        transform: scale(1.04); z-index: 2;
    }
    .pricing-card.featured:hover {
        transform: scale(1.04) translateY(-6px);
        box-shadow: 0 0 60px rgba(0,217,255,0.12), 0 16px 50px rgba(0,0,0,0.2);
    }
    .pricing-card.featured .featured-tag {
        position: absolute; top: 0.8rem; right: -2.5rem;
        transform: rotate(45deg);
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        color: #fff; padding: 0.3rem 2.8rem;
        font-size: 0.65rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(0,217,255,0.3);
    }
    .pricing-card .pkg-accent {
        position: absolute; top: 0; left: 1.5rem; right: 1.5rem; height: 2px;
        background: linear-gradient(90deg, transparent, rgba(0,217,255,0.3), transparent);
        z-index: 1;
    }
    .pricing-card.featured .pkg-accent {
        background: linear-gradient(90deg, transparent, #00d9ff, #00ff88, transparent);
    }

    .pricing-card .pkg-icon {
        width: 48px; height: 48px; margin: 0 auto 0.8rem;
        background: rgba(0,217,255,0.08);
        border: 1px solid rgba(0,217,255,0.1);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; color: var(--accent-light);
        transition: all 0.4s ease; position: relative; z-index: 1;
    }
    .pricing-card:hover .pkg-icon {
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        border-color: transparent; color: #fff;
        transform: scale(1.1) rotate(-3deg);
        box-shadow: 0 8px 25px rgba(0,217,255,0.25);
    }

    .pricing-card .pkg-name {
        font-size: 1.1rem; font-weight: 700;
        color: var(--text-primary); margin-bottom: 0.3rem;
        position: relative; z-index: 1;
    }
    .pricing-card .pkg-subtitle {
        font-size: 0.78rem; color: var(--text-muted);
        margin-bottom: 1rem; position: relative; z-index: 1;
    }
    .pricing-card .pkg-price {
        font-size: 2.4rem; font-weight: 800;
        color: var(--accent-light);
        line-height: 1; margin-bottom: 0.25rem;
        position: relative; z-index: 1;
    }
    .pricing-card .pkg-price .currency {
        font-size: 1.2rem; font-weight: 600; vertical-align: super;
    }
    .pricing-card .pkg-duration {
        font-size: 0.78rem; color: var(--text-muted);
        margin-bottom: 1.5rem; position: relative; z-index: 1;
    }
    .pricing-card .pkg-divider {
        width: 60%; height: 1px; margin: 0 auto 1.2rem;
        background: linear-gradient(90deg, transparent, var(--border-color), transparent);
        position: relative; z-index: 1;
    }

    .pricing-features {
        list-style: none; padding: 0; margin: 0 0 1.5rem;
        flex: 1; position: relative; z-index: 1;
    }
    .pricing-features li {
        padding: 0.6rem 0.5rem; color: var(--text-secondary);
        font-size: 0.88rem;
        display: flex; align-items: center; justify-content: center;
        gap: 0.5rem;
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }
    .pricing-features li:last-child { border-bottom: none; }
    .pricing-features li i {
        color: #22c55e; font-size: 0.85rem;
        flex-shrink: 0; transition: transform 0.3s ease;
    }
    .pricing-card:hover .pricing-features li i { transform: scale(1.2); }
    .pricing-features li .feature-text { flex: 1; text-align: left; }

    .btn-order {
        display: inline-flex; align-items: center; justify-content: center;
        gap: 0.6rem; width: 100%;
        padding: 0.8rem 1.5rem;
        background: linear-gradient(135deg, #00d9ff, #00a2c9);
        color: #fff; border: none; border-radius: 14px;
        font-weight: 700; font-size: 0.95rem;
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
        text-decoration: none; cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 15px rgba(0,217,255,0.25);
        position: relative; overflow: hidden; z-index: 1;
    }
    .btn-order::before {
        content: ''; position: absolute; top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
        transition: left 0.6s ease;
    }
    .btn-order:hover::before { left: 100%; }
    .btn-order:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 30px rgba(0,217,255,0.4); color: #fff;
    }
    .btn-order i { font-size: 1rem; transition: transform 0.4s ease; }
    .btn-order:hover i { transform: translateX(4px); }

    @media (max-width: 968px) {
        .pricing-grid { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
        .pricing-card.featured {
            transform: none; grid-column: 1 / -1;
            max-width: 500px; margin: 0 auto;
        }
        .pricing-card.featured:hover { transform: translateY(-6px); }
    }
    /* ===== Suggested gigs ===== */
    .suggested-section {
        margin-top: 4.5rem;
        padding-top: 1rem;
    }
    .suggested-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    .suggested-header h2 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 0.4rem;
        letter-spacing: -0.5px;
    }
    .suggested-header p {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin: 0;
    }
    .suggested-header .title-line {
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #00d9ff, #00ff88);
        margin: 0.8rem auto 0;
        border-radius: 2px;
    }
    .suggested-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1.5rem;
    }
    .suggested-card {
        width: calc(33.333% - 1rem);
        min-width: 280px;
        max-width: 360px;
        flex-shrink: 0;
        display: block;
        text-decoration: none;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
    }
    html.light-theme .suggested-card { background: rgba(255, 255, 255, 0.92); }
    .suggested-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(0,217,255,0.45) 0%, rgba(0,217,255,0.18) 30%, transparent 60%);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.5s ease;
        z-index: 1;
        border-radius: inherit;
    }
    .suggested-card:hover::after { opacity: 1; }
    .suggested-card:hover {
        border-color: rgba(0,217,255,0.25);
        box-shadow: 0 20px 60px rgba(0,217,255,0.08), 0 8px 20px rgba(0,0,0,0.12);
        transform: translateY(-6px);
    }
    html.light-theme .suggested-card:hover {
        box-shadow: 0 20px 60px rgba(0,217,255,0.1);
    }
    .suggested-card .sc-image {
        height: 180px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg-secondary);
    }
    .suggested-card .sc-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .suggested-card:hover .sc-image img { transform: scale(1.08); }
    .suggested-card .sc-image .sc-fallback {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1e293b 0%, #111827 50%, #0b1f28 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .suggested-card .sc-image .sc-fallback i {
        font-size: 3.5rem;
        opacity: 0.12;
        color: var(--accent);
    }
    .suggested-card .sc-image::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 60px;
        background: linear-gradient(transparent, rgba(8,11,18,0.95));
        pointer-events: none;
        z-index: 1;
    }
    html.light-theme .suggested-card .sc-image::after {
        background: linear-gradient(transparent, rgba(248,250,252,0.9));
    }
    .suggested-card .sc-body {
        padding: 1.25rem 1.5rem 1.5rem;
        position: relative;
        z-index: 2;
    }
    .suggested-card .sc-body h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
        color: var(--text-primary);
        line-height: 1.3;
    }
    .suggested-card .sc-body p {
        color: var(--text-secondary);
        font-size: 0.85rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .suggested-card .sc-price {
        display: inline-block;
        padding: 0.3rem 1rem;
        background: rgba(0, 217, 255, 0.12);
        color: var(--accent-light);
        border: 1px solid rgba(0, 217, 255, 0.25);
        border-radius: 20px;
        font-size: 0.82rem;
        font-weight: 600;
    }
    .suggested-card .sc-body .sc-body-inner { position: relative; z-index: 2; }
    @media (max-width: 968px) {
        .suggested-grid { gap: 1.2rem; }
        .suggested-card { min-width: 250px; }
    }
    @media (max-width: 768px) {
        .suggested-section { margin-top: 3rem; }
        .suggested-header h2 { font-size: 1.4rem; }
        .suggested-card { width: 100%; max-width: 400px; }
        .suggested-card .sc-image { height: 200px; }
    }
    @media (max-width: 480px) {
        .suggested-section { margin-top: 2rem; }
        .suggested-header { margin-bottom: 1.5rem; }
        .suggested-header h2 { font-size: 1.2rem; }
    }

    @media (max-width: 768px) {
        .gig-detail-page { padding-top: 70px; padding-bottom: 3rem; }
        .gd-container { padding: 0 1rem; }
        .gd-image-wrap { border-radius: 16px; margin-bottom: 1.5rem; }
        .gd-hero-content { margin-bottom: 2.5rem; padding: 0; }
        .gd-hero-content h1 { font-size: 1.6rem; }
        .gd-hero-content .hero-sub { font-size: 0.92rem; }
        .pricing-grid { grid-template-columns: 1fr; gap: 1.4rem; }
        .pricing-card.featured { max-width: 100%; }
        .gd-description-card { padding: 1.5rem; }
        .gd-description-card .desc-text { font-size: 0.92rem; }
    }
    @media (max-width: 480px) {
        .gd-image-wrap { border-radius: 12px; margin-bottom: 1.5rem; }
        .gd-hero-content h1 { font-size: 1.3rem; }
        .gd-hero-content .hero-meta { gap: 0.5rem; }
        .gd-hero-content .hero-category { font-size: 0.7rem; padding: 0.25rem 0.9rem; }
        .pricing-card { padding: 1.8rem 1.2rem 1.5rem; }
        .pricing-card .pkg-price { font-size: 2rem; }
        .top-bar { margin-bottom: 1.5rem; }
        .pricing-section-title h2 { font-size: 1.4rem; }
        .gd-description-card { padding: 1.2rem; border-radius: 16px; }
    }
</style>

<div class="gig-detail-page">
    <div class="gd-container">
        <div class="top-bar">
            <a href="{{ route('home') }}#gigs" class="back-link">
                <i class="bi bi-arrow-left"></i> <span>{{ __('messages.back_to_gigs') }}</span>
            </a>
        </div>

            <div class="gd-image-wrap">
                @if($gig->image)
                    <img src="{{ config('app.storage_url') }}{{ $gig->image }}" alt="{{ $gig->title }}">
                @else
                    <div class="img-fallback">
                        <i class="bi bi-image"></i>
                    </div>
                @endif
            </div>

        <div class="gd-hero-content">
            <div class="hero-meta">
                <span class="hero-category"><i class="bi bi-gear-fill"></i> {{ __('messages.service') }}</span>
                <span class="hero-badge-meta"><i class="bi bi-star-fill"></i> {{ __('messages.premium_service') }}</span>
            </div>
            <h1>{{ $gig->title }}</h1>
            @if($gig->short_description)
                <p class="hero-sub">{{ $gig->short_description }}</p>
            @endif
        </div>

        @if($gig->description)
            <div class="gd-description-wrap">
                <div class="gd-description-card">
                    <div class="desc-accent"></div>
                    <div class="desc-label">
                        <i class="bi bi-info-circle"></i> {{ __('messages.about_this_gig') }}
                    </div>
                    <p class="desc-text">{{ $gig->description }}</p>
                </div>
            </div>
        @endif

        <div class="pricing-section-title">
            <h2>{{ __('messages.pricing_plans') }}</h2>
            <p>{{ __('messages.choose_package') }}</p>
            <div class="title-line"></div>
        </div>

        <div class="pricing-grid">
            <div class="pricing-card">
                <div class="pkg-accent"></div>
                <div class="pkg-icon"><i class="bi bi-rocket-takeoff"></i></div>
                <div class="pkg-name">{{ $gig->basic_name ?: 'Basic' }}</div>
                <div class="pkg-subtitle">{{ __('messages.starter_package') }}</div>
                <div class="pkg-price"><span class="currency">$</span>{{ number_format($gig->basic_price, 0) }}</div>
                <div class="pkg-duration">{{ __('messages.one_time') }}</div>
                <div class="pkg-divider"></div>
                @if($gig->basic_features)
                    <ul class="pricing-features">
                        @foreach(explode("\n", $gig->basic_features) as $feature)
                            @if(trim($feature))
                                <li><i class="bi bi-check-circle-fill"></i><span class="feature-text">{{ trim($feature) }}</span></li>
                            @endif
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('inbox.order', [$gig->id, 'basic']) }}" method="POST" style="position:relative; z-index:1;">
                    @csrf
                    <button type="submit" class="btn-order">{{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i></button>
                </form>
            </div>

            <div class="pricing-card featured">
                <div class="featured-tag">{{ __('messages.popular') }}</div>
                <div class="pkg-accent"></div>
                <div class="pkg-icon"><i class="bi bi-stars"></i></div>
                <div class="pkg-name">{{ $gig->standard_name ?: 'Standard' }}</div>
                <div class="pkg-subtitle">{{ __('messages.best_value') }}</div>
                <div class="pkg-price"><span class="currency">$</span>{{ number_format($gig->standard_price, 0) }}</div>
                <div class="pkg-duration">{{ __('messages.one_time') }}</div>
                <div class="pkg-divider"></div>
                @if($gig->standard_features)
                    <ul class="pricing-features">
                        @foreach(explode("\n", $gig->standard_features) as $feature)
                            @if(trim($feature))
                                <li><i class="bi bi-check-circle-fill"></i><span class="feature-text">{{ trim($feature) }}</span></li>
                            @endif
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('inbox.order', [$gig->id, 'standard']) }}" method="POST" style="position:relative; z-index:1;">
                    @csrf
                    <button type="submit" class="btn-order">{{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i></button>
                </form>
            </div>

            <div class="pricing-card">
                <div class="pkg-accent"></div>
                <div class="pkg-icon"><i class="bi bi-gem"></i></div>
                <div class="pkg-name">{{ $gig->premium_name ?: 'Premium' }}</div>
                <div class="pkg-subtitle">{{ __('messages.premium_package') }}</div>
                <div class="pkg-price"><span class="currency">$</span>{{ number_format($gig->premium_price, 0) }}</div>
                <div class="pkg-duration">{{ __('messages.one_time') }}</div>
                <div class="pkg-divider"></div>
                @if($gig->premium_features)
                    <ul class="pricing-features">
                        @foreach(explode("\n", $gig->premium_features) as $feature)
                            @if(trim($feature))
                                <li><i class="bi bi-check-circle-fill"></i><span class="feature-text">{{ trim($feature) }}</span></li>
                            @endif
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('inbox.order', [$gig->id, 'premium']) }}" method="POST" style="position:relative; z-index:1;">
                    @csrf
                    <button type="submit" class="btn-order">{{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i></button>
                </form>
            </div>
        </div>

        @if($suggestedGigs->count() > 0)
            <div class="suggested-section">
                <div class="suggested-header">
                    <h2>{{ __('messages.suggested_gigs') }}</h2>
                    <p>{{ __('messages.choose_package') }}</p>
                    <div class="title-line"></div>
                </div>
                <div class="suggested-grid">
                    @foreach($suggestedGigs as $suggested)
                        <a href="{{ route('gig.detail', $suggested->id) }}" class="suggested-card">
                            <div class="sc-image">
                                @if($suggested->image)
                                    <img src="{{ config('app.storage_url') }}{{ $suggested->image }}" alt="{{ $suggested->title }}">
                                @else
                                    <div class="sc-fallback">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="sc-body">
                                <h3>{{ $suggested->title }}</h3>
                                @if($suggested->short_description)
                                    <p>{{ $suggested->short_description }}</p>
                                @endif
                                <span class="sc-price">{{ __('messages.starting_from') }} ${{ number_format(min($suggested->basic_price, $suggested->standard_price, $suggested->premium_price), 0) }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<script>
(function() {
    var selectors = '.back-link, .gd-image-wrap, .gd-description-card, .pricing-card, .suggested-card';
    document.querySelectorAll(selectors).forEach(function(el) {
        var rafId = null;
        el.addEventListener('mousemove', function(e) {
            if (rafId) return;
            var self = this;
            rafId = requestAnimationFrame(function() {
                var rect = self.getBoundingClientRect();
                var x = ((e.clientX - rect.left) / rect.width) * 100;
                var y = ((e.clientY - rect.top) / rect.height) * 100;
                self.style.setProperty('--shx', x + '%');
                self.style.setProperty('--shy', y + '%');
                rafId = null;
            });
        });
        el.addEventListener('mouseleave', function() {
            if (rafId) { cancelAnimationFrame(rafId); rafId = null; }
            this.style.setProperty('--shx', '50%');
            this.style.setProperty('--shy', '50%');
        });
    });
})();
</script>
@endsection
