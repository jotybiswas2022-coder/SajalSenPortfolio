@extends('frontend.app')

@section('content')
<style>
    /* ===== INDEX PAGE - DARK PORTFOLIO THEME ===== */
    :root {
        --bg-primary: #080b12;
        --bg-secondary: #111827;
        --bg-card: rgba(17, 24, 39, 0.8);
        --bg-nav: rgba(8, 11, 18, 0.88);
        --accent: #00d9ff;
        --accent-light: #7ce6ff;
        --accent-dark: #00a2c9;
        --accent-gradient: linear-gradient(135deg, #00d9ff, #00ff88);
        --accent-gradient-2: linear-gradient(135deg, #00d9ff, #7ce6ff, #6bffb8, #00d9ff);
        --text-primary: #f1f5f9;
        --text-secondary: #94a3b8;
        --text-muted: #94a3b8;
        --border-color: #1e293b;
        --border-hover: rgba(0, 217, 255, 0.3);
        --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.3);
        --shadow-md: 0 10px 40px rgba(0, 0, 0, 0.4);
        --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.5);
        --shadow-accent: 0 10px 40px rgba(0, 217, 255, 0.3);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 20px;
        --radius-xl: 24px;
        --transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        --font: 'Inter', 'Noto Sans Bengali', sans-serif;
    }

    /* Light Theme — full override with higher specificity than :root */
    html.light-theme {
        --bg-primary: #f8fafc;
        --bg-secondary: #f1f5f9;
        --bg-card: rgba(255, 255, 255, 0.92);
        --text-primary: #111827;
        --text-secondary: #475569;
        --text-muted: #94a3b8;
        --border-color: #e2e8f0;
        --border-hover: rgba(0, 217, 255, 0.35);
        --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 10px 40px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.12);
        --shadow-accent: 0 10px 40px rgba(0, 217, 255, 0.2);
    }
    html.light-theme body { background: #f8fafc; }

    /* Hero Light Theme */
    html.light-theme .hero {
        background: linear-gradient(180deg, #f0f7fb 0%, #f8fafc 100%);
    }
    html.light-theme .hero::before {
        background: radial-gradient(circle, rgba(0, 217, 255, 0.07), transparent 70%);
    }
    html.light-theme .float-chip {
        background: rgba(255, 255, 255, 0.9);
        border-color: rgba(0, 217, 255, 0.25);
        color: #475569;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
    }
    html.light-theme .float-chip i {
        color: #00d9ff;
    }
    html.light-theme .matrix-rain {
        opacity: 0.9;
        -webkit-mask-image: radial-gradient(ellipse 95% 95% at 50% 45%, transparent 0%, transparent 22%, rgba(0,0,0,0.35) 48%, #000 62%);
        mask-image: radial-gradient(ellipse 95% 95% at 50% 45%, transparent 0%, transparent 22%, rgba(0,0,0,0.35) 48%, #000 62%);
    }
    html.light-theme .cyber-grid {
        background-image:
            linear-gradient(rgba(0, 255, 136, 0.02) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 255, 136, 0.02) 1px, transparent 1px);
    }
    html.light-theme .scan-lines {
        background: linear-gradient(
            to bottom,
            transparent 0%,
            rgba(0, 255, 136, 0.02) 50%,
            transparent 50.5%,
            transparent 100%
        );
    }
    html.light-theme .hex-pattern {
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cpath d='M50 5L93 27V73L50 95L7 73V27L50 5Z' fill='none' stroke='rgba(0,255,136,0.08)' stroke-width='1'/%3E%3C/svg%3E");
    }
    html.light-theme .data-stream { color: rgba(0, 255, 136, 0.25); }
    html.light-theme .float-chip {
        background: rgba(255, 255, 255, 0.9);
        border-color: rgba(0, 255, 136, 0.2);
        color: #00b35c;
    }
    html.light-theme .float-chip i { color: #00b35c; }
    html.light-theme .hero-badge {
        background: rgba(8, 145, 178, 0.06);
        border-color: rgba(8, 145, 178, 0.25);
        color: #0d9488;
    }
    html.light-theme .hero-badge i { color: #0d9488; }
    html.light-theme .hero-badge .shimmer-text {
        background: linear-gradient(90deg, #059669 0%, #0d9488 30%, #0891b2 50%, #0d9488 70%, #059669 100%);
        background-size: 200% auto;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmerMove 3s linear infinite;
    }
    html.light-theme .hero h1 { color: #0f172a; }
    html.light-theme .hero h1 .gradient-text {
        background: linear-gradient(135deg, #0891b2, #0d9488, #059669, #0891b2);
        background-size: 300% 300%;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    html.light-theme .hero p { color: #475569; }
    html.light-theme .hero-buttons .btn-outline-custom {
        color: #0891b2; border-color: rgba(8, 145, 178, 0.35);
    }
    html.light-theme .hero-buttons .btn-outline-custom i { color: #0891b2; }
    html.light-theme .hero-buttons .btn-outline-custom:hover {
        background: rgba(8, 145, 178, 0.08); border-color: #0891b2;
    }
    html.light-theme .hero-buttons .btn-primary-custom {
        background: linear-gradient(135deg, #0891b2, #0d9488, #059669);
        box-shadow: 0 4px 20px rgba(8, 145, 178, 0.3);
    }
    html.light-theme .stat-item .number {
        filter: drop-shadow(0 0 12px rgba(0, 217, 255, 0.15));
    }
    html.light-theme .stat-item:hover .number {
        filter: drop-shadow(0 0 20px rgba(0, 217, 255, 0.3));
    }

    html.light-theme .cyber-card,
    html.light-theme .contact-form,
    html.light-theme .contact-item,
    html.light-theme .testimonial-card,
    html.light-theme .faq-item {
        background: rgba(255, 255, 255, 0.85) !important;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html { scroll-behavior: auto; }
    body {
        width: 100%;
        font-family: var(--font);
        background: var(--bg-primary);
        color: var(--text-primary);
        overflow-x: hidden;
        line-height: 1.6;
    }
    ::selection { background: rgba(0, 217, 255, 0.3); color: #fff; }
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--bg-primary); }
    ::-webkit-scrollbar-thumb { background: rgba(0, 217, 255, 0.3); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: rgba(0, 217, 255, 0.5); }

    /* Particles */
    #particles-canvas {
        position: fixed; top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 0; pointer-events: none;
    }

    /* ===== Hero Decorative Effects ===== */

    /* Speed Lines */
    /* Orbit Rings */

    /* ===== CYBER SECURITY SPECIAL EFFECTS ===== */
    
    /* Cyber Grid Background - Command Center Style */
    .cyber-grid {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background-image:
            linear-gradient(rgba(0, 255, 136, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 255, 136, 0.05) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none; z-index: 0;
        animation: gridPulse 6s ease-in-out infinite;
    }
    @keyframes gridPulse {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 0.8; }
    }
    
    /* Animated Shield Icon - Center Hero */
    .shield-icon-center {
        position: absolute; 
        top: 50%; left: 50%; 
        transform: translate(-50%, -50%);
        width: 120px; height: 120px;
        pointer-events: none; z-index: 0;
        opacity: 0.15;
    }
    .shield-icon-center svg {
        width: 100%; height: 100%;
        filter: drop-shadow(0 0 30px rgba(0, 255, 136, 0.5));
        animation: shieldPulse 3s ease-in-out infinite;
    }
    @keyframes shieldPulse {
        0%, 100% { 
            transform: scale(1); 
            filter: drop-shadow(0 0 20px rgba(0, 255, 136, 0.3));
        }
        50% { 
            transform: scale(1.1);
            filter: drop-shadow(0 0 40px rgba(0, 255, 136, 0.6));
        }
    }
    
    /* Shield Orbit Rings */
    .shield-orbits { position: absolute; top: 50%; left: 50%; width: 0; height: 0; pointer-events: none; z-index: 0; }
    .shield-orbit-ring { position: absolute; border: 1px solid rgba(0, 255, 136, 0.15); border-radius: 50%; }
    .shield-orbit-ring:nth-child(1) { width: 200px; height: 200px; margin: -100px 0 0 -100px; animation: orbitSpin 8s linear infinite; }
    .shield-orbit-ring:nth-child(2) { width: 320px; height: 320px; margin: -160px 0 0 -160px; animation: orbitSpin 12s linear infinite reverse; }
    .shield-orbit-ring:nth-child(3) { width: 440px; height: 440px; margin: -220px 0 0 -220px; animation: orbitSpin 16s linear infinite; }
    .shield-orbit-dot { position: absolute; width: 4px; height: 4px; background: #00ff88; border-radius: 50%; box-shadow: 0 0 8px #00ff88; }
    .shield-orbit-ring:nth-child(1) .shield-orbit-dot { top: -2px; left: 50%; margin-left: -2px; }
    .shield-orbit-ring:nth-child(2) .shield-orbit-dot { top: 50%; right: -2px; margin-top: -2px; }
    .shield-orbit-ring:nth-child(3) .shield-orbit-dot { bottom: -2px; left: 50%; margin-left: -2px; }
    @keyframes orbitSpin { 100% { transform: rotate(360deg); } }
    @keyframes gridPulse {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 1; }
    }
    
    @keyframes shieldPulse {
        0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.6; }
        50% { transform: translate(-50%, -50%) scale(1.15); opacity: 1; }
    }
    
    /* Scan Lines Overlay - Terminal Effect */
    .scan-lines {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(
            to bottom,
            transparent 0%,
            rgba(0, 255, 136, 0.04) 50%,
            transparent 50.3%,
            transparent 100%
        );
        background-size: 100% 3px;
        pointer-events: none; z-index: 1;
        animation: scanMove 1.2s linear infinite;
    }
    @keyframes scanMove {
        0% { background-position: 0 0; }
        100% { background-position: 0 3px; }
    }
    @keyframes shieldPulse {
        0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.6; }
        50% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
    }
    
    
    /* Scan Lines Overlay */
    .scan-lines {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(
            to bottom,
            transparent 0%,
            rgba(0, 255, 136, 0.03) 50%,
            transparent 50.5%,
            transparent 100%
        );
        background-size: 100% 4px;
        pointer-events: none; z-index: 1;
        animation: scanMove 1.5s linear infinite;
    }
    @keyframes scanMove {
        0% { background-position: 0 0; }
        100% { background-position: 0 4px; }
    }
    
    /* Hexagonal Pattern Decoration - Security Mesh */
    .hex-pattern {
        position: absolute; width: 140px; height: 140px;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cpath d='M50 5L93 27V73L50 95L7 73V27L50 5Z' fill='none' stroke='rgba(0,255,136,0.12)' stroke-width='1'/%3E%3C/svg%3E");
        background-size: contain; background-repeat: repeat;
        pointer-events: none; z-index: 0; opacity: 0.6;
        animation: hexFade 8s ease-in-out infinite;
    }
    @keyframes hexFade {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 0.7; }
    }
    
    /* Data Stream Animation - Terminal Text */
    .data-stream {
        position: absolute; font-family: 'JetBrains Mono', 'Courier New', monospace;
        font-size: 0.65rem; color: rgba(0, 255, 136, 0.5);
        pointer-events: none; z-index: 0;
        white-space: nowrap; 
        overflow: hidden; 
        width: 200%;
        text-shadow: 0 0 5px rgba(0, 255, 136, 0.3);
    }
    .data-stream span {
        display: inline-block;
        animation: streamScroll 25s linear infinite;
    }
    @keyframes streamScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    
    /* Floating Security Chips - Improved */
    .float-chip { 
        position: absolute; 
        display: flex; align-items: center; gap: 0.5rem; 
        padding: 0.5rem 1rem; 
        background: rgba(0, 15, 5, 0.75); 
        backdrop-filter: blur(12px); 
        border: 1px solid rgba(0, 255, 136, 0.25); 
        border-radius: 6px; 
        font-size: 0.7rem; 
        color: #00ff88; 
        pointer-events: none; 
        z-index: 2; 
        white-space: nowrap; 
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4), inset 0 0 10px rgba(0, 255, 136, 0.05);
    }
    .float-chip i { color: #00ff88; font-size: 0.75rem; }
    .float-chip.c1 { top: 12%; right: 4%; animation: floatChip 5s ease-in-out infinite; }
    .float-chip.c2 { bottom: 22%; left: 2%; animation: floatChip 6s ease-in-out infinite 1.5s; }
    .float-chip.c3 { top: 38%; left: 6%; animation: floatChip 4.5s ease-in-out infinite 0.8s; }
    @keyframes floatChip { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
    .data-stream span {
        display: inline-block;
        animation: streamScroll 20s linear infinite;
    }
    @keyframes streamScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* Cyber Security Ticker - diagonal lines flanking hero text */
    .cyber-ticker {
        position: absolute;
        display: flex; align-items: center;
        overflow: hidden; pointer-events: none; z-index: 1;
        height: 32px;
        font-family: 'Inter', 'Noto Sans Bengali', sans-serif;
        font-size: 0.72rem; font-weight: 500; letter-spacing: 0.3px;
        color: rgba(0, 255, 136, 0.6);
        text-shadow: 0 0 10px rgba(0, 255, 136, 0.15);
        background: linear-gradient(90deg, rgba(0,255,136,0.02) 0%, rgba(0,255,136,0.04) 50%, rgba(0,255,136,0.02) 100%);
        border-top: 1px solid rgba(0, 255, 136, 0.08);
        border-bottom: 1px solid rgba(0, 255, 136, 0.08);
        -webkit-mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent);
        mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent);
    }
    html.light-theme .cyber-ticker {
        color: rgba(4, 120, 87, 0.7);
        text-shadow: none;
        background: linear-gradient(90deg, rgba(0,217,255,0.02) 0%, rgba(0,217,255,0.04) 50%, rgba(0,217,255,0.02) 100%);
        border-top: 1px solid rgba(2, 132, 199, 0.1);
        border-bottom: 1px solid rgba(2, 132, 199, 0.1);
    }
    .cyber-ticker-left {
        top: 57%;
        left: 12%;
        width: 30%;
        transform: translateY(-50%) rotate(-45deg);
        transform-origin: left center;
    }
    .cyber-ticker-right {
        top: 57%;
        right: 12%;
        width: 30%;
        transform: translateY(-50%) rotate(45deg);
        transform-origin: right center;
    }
    .cyber-ticker-track {
        display: flex; align-items: center; width: max-content;
        white-space: nowrap;
        animation: cyberTickerLeft 45s linear infinite;
        will-change: transform;
    }
    .cyber-ticker-right .cyber-ticker-track { animation-name: cyberTickerRight; animation-duration: 50s; }
    .cyber-ticker-group { display: inline-flex; align-items: center; flex-shrink: 0; }
    .cyber-ticker-item {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0 1.5rem 0 0;
        margin-right: 0.5rem;
        position: relative;
    }
    .cyber-ticker-item::after {
        content: ''; position: absolute; right: -0.15rem; top: 50%;
        transform: translateY(-50%);
        width: 3px; height: 3px; border-radius: 50%;
        background: rgba(0, 217, 255, 0.4);
        box-shadow: 0 0 4px rgba(0, 217, 255, 0.5);
    }
    .cyber-ticker-item:last-child::after { display: none; }
    .cyber-ticker-item i { font-size: 0.75rem; color: rgba(0, 217, 255, 0.7); }
    html.light-theme .cyber-ticker-item i { color: rgba(2, 132, 199, 0.8); }
    @keyframes cyberTickerLeft {
        from { transform: translateX(0); }
        to { transform: translateX(-33.3333%); }
    }
    @keyframes cyberTickerRight {
        from { transform: translateX(-33.3333%); }
        to { transform: translateX(0); }
    }
    @media (max-width: 768px) {
        .cyber-ticker { font-size: 0.58rem; height: 22px; }
        .cyber-ticker-left { top: 56%; left: -7%; width: 42%; transform: translateY(-50%) rotate(-30deg); transform-origin: left center; }
        .cyber-ticker-right { top: 56%; right: -7%; width: 42%; transform: translateY(-50%) rotate(30deg); transform-origin: right center; }
        .cyber-ticker-item { padding: 0 1rem 0 0; margin-right: 0.4rem; }
        .cyber-ticker-item::after { right: -0.1rem; }
    }
    @media (max-width: 480px) {
        .cyber-ticker { font-size: 0.55rem; height: 20px; }
        .cyber-ticker-left { top: 54%; left: -14%; width: 50%; transform: translateY(-50%) rotate(-30deg); transform-origin: left center; }
        .cyber-ticker-right { top: 54%; right: -14%; width: 50%; transform: translateY(-50%) rotate(30deg); transform-origin: right center; }
    }

    /* Matrix Binary Rain Background */
    .matrix-rain {
        position: absolute; top: 0; left: 0;
        width: 100%; height: 100%;
        pointer-events: none; z-index: 0;
        opacity: 0.6;
        -webkit-mask-image: radial-gradient(ellipse 95% 95% at 50% 45%, transparent 0%, transparent 14%, rgba(0,0,0,0.5) 40%, #000 62%);
        mask-image: radial-gradient(ellipse 95% 95% at 50% 45%, transparent 0%, transparent 14%, rgba(0,0,0,0.5) 40%, #000 62%);
    }
    @media (max-width: 768px) {
        .matrix-rain { opacity: 0.45; }
    }

    /* Floating Chips */
    .float-chip { position: absolute; display: flex; align-items: center; justify-content: center; box-sizing: border-box; gap: 0.4rem; width: 158px; padding: 0.45rem 0.75rem; background: rgba(0, 20, 10, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(0, 255, 136, 0.2); border-radius: 50px; font-size: 0.72rem; color: #00ff88; pointer-events: none; z-index: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .float-chip i { color: #00ff88; font-size: 0.78rem; flex-shrink: 0; }
    .float-chip.c1 { top: 18%; right: 5%; height: 26px; padding: 0 0.75rem; font-size: 0.68rem; animation: floatChip 5s ease-in-out infinite; }
    .float-chip.c2 { top: 15%; left: 4%; height: 26px; padding: 0 0.75rem; font-size: 0.68rem; animation: floatChip 6s ease-in-out infinite 1s; }
    .float-chip.c3 { bottom: 22%; left: 3%; height: 26px; padding: 0 0.75rem; font-size: 0.68rem; animation: floatChip 4.5s ease-in-out infinite 0.5s; }
    .float-chip.c4 { bottom: 25%; right: 3%; height: 26px; padding: 0 0.75rem; font-size: 0.68rem; animation: floatChip 5.5s ease-in-out infinite 0.2s; }
    @keyframes floatChip { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }

    /* Shimmer Text */
    .shimmer-text { background: linear-gradient(90deg, var(--accent-light) 0%, #7ce6ff 25%, #6bffb8 50%, #7ce6ff 75%, var(--accent-light) 100%); background-size: 200% auto; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; animation: shimmerMove 3s linear infinite; display: inline; }
    @keyframes shimmerMove { 0% { background-position: 0% center; } 100% { background-position: 200% center; } }

    /* Custom Cursor */
    .cursor-glow {
        width: 36px; height: 36px;
        border-radius: 50%; position: fixed;
        pointer-events: none; z-index: 99999;
        transform: translate(-50%, -50%);
        border: 2px solid rgba(0,217,255,0.5);
        background: rgba(0,217,255,0.06);
        box-shadow: 0 0 30px rgba(0,217,255,0.1), inset 0 0 20px rgba(0,217,255,0.04);
        will-change: transform;
        transition: width 0.2s ease, height 0.2s ease, border-color 0.2s ease, background 0.2s ease;
    }
    .cursor-glow.active {
        width: 48px; height: 48px;
        border-color: var(--accent);
        background: rgba(0,217,255,0.1);
        box-shadow: 0 0 40px rgba(0,217,255,0.2), inset 0 0 30px rgba(0,217,255,0.06);
    }
    html.light-theme .cursor-glow {
        border-color: rgba(0,217,255,0.35);
        background: rgba(0,217,255,0.03);
    }
    html.light-theme .cursor-glow.active {
        border-color: var(--accent);
        background: rgba(0,217,255,0.08);
    }
    @media (max-width: 968px) { .cursor-glow { display: none; } }

    /* Hero */
    .hero {
        min-height: 100vh; display: flex; align-items: center;
        justify-content: center; text-align: center;
        position: relative; z-index: 1; padding: 6rem 2rem 2rem;
    }
    .hero-content { max-width: 850px; position: relative; z-index: 2; }
    .hero::before {
        content: ''; position: absolute;
        width: 700px; height: 700px;
        background: radial-gradient(circle, rgba(0, 217, 255, 0.12), transparent 70%);
        border-radius: 50%; top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        animation: pulseOrb 5s ease-in-out infinite;
    }
    @keyframes pulseOrb {
        0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.4; }
        50% { transform: translate(-50%, -50%) scale(1.15); opacity: 0.8; }
    }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.4rem 1.2rem;
        background: rgba(0, 255, 136, 0.08);
        border: 1px solid rgba(0, 255, 136, 0.25);
        border-radius: 50px; font-size: 0.82rem;
        color: #00ff88; margin-bottom: 1.5rem;
        opacity: 0; transform: translateY(-20px);
        animation: fadeInDown 0.8s ease forwards;
    }
    .hero-badge i { color: #00ff88; }
    .hero h1 {
        font-size: clamp(2.8rem, 7vw, 5.5rem); font-weight: 900;
        line-height: 1.05; margin-bottom: 1rem;
        opacity: 0; transform: translateY(40px);
        animation: fadeInUp 1s ease forwards;
        animation-delay: 0.2s; letter-spacing: -1.5px;
    }
    .hero h1 .gradient-text {
        background: linear-gradient(135deg, #00ff88, #00e69c, #00d9ff, #00ff88);
        background-size: 300% 300%;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        white-space: nowrap;
        animation: gradientShift 4s ease infinite;
    }
    .hero h1 .gradient-text {
        background: var(--accent-gradient-2);
        background-size: 300% 300%;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        white-space: nowrap;
        animation: gradientShift 4s ease infinite;
    }
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .hero p {
        font-size: 1.15rem; color: var(--text-secondary);
        max-width: 640px; margin: 0 auto 2.5rem;
        opacity: 0; transform: translateY(40px);
        animation: fadeInUp 1s ease forwards;
        animation-delay: 0.4s; line-height: 1.8;
    }
    .hero-buttons {
        display: flex; gap: 1rem; justify-content: center;
        flex-wrap: wrap;
        opacity: 0; transform: translateY(40px);
        animation: fadeInUp 1s ease forwards; animation-delay: 0.6s;
    }
    .btn-primary-custom {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.85rem 2.2rem;
        background: linear-gradient(135deg, #00ff88, #00d96e, #00b35c); color: #fff;
        border: none; border-radius: var(--radius-md);
        font-size: 0.95rem; font-weight: 600;
        cursor: pointer; transition: var(--transition);
        position: relative; overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 255, 136, 0.3);
    }
    .btn-primary-custom::before {
        content: ''; position: absolute; top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.6s ease;
    }
    .btn-primary-custom:hover::before { left: 100%; }
    .btn-primary-custom:hover {
        transform: translateY(-3px); 
        box-shadow: 0 8px 30px rgba(0, 255, 136, 0.4); 
    }
    .btn-primary-custom i { color: #fff; }
    .btn-outline-custom {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.85rem 2.2rem; background: transparent;
        color: #00ff88; border: 2px solid rgba(0, 255, 136, 0.35);
        border-radius: var(--radius-md); font-size: 0.95rem; font-weight: 600;
        cursor: pointer; transition: var(--transition);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }
    .btn-outline-custom:hover {
        background: rgba(0, 255, 136, 0.08);
        border-color: #00ff88; transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0, 255, 136, 0.2);
    }
    .btn-outline-custom i { color: #00ff88; }
    .scroll-indicator {
        position: absolute; bottom: 2rem; left: 50%;
        transform: translateX(-50%); animation: bounce 2s ease infinite;
    }
    .scroll-indicator .mouse {
        width: 24px; height: 38px;
        border: 2px solid rgba(0, 217, 255, 0.4);
        border-radius: 12px; display: flex;
        justify-content: center; padding-top: 7px;
    }
    .scroll-indicator .wheel {
        width: 3px; height: 9px; background: var(--accent);
        border-radius: 3px; animation: scrollWheel 1.5s ease infinite;
    }
    @keyframes scrollWheel {
        0% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(12px); }
    }
    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(-8px); }
    }

    /* Sections */
    section { position: relative; z-index: 1; }
    .section-padding { padding: 7rem 2rem; }
    .container { max-width: 1200px; margin: 0 auto; padding-left: 1rem; padding-right: 1rem; }
    .section-title { text-align: center; margin-bottom: 4rem; }
    .section-title h2 {
        font-size: 2.5rem; font-weight: 800;
        margin-bottom: 0.8rem; letter-spacing: -1px;
    }
    .section-title .line {
        width: 60px; height: 4px;
        background: var(--accent-gradient);
        margin: 0 auto 1.2rem; border-radius: 2px;
    }
    .section-title p { color: var(--text-secondary); font-size: 1.05rem; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .reveal { transform: translateY(60px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
    .reveal.active { opacity: 1; transform: translateY(0); }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }

    /* About */
    .about-section { background: linear-gradient(180deg, var(--bg-secondary) 0%, var(--bg-primary) 100%); }
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: flex-start; }
    .about-image { position: relative; display: flex; justify-content: center; align-items: center; }
    .about-image { margin-top: -1.5rem; }
    .about-name-highlight { color: var(--accent-light); font-weight: 700; }
    .about-image .img-wrapper {
        width: 320px; height: 320px; border-radius: 50%; overflow: hidden;
        border: 3px solid rgba(0, 217, 255, 0.25); position: relative;
        background: linear-gradient(135deg, #1e293b, #111827);
        display: flex; align-items: center; justify-content: center;
        animation: float 6s ease-in-out infinite;
        box-shadow: 0 20px 60px rgba(0, 217, 255, 0.1);
    }
    html.light-theme .about-image .img-wrapper { background: linear-gradient(135deg, #e2e8f0, #f1f5f9) !important; }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        33% { transform: translateY(-10px); }
        66% { transform: translateY(5px); }
    }

    /* ===== About Cyber Security Animations ===== */
    .about-cyber-grid {
        position: absolute; inset: 0; border-radius: 50%;
        background-image:
            linear-gradient(rgba(0, 217, 255, 0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 217, 255, 0.04) 1px, transparent 1px);
        background-size: 34px 34px;
        -webkit-mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, rgba(0,0,0,0.6), transparent 75%);
        mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, rgba(0,0,0,0.6), transparent 75%);
        pointer-events: none;
    }
    .about-corner {
        position: absolute; width: 26px; height: 26px;
        border: 2px solid rgba(0, 217, 255, 0.55);
        z-index: 3; pointer-events: none;
        filter: drop-shadow(0 0 6px rgba(0, 217, 255, 0.5));
    }
    .about-corner.tl { top: 8px; left: 8px; border-width: 2px 0 0 2px; border-top-left-radius: 10px; }
    .about-corner.tr { top: 8px; right: 8px; border-width: 2px 2px 0 0; border-top-right-radius: 10px; }
    .about-corner.bl { bottom: 8px; left: 8px; border-width: 0 0 2px 2px; border-bottom-left-radius: 10px; }
    .about-corner.br { bottom: 8px; right: 8px; border-width: 0 2px 2px 0; border-bottom-right-radius: 10px; }
    .about-corner { display: none; }
    .about-scan { position: absolute; left: 12px; right: 12px; height: 3px; z-index: 2;
        background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.65), rgba(0, 217, 255, 0.8), transparent);
        animation: aboutScan 3s ease-in-out infinite;
        filter: drop-shadow(0 0 6px rgba(0, 255, 136, 0.6));
        border-radius: 2px;
    }
    @keyframes aboutScan {
        0% { top: 14%; opacity: 0; }
        12% { opacity: 1; }
        88% { opacity: 1; }
        100% { top: 86%; opacity: 0; }
    }
    .about-verify-badge {
        position: absolute; z-index: 3; right: -10px; bottom: 22px;
        display: inline-flex; align-items: center; gap: 0.45rem;
        padding: 0.5rem 0.95rem;
        background: rgba(6, 30, 22, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 255, 136, 0.35);
        border-radius: 50px;
        font-size: 0.72rem; font-weight: 700; letter-spacing: 0.4px;
        color: #00ff88;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
        animation: float 4s ease-in-out infinite;
        white-space: nowrap;
    }
    html.light-theme .about-verify-badge {
        background: rgba(255, 255, 255, 0.95);
        border-color: rgba(8, 145, 178, 0.4);
        color: #0d9488;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    .about-verify-badge .pulse-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: #00ff88;
        box-shadow: 0 0 0 0 rgba(0, 255, 136, 0.6);
        animation: pulseDot 1.6s ease-out infinite;
    }
    html.light-theme .about-verify-badge .pulse-dot { background: #0d9488; box-shadow: 0 0 0 0 rgba(13, 148, 136, 0.5); }
    @keyframes pulseDot {
        0% { box-shadow: 0 0 0 0 rgba(0, 255, 136, 0.6); }
        70% { box-shadow: 0 0 0 9px rgba(0, 255, 136, 0); }
        100% { box-shadow: 0 0 0 0 rgba(0, 255, 136, 0); }
    }
    .about-status {
        display: inline-flex; align-items: center; gap: 0.55rem;
        padding: 0.4rem 0.9rem; margin-bottom: 1.1rem;
        background: rgba(0, 255, 136, 0.06);
        border: 1px solid rgba(0, 255, 136, 0.2);
        border-radius: 50px;
        font-size: 0.72rem; font-weight: 600; letter-spacing: 0.3px;
        color: #00ff88;
    }
    html.light-theme .about-status {
        background: rgba(8, 145, 178, 0.06);
        border-color: rgba(8, 145, 178, 0.25);
        color: #0d9488;
    }
    .about-status .cursor-blink {
        width: 8px; height: 8px; border-radius: 2px;
        background: currentColor;
        animation: blinkCursor 1s steps(2, start) infinite;
    }
    @keyframes blinkCursor {
        to { visibility: hidden; }
    }
    @keyframes aboutDataScroll {
        0% { transform: translateY(0); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-14px); opacity: 0; }
    }
    .about-image .img-wrapper { animation: float 6s ease-in-out infinite; }
    .about-image .glow-ring {
        position: absolute; width: 340px; height: 340px;
        top: 50%; left: 50%; transform: translate(-50%, -50%);
        border-radius: 50%; border: 2px solid rgba(0, 217, 255, 0.15);
        animation: rotateRing 8s linear infinite;
    }
    @keyframes rotateRing {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
    .about-text { display: flex; gap: 2.5rem; align-items: flex-start; }
    .about-text h3 { font-size: 1.75rem; font-weight: 700; margin-bottom: 1rem; line-height: 1.3; }
    .about-text p { color: var(--text-secondary); line-height: 1.8; margin-bottom: 1rem; }
    .about-text-main { flex: 1; min-width: 0; }
    .about-text-main h3 {
        background: linear-gradient(135deg, #00d9ff, #7ce6ff, #6bffb8);
        background-size: 200% auto;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: navGradient 6s ease infinite;
    }
    html.light-theme .about-text-main h3 {
        background: linear-gradient(135deg, #0891b2, #0d9488, #059669);
        background-size: 200% auto;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: navGradient 6s ease infinite;
    }
    @keyframes navGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .about-bio-lead { position: relative; padding-left: 1.1rem; border-left: 3px solid rgba(0, 217, 255, 0.5); }
    .about-bio-lead p { margin-bottom: 0.8rem; }
    .about-bio-lead p:first-child::first-letter { font-size: 2.6em; float: left; line-height: 0.85; padding-right: 0.4rem; font-weight: 800; color: var(--text-secondary); opacity: 0.85; }
    .about-bio-lead p:last-child { margin-bottom: 0; }
    .about-bio-tags {
        display: flex; flex-wrap: wrap; gap: 0.55rem;
        margin-top: 1.4rem;
    }
    .about-bio-tag {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.4rem 0.85rem;
        background: rgba(0, 217, 255, 0.06);
        border: 1px solid rgba(0, 217, 255, 0.18);
        border-radius: 50px;
        font-size: 0.72rem; font-weight: 600; letter-spacing: 0.3px;
        color: #7ce6ff;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    html.light-theme .about-bio-tag { color: #0d9488; border-color: rgba(8, 145, 178, 0.25); background: rgba(8, 145, 178, 0.05); }
    .about-bio-tag i { font-size: 0.75rem; }
    .about-bio-tag:hover {
        transform: translateY(-3px);
        background: rgba(0, 217, 255, 0.14);
        border-color: rgba(0, 217, 255, 0.4);
        box-shadow: 0 6px 18px rgba(0, 217, 255, 0.15);
    }
    html.light-theme .about-bio-tag:hover { background: rgba(8, 145, 178, 0.1); border-color: rgba(8, 145, 178, 0.4); box-shadow: 0 6px 18px rgba(8, 145, 178, 0.12); }
    .about-tags-label {
        display: inline-flex; align-items: center; gap: 0.45rem;
        font-size: 0.68rem; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase;
        color: var(--text-muted);
        margin-top: 1.6rem; margin-bottom: 0.1rem;
    }
    .about-social-sidebar {
        display: flex; flex-direction: column; align-items: center; gap: 1rem;
        padding: 1.25rem 0.75rem; position: sticky; top: 2rem;
        background: rgba(0, 217, 255, 0.03);
        border: 1px solid rgba(0, 217, 255, 0.08);
        border-radius: 18px;
    }
    .about-social-sidebar .social-label {
        font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;
        letter-spacing: 1px; font-weight: 600; writing-mode: vertical-lr;
    }
    .about-social-sidebar .social-links {
        display: flex; flex-direction: column; gap: 0.6rem;
    }
    .about-social-sidebar .social-link {
        width: 44px; height: 44px; border-radius: 12px;
        background: rgba(0, 217, 255, 0.06);
        border: 1px solid rgba(0, 217, 255, 0.1);
        display: inline-flex; align-items: center; justify-content: center;
        color: var(--text-muted); font-size: 1.15rem;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .about-social-sidebar .social-link:hover {
        background: var(--accent-gradient); border-color: transparent;
        color: #fff; transform: translateY(-4px) scale(1.1);
        box-shadow: 0 8px 25px rgba(0, 217, 255, 0.3);
    }

    /* Stats — Redesigned */
    .about-stats {
        display: flex;
        gap: 1.25rem;
        margin-top: 2rem;
    }
    .stat-item {
        flex: 1;
        position: relative;
        padding: 1.6rem 1rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
        cursor: default;
    }
    .stat-item::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        transform: scaleX(0);
        transform-origin: center;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .stat-item:hover::before {
        transform: scaleX(1);
    }
    .stat-item:hover {
        transform: translateY(-8px) scale(1.03);
        border-color: var(--accent);
        box-shadow: 0 16px 50px rgba(0, 217, 255, 0.12);
    }
    .stat-item .stat-icon {
        width: 44px;
        height: 44px;
        margin: 0 auto 0.8rem;
        background: rgba(0, 217, 255, 0.08);
        border: 1px solid rgba(0, 217, 255, 0.15);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        color: var(--accent-light);
        transition: all 0.4s ease;
    }
    .stat-item:hover .stat-icon {
        background: var(--accent-gradient);
        border-color: transparent;
        color: #fff;
        transform: scale(1.1) rotate(-5deg);
        box-shadow: 0 8px 25px rgba(0, 217, 255, 0.25);
    }
    .stat-item .number {
        font-size: 2.2rem;
        font-weight: 900;
        background: linear-gradient(135deg, var(--accent-light), #6bffb8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin-bottom: 0.25rem;
        letter-spacing: -1px;
        transition: all 0.3s ease;
        filter: drop-shadow(0 0 12px rgba(0, 217, 255, 0.25));
    }
    .stat-item:hover .number {
        background: linear-gradient(135deg, #7ce6ff, #3dffa3);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        filter: drop-shadow(0 0 20px rgba(0, 217, 255, 0.45));
    }
    .stat-item .label {
        font-size: 0.78rem;
        color: var(--text-muted);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: color 0.3s ease;
    }
    .stat-item:hover .label {
        color: var(--text-secondary);
    }
    .stat-item .stat-glow {
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(0, 217, 255, 0.06), transparent 70%);
        top: -40px;
        right: -40px;
        pointer-events: none;
        transition: all 0.5s ease;
    }
    .stat-item:hover .stat-glow {
        transform: scale(2);
        opacity: 0.5;
    }
    html.light-theme .stat-item {
        background: rgba(255, 255, 255, 0.85) !important;
    }
    html.light-theme .stat-item:hover {
        box-shadow: 0 16px 50px rgba(0, 217, 255, 0.15) !important;
    }

    /* ===== Light-theme polish for about cyber UI ===== */
    html.light-theme .about-name-highlight { color: #0891b2; }
    html.light-theme .stat-item .stat-icon { color: #0e7490; }
    html.light-theme .stat-item:hover .stat-icon {
        background: var(--accent-gradient);
        box-shadow: 0 8px 25px rgba(8, 145, 178, 0.25);
    }
    html.light-theme .stat-item .number {
        background: linear-gradient(135deg, #0891b2, #059669);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        filter: drop-shadow(0 0 6px rgba(8, 145, 178, 0.15));
    }
    html.light-theme .stat-item:hover .number {
        background: linear-gradient(135deg, #0e7490, #047857);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        filter: drop-shadow(0 0 10px rgba(8, 145, 178, 0.25));
    }
    html.light-theme .about-scan {
        background: linear-gradient(90deg, transparent, rgba(5, 150, 105, 0.55), rgba(8, 145, 178, 0.7), transparent);
        filter: drop-shadow(0 0 5px rgba(5, 150, 105, 0.35));
    }
    html.light-theme .about-bio-lead { border-left-color: rgba(8, 145, 178, 0.45); }
    html.light-theme .about-image .img-wrapper { border-color: rgba(8, 145, 178, 0.25); }
    html.light-theme .about-image .glow-ring { border-color: rgba(8, 145, 178, 0.15); }

    /* ===== SERVICES — PURE WATER WAVE EFFECT (no boxes, no grid) ===== */
    .services-section {
        background: linear-gradient(180deg, #070d15 0%, #0a1420 40%, #0e1e2e 70%, #112436 100%);
        position: relative;
        overflow: hidden;
    }
    .services-section .services-container {
        max-width: 100%;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
    html.light-theme .services-section {
        background: linear-gradient(180deg, #e6eef5 0%, #dbe7f0 40%, #cfddea 70%, #c3d5e4 100%);
    }

    /* Deep water caustics overlay */
    .services-section::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background:
            radial-gradient(ellipse at 20% 50%, rgba(0, 217, 255, 0.03), transparent 50%),
            radial-gradient(ellipse at 80% 30%, rgba(56, 189, 248, 0.025), transparent 50%),
            radial-gradient(ellipse at 50% 80%, rgba(0, 217, 255, 0.02), transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    /* Cyber top divider line (replaces surface water wave) */
    .services-section .water-surface {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        z-index: 3;
        pointer-events: none;
        overflow: hidden;
    }
    .services-section .water-surface .wave {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        width: 100%; height: 100%;
        border-radius: 0;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 217, 255, 0.7) 30%,
            rgba(0, 255, 136, 0.9) 50%,
            rgba(0, 217, 255, 0.7) 70%,
            transparent 100%
        );
        background-size: 200% 100%;
        filter: drop-shadow(0 0 6px rgba(0, 217, 255, 0.5));
    }
    .services-section .water-surface .wave:nth-child(1) {
        animation: surfaceWave1 4s linear infinite;
        opacity: 0.8;
    }
    .services-section .water-surface .wave:nth-child(2) {
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 255, 136, 0.4) 50%,
            transparent 100%
        );
        background-size: 150% 100%;
        animation: surfaceWave2 6s linear infinite;
        opacity: 0.6;
    }
    @keyframes surfaceWave1 {
        0%   { background-position: -100% 0; }
        100% { background-position: 100% 0; }
    }
    @keyframes surfaceWave2 {
        0%   { background-position: 150% 0; }
        100% { background-position: -150% 0; }
    }

    /* ===== WAVE SCENE — continuous full-width water body ===== */
    .wave-scene {
        position: relative;
        z-index: 2;
        min-height: 500px;
        padding: 2rem 0;
        overflow: hidden;
    }

    /* ---- Full-width flowing wave layers ---- */
    /* Wave Layer 1 — deepest, slowest, darkest */
    .wave-scene::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background:
            linear-gradient(rgba(0, 217, 255, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 217, 255, 0.05) 1px, transparent 1px);
        background-size: 42px 42px;
        -webkit-mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, rgba(0,0,0,0.85), transparent 85%);
        mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, rgba(0,0,0,0.85), transparent 85%);
        pointer-events: none;
        z-index: 0;
        animation: cyberGrid 5s linear infinite;
        will-change: transform;
    }
    @keyframes cyberGrid {
        0%   { background-position: 0 0; }
        100% { background-position: 0 42px; }
    }
    /* Wave Layer 2 — mid, medium speed */
    .wave-scene::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(180deg,
            transparent 0%,
            rgba(0, 217, 255, 0.05) 8%,
            rgba(0, 217, 255, 0.12) 12%,
            rgba(0, 217, 255, 0.05) 16%,
            transparent 24%
        );
        background-size: 100% 400px;
        background-repeat: no-repeat;
        filter: drop-shadow(0 0 10px rgba(0, 217, 255, 0.3));
        pointer-events: none;
        z-index: 1;
        animation: cyberScanMove 6s linear infinite;
    }
    @keyframes cyberScanMove {
        0%   { background-position: 0 -120px; opacity: 0; }
        10%  { opacity: 1; }
        90%  { opacity: 1; }
        100% { background-position: 0 500px; opacity: 0; }
    }

    /* Cyber data-stream bar (replaces foreground wave) */
    .wave-scene .wave-layer {
        position: absolute;
        top: 62%;
        left: 0; right: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 217, 255, 0.1) 20%,
            rgba(0, 255, 136, 0.7) 50%,
            rgba(0, 217, 255, 0.1) 80%,
            transparent 100%
        );
        filter: drop-shadow(0 0 8px rgba(0, 217, 255, 0.5));
        pointer-events: none;
        z-index: 2;
        animation: dataStream 3s linear infinite;
        opacity: 0.6;
    }
    @keyframes dataStream {
        0%   { transform: translateX(-40%); }
        100% { transform: translateX(40%); }
    }

    /* Cyber data-stream bar 2 */
    .wave-scene .wave-layer-2 {
        position: absolute;
        top: 80%;
        left: 0; right: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 255, 136, 0.5) 50%,
            transparent 100%
        );
        filter: drop-shadow(0 0 6px rgba(0, 255, 136, 0.4));
        pointer-events: none;
        z-index: 3;
        animation: dataStream2 5s linear infinite;
        opacity: 0.5;
    }
    @keyframes dataStream2 {
        0%   { transform: translateX(40%); }
        100% { transform: translateX(-40%); }
    }

    /* Wave flow keyframes — pure linear translation, no scale, for smooth flowing water */
    @keyframes waveDeep {
        0%   { transform: translateX(0); opacity: 0.4; }
        100% { transform: translateX(-25%); opacity: 0.6; }
    }
    @keyframes waveMid {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-25%); }
    }
    @keyframes waveFront {
        0%   { transform: translateX(0); }
        100% { transform: translateX(25%); }
    }
    @keyframes waveFront2 {
        0%   { transform: translateX(0); }
        100% { transform: translateX(-30%); }
    }

    /* Cyber vertical scanner beam (replaces water shimmer) */
    .wave-scene .wave-shimmer {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(90deg,
            transparent 0%,
            transparent 40%,
            rgba(0, 217, 255, 0.06) 49%,
            rgba(0, 255, 136, 0.12) 50%,
            rgba(0, 217, 255, 0.06) 51%,
            transparent 60%,
            transparent 100%
        );
        width: 100%;
        background-size: 200% 100%;
        filter: drop-shadow(0 0 8px rgba(0, 217, 255, 0.3));
        pointer-events: none;
        z-index: 4;
        animation: scannerSweep 4s linear infinite;
        opacity: 0.7;
    }
    @keyframes scannerSweep {
        0%   { background-position: 120% 0; }
        100% { background-position: -120% 0; }
    }

    /* Mouse-responsive cyber ripple (subtle) */
    .wave-scene .wave-ripple {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.05), transparent 60%);
        pointer-events: none;
        z-index: 5;
        opacity: 0;
        transition: opacity 0.6s ease;
    }
    .wave-scene:hover .wave-ripple {
        opacity: 1;
    }

    /* Floating binary glyphs rising (replaces water bubbles) */
    .wave-scene .wave-bubbles {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 100%;
        pointer-events: none;
        z-index: 2;
        overflow: hidden;
    }
    .wave-scene .wave-bubbles .bub {
        position: absolute;
        bottom: -8px;
        width: 4px; height: 4px;
        border-radius: 0;
        background: rgba(0, 255, 136, 0.5);
        box-shadow: 0 0 6px rgba(0, 255, 136, 0.5), 0 0 12px rgba(0, 217, 255, 0.3);
        opacity: 0;
    }
    .wave-scene .wave-bubbles .bub:nth-child(1)  { left: 5%;  width: 3px;  height: 3px;  animation: bubRise 5s ease-out infinite; animation-delay: 0s; }
    .wave-scene .wave-bubbles .bub:nth-child(2)  { left: 12%; width: 5px;  height: 5px;  animation: bubRise 6s ease-out infinite; animation-delay: 0.8s; }
    .wave-scene .wave-bubbles .bub:nth-child(3)  { left: 22%; width: 2px;  height: 2px;  animation: bubRise 4s ease-out infinite; animation-delay: 0.4s; }
    .wave-scene .wave-bubbles .bub:nth-child(4)  { left: 30%; width: 4px;  height: 4px;  animation: bubRise 5.5s ease-out infinite; animation-delay: 1.6s; }
    .wave-scene .wave-bubbles .bub:nth-child(5)  { left: 40%; width: 3px;  height: 3px;  animation: bubRise 4.5s ease-out infinite; animation-delay: 0.2s; }
    .wave-scene .wave-bubbles .bub:nth-child(6)  { left: 48%; width: 6px;  height: 6px;  animation: bubRise 7s ease-out infinite; animation-delay: 2s; }
    .wave-scene .wave-bubbles .bub:nth-child(7)  { left: 55%; width: 3px;  height: 3px;  animation: bubRise 5s ease-out infinite; animation-delay: 1s; }
    .wave-scene .wave-bubbles .bub:nth-child(8)  { left: 65%; width: 4px;  height: 4px;  animation: bubRise 6.5s ease-out infinite; animation-delay: 0.6s; }
    .wave-scene .wave-bubbles .bub:nth-child(9)  { left: 75%; width: 2px;  height: 2px;  animation: bubRise 3.8s ease-out infinite; animation-delay: 1.4s; }
    .wave-scene .wave-bubbles .bub:nth-child(10) { left: 85%; width: 5px;  height: 5px;  animation: bubRise 5.5s ease-out infinite; animation-delay: 0.3s; }
    .wave-scene .wave-bubbles .bub:nth-child(11) { left: 93%; width: 3px;  height: 3px;  animation: bubRise 4.2s ease-out infinite; animation-delay: 1.8s; }
    .wave-scene .wave-bubbles .bub:nth-child(12) { left: 98%; width: 4px;  height: 4px;  animation: bubRise 6s ease-out infinite; animation-delay: 0.9s; }
    @keyframes bubRise {
        0%   { transform: translateY(0) scale(0); opacity: 0; }
        15%  { opacity: 0.4; }
        60%  { opacity: 0.2; transform: translateY(calc(-100% - 400px)) scale(1); }
        100% { transform: translateY(calc(-100% - 400px)) scale(0); opacity: 0; }
    }

    /* ---- Service content floating within the waves (no boxes!) ---- */
    .wave-services {
        position: relative;
        z-index: 6;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2.5rem 3rem;
        padding: 3rem 0;
    }

    .wave-service {
        flex: 0 1 300px;
        text-align: center;
        padding: 2.2rem 1.6rem 1.8rem;
        position: relative;
        cursor: default;
    }
    .wave-service > * { position: relative; z-index: 2; }
    .wave-service .ws-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: var(--accent-light);
        background: rgba(0, 217, 255, 0.08);
        border: 1px solid rgba(0, 217, 255, 0.10);
        border-radius: 18px;
        transition: all 0.4s ease;
    }
    .wave-service:hover .ws-icon {
        background: var(--accent-gradient);
        border-color: transparent;
        color: #fff;
        transform: scale(1.1) rotate(-4deg);
        box-shadow: 0 8px 25px rgba(0, 217, 255, 0.25);
    }
    .wave-service h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        line-height: 1.3;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }
    .wave-service p {
        font-size: 0.85rem;
        color: var(--text-secondary);
        line-height: 1.6;
        margin: 0;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
    }

    /* ===== SERVICES CYBER HUD OVERLAY ===== */
    .ws-cyber {
        position: absolute; inset: 0; border-radius: 20px; pointer-events: none;
        background: rgba(8, 18, 30, 0.35);
        border: 1px solid rgba(0, 217, 255, 0.14);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        box-shadow: 0 18px 50px rgba(0, 0, 0, 0.35);
        transition: border-color 0.4s ease, box-shadow 0.4s ease;
    }
    html.light-theme .ws-cyber {
        background: rgba(255, 255, 255, 0.55);
        border-color: rgba(0, 217, 255, 0.2);
        box-shadow: 0 18px 50px rgba(0, 0, 0, 0.08);
    }
    .wave-service:hover .ws-cyber {
        border-color: rgba(0, 217, 255, 0.5);
        box-shadow: 0 20px 60px rgba(0, 217, 255, 0.18);
    }
    html.light-theme .wave-service:hover .ws-cyber { box-shadow: 0 20px 60px rgba(0, 217, 255, 0.15); }

    /* HUD corner brackets */
    .ws-corner { position: absolute; width: 18px; height: 18px; border: 2px solid rgba(0, 217, 255, 0.6); z-index: 3; }
    .ws-corner.tl { top: 8px; left: 8px; border-width: 2px 0 0 2px; border-top-left-radius: 8px; }
    .ws-corner.tr { top: 8px; right: 8px; border-width: 2px 2px 0 0; border-top-right-radius: 8px; }
    .ws-corner.bl { bottom: 8px; left: 8px; border-width: 0 0 2px 2px; border-bottom-left-radius: 8px; }
    .ws-corner.br { bottom: 8px; right: 8px; border-width: 0 2px 2px 0; border-bottom-right-radius: 8px; }

    /* Card scan line */
    .ws-scan {
        position: absolute; left: 12px; right: 12px; height: 2px; z-index: 3;
        background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.6), transparent);
        filter: drop-shadow(0 0 5px rgba(0, 255, 136, 0.5));
        opacity: 0;
    }
    .wave-service:hover .ws-scan { animation: wsScan 2.2s ease-in-out infinite; }
    @keyframes wsScan {
        0% { top: 12%; opacity: 0; }
        15% { opacity: 1; }
        85% { opacity: 1; }
        100% { top: 88%; opacity: 0; }
    }

    /* Pulsing ring behind icon */
    .wave-service .ws-icon { position: relative; }
    .wave-service .ws-icon::before {
        content: ''; position: absolute; inset: -9px; border-radius: 22px;
        border: 1px solid rgba(0, 217, 255, 0.4);
        animation: wsPulse 2.6s ease-out infinite; opacity: 0;
    }
    .wave-service:hover .ws-icon::before { opacity: 1; }
    @keyframes wsPulse {
        0% { transform: scale(0.85); opacity: 0.8; }
        100% { transform: scale(1.35); opacity: 0; }
    }

    /* Cyber status tag */
    .ws-status {
        display: inline-flex; align-items: center; gap: 0.35rem;
        margin-top: 0.6rem; padding: 0.22rem 0.6rem;
        font-size: 0.62rem; font-weight: 700; letter-spacing: 0.5px;
        color: #00ff88; background: rgba(0, 255, 136, 0.06);
        border: 1px solid rgba(0, 255, 136, 0.18);
        border-radius: 50px; text-transform: uppercase;
    }
    .ws-status .ws-dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: #00ff88; box-shadow: 0 0 0 0 rgba(0, 255, 136, 0.6);
        animation: wsDot 1.8s ease-out infinite;
    }
    html.light-theme .ws-status { color: #0d9488; background: rgba(13, 148, 136, 0.06); border-color: rgba(13, 148, 136, 0.25); }
    html.light-theme .ws-status .ws-dot { background: #0d9488; box-shadow: 0 0 0 0 rgba(13, 148, 136, 0.5); }
    @keyframes wsDot {
        0% { box-shadow: 0 0 0 0 rgba(0, 255, 136, 0.6); }
        70% { box-shadow: 0 0 0 7px rgba(0, 255, 136, 0); }
        100% { box-shadow: 0 0 0 0 rgba(0, 255, 136, 0); }
    }

    /* Floating binary particles in section */
    .ws-particle {
        position: absolute; z-index: 1; color: rgba(0, 217, 255, 0.5);
        font-size: 0.7rem; font-family: 'Consolas', monospace; font-weight: 700;
        pointer-events: none; user-select: none;
        animation: wsFloat linear infinite;
        opacity: 0;
    }
    @keyframes wsFloat {
        0% { transform: translateY(20px); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-140px); opacity: 0; }
    }

    /* Rotating radar ring behind services */
    .ws-radar {
        position: absolute; z-index: 1; top: 50%; left: 50%;
        width: 420px; height: 420px; transform: translate(-50%, -50%);
        border-radius: 50%; pointer-events: none;
        border: 1px solid rgba(0, 217, 255, 0.12);
        opacity: 0.8;
    }
    .ws-radar::before, .ws-radar::after {
        content: ''; position: absolute; inset: 0; border-radius: 50%;
    }
    .ws-radar::before {
        border: 1px dashed rgba(0, 217, 255, 0.15);
        animation: wsRadarSpin 20s linear infinite;
    }
    .ws-radar::after {
        background: conic-gradient(from 0deg, rgba(0, 217, 255, 0.15), transparent 60deg, transparent 360deg);
        animation: wsRadarSpin 4s linear infinite;
    }
    @keyframes wsRadarSpin {
        to { transform: rotate(360deg); }
    }
    html.light-theme .services-section .ws-radar { border-color: rgba(0, 217, 255, 0.25); }
    html.light-theme .services-section .ws-radar::before { border-color: rgba(0, 217, 255, 0.2); }

    /* Cyber bottom divider line (replaces bottom water waves) */
    .services-section .bottom-waves {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        z-index: 3;
        pointer-events: none;
        overflow: hidden;
    }
    .services-section .bottom-waves .wave {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        width: 100%; height: 100%;
        border-radius: 0;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 217, 255, 0.5) 30%,
            rgba(0, 255, 136, 0.8) 50%,
            rgba(0, 217, 255, 0.5) 70%,
            transparent 100%
        );
        background-size: 200% 100%;
        filter: drop-shadow(0 0 6px rgba(0, 217, 255, 0.5));
    }
    .services-section .bottom-waves .wave:nth-child(1) {
        animation: bottomWave1 4s linear infinite;
        opacity: 0.8;
    }
    .services-section .bottom-waves .wave:nth-child(2) {
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 255, 136, 0.35) 50%,
            transparent 100%
        );
        background-size: 140% 100%;
        animation: bottomWave2 7s linear infinite;
        opacity: 0.6;
    }
    .services-section .bottom-waves .wave:nth-child(3) {
        background: rgba(0, 217, 255, 0.15);
        animation: none;
        opacity: 0.5;
    }
    @keyframes bottomWave1 {
        0%   { background-position: -100% 0; }
        100% { background-position: 100% 0; }
    }
    @keyframes bottomWave2 {
        0%   { background-position: 140% 0; }
        100% { background-position: -140% 0; }
    }

    /* Cyber gradient divider (end of every section) */
    section:has(> .section-divider) { position: relative; }
    .section-divider {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 217, 255, 0.5) 30%,
            rgba(0, 255, 136, 0.85) 50%,
            rgba(0, 217, 255, 0.5) 70%,
            transparent 100%
        );
        background-size: 200% 100%;
        animation: dividerFlow 4s linear infinite;
        opacity: 0.8;
        pointer-events: none;
        z-index: 3;
    }
    html.light-theme .section-divider {
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(8, 145, 178, 0.45) 30%,
            rgba(13, 148, 136, 0.75) 50%,
            rgba(8, 145, 178, 0.45) 70%,
            transparent 100%
        );
        background-size: 200% 100%;
    }
    @keyframes dividerFlow {
        0%   { background-position: -100% 0; }
        100% { background-position: 100% 0; }
    }

    /* ---- Light theme ---- */
    html.light-theme .services-section::before {
        background:
            radial-gradient(ellipse at 20% 50%, rgba(0, 217, 255, 0.04), transparent 50%),
            radial-gradient(ellipse at 80% 30%, rgba(56, 189, 248, 0.03), transparent 50%);
    }
    html.light-theme .wave-scene::before {
        background:
            linear-gradient(rgba(0, 217, 255, 0.06) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 217, 255, 0.06) 1px, transparent 1px);
        background-size: 42px 42px;
    }
    html.light-theme .wave-scene::after {
        background: linear-gradient(180deg,
            transparent 0%,
            rgba(0, 217, 255, 0.05) 8%,
            rgba(0, 217, 255, 0.10) 12%,
            rgba(0, 217, 255, 0.05) 16%,
            transparent 24%
        );
        background-size: 100% 400px;
        background-repeat: no-repeat;
        animation: cyberScanMove 6s linear infinite;
    }
    html.light-theme .wave-scene .wave-layer {
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 217, 255, 0.04) 20%,
            rgba(0, 255, 136, 0.6) 50%,
            rgba(0, 217, 255, 0.04) 80%,
            transparent 100%
        );
    }
    html.light-theme .wave-scene .wave-layer-2 {
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 255, 136, 0.45) 50%,
            transparent 100%
        );
    }
    html.light-theme .wave-scene .wave-ripple {
        background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.05), transparent 60%);
    }
    html.light-theme .wave-scene .wave-bubbles .bub {
        background: rgba(0, 255, 136, 0.5);
    }
    html.light-theme .wave-service h3 {
        color: #111827;
        text-shadow: 0 2px 8px rgba(255, 255, 255, 0.5);
    }
    html.light-theme .wave-service p,
    html.light-theme .wave-service .ws-status {
        text-shadow: none;
    }
    html.light-theme .wave-service .ws-icon {
        background: rgba(255, 255, 255, 0.7);
        border-color: rgba(0, 217, 255, 0.15);
    }
    html.light-theme .wave-service:hover .ws-icon {
        background: var(--accent-gradient);
        border-color: transparent;
    }
    html.light-theme .wave-service .ws-icon { color: #0e7490; }
    html.light-theme .ws-corner { border-color: rgba(8, 145, 178, 0.55); }
    html.light-theme .ws-scan {
        background: linear-gradient(90deg, transparent, rgba(5, 150, 105, 0.55), transparent);
        filter: drop-shadow(0 0 5px rgba(5, 150, 105, 0.35));
    }
    html.light-theme .ws-particle { color: rgba(8, 145, 178, 0.5); }
    html.light-theme .wave-service .ws-icon::before { border-color: rgba(8, 145, 178, 0.35); }
    html.light-theme .wave-service:hover .ws-icon { box-shadow: 0 8px 25px rgba(8, 145, 178, 0.25); }
    html.light-theme .services-section .water-surface .wave:nth-child(1) {
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(8, 145, 178, 0.5) 30%,
            rgba(13, 148, 136, 0.8) 50%,
            rgba(8, 145, 178, 0.5) 70%,
            transparent 100%
        );
        background-size: 200% 100%;
    }
    html.light-theme .services-section .water-surface .wave:nth-child(2) {
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(13, 148, 136, 0.4) 50%,
            transparent 100%
        );
        background-size: 150% 100%;
    }
    html.light-theme .services-section .bottom-waves .wave:nth-child(1) {
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(8, 145, 178, 0.4) 30%,
            rgba(13, 148, 136, 0.7) 50%,
            rgba(8, 145, 178, 0.4) 70%,
            transparent 100%
        );
        background-size: 200% 100%;
    }
    html.light-theme .services-section .bottom-waves .wave:nth-child(2) {
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(13, 148, 136, 0.35) 50%,
            transparent 100%
        );
        background-size: 140% 100%;
    }
    html.light-theme .services-section .bottom-waves .wave:nth-child(3) {
        background: rgba(8, 145, 178, 0.15);
    }

    /* ---- Mobile: grid cards ---- */
    @media (max-width: 768px) {
        .services-section .water-surface { height: 3px; }
        .services-section .water-surface .wave { height: 100%; }
        .services-section .bottom-waves { height: 3px; }
        .services-section .bottom-waves .wave { height: 100%; }
        .wave-scene { min-height: auto; padding: 1rem 0; }
        .wave-scene .wave-bubbles .bub { display: none; }
        .wave-scene .wave-shimmer { opacity: 0.3; }
        .wave-scene .wave-layer-2 { display: none; }
        .wave-services {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem; padding: 2rem 0;
        }
        .wave-service { flex: none; text-align: center; padding: 1.8rem 1.2rem 1.5rem; }
        .wave-service:hover .ws-icon { background: var(--accent-gradient); border-color: transparent; color: #fff; transform: scale(1.1) rotate(-4deg); box-shadow: 0 8px 25px rgba(0, 217, 255, 0.25); }
        .wave-service .ws-icon { width: 44px; height: 44px; font-size: 1.2rem; margin-bottom: 0.75rem; }
        .wave-service h3 { font-size: 0.95rem; margin-bottom: 0.4rem; }
        .wave-service p { font-size: 0.8rem; line-height: 1.5; }
    }
    @media (max-width: 480px) {
        .wave-services { grid-template-columns: 1fr; gap: 1.5rem; padding: 2rem 0.5rem; }
        .wave-service { padding: 1.6rem 1rem 1.4rem; }
        .wave-service .ws-icon { width: 44px; height: 44px; font-size: 1.1rem; margin-bottom: 0.6rem; }
        .wave-service h3 { font-size: 0.95rem; margin-bottom: 0.4rem; }
        .wave-service p { font-size: 0.82rem; line-height: 1.5; }
    }
    @media (max-width: 360px) {
        .wave-services { grid-template-columns: 1fr; gap: 1.25rem; padding: 1.5rem 0.25rem; }
    }

    /* Mobile responsive for cyber security elements */
    @media (max-width: 992px) {
        .data-stream { display: none; }
        .hex-pattern { display: none; }
    }
    @media (max-width: 768px) {
        .cyber-grid { display: none; }
        .scan-lines { display: none; }
        .float-chip { font-size: 0.65rem; padding: 0.4rem 0.8rem; }
        .float-chip.c1 { right: 2%; }
        .float-chip.c2 { left: 2%; }
        .float-chip.c3 { left: 5%; }
    }

    /* ── Case Studies ── */
    .casestudy-section {
        background: linear-gradient(180deg, #080b12 0%, var(--bg-primary) 100%);
        position: relative; overflow: hidden;
    }
    html.light-theme .casestudy-section {
        background: linear-gradient(180deg, #f1f5f9 0%, #f8fafc 100%);
    }
    .casestudy-section::before {
        content: ''; position: absolute;
        top: -20%; right: -10%; width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(0,217,255,0.06) 0%, transparent 70%);
        pointer-events: none;
    }
    html.light-theme .casestudy-section::before {
        background: radial-gradient(circle, rgba(0,217,255,0.04) 0%, transparent 70%);
    }

    /* ── Threat-intel grid backdrop ── */
    .cs-grid-bg {
        position: absolute; inset: 0; pointer-events: none; z-index: 0; opacity: .5;
        background-image:
            linear-gradient(90deg, rgba(0,217,255,.04) 1px, transparent 1px),
            linear-gradient(rgba(0,217,255,.04) 1px, transparent 1px);
        background-size: 44px 44px;
        -webkit-mask-image: radial-gradient(ellipse 70% 55% at 50% 20%, black 20%, transparent 75%);
        mask-image: radial-gradient(ellipse 70% 55% at 50% 20%, black 20%, transparent 75%);
    }

    .casestudy-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; max-width: 1200px; margin: 0 auto; position: relative; z-index: 1; }

    /* ── HUD threat panel card ── */
    .casestudy-card {
        position: relative;
        background: rgba(8,12,20,.72);
        backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(0,217,255,.14);
        border-radius: 14px; overflow: hidden;
        transition: all .5s cubic-bezier(.16,1,.3,1);
        text-decoration: none; display: block; cursor: pointer;
    }
    html.light-theme .casestudy-card {
        background: rgba(255,255,255,.78);
        border-color: rgba(0,217,255,.18);
    }
    /* corner brackets */
    .casestudy-card .cs-corners {
        position: absolute; inset: 0; pointer-events: none; z-index: 4;
    }
    .casestudy-card .cs-corners span {
        position: absolute; width: 16px; height: 16px;
        border-color: rgba(0,217,255,.35); border-style: solid; border-width: 0;
        transition: border-color .3s;
    }
    .casestudy-card:hover .cs-corners span { border-color: rgba(0,217,255,.8); }
    .casestudy-card .cs-corners .tl { top: 6px; left: 6px; border-top-width: 1px; border-left-width: 1px; }
    .casestudy-card .cs-corners .tr { top: 6px; right: 6px; border-top-width: 1px; border-right-width: 1px; }
    .casestudy-card .cs-corners .bl { bottom: 6px; left: 6px; border-bottom-width: 1px; border-left-width: 1px; }
    .casestudy-card .cs-corners .br { bottom: 6px; right: 6px; border-bottom-width: 1px; border-right-width: 1px; }

    .casestudy-card:hover {
        border-color: rgba(0,217,255,.4);
        box-shadow: 0 20px 60px rgba(0,217,255,.1), inset 0 0 30px rgba(0,217,255,.04);
        transform: translateY(-6px);
    }
    html.light-theme .casestudy-card:hover { box-shadow: 0 20px 60px rgba(0,217,255,.14); }

    /* top header bar */
    .cs-header {
        position: relative; z-index: 3;
        display: flex; align-items: center; justify-content: space-between;
        padding: .9rem 1.1rem;
        background: rgba(0,217,255,.05);
        border-bottom: 1px solid rgba(0,217,255,.1);
    }
    html.light-theme .cs-header { background: rgba(0,100,140,.05); border-color: rgba(0,100,140,.12); }
    .cs-header .cs-fileid {
        font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: .62rem; font-weight: 700; color: var(--accent);
        letter-spacing: .08em; text-transform: uppercase;
    }
    html.light-theme .cs-header .cs-fileid { color: #0e7490; }
    html.light-theme .cs-analyze-btn { color: #0e7490; }
    html.light-theme .casestudy-card:hover .cs-analyze-btn {
        color: #fff;
        background: linear-gradient(135deg, #0891b2, #0e7490);
        border-color: transparent;
        box-shadow: 0 0 12px rgba(8, 145, 178, 0.25);
    }
    html.light-theme .cs-meta i { color: #0e7490; }
    html.light-theme .cs-grid-bg {
        background-image:
            linear-gradient(90deg, rgba(8, 145, 178, 0.05) 1px, transparent 1px),
            linear-gradient(rgba(8, 145, 178, 0.05) 1px, transparent 1px);
    }
    html.light-theme .casestudy-cta::before {
        background: linear-gradient(90deg, transparent, #0891b2, #059669, transparent);
    }
    html.light-theme .casestudy-image::after {
        background: linear-gradient(180deg, rgba(8, 145, 178, 0.1), transparent 30%, transparent 70%, rgba(15, 23, 42, 0.15));
    }
    .cs-header .cs-status {
        display: inline-flex; align-items: center; gap: .35rem;
        font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: .6rem; font-weight: 700; color: #00ff88;
        letter-spacing: .08em; text-transform: uppercase;
    }
    html.light-theme .cs-header .cs-status { color: #00884a; }
    .cs-header .cs-status .csdot {
        width: 6px; height: 6px; border-radius: 50%;
        background: #00ff88; box-shadow: 0 0 8px #00ff88;
        animation: csBlink 1s step-end infinite;
    }
    html.light-theme .cs-header .cs-status .csdot { background: #00884a; box-shadow: 0 0 8px rgba(0,136,74,.6); }
    @keyframes csBlink { 50% { opacity: .3; } }

    /* image / radar zone */
    .casestudy-image { position: relative; width: 100%; height: 168px; overflow: hidden; margin: .9rem 1.1rem 0; width: calc(100% - 2.2rem); border-radius: 8px; border: 1px solid rgba(0,217,255,.1); z-index: 2; }
    .casestudy-image img { width: 100%; height: 100%; object-fit: cover; transition: transform .7s cubic-bezier(.16,1,.3,1); }
    .casestudy-card:hover .casestudy-image img { transform: scale(1.06); }
    .casestudy-image::after {
        content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(180deg, rgba(0,217,255,.12), transparent 30%, transparent 70%, rgba(8,11,18,.5));
        pointer-events: none;
    }
    /* scanline sweep over image */
    .casestudy-image::before {
        content: ''; position: absolute; left: 0; right: 0; height: 1px; top: 0; z-index: 2;
        background: linear-gradient(90deg, transparent, rgba(0,217,255,.6), transparent);
        opacity: 0; pointer-events: none;
    }
    .casestudy-card:hover .casestudy-image::before {
        opacity: 1; animation: csImgScan 1.4s ease-in-out infinite;
    }
    @keyframes csImgScan {
        0%   { top: 0; opacity: 0; }
        15%  { opacity: 1; }
        85%  { opacity: 1; }
        100% { top: 100%; opacity: 0; }
    }

    /* category chip */
    .cs-category {
        position: absolute; top: .75rem; left: .75rem; z-index: 3;
        font-family: 'JetBrains Mono', Consolas, monospace;
        background: rgba(8,11,18,.75); color: var(--accent);
        border: 1px solid rgba(0,217,255,.35);
        padding: .3rem .75rem; border-radius: 6px;
        font-size: .62rem; font-weight: 700; letter-spacing: .06em;
        clip-path: polygon(8px 0, 100% 0, 100% calc(100% - 8px), calc(100% - 8px) 100%, 0 100%, 0 8px);
        backdrop-filter: blur(4px);
    }
    html.light-theme .cs-category { color: var(--accent); }

    /* radar placeholder (no image) */
    .cs-radar-ph {
        position: relative; margin: .9rem 1.1rem 0; height: 168px;
        border-radius: 8px; border: 1px solid rgba(0,217,255,.1);
        overflow: hidden; background: rgba(0,217,255,.02);
    }
    html.light-theme .cs-radar-ph { background: rgba(0,100,140,.03); border-color: rgba(0,100,140,.12); }
    .cs-radar-ph::before {
        content: ''; position: absolute; inset: 0;
        background:
            linear-gradient(90deg, rgba(0,217,255,.05) 1px, transparent 1px),
            linear-gradient(rgba(0,217,255,.05) 1px, transparent 1px);
        background-size: 24px 24px;
    }
    .cs-radar-ph .rr {
        position: absolute; border-radius: 50%;
        border: 1px solid rgba(0,217,255,.18);
        top: 50%; left: 50%; transform: translate(-50%,-50%);
    }
    .cs-radar-ph .rr.r1 { width: 120px; height: 120px; animation: csSpin 8s linear infinite; border-style: dashed; }
    .cs-radar-ph .rr.r2 { width: 80px; height: 80px; }
    .cs-radar-ph .rr.r3 { width: 40px; height: 40px; }
    .cs-radar-ph .beam {
        position: absolute; top: 50%; left: 50%; width: 60px; height: 60px;
        margin: -30px 0 0 -30px;
        background: conic-gradient(from 0deg, rgba(0,217,255,.25), transparent 40%);
        border-radius: 50%;
        animation: csSpin 2.4s linear infinite;
    }
    @keyframes csSpin { to { transform: rotate(360deg); } }
    .cs-radar-ph .cs-scan-h {
        position: absolute; left: 0; right: 0; height: 1px; top: 0;
        background: linear-gradient(90deg, transparent, rgba(0,217,255,.4), transparent);
        animation: csVerticalScan 3.2s ease-in-out infinite;
    }
    @keyframes csVerticalScan {
        0%   { top: 0; opacity: 0; }
        10%  { opacity: 1; }
        90%  { opacity: .8; }
        100% { top: 100%; opacity: 0; }
    }

    /* body */
    .casestudy-body { padding: 1.1rem 1.1rem 1.2rem; position: relative; z-index: 2; }
    .casestudy-body h3 { font-size: 1.08rem; font-weight: 700; margin-bottom: .15rem; color: #fff; letter-spacing: -.2px; }
    html.light-theme .casestudy-body h3 { color: #111827; }
    .cs-meta { display: flex; align-items: center; gap: 1rem; font-size: .72rem; color: #94a3b8; }
    html.light-theme .cs-meta { color: #64748b; }
    .cs-meta i { color: var(--accent); }

    /* result terminal block */
    .cs-terminal {
        position: relative; z-index: 2;
        margin: 1rem 1.1rem .9rem;
        background: rgba(0,217,255,.04);
        border: 1px solid rgba(0,217,255,.12);
        border-left: 3px solid #00ff88;
        border-radius: 6px; padding: .7rem .85rem;
        min-height: 78px;
    }
    html.light-theme .cs-terminal { background: rgba(0,100,140,.04); border-color: rgba(0,100,140,.15); border-left-color: #00884a; }
    .cs-terminal .cs-term-label {
        display: inline-flex; align-items: center; gap: .35rem;
        font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: .56rem; font-weight: 700; letter-spacing: .1em;
        color: #00ff88; text-transform: uppercase; margin-bottom: .4rem;
    }
    html.light-theme .cs-terminal .cs-term-label { color: #00884a; }
    .cs-terminal p { font-size: .72rem; line-height: 1.5; color: var(--text-secondary); margin: 0; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

    /* CTA */
    .cs-action {
        position: relative; z-index: 3;
        padding: 0 1.1rem 1.2rem;
    }
    .cs-analyze-btn {
        display: flex; align-items: center; justify-content: center; gap: .5rem;
        width: 100%;
        position: relative;
        font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: .74rem; font-weight: 700; letter-spacing: .12em;
        color: var(--accent);
        border: 1px solid rgba(0,217,255,.35);
        border-radius: 8px; padding: .65rem;
        background: rgba(0,217,255,.05);
        overflow: hidden; text-transform: uppercase;
        transition: all .3s;
    }
    html.light-theme .cs-analyze-btn { color: var(--accent); border-color: rgba(0,100,140,.35); background: rgba(0,100,140,.05); }
    .cs-analyze-btn i { transition: transform .3s; }
    .casestudy-card:hover .cs-analyze-btn {
        color: #fff; background: rgba(0,217,255,.14);
        border-color: rgba(0,217,255,.55);
        box-shadow: 0 0 16px rgba(0,217,255,.2);
    }
    html.light-theme .casestudy-card:hover .cs-analyze-btn { color: #fff; }
    .casestudy-card:hover .cs-analyze-btn i { transform: translateX(4px); }
    /* sheen sweep on CTA */
    .cs-analyze-btn::before {
        content: ''; position: absolute; top: 0; bottom: 0; width: 40%; left: -60%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,.35), transparent);
        transform: skewX(-20deg); transition: left .5s ease;
    }
    .casestudy-card:hover .cs-analyze-btn::before { left: 120%; }

    .casestudy-cta {
        text-align: center; margin-top: 3rem; padding: 2rem 2rem;
        background: linear-gradient(135deg, rgba(0,217,255,.04), rgba(0,255,136,.04));
        border: 1px solid rgba(0,217,255,.1);
        border-radius: 14px; position: relative; overflow: hidden; position: relative;
        z-index: 1; backdrop-filter: blur(6px);
    }
    html.light-theme .casestudy-cta { background: linear-gradient(135deg, rgba(0,217,255,.04), rgba(0,255,136,.04)); }
    .casestudy-cta::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #00d9ff, #00ff88, transparent);
    }
    .casestudy-cta p { font-size: 1rem; color: var(--text-secondary); margin-bottom: 1.25rem; max-width: 600px; margin-left: auto; margin-right: auto; }
    @media (max-width: 968px) {
        .casestudy-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .casestudy-grid { grid-template-columns: 1fr; gap: 1.25rem; }
        .casestudy-image { height: 200px; }
        .casestudy-body { padding: 1rem; }
    }

    /* ─── Cyber FAQ: knowledge-base console ─── */
    .faq-section {
        background: linear-gradient(180deg, var(--bg-primary) 0%, #05080f 100%);
        position: relative; overflow: hidden;
    }
    html.light-theme .faq-section { background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%); }
    .faq-section::before {
        content: ''; position: absolute; inset: 0; pointer-events: none;
        background-image:
            linear-gradient(90deg, rgba(0,217,255,.03) 1px, transparent 1px),
            linear-gradient(rgba(0,217,255,.03) 1px, transparent 1px);
        background-size: 46px 46px;
        -webkit-mask-image: radial-gradient(ellipse 65% 60% at 50% 30%, black 20%, transparent 80%);
        mask-image: radial-gradient(ellipse 65% 60% at 50% 30%, black 20%, transparent 80%);
    }
    html.light-theme .faq-section::before {
        background-image:
            linear-gradient(90deg, rgba(0,100,140,.04) 1px, transparent 1px),
            linear-gradient(rgba(0,100,140,.04) 1px, transparent 1px);
    }

    .faq-list { max-width: 800px; margin: 0 auto; position: relative; z-index: 1; }

    .faq-item {
        position: relative;
        background: rgba(8,12,20,.6);
        backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(0,217,255,.12);
        border-left: 3px solid rgba(0,217,255,.25);
        border-radius: 12px;
        margin-bottom: 1rem;
        overflow: hidden;
        transition: all .35s cubic-bezier(.16,1,.3,1);
    }
    .faq-item::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent, #00d9ff, transparent);
        opacity: 0; transition: opacity .3s;
    }
    .faq-item:hover, .faq-item.open {
        border-color: rgba(0,217,255,.3);
        border-left-color: var(--accent);
        box-shadow: 0 8px 30px rgba(0,217,255,.08);
    }
    .faq-item.open::before { opacity: 1; }
    html.light-theme .faq-item { background: rgba(255,255,255,.78); border-color: rgba(0,100,140,.15); }
    html.light-theme .faq-item:hover, html.light-theme .faq-item.open { box-shadow: 0 8px 30px rgba(0,100,140,.12); }

    .faq-item .faq-question {
        width: 100%;
        padding: 1.1rem 1.5rem;
        background: none; border: none;
        color: var(--text-primary);
        font-size: .94rem; font-weight: 600;
        text-align: left; cursor: pointer;
        display: flex; align-items: center; gap: 1rem;
        font-family: var(--font);
        transition: color .3s;
        position: relative; z-index: 2;
    }
    .faq-item.open .faq-question { color: var(--accent); }

    .faq-qid {
        flex-shrink: 0;
        font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: .58rem; font-weight: 700; letter-spacing: .06em;
        color: var(--accent);
        background: rgba(0,217,255,.06);
        border: 1px solid rgba(0,217,255,.25);
        border-radius: 6px;
        padding: .2rem .5rem;
    }
    html.light-theme .faq-qid { background: rgba(0,100,140,.06); border-color: rgba(0,100,140,.25); color: var(--accent); }

    .faq-question .faq-chev {
        margin-left: auto; flex-shrink: 0;
        font-size: .8rem; color: var(--accent);
        transition: transform .3s ease;
        width: 28px; height: 28px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 6px;
        border: 1px solid rgba(0,217,255,.2);
        background: rgba(0,217,255,.04);
    }
    .faq-item.open .faq-chev { transform: rotate(180deg); border-color: rgba(0,217,255,.5); }

    .faq-answer {
        max-height: 0; overflow: hidden;
        transition: max-height .4s cubic-bezier(.16,1,.3,1), padding .4s ease;
        padding: 0 1.5rem;
        position: relative; z-index: 1;
    }
    .faq-answer p {
        margin: 0; padding: 0 0 1.2rem 1.2rem;
        color: var(--text-secondary);
        font-size: .88rem; line-height: 1.8;
        border-left: 1px solid rgba(0,217,255,.15);
        position: relative;
    }
    .faq-answer p::before {
        content: '>';
        position: absolute; left: 0; top: 0;
        font-family: 'JetBrains Mono', Consolas, monospace;
        color: #00ff88;
        font-weight: 700;
    }
    html.light-theme .faq-answer p::before { color: #00884a; }

    .faq-item .faq-scanline {
        position: absolute; left: 0; right: 0; height: 1px; top: 0;
        background: linear-gradient(90deg, transparent 5%, rgba(0,217,255,.4) 50%, transparent 95%);
        opacity: 0; pointer-events: none;
    }
    .faq-item.open .faq-scanline { opacity: 1; animation: faqScan 1.2s ease-in-out infinite; }
    @keyframes faqScan {
        0%   { top: 0; opacity: 0; }
        10%  { opacity: 1; }
        90%  { opacity: .8; }
        100% { top: 100%; opacity: 0; }
    }

    /* ─── Cyber-security work experience feed ─── */
    .timeline-section { background: linear-gradient(180deg, var(--bg-primary) 0%, #05080f 100%); }
    html.light-theme .timeline-section { background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%); }
    .cyber-feed {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
        padding: 0.5rem 0;
    }
    .cyber-grid {
        position: absolute; inset: -30px 0;
        pointer-events: none;
        background-image:
            linear-gradient(rgba(0, 217, 255, 0.045) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 217, 255, 0.045) 1px, transparent 1px);
        background-size: 42px 42px;
        -webkit-mask-image: radial-gradient(ellipse 65% 60% at 50% 0%, black 30%, transparent 80%);
        mask-image: radial-gradient(ellipse 65% 60% at 50% 0%, black 30%, transparent 80%);
    }
    .cyber-line {
        position: absolute; left: 19px; top: 0; bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, transparent, rgba(0, 217, 255, 0.55), rgba(0, 255, 136, 0.45), rgba(0, 217, 255, 0.55), transparent);
        box-shadow: 0 0 14px rgba(0, 217, 255, 0.35);
    }
    .cyber-line::after {
        content: ''; position: absolute; left: 50%; top: 0; width: 7px; height: 7px;
        transform: translateX(-50%) rotate(45deg);
        background: #00ff88; box-shadow: 0 0 10px #00ff88;
        animation: cyberPacket 2.8s linear infinite;
    }
    @keyframes cyberPacket {
        0%   { top: -10px; opacity: 0; }
        8%   { opacity: 1; }
        92%  { opacity: 1; }
        100% { top: 100%; opacity: 0; }
    }

    .cyber-entry { position: relative; padding-left: 60px; margin-bottom: 2rem; }
    .cyber-entry:last-child { margin-bottom: 0; }
    .cyber-node {
        position: absolute; left: 0; top: 1.3rem;
        width: 40px; height: 40px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; z-index: 2;
        color: #00d9ff;
        background: linear-gradient(135deg, rgba(0, 217, 255, 0.16), rgba(0, 255, 136, 0.06));
        border: 1px solid rgba(0, 217, 255, 0.45);
        box-shadow: 0 0 18px rgba(0, 217, 255, 0.18);
    }
    .cyber-entry.live .cyber-node {
        color: #00ff88;
        border-color: rgba(0, 255, 136, 0.5);
        background: linear-gradient(135deg, rgba(0, 255, 136, 0.14), rgba(0, 217, 255, 0.06));
        animation: cyberNodePulse 2.2s ease-in-out infinite;
    }
    @keyframes cyberNodePulse {
        0%, 100% { box-shadow: 0 0 14px rgba(0, 255, 136, 0.2); }
        50%       { box-shadow: 0 0 30px rgba(0, 255, 136, 0.45); }
    }
    .cyber-node::after {
        content: ''; position: absolute; inset: -7px;
        border-radius: 13px;
        border: 1px solid rgba(0, 217, 255, 0.3);
        animation: cyberRadar 2.4s ease-out infinite;
    }
    .cyber-entry.live .cyber-node::after { border-color: rgba(0, 255, 136, 0.45); }
    @keyframes cyberRadar {
        0%   { transform: scale(0.72); opacity: 0.9; }
        100% { transform: scale(1.4); opacity: 0; }
    }

    .cyber-card {
        position: relative; overflow: hidden;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-left: 3px solid #00d9ff;
        border-radius: var(--radius-lg);
        padding: 1.35rem 1.5rem;
        transition: var(--transition);
    }
    .cyber-entry.live .cyber-card { border-left-color: #00ff88; }
    .cyber-card::before {
        content: ''; position: absolute; top: 0; left: -110%;
        width: 55%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(0, 217, 255, 0.07), transparent);
        transform: skewX(-20deg);
        transition: left 0.7s ease;
        pointer-events: none;
    }
    .cyber-card:hover::before { left: 170%; }
    .cyber-card::after {
        content: ''; position: absolute; bottom: 0; left: 0; height: 2px; width: 100%;
        background: linear-gradient(90deg, #00d9ff, #00ff88);
        transform: scaleX(0); transform-origin: left;
        transition: transform 0.5s ease;
    }
    .cyber-entry.live .cyber-card::after { background: linear-gradient(90deg, #00ff88, #00d9ff); }
    .cyber-card:hover::after { transform: scaleX(1); }
    .cyber-card:hover {
        border-color: var(--border-hover);
        border-left-color: #00d9ff;
        transform: translateY(-4px);
        box-shadow: 0 0 0 1px rgba(0, 217, 255, 0.15), var(--shadow-md);
    }
    html.light-theme .cyber-card { border-left-color: #0891b2; }

    .cyber-card-top {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 0.5rem; margin-bottom: 0.6rem;
    }
    .cyber-date {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: 0.74rem; font-weight: 600;
        color: var(--accent-light); letter-spacing: 0.02em;
        background: rgba(0, 217, 255, 0.08);
        border: 1px solid rgba(0, 217, 255, 0.16);
        padding: 0.25rem 0.8rem; border-radius: 6px;
    }
    .cyber-date::before { content: '$'; color: #00ff88; font-weight: 700; margin-right: 0.15rem; }
    html.light-theme .cyber-date::before { color: #059669; }
    .cyber-status {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-family: 'JetBrains Mono', Consolas, monospace;
        text-transform: uppercase; letter-spacing: 0.08em;
        font-size: 0.6rem; font-weight: 700;
        color: var(--text-muted);
        background: rgba(148, 163, 184, 0.12);
        border: 1px solid rgba(148, 163, 184, 0.28);
        padding: 0.26rem 0.7rem; border-radius: 6px;
    }
    .cyber-status.live { color: #00ff88; background: rgba(0, 255, 136, 0.1); border-color: rgba(0, 255, 136, 0.32); }
    html.light-theme .cyber-status.live { color: #059669; background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.3); }
    .cyber-pulse { width: 7px; height: 7px; border-radius: 50%; background: #00ff88; box-shadow: 0 0 8px #00ff88; animation: cyberBlink 1.1s steps(2, start) infinite; }
    html.light-theme .cyber-pulse { background: #059669; box-shadow: 0 0 8px rgba(16, 185, 129, 0.5); }
    @keyframes cyberBlink { 50% { opacity: 0.25; } }

    .cyber-card h3 { font-size: 1.15rem; font-weight: 700; margin-bottom: 0.25rem; }
    .cyber-company {
        display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem;
        font-size: 0.88rem; color: var(--text-secondary); margin-bottom: 0.8rem;
    }
    .cyber-company i { color: #00d9ff; }
    .cyber-entry.live .cyber-company i { color: #00ff88; }
    html.light-theme .cyber-company i { color: #0891b2; }
    html.light-theme .cyber-entry.live .cyber-company i { color: #059669; }
    .cyber-location { font-size: 0.82rem; color: var(--text-muted); }
    .cyber-card p { color: var(--text-secondary); font-size: 0.88rem; line-height: 1.7; margin-bottom: 0; }

    /* ===== Light-theme polish for cyber timeline ===== */
    html.light-theme .cyber-date { color: #0e7490; background: rgba(8, 145, 178, 0.08); border-color: rgba(8, 145, 178, 0.2); }
    html.light-theme .cyber-status { color: #64748b; background: rgba(100, 116, 139, 0.1); border-color: rgba(100, 116, 139, 0.25); }
    html.light-theme .cyber-node {
        color: #0e7490;
        background: linear-gradient(135deg, rgba(8, 145, 178, 0.14), rgba(5, 150, 105, 0.06));
        border-color: rgba(8, 145, 178, 0.4);
        box-shadow: 0 0 16px rgba(8, 145, 178, 0.16);
    }
    html.light-theme .cyber-entry.live .cyber-node {
        color: #059669;
        border-color: rgba(5, 150, 105, 0.45);
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.12), rgba(8, 145, 178, 0.06));
    }
    html.light-theme .cyber-node::after,
    html.light-theme .cyber-entry.live .cyber-node::after { border-color: rgba(8, 145, 178, 0.3); }
    html.light-theme .cyber-entry.live .cyber-card { border-left-color: #059669; }
    html.light-theme .cyber-card:hover { border-left-color: #0891b2; box-shadow: 0 0 0 1px rgba(8, 145, 178, 0.2), var(--shadow-md); }
    html.light-theme .cyber-card::after { background: linear-gradient(90deg, #0891b2, #059669); }
    html.light-theme .cyber-entry.live .cyber-card::after { background: linear-gradient(90deg, #059669, #0891b2); }
    html.light-theme .cyber-line {
        background: linear-gradient(180deg, transparent, rgba(8, 145, 178, 0.5), rgba(5, 150, 105, 0.4), rgba(8, 145, 178, 0.5), transparent);
        box-shadow: 0 0 10px rgba(8, 145, 178, 0.2);
    }
    html.light-theme .cyber-line::after { background: #059669; box-shadow: 0 0 8px rgba(5, 150, 105, 0.5); }
    html.light-theme .cyber-feed .cyber-grid {
        background-image:
            linear-gradient(rgba(8, 145, 178, 0.06) 1px, transparent 1px),
            linear-gradient(90deg, rgba(8, 145, 178, 0.06) 1px, transparent 1px);
    }

    @media (max-width: 768px) {
        .cyber-entry { padding-left: 3.4rem; }
        .cyber-line { left: 12px; }
        .cyber-node { width: 34px; height: 34px; font-size: 0.85rem; top: 1.2rem; }
        .cyber-card { padding: 1rem; }
        .cyber-card-top { gap: 0.3rem; }
        .cyber-card h3 { font-size: 0.95rem; }
        .cyber-company { font-size: 0.78rem; margin-bottom: 0.5rem; }
        .cyber-card p { font-size: 0.78rem; line-height: 1.6; }
        .cyber-date { font-size: 0.66rem; padding: 0.22rem 0.65rem; }
        .cyber-status { font-size: 0.55rem; padding: 0.22rem 0.6rem; }
        .cyber-location { font-size: 0.72rem; }
    }

    /* Skills section */
    /* ===== CYBER SECURITY SKILLS SECTION ===== */
    .skills-section { background: linear-gradient(180deg, #080b12 0%, var(--bg-secondary) 100%); position: relative; overflow: hidden; }
    html.light-theme .skills-section { background: linear-gradient(180deg, #f1f5f9 0%, #eef2f7 100%); }
    .skills-section::before {
        content: ''; position: absolute; inset: 0;
        background:
            linear-gradient(90deg, rgba(0,217,255,.02) 1px, transparent 1px),
            linear-gradient(rgba(0,217,255,.02) 1px, transparent 1px);
        background-size: 50px 50px; pointer-events: none;
    }
    html.light-theme .skills-section::before { background: linear-gradient(90deg, rgba(0,100,140,.03) 1px, transparent 1px), linear-gradient(rgba(0,100,140,.03) 1px, transparent 1px); background-size: 50px 50px; }

    .skills-radar {
        position: absolute; width: 400px; height: 400px; top: 50%; left: 50%;
        transform: translate(-50%,-50%); pointer-events: none; opacity: .04; z-index: 0;
    }
    .skills-radar .r-ring {
        position: absolute; border-radius: 50%; border: 1px solid #00d9ff;
        top: 50%; left: 50%; transform: translate(-50%,-50%);
        animation: radarPulse 3s ease-in-out infinite;
    }
    .skills-radar .r-ring:nth-child(1) { width: 300px; height: 300px; animation-delay: 0s; }
    .skills-radar .r-ring:nth-child(2) { width: 200px; height: 200px; animation-delay: 0.5s; }
    .skills-radar .r-ring:nth-child(3) { width: 100px; height: 100px; animation-delay: 1s; }
    @keyframes radarPulse {
        0%, 100% { opacity: 0.4; transform: translate(-50%,-50%) scale(1); }
        50% { opacity: 0.8; transform: translate(-50%,-50%) scale(1.05); }
    }
    .skills-radar .r-line {
        position: absolute; width: 200px; height: 1px; background: linear-gradient(90deg,transparent,#00d9ff);
        top: 50%; left: 50%; transform-origin: left center;
    }
    .skills-radar .r-line:nth-child(4) { transform: rotate(0deg); }
    .skills-radar .r-line:nth-child(5) { transform: rotate(60deg); }
    .skills-radar .r-line:nth-child(6) { transform: rotate(120deg); }

    .skills-wrapper { position: relative; z-index: 1; }
    .skills-grid {
        display: flex;
        align-items: center;
        gap: 1rem;
        width: max-content;
        animation: skillScroll 30s linear infinite;
    }
    .skills-grid:hover {
        animation-play-state: paused;
    }
    @keyframes skillScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .skill-card {
        flex-shrink: 0; position: relative;
        display: flex; align-items: center; gap: .7rem;
        padding: .5rem .8rem;
        height: 52px;
        background: rgba(0,217,255,.03);
        border: 1px solid rgba(0,217,255,.14);
        border-radius: 12px;
        cursor: default;
        transition: all .35s cubic-bezier(.175,.885,.32,1.275);
        overflow: hidden;
    }
    html.light-theme .skill-card {
        background: rgba(0,100,140,.05);
        border-color: rgba(0,100,140,.18);
    }
    .skill-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: 0; transition: opacity .3s;
    }
    .skill-card:hover::before { opacity: 1; }
    .skill-card::after {
        content: ''; position: absolute; inset: 0; border-radius: 12px; pointer-events: none;
        background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,217,255,.015) 2px, rgba(0,217,255,.015) 4px);
        opacity: 0; transition: opacity .4s;
    }
    .skill-card:hover::after { opacity: 1; }
    .skill-card:hover {
        border-color: rgba(0,217,255,.45);
        background: rgba(0,217,255,.07);
        transform: translateY(-3px);
        box-shadow: 0 0 18px rgba(0,217,255,.12), 0 6px 20px rgba(0,0,0,.3);
    }
    html.light-theme .skill-card:hover {
        background: rgba(0,100,140,.08);
        box-shadow: 0 4px 16px rgba(0,100,140,.12);
    }

    .skill-card .sk-scan {
        position: absolute; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent 5%, rgba(0,217,255,.6) 30%, #00d9ff 50%, rgba(0,217,255,.6) 70%, transparent 95%);
        opacity: 0; z-index: 2; pointer-events: none; top: 0;
        box-shadow: 0 0 8px rgba(0,217,255,.4), 0 0 20px rgba(0,217,255,.15);
    }
    .skill-card:hover .sk-scan { opacity: 1; animation: skScanLine 1.1s ease-in-out infinite; }
    @keyframes skScanLine {
        0%   { top: 0; opacity: 0; }
        10%  { opacity: 1; }
        90%  { opacity: 1; }
        100% { top: 100%; opacity: 0; }
    }

    .skill-card .sk-icon {
        width: 34px; height: 34px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        border: 1px solid rgba(0,217,255,.25);
        border-radius: 8px;
        background: rgba(0,217,255,.06);
        color: var(--accent-light);
        font-size: 1rem;
        transition: all .3s;
        position: relative;
    }
    html.light-theme .skill-card .sk-icon { border-color: rgba(0,100,140,.3); color: var(--accent); }
    .skill-card:hover .sk-icon {
        color: #fff; border-color: rgba(0,217,255,.5);
        background: rgba(0,217,255,.12);
        box-shadow: 0 0 12px rgba(0,217,255,.25);
        animation: iconGlitch 0.3s ease-in-out;
    }
    html.light-theme .skill-card:hover .sk-icon { color: var(--accent); }
    @keyframes iconGlitch {
        0% { transform: translate(0); }
        20% { transform: translate(-1px, 1px); }
        40% { transform: translate(1px, -1px); }
        60% { transform: translate(-1px, 0); }
        80% { transform: translate(1px, 1px); }
        100% { transform: translate(0); }
    }

    .skill-card .sk-info {
        display: flex; flex-direction: column; gap: .3rem; min-width: 0;
    }
    .skill-card .skill-name {
        font-weight: 600; font-size: .72rem; color: var(--text-primary);
        line-height: 1; white-space: nowrap;
        font-family: 'JetBrains Mono', Consolas, monospace;
        position: relative;
    }
    html.light-theme .skill-card .skill-name { color: var(--text-primary); }
    .skill-card:hover .skill-name {
        animation: textGlitch 0.4s ease-in-out;
    }
    @keyframes textGlitch {
        0%, 100% { text-shadow: none; }
        10% { text-shadow: -1px 0 #ff0040, 1px 0 #00d9ff; }
        20% { text-shadow: 1px 0 #ff0040, -1px 0 #00d9ff; }
        30% { text-shadow: none; }
        40% { text-shadow: -1px 0 #ff0040, 1px 0 #00d9ff; }
        50% { text-shadow: none; }
    }

    .skill-card .sk-bar {
        width: 96px; height: 3px; border-radius: 4px;
        background: rgba(0,217,255,.12);
        overflow: hidden;
        position: relative;
    }
    html.light-theme .skill-card .sk-bar { background: rgba(0,100,140,.15); }
    .skill-card .sk-bar::after {
        content: ''; position: absolute; top: 0; left: -100%; width: 40%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,.3), transparent);
        animation: barSweep 2s ease-in-out infinite;
    }
    @keyframes barSweep {
        0% { left: -40%; }
        100% { left: 140%; }
    }
    .skill-card .sk-bar-fill {
        display: block; height: 100%; width: 0;
        background: var(--accent-gradient);
        border-radius: 4px;
        transition: width 1.2s cubic-bezier(.16,1,.3,1);
        position: relative;
    }
    .skill-card .sk-bar-fill::after {
        content: ''; position: absolute; right: 0; top: -1px; width: 6px; height: 5px;
        background: #00d9ff; border-radius: 50%;
        box-shadow: 0 0 6px #00d9ff, 0 0 12px rgba(0,217,255,.5);
        opacity: 0; transition: opacity .3s;
    }
    .skill-card:hover .sk-bar-fill::after { opacity: 1; }

    .skill-card .skill-percent {
        font-size: .62rem; font-weight: 700;
        font-family: 'JetBrains Mono', Consolas, monospace;
        color: var(--accent); opacity: .8; flex-shrink: 0;
        position: relative;
    }
    html.light-theme .skill-card .skill-percent { color: var(--accent); }
    .skill-card:hover .skill-percent { opacity: 1; animation: percentFlicker 0.6s ease-in-out; }
    @keyframes percentFlicker {
        0%, 100% { opacity: 1; }
        15% { opacity: 0.4; }
        30% { opacity: 1; }
        45% { opacity: 0.6; }
        60% { opacity: 1; }
    }
    .cyber-particles {
        position: absolute; inset: 0; pointer-events: none; overflow: hidden; z-index: 0; opacity: 0; transition: opacity .5s;
    }
    .skill-card:hover .cyber-particles { opacity: 1; }
    .cyber-particle {
        position: absolute; font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: 8px; color: rgba(0,217,255,.25); white-space: nowrap;
        animation: matrixFall linear infinite;
    }
    @keyframes matrixFall {
        0% { transform: translateY(-100%); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(200%); opacity: 0; }
    }

    /* ===== Light-theme polish for cyber skill effects ===== */
    html.light-theme .skill-card .sk-scan {
        background: linear-gradient(90deg, transparent 5%, rgba(0,145,190,.5) 30%, #0891b2 50%, rgba(0,145,190,.5) 70%, transparent 95%);
        box-shadow: 0 0 6px rgba(8,145,178,.35), 0 0 14px rgba(8,145,178,.15);
    }
    html.light-theme .skill-card .sk-icon {
        background: rgba(8,145,178,.07);
        color: #0e7490;
    }
    html.light-theme .skill-card:hover .sk-icon {
        background: rgba(8,145,178,.12);
        color: #0e7490;
        box-shadow: 0 0 10px rgba(8,145,178,.22);
    }
    html.light-theme .skill-card:hover .skill-name {
        animation: textGlitchLight 0.4s ease-in-out;
    }
    @keyframes textGlitchLight {
        0%, 100% { text-shadow: none; }
        10% { text-shadow: -1px 0 rgba(200,0,90,.35), 1px 0 rgba(0,145,190,.4); }
        20% { text-shadow: 1px 0 rgba(200,0,90,.35), -1px 0 rgba(0,145,190,.4); }
        30% { text-shadow: none; }
        40% { text-shadow: -1px 0 rgba(200,0,90,.35), 1px 0 rgba(0,145,190,.4); }
        50% { text-shadow: none; }
    }
    html.light-theme .skill-card:hover .skill-percent { animation: percentFlicker 0.6s ease-in-out; }
    html.light-theme .skill-card .sk-bar-fill::after {
        background: #0891b2;
        box-shadow: 0 0 5px #0891b2, 0 0 10px rgba(8,145,178,.4);
    }
    html.light-theme .online-cyber-particle,
    html.light-theme .cyber-particle { color: rgba(8,145,178,.3); }
    html.light-theme .skill-card .cyber-particles { opacity: 0; }
    html.light-theme .skill-card:hover .cyber-particles { opacity: 1; }
    /* Filter Tabs */
    .filter-tabs {
        display: flex; flex-wrap: wrap; gap: 0.6rem;
        justify-content: center; margin-bottom: 2.5rem;
    }
    .filter-btn {
        padding: 0.5rem 1.2rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 50px;
        color: var(--text-secondary);
        font-size: 0.82rem; font-weight: 500;
        cursor: pointer; transition: var(--transition);
        font-family: var(--font);
    }
    .filter-btn:hover {
        border-color: var(--accent);
        color: var(--accent-light);
    }
    .filter-btn.active {
        background: var(--accent-gradient);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 4px 15px rgba(0, 217, 255, 0.3);
    }
    .filter-btn.active:hover {
        color: #fff;
    }

    /* ===== GIGS — CYBER PRICING PLANS ===== */
    .gigs-section { position: relative; overflow: hidden; }
    .gigs-section::before {
        content: '';
        position: absolute; inset: 0; pointer-events: none; z-index: 0;
        background:
            linear-gradient(rgba(0, 217, 255, 0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 217, 255, 0.04) 1px, transparent 1px);
        background-size: 44px 44px;
        -webkit-mask-image: radial-gradient(ellipse 70% 70% at 50% 45%, rgba(0,0,0,0.65), transparent 82%);
        mask-image: radial-gradient(ellipse 70% 70% at 50% 45%, rgba(0,0,0,0.65), transparent 82%);
    }
    .gigs-cyber-bg { position: absolute; inset: 0; z-index: 0; pointer-events: none; overflow: hidden; }
    .gc-radar {
        position: absolute; left: 50%; top: 45%; width: 620px; height: 620px;
        transform: translate(-50%, -50%); border-radius: 50%;
        border: 1px solid rgba(0, 217, 255, 0.07);
    }
    .gc-radar::before {
        content: ''; position: absolute; inset: 0; border-radius: 50%;
        border: 1px dashed rgba(0, 217, 255, 0.1); animation: wsRadarSpin 30s linear infinite;
    }
    .gc-radar::after {
        content: ''; position: absolute; inset: 0; border-radius: 50%;
        background: conic-gradient(from 0deg, rgba(0,217,255,0.1), transparent 70deg, transparent 360deg);
        animation: wsRadarSpin 6s linear infinite;
    }
    .gc-beam {
        position: absolute; left: 50%; top: 0; bottom: 0; width: 1px;
        background: linear-gradient(180deg, transparent, rgba(0,217,255,0.35), transparent);
        transform: translateX(-50%);
        animation: gcBeamMove 8s ease-in-out infinite;
    }
    @keyframes gcBeamMove {
        0%   { left: 8%; opacity: 0; }
        15%  { opacity: 1; }
        50%  { left: 92%; opacity: 1; }
        65%  { opacity: 1; }
        100% { left: 8%; opacity: 0; }
    }
    .gc-particle {
        position: absolute; color: rgba(0, 255, 136, 0.4);
        font-family: 'JetBrains Mono', Consolas, monospace; font-size: 0.68rem; font-weight: 700;
        animation: gcFloat linear infinite; z-index: 0;
    }
    .gc-particle.p1 { left: 6%; top: 32%; animation-duration: 8s; }
    .gc-particle.p2 { right: 8%; top: 55%; animation-duration: 9s; animation-delay: 1.2s; }
    .gc-particle.p3 { left: 13%; bottom: 22%; animation-duration: 7.5s; animation-delay: 2s; }
    @keyframes gcFloat {
        0%   { transform: translateY(0); opacity: 0; }
        12%  { opacity: 1; }
        88%  { opacity: 1; }
        100% { transform: translateY(-70px); opacity: 0; }
    }

    .gigs-grid {
        position: relative; z-index: 1;
        display: flex; flex-wrap: wrap; justify-content: center;
        gap: 1.75rem;
    }
    .gig-card {
        width: calc(33.333% - 1.17rem);
        min-width: 280px;
        flex-shrink: 0;
        display: flex; flex-direction: column;
        text-decoration: none;
        position: relative;
        background: linear-gradient(170deg, rgba(11, 24, 38, 0.94), rgba(7, 16, 27, 0.9));
        border: 1px solid rgba(0, 217, 255, 0.16);
        border-radius: 18px;
        overflow: hidden;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s, border-color 0.4s;
    }
    html.light-theme .gig-card { background: linear-gradient(170deg, rgba(255,255,255,0.96), rgba(248,250,252,0.92)); border-color: rgba(8,145,178,0.18); }
    .gig-card:hover {
        border-color: rgba(0, 217, 255, 0.55);
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.45), 0 0 30px rgba(0, 217, 255, 0.1);
        transform: translateY(-9px);
    }
    html.light-theme .gig-card:hover { box-shadow: 0 24px 50px rgba(0,0,0,0.14), 0 0 24px rgba(8,145,178,0.2); }

    /* HUD top bar */
    .gig-hud {
        position: relative; z-index: 2;
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.55rem 1.1rem;
        font-family: 'JetBrains Mono', Consolas, monospace; font-size: 0.68rem; letter-spacing: 0.14em;
        color: rgba(0, 217, 255, 0.65);
        background: rgba(0, 217, 255, 0.04);
        border-bottom: 1px solid rgba(0, 217, 255, 0.12);
    }
    html.light-theme .gig-hud { color: #0e7490; background: rgba(8,145,178,0.05); border-color: rgba(8,145,178,0.15); }
    .gig-hud-id { font-weight: 700; }
    .gig-hud-live { display: inline-flex; align-items: center; gap: 0.45rem; }
    .gig-hud-live .dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: #00ff88; box-shadow: 0 0 10px rgba(0, 255, 136, 0.9);
        animation: cyberBlink 1.6s linear infinite;
    }

    /* Cyber head */
    .gig-thumb {
        position: relative; z-index: 2;
        height: 175px; overflow: hidden;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(170deg, rgba(0, 217, 255, 0.1), rgba(0, 255, 136, 0.06));
        border-bottom: 1px solid rgba(0, 217, 255, 0.14);
    }
    .gig-thumb img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .gig-card:hover .gig-thumb img { transform: scale(1.08); }
    .gig-thumb::after {
        content: ''; position: absolute; inset: 0; pointer-events: none;
        background: linear-gradient(180deg, rgba(7, 16, 27, 0) 62%, rgba(7, 16, 27, 0.72));
    }
    html.light-theme .gig-thumb::after { background: linear-gradient(180deg, rgba(255, 255, 255, 0) 62%, rgba(248, 250, 252, 0.78)); }
    .gig-thumb .gig-icon { margin: 0; }

    .gig-head {
        position: relative; z-index: 2;
        text-align: center; padding: 1.6rem 1.6rem 1.2rem;
    }
    .gig-head::before {
        content: ''; position: absolute; left: 1.6rem; right: 1.6rem; top: 0; height: 3px;
        background: linear-gradient(90deg, transparent, rgba(0, 217, 255, 0.7), transparent);
        animation: topBarPulse 3s ease-in-out infinite;
    }
    @keyframes topBarPulse {
        0%, 100% { opacity: 0.35; }
        50% { opacity: 1; }
    }
    .gig-icon {
        position: relative; width: 74px; height: 74px; margin: 0 auto 1.1rem;
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%;
        background: rgba(0, 217, 255, 0.07);
        border: 1px solid rgba(0, 217, 255, 0.25);
    }
    .gig-icon i { font-size: 2rem; color: #00d9ff; filter: drop-shadow(0 0 10px rgba(0, 217, 255, 0.6)); }
    html.light-theme .gig-icon i { color: #0891b2; filter: drop-shadow(0 0 6px rgba(8,145,178,0.4)); }
    .gig-icon::before, .gig-icon::after {
        content: ''; position: absolute; border-radius: 50%;
        border: 1px dashed rgba(0, 217, 255, 0.3);
        animation: wsRadarSpin 14s linear infinite;
    }
    .gig-icon::before { inset: -12px; animation-duration: 14s; }
    .gig-icon::after { inset: -24px; animation-duration: 22s; animation-direction: reverse; }
    .gig-head h3 { font-size: 1.22rem; font-weight: 800; color: var(--text-primary); letter-spacing: -0.3px; margin-bottom: 0.35rem; }
    .gig-head p { color: var(--text-secondary); font-size: 0.88rem; line-height: 1.6; margin: 0; }
    html.light-theme .gig-head p { color: #475569; }

    /* Tier bars */
    .gig-tiers { position: relative; z-index: 2; display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.5rem; padding: 0.9rem 1.5rem; }
    .gig-tier {
        text-align: center; padding: 0.7rem 0.4rem 0.6rem;
        background: rgba(148, 163, 184, 0.07);
        border: 1px solid rgba(148, 163, 184, 0.18);
        border-radius: 12px;
        transition: transform 0.3s ease, border-color 0.3s ease;
    }
    .gig-card:hover .gig-tier { transform: translateY(-2px); }
    .gig-tier.std { background: rgba(0, 217, 255, 0.08); border-color: rgba(0, 217, 255, 0.3); }
    .gig-tier.pre { background: rgba(251, 191, 36, 0.07); border-color: rgba(251, 191, 36, 0.28); }
    .gig-tier-name {
        display: block; font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: 0.6rem; letter-spacing: 0.1em; text-transform: uppercase;
        color: var(--text-muted); margin-bottom: 0.3rem;
    }
    .gig-tier-name::before {
        content: ''; display: inline-block; width: 5px; height: 5px; border-radius: 50%;
        background: #94a3b8; margin-right: 0.35rem; vertical-align: middle;
    }
    .gig-tier.std .gig-tier-name::before { background: #00d9ff; box-shadow: 0 0 6px rgba(0, 217, 255, 0.8); }
    .gig-tier.pre .gig-tier-name::before { background: #fbbf24; box-shadow: 0 0 6px rgba(251, 191, 36, 0.8); }
    .gig-tier-price {
        display: block; font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: 0.9rem; font-weight: 700; color: var(--text-primary);
    }
    .gig-tier.std .gig-tier-price { color: #00d9ff; text-shadow: 0 0 12px rgba(0, 217, 255, 0.35); }
    html.light-theme .gig-tier.std .gig-tier-price { text-shadow: none; }
    .gig-tier.pre .gig-tier-price { color: #fbbf24; text-shadow: 0 0 12px rgba(251, 191, 36, 0.3); }
    html.light-theme .gig-tier.pre .gig-tier-price { text-shadow: none; }

    /* CTA */
    .gig-cta {
        position: relative; z-index: 2; overflow: hidden;
        display: flex; align-items: center; justify-content: space-between;
        margin: auto 1.5rem 1.5rem; padding: 0.8rem 1.2rem;
        border-radius: 12px;
        background: linear-gradient(90deg, rgba(0, 217, 255, 0.14), rgba(0, 255, 136, 0.1));
        border: 1px solid rgba(0, 217, 255, 0.35);
        font-weight: 700; font-size: 0.88rem; letter-spacing: 0.02em;
        color: #d9f6ff; transition: var(--transition);
    }
    html.light-theme .gig-cta { color: #075985; }
    .gig-cta i { position: relative; z-index: 2; transition: transform 0.3s ease; }
    .gig-card:hover .gig-cta {
        background: linear-gradient(90deg, rgba(0, 217, 255, 0.26), rgba(0, 255, 136, 0.18));
        border-color: rgba(0, 217, 255, 0.6);
        box-shadow: 0 0 20px rgba(0, 217, 255, 0.15);
    }
    .gig-card:hover .gig-cta i { transform: translateX(5px); }
    .gig-cta::after {
        content: ''; position: absolute; top: 0; bottom: 0; width: 40px;
        background: linear-gradient(105deg, transparent, rgba(255, 255, 255, 0.22), transparent);
        transform: skewX(-20deg); animation: gcScan 3.2s ease-in-out infinite;
    }
    @keyframes gcScan {
        0%   { left: -60px; opacity: 0; }
        25%  { opacity: 1; }
        75%  { opacity: 1; }
        100% { left: 110%; opacity: 0; }
    }

    /* ===== Light-theme polish for cyber pricing plans ===== */
    html.light-theme .gig-tier-name { color: #64748b; }
    html.light-theme .gig-tier.std .gig-tier-price { color: #0891b2; }
    html.light-theme .gig-tier.pre .gig-tier-price { color: #b45309; }
    html.light-theme .gig-tier.std { background: rgba(8, 145, 178, 0.07); border-color: rgba(8, 145, 178, 0.28); }
    html.light-theme .gig-tier.pre { background: rgba(245, 158, 11, 0.07); border-color: rgba(245, 158, 11, 0.26); }
    html.light-theme .gig-icon {
        background: rgba(8, 145, 178, 0.06);
        border: 1px solid rgba(8, 145, 178, 0.22);
    }
    html.light-theme .gig-icon::before, html.light-theme .gig-icon::after { border-color: rgba(8, 145, 178, 0.26); }
    html.light-theme .gig-thumb {
        background: linear-gradient(170deg, rgba(8, 145, 178, 0.09), rgba(5, 150, 105, 0.05));
        border-bottom-color: rgba(8, 145, 178, 0.16);
    }
    html.light-theme .gig-cta {
        background: linear-gradient(90deg, rgba(8, 145, 178, 0.12), rgba(5, 150, 105, 0.09));
        border-color: rgba(8, 145, 178, 0.32);
    }
    html.light-theme .gig-card:hover .gig-cta {
        background: linear-gradient(90deg, rgba(8, 145, 178, 0.2), rgba(5, 150, 105, 0.15));
        border-color: rgba(8, 145, 178, 0.5);
        box-shadow: 0 0 16px rgba(8, 145, 178, 0.18);
    }
    html.light-theme .gig-hud-live .dot { box-shadow: 0 0 6px rgba(5, 150, 105, 0.5); }
    html.light-theme .gc-particle { color: rgba(5, 150, 105, 0.45); }

    /* Testimonials */
    .testimonials-section { background: linear-gradient(180deg, var(--bg-primary) 0%, #080b12 100%); }
    html.light-theme .testimonials-section { background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); }
    .testimonial-carousel { max-width: 750px; margin: 0 auto; position: relative; overflow: hidden; }
    .testimonial-track { display: flex; transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
    .testimonial-card {
        min-width: 100%; padding: 2.5rem 2rem;
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: var(--radius-xl); text-align: center;
        position: relative; transition: var(--transition);
    }
    .testimonial-card:hover { border-color: var(--border-hover); box-shadow: var(--shadow-md); }
    .quote-icon { font-size: 3rem; color: rgba(0, 217, 255, 0.15); margin-bottom: 0.5rem; }
    .testimonial-stars { color: #f59e0b; margin-bottom: 1.2rem; font-size: 1.05rem; display: flex; justify-content: center; gap: 3px; }
    .testimonial-stars .bi-star { opacity: 0.3; }
    .testimonial-text { color: #cbd5e1; font-size: 1.02rem; line-height: 1.8; margin-bottom: 1.8rem; font-style: italic; }
    html.light-theme .testimonial-text { color: #334155 !important; }
    .testimonial-author { display: flex; align-items: center; justify-content: center; gap: 1rem; }
    .author-avatar img { width: 55px; height: 55px; border-radius: 50%; object-fit: cover; border: 2px solid rgba(0, 217, 255, 0.25); }
    .avatar-fallback { width: 55px; height: 55px; border-radius: 50%; background: var(--accent-gradient); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.3rem; color: #fff; border: 2px solid rgba(0, 217, 255, 0.25); }
    .author-name { font-weight: 700; color: var(--text-primary); font-size: 1rem; }
    .author-designation { font-size: 0.78rem; color: var(--text-muted); margin-top: 2px; }
    .carousel-controls { display: flex; align-items: center; justify-content: center; gap: 1.5rem; margin-top: 2rem; }
    .carousel-btn {
        width: 44px; height: 44px; border-radius: 50%;
        border: 1px solid rgba(0, 217, 255, 0.25);
        background: rgba(30, 41, 59, 0.4); color: var(--text-secondary);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: var(--transition); font-size: 1.1rem;
    }
    html.light-theme .carousel-btn { background: rgba(255, 255, 255, 0.85) !important; color: #475569 !important; }
    .carousel-btn:hover { background: var(--accent); border-color: var(--accent); color: #fff; transform: scale(1.05); }
    .carousel-dots { display: flex; gap: 8px; }
    .carousel-dots .dot { width: 10px; height: 10px; border-radius: 50%; background: rgba(0, 217, 255, 0.2); cursor: pointer; transition: var(--transition); }
    .carousel-dots .dot.active { background: var(--accent); width: 28px; border-radius: 5px; }

    /* ===== TESTIMONIALS — CYBER HUD OVERLAY ===== */
    .testimonials-section { position: relative; overflow: hidden; }
    .testimonials-section-wrap { position: absolute; inset: 0; z-index: 0; pointer-events: none; }
    .testimonial-carousel { position: relative; z-index: 2; }
    .testimonials-section::before {
        content: '';
        position: absolute; inset: 0; pointer-events: none;
        background:
            linear-gradient(rgba(0, 217, 255, 0.04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 217, 255, 0.04) 1px, transparent 1px);
        background-size: 46px 46px;
        -webkit-mask-image: radial-gradient(ellipse 65% 65% at 50% 45%, rgba(0,0,0,0.7), transparent 85%);
        mask-image: radial-gradient(ellipse 65% 65% at 50% 45%, rgba(0,0,0,0.7), transparent 85%);
    }
    .tm-radar {
        position: absolute; z-index: 1; top: 55%; left: 50%;
        width: 520px; height: 520px; transform: translate(-50%, -50%);
        border-radius: 50%; pointer-events: none;
        border: 1px solid rgba(0, 217, 255, 0.08); opacity: 0.9;
    }
    .tm-radar::before {
        content: ''; position: absolute; inset: 0; border-radius: 50%;
        border: 1px dashed rgba(0, 217, 255, 0.12); animation: wsRadarSpin 24s linear infinite;
    }
    .tm-radar::after {
        content: ''; position: absolute; inset: 0; border-radius: 50%;
        background: conic-gradient(from 0deg, rgba(0, 217, 255, 0.12), transparent 60deg, transparent 360deg);
        animation: wsRadarSpin 5s linear infinite;
    }
    .tm-particle {
        position: absolute; z-index: 1; color: rgba(0, 255, 136, 0.5);
        font-size: 0.7rem; font-family: 'Consolas', monospace; font-weight: 700;
        pointer-events: none; user-select: none; animation: wsFloat linear infinite; opacity: 0;
    }
    .testimonial-card {
        overflow: hidden; background: transparent;
        border-radius: var(--radius-xl); border: 1px solid rgba(0, 217, 255, 0.12);
        box-shadow: 0 20px 55px rgba(0, 0, 0, 0.35);
    }
    html.light-theme .testimonial-card { box-shadow: 0 20px 55px rgba(0, 0, 0, 0.08); }
    .tm-cyber {
        position: absolute; inset: 0; border-radius: var(--radius-xl); pointer-events: none;
        background: linear-gradient(160deg, rgba(12, 26, 40, 0.9), rgba(8, 18, 30, 0.85));
        backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(0, 217, 255, 0.1); z-index: 0;
    }
    html.light-theme .tm-cyber {
        background: linear-gradient(160deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.85));
    }
    .testimonial-card > * { position: relative; z-index: 2; }
    .tm-corner { position: absolute; width: 16px; height: 16px; border: 2px solid rgba(0, 217, 255, 0.55); z-index: 3; }
    .tm-corner.tl { top: 10px; left: 10px; border-width: 2px 0 0 2px; border-top-left-radius: 8px; }
    .tm-corner.tr { top: 10px; right: 10px; border-width: 2px 2px 0 0; border-top-right-radius: 8px; }
    .tm-corner.bl { bottom: 10px; left: 10px; border-width: 0 0 2px 2px; border-bottom-left-radius: 8px; }
    .tm-corner.br { bottom: 10px; right: 10px; border-width: 0 2px 2px 0; border-bottom-right-radius: 8px; }
    .tm-topbar {
        position: absolute; top: 0; left: 0; right: 0; height: 3px; z-index: 3;
        background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.8), transparent);
        animation: tmTopbar 4s linear infinite; opacity: 0.7;
        background-size: 60% 100%; background-repeat: no-repeat;
    }
    @keyframes tmTopbar {
        0% { background-position: -60% 0; }
        100% { background-position: 160% 0; }
    }
    .tm-status {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.24rem 0.7rem; margin-bottom: 1rem;
        font-size: 0.62rem; font-weight: 700; letter-spacing: 0.6px;
        color: #00ff88; background: rgba(0, 255, 136, 0.06);
        border: 1px solid rgba(0, 255, 136, 0.2); border-radius: 50px; text-transform: uppercase;
    }
    html.light-theme .tm-status { color: #0d9488; background: rgba(13,148,136,0.06); border-color: rgba(13,148,136,0.25); }
    .tm-status .tm-dot { width: 6px; height: 6px; border-radius: 50%; background: #00ff88; box-shadow: 0 0 0 0 rgba(0,255,136,0.6); animation: wsDot 1.8s ease-out infinite; }
    html.light-theme .tm-status .tm-dot { background: #0d9488; box-shadow: 0 0 0 0 rgba(13,148,136,0.5); }
    .quote-icon { position: relative; display: inline-block; }
    .quote-icon::before {
        content: ''; position: absolute; inset: -12px; border-radius: 50%;
        border: 1px solid rgba(0, 217, 255, 0.35); animation: wsPulse 3s ease-out infinite; opacity: 0;
    }
    .testimonial-card:hover .quote-icon::before { opacity: 1; }
    .author-avatar { position: relative; }
    .author-avatar::before {
        content: ''; position: absolute; inset: -5px; border-radius: 50%;
        border: 1px solid rgba(0, 255, 136, 0.4); animation: wsPulse 3s ease-out infinite; opacity: 0;
    }
    .testimonial-card:hover .author-avatar::before { opacity: 1; }

    /* ===== CONTACT — REDESIGNED MODERN ===== */
    .contact-section {
        background: linear-gradient(180deg, #070d15 0%, #0a1420 40%, #0e1e2e 70%, #080b12 100%);
        position: relative;
        overflow: hidden;
    }
    html.light-theme .contact-section {
        background: linear-gradient(180deg, #e6eef5 0%, #dbe7f0 40%, #cfddea 70%, #eef2f7 100%);
    }

    /* ===== DECORATIVE BACKGROUND ELEMENTS ===== */
    .contact-section::before {
        content: '';
        position: absolute;
        top: -20%; left: -10%;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(0, 217, 255, 0.08), transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        animation: contactOrbFloat 8s ease-in-out infinite;
        z-index: 0;
    }
    .contact-section::after {
        content: '';
        position: absolute;
        bottom: -10%; right: -5%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(0, 255, 136, 0.06), transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        animation: contactOrbFloat2 10s ease-in-out infinite;
        z-index: 0;
    }
    @keyframes contactOrbFloat {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -30px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.95); }
    }
    @keyframes contactOrbFloat2 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(-30px, 20px) scale(1.05); }
        66% { transform: translate(20px, -30px) scale(0.9); }
    }

    /* Grid pattern overlay */
    .contact-section .contact-bg-grid {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image:
            linear-gradient(rgba(0, 217, 255, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 217, 255, 0.03) 1px, transparent 1px);
        background-size: 60px 60px;
        pointer-events: none;
        z-index: 0;
    }
    html.light-theme .contact-section .contact-bg-grid {
        background-image:
            linear-gradient(rgba(0, 217, 255, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 217, 255, 0.05) 1px, transparent 1px);
    }

    /* ===== MAIN CONTENT ===== */
    .contact-section .container { position: relative; z-index: 1; }
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.3fr;
        gap: 3rem;
        align-items: start;
    }

    /* ===== CONTACT INFO CARD ===== */
    .contact-info-card {
        background: rgba(17, 24, 39, 0.6);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 217, 255, 0.12);
        border-radius: 24px;
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .contact-info-card:hover {
        border-color: rgba(0, 217, 255, 0.25);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 217, 255, 0.05);
        transform: translateY(-4px);
    }
    html.light-theme .contact-info-card {
        background: rgba(255, 255, 255, 0.7);
        border-color: rgba(0, 217, 255, 0.15);
    }
    html.light-theme .contact-info-card:hover {
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08), 0 0 40px rgba(0, 217, 255, 0.1);
    }

    /* Decorative gradient line on top of info card */
    .contact-info-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, #00d9ff, #00ff88, #00d9ff, transparent);
        background-size: 200% 100%;
        animation: contactLineSweep 3s linear infinite;
    }
    @keyframes contactLineSweep {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .contact-info-card h3 {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 0.75rem;
        letter-spacing: -0.5px;
        background: linear-gradient(135deg, var(--accent-light), #6bffb8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .contact-info-card > p {
        color: var(--text-secondary);
        line-height: 1.7;
        margin-bottom: 2rem;
        font-size: 0.92rem;
    }

    /* ===== CONTACT ITEMS — MODERN GLASS ===== */
    .contact-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 1.1rem 1.2rem;
        background: rgba(0, 217, 255, 0.04);
        border: 1px solid rgba(0, 217, 255, 0.08);
        border-radius: 16px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: default;
        position: relative;
        overflow: hidden;
    }
    .contact-item::before {
        content: '';
        position: absolute;
        top: 0; left: 0; bottom: 0;
        width: 3px;
        background: linear-gradient(180deg, #00d9ff, #00ff88);
        border-radius: 0 3px 3px 0;
        transform: scaleY(0);
        transform-origin: top;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .contact-item:hover::before { transform: scaleY(1); }
    .contact-item:hover {
        border-color: rgba(0, 217, 255, 0.25);
        transform: translateX(8px) scale(1.02);
        background: rgba(0, 217, 255, 0.07);
        box-shadow: 0 8px 30px rgba(0, 217, 255, 0.08);
    }
    html.light-theme .contact-item {
        background: rgba(255, 255, 255, 0.5);
        border-color: rgba(0, 217, 255, 0.12);
    }
    html.light-theme .contact-item:hover {
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 8px 30px rgba(0, 217, 255, 0.12);
    }
    .contact-item .icon-box {
        width: 48px;
        height: 48px;
        min-width: 48px;
        background: linear-gradient(135deg, rgba(0, 217, 255, 0.12), rgba(0, 255, 136, 0.08));
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: var(--accent-light);
        transition: all 0.4s ease;
        position: relative;
    }
    .contact-item:hover .icon-box {
        background: var(--accent-gradient);
        color: #fff;
        transform: scale(1.1) rotate(-5deg);
        box-shadow: 0 8px 25px rgba(0, 217, 255, 0.3);
    }
    .contact-item .text .label {
        font-size: 0.72rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-weight: 600;
        margin-bottom: 2px;
    }
    .contact-item .text .value {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--text-primary);
        letter-spacing: 0.2px;
        transition: color 0.3s ease;
    }
    .contact-item:hover .text .value {
        color: var(--accent-light);
    }

    /* ===== SOCIAL LINKS ===== */
    .contact-social {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(0, 217, 255, 0.08);
    }
    .contact-social .social-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }
    .contact-social .social-row {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
    }
    .contact-social .social-link {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: rgba(0, 217, 255, 0.06);
        border: 1px solid rgba(0, 217, 255, 0.1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        font-size: 1.1rem;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
    }
    .contact-social .social-link:hover {
        background: var(--accent-gradient);
        border-color: transparent;
        color: #fff;
        transform: translateY(-4px) scale(1.1);
        box-shadow: 0 8px 25px rgba(0, 217, 255, 0.3);
    }

    /* ===== FREELANCE PROFILES - ABOUT SECTION ===== */
    /* ===== KEYFRAME ANIMATIONS ===== */
    @keyframes borderRotate {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    @keyframes pulseTag {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.7; transform: scale(0.97); }
    }
    @keyframes glowPulse {
        0%, 100% { box-shadow: 0 0 5px rgba(0, 217, 255, 0.2); }
        50% { box-shadow: 0 0 20px rgba(0, 217, 255, 0.4); }
    }

    /* ===== FREELANCE PROFILES - ABOUT SECTION ===== */
    .about-freelance {
        margin-top: 2rem;
        padding: 1.5rem 1.8rem;
        background: linear-gradient(135deg, rgba(0, 217, 255, 0.05), rgba(0, 255, 136, 0.05));
        border-radius: 20px;
        position: relative;
        overflow: hidden;
        isolation: isolate;
    }
    /* Animated gradient border (idea 8) */
    .about-freelance::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 20px;
        padding: 1.5px;
        background: linear-gradient(90deg, #1DBF73, #6FDA44, #29B2FE, #1DBF73, #6FDA44, #29B2FE);
        background-size: 300% 100%;
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        animation: borderRotate 4s ease-in-out infinite;
        pointer-events: none;
        z-index: 0;
    }
    .about-freelance::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(0, 217, 255, 0.03) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }
    .about-freelance .freelance-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 0.5rem;
        position: relative;
        z-index: 1;
    }
    .about-freelance .freelance-header-left {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    /* Avatar/illustration (idea 4) */
    .about-freelance .freelance-avatar {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(0, 217, 255, 0.12), rgba(0, 255, 136, 0.08));
        border: 1px solid rgba(0, 217, 255, 0.15);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    .about-freelance .freelance-label {
        font-size: 0.85rem;
        color: var(--text-primary);
        font-weight: 700;
        letter-spacing: 0.3px;
    }
    .about-freelance .freelance-label i {
        color: var(--accent);
        background: rgba(0, 217, 255, 0.1);
        padding: 0.4rem;
        border-radius: 8px;
        font-size: 0.9rem;
    }
    /* Pulse animation tag (idea 10) */
    .about-freelance .freelance-tag {
        font-size: 0.7rem;
        color: #1DBF73;
        background: rgba(29, 191, 115, 0.1);
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        border: 1px solid rgba(29, 191, 115, 0.2);
        letter-spacing: 0.3px;
        font-weight: 600;
        animation: pulseTag 2s ease-in-out infinite;
        position: relative;
        z-index: 1;
    }
    .about-freelance .freelance-tag i {
        font-size: 0.65rem;
    }
    .about-freelance .freelance-row {
        display: flex;
        gap: 0.8rem;
        flex-wrap: nowrap;
        position: relative;
        z-index: 1;
    }
    /* Button wrapper per platform (for rating badge) */
    .about-freelance .freelance-btn-wrap {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 0.4rem;
        flex: 1;
    }
    .about-freelance .freelance-btn {
        display: inline-flex;
        min-width: 0;
        white-space: nowrap;
        align-items: center;
        gap: 0.6rem;
        padding: 0.65rem 1.3rem;
        border-radius: 14px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1.5px solid transparent;
        position: relative;
    }
    /* Icon in colored box (idea 1) */
    .about-freelance .freelance-btn .btn-icon-box {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
        transition: all 0.4s ease;
    }
    .about-freelance .freelance-btn.fiverr .btn-icon-box {
        background: rgba(29, 191, 115, 0.15);
        color: #1DBF73;
    }
    .about-freelance .freelance-btn.upwork .btn-icon-box {
        background: rgba(106, 218, 68, 0.15);
        color: #6FDA44;
    }
    .about-freelance .freelance-btn.freelancer .btn-icon-box {
        background: rgba(41, 178, 254, 0.15);
        color: #29B2FE;
    }
    .about-freelance .freelance-btn.fiverr {
        background: linear-gradient(135deg, rgba(29, 191, 115, 0.06), rgba(29, 191, 115, 0.02));
        color: #1DBF73;
        border-color: rgba(29, 191, 115, 0.2);
    }
    /* Neon glow hover (idea 2) */
    .about-freelance .freelance-btn.fiverr:hover {
        background: linear-gradient(135deg, #1DBF73, #17a864);
        color: #fff;
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 0 25px rgba(29, 191, 115, 0.4), 0 8px 30px rgba(29, 191, 115, 0.25);
        border-color: transparent;
    }
    .about-freelance .freelance-btn.fiverr:hover .btn-icon-box {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
    }
    /* Icon color shift: hover e brand color -> white (idea 9) */
    .about-freelance .freelance-btn.fiverr:hover .btn-icon-box svg rect { fill: rgba(255,255,255,0.3); }
    .about-freelance .freelance-btn.fiverr:hover .btn-icon-box svg text { fill: #fff; }
    .about-freelance .freelance-btn.upwork {
        background: linear-gradient(135deg, rgba(106, 218, 68, 0.06), rgba(106, 218, 68, 0.02));
        color: #6FDA44;
        border-color: rgba(106, 218, 68, 0.2);
    }
    .about-freelance .freelance-btn.upwork:hover {
        background: linear-gradient(135deg, #6FDA44, #5ac43a);
        color: #fff;
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 0 25px rgba(106, 218, 68, 0.4), 0 8px 30px rgba(106, 218, 68, 0.25);
        border-color: transparent;
    }
    .about-freelance .freelance-btn.upwork:hover .btn-icon-box {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
    }
    .about-freelance .freelance-btn.freelancer {
        background: linear-gradient(135deg, rgba(41, 178, 254, 0.06), rgba(41, 178, 254, 0.02));
        color: #29B2FE;
        border-color: rgba(41, 178, 254, 0.2);
    }
    .about-freelance .freelance-btn.freelancer:hover {
        background: linear-gradient(135deg, #29B2FE, #1a9ee8);
        color: #fff;
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 0 25px rgba(41, 178, 254, 0.4), 0 8px 30px rgba(41, 178, 254, 0.25);
        border-color: transparent;
    }
    .about-freelance .freelance-btn.freelancer:hover .btn-icon-box {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
    }
    /* Rating badge (idea 3) */
    .about-freelance .freelance-rating {
        font-size: 0.62rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 0.2rem;
        white-space: nowrap;
    }
    .about-freelance .freelance-rating i {
        color: #f59e0b;
        font-size: 0.55rem;
    }
    .about-freelance .freelance-rating span { font-weight: 600; color: var(--text-primary); }

    /* Light theme fixes */
    html.light-theme .about-freelance {
        background: #fff;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06);
    }
    html.light-theme .about-freelance::before {
        background: linear-gradient(90deg, #1DBF73, #6FDA44, #29B2FE, #1DBF73, #6FDA44, #29B2FE);
        background-size: 300% 100%;
        opacity: 0.6;
    }
    html.light-theme .about-freelance::after {
        background: radial-gradient(circle, rgba(0, 217, 255, 0.05) 0%, transparent 70%);
    }
    html.light-theme .about-freelance .freelance-btn.fiverr {
        background: rgba(29, 191, 115, 0.08);
        border-color: rgba(29, 191, 115, 0.25);
    }
    html.light-theme .about-freelance .freelance-btn.upwork {
        background: rgba(106, 218, 68, 0.08);
        border-color: rgba(106, 218, 68, 0.25);
    }
    html.light-theme .about-freelance .freelance-btn.freelancer {
        background: rgba(41, 178, 254, 0.08);
        border-color: rgba(41, 178, 254, 0.25);
    }
    html.light-theme .about-freelance .freelance-btn.fiverr:hover {
        background: linear-gradient(135deg, #1DBF73, #17a864);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 0 20px rgba(29, 191, 115, 0.3), 0 8px 25px rgba(29, 191, 115, 0.2);
    }
    html.light-theme .about-freelance .freelance-btn.upwork:hover {
        background: linear-gradient(135deg, #6FDA44, #5ac43a);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 0 20px rgba(106, 218, 68, 0.3), 0 8px 25px rgba(106, 218, 68, 0.2);
    }
    html.light-theme .about-freelance .freelance-btn.freelancer:hover {
        background: linear-gradient(135deg, #29B2FE, #1a9ee8);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 0 20px rgba(41, 178, 254, 0.3), 0 8px 25px rgba(41, 178, 254, 0.2);
    }
    html.light-theme .about-freelance .freelance-avatar {
        background: linear-gradient(135deg, rgba(0, 217, 255, 0.08), rgba(0, 255, 136, 0.05));
        border-color: rgba(0, 217, 255, 0.1);
    }

    /* Tablet breakpoint (idea 7) */
    @media (max-width: 768px) {
        .about-freelance { padding: 1.2rem 1.2rem; }
        .about-freelance .freelance-row { gap: 0.6rem; }
        .about-freelance .freelance-btn {
            padding: 0.55rem 1rem; font-size: 0.8rem; gap: 0.4rem;
        }
        .about-freelance .freelance-btn .btn-icon-box {
            width: 26px; height: 26px; font-size: 0.85rem;
        }
        .about-freelance .freelance-avatar { width: 34px; height: 34px; font-size: 1.1rem; }
    }
    @media (max-width: 480px) {
        .about-freelance { padding: 0.8rem; }
        .about-freelance .freelance-header { flex-direction: column; align-items: flex-start; gap: 0.4rem; }
        .about-freelance .freelance-row { gap: 0.4rem; flex-wrap: nowrap; }
        .about-freelance .freelance-btn-wrap { flex: 1; }
        .about-freelance .freelance-btn {
            padding: 0.4rem 0.5rem; font-size: 0.65rem; gap: 0.2rem;
            justify-content: center; border-radius: 10px;
        }
        .about-freelance .freelance-btn .btn-icon-box {
            width: 22px; height: 22px; font-size: 0.7rem; border-radius: 6px;
        }
        .about-freelance .freelance-btn i, .about-freelance .freelance-btn svg { font-size: 0.7rem; }
        .about-freelance .freelance-header { margin-bottom: 0.6rem; }
        .about-freelance .freelance-header-left { gap: 0.4rem; }
        .about-freelance .freelance-avatar { width: 28px; height: 28px; font-size: 0.9rem; border-radius: 8px; }
        .about-freelance .freelance-label { font-size: 0.75rem; }
        .about-freelance .freelance-tag { font-size: 0.6rem; padding: 0.2rem 0.5rem; }
        .about-freelance .freelance-tag i { display: none; }
        .about-freelance .freelance-rating { font-size: 0.5rem; }
    }

    /* ===== CONTACT FORM — GLASS CARD ===== */
    .contact-form {
        background: rgba(17, 24, 39, 0.6);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 217, 255, 0.12);
        border-radius: 24px;
        padding: 2.8rem;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }
    .contact-form:hover {
        border-color: rgba(0, 217, 255, 0.2);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }
    html.light-theme .contact-form {
        background: rgba(255, 255, 255, 0.7);
        border-color: rgba(0, 217, 255, 0.15);
    }
    html.light-theme .contact-form:hover {
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
    }

    /* Form header */
    .contact-form .form-header {
        margin-bottom: 2rem;
    }
    .contact-form .form-header h4 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
        color: var(--text-primary);
    }
    .contact-form .form-header p {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin: 0;
    }

    /* ===== MODERN FORM FIELDS ===== */
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    .form-group .field-wrapper {
        position: relative;
    }
    .form-group label {
        display: block;
        font-size: 0.78rem;
        font-weight: 600;
        margin-bottom: 0.4rem;
        color: var(--text-secondary);
        letter-spacing: 0.3px;
        transition: color 0.3s ease;
    }
    .form-group:focus-within label {
        color: var(--accent-light);
    }
    .form-group input, .form-group textarea {
        width: 100%;
        padding: 0.85rem 1.2rem;
        background: rgba(8, 11, 18, 0.5);
        border: 1.5px solid rgba(0, 217, 255, 0.1);
        border-radius: 14px;
        color: var(--text-primary) !important;
        font-family: var(--font);
        font-size: 0.92rem;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        outline: none;
    }
    html.light-theme .form-group input,
    html.light-theme .form-group textarea {
        background: rgba(255, 255, 255, 0.6) !important;
        color: #111827 !important;
        border-color: rgba(0, 217, 255, 0.15) !important;
    }
    .form-group input:focus, .form-group textarea:focus {
        border-color: #00d9ff;
        box-shadow:
            0 0 0 3px rgba(0, 217, 255, 0.08),
            0 4px 20px rgba(0, 217, 255, 0.05);
        background: rgba(8, 11, 18, 0.7);
        color: var(--text-primary) !important;
    }
    html.light-theme .form-group input:focus,
    html.light-theme .form-group textarea:focus {
        background: #ffffff !important;
        border-color: #00d9ff !important;
        box-shadow:
            0 0 0 3px rgba(0, 217, 255, 0.12),
            0 4px 20px rgba(0, 217, 255, 0.1) !important;
    }
    .form-group input::placeholder, .form-group textarea::placeholder {
        color: rgba(148, 163, 184, 0.4);
    }
    html.light-theme .form-group input::placeholder,
    html.light-theme .form-group textarea::placeholder {
        color: rgba(100, 116, 139, 0.4);
    }
    .form-group textarea {
        resize: vertical;
        min-height: 120px;
        line-height: 1.6;
    }

    /* Input focus glow effect */
    .form-group .field-glow {
        position: absolute;
        top: -2px; left: -2px; right: -2px; bottom: -2px;
        border-radius: 16px;
        background: linear-gradient(135deg, #00d9ff, #00ff88, #00d9ff);
        background-size: 200% 200%;
        opacity: 0;
        z-index: -1;
        transition: opacity 0.4s ease;
        animation: fieldGlowRotate 2s linear infinite;
        pointer-events: none;
    }
    @keyframes fieldGlowRotate {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .form-group:focus-within .field-glow {
        opacity: 1;
    }

    /* Input icons */
    .form-group .field-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(148, 163, 184, 0.3);
        font-size: 1rem;
        pointer-events: none;
        transition: all 0.3s ease;
    }
    .form-group:focus-within .field-icon {
        color: var(--accent);
        opacity: 0.6;
    }
    .form-group textarea ~ .field-icon {
        top: 1.2rem;
        transform: none;
    }

    /* ===== MODERN SUBMIT BUTTON ===== */
    .btn-submit {
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, #00d9ff, #00d9ff, #00ff88);
        background-size: 200% 200%;
        color: #fff;
        border: none;
        border-radius: 14px;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        font-family: var(--font);
        letter-spacing: 0.3px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        animation: btnGradShift 3s ease infinite;
    }
    @keyframes btnGradShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .btn-submit:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow:
            0 12px 40px rgba(0, 217, 255, 0.35),
            0 0 60px rgba(0, 217, 255, 0.1);
    }
    .btn-submit:active {
        transform: translateY(-1px) scale(0.98);
    }
    .btn-submit .btn-shimmer {
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.6s ease;
    }
    .btn-submit:hover .btn-shimmer { left: 100%; }
    .btn-submit .btn-icon {
        font-size: 1.1rem;
        transition: transform 0.4s ease;
    }
    .btn-submit:hover .btn-icon {
        transform: translateX(3px) rotate(-10deg);
    }

    /* ===== MODERN MAP SECTION ===== */
    .map-wrapper {
        margin-top: 3rem;
        position: relative;
    }
    .map-container {
        max-width: 900px;
        margin: 0 auto;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(0, 217, 255, 0.12);
        box-shadow:
            0 10px 40px rgba(0, 0, 0, 0.3),
            0 0 60px rgba(0, 217, 255, 0.03);
        transition: all 0.4s ease;
        position: relative;
    }
    .map-container::before {
        content: '';
        position: absolute;
        top: -1px; left: -1px; right: -1px; bottom: -1px;
        border-radius: 25px;
        background: linear-gradient(135deg, rgba(0, 217, 255, 0.15), transparent, rgba(0, 255, 136, 0.1));
        z-index: -1;
        opacity: 0;
        transition: opacity 0.5s ease;
    }
    .map-container:hover {
        border-color: rgba(0, 217, 255, 0.25);
        box-shadow:
            0 20px 60px rgba(0, 0, 0, 0.4),
            0 0 80px rgba(0, 217, 255, 0.06);
        transform: translateY(-3px);
    }
    .map-container:hover::before { opacity: 1; }
    .map-container iframe {
        display: block;
        filter: invert(0.9) hue-rotate(180deg) saturate(0.5);
        transition: filter 0.5s ease;
    }
    .map-container:hover iframe { filter: invert(0.85) hue-rotate(180deg) saturate(0.6); }
    html.light-theme .map-container iframe { filter: none !important; }
    html.light-theme .map-container {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }
    html.light-theme .map-container:hover {
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
    }

    /* ===== CONTACT — CYBER HUD OVERLAY ===== */
    .contact-section { position: relative; overflow: hidden; }
    .contact-section .container { position: relative; z-index: 2; }
    .contact-radar {
        position: absolute; z-index: 1; top: 42%; left: 50%;
        width: 680px; height: 680px; transform: translate(-50%, -50%);
        border-radius: 50%; pointer-events: none;
        border: 1px solid rgba(0, 217, 255, 0.07); opacity: 0.8;
    }
    .contact-radar::before {
        content: ''; position: absolute; inset: 0; border-radius: 50%;
        border: 1px dashed rgba(0, 217, 255, 0.1); animation: wsRadarSpin 26s linear infinite;
    }
    .contact-radar::after {
        content: ''; position: absolute; inset: 0; border-radius: 50%;
        background: conic-gradient(from 0deg, rgba(0, 217, 255, 0.09), transparent 60deg, transparent 360deg);
        animation: wsRadarSpin 6s linear infinite;
    }
    .contact-particle {
        position: absolute; z-index: 1; color: rgba(0, 255, 136, 0.45);
        font-size: 0.7rem; font-family: 'Consolas', monospace; font-weight: 700;
        pointer-events: none; user-select: none; animation: wsFloat linear infinite; opacity: 0;
    }
    .ct-corner { position: absolute; width: 16px; height: 16px; border: 2px solid rgba(0, 217, 255, 0.6); z-index: 6; }
    .ct-corner.tl { top: 12px; left: 12px; border-width: 2px 0 0 2px; border-top-left-radius: 9px; }
    .ct-corner.tr { top: 12px; right: 12px; border-width: 2px 2px 0 0; border-top-right-radius: 9px; }
    .ct-corner.bl { bottom: 12px; left: 12px; border-width: 0 0 2px 2px; border-bottom-left-radius: 9px; }
    .ct-corner.br { bottom: 12px; right: 12px; border-width: 0 2px 2px 0; border-bottom-right-radius: 9px; }
    .ct-topbar {
        position: absolute; top: 0; left: 0; right: 0; height: 3px; z-index: 6;
        background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.8), transparent);
        background-size: 60% 100%; background-repeat: no-repeat;
        animation: tmTopbar 4s linear infinite; opacity: 0.6;
    }
    .ct-status {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.24rem 0.7rem; margin-bottom: 1rem;
        font-size: 0.62rem; font-weight: 700; letter-spacing: 0.6px;
        color: #00ff88; background: rgba(0, 255, 136, 0.06);
        border: 1px solid rgba(0, 255, 136, 0.22); border-radius: 50px; text-transform: uppercase;
    }
    html.light-theme .ct-status { color: #0d9488; background: rgba(13,148,136,0.06); border-color: rgba(13,148,136,0.25); }
    .ct-status .ct-dot { width: 6px; height: 6px; border-radius: 50%; background: #00ff88; box-shadow: 0 0 0 0 rgba(0,255,136,0.6); animation: wsDot 1.8s ease-out infinite; }
    html.light-theme .ct-status .ct-dot { background: #0d9488; box-shadow: 0 0 0 0 rgba(13,148,136,0.5); }
    .contact-info-card, .contact-form { overflow: hidden; }
    .map-scan {
        position: absolute; top: 0; left: 0; right: 0; height: 40px; z-index: 6;
        background: linear-gradient(180deg, transparent, rgba(0, 217, 255, 0.06), rgba(0, 255, 136, 0.16), transparent);
        pointer-events: none; animation: mapScan 6s ease-in-out infinite; opacity: 0;
    }
    @keyframes mapScan {
        0%, 12% { top: -10%; opacity: 0; }
        18% { opacity: 0.8; }
        82% { opacity: 0.8; }
        88%, 100% { top: 108%; opacity: 0; }
    }
    .map-status { position: absolute; top: 12px; left: 12px; margin: 0; z-index: 7; background: rgba(8,18,30,0.75); }
    html.light-theme .map-status { background: rgba(255,255,255,0.9); }
    .contact-section .section-title .line { background: linear-gradient(90deg, var(--accent), #00ff88); }

    /* Map */
    .map-wrapper { margin-top: 3rem; }
    .map-container {
        max-width: 900px; margin: 0 auto; border-radius: var(--radius-lg);
        overflow: hidden; border: 1px solid var(--border-color);
        box-shadow: var(--shadow-sm); transition: var(--transition);
    }
    .map-container:hover { border-color: var(--border-hover); box-shadow: var(--shadow-md); }
    .map-container iframe { display: block; filter: invert(0.9) hue-rotate(180deg) saturate(0.5); }
    html.light-theme .map-container iframe { filter: none !important; }

    /* Footer */
    .footer {
        background: #070a13; position: relative; z-index: 1;
        padding: 3.5rem 2rem 2.5rem; text-align: center;
        border-top: none; overflow: hidden;
    }
    .footer::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #00d9ff, #00ff88, #00d9ff, transparent);
        background-size: 200% 100%; animation: footerLine 3s linear infinite;
    }
    @keyframes footerLine {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    /* cyber grid + glow layers */
    .footer::after {
        content: ''; position: absolute; top: -50%; left: 50%; translate: -50% 0;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(0,217,255,0.06) 0%, transparent 70%);
        pointer-events: none;
    }
    .footer-cybergrid {
        position: absolute; inset: 0; pointer-events: none; z-index: 0;
        background-image:
            linear-gradient(90deg, rgba(0,217,255,.03) 1px, transparent 1px),
            linear-gradient(rgba(0,217,255,.03) 1px, transparent 1px);
        background-size: 38px 38px;
        -webkit-mask-image: radial-gradient(ellipse 70% 70% at 50% 100%, black 15%, transparent 75%);
        mask-image: radial-gradient(ellipse 70% 70% at 50% 100%, black 15%, transparent 75%);
    }
    html.light-theme .footer { background: linear-gradient(180deg, #f1f5f9, #e2e8f0) !important; }
    html.light-theme .footer::after {
        background: radial-gradient(circle, rgba(0,217,255,0.04) 0%, transparent 70%);
    }
    html.light-theme .footer-cybergrid {
        background-image:
            linear-gradient(90deg, rgba(0,100,140,.04) 1px, transparent 1px),
            linear-gradient(rgba(0,100,140,.04) 1px, transparent 1px);
    }
    .footer-inner { position: relative; z-index: 2; max-width: 900px; margin: 0 auto; }

    /* status bar strip */
    .ft-status {
        display: inline-flex; align-items: center; gap: .6rem;
        font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: .6rem; font-weight: 700; letter-spacing: .14em;
        color: #00ff88; text-transform: uppercase;
        border: 1px solid rgba(0,217,255,.2);
        background: rgba(0,217,255,.04);
        border-radius: 8px; padding: .35rem .9rem;
        margin-bottom: 1.6rem;
    }
    html.light-theme .ft-status { color: #00884a; border-color: rgba(0,100,140,.25); background: rgba(0,100,140,.05); }
    .ft-status .ft-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: #00ff88; box-shadow: 0 0 8px #00ff88;
        animation: ftDotBlink 1.1s step-end infinite;
    }
    html.light-theme .ft-status .ft-dot { background: #00884a; box-shadow: 0 0 8px rgba(0,136,74,.6); }
    @keyframes ftDotBlink { 50% { opacity: .3; } }
    .ft-status i { font-size: .75rem; color: #00ff88; }
    html.light-theme .ft-status i { color: #00884a; }

    .footer-brand { margin-bottom: 1.5rem; }
    .footer-brand h4 {
        font-size: 1.4rem; font-weight: 800; letter-spacing: -.5px;
        background: linear-gradient(135deg, var(--accent-light), #6bffb8);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        font-family: 'JetBrains Mono', Consolas, monospace;
    }
    .footer-brand p { color: #64748b; font-size: .82rem; margin: .3rem 0 0; }
    .footer-divider {
        width: 80px; height: 2px; margin: 0 auto 1.5rem;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        border-radius: 2px;
    }
    .footer-links {
        display: flex; justify-content: center; gap: 1.4rem; margin-bottom: 1.5rem; flex-wrap: wrap;
    }
    .footer-links a {
        color: #64748b; transition: all .3s ease; font-size: .8rem;
        font-weight: 500; text-decoration: none; position: relative;
        padding: .25rem .65rem;
        font-family: 'JetBrains Mono', Consolas, monospace;
        border: 1px solid transparent; border-radius: 6px;
        letter-spacing: .03em;
    }
    .footer-links a::before {
        content: '> '; color: var(--accent); opacity: 0; transition: opacity .3s;
    }
    .footer-links a:hover {
        color: var(--accent-light);
        border-color: rgba(0,217,255,.25);
        background: rgba(0,217,255,.05);
    }
    html.light-theme .footer-links a:hover { color: var(--accent); border-color: rgba(0,100,140,.25); background: rgba(0,100,140,.06); }
    .footer-links a:hover::before { opacity: 1; }
    .social-icon {
        width: 44px; height: 44px; border-radius: 10px;
        background: rgba(0,217,255,0.05);
        border: 1px solid rgba(0,217,255,0.15);
        display: inline-flex; align-items: center; justify-content: center;
        color: #64748b; font-size: 1.2rem;
        transition: all .35s cubic-bezier(.16,1,.3,1);
        text-decoration: none; position: relative; overflow: hidden;
        clip-path: polygon(6px 0, 100% 0, 100% calc(100% - 6px), calc(100% - 6px) 100%, 0 100%, 0 6px);
    }
    .social-icon::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(0,217,255,.14), rgba(0,255,136,.1));
        opacity: 0; transition: opacity .35s ease;
    }
    .social-icon::after {
        content: ''; position: absolute; top: 0; left: -60%; width: 50%; bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,.18), transparent);
        transform: skewX(-20deg); transition: left .5s ease;
    }
    .social-icon:hover::before { opacity: 1; }
    .social-icon:hover::after { left: 120%; }
    .social-icon i, .social-icon svg { position: relative; z-index: 1; }
    .social-icon:hover {
        border-color: rgba(0,217,255,.45); color: var(--accent-light);
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0,217,255,.18);
        filter: drop-shadow(0 0 8px rgba(0,217,255,.3));
    }
    html.light-theme .social-icon {
        background: rgba(255,255,255,.6); border-color: rgba(0,217,255,.15);
    }
    html.light-theme .social-icon:hover {
        background: rgba(255,255,255,.85); border-color: var(--accent); color: var(--accent);
        box-shadow: 0 10px 30px rgba(0,217,255,.2);
        filter: none;
    }
    .footer-bottom {
        padding-top: 1.2rem; border-top: 1px solid rgba(0,217,255,.08);
        display: flex; justify-content: center; align-items: center; gap: 1.1rem; flex-wrap: wrap;
    }
    .footer-bottom p { color: #475569; font-size: .82rem; margin: 0; }
    html.light-theme .footer-bottom p { color: #64748b; }
    .footer-bottom .heart { color: #ef4444; display: inline-block; animation: heartBeat 1.4s ease infinite; }
    @keyframes heartBeat { 0%,100% { transform: scale(1); } 50% { transform: scale(1.2); } }
    .ft-seal {
        display: inline-flex; align-items: center; gap: .35rem;
        font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: .66rem; font-weight: 700; letter-spacing: .1em;
        color: rgba(0,255,136,.8); text-transform: uppercase;
        border: 1px solid rgba(0,255,136,.25);
        padding: .2rem .6rem; border-radius: 6px;
        background: rgba(0,255,136,.04);
    }
    html.light-theme .ft-seal { color: #00884a; border-color: rgba(0,136,74,.3); background: rgba(0,136,74,.05); }
    .back-top {
        display: inline-flex; align-items: center; gap: .4rem;
        color: var(--accent); font-size: .78rem; font-weight: 600;
        text-decoration: none; transition: all .3s ease;
        font-family: 'JetBrains Mono', Consolas, monospace;
    }
    .back-top:hover { gap: .7rem; color: var(--accent-light); }
    html.light-theme .footer-links a { color: #64748b; }

    /* WhatsApp */
    .whatsapp-float {
        position: fixed; bottom: 2rem; left: 2rem;
        width: 56px; height: 56px;
        background: linear-gradient(135deg, #25D366, #128C7E);
        border-radius: 50%; display: flex; align-items: center;
        justify-content: center; color: #fff; font-size: 1.6rem;
        z-index: 9999; box-shadow: 0 6px 25px rgba(37, 211, 102, 0.35);
        transition: var(--transition); text-decoration: none;
        animation: pulseWhatsApp 2.5s ease-in-out infinite;
    }
    .whatsapp-float:hover { transform: scale(1.1); box-shadow: 0 10px 35px rgba(37, 211, 102, 0.5); color: #fff; }
    .whatsapp-tooltip {
        position: absolute; left: 66px; top: 50%; transform: translateY(-50%);
        background: #1e293b; color: var(--text-primary);
        padding: 0.4rem 0.9rem; border-radius: var(--radius-sm);
        font-size: 0.78rem; white-space: nowrap; font-weight: 500;
        opacity: 0; pointer-events: none; transition: var(--transition);
        border: 1px solid var(--border-color);
    }
    html.light-theme .whatsapp-tooltip { background: #f1f5f9 !important; color: #111827 !important; border-color: rgba(0, 217, 255, 0.15) !important; }
    .whatsapp-float:hover .whatsapp-tooltip { opacity: 1; }
    @keyframes pulseWhatsApp {
        0%, 100% { box-shadow: 0 6px 25px rgba(37, 211, 102, 0.35); }
        50% { box-shadow: 0 6px 40px rgba(37, 211, 102, 0.6); }
    }

    /* Scroll Progress Bar */
    .scroll-progress {
        position: fixed; top: 0; left: 0;
        height: 3px; z-index: 10001;
        background: linear-gradient(90deg, #00d9ff, #00ff88, #ec4899);
        background-size: 200% 100%;
        animation: progressGlow 2s ease infinite;
        width: 0%;
        transition: width 0.1s ease-out;
        box-shadow: 0 0 10px rgba(0, 217, 255, 0.4);
    }
    @keyframes progressGlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Back to Top */


    /* Floating Admin Button */
    .admin-float-btn {
        position: fixed; bottom: 5rem; right: 2rem;
        width: 48px; height: 48px;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; cursor: pointer; z-index: 99;
        opacity: 0; transform: translateY(20px);
        transition: var(--transition); border: none; color: #fff;
        text-decoration: none;
        box-shadow: 0 5px 20px rgba(0,217,255,0.3);
    }
    .admin-float-btn:hover {
        opacity: 1 !important;
        transform: translateY(-5px) !important;
        color: #fff;
        box-shadow: 0 10px 30px rgba(0,217,255,0.45);
    }
    .admin-float-btn.visible { opacity: 1; transform: translateY(0); }

    /* Toast */
    .toast {
        position: fixed; bottom: 2rem; left: 50%;
        transform: translateX(-50%) translateY(100px);
        background: var(--accent-gradient); color: #fff;
        padding: 1rem 2rem; border-radius: var(--radius-md);
        font-weight: 600; z-index: 10000;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: var(--shadow-accent);
        display: flex; align-items: center; gap: 0.5rem;
    }
    .toast.show { transform: translateX(-50%) translateY(0); }

    /* Download CV Button */
    .btn-download {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.95rem 2.5rem;
        background: linear-gradient(135deg, #059669, #10b981, #34d399);
        color: #fff;
        border: none;
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        text-decoration: none !important;
        box-shadow: 0 8px 30px rgba(16, 185, 129, 0.25);
        letter-spacing: 0.3px;
    }
    .btn-download::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.6s ease;
    }
    .btn-download:hover::before { left: 100%; }
    .btn-download:hover {
        transform: translateY(-4px) scale(1.03);
        box-shadow: 0 12px 40px rgba(16, 185, 129, 0.4);
        color: #fff;
    }
    .btn-download:active {
        transform: translateY(-1px) scale(0.98);
    }
    .btn-download .download-icon {
        font-size: 1.2rem;
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .btn-download:hover .download-icon {
        transform: translateY(3px) scale(1.15);
        animation: downloadBounce 1s ease infinite;
    }
    @keyframes downloadBounce {
        0%, 100% { transform: translateY(0) scale(1); }
        50% { transform: translateY(4px) scale(1.1); }
    }
    .btn-download .format-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.2rem 0.6rem;
        background: rgba(255,255,255,0.18);
        border-radius: 6px;
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: background 0.3s ease;
    }
    .btn-download:hover .format-badge {
        background: rgba(255,255,255,0.25);
    }
    .btn-download .btn-text {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    .btn-download-wrapper {
        margin-top: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .btn-download-wrapper .download-hint {
        font-size: 0.78rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 0.35rem;
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .btn-download-wrapper:hover .download-hint {
        opacity: 1;
        transform: translateX(0);
    }
    html.light-theme .btn-download {
        box-shadow: 0 8px 30px rgba(16, 185, 129, 0.3);
    }
    html.light-theme .btn-download:hover {
        box-shadow: 0 12px 40px rgba(16, 185, 129, 0.45);
    }

    /* Shared Utilities */
    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-state i { font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem; display: block; }
    .empty-state p { color: var(--text-muted); }
    .magnetic { transition: transform 0.3s ease; }

    /* ===== COMPREHENSIVE RESPONSIVE ===== */
    
    /* Tablet (max 968px) */
    @media (max-width: 968px) {
        .about-grid, .contact-grid { grid-template-columns: 1fr; gap: 2.5rem; }
        .about-image { order: -1; }
        .hero { padding: 5rem 1.5rem 2rem; }
        .hero-content { max-width: 100%; padding: 0 0.5rem; }
        .hero h1 { font-size: clamp(2.4rem, 7vw, 4rem); }
        .whatsapp-float { width: 48px; height: 48px; font-size: 1.3rem; bottom: 1.5rem; left: 1.5rem; }
        .admin-float-btn { width: 42px; height: 42px; font-size: 1rem; bottom: 4.5rem; right: 1.5rem; }
    }
    
    /* Mobile Large (max 768px) */
    @media (max-width: 768px) {
        .section-padding { padding: 5rem 1.5rem; }
        .section-title { margin-bottom: 3rem; }
        .section-title h2 { font-size: 2rem; }
        .section-title p { font-size: 0.95rem; }
        .hero { overflow: hidden; }
        .hero h1 { font-size: clamp(2rem, 6vw, 3.5rem); }
        .hero p { font-size: 1rem; }
        .hero-badge { font-size: 0.75rem; padding: 0.3rem 1rem; }
        .hero::before { width: 400px; height: 400px; }
        .hero-content { width: 100%; min-width: 0; }
        .hero-badge { max-width: 90%; text-align: center; white-space: normal; }
        .hero p { max-width: 100%; }
        .hero h1 .gradient-text { white-space: normal; word-break: break-word; }
        
        .about-stats { flex-wrap: nowrap; gap: 0.75rem; }
        .stat-item .stat-icon { width: 36px; height: 36px; font-size: 0.95rem; }
        .about-image .img-wrapper { width: 180px; height: 180px; }
        .about-image .glow-ring { width: 200px; height: 200px; }
        .about-text { flex-direction: column; gap: 1.5rem; }
        .about-text h3 { font-size: 1.5rem; }
        .about-text p { font-size: 0.92rem; }
        .stat-item .number { font-size: 1.6rem; }
        .about-social-sidebar {
            flex-direction: row; flex-wrap: wrap; justify-content: center;
            padding: 0.75rem; width: 100%; position: static;
            background: none; border: none; border-radius: 0;
        }
        .about-social-sidebar .social-label { writing-mode: horizontal-tb; }
        .about-social-sidebar .social-links { flex-direction: row; }
        .about-social-sidebar .social-link { width: 40px; height: 40px; font-size: 1rem; }
        
        

        
        

        
        .gigs-grid { gap: 1.5rem; }
        .gig-card { width: calc(50% - 0.75rem); min-width: 240px; }
        .filter-tabs { gap: 0.4rem; }
        .filter-btn { font-size: 0.75rem; padding: 0.4rem 1rem; }
        
        .testimonial-card { padding: 2rem 1.5rem; }
        .testimonial-text { font-size: 0.95rem; }
        .contact-info h3 { font-size: 1.4rem; }
        .contact-form { padding: 1.8rem; }
        
        .faq-item .faq-question { padding: 1rem 1.2rem !important; font-size: 0.92rem !important; }
        .faq-answer p { font-size: 0.85rem !important; }
        
        .footer { padding: 2.5rem 1.5rem; }
        .footer-inner { max-width: 100%; }
        .footer-links { gap: 1.2rem; }
        .footer-links a { font-size: 0.82rem; }
        .social-icon { width: 38px; height: 38px; font-size: 1rem; }
        .footer-bottom { flex-direction: column; gap: 0.5rem; text-align: center; }
        
        .scroll-indicator { display: none; }
        .toast { padding: 0.8rem 1.5rem; font-size: 0.85rem; max-width: 90%; }
        .empty-state { padding: 3rem 1.2rem; }
        .empty-state i { font-size: 2.2rem; }
        
        /* Tablet hero decorative */
        .float-chip { display: none; }
    }
    
    /* Mobile Small (max 480px) */
    @media (max-width: 480px) {
        .section-padding { padding: 3rem 1rem; }
        .section-title { padding: 0 0.5rem; margin-bottom: 2.5rem; }
        .section-title h2 { font-size: 1.7rem; letter-spacing: -0.5px; }
        .section-title .line { width: 45px; height: 3px; }
        .hero { padding: 4rem 1rem 1.5rem; min-height: 88vh; }
        .hero h1 { font-size: 1.7rem; letter-spacing: -0.5px; }
        .hero p { font-size: 0.9rem; }
        .hero-buttons { flex-direction: column; align-items: center; gap: 0.7rem; }
        .hero-buttons .btn-primary-custom,
        .hero-buttons .btn-outline-custom { width: 100%; justify-content: center; padding: 0.75rem 1.5rem; font-size: 0.88rem; }
        .hero::before { width: 300px; height: 300px; }
        .hero-badge { font-size: 0.68rem; padding: 0.35rem 0.9rem; margin-bottom: 1.2rem; gap: 0.4rem; }
        .hero-badge i { font-size: 0.8rem; }
        
        .cyber-entry { padding-left: 2.9rem; }
        .cyber-node { width: 30px; height: 30px; font-size: 0.78rem; top: 1.1rem; }
        .cyber-card { padding: 0.85rem; }
        .cyber-card h3 { font-size: 0.88rem; }
        .cyber-company { font-size: 0.72rem; margin-bottom: 0.4rem; }
        .cyber-card p { font-size: 0.72rem; line-height: 1.5; }
        .cyber-date { font-size: 0.62rem; padding: 0.15rem 0.6rem; }
        .cyber-status { font-size: 0.5rem; padding: 0.15rem 0.5rem; }
        .cyber-location { font-size: 0.68rem; }

        .skills-grid { gap: 1.2rem; }
        .skill-card { padding: .5rem .7rem; }
        .skill-card .sk-bar { width: 80px; }
        .skill-card .skill-name { font-size: 0.66rem; }
        .skill-card .skill-percent { font-size: 0.58rem; }
        .skills-grid { animation-duration: 20s; }
        
        .about-grid { gap: 2rem; }
        .about-image .img-wrapper { width: 150px; height: 150px; border-radius: 50%; }
        .about-image .glow-ring { width: 170px; height: 170px; border-radius: 50%; }
        .about-stats .stat-item { padding: 0.8rem 0.6rem; }
        .stat-item .stat-icon { width: 32px; height: 32px; font-size: 0.85rem; margin-bottom: 0.5rem; }
        .about-stats .stat-item .number { font-size: 1.4rem; }
        .about-stats .stat-item .label { font-size: 0.72rem; }
        .about-text h3 { font-size: 1.3rem; }
        .about-social-sidebar {
            flex-direction: row; flex-wrap: wrap; justify-content: center;
            padding: 0.5rem; width: 100%; position: static;
            background: none; border: none; border-radius: 0;
        }
        .about-social-sidebar .social-label { writing-mode: horizontal-tb; }
        .about-social-sidebar .social-links { flex-direction: row; }
        .about-social-sidebar .social-link { width: 38px; height: 38px; font-size: 0.95rem; }
        .gigs-grid { display: block !important; gap: unset; width: 100% !important; }
        .gig-card { width: 100% !important; min-width: 0 !important; display: block; max-width: none !important; }
        .gig-card + .gig-card { margin-top: 1rem; }
        .gig-head { padding: 1.5rem 1.2rem 1rem; }
        .gig-thumb { height: 130px; }
        .gig-head h3 { font-size: 1.02rem; margin-bottom: 0.3rem; }
        .gig-head p { font-size: 0.8rem; margin-bottom: 0.4rem; line-height: 1.45; }
        .gig-icon { width: 60px; height: 60px; margin-bottom: 0.9rem; }
        .gig-icon i { font-size: 1.6rem; }
        .gig-tiers { padding: 0.75rem 1.2rem; gap: 0.4rem; }
        .gig-cta { margin: auto 1.2rem 1.2rem; padding: 0.7rem 1rem; font-size: 0.82rem; }
        .filter-tabs { justify-content: flex-start; overflow-x: auto; flex-wrap: nowrap; padding-bottom: 0.5rem; -webkit-overflow-scrolling: touch; }
        .filter-tabs::-webkit-scrollbar { height: 2px; }
        .filter-tabs::-webkit-scrollbar-thumb { background: rgba(0,217,255,0.3); border-radius: 2px; }
        .filter-btn { flex-shrink: 0; }
        
        .testimonial-card { padding: 1.5rem 1.2rem; }
        .testimonial-text { font-size: 0.88rem; }
        .quote-icon { font-size: 2rem; }
        .carousel-btn { width: 38px; height: 38px; font-size: 0.9rem; }
        .carousel-dots .dot { width: 8px; height: 8px; }
        .carousel-dots .dot.active { width: 22px; }
        
        .contact-grid { gap: 2rem; }
        .contact-form { padding: 1.4rem; }
        .contact-info h3 { font-size: 1.2rem; }
        .contact-item { padding: 0.8rem; }
        .contact-item .icon-box { width: 38px; height: 38px; font-size: 1rem; }
        .contact-item .text .value { font-size: 0.82rem; }
        .form-group label { font-size: 0.8rem; }
        .form-group input, .form-group textarea { padding: 0.75rem 1rem; font-size: 0.85rem; }
        .btn-submit { padding: 0.85rem; font-size: 0.88rem; }
        
        .whatsapp-tooltip { display: none; }
        .whatsapp-float { width: 44px; height: 44px; font-size: 1.2rem; bottom: 1rem; left: 1rem; }
        .admin-float-btn { width: 38px; height: 38px; font-size: 0.9rem; bottom: 4rem; right: 1rem; border-radius: 10px; }
        
        .map-container iframe { height: 220px; }
        .map-wrapper { margin-top: 2rem; }
        
        .footer { padding: 2rem 1rem; }
        .footer-inner { max-width: 100%; }
        .footer-links { gap: 0.8rem; flex-direction: column; align-items: center; }
        .footer-bottom { flex-direction: column; gap: 0.4rem; text-align: center; }
        .footer p, .footer-bottom p, .footer-bottom span { font-size: 0.78rem; }
        .social-icon { width: 36px; height: 36px; font-size: 0.95rem; }
        .back-top { font-size: 0.75rem; }
        
        .toast { font-size: 0.8rem; padding: 0.7rem 1.2rem; max-width: 85%; bottom: 1.2rem; }
        .empty-state { padding: 2rem 1rem; }
        .empty-state i { font-size: 2rem; }
        .empty-state .fw-semibold.fs-5 { font-size: 1rem !important; }
        
        .scroll-progress { height: 2px; }
        
        /* Disable some heavy animations on mobile */
        #particles-canvas { display: none; }
        .magnetic { transition: none !important; }
        
        /* Hero decorative responsive */
        .matrix-rain { opacity: 0.35; }
        .float-chip { display: none; }

        /* Extra size reductions for very small screens */
        .hero-content { max-width: 100%; }
        .hero-badge { font-size: 0.7rem; padding: 0.3rem 0.8rem; }
        .btn-primary-custom, .btn-outline-custom { font-size: 0.82rem; padding: 0.65rem 1.5rem; }
    }
    
    /* Very Small Screens (max 360px) */
    @media (max-width: 360px) {
        html { font-size: 13px; }
        .hero h1 { font-size: 1.5rem; }
        .about-image .img-wrapper { width: 130px; height: 130px; }
        .about-image .glow-ring { width: 150px; height: 150px; }
        .skills-grid { gap: 1rem; animation-duration: 15s; }
        .skill-card { padding: .45rem .6rem; gap: .5rem; }
        .skill-card .sk-icon { width: 28px; height: 28px; font-size: .85rem; }
        .skill-card .sk-bar { width: 64px; }
        .skill-card .skill-name { font-size: 0.6rem; }
        .skill-card .skill-percent { font-size: 0.52rem; }
        .about-stats { flex-direction: row; flex-wrap: nowrap; gap: 0.5rem; }
        .stat-item { min-width: 0; flex: 1; padding: 0.6rem 0.3rem; }
        .section-title h2 { font-size: 1.4rem; }
        .hero { padding: 3.5rem 0.75rem 1rem; }
        .hero p { font-size: 0.82rem; }
        .hero-badge { font-size: 0.65rem; padding: 0.2rem 0.6rem; }
        .btn-primary-custom, .btn-outline-custom { font-size: 0.78rem; padding: 0.55rem 1.2rem; }
    }
</style>
    <!-- Custom Cursor -->
    <div class="cursor-glow" id="cursorGlow"></div>

    <!-- Particles Canvas -->
    <canvas id="particles-canvas"></canvas>

    <!-- Hero Section - Cyber Security Theme -->
    <section class="hero" id="hero">
        <!-- Cyber Grid Background -->
        <div class="cyber-grid"></div>
        
        <!-- Hexagon Patterns -->
        <div class="hex-pattern" style="top: 10%; right: 5%; width: 180px; height: 180px; opacity: 0.3;"></div>
        <div class="hex-pattern" style="bottom: 20%; left: 3%; width: 140px; height: 140px; opacity: 0.2; transform: rotate(15deg);"></div>
        <div class="hex-pattern" style="top: 35%; left: 2%; width: 100px; height: 100px; opacity: 0.25; transform: rotate(-10deg);"></div>

        <!-- Cyber Security Ticker - LEFT DIAGONAL -->
        <div class="cyber-ticker cyber-ticker-left" aria-hidden="true">
            <div class="cyber-ticker-track">
                <div class="cyber-ticker-group">
                    <span class="cyber-ticker-item"><i class="bi bi-shield-check"></i>System Status: Secure</span>
                    <span class="cyber-ticker-item"><i class="bi bi-activity"></i>24/7 Threat Monitoring: Active</span>
                    <span class="cyber-ticker-item"><i class="bi bi-lock-fill"></i>Firewall: Enabled</span>
                    <span class="cyber-ticker-item"><i class="bi bi-eye"></i>Intrusion Detection: Active</span>
                    <span class="cyber-ticker-item"><i class="bi bi-key"></i>AES-256-GCM Encryption</span>
                    <span class="cyber-ticker-item"><i class="bi bi-patch-check"></i>SOC 2 + ISO 27001 Compliant</span>
                    <span class="cyber-ticker-item"><i class="bi bi-shield-fill-check"></i>DDoS Protection: Enabled</span>
                    <span class="cyber-ticker-item"><i class="bi bi-globe"></i>Zero-Trust Architecture</span>
                    <span class="cyber-ticker-item"><i class="bi bi-cpu"></i>Endpoint Security: All Clear</span>
                    <span class="cyber-ticker-item"><i class="bi bi-shield-lock-fill"></i>Threat Level: Low</span>
                </div>
                <div class="cyber-ticker-group">
                    <span class="cyber-ticker-item"><i class="bi bi-shield-check"></i>System Status: Secure</span>
                    <span class="cyber-ticker-item"><i class="bi bi-activity"></i>24/7 Threat Monitoring: Active</span>
                    <span class="cyber-ticker-item"><i class="bi bi-lock-fill"></i>Firewall: Enabled</span>
                    <span class="cyber-ticker-item"><i class="bi bi-eye"></i>Intrusion Detection: Active</span>
                    <span class="cyber-ticker-item"><i class="bi bi-key"></i>AES-256-GCM Encryption</span>
                    <span class="cyber-ticker-item"><i class="bi bi-patch-check"></i>SOC 2 + ISO 27001 Compliant</span>
                    <span class="cyber-ticker-item"><i class="bi bi-shield-fill-check"></i>DDoS Protection: Enabled</span>
                    <span class="cyber-ticker-item"><i class="bi bi-globe"></i>Zero-Trust Architecture</span>
                    <span class="cyber-ticker-item"><i class="bi bi-cpu"></i>Endpoint Security: All Clear</span>
                    <span class="cyber-ticker-item"><i class="bi bi-shield-lock-fill"></i>Threat Level: Low</span>
                </div>
                <div class="cyber-ticker-group">
                    <span class="cyber-ticker-item"><i class="bi bi-shield-check"></i>System Status: Secure</span>
                    <span class="cyber-ticker-item"><i class="bi bi-activity"></i>24/7 Threat Monitoring: Active</span>
                    <span class="cyber-ticker-item"><i class="bi bi-lock-fill"></i>Firewall: Enabled</span>
                    <span class="cyber-ticker-item"><i class="bi bi-eye"></i>Intrusion Detection: Active</span>
                    <span class="cyber-ticker-item"><i class="bi bi-key"></i>AES-256-GCM Encryption</span>
                    <span class="cyber-ticker-item"><i class="bi bi-patch-check"></i>SOC 2 + ISO 27001 Compliant</span>
                    <span class="cyber-ticker-item"><i class="bi bi-shield-fill-check"></i>DDoS Protection: Enabled</span>
                    <span class="cyber-ticker-item"><i class="bi bi-globe"></i>Zero-Trust Architecture</span>
                    <span class="cyber-ticker-item"><i class="bi bi-cpu"></i>Endpoint Security: All Clear</span>
                    <span class="cyber-ticker-item"><i class="bi bi-shield-lock-fill"></i>Threat Level: Low</span>
                </div>
            </div>
        </div>

        <!-- Cyber Security Ticker - RIGHT DIAGONAL -->
        <div class="cyber-ticker cyber-ticker-right" aria-hidden="true">
            <div class="cyber-ticker-track">
                <div class="cyber-ticker-group">
                    <span class="cyber-ticker-item"><i class="bi bi-lightning-fill"></i>LIVE: 1,247 Phishing Attempts Blocked Today</span>
                    <span class="cyber-ticker-item"><i class="bi bi-virus"></i>Real-Time Malware Scan: Running</span>
                    <span class="cyber-ticker-item"><i class="bi bi-arrow-repeat"></i>Signature Database Updated</span>
                    <span class="cyber-ticker-item"><i class="bi bi-lock-fill"></i>VPN Secure Tunnel: Connected</span>
                    <span class="cyber-ticker-item"><i class="bi bi-shield-check"></i>Quantum-Resistant Crypto: Ready</span>
                    <span class="cyber-ticker-item"><i class="bi bi-database"></i>Backups Verified: Daily 00:30 UTC</span>
                    <span class="cyber-ticker-item"><i class="bi bi-key"></i>Credential Vault: Sealed</span>
                    <span class="cyber-ticker-item"><i class="bi bi-broadcast"></i>SIEM Monitoring: 156 Nodes</span>
                    <span class="cyber-ticker-item"><i class="bi bi-wifi"></i>Secure Channel: TLS 1.3</span>
                    <span class="cyber-ticker-item"><i class="bi bi-patch-check"></i>Compliance Audit: Passed</span>
                </div>
                <div class="cyber-ticker-group">
                    <span class="cyber-ticker-item"><i class="bi bi-lightning-fill"></i>LIVE: 1,247 Phishing Attempts Blocked Today</span>
                    <span class="cyber-ticker-item"><i class="bi bi-virus"></i>Real-Time Malware Scan: Running</span>
                    <span class="cyber-ticker-item"><i class="bi bi-arrow-repeat"></i>Signature Database Updated</span>
                    <span class="cyber-ticker-item"><i class="bi bi-lock-fill"></i>VPN Secure Tunnel: Connected</span>
                    <span class="cyber-ticker-item"><i class="bi bi-shield-check"></i>Quantum-Resistant Crypto: Ready</span>
                    <span class="cyber-ticker-item"><i class="bi bi-database"></i>Backups Verified: Daily 00:30 UTC</span>
                    <span class="cyber-ticker-item"><i class="bi bi-key"></i>Credential Vault: Sealed</span>
                    <span class="cyber-ticker-item"><i class="bi bi-broadcast"></i>SIEM Monitoring: 156 Nodes</span>
                    <span class="cyber-ticker-item"><i class="bi bi-wifi"></i>Secure Channel: TLS 1.3</span>
                    <span class="cyber-ticker-item"><i class="bi bi-patch-check"></i>Compliance Audit: Passed</span>
                </div>
                <div class="cyber-ticker-group">
                    <span class="cyber-ticker-item"><i class="bi bi-lightning-fill"></i>LIVE: 1,247 Phishing Attempts Blocked Today</span>
                    <span class="cyber-ticker-item"><i class="bi bi-virus"></i>Real-Time Malware Scan: Running</span>
                    <span class="cyber-ticker-item"><i class="bi bi-arrow-repeat"></i>Signature Database Updated</span>
                    <span class="cyber-ticker-item"><i class="bi bi-lock-fill"></i>VPN Secure Tunnel: Connected</span>
                    <span class="cyber-ticker-item"><i class="bi bi-shield-check"></i>Quantum-Resistant Crypto: Ready</span>
                    <span class="cyber-ticker-item"><i class="bi bi-database"></i>Backups Verified: Daily 00:30 UTC</span>
                    <span class="cyber-ticker-item"><i class="bi bi-key"></i>Credential Vault: Sealed</span>
                    <span class="cyber-ticker-item"><i class="bi bi-broadcast"></i>SIEM Monitoring: 156 Nodes</span>
                    <span class="cyber-ticker-item"><i class="bi bi-wifi"></i>Secure Channel: TLS 1.3</span>
                    <span class="cyber-ticker-item"><i class="bi bi-patch-check"></i>Compliance Audit: Passed</span>
                </div>
            </div>
        </div>

        <!-- Matrix Binary Rain Background -->
        <canvas id="matrixRain" class="matrix-rain" aria-hidden="true"></canvas>

        <!-- Floating Security Chips -->
        <div class="float-chip c1"><i class="bi bi-shield-check"></i> AES-256</div>
        <div class="float-chip c2"><i class="bi bi-upc-scan"></i> 24/7 Monitoring</div>
        <div class="float-chip c3"><i class="bi bi-shield-lock-fill"></i> SOC 2 Ready</div>
        <div class="float-chip c4"><i class="bi bi-broadcast"></i> Zero-Trust</div>

        <!-- Scan Line Overlay -->
        <div class="scan-lines"></div>

        <div class="hero-content">
            <div class="hero-badge"><i class="bi bi-shield-fill"></i> <span class="shimmer-text">{{ __('messages.hero_badge') }}</span></div>
            <h1>{{ __('messages.hero_greeting') }}<br><span class="gradient-text">{{ optional($account)->name ?? 'Security Force' }}</span></h1>
            <p>{{ __('messages.hero_tagline') }}</p>
<div class="hero-buttons">
                <a href="#services" class="btn-primary-custom magnetic">
                    <i class="bi bi-shield-lock"></i> {{ __('messages.see_my_work') }}
                </a>
                <a href="#contact" class="btn-outline-custom magnetic">
                    <i class="bi bi-shield-gear"></i> {{ __('messages.contact_me') }}
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section section-padding" id="about">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.about_title') }}</h2>
                <p>{{ __('messages.about_subtitle') }}</p>
            </div>
            <div class="about-grid">
                <div class="about-image reveal reveal-delay-1">
                    <div class="about-cyber-grid"></div>
                    <div class="glow-ring"></div>
                    <div class="img-wrapper">
                        <img src="{{ config('app.storage_url') }}{{ optional($account)->image }}" alt="{{ optional($account)->name ?? 'Portfolio' }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                    </div>
                    <span class="about-corner tl"></span>
                    <span class="about-corner tr"></span>
                    <span class="about-corner bl"></span>
                    <span class="about-corner br"></span>
                    <div class="about-scan"></div>
                    <div class="about-verify-badge">
                        <span class="pulse-dot"></span>
                        <i class="bi bi-shield-lock-fill"></i>
                        IDENTITY VERIFIED
                    </div>
                </div>
                <div class="about-text reveal reveal-delay-2">
                    <div class="about-text-main">
                        <div class="about-status"><span class="cursor-blink"></span> SECURITY MONITOR: ONLINE</div>
                        <h3>{{ __('messages.about_heading') }}</h3>
                        <div class="about-bio-lead">
                            <p>Hi, I'm <span class="about-name-highlight">{{ optional($account)->name ?? 'Portfolio' }}</span>. {{ __('messages.about_desc_1') }}</p>
                            <p>{{ __('messages.about_desc_2') }}</p>
                        </div>
                        <div class="about-stats">
                            <div class="stat-item">
                                <div class="stat-glow"></div>
                                <div class="stat-icon"><i class="bi bi-folder2-open"></i></div>
                                <div class="number" data-count="50">0</div>
                                <div class="label">{{ __('messages.stat_projects') }}</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-glow"></div>
                                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                                <div class="number" data-count="30">0</div>
                                <div class="label">{{ __('messages.stat_clients') }}</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-glow"></div>
                                <div class="stat-icon"><i class="bi bi-trophy-fill"></i></div>
                                <div class="number" data-count="5">0</div>
                                <div class="label">{{ __('messages.stat_years') }}</div>
                            </div>
                        </div>

                        <!-- Download CV Button -->
                        @if(isset($account) && $account->cv)
                            <div class="btn-download-wrapper">
                                <a href="{{ config('app.storage_url') }}{{ $account->cv }}" 
                                   download
                                   class="btn-download magnetic">
                                    <span class="download-icon"><i class="bi bi-cloud-arrow-down-fill"></i></span>
                                    <span class="btn-text">
                                        {{ __('messages.download_cv') }}
                                        <span class="format-badge"><i class="bi bi-filetype-pdf"></i> PDF</span>
                                    </span>
                                </a>
                                <span class="download-hint">
                                    <i class="bi bi-arrow-down-circle"></i> {{ __('messages.click_to_download') }}
                                </span>
                            </div>
                        @endif

                        @if(isset($account) && ($account->fiverr || $account->upwork || $account->freelancer))
                            <div class="about-freelance">
                                <div class="freelance-header">
                                    <div class="freelance-header-left">
                                        <div class="freelance-label"><i class="bi bi-briefcase-fill me-1"></i> {{ __("messages.hire_me") }}</div>
                                    </div>
                                    <span class="freelance-tag"><i class="bi bi-lightning-fill me-1"></i>{{ __("messages.avail_for_work") }}</span>
                                </div>
                                <div class="freelance-row">
                                @if(isset($account) && $account->fiverr)
                                    <div class="freelance-btn-wrap">
                                        <a href="{{ $account->fiverr }}" target="_blank" class="freelance-btn fiverr" aria-label="Fiverr">
                                            <span class="btn-icon-box">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1em;height:1em"><rect width="24" height="24" rx="5" fill="#1DBF73"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="14" font-family="Arial,sans-serif">f</text></svg>
                                            </span>
                                            Fiverr
                                        </a>
                                    </div>
                                @endif
                                @if(isset($account) && $account->upwork)
                                    <div class="freelance-btn-wrap">
                                        <a href="{{ $account->upwork }}" target="_blank" class="freelance-btn upwork" aria-label="Upwork">
                                            <span class="btn-icon-box"><i class="fab fa-upwork"></i></span>
                                            Upwork
                                        </a>
                                    </div>
                                @endif
                                @if(isset($account) && $account->freelancer)
                                    <div class="freelance-btn-wrap">
                                        <a href="{{ $account->freelancer }}" target="_blank" class="freelance-btn freelancer" aria-label="Freelancer">
                                            <span class="btn-icon-box"><i class="fas fa-user-tie"></i></span>
                                            Freelancer
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    </div>

                    @if(isset($account) && ($account->github || $account->linkedin || $account->facebook || $account->instagram || $account->twitter || $account->youtube))
                        <aside class="about-social-sidebar">
                            <div class="social-label">{{ __("messages.connect") }}</div>
                            <div class="social-links">
                                @if(isset($account) && $account->github)
                                    <a href="{{ $account->github }}" target="_blank" class="social-link" aria-label="GitHub"><i class="bi bi-github"></i></a>
                                @endif
                                @if(isset($account) && $account->linkedin)
                                    <a href="{{ $account->linkedin }}" target="_blank" class="social-link" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                @endif
                                @if(isset($account) && $account->facebook)
                                    <a href="{{ $account->facebook }}" target="_blank" class="social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if(isset($account) && $account->instagram)
                                    <a href="{{ $account->instagram }}" target="_blank" class="social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                                @endif
                                @if(isset($account) && $account->twitter)
                                    <a href="{{ $account->twitter }}" target="_blank" class="social-link" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                                @endif
                                @if(isset($account) && $account->youtube)
                                    <a href="{{ $account->youtube }}" target="_blank" class="social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                                @endif
                            </div>
                        </aside>
                        @endif
                </div>
            </div>
        </div>
        <div class="section-divider"></div>
    </section>

    <!-- Services Section -->
    <section class="services-section section-padding" id="services">
        <div class="container services-container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.services_title') }}</h2>
                <p>{{ __('messages.services_subtitle') }}</p>
            </div>

            @if($services->isNotEmpty())
                <div class="water-surface">
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>
                <div class="wave-scene">
                    <!-- Flowing wave layers (4 layers) -->
                    <div class="wave-layer"></div>
                    <div class="wave-layer-2"></div>
                    <!-- Surface shimmer -->
                    <div class="wave-shimmer"></div>
                    <!-- Mouse ripple -->
                    <div class="wave-ripple"></div>
                    <!-- Rotating cyber radar sweep -->
                    <div class="ws-radar"></div>
                    <!-- Floating binary particles -->
                    <div class="ws-particle" style="left:6%; animation-duration:7s; animation-delay:0s;">01001</div>
                    <div class="ws-particle" style="left:14%; animation-duration:9s; animation-delay:1.5s;">1010</div>
                    <div class="ws-particle" style="left:78%; animation-duration:8s; animation-delay:0.8s;">110</div>
                    <div class="ws-particle" style="left:88%; animation-duration:6.5s; animation-delay:2.2s;">01100</div>
                    <div class="ws-particle" style="left:24%; animation-duration:10s; animation-delay:3s;">10</div>
                    <div class="ws-particle" style="left:92%; animation-duration:8.5s; animation-delay:1s;">0101</div>
                    <!-- Floating bubbles -->
                    <div class="wave-bubbles">
                        <div class="bub"></div><div class="bub"></div><div class="bub"></div>
                        <div class="bub"></div><div class="bub"></div><div class="bub"></div>
                        <div class="bub"></div><div class="bub"></div><div class="bub"></div>
                        <div class="bub"></div><div class="bub"></div><div class="bub"></div>
                    </div>
                    <!-- Services within the waves (HUD cards) -->
                    <div class="wave-services">
                        @foreach($services as $index => $service)
                            @php $delay = ($index % 4) + 1; @endphp
                            <div class="wave-service reveal reveal-delay-{{ $delay }}">
                                <div class="ws-cyber"></div>
                                <span class="ws-corner tl"></span>
                                <span class="ws-corner tr"></span>
                                <span class="ws-corner bl"></span>
                                <span class="ws-corner br"></span>
                                <div class="ws-scan"></div>
                                <div class="ws-icon">
                                    <i class="bi {{ $service->icon ?: 'bi-star' }}"></i>
                                </div>
                                <h3>{{ $service->title }}</h3>
                                @if($service->short_description)
                                    <p>{{ $service->short_description }}</p>
                                @endif
                                <span class="ws-status"><span class="ws-dot"></span> Secure</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="bottom-waves">
                    <div class="wave"></div>
                    <div class="wave"></div>
                    <div class="wave"></div>
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-gear"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_services') }}</p>
                    <p>{{ __('messages.no_services_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Gigs Section -->
    @if($gigs->isNotEmpty())
    <section class="gigs-section section-padding" id="gigs">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.gigs_title') }}</h2>
                <p>{{ __('messages.gigs_subtitle') }}</p>
            </div>

            <div class="gigs-cyber-bg" aria-hidden="true">
                <div class="gc-radar"></div>
                <div class="gc-beam"></div>
                <div class="gc-particle p1">0x7F3A</div>
                <div class="gc-particle p2">TCP:443</div>
                <div class="gc-particle p3">IDS</div>
            </div>

            <div class="gigs-grid">
                @foreach($gigs as $index => $gig)
                    @php
                        $delay = ($index % 4) + 1;
                        $tiers = [
                            ['name' => $gig->basic_name ?: 'Basic',    'price' => $gig->basic_price,    'cls' => ''],
                            ['name' => $gig->standard_name ?: 'Standard', 'price' => $gig->standard_price, 'cls' => 'std'],
                            ['name' => $gig->premium_name ?: 'Premium', 'price' => $gig->premium_price,  'cls' => 'pre'],
                        ];
                    @endphp
                    <a href="{{ route('gig.detail', $gig->id) }}" class="gig-card reveal reveal-delay-{{ $delay }}">
                        <div class="gig-hud">
                            <span class="gig-hud-id">PKG-{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</span>
                            <span class="gig-hud-live"><span class="dot"></span> ACTIVE</span>
                        </div>
                        <div class="gig-thumb">
                            @if($gig->image)
                                <img src="{{ config('app.storage_url') }}{{ $gig->image }}" alt="{{ $gig->title }}">
                            @else
                                <div class="gig-icon"><i class="bi bi-shield-lock-fill"></i></div>
                            @endif
                        </div>
                        <div class="gig-head">
                            <h3>{{ $gig->title }}</h3>
                            @if($gig->short_description)
                                <p>{{ $gig->short_description }}</p>
                            @endif
                        </div>
                        <div class="gig-tiers">
                            @foreach($tiers as $tier)
                                <div class="gig-tier {{ $tier['cls'] }}">
                                    <span class="gig-tier-name">{{ $tier['name'] }}</span>
                                    <span class="gig-tier-price">${{ number_format((int)$tier['price'], 0) }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="gig-cta">
                            <span>{{ __('messages.gigs_cta') }}</span>
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="section-divider"></div>
    </section>
    @endif

    <!-- Case Studies Section -->
    @if($caseStudies->isNotEmpty())
    <section class="casestudy-section section-padding" id="case-studies">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.casestudy_title') }}</h2>
                <p>{{ __('messages.casestudy_subtitle') }}</p>
            </div>
            <div class="cs-grid-bg" aria-hidden="true"></div>
            <div class="casestudy-grid">
                @foreach($caseStudies as $cs)
                    <a href="{{ route('case-study.detail', $cs->id) }}" class="casestudy-card reveal">
                        <div class="cs-corners"><span class="tl"></span><span class="tr"></span><span class="bl"></span><span class="br"></span></div>
                        <div class="cs-header">
                            <span class="cs-fileid">CS-{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</span>
                            <span class="cs-status"><span class="csdot"></span> {{ __('messages.case_monitored') }}</span>
                        </div>
                        @if($cs->image)
                            <div class="casestudy-image">
                                <img src="{{ config('app.storage_url') }}{{ $cs->image }}" alt="{{ $cs->title }}">
                                @if($cs->category)<span class="cs-category">{{ $cs->category }}</span>@endif
                            </div>
                        @else
                            <div class="cs-radar-ph">
                                <span class="rr r1"></span><span class="rr r2"></span><span class="rr r3"></span>
                                <span class="beam"></span>
                                <span class="cs-scan-h"></span>
                                @if($cs->category)<span class="cs-category">{{ $cs->category }}</span>@endif
                            </div>
                        @endif
                        <div class="casestudy-body">
                            <h3>{{ $cs->title }}</h3>
                            @if($cs->client)
                                <div class="cs-meta mt-2"><i class="bi bi-building me-1"></i>{{ $cs->client }}</div>
                            @endif
                        </div>
                        @if($cs->result)
                            <div class="cs-terminal">
                                <span class="cs-term-label"><i class="bi bi-shield-check me-1"></i>{{ __('messages.case_result') }}</span>
                                <p>{{ $cs->result }}</p>
                            </div>
                        @endif
                        <div class="cs-action">
                            <span class="cs-analyze-btn">{{ __('messages.analyze_case') }} <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="casestudy-cta reveal">
                <p>{{ __('messages.casestudy_cta') }}</p>
                <a href="#contact" class="btn-primary-custom">{{ __('messages.start_project') }} <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
        <div class="section-divider"></div>
    </section>
    @endif

    <!-- Experience Timeline Section -->
    <section class="timeline-section section-padding" id="experience">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.experience_title') }}</h2>
                <p>{{ __('messages.experience_subtitle') }}</p>
            </div>

            @if($experiences->isNotEmpty())
                <div class="cyber-feed reveal">
                    <div class="cyber-grid"></div>
                    <div class="cyber-line"></div>

                    @foreach($experiences as $exp)
                        <div class="cyber-entry {{ $exp->is_current ? 'live' : '' }} reveal">
                            <div class="cyber-node">
                                <i class="bi {{ $exp->is_current ? 'bi-shield-fill-check' : 'bi-shield-fill' }}"></i>
                            </div>
                            <div class="cyber-card">
                                <div class="cyber-card-top">
                                    <span class="cyber-date"><i class="bi bi-calendar3 me-1"></i>{{ $exp->duration }}</span>
                                    @if($exp->is_current)
                                        <span class="cyber-status live"><span class="cyber-pulse"></span>{{ __('messages.current') }}</span>
                                    @else
                                        <span class="cyber-status"><i class="bi bi-check2-circle me-1"></i>Closed</span>
                                    @endif
                                </div>
                                <h3>{{ $exp->position }}</h3>
                                <div class="cyber-company">
                                    <i class="bi bi-building me-1"></i>{{ $exp->company }}
                                    @if($exp->location)
                                        <span class="cyber-location"><i class="bi bi-geo-alt me-1"></i>{{ $exp->location }}</span>
                                    @endif
                                </div>
                                @if($exp->description)
                                    <p>{{ $exp->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-briefcase"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_experience') }}</p>
                    <p>{{ __('messages.no_experience_desc') }}</p>
                </div>
            @endif
        </div>
        <div class="section-divider"></div>
    </section>

    <!-- Education Qualification Section -->
    <section class="section-padding" id="education"
        style="background: linear-gradient(180deg, var(--bg-secondary) 0%, #080b12 100%);">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.education_title') }}</h2>
                <p>{{ __('messages.education_subtitle') }}</p>
            </div>

            @if($educations->isNotEmpty())
                <div class="row g-4 justify-content-center reveal">
                    @foreach($educations as $edu)
                        <div class="col-lg-6 col-12">
                            <div class="edu-card" style="height: 100%;">
                                <span class="edu-hud"></span>
                                <span class="edu-hud br"></span>
                                <div class="edu-scanline"></div>
                                <div class="edu-bar"></div>
                                <div class="p-4">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="edu-icon-wrap">
                                            <div class="edu-icon">
                                                <i class="bi bi-mortarboard-fill"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1" style="min-width:0;">
                                            <div class="edu-top">
                                                <span class="edu-duration">
                                                    <i class="bi bi-calendar3 me-1"></i>{{ $edu->duration }}
                                                </span>
                                                <span class="edu-verify"><span class="edu-pulse"></span><i class="bi bi-shield-check"></i> Verified</span>
                                            </div>
                                            <h3 class="edu-degree">{{ $edu->degree_name }}</h3>
                                            <div class="edu-meta">
                                                <span><i class="bi bi-building me-1"></i>{{ $edu->institution }}</span>
                                                @if($edu->board_or_university)
                                                    <span class="edu-board"><i class="bi bi-globe me-1"></i>{{ $edu->board_or_university }}</span>
                                                @endif
                                            </div>
                                            @if($edu->result)
                                                <div class="edu-result">
                                                    <i class="bi bi-award"></i>
                                                    <span>{{ $edu->result }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-mortarboard"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_education') }}</p>
                    <p>{{ __('messages.no_education_desc') }}</p>
                </div>
            @endif
        </div>
        <div class="section-divider"></div>
    </section>

    <style>
    .edu-card {
        background: rgba(255,255,255,0.04) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(0,217,255,0.15) !important;
        position: relative;
        overflow: hidden;
    }
    html.light-theme .edu-card {
        background: rgba(255,255,255,0.8) !important;
        border-color: rgba(0,217,255,0.22) !important;
    }
    .edu-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(0,217,255,0.5) 0%, rgba(0,217,255,0.15) 30%, transparent 60%);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.5s ease;
        z-index: 1;
        border-radius: inherit;
    }
    html.light-theme .edu-card::before {
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(0,217,255,0.35) 0%, rgba(0,217,255,0.1) 30%, transparent 60%);
    }
    .edu-card:hover::before { opacity: 1; }
    .edu-card:hover {
        transform: translateY(-8px);
        border-color: rgba(0,217,255,0.45) !important;
        box-shadow: 0 0 32px rgba(0,217,255,0.28), var(--shadow-md);
    }
    html.light-theme .edu-card:hover {
        box-shadow: 0 0 30px rgba(0,217,255,0.15), var(--shadow-md);
    }
    /* HUD corner brackets */
    .edu-hud {
        position: absolute; top: 12px; left: 12px;
        width: 15px; height: 15px;
        pointer-events: none; z-index: 2;
        opacity: 0.9;
    }
    .edu-hud::before {
        content: ''; position: absolute; top: 0; left: 0;
        width: 15px; height: 2px;
        background: #00d9ff; box-shadow: 0 0 8px rgba(0,217,255,0.6);
    }
    .edu-hud::after {
        content: ''; position: absolute; top: 0; left: 0;
        width: 2px; height: 15px;
        background: #00d9ff; box-shadow: 0 0 8px rgba(0,217,255,0.6);
    }
    .edu-hud.br {
        top: auto; bottom: 12px; left: auto; right: 12px;
        transform: rotate(180deg);
        animation: eduHudBlink 2.6s ease-in-out infinite;
    }
    html.light-theme .edu-hud::before, html.light-theme .edu-hud::after { background: #0891b2; box-shadow: 0 0 8px rgba(8, 145, 178, 0.5); }
    @keyframes eduHudBlink { 0%, 100% { opacity: 1; } 50% { opacity: 0.45; } }

    /* Continuous scan sweep */
    .edu-scanline {
        position: absolute; top: 0; width: 60%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(0, 217, 255, 0.08), transparent);
        transform: skewX(-20deg);
        animation: eduScan 3.1s linear infinite;
        z-index: 1; pointer-events: none; filter: blur(1px);
    }
    html.light-theme .edu-scanline { background: linear-gradient(90deg, transparent, rgba(0, 217, 255, 0.14), transparent); }
    @keyframes eduScan { 0% { left: -75%; } 100% { left: 135%; } }

    .edu-bar {
        height: 4px;
        background: linear-gradient(90deg, transparent, #00d9ff, #00ff88, #00d9ff, transparent);
        background-size: 200% 100%;
        animation: eduShimmer 3s ease-in-out infinite;
    }
    .edu-icon-wrap { position: relative; width: 52px; height: 52px; flex-shrink: 0; }
    .edu-icon-wrap::after {
        content: ''; position: absolute; inset: -6px;
        border-radius: 18px;
        border: 1px solid rgba(0, 217, 255, 0.3);
        animation: cyberRadar 2.4s ease-out infinite;
    }
    .edu-icon {
        width: 100%; height: 100%;
        border-radius: 14px;
        background: linear-gradient(135deg, rgba(0, 217, 255, 0.16), rgba(0, 255, 136, 0.08));
        border: 1px solid rgba(0, 217, 255, 0.45);
        box-shadow: 0 0 18px rgba(0, 217, 255, 0.2);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; color: #00d9ff;
        position: relative; z-index: 1;
        transition: all 0.4s ease;
    }
    .edu-card:hover .edu-icon {
        transform: rotate(-6deg) scale(1.06);
        box-shadow: 0 0 26px rgba(0, 217, 255, 0.4);
    }
    .edu-top {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 0.4rem; margin-bottom: 0.4rem;
    }
    .edu-duration {
        display: inline-flex; align-items: center;
        font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: 0.72rem; color: var(--accent-light); font-weight: 600;
        background: rgba(0, 217, 255, 0.08);
        border: 1px solid rgba(0, 217, 255, 0.16);
        padding: 0.2rem 0.7rem; border-radius: 6px;
    }
    .edu-duration::before { content: '$'; color: #00ff88; font-weight: 700; margin-right: 0.3rem; }
    html.light-theme .edu-duration::before { color: #059669; }
    .edu-verify {
        display: inline-flex; align-items: center; gap: 0.35rem;
        font-family: 'JetBrains Mono', Consolas, monospace;
        text-transform: uppercase; letter-spacing: 0.07em;
        font-size: 0.58rem; font-weight: 700;
        color: #00ff88;
        background: rgba(0, 255, 136, 0.09);
        border: 1px solid rgba(0, 255, 136, 0.3);
        padding: 0.24rem 0.6rem; border-radius: 6px;
    }
    html.light-theme .edu-verify { color: #059669; background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.3); }
    .edu-pulse {
        width: 6px; height: 6px; border-radius: 50%;
        background: #00ff88; box-shadow: 0 0 7px #00ff88;
        animation: cyberBlink 1.2s steps(2, start) infinite;
    }
    html.light-theme .edu-pulse { background: #059669; box-shadow: 0 0 7px rgba(16, 185, 129, 0.5); }

    .edu-degree {
        font-size: 1.1rem; font-weight: 700;
        margin-bottom: 0.15rem; color: var(--text-primary);
    }
    .edu-meta {
        font-size: 0.88rem; color: var(--text-secondary);
        margin-bottom: 0.6rem;
        display: flex; flex-wrap: wrap; align-items: center;
        gap: 0.3rem 1rem;
    }
    .edu-meta i { color: #00d9ff; }
    .edu-board { font-size: 0.82rem; color: var(--text-muted); }
    .edu-result {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-family: 'JetBrains Mono', Consolas, monospace;
        font-size: 0.8rem; color: #fbbf24; font-weight: 600;
        background: rgba(245, 158, 11, 0.1);
        border: 1px solid rgba(245, 158, 11, 0.28);
        padding: 0.25rem 0.85rem; border-radius: 6px;
    }
    @keyframes eduShimmer {
        0%, 100% { background-position: 200% 50%; }
        50% { background-position: 0% 50%; }
    }
    html.light-theme #education {
        background: linear-gradient(180deg, #eef2f7 0%, #f1f5f9 100%) !important;
    }
    html.light-theme .edu-duration {
        color: #0e7490;
        background: rgba(8, 145, 178, 0.08);
        border-color: rgba(8, 145, 178, 0.2);
    }
    html.light-theme .edu-icon {
        background: linear-gradient(135deg, rgba(8, 145, 178, 0.14), rgba(5, 150, 105, 0.08));
        border-color: rgba(8, 145, 178, 0.4);
        box-shadow: 0 0 16px rgba(8, 145, 178, 0.18);
        color: #0e7490;
    }
    html.light-theme .edu-card:hover .edu-icon { box-shadow: 0 0 22px rgba(8, 145, 178, 0.3); }
    html.light-theme .edu-icon-wrap::after { border-color: rgba(8, 145, 178, 0.3); }
    html.light-theme .edu-meta i { color: #0e7490; }
    html.light-theme .edu-board { color: #64748b; }
    html.light-theme .edu-result {
        color: #b45309;
        background: rgba(245, 158, 11, 0.1);
        border-color: rgba(245, 158, 11, 0.3);
    }
    html.light-theme .edu-bar {
        background: linear-gradient(90deg, transparent, #0891b2, #059669, #0891b2, transparent);
    }
    html.light-theme .edu-scanline {
        background: linear-gradient(90deg, transparent, rgba(8, 145, 178, 0.12), transparent);
    }
    html.light-theme .edu-card { border-color: rgba(8, 145, 178, 0.2) !important; }
    html.light-theme .edu-card:hover { border-color: rgba(8, 145, 178, 0.45) !important; }
    @media (max-width: 768px) {
        .edu-degree { font-size: 0.95rem !important; }
        .edu-icon-wrap { width: 42px !important; height: 42px !important; }
        .edu-icon { font-size: 1.1rem !important; }
        .edu-card .p-4 { padding: 1rem !important; }
    }
    </style>

    <!-- Skills Section -->
    <section class="skills-section section-padding" id="skills">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.skills_title') }}</h2>
                <p>{{ __('messages.skills_subtitle') }}</p>
            </div>

            @if($skills->isNotEmpty())
                <div class="skills-radar" aria-hidden="true">
                    <div class="r-ring"></div><div class="r-ring"></div><div class="r-ring"></div>
                    <div class="r-line"></div><div class="r-line"></div><div class="r-line"></div>
                </div>
                <div class="skills-wrapper">
                    <div class="skills-grid">
                        @foreach($skills as $index => $skill)
                            <div class="skill-card" data-skill-index="{{ $index }}">
                                <div class="sk-scan"></div>
                                <div class="cyber-particles"></div>
                                <span class="sk-icon"><i class="bi {{ $skill->icon ?: 'bi-shield-lock' }}"></i></span>
                                <div class="sk-info">
                                    <span class="skill-name">{{ $skill->name }}</span>
                                    <div class="sk-bar"><span class="sk-bar-fill" data-width="{{ $skill->percentage }}"></span></div>
                                </div>
                                <span class="skill-percent">{{ $skill->percentage }}%</span>
                            </div>
                        @endforeach
                        @foreach($skills as $index => $skill)
                            <div class="skill-card" data-skill-index="{{ $index }}">
                                <div class="sk-scan"></div>
                                <div class="cyber-particles"></div>
                                <span class="sk-icon"><i class="bi {{ $skill->icon ?: 'bi-shield-lock' }}"></i></span>
                                <div class="sk-info">
                                    <span class="skill-name">{{ $skill->name }}</span>
                                    <div class="sk-bar"><span class="sk-bar-fill" data-width="{{ $skill->percentage }}"></span></div>
                                </div>
                                <span class="skill-percent">{{ $skill->percentage }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-shield-lock"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_skills') }}</p>
                    <p>{{ __('messages.no_skills_desc') }}</p>
                </div>
            @endif
        </div>
        <div class="section-divider"></div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section section-padding" id="testimonials">
        <div class="container">                            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.testimonials_title') }}</h2>
                <p>{{ __('messages.testimonials_subtitle') }}</p>
            </div>

            @if($testimonials->isNotEmpty())
                <div class="testimonials-section-wrap">
                    <div class="tm-radar"></div>
                    <div class="tm-particle" style="left:4%; animation-duration:7s; animation-delay:0s;">0101</div>
                    <div class="tm-particle" style="left:12%; animation-duration:9s; animation-delay:1.2s;">110</div>
                    <div class="tm-particle" style="left:86%; animation-duration:8s; animation-delay:0.6s;">0110</div>
                    <div class="tm-particle" style="left:94%; animation-duration:7.5s; animation-delay:2s;">101</div>
                </div>
                <div class="testimonial-carousel reveal">
                    <div class="testimonial-track" id="testimonialTrack">
                        @foreach($testimonials as $testimonial)
                            <div class="testimonial-card">
                                <div class="tm-cyber"></div>
                                <span class="tm-corner tl"></span>
                                <span class="tm-corner tr"></span>
                                <span class="tm-corner bl"></span>
                                <span class="tm-corner br"></span>
                                <div class="tm-topbar"></div>
                                <span class="tm-status"><span class="tm-dot"></span> Verified Review</span>
                                <div class="quote-icon"><i class="bi bi-quote"></i></div>
                                <div class="testimonial-stars">
                                    @foreach($testimonial->stars as $filled)
                                        <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                                    @endforeach
                                </div>
                                <p class="testimonial-text">"{{ $testimonial->message }}"</p>
                                <div class="testimonial-author">
                                    <div class="author-avatar">
                                        @if($testimonial->avatar)
                                            <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                                                 alt="{{ $testimonial->name }}">
                                        @else
                                            <div class="avatar-fallback">
                                                {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="author-info">
                                        <div class="author-name">{{ $testimonial->name }}</div>
                                        <div class="author-designation">{{ $testimonial->designation_display }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="carousel-controls">
                        <button class="carousel-btn carousel-prev" id="testPrev" aria-label="Previous">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <div class="carousel-dots" id="testDots"></div>
                        <button class="carousel-btn carousel-next" id="testNext" aria-label="Next">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-chat-quote"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_testimonials') }}</p>
                    <p>{{ __('messages.no_testimonials_desc') }}</p>
                </div>
            @endif
        </div>
        <div class="section-divider"></div>
    </section>

        <!-- Contact Section — REDESIGNED MODERN -->
    <section class="contact-section section-padding" id="contact">
        <div class="contact-bg-grid"></div>
        <div class="contact-radar"></div>
        <div class="contact-particle" style="left:8%; top:28%; animation-duration:8s;">0110</div>
        <div class="contact-particle" style="left:44%; top:12%; animation-duration:7s; animation-delay:1s;">101</div>
        <div class="contact-particle" style="left:90%; top:22%; animation-duration:9s; animation-delay:0.4s;">1101</div>
        <div class="contact-particle" style="left:6%; top:70%; animation-duration:9.5s; animation-delay:1.6s;">1001</div>
        <div class="contact-particle" style="left:85%; top:80%; animation-duration:7.5s; animation-delay:2s;">010</div>
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __("messages.contact_title") }}</h2>
                <p>{{ __("messages.contact_subtitle") }}</p>
            </div>

            <div class="contact-grid">
                <div class="contact-info-card reveal reveal-delay-1">
                    <span class="ct-corner tl"></span>
                    <span class="ct-corner tr"></span>
                    <span class="ct-corner bl"></span>
                    <span class="ct-corner br"></span>
                    <div class="ct-topbar"></div>
                    <span class="ct-status"><span class="ct-dot"></span> Secure Channel</span>
                    <h3><i class="bi bi-chat-dots-fill me-2"></i>{{ __("messages.contact_heading") }}</h3>
                    <p>{{ __("messages.contact_desc") }}</p>

                    <div class="contact-item">
                        <div class="icon-box"><i class="bi bi-envelope-fill"></i></div>
                        <div class="text">
                            <div class="label">{{ __("messages.email_label") }}</div>
                            <div class="value">{{ $account->email ?? "joty@example.com" }}</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="icon-box"><i class="bi bi-phone-fill"></i></div>
                        <div class="text">
                            <div class="label">{{ __("messages.phone_label") }}</div>
                            <div class="value">{{ $account->phone ?? "+880 1XXX-XXXXXX" }}</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="icon-box"><i class="bi bi-geo-alt-fill"></i></div>
                        <div class="text">
                            <div class="label">{{ __("messages.location_label") }}</div>
                            <div class="value">Bangladesh</div>
                        </div>
                    </div>

                    @if(isset($account) && ($account->github || $account->linkedin || $account->facebook || $account->instagram || $account->twitter || $account->youtube))
                        <div class="contact-social">
                            <div class="social-label"><i class="bi bi-share-fill me-1"></i> {{ __("messages.connect") }}</div>
                            <div class="social-row">
                                @if(isset($account) && $account->github)
                                    <a href="{{ $account->github }}" target="_blank" class="social-link" aria-label="GitHub"><i class="bi bi-github"></i></a>
                                @endif
                                @if(isset($account) && $account->linkedin)
                                    <a href="{{ $account->linkedin }}" target="_blank" class="social-link" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                @endif
                                @if(isset($account) && $account->facebook)
                                    <a href="{{ $account->facebook }}" target="_blank" class="social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if(isset($account) && $account->instagram)
                                    <a href="{{ $account->instagram }}" target="_blank" class="social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                                @endif
                                @if(isset($account) && $account->twitter)
                                    <a href="{{ $account->twitter }}" target="_blank" class="social-link" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                                @endif
                                @if(isset($account) && $account->youtube)
                                    <a href="{{ $account->youtube }}" target="_blank" class="social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>

                <div class="contact-form reveal reveal-delay-2">
                    <span class="ct-corner tl"></span>
                    <span class="ct-corner tr"></span>
                    <span class="ct-corner bl"></span>
                    <span class="ct-corner br"></span>
                    <div class="ct-topbar"></div>
                    <div class="form-header">
                        <span class="ct-status"><span class="ct-dot"></span> Encrypted Transmission</span>
                        <h4><i class="bi bi-pencil-square me-2"></i>{{ __("messages.send_message") }}</h4>
                        <p>{{ __("messages.contact_desc") }}</p>
                    </div>
                    <form action="{{ url("/contactus") }}" method="POST" id="contactForm">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="bi bi-person-fill me-1"></i> {{ __("messages.your_name") }}</label>
                            <div class="field-wrapper">
                                <input type="text" id="name" name="name" class="form-control" placeholder="{{ __("messages.name_placeholder") }}" required>
                                <span class="field-glow"></span>
                                <i class="bi bi-person field-icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="bi bi-envelope-fill me-1"></i> {{ __("messages.your_email") }}</label>
                            <div class="field-wrapper">
                                <input type="email" id="email" name="email" class="form-control" placeholder="{{ __("messages.email_placeholder") }}" required>
                                <span class="field-glow"></span>
                                <i class="bi bi-envelope field-icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message"><i class="bi bi-chat-text-fill me-1"></i> {{ __("messages.your_message") }}</label>
                            <div class="field-wrapper">
                                <textarea id="message" name="message" class="form-control" placeholder="{{ __("messages.message_placeholder") }}" rows="4" required></textarea>
                                <span class="field-glow"></span>
                                <i class="bi bi-chat-text field-icon"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn-submit">
                            <span class="btn-shimmer"></span>
                            <i class="bi bi-send-fill btn-icon"></i>
                            <span>{{ __("messages.send_message") }}</span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="map-wrapper reveal reveal-delay-1">
                <div class="map-container">
                    <span class="ct-corner tl"></span>
                    <span class="ct-corner tr"></span>
                    <span class="ct-corner bl"></span>
                    <span class="ct-corner br"></span>
                    <span class="ct-status map-status"><span class="ct-dot"></span> Live Location Feed</span>
                    <div class="map-scan"></div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3749427.7985686358!2d88.0190403004489!3d23.684993584973406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ada8e30e97f93d%3A0x8e70e7e2225e28a2!2sBangladesh!5e0!3m2!1sen!2sbd!4v1!4m2!3m1!1s0x30ada8e30e97f93d%3A0x8e70e7e2225e28a2"
                        width="100%" height="350" style="border:0; border-radius: 16px;"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Location Map">
                    </iframe>
                </div>
            </div>
        </div>
        <div class="section-divider"></div>
    </section><!-- FAQ Section -->
    <section class="faq-section section-padding" id="faq">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.faq_title') }}</h2>
                <p>{{ __('messages.faq_subtitle') }}</p>
            </div>

            @if($faqs->isNotEmpty())
                <div class="faq-list reveal" style="max-width: 800px; margin: 0 auto;">
                    @foreach($faqs as $index => $faq)
                        <div class="faq-item" data-faq-index="{{ $index }}">
                            <div class="faq-scanline"></div>
                            <button class="faq-question" onclick="toggleFaq(this)">
                                <span class="faq-qid">Q-{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</span>
                                <span class="faq-qtext">{{ $faq->question }}</span>
                                <span class="faq-chev"><i class="bi bi-chevron-down"></i></span>
                            </button>
                            <div class="faq-answer">
                                <p>{{ $faq->answer }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <script>
                function toggleFaq(btn) {
                    var item = btn.parentElement;
                    var answer = item.querySelector('.faq-answer');
                    var isOpen = item.classList.contains('open');

                    // Close all
                    document.querySelectorAll('.faq-item').forEach(function(el) {
                        el.classList.remove('open');
                        el.querySelector('.faq-answer').style.maxHeight = '0';
                        el.querySelector('.faq-answer').style.padding = '0 1.5rem';
                    });

                    if (!isOpen) {
                        item.classList.add('open');
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        answer.style.padding = '0 1.5rem 0';
                    }
                }
                </script>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-terminal"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_faqs') }}</p>
                    <p>{{ __('messages.no_faqs_desc') }}</p>
                </div>
            @endif
        </div>
        <div class="section-divider"></div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-cybergrid" aria-hidden="true"></div>
        <div class="footer-inner">
            <div class="ft-status">
                <span class="ft-dot"></span>
                <i class="bi bi-shield-lock"></i>
                <span>System Online</span>
            </div>
            <div class="footer-brand">
                <h4>{{ optional($account)->name ?? 'Portfolio' }}</h4>
                <p>{{ __('messages.copyright') }}</p>
            </div>
            <div class="footer-divider"></div>

            <div class="footer-links">
                <a href="#about">{{ __('messages.about') }}</a>
                <a href="#services">{{ __('messages.services') }}</a>
                <a href="#skills">{{ __('messages.skills') }}</a>
                <a href="#faq">FAQ</a>
                <a href="#contact">{{ __('messages.contact') }}</a>
            </div>

            <!-- Social Media Icons -->
            <div class="footer-social d-flex justify-content-center gap-2 flex-wrap" style="margin-bottom: 1.5rem;">
                @if(isset($account) && $account->github)
                    <a href="{{ $account->github }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="GitHub">
                        <i class="bi bi-github"></i>
                    </a>
                @endif
                @if(isset($account) && $account->linkedin)
                    <a href="{{ $account->linkedin }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                @endif
                @if(isset($account) && $account->facebook)
                    <a href="{{ $account->facebook }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                @endif
                @if(isset($account) && $account->instagram)
                    <a href="{{ $account->instagram }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                @endif
                @if(isset($account) && $account->twitter)
                    <a href="{{ $account->twitter }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Twitter">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                @endif
                @if(isset($account) && $account->youtube)
                    <a href="{{ $account->youtube }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                @endif
                @if(isset($account) && $account->fiverr)
                    <a href="{{ $account->fiverr }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Fiverr">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1.15em;height:1.15em;vertical-align:middle"><rect width="24" height="24" rx="5" fill="#1DBF73"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="14" font-family="Arial,sans-serif">f</text></svg>
                    </a>
                @endif
                @if(isset($account) && $account->upwork)
                    <a href="{{ $account->upwork }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Upwork">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1.15em;height:1.15em;vertical-align:middle"><rect width="24" height="24" rx="5" fill="#6FDA44"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="14" font-family="Arial,sans-serif">U</text></svg>
                    </a>
                @endif
                @if(isset($account) && $account->freelancer)
                    <a href="{{ $account->freelancer }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Freelancer">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1.15em;height:1.15em;vertical-align:middle"><rect width="24" height="24" rx="5" fill="#29B2FE"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="13" font-family="Arial,sans-serif">Fc</text></svg>
                    </a>
                @endif
            </div>

            <div class="footer-bottom">
                <p>© {{ date('Y') }} {{ optional($account)->name ?? 'Portfolio' }}. {{ __('messages.copyright') }}</p>
                <span style="color: #475569; font-size: 0.82rem;">{{ __('messages.made_with') }} <span class="heart">&hearts;</span></span>
                <span class="ft-seal"><i class="bi bi-shield-check"></i> Secured By 256-Bit</span>
                <a href="#" class="back-top"><i class="bi bi-arrow-up"></i> {{ __('messages.back_to_top') }}</a>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $account->phone ?? '8801XXXXXXXXX') }}"
       target="_blank" rel="noopener noreferrer"
       class="whatsapp-float" id="whatsappFloat" aria-label="{{ __('messages.chat_whatsapp') }}">
        <i class="bi bi-whatsapp"></i>
        <span class="whatsapp-tooltip">{{ __('messages.chat_whatsapp') }}</span>
    </a>



    <!-- Floating Admin Button (only for admin users) -->
    @auth
        @if(auth()->user()->is_admin == 1)
            <a href="{{ url('/admin') }}" class="admin-float-btn" aria-label="Admin Panel" title="Go to Admin Panel">
                <i class="bi bi-speedometer2"></i>
            </a>
        @endif
    @endauth

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Toast -->
    <div class="toast" id="toast">
        <i class="bi bi-check-circle-fill"></i> {{ __('messages.msg_sent') }}
    </div>

<script>
// ===== PARTICLES SYSTEM =====
(function() {
    const canvas = document.getElementById('particles-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let particles = [];
    let mouse = { x: 0, y: 0 };

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    class Particle {
        constructor() { this.reset(); }
        reset() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 2 + 0.5;
            this.speedX = (Math.random() - 0.5) * 0.4;
            this.speedY = (Math.random() - 0.5) * 0.4;
            this.opacity = Math.random() * 0.4 + 0.1;
        }
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            const dx = mouse.x - this.x;
            const dy = mouse.y - this.y;
            const dist = Math.sqrt(dx * dx + dy * dy);
            if (dist < 120) { this.x -= dx * 0.008; this.y -= dy * 0.008; }
            if (this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
        }
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(0, 217, 255, ' + this.opacity + ')';
            ctx.fill();
        }
    }

    function initParticles() {
        particles = [];
        var count = Math.min(80, Math.floor((canvas.width * canvas.height) / 15000));
        for (var i = 0; i < count; i++) particles.push(new Particle());
    }
    initParticles();

    function connectParticles() {
        for (var i = 0; i < particles.length; i++) {
            for (var j = i + 1; j < particles.length; j++) {
                var dx = particles[i].x - particles[j].x;
                var dy = particles[i].y - particles[j].y;
                var dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 150) {
                    ctx.beginPath();
                    ctx.strokeStyle = 'rgba(0, 217, 255, ' + (0.06 * (1 - dist / 150)) + ')';
                    ctx.lineWidth = 0.5;
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }
    }

    function animateParticles() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (var i = 0; i < particles.length; i++) { particles[i].update(); particles[i].draw(); }
        connectParticles();
        requestAnimationFrame(animateParticles);
    }
    animateParticles();

    document.addEventListener('mousemove', function(e) { mouse.x = e.clientX; mouse.y = e.clientY; });
})();

// ===== MATRIX BINARY RAIN (hero background) =====
(function() {
    var canvas = document.getElementById('matrixRain');
    var hero = document.getElementById('hero');
    if (!canvas || !hero || !canvas.getContext) return;
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var ctx = canvas.getContext('2d');
    var FONT = 16;
    var TRAIL = 14;
    var CHAR_SET = '01アイウエオカキクケコサシスセソタチツテトナニヌネノ0123456789';
    var streams = [];
    var lastTime = 0;

    function inLightTheme() {
        return document.documentElement.classList.contains('light-theme');
    }

    function randomGlyph() {
        return CHAR_SET.charAt(Math.floor(Math.random() * CHAR_SET.length));
    }

    function sizeCanvas() {
        var dpr = Math.min(window.devicePixelRatio || 1, 2);
        canvas.width = Math.max(1, Math.floor(hero.clientWidth * dpr));
        canvas.height = Math.max(1, Math.floor(hero.clientHeight * dpr));
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }

    function resetStream(s) {
        s.pos = -(Math.random() * hero.clientHeight * 0.9 + FONT * 2);
        s.headRow = Math.floor(s.pos / FONT);
        s.glyphs = [];
        s.speed = FONT * (0.04 + Math.random() * 0.08); // px per ms (~4-11 rows/sec)
    }

    function initStreams() {
        var count = Math.max(1, Math.floor(hero.clientWidth / FONT));
        streams = [];
        for (var i = 0; i < count; i++) {
            var s = { x: i * FONT };
            resetStream(s);
            streams.push(s);
        }
    }

    function draw(t) {
        requestAnimationFrame(draw);
        if (!lastTime) lastTime = t;
        var dt = Math.min(t - lastTime, 50);
        lastTime = t;
        if (dt <= 0) return;

        var h = hero.clientHeight;
        var bottomLimit = h + TRAIL * FONT;
        ctx.clearRect(0, 0, hero.clientWidth, h);
        ctx.font = FONT + 'px "JetBrains Mono", Consolas, monospace';
        ctx.textBaseline = 'alphabetic';

        for (var i = 0; i < streams.length; i++) {
            var s = streams[i];
            s.pos += s.speed * dt;
            var row = Math.floor(s.pos / FONT);

            if (row > s.headRow) {
                for (var k = 0; k < row - s.headRow && k < TRAIL; k++) {
                    s.glyphs.push(randomGlyph());
                }
                s.headRow = row;
                if (s.glyphs.length > TRAIL) {
                    s.glyphs = s.glyphs.slice(s.glyphs.length - TRAIL);
                }
            }

            var startRow = s.headRow - s.glyphs.length + 1;
            var light = inLightTheme();
            for (var j = 0; j < s.glyphs.length; j++) {
                var y = (startRow + j) * FONT;
                if (y < -FONT || y > h) continue;
                var distFromHead = s.glyphs.length - 1 - j;
                if (distFromHead === 0) {
                    ctx.fillStyle = light ? 'rgb(4, 120, 110)' : 'rgba(180, 255, 210, 0.9)';
                } else {
                    var a = Math.pow(1 - distFromHead / TRAIL, 1.6);
                    ctx.fillStyle = light
                        ? 'rgba(13, 148, 136, ' + a.toFixed(3) + ')'
                        : 'rgba(0, 255, 136, ' + (a * 0.65).toFixed(3) + ')';
                }
                ctx.fillText(s.glyphs[j], s.x, y + FONT - 3);
            }

            if (s.pos > bottomLimit) resetStream(s);
        }
    }

    sizeCanvas();
    initStreams();
    window.addEventListener('load', function() {
        sizeCanvas();
        initStreams();
    });
    window.addEventListener('resize', function() {
        sizeCanvas();
        initStreams();
    });
    requestAnimationFrame(draw);
})();

// ===== CURSOR GLOW =====
(function() {
    var glow = document.getElementById('cursorGlow');
    if (!glow) return;
    document.addEventListener('mousemove', function(e) {
        glow.style.left = e.clientX + 'px';
        glow.style.top = e.clientY + 'px';
    });
    document.querySelectorAll('a, button, .magnetic, .gig-card, .skill-card, .social-link, .btn-primary-custom, .btn-outline-custom, .freelance-btn').forEach(function(el) {
        el.addEventListener('mouseenter', function() { glow.classList.add('active'); });
        el.addEventListener('mouseleave', function() { glow.classList.remove('active'); });
    });
})();

// ===== MOBILE MENU =====
(function() {
    var hamburger = document.getElementById('hamburger');
    var navLinks = document.getElementById('navLinks');
    if (!hamburger || !navLinks) return;
    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('active');
        navLinks.classList.toggle('open');
    });
    navLinks.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', function() {
            hamburger.classList.remove('active');
            navLinks.classList.remove('open');
        });
    });
})();


// ===== SERVICE WAVE WATER RIPPLE (mouse-responsive) =====
(function() {
    var scenes = document.querySelectorAll('.wave-scene');
    if (!scenes.length) return;
    [].forEach.call(scenes, function(scene) {
        var ripple = scene.querySelector('.wave-ripple');
        if (!ripple) return;
        scene.addEventListener('mousemove', function(e) {
            var rect = scene.getBoundingClientRect();
            var x = ((e.clientX - rect.left) / rect.width) * 100;
            var y = ((e.clientY - rect.top) / rect.height) * 100;
            ripple.style.background = 'radial-gradient(circle at ' + x + '% ' + y + '%, rgba(0, 217, 255, 0.15), transparent 60%)';
        });
        scene.addEventListener('mouseleave', function() {
            ripple.style.background = 'radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.08), transparent 60%)';
        });
    });
})();
// ===== COALESCED SCROLL HANDLER (passive + rAF throttled) =====
(function() {
    var navbar = document.getElementById('navbar');
    var adminFloat = document.querySelector('.admin-float-btn');
    var progressBar = document.getElementById('scrollProgress');
    var revealElements = document.querySelectorAll('.reveal');
    var statNumbers = document.querySelectorAll('.stat-item .number');
    var ticking = false;

    function onScroll() {
        var scrollY = window.scrollY;
        var winHeight = window.innerHeight;
        var docHeight = document.documentElement.scrollHeight - winHeight;
        
        // Navbar
        if (navbar) {
            if (scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        }
        
        // Admin float
        if (adminFloat) {
            if (scrollY > 300) adminFloat.classList.add('visible');
            else adminFloat.classList.remove('visible');
        }
        
        // Scroll progress bar
        if (progressBar && docHeight > 0) {
            progressBar.style.width = Math.min((scrollY / docHeight) * 100, 100) + '%';
        }
        
        // Scroll reveal + counters (run both in same pass)
        [].forEach.call(revealElements, function(el) {
            if (el.getBoundingClientRect().top < winHeight - 80) el.classList.add('active');
        });
        [].forEach.call(statNumbers, function(el) {
            if (el.dataset.animated) return;
            if (el.getBoundingClientRect().top < winHeight) {
                el.dataset.animated = 'true';
                var target = parseInt(el.getAttribute('data-count'));
                var count = 0;
                var step = Math.ceil(target / 60);
                var interval = setInterval(function() {
                    count += step;
                    if (count >= target) { count = target; clearInterval(interval); }
                    el.textContent = count + '+';
                }, 30);
            }
        });
        // Skill bar animation
        [].forEach.call(document.querySelectorAll('.sk-bar-fill'), function(bar) {
            if (bar.dataset.animated) return;
            if (bar.getBoundingClientRect().top < winHeight - 80) {
                bar.dataset.animated = 'true';
                bar.style.width = bar.getAttribute('data-width') + '%';
            }
        });
    }

    // rAF-coalesced scroll for zero layout thrashing
    function scrollHandler() {
        if (!ticking) {
            requestAnimationFrame(function() {
                onScroll();
                ticking = false;
            });
            ticking = true;
        }
    }

    window.addEventListener('scroll', scrollHandler, { passive: true });
    window.addEventListener('load', onScroll);
    window.addEventListener('resize', onScroll);
})();

// ===== SMOOTH ANCHOR SCROLL =====
(function() {
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var href = this.getAttribute('href');
            if (href === '#') { e.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' }); return; }
            e.preventDefault();
            var target = document.querySelector(href);
            if (target) {
                var pos = target.getBoundingClientRect().top + window.scrollY - 80;
                window.scrollTo({ top: pos, behavior: 'smooth' });
            }
        });
    });
})();


// ===== MAGNETIC BUTTON EFFECT =====
(function() {
    document.querySelectorAll('.magnetic').forEach(function(btn) {
        btn.addEventListener('mousemove', function(e) {
            var rect = btn.getBoundingClientRect();
            var x = e.clientX - rect.left - rect.width/2;
            var y = e.clientY - rect.top - rect.height/2;
            btn.style.transform = 'translate(' + (x*0.2) + 'px, ' + (y*0.2) + 'px)';
        });
        btn.addEventListener('mouseleave', function() { btn.style.transform = 'translate(0, 0)'; });
    });
})();

// ===== TESTIMONIAL CAROUSEL =====
(function() {
    var track = document.getElementById('testimonialTrack');
    var dotsContainer = document.getElementById('testDots');
    var prevBtn = document.getElementById('testPrev');
    var nextBtn = document.getElementById('testNext');
    if (!track) return;
    var cards = track.querySelectorAll('.testimonial-card');
    var total = cards.length;
    if (total <= 1) return;
    var currentIndex = 0;
    var autoInterval;

    for (var i = 0; i < total; i++) {
        var dot = document.createElement('span');
        dot.className = 'dot' + (i === 0 ? ' active' : '');
        (function(idx) { dot.addEventListener('click', function() { goToSlide(idx); }); })(i);
        dotsContainer.appendChild(dot);
    }

    function goToSlide(index) {
        currentIndex = index;
        track.style.transform = 'translateX(-' + (index * 100) + '%)';
        dotsContainer.querySelectorAll('.dot').forEach(function(d, i) { d.classList.toggle('active', i === index); });
    }
    function startAutoPlay() { autoInterval = setInterval(function() { goToSlide(currentIndex === total - 1 ? 0 : currentIndex + 1); }, 5000); }
    function stopAutoPlay() { clearInterval(autoInterval); }

    prevBtn.addEventListener('click', function() { stopAutoPlay(); goToSlide(currentIndex === 0 ? total - 1 : currentIndex - 1); startAutoPlay(); });
    nextBtn.addEventListener('click', function() { stopAutoPlay(); goToSlide(currentIndex === total - 1 ? 0 : currentIndex + 1); startAutoPlay(); });

    var carousel = document.querySelector('.testimonial-carousel');
    carousel.addEventListener('mouseenter', stopAutoPlay);
    carousel.addEventListener('mouseleave', startAutoPlay);
    startAutoPlay();
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') prevBtn.click();
        if (e.key === 'ArrowRight') nextBtn.click();
    });
})();

// ===== CYBER PARTICLES FOR SKILL CARDS =====
(function() {
    var binaryChars = ['0', '1', '01', '10', '11', '0x', 'FF', 'A3', '>>', '<<', '##', '@@'];
    document.querySelectorAll('.skill-card').forEach(function(card) {
        var container = card.querySelector('.cyber-particles');
        if (!container) return;
        var spawned = false;
        card.addEventListener('mouseenter', function() {
            if (spawned) return;
            spawned = true;
            for (var i = 0; i < 8; i++) {
                var span = document.createElement('span');
                span.className = 'cyber-particle';
                span.textContent = binaryChars[Math.floor(Math.random() * binaryChars.length)];
                span.style.left = Math.random() * 90 + '%';
                span.style.animationDuration = (1.5 + Math.random() * 2) + 's';
                span.style.animationDelay = (Math.random() * 1.5) + 's';
                container.appendChild(span);
            }
        });
        card.addEventListener('mouseleave', function() {
            spawned = false;
            container.innerHTML = '';
        });
    });
})();

// ===== CONTACT FORM AJAX =====
(function() {
    var form = document.getElementById('contactForm');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(form);
        var btn = form.querySelector('.btn-submit');
        var origText = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';
        btn.disabled = true;

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async function(response) {
            if (!response.ok) { var err = await response.json(); throw err; }
            return response.text();
        })
        .then(function() {
            var toast = document.getElementById('toast');
            if (toast) { toast.classList.add('show'); setTimeout(function() { toast.classList.remove('show'); }, 3000); }
            form.reset();
        })
        .catch(function(error) { console.error('Error:', error); alert('Message send failed!'); })
        .finally(function() { btn.innerHTML = origText; btn.disabled = false; });
    });
})();

// ===== SCROLL PROGRESS BAR =====
(function() {
    var bar = document.getElementById('scrollProgress');
    if (!bar) return;
    window.addEventListener('scroll', function() {
        var scrollTop = window.scrollY;
        var docHeight = document.documentElement.scrollHeight - window.innerHeight;
        var progress = (scrollTop / docHeight) * 100;
        bar.style.width = progress + '%';
    });
})();

// ===== CYBER SKILLS: RADAR SWEEP + PROGRESS FILL ON SCROLL =====
(function() {
    var section = document.querySelector('.skills-section');
    if (!section) return;
    var cards = Array.prototype.slice.call(document.querySelectorAll('.skills-grid .skill-card'));

    // Animate skill bars when section scrolls into view
    function fillProgress() {
        cards.forEach(function(card) {
            var bar = card.querySelector('.sk-bar-fill');
            if (!bar) return;
            var target = bar.getAttribute('data-width');
            if (bar.getAttribute('data-filled') !== '1') {
                bar.setAttribute('data-filled', '1');
                setTimeout(function() {
                    bar.style.width = target + '%';
                }, 60);
            }
        });
    }

    if (window.IntersectionObserver) {
        new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) fillProgress();
            });
        }, { threshold: 0.25 }).observe(section);
    } else {
        window.addEventListener('scroll', function() {
            var rect = section.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) fillProgress();
        });
    }

    // Immediate fill if already visible on load
    setTimeout(function() {
        var rect = section.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) fillProgress();
    }, 400);
})();

// ===== GLASS CARD SHINE EFFECT (all glass cards) =====
(function() {
    var selectors = '.cs-step, .cyber-card, .gig-card, .testimonial-card, .faq-item, .wave-service, .contact-info-card, .contact-item, .casestudy-card, .edu-card, .skill-card';
    document.querySelectorAll(selectors).forEach(function(card) {
        var rafId = null;
        card.addEventListener('mousemove', function(e) {
            if (rafId) return;
            var self = this;
            rafId = requestAnimationFrame(function() {
                var rect = self.getBoundingClientRect();
                var x = ((e.clientX - rect.left) / rect.width) * 100;
                var y = ((e.clientY - rect.top) / rect.height) * 100;
                self.style.setProperty('--shine-x', x + '%');
                self.style.setProperty('--shine-y', y + '%');
                rafId = null;
            });
        });
        card.addEventListener('mouseleave', function() {
            if (rafId) { cancelAnimationFrame(rafId); rafId = null; }
            this.style.setProperty('--shine-x', '50%');
            this.style.setProperty('--shine-y', '50%');
        });
    });
})();
</script>
@endsection

