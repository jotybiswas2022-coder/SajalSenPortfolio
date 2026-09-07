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
    html.light-theme .matrix-rain { opacity: 0.55; }
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
        background: rgba(0, 255, 136, 0.06);
        border-color: rgba(0, 255, 136, 0.2);
        color: #00b35c;
    }
    html.light-theme .hero-badge i { color: #00b35c; }
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

    html.light-theme .project-card {
        background: linear-gradient(145deg, #ffffff, #f8fafc) !important;
    }
    html.light-theme .timeline-card,
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
        top: 65%;
        left: 15%;
        width: 30%;
        transform: translateY(-50%) rotate(45deg);
        transform-origin: left center;
    }
    .cyber-ticker-right {
        top: 60%;
        right: 15%;
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
        .cyber-ticker-left { width: 26%; transform: translateY(-50%) rotate(-45deg); }
        .cyber-ticker-right { width: 26%; transform: translateY(-50%) rotate(45deg); }
        .cyber-ticker-item { padding: 0 1rem 0 0; margin-right: 0.4rem; }
        .cyber-ticker-item::after { right: -0.1rem; }
    }
    @media (max-width: 480px) {
        .cyber-ticker { font-size: 0.55rem; height: 20px; }
        .cyber-ticker-left { width: 22%; transform: translateY(-50%) rotate(-45deg); }
        .cyber-ticker-right { width: 22%; transform: translateY(-50%) rotate(45deg); }
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
    .float-chip { position: absolute; display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: rgba(0, 20, 10, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(0, 255, 136, 0.2); border-radius: 50px; font-size: 0.75rem; color: #00ff88; pointer-events: none; z-index: 1; white-space: nowrap; }
    .float-chip i { color: #00ff88; font-size: 0.8rem; }
    .float-chip.c1 { top: 15%; right: 5%; animation: floatChip 5s ease-in-out infinite; }
    .float-chip.c2 { bottom: 25%; left: 3%; animation: floatChip 6s ease-in-out infinite 1s; }
    .float-chip.c3 { top: 40%; left: 8%; animation: floatChip 4.5s ease-in-out infinite 0.5s; }
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
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
    .about-image { position: relative; display: flex; justify-content: center; align-items: center; }
    .about-name-highlight { color: var(--accent-light); font-weight: 700; }
    .about-image .img-wrapper {
        width: 320px; height: 320px; border-radius: 32px; overflow: hidden;
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
    .about-image .glow-ring {
        position: absolute; width: 340px; height: 340px;
        top: 50%; left: 50%; transform: translate(-50%, -50%);
        border-radius: 32px; border: 2px solid rgba(0, 217, 255, 0.15);
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

    /* ===== SERVICES — PURE WATER WAVE EFFECT (no boxes, no grid) ===== */
    .services-section {
        background: linear-gradient(180deg, #070d15 0%, #0a1420 40%, #0e1e2e 70%, #112436 100%);
        position: relative;
        overflow: hidden;
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

    /* Surface water wave at top of section */
    .services-section .water-surface {
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 50px;
        z-index: 1;
        pointer-events: none;
        overflow: hidden;
    }
    .services-section .water-surface .wave {
        position: absolute;
        top: -20px; left: -50%;
        width: 200%; height: 60px;
        border-radius: 45%;
    }
    .services-section .water-surface .wave:nth-child(1) {
        background: rgba(0, 217, 255, 0.06);
        animation: surfaceWave1 4s linear infinite alternate;
    }
    .services-section .water-surface .wave:nth-child(2) {
        background: rgba(0, 217, 255, 0.04);
        animation: surfaceWave2 6s linear infinite alternate;
    }
    @keyframes surfaceWave1 {
        0%   { transform: translateX(0) rotate(0deg); }
        100% { transform: translateX(-20%) rotate(5deg); }
    }
    @keyframes surfaceWave2 {
        0%   { transform: translateX(0) rotate(0deg); }
        100% { transform: translateX(15%) rotate(-3deg); }
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
        top: 15%;
        left: -50%;
        width: 200%;
        height: 70%;
        background: linear-gradient(90deg,
            transparent 0%, 
            rgba(30, 58, 95, 0.20) 20%,
            rgba(20, 50, 80, 0.30) 40%,
            rgba(30, 58, 95, 0.20) 60%,
            transparent 100%
        );
        border-radius: 40%;
        pointer-events: none;
        z-index: 0;
        animation: waveDeep 6s linear infinite alternate;
        will-change: transform;
    }
    /* Wave Layer 2 — mid, medium speed */
    .wave-scene::after {
        content: '';
        position: absolute;
        top: 25%;
        left: -50%;
        width: 200%;
        height: 60%;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 217, 255, 0.03) 15%,
            rgba(0, 217, 255, 0.08) 35%,
            rgba(0, 217, 255, 0.05) 55%,
            rgba(56, 189, 248, 0.03) 75%,
            transparent 100%
        );
        border-radius: 36%;
        pointer-events: none;
        z-index: 1;
        animation: waveMid 5s linear infinite alternate;
        will-change: transform;
    }

    /* Wave Layer 3 — foreground, faster */
    .wave-scene .wave-layer {
        position: absolute;
        top: 35%;
        left: -50%;
        width: 200%;
        height: 65%;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(6, 182, 212, 0.02) 10%,
            rgba(0, 217, 255, 0.06) 30%,
            rgba(0, 217, 255, 0.04) 50%,
            rgba(0, 217, 255, 0.06) 70%,
            transparent 100%
        );
        border-radius: 44%;
        pointer-events: none;
        z-index: 2;
        animation: waveFront 4s linear infinite alternate;
        will-change: transform;
    }

    /* Wave Layer 4 — very foreground, opposite direction */
    .wave-scene .wave-layer-2 {
        position: absolute;
        top: 45%;
        left: -50%;
        width: 200%;
        height: 75%;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 255, 136, 0.015) 20%,
            rgba(0, 217, 255, 0.04) 40%,
            rgba(56, 189, 248, 0.03) 60%,
            rgba(0, 217, 255, 0.04) 80%,
            transparent 100%
        );
        border-radius: 38%;
        pointer-events: none;
        z-index: 3;
        animation: waveFront2 7s linear infinite alternate;
        will-change: transform;
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

    /* Water surface shimmer — sweeps across the full scene */
    .wave-scene .wave-shimmer {
        position: absolute;
        top: 0; left: -100%; right: 0; bottom: 0;
        width: 300%;
        background: linear-gradient(90deg,
            transparent 0%,
            transparent 30%,
            rgba(255, 255, 255, 0.015) 45%,
            rgba(255, 255, 255, 0.03) 50%,
            rgba(255, 255, 255, 0.015) 55%,
            transparent 70%,
            transparent 100%
        );
        pointer-events: none;
        z-index: 4;
        animation: shimmerSweep 4s linear infinite;
        opacity: 0.5;
    }
    @keyframes shimmerSweep {
        0%   { transform: translateX(0); }
        100% { transform: translateX(33.33%); }
    }

    /* Mouse-responsive water ripple */
    .wave-scene .wave-ripple {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.04), transparent 60%);
        pointer-events: none;
        z-index: 5;
        opacity: 0;
        transition: opacity 0.6s ease;
    }
    .wave-scene:hover .wave-ripple {
        opacity: 1;
    }

    /* Floating bubbles rising through the water */
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
        border-radius: 50%;
        background: rgba(0, 217, 255, 0.12);
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
        flex: 0 1 280px;
        text-align: center;
        padding: 0;
        position: relative;
        cursor: default;
    }
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

    /* Bottom section waves */
    .services-section .bottom-waves {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 70px;
        z-index: 1;
        pointer-events: none;
        overflow: hidden;
    }
    .services-section .bottom-waves .wave {
        position: absolute;
        bottom: 0; left: -50%;
        width: 200%; height: 100%;
        border-radius: 45%;
    }
    .services-section .bottom-waves .wave:nth-child(1) {
        background: rgba(0, 217, 255, 0.05);
        animation: bottomWave1 5s linear infinite alternate;
    }
    .services-section .bottom-waves .wave:nth-child(2) {
        background: rgba(0, 217, 255, 0.04);
        animation: bottomWave2 7s linear infinite alternate;
    }
    .services-section .bottom-waves .wave:nth-child(3) {
        background: rgba(6, 182, 212, 0.03);
        animation: bottomWave3 4s linear infinite alternate;
    }
    @keyframes bottomWave1 {
        0%   { transform: translateX(0) rotate(0deg); opacity: 0.4; }
        100% { transform: translateX(-25%) rotate(4deg); opacity: 0.6; }
    }
    @keyframes bottomWave2 {
        0%   { transform: translateX(0) rotate(0deg); opacity: 0.3; }
        100% { transform: translateX(20%) rotate(-3deg); opacity: 0.5; }
    }
    @keyframes bottomWave3 {
        0%   { transform: translateX(0) rotate(0deg); opacity: 0.2; }
        100% { transform: translateX(-20%) rotate(5deg); opacity: 0.4; }
    }

    /* ---- Light theme ---- */
    html.light-theme .services-section::before {
        background:
            radial-gradient(ellipse at 20% 50%, rgba(0, 217, 255, 0.04), transparent 50%),
            radial-gradient(ellipse at 80% 30%, rgba(56, 189, 248, 0.03), transparent 50%);
    }
    html.light-theme .wave-scene::before {
        background: linear-gradient(90deg,
            transparent 0%, 
            rgba(30, 58, 95, 0.10) 20%,
            rgba(20, 50, 80, 0.15) 40%,
            rgba(30, 58, 95, 0.10) 60%,
            transparent 100%
        );
    }
    html.light-theme .wave-scene::after {
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 217, 255, 0.04) 15%,
            rgba(0, 217, 255, 0.10) 35%,
            rgba(0, 217, 255, 0.07) 55%,
            rgba(56, 189, 248, 0.04) 75%,
            transparent 100%
        );
    }
    html.light-theme .wave-scene .wave-layer {
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(6, 182, 212, 0.03) 10%,
            rgba(0, 217, 255, 0.08) 30%,
            rgba(0, 217, 255, 0.06) 50%,
            rgba(0, 217, 255, 0.08) 70%,
            transparent 100%
        );
    }
    html.light-theme .wave-scene .wave-layer-2 {
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(0, 255, 136, 0.02) 20%,
            rgba(0, 217, 255, 0.05) 40%,
            rgba(56, 189, 248, 0.04) 60%,
            rgba(0, 217, 255, 0.05) 80%,
            transparent 100%
        );
    }
    html.light-theme .wave-scene .wave-ripple {
        background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.04), transparent 60%);
    }
    html.light-theme .wave-scene .wave-bubbles .bub {
        background: rgba(0, 217, 255, 0.10);
    }
    html.light-theme .wave-service h3 {
        color: #111827;
        text-shadow: 0 2px 8px rgba(255, 255, 255, 0.5);
    }
    html.light-theme .wave-service p {
        color: #475569;
        text-shadow: 0 1px 4px rgba(255, 255, 255, 0.3);
    }
    html.light-theme .wave-service .ws-icon {
        background: rgba(255, 255, 255, 0.7);
        border-color: rgba(0, 217, 255, 0.15);
    }
    html.light-theme .wave-service:hover .ws-icon {
        background: var(--accent-gradient);
        border-color: transparent;
    }
    html.light-theme .services-section .water-surface .wave:nth-child(1) {
        background: rgba(0, 217, 255, 0.04);
    }
    html.light-theme .services-section .water-surface .wave:nth-child(2) {
        background: rgba(0, 217, 255, 0.03);
    }
    html.light-theme .services-section .bottom-waves .wave:nth-child(1) {
        background: rgba(0, 217, 255, 0.04);
    }
    html.light-theme .services-section .bottom-waves .wave:nth-child(2) {
        background: rgba(0, 217, 255, 0.03);
    }
    html.light-theme .services-section .bottom-waves .wave:nth-child(3) {
        background: rgba(6, 182, 212, 0.02);
    }

    /* ---- Mobile: grid cards ---- */
    @media (max-width: 768px) {
        .services-section .water-surface { height: 30px; }
        .services-section .water-surface .wave { height: 40px; }
        .services-section .bottom-waves { height: 40px; }
        .wave-scene { min-height: auto; padding: 1rem 0; }
        .wave-scene .wave-bubbles .bub { display: none; }
        .wave-scene .wave-shimmer { opacity: 0.3; }
        .wave-scene .wave-layer-2 { display: none; }
        .wave-services {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem; padding: 2rem 0;
        }
        .wave-service { flex: none; text-align: center; padding: 0; background: none; border: none; border-radius: 0; }
        .wave-service:hover .ws-icon { background: var(--accent-gradient); border-color: transparent; color: #fff; transform: scale(1.1) rotate(-4deg); box-shadow: 0 8px 25px rgba(0, 217, 255, 0.25); }
        .wave-service .ws-icon { width: 44px; height: 44px; font-size: 1.2rem; margin-bottom: 0.75rem; }
        .wave-service h3 { font-size: 0.95rem; margin-bottom: 0.4rem; }
        .wave-service p { font-size: 0.8rem; line-height: 1.5; }
    }
    @media (max-width: 480px) {
        .wave-services { grid-template-columns: 1fr; gap: 1.5rem; padding: 2rem 0.5rem; }
        .wave-service { padding: 0; background: none; border: none; }
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
    .casestudy-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; max-width: 1200px; margin: 0 auto; }
    .casestudy-card {
        position: relative;
        background: rgba(255,255,255,0.03);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(0,217,255,0.1);
        border-radius: 20px; overflow: hidden;
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none; display: block; cursor: pointer;
    }
    html.light-theme .casestudy-card {
        background: rgba(255,255,255,0.7);
        border-color: rgba(0,217,255,0.12);
    }
    .casestudy-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, transparent, #00d9ff, #00ff88, transparent);
        opacity: 0; transition: opacity 0.5s ease;
    }
    .casestudy-card:hover::before { opacity: 1; }
    .casestudy-card:hover {
        border-color: rgba(0,217,255,0.25);
        box-shadow: 0 20px 60px rgba(0,217,255,0.08), 0 8px 20px rgba(0,0,0,0.12);
        transform: translateY(-6px);
    }
    html.light-theme .casestudy-card:hover {
        box-shadow: 0 20px 60px rgba(0,217,255,0.1);
    }
    .casestudy-view-link { margin-top: 1rem; }
    .view-details-btn {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.85rem; font-weight: 600; color: var(--accent); text-decoration: none;
        padding: 0.4rem 1rem; border-radius: 10px;
        background: rgba(0,217,255,0.06); transition: all 0.3s ease;
    }
    .casestudy-card:hover .view-details-btn {
        background: rgba(0,217,255,0.12);
        gap: 0.7rem;
    }
    .view-details-btn i { font-size: 0.8rem; transition: transform 0.3s ease; }
    .casestudy-card:hover .view-details-btn i { transform: translateX(3px); }
    .casestudy-image { position: relative; width: 100%; height: 180px; overflow: hidden; }
    .casestudy-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1); }
    .casestudy-card:hover .casestudy-image img { transform: scale(1.06); }
    .casestudy-image::after {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0;
        height: 60%; background: linear-gradient(0deg, rgba(8,11,18,0.8) 0%, transparent 100%);
        pointer-events: none;
    }
    html.light-theme .casestudy-image::after {
        background: linear-gradient(0deg, rgba(248,250,252,0.8) 0%, transparent 100%);
    }
    .casestudy-category {
        position: absolute; top: 1rem; left: 1rem; z-index: 2;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        color: #fff; padding: 0.35rem 1.1rem;
        border-radius: 20px; font-size: 0.72rem; font-weight: 700;
        letter-spacing: 0.3px; box-shadow: 0 4px 15px rgba(0,217,255,0.3);
    }
    .casestudy-body { padding: 1.75rem 1.75rem 1.5rem; position: relative; z-index: 1; }
    .casestudy-body h3 { font-size: 1.3rem; font-weight: 800; margin-bottom: 0.2rem; letter-spacing: -0.3px; color: #fff; }
    html.light-theme .casestudy-body h3 { color: #111827; }
    .casestudy-client { font-size: 0.85rem; color: #94a3b8; margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.4rem; }
    html.light-theme .casestudy-client { color: #64748b; }


    /* ===== Glass Card Shine Effect ===== */
    .project-card::after,
    .gig-card::after,
    .testimonial-card::after,
    .faq-item::after,
    .wave-service::after,
    .contact-info-card::after,
    .contact-item::after,
    .casestudy-card::after {
        content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(0,217,255,0.45) 0%, rgba(0,217,255,0.18) 30%, transparent 60%);
        pointer-events: none; opacity: 0; transition: opacity 0.5s ease; z-index: 1; border-radius: inherit;
    }
    html.light-theme .project-card::after,
    html.light-theme .gig-card::after,
    html.light-theme .testimonial-card::after,
    html.light-theme .faq-item::after,
    html.light-theme .wave-service::after,
    html.light-theme .contact-info-card::after,
    html.light-theme .contact-item::after,
    html.light-theme .casestudy-card::after {
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(0,217,255,0.35) 0%, rgba(0,217,255,0.12) 30%, transparent 60%);
    }
    .project-card:hover::after,
    .gig-card:hover::after,
    .testimonial-card:hover::after,
    .faq-item:hover::after,
    .wave-service:hover::after,
    .contact-info-card:hover::after,
    .contact-item:hover::after,
    .casestudy-card:hover::after { opacity: 1; }
    /* Ensure content stays above shine */
    .project-card .card-image,
    .gig-card .gig-image,
    .gig-card .gig-body,
    .project-card .card-body,
    .testimonial-card .quote-icon,
    .testimonial-card .testimonial-stars,
    .testimonial-card .testimonial-text,
    .testimonial-card .testimonial-author,
    .faq-item button,
    .faq-item .faq-answer,
    .wave-service .ws-icon,
    .wave-service h3,
    .wave-service p,
    .contact-info-card h3,
    .contact-info-card p,
    .contact-info-card .contact-item,
    .contact-item .icon-box,
    .contact-item .info,
    .casestudy-card .casestudy-image,
    .casestudy-card .casestudy-body { position: relative; z-index: 2; }


    .casestudy-cta {
        text-align: center; margin-top: 3.5rem; padding: 2.5rem 2rem;
        background: linear-gradient(135deg, rgba(0,217,255,0.04), rgba(0,255,136,0.04));
        border: 1px solid rgba(0,217,255,0.1);
        border-radius: 20px; position: relative; overflow: hidden;
    }
    html.light-theme .casestudy-cta {
        background: linear-gradient(135deg, rgba(0,217,255,0.04), rgba(0,255,136,0.04));
    }
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
        .casestudy-body { padding: 1.25rem; }
    }

    /* Timeline section */
    .timeline-section { background: linear-gradient(180deg, var(--bg-primary) 0%, #080b12 100%); }
    html.light-theme .timeline-section { background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); }
    .timeline { position: relative; max-width: 900px; margin: 0 auto; padding: 1rem 0; }
    .timeline-line {
        position: absolute; left: 50%; top: 0; bottom: 0; width: 2px;
        background: linear-gradient(180deg, transparent, rgba(0,217,255,0.3), rgba(0,217,255,0.5), rgba(0,217,255,0.3), transparent);
        transform: translateX(-50%);
    }
    .timeline-item { position: relative; width: 50%; padding: 1.5rem 2.5rem; }
    .timeline-item.left { left: 0; text-align: right; padding-right: 3rem; }
    .timeline-item.right { left: 50%; text-align: left; padding-left: 3rem; }
    .timeline-dot {
        position: absolute; width: 46px; height: 46px;
        background: var(--accent-gradient); border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.1rem; z-index: 2;
        box-shadow: 0 0 20px rgba(0, 217, 255, 0.3);
        border: 3px solid var(--bg-primary);
    }
    .timeline-item.left .timeline-dot { right: -23px; top: 1.8rem; }
    .timeline-item.right .timeline-dot { left: -23px; top: 1.8rem; }
    .timeline-card {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: var(--radius-lg); padding: 1.5rem;
        transition: var(--transition); position: relative; overflow: hidden;
    }
    .timeline-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(0,217,255,0.5) 0%, rgba(0,217,255,0.2) 30%, transparent 60%);
        pointer-events: none; opacity: 0; transition: opacity 0.5s ease; z-index: 1; border-radius: inherit;
    }
    .timeline-card:hover::before { opacity: 1; }
    html.light-theme .timeline-card::before {
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(0,217,255,0.4) 0%, rgba(0,217,255,0.15) 30%, transparent 60%);
    }
    .timeline-card:hover {
        border-color: var(--border-hover); transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }
    .timeline-date {
        display: inline-flex; align-items: center; gap: 0.3rem;
        font-size: 0.78rem; color: var(--accent-light); font-weight: 600;
        background: rgba(0, 217, 255, 0.08);
        padding: 0.25rem 0.9rem; border-radius: 20px; margin-bottom: 0.6rem;
    }
    .current-badge {
        display: inline-block; font-size: 0.6rem; font-weight: 700;
        background: #10b981; color: #fff;
        padding: 0.2rem 0.6rem; border-radius: 20px;
        margin-left: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px;
    }
    .timeline-card h3 { font-size: 1.15rem; font-weight: 700; margin-bottom: 0.25rem; }
    .timeline-company { font-size: 0.88rem; color: var(--text-secondary); margin-bottom: 0.8rem; display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem; }
    .timeline-item.left .timeline-company { justify-content: flex-end; }
    .timeline-location { font-size: 0.82rem; color: var(--text-muted); }
    .timeline-card p { color: var(--text-secondary); font-size: 0.88rem; line-height: 1.7; margin-bottom: 0; }
    .timeline-item.left .timeline-card p { text-align: right; }
    @media (max-width: 768px) {
        .timeline-line { left: 28px; }
        .timeline-item { width: 100%; padding: 1rem 0 1rem 4rem !important; text-align: left !important; }
        .timeline-item.left { left: 0; padding-right: 0; }
        .timeline-item.right { left: 0; }
        .timeline-item .timeline-dot { left: 6px !important; right: auto !important; width: 38px; height: 38px; font-size: 0.9rem; top: 1.5rem; }
        .timeline-item.left .timeline-company { justify-content: flex-start; }
        .timeline-item.left .timeline-card p { text-align: left; }
        .timeline-card { padding: 1rem; }
        .timeline-card h3 { font-size: 0.95rem; }
        .timeline-company { font-size: 0.78rem; margin-bottom: 0.5rem; }
        .timeline-card p { font-size: 0.78rem; line-height: 1.6; }
        .timeline-date { font-size: 0.68rem; padding: 0.2rem 0.7rem; }
        .current-badge { font-size: 0.55rem; }
        .timeline-location { font-size: 0.72rem; }
    }

    /* Skills section */
    .skills-section { background: linear-gradient(180deg, #080b12 0%, var(--bg-secondary) 100%); }
    html.light-theme .skills-section { background: linear-gradient(180deg, #f1f5f9 0%, #eef2f7 100%); }
    .skills-wrapper {
    }
    .skills-grid {
        display: flex;
        gap: 1.5rem;
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
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: default;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-shrink: 0;
    }
    .skill-card .skill-circle {
        position: relative;
        width: 120px;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
        border-radius: 50%;
        background: transparent;
    }
    .skill-circle-svg {
        position: absolute;
        width: 100%;
        height: 100%;
        transform: rotate(-90deg);
    }
    .skill-circle-bg {
        fill: none;
        stroke: rgba(0, 217, 255, 0.1);
        stroke-width: 6;
    }
    .skill-circle-progress {
        fill: none;
        stroke: var(--accent-gradient);
        stroke-width: 6;
        stroke-linecap: round;
        transition: stroke-dashoffset 1.5s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .skill-card .skill-icon {
        font-size: 1.8rem;
        color: var(--accent-light);
        display: block;
        z-index: 2;
        transition: color 0.3s ease;
    }

    html.light-theme .skill-card .skill-icon {
        color: var(--accent);
    }
    .skill-card    .skill-percent {
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--text-muted);
        z-index: 2;
        display: block;
        line-height: 1;
    }
    html.light-theme .skill-card .skill-percent {
        color: var(--text-secondary);
    }
    .skill-card .skill-name {
        font-weight: 700;
        font-size: 0.88rem;
        color: var(--text-primary);
        display: block;
    }

    /* ===== Thunder and Lightning Effects ===== */
    .skill-card {
        position: relative;
    }

    /* Lightning bolt SVG */
    .skill-lightning {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 40px;
        height: 40px;
        z-index: 10;
        pointer-events: none;
        opacity: 0;
        transform-origin: center;
        transition: opacity 0.05s ease;
    }
    .skill-lightning.thunder-active {
        opacity: 1;
        animation: lightningBolt 0.6s ease-out forwards;
    }
    @keyframes lightningBolt {
        0%   { transform: scale(0.3) rotate(-20deg); opacity: 1; filter: brightness(2); }
        10%  { transform: scale(1.2) rotate(5deg); opacity: 1; filter: brightness(2.5); }
        20%  { transform: scale(0.9) rotate(-5deg); opacity: 0.9; filter: brightness(1.5); }
        35%  { transform: scale(1.1) rotate(2deg); opacity: 0.7; filter: brightness(1.2); }
        50%  { transform: scale(1) rotate(0deg); opacity: 0.6; filter: brightness(1); }
        100% { transform: scale(0.8) rotate(0deg); opacity: 0; }
    }

    /* Flash overlay on the skill circle */
    .skill-circle .thunder-flash {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(170, 215, 230, 0.9), rgba(0, 217, 255, 0.3), transparent 70%);
        z-index: 5;
        pointer-events: none;
        opacity: 0;
    }
    .skill-circle .thunder-flash.flash-active {
        opacity: 0;
        animation: thunderFlash 0.5s ease-out forwards;
    }
    @keyframes thunderFlash {
        0%   { opacity: 0.9; transform: scale(0.8); }
        10%  { opacity: 1; transform: scale(1.15); }
        25%  { opacity: 0.6; transform: scale(1.05); }
        50%  { opacity: 0.2; transform: scale(1); }
        100% { opacity: 0; transform: scale(0.95); }
    }

    /* Electric arc ring around the skill circle */
    .skill-circle .electric-ring {
        position: absolute;
        top: -4px; left: -4px; right: -4px; bottom: -4px;
        border-radius: 50%;
        border: 2px solid transparent;
        z-index: 4;
        pointer-events: none;
        opacity: 0;
        box-shadow: none;
    }
    .skill-circle .electric-ring.arc-active {
        opacity: 1;
        border-color: rgba(179, 240, 255, 0.6);
        box-shadow:
            0 0 8px 2px rgba(124, 230, 255, 0.6),
            0 0 20px 6px rgba(0, 217, 255, 0.3),
            inset 0 0 8px 2px rgba(124, 230, 255, 0.3);
        animation: electricArc 0.8s ease-out forwards;
    }
    @keyframes electricArc {
        0%   { opacity: 0; transform: scale(0.85) rotate(0deg); box-shadow: 0 0 0 0 rgba(124, 230, 255, 0); }
        15%  { opacity: 1; transform: scale(1.08) rotate(30deg); box-shadow: 0 0 12px 4px rgba(124, 230, 255, 0.8), 0 0 30px 10px rgba(0, 217, 255, 0.4), inset 0 0 12px 4px rgba(124, 230, 255, 0.4); }
        30%  { opacity: 0.8; transform: scale(1.02) rotate(60deg); box-shadow: 0 0 8px 2px rgba(124, 230, 255, 0.5), 0 0 20px 6px rgba(0, 217, 255, 0.3); }
        50%  { opacity: 0.5; transform: scale(1) rotate(90deg); box-shadow: 0 0 4px 1px rgba(124, 230, 255, 0.3); }
        100% { opacity: 0; transform: scale(0.95) rotate(120deg); box-shadow: 0 0 0 0 rgba(124, 230, 255, 0); }
    }

    /* Background thunder flash on the whole skills section */
    .skills-section.thunder-bg-flash {
        animation: sectionThunderFlash 0.6s ease-out;
    }
    @keyframes sectionThunderFlash {
        0%   { background: linear-gradient(180deg, #0a1420, #111827); }
        8%   { background: linear-gradient(180deg, rgba(170, 215, 230, 0.15) 0%, #111827 40%); }
        20%  { background: linear-gradient(180deg, rgba(170, 215, 230, 0.08) 0%, #111827 60%); }
        100% { background: linear-gradient(180deg, #080b12 0%, var(--bg-secondary) 100%); }
    }
    html.light-theme .skills-section.thunder-bg-flash {
        animation: sectionThunderFlashLight 0.6s ease-out;
    }
    @keyframes sectionThunderFlashLight {
        0%   { background: linear-gradient(180deg, #f1f5f9, #eef2f7); }
        8%   { background: linear-gradient(180deg, rgba(170, 215, 230, 0.3) 0%, #eef2f7 40%); }
        20%  { background: linear-gradient(180deg, rgba(170, 215, 230, 0.15) 0%, #eef2f7 60%); }
        100% { background: linear-gradient(180deg, #f1f5f9 0%, #eef2f7 100%); }
    }

    /* Skill card shake on thunder strike */
    .skill-card.thunder-shake {
        animation: thunderShake 0.5s ease-out;
    }
    @keyframes thunderShake {
        0%   { transform: translateX(0) translateY(0); }
        5%   { transform: translateX(-3px) translateY(2px); }
        10%  { transform: translateX(4px) translateY(-1px); }
        15%  { transform: translateX(-2px) translateY(3px); }
        25%  { transform: translateX(1px) translateY(-2px); }
        40%  { transform: translateX(-1px) translateY(0); }
        100% { transform: translateX(0) translateY(0); }
    }

    /* Small electric spark particles */
    .skill-card .spark {
        position: absolute;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: #7ce6ff;
        pointer-events: none;
        z-index: 11;
        opacity: 0;
        box-shadow: 0 0 6px 2px rgba(124, 230, 255, 0.8);
    }
    .skill-card .spark.spark-active {
        animation: sparkFly 0.7s ease-out forwards;
    }
    @keyframes sparkFly {
        0%   { opacity: 1; transform: translate(0, 0) scale(1); }
        100% { opacity: 0; transform: translate(var(--spark-x), var(--spark-y)) scale(0); }
    }

    /* Thunder strike: skill icon glows */
    .skill-card.thunder-strike .skill-icon {
        animation: iconGlow 0.4s ease-out 2;
    }
    @keyframes iconGlow {
        0%   { color: #fff; filter: drop-shadow(0 0 8px rgba(124, 230, 255, 0.8)); }
        50%  { color: #b3f0ff; filter: drop-shadow(0 0 16px rgba(124, 230, 255, 0.6)); }
        100% { color: var(--accent-light); filter: none; }
    }

    /* Skill circle progress glows on thunder */
    .skill-card.thunder-strike .skill-circle-progress {
        filter: brightness(1.4) drop-shadow(0 0 6px rgba(0, 217, 255, 0.6));
        transition: filter 0.3s ease;
    }
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

    /* Projects */
    .projects-section { background: linear-gradient(180deg, var(--bg-secondary) 0%, var(--bg-primary) 100%); }
    .projects-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 2rem; }
    .project-card {
        background: linear-gradient(145deg, rgba(30, 41, 59, 0.5), rgba(22, 32, 50, 0.5));
        border: 1px solid var(--border-color); border-radius: var(--radius-lg);
        overflow: hidden; transition: var(--transition); position: relative;
        text-decoration: none; display: block; cursor: pointer;
    }
    html.light-theme .project-card {
        background: rgba(255,255,255,0.7);
        border-color: rgba(0,217,255,0.12);
    }
    .project-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, transparent, #00d9ff, #00ff88, transparent);
        opacity: 0; transition: opacity 0.5s ease; z-index: 2;
    }
    .project-card:hover::before { opacity: 1; }
    .project-card:hover {
        transform: translateY(-6px); border-color: rgba(0,217,255,0.25);
        box-shadow: 0 20px 60px rgba(0,217,255,0.08), 0 8px 20px rgba(0,0,0,0.12);
    }
    html.light-theme .project-card:hover {
        box-shadow: 0 20px 60px rgba(0,217,255,0.1);
    }
    .project-card .card-image { height: 210px; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center; }
    .project-card .card-image .project-icon { font-size: 4rem; opacity: 0.5; transition: var(--transition); }
    .project-card:hover .card-image .project-icon { transform: scale(1.3); opacity: 1; }
    .project-card .card-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1); }
    .project-card:hover .card-image img { transform: scale(1.08); }
    .project-card .card-image::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 60%; background: linear-gradient(0deg, rgba(8,11,18,0.8) 0%, transparent 100%); pointer-events: none; }
    html.light-theme .project-card .card-image::after { background: linear-gradient(0deg, rgba(248,250,252,0.8) 0%, transparent 100%); }
    .project-card .card-body { padding: 1.75rem 1.75rem 1.5rem; position: relative; z-index: 1; }
    .project-card .card-body h3 { font-size: 1.3rem; font-weight: 800; margin-bottom: 0; color: #fff; letter-spacing: -0.3px; }
    html.light-theme .project-card .card-body h3 { color: #111827; }
    .project-card:hover .view-details-btn { background: rgba(0,217,255,0.12); gap: 0.7rem; }
    .project-card:hover .view-details-btn i { transform: translateX(3px); }

/* ===== GIGS — FLEX GRID (3+2 centered, matches casestudy width) ===== */
    .gigs-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1.5rem;
    }
    .gig-card {
        width: calc(33.333% - 1rem);
        min-width: 280px;
        flex-shrink: 0;
        display: block;
        text-decoration: none;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
    }
    html.light-theme .gig-card { background: rgba(255, 255, 255, 0.85); }
    .gig-card:hover {
        border-color: var(--border-hover);
        box-shadow: var(--shadow-md);
        transform: translateY(-6px);
    }
    .gig-image {
        height: 220px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .gig-image .gig-icon { font-size: 4rem; opacity: 0.5; transition: var(--transition); }
    .gig-card:hover .gig-image .gig-icon { transform: scale(1.3); opacity: 1; }
    .gig-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1); }
    .gig-card:hover .gig-image img { transform: scale(1.08); }
    .gig-image::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 70px;
        background: linear-gradient(transparent, rgba(30, 41, 59, 0.95));
    }
    html.light-theme .gig-image::after { background: linear-gradient(transparent, rgba(248, 250, 252, 0.9)) !important; }
    .gig-body { padding: 1.5rem 1.5rem 1.8rem; position: relative; z-index: 2; }
    .gig-body h3 { font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-primary); }
    .gig-body p { color: var(--text-secondary); font-size: 0.9rem; line-height: 1.6; margin-bottom: 1rem; }
    .gig-price-badge {
        display: inline-block;
        padding: 0.3rem 1rem;
        background: rgba(0, 217, 255, 0.12);
        color: var(--accent-light);
        border: 1px solid rgba(0, 217, 255, 0.25);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

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
        margin: 0 0.25rem;
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
        background: #080b14; position: relative; z-index: 1;
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
    .footer::after {
        content: ''; position: absolute; top: -50%; left: 50%; translate: -50% 0;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(0,217,255,0.06) 0%, transparent 70%);
        pointer-events: none;
    }
    html.light-theme .footer { background: linear-gradient(180deg, #f1f5f9, #e2e8f0) !important; }
    html.light-theme .footer::after {
        background: radial-gradient(circle, rgba(0,217,255,0.04) 0%, transparent 70%);
    }
    .footer-inner { position: relative; z-index: 2; max-width: 900px; margin: 0 auto; }
    .footer-brand { margin-bottom: 1.5rem; }
    .footer-brand h4 {
        font-size: 1.4rem; font-weight: 800; letter-spacing: -0.5px;
        background: linear-gradient(135deg, var(--accent-light), #6bffb8);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .footer-brand p { color: #64748b; font-size: 0.82rem; margin: 0.3rem 0 0; }
    .footer-divider {
        width: 80px; height: 2px; margin: 0 auto 1.5rem;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        border-radius: 2px;
    }
    .footer-links {
        display: flex; justify-content: center; gap: 1.8rem; margin-bottom: 1.5rem; flex-wrap: wrap;
    }
    .footer-links a {
        color: #64748b; transition: all 0.3s ease; font-size: 0.85rem;
        font-weight: 500; text-decoration: none; position: relative;
        padding: 0.2rem 0;
    }
    .footer-links a::after {
        content: ''; position: absolute; bottom: 0; left: 50%; right: 50%;
        height: 1px; background: var(--accent);
        transition: all 0.3s ease;
    }
    .footer-links a:hover { color: var(--accent); }
    .footer-links a:hover::after { left: 0; right: 0; }
    .social-icon {
        width: 44px; height: 44px; border-radius: 14px;
        background: rgba(0,217,255,0.06);
        border: 1px solid rgba(0,217,255,0.1);
        display: inline-flex; align-items: center; justify-content: center;
        color: #64748b; font-size: 1.2rem;
        transition: all 0.35s cubic-bezier(0.16,1,0.3,1);
        text-decoration: none; position: relative; overflow: hidden;
    }
    .social-icon::before {
        content: ''; position: absolute; inset: 0; border-radius: inherit;
        background: linear-gradient(135deg, rgba(0,217,255,0.12), rgba(0,255,136,0.08));
        opacity: 0; transition: opacity 0.35s ease;
    }
    .social-icon i { position: relative; z-index: 1; }
    .social-icon:hover::before { opacity: 1; }
    .social-icon:hover {
        border-color: rgba(0,217,255,0.35); color: var(--accent-light);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,217,255,0.2);
    }
    html.light-theme .social-icon {
        background: rgba(255,255,255,0.5); border-color: rgba(0,217,255,0.12);
    }
    html.light-theme .social-icon:hover {
        background: rgba(255,255,255,0.8); border-color: var(--accent); color: var(--accent);
    }
    .footer-bottom {
        padding-top: 1.2rem; border-top: 1px solid rgba(0,217,255,0.06);
        display: flex; justify-content: center; align-items: center; gap: 1rem; flex-wrap: wrap;
    }
    .footer-bottom p { color: #475569; font-size: 0.82rem; margin: 0; }
    .footer-bottom .heart { color: #ef4444; display: inline-block; animation: heartBeat 1.4s ease infinite; }
    @keyframes heartBeat { 0%,100% { transform: scale(1); } 50% { transform: scale(1.2); } }
    .back-top {
        display: inline-flex; align-items: center; gap: 0.4rem;
        color: var(--accent); font-size: 0.8rem; font-weight: 600;
        text-decoration: none; transition: all 0.3s ease;
    }
    .back-top:hover { gap: 0.7rem; color: var(--accent-light); }
    html.light-theme .footer-links a { color: #64748b; }
    html.light-theme .footer-bottom p { color: #64748b; }

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
        .projects-grid { grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; }
        .hero { padding: 5rem 1.5rem 2rem; }
        .whatsapp-float { width: 48px; height: 48px; font-size: 1.3rem; bottom: 1.5rem; left: 1.5rem; }
        .admin-float-btn { width: 42px; height: 42px; font-size: 1rem; bottom: 4.5rem; right: 1.5rem; }
    }
    
    /* Mobile Large (max 768px) */
    @media (max-width: 768px) {
        .section-padding { padding: 5rem 1.5rem; }
        .section-title { margin-bottom: 3rem; }
        .section-title h2 { font-size: 2rem; }
        .section-title p { font-size: 0.95rem; }
        .hero h1 { font-size: clamp(2rem, 6vw, 3.5rem); }
        .hero p { font-size: 1rem; }
        .hero-badge { font-size: 0.75rem; padding: 0.3rem 1rem; }
        .hero::before { width: 400px; height: 400px; }
        
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
        
        

        
        

        
        .project-card .card-body { padding: 1.4rem; }
        .project-card .card-body h3 { font-size: 1.1rem; }
        .project-card .card-image { height: 180px; }
        .project-card .card-body .view-details-btn { font-size: 0.8rem; }
        .gigs-grid { gap: 1.5rem; }
        .gig-card { width: calc(50% - 0.75rem); min-width: 240px; }
        .gig-image { height: 180px; }
        .gig-body { padding: 1.3rem; }
        .gig-body h3 { font-size: 1.1rem; }
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
        .float-chip.c1 { top: 10%; right: 3%; }
        .float-chip.c2 { display: none; }
        .float-chip.c3 { display: none; }
    }
    
    /* Mobile Small (max 480px) */
    @media (max-width: 480px) {
        .section-padding { padding: 3rem 1rem; }
        .section-title { padding: 0 0.5rem; margin-bottom: 2.5rem; }
        .section-title h2 { font-size: 1.7rem; letter-spacing: -0.5px; }
        .section-title .line { width: 45px; height: 3px; }
        .hero { padding: 4rem 1rem 1.5rem; min-height: 90vh; }
        .hero h1 { font-size: 1.8rem; letter-spacing: -0.5px; }
        .hero p { font-size: 0.9rem; }
        .hero-buttons { flex-direction: column; align-items: center; }
        .hero-buttons .btn-primary-custom,
        .hero-buttons .btn-outline-custom { width: 100%; justify-content: center; padding: 0.75rem 1.5rem; font-size: 0.88rem; }
        .hero::before { width: 300px; height: 300px; }
        
        .timeline-card { padding: 0.85rem; }
        .timeline-card h3 { font-size: 0.88rem; }
        .timeline-company { font-size: 0.72rem; margin-bottom: 0.4rem; }
        .timeline-card p { font-size: 0.72rem; line-height: 1.5; }
        .timeline-date { font-size: 0.62rem; padding: 0.15rem 0.6rem; }
        .current-badge { font-size: 0.5rem; padding: 0.15rem 0.5rem; }
        .timeline-location { font-size: 0.68rem; }

        .skills-grid { gap: 1.2rem; }
        .skill-card .skill-circle { width: 100px; height: 100px; }
        .skill-card .skill-icon { font-size: 1.5rem; }
        .skill-card .skill-name { font-size: 0.8rem; }
        .skill-card .skill-percent { font-size: 0.65rem; }
        .skills-grid { animation-duration: 20s; }
        
        .about-grid { gap: 2rem; }
        .about-image .img-wrapper { width: 150px; height: 150px; border-radius: 24px; }
        .about-image .glow-ring { width: 170px; height: 170px; border-radius: 24px; }
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


        .projects-grid { grid-template-columns: 1fr; gap: 1.2rem; }
        .project-card .card-image { height: 160px; }
        .project-card .card-body { padding: 1.2rem; }
        .project-card .card-body h3 { font-size: 1rem; }
        .gigs-grid { display: block !important; gap: unset; width: 100% !important; }
        .gig-card { width: 100% !important; min-width: 0 !important; display: block; max-width: none !important; }
        .gig-card + .gig-card { margin-top: 1rem; }
        .gig-image { height: 140px; }
        .gig-body { padding: 1rem; }
        .gig-body h3 { font-size: 0.9rem; margin-bottom: 0.3rem; }
        .gig-body p { font-size: 0.8rem; margin-bottom: 0.5rem; line-height: 1.4; }
        .gig-price-badge { font-size: 0.72rem; padding: 0.2rem 0.7rem; }
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
        .project-card { transform: none !important; }
        .project-card:hover { transform: translateY(-4px) !important; }
        
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
        .skill-card .skill-circle { width: 90px; height: 90px; }
        .skill-card .skill-icon { font-size: 1.3rem; }
        .skill-card .skill-name { font-size: 0.72rem; }
        .skill-card .skill-percent { font-size: 0.6rem; }
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
        <div class="float-chip c1"><i class="bi bi-shield-check"></i> 256-Bit Encryption</div>
        <div class="float-chip c2"><i class="bi bi-upc-scan"></i> 24/7 Threat Monitoring</div>
        <div class="float-chip c3"><i class="bi bi-shield-lock-fill"></i> SOC 2 Compliant</div>

        <!-- Scan Line Overlay -->
        <div class="scan-lines"></div>

        <div class="hero-content">
            <div class="hero-badge"><i class="bi bi-shield-fill"></i> <span class="shimmer-text">{{ __('messages.hero_badge') }}</span></div>
            <h1>{{ __('messages.hero_greeting') }}<br><span class="gradient-text">{{ optional($account)->name ?? 'Security Force' }}</span></h1>
            <p>{{ __('messages.hero_tagline') }}</p>
            <div class="hero-buttons">
                <a href="#projects" class="btn-primary-custom magnetic">
                    <i class="bi bi-shield-lock"></i> {{ __('messages.see_my_work') }}
                </a>
                <a href="#contact" class="btn-outline-custom magnetic">
                    <i class="bi bi-shield-gear"></i> {{ __('messages.contact_me') }}
                </a>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="mouse">
                <div class="wheel"></div>
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
                    <div class="glow-ring"></div>
                    <div class="img-wrapper">
                        <img src="{{ config('app.storage_url') }}{{ optional($account)->image }}" alt="{{ optional($account)->name ?? 'Portfolio' }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 32px;">
                    </div>
                </div>
                <div class="about-text reveal reveal-delay-2">
                    <div class="about-text-main">
                        <h3>{{ __('messages.about_heading') }}</h3>
                        <p>Hi, I'm <span class="about-name-highlight">{{ optional($account)->name ?? 'Portfolio' }}</span>. {{ __('messages.about_desc_1') }}</p>
                        <p>{{ __('messages.about_desc_2') }}</p>
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
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section section-padding" id="services">
        <div class="container">
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
                    <!-- Floating bubbles -->
                    <div class="wave-bubbles">
                        <div class="bub"></div><div class="bub"></div><div class="bub"></div>
                        <div class="bub"></div><div class="bub"></div><div class="bub"></div>
                        <div class="bub"></div><div class="bub"></div><div class="bub"></div>
                        <div class="bub"></div><div class="bub"></div><div class="bub"></div>
                    </div>
                    <!-- Services floating within the waves (no boxes!) -->
                    <div class="wave-services">
                        @foreach($services as $index => $service)
                            @php $delay = ($index % 4) + 1; @endphp
                            <div class="wave-service reveal reveal-delay-{{ $delay }}">
                                <div class="ws-icon">
                                    <i class="bi {{ $service->icon ?: 'bi-star' }}"></i>
                                </div>
                                <h3>{{ $service->title }}</h3>
                                @if($service->short_description)
                                    <p>{{ $service->short_description }}</p>
                                @endif
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
            <div class="gigs-grid">
                @foreach($gigs as $index => $gig)
                    @php
                        $delay = ($index % 4) + 1;
                        $gradients = [
                            'linear-gradient(135deg, #0f2d3b, #0b1f28)',
                            'linear-gradient(135deg, #0d2f27, #0c2530)',
                            'linear-gradient(135deg, #17303c, #0b1f28)',
                            'linear-gradient(135deg, #1f3a2e, #0b1f28)',
                        ];
                        $icons = ['bi bi-star-fill', 'bi bi-rocket-takeoff-fill', 'bi bi-lightning-fill', 'bi bi-diamond-fill'];
                    @endphp
                    <a href="{{ route('gig.detail', $gig->id) }}" class="gig-card reveal reveal-delay-{{ $delay }}">
                        <div class="gig-image" style="background: {{ $gradients[$index % count($gradients)] }};">
                            @if($gig->image)
                                <img src="{{ config('app.storage_url') }}{{ $gig->image }}" alt="{{ $gig->title }}">
                            @else
                                <span class="gig-icon"><i class="{{ $icons[$index % count($icons)] }}"></i></span>
                            @endif
                        </div>
                        <div class="gig-body">
                            <h3>{{ $gig->title }}</h3>
                            @if($gig->short_description)
                                <p>{{ $gig->short_description }}</p>
                            @endif
                            <span class="gig-price-badge">
                                {{ $gig->basic_price }} USD
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
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
            <div class="casestudy-grid">
                @foreach($caseStudies as $cs)
                    <a href="{{ route('case-study.detail', $cs->id) }}" class="casestudy-card reveal">
                        @if($cs->image)
                            <div class="casestudy-image">
                                <img src="{{ config('app.storage_url') }}{{ $cs->image }}" alt="{{ $cs->title }}">
                                @if($cs->category)<span class="casestudy-category">{{ $cs->category }}</span>@endif
                            </div>
                        @endif
                        <div class="casestudy-body">
                            <h3>{{ $cs->title }}</h3>
                            @if($cs->client)<div class="casestudy-client"><i class="bi bi-building me-1"></i>{{ $cs->client }}</div>@endif
                            <div class="casestudy-view-link">
                                <span class="view-details-btn">{{ __('messages.view_project') }} <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="casestudy-cta reveal">
                <p>{{ __('messages.casestudy_cta') }}</p>
                <a href="#contact" class="btn-primary-custom">{{ __('messages.start_project') }} <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
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
                <div class="timeline reveal">
                    <div class="timeline-line"></div>

                    @foreach($experiences as $index => $exp)
                        <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}">
                            <div class="timeline-dot">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                            <div class="timeline-card">
                                <div class="timeline-date">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $exp->duration }}
                                </div>
                                @if($exp->is_current)
                                    <span class="current-badge">{{ __('messages.current') }}</span>
                                @endif
                                <h3>{{ $exp->position }}</h3>
                                <div class="timeline-company">
                                    <i class="bi bi-building me-1"></i>{{ $exp->company }}
                                    @if($exp->location)
                                        <span class="timeline-location ms-3">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $exp->location }}
                                        </span>
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
                            <div class="edu-card"
                                style="border-radius: var(--radius-lg); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); height: 100%;">
                                <div class="edu-bar"></div>
                                <div class="p-4">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="edu-icon">
                                            <i class="bi bi-mortarboard-fill"></i>
                                        </div>
                                        <div class="flex-grow-1" style="min-width:0;">
                                            <span class="edu-duration">
                                                <i class="bi bi-calendar3 me-1"></i>{{ $edu->duration }}
                                            </span>
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
        background: rgba(255,255,255,0.7) !important;
        border-color: rgba(0,217,255,0.2) !important;
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
        border-color: rgba(0,217,255,0.4) !important;
        box-shadow: 0 0 30px rgba(0,217,255,0.25), var(--shadow-md);
    }
    html.light-theme .edu-card:hover {
        box-shadow: 0 0 30px rgba(0,217,255,0.15), var(--shadow-md);
    }
    .edu-bar {
        height: 5px;
        background: linear-gradient(90deg, #00d9ff, #6bffb8, #00d9ff);
        background-size: 200% 100%;
        animation: eduShimmer 3s ease-in-out infinite;
    }
    .edu-icon {
        width: 52px; height: 52px; flex-shrink: 0;
        background: var(--accent-gradient);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; color: #fff;
        box-shadow: 0 4px 15px rgba(0,217,255,0.3);
    }
    .edu-duration {
        display: inline-flex; align-items: center;
        font-size: 0.72rem; color: var(--accent-light); font-weight: 600;
        background: rgba(0,217,255,0.08);
        padding: 0.2rem 0.8rem; border-radius: 20px;
        margin-bottom: 0.3rem;
    }
    .edu-degree {
        font-size: 1.1rem; font-weight: 700;
        margin-bottom: 0.15rem; color: var(--text-primary);
    }
    .edu-meta {
        font-size: 0.88rem; color: var(--text-secondary);
        margin-bottom: 0.5rem;
        display: flex; flex-wrap: wrap; align-items: center;
        gap: 0.3rem 1rem;
    }
    .edu-meta i { color: var(--accent-light); }
    .edu-board { font-size: 0.82rem; color: var(--text-muted); }
    .edu-result {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.82rem; color: #f59e0b; font-weight: 600;
        background: rgba(245,158,11,0.1);
        padding: 0.25rem 1rem; border-radius: 20px;
    }
    @keyframes eduShimmer {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    html.light-theme #education {
        background: linear-gradient(180deg, #eef2f7 0%, #f1f5f9 100%) !important;
    }
    @media (max-width: 768px) {
        .edu-degree { font-size: 0.95rem !important; }
        .edu-icon { width: 42px !important; height: 42px !important; font-size: 1.1rem !important; }
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
                <div class="skills-wrapper">
                    <div class="skills-grid">
                        @foreach($skills as $index => $skill)
                            <div class="skill-card" data-skill-index="{{ $index }}">
                                <div class="skill-circle">
                                    <svg class="skill-circle-svg" viewBox="0 0 120 120">
                                        <circle class="skill-circle-bg" cx="60" cy="60" r="52"/>
                                        <circle class="skill-circle-progress" cx="60" cy="60" r="52"
                                            stroke-dasharray="326.73"
                                            stroke-dashoffset="326.73"
                                            data-dashoffset="{{ 326.73 - (326.73 * $skill->percentage / 100) }}"/>
                                    </svg>
                                    <span class="skill-icon"><i class="bi {{ $skill->icon ?: 'bi-star' }}"></i></span>
                                    <span class="skill-percent">{{ $skill->percentage }}%</span>
                                    <!-- Thunder flash overlay -->
                                    <div class="thunder-flash"></div>
                                    <!-- Electric arc ring -->
                                    <div class="electric-ring"></div>
                                    <!-- Lightning bolt SVG top-right -->
                                    <svg class="skill-lightning" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 2L4 14h7l-1 8 10-12h-7l1-8z" fill="#fbbf24" stroke="#f59e0b" stroke-width="0.5"/>
                                        <path d="M13 2L4 14h7l-1 8 10-12h-7l1-8z" fill="#fff" opacity="0.3"/>
                                    </svg>
                                </div>
                                <span class="skill-name">{{ $skill->name }}</span>
                                <!-- Spark particles (generated by JS) -->
                            </div>
                        @endforeach
                        @foreach($skills as $index => $skill)
                            <div class="skill-card" data-skill-index="{{ $index }}">
                                <div class="skill-circle">
                                    <svg class="skill-circle-svg" viewBox="0 0 120 120">
                                        <circle class="skill-circle-bg" cx="60" cy="60" r="52"/>
                                        <circle class="skill-circle-progress" cx="60" cy="60" r="52"
                                            stroke-dasharray="326.73"
                                            stroke-dashoffset="326.73"
                                            data-dashoffset="{{ 326.73 - (326.73 * $skill->percentage / 100) }}"/>
                                    </svg>
                                    <span class="skill-icon"><i class="bi {{ $skill->icon ?: 'bi-star' }}"></i></span>
                                    <span class="skill-percent">{{ $skill->percentage }}%</span>
                                    <!-- Thunder flash overlay -->
                                    <div class="thunder-flash"></div>
                                    <!-- Electric arc ring -->
                                    <div class="electric-ring"></div>
                                    <!-- Lightning bolt SVG top-right -->
                                    <svg class="skill-lightning" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 2L4 14h7l-1 8 10-12h-7l1-8z" fill="#fbbf24" stroke="#f59e0b" stroke-width="0.5"/>
                                        <path d="M13 2L4 14h7l-1 8 10-12h-7l1-8z" fill="#fff" opacity="0.3"/>
                                    </svg>
                                </div>
                                <span class="skill-name">{{ $skill->name }}</span>
                                <!-- Spark particles (generated by JS) -->
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-lightning-charge"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_skills') }}</p>
                    <p>{{ __('messages.no_skills_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Projects Section -->
    <section class="projects-section section-padding" id="projects">
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.projects_title') }}</h2>
                <p>{{ __('messages.projects_subtitle') }}</p>
            </div>
            <!-- Filter Buttons -->
            <div class="filter-tabs reveal">
                <button class="filter-btn active" data-filter="all">{{ __('messages.all') }}</button>
                @php
                    $allTechs = [];
                    foreach($projects as $p) {
                        foreach($p->getTechStackArray() as $t) {
                            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $t));
                            $allTechs[$slug] = $t;
                        }
                    }
                @endphp
                @foreach($allTechs as $slug => $label)
                    <button class="filter-btn" data-filter="{{ $slug }}">{{ $label }}</button>
                @endforeach
            </div>

            <div class="projects-grid">
                @forelse($projects as $index => $project)
                    @php
                        $techSlugs = [];
                        foreach($project->getTechStackArray() as $t) {
                            $techSlugs[] = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $t));
                        }
                        $gradients = [
                            'linear-gradient(135deg, #0f2d3b, #0b1f28)',
                            'linear-gradient(135deg, #0d2f27, #0c2530)',
                            'linear-gradient(135deg, #17303c, #0b1f28)',
                            'linear-gradient(135deg, #1f3a2e, #0b1f28)',
                            'linear-gradient(135deg, #162b3a, #0b1f28)',
                            'linear-gradient(135deg, #24351f, #10241b)',
                        ];
                        $icons = [
                            'bi bi-cart-fill',
                            'bi bi-palette-fill',
                            'bi bi-card-checklist',
                            'bi bi-phone-fill',
                            'bi bi-globe',
                            'bi bi-cpu-fill',
                        ];
                        $delay = ($index % 4) + 1;
                    @endphp
                    <a href="{{ route('project.detail', $project->id) }}" class="project-card reveal reveal-delay-{{ $delay }}" data-tech="{{ implode(' ', $techSlugs) }}">
                        <div class="card-image" style="background: {{ $gradients[$index % count($gradients)] }};">
                            @if($project->image)
                                <img src="{{ config('app.storage_url') }}{{ $project->image }}"
                                     alt="{{ $project->title }} screenshot"
                                     style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8;">
                            @else
                                <span class="project-icon"><i class="{{ $icons[$index % count($icons)] }}"></i></span>
                            @endif
                            @if($project->category)<span class="casestudy-category">{{ $project->category }}</span>@endif
                        </div>
                        <div class="card-body">
                            <h3>{{ $project->title }}</h3>
                            <div class="project-links d-flex gap-3" style="margin-top: 1rem;">
                                <span class="view-details-btn">{{ __('messages.view_project') }} <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <i class="bi bi-folder-plus"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_projects') }}</p>
                    <p>{{ __('messages.no_projects_desc') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section section-padding" id="testimonials">
        <div class="container">                            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __('messages.testimonials_title') }}</h2>
                <p>{{ __('messages.testimonials_subtitle') }}</p>
            </div>

            @if($testimonials->isNotEmpty())
                <div class="testimonial-carousel reveal">
                    <div class="testimonial-track" id="testimonialTrack">
                        @foreach($testimonials as $testimonial)
                            <div class="testimonial-card">
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
    </section>

        <!-- Contact Section — REDESIGNED MODERN -->
    <section class="contact-section section-padding" id="contact">
        <div class="contact-bg-grid"></div>
        <div class="container">
            <div class="section-title reveal">
                <div class="line"></div>
                <h2>{{ __("messages.contact_title") }}</h2>
                <p>{{ __("messages.contact_subtitle") }}</p>
            </div>

            <div class="contact-grid">
                <div class="contact-info-card reveal reveal-delay-1">
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
                    <div class="form-header">
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
                        <div class="faq-item" style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-md); margin-bottom: 1rem; overflow: hidden; transition: var(--transition); filter: drop-shadow(0 4px 30px rgba(0, 217, 255, 0.15));">
                            <button class="faq-question" 
                                    onclick="toggleFaq(this)"
                                    style="width: 100%; padding: 1.2rem 1.5rem; background: none; border: none; color: var(--text-primary); font-size: 0.98rem; font-weight: 600; text-align: left; cursor: pointer; display: flex; justify-content: space-between; align-items: center; gap: 1rem; font-family: var(--font); transition: var(--transition);">
                                <span>{{ $faq->question }}</span>
                                <i class="bi bi-chevron-down" style="font-size: 0.8rem; color: var(--accent); transition: transform 0.3s ease; flex-shrink: 0;"></i>
                            </button>
                            <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.4s cubic-bezier(0.16, 1, 0.3, 1), padding 0.4s ease; padding: 0 1.5rem;">
                                <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.8; padding-bottom: 1.2rem; margin: 0;">{{ $faq->answer }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <script>
                function toggleFaq(btn) {
                    var item = btn.parentElement;
                    var answer = item.querySelector('.faq-answer');
                    var icon = btn.querySelector('i');
                    var isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
                    
                    // Close all
                    document.querySelectorAll('.faq-item').forEach(function(el) {
                        el.querySelector('.faq-answer').style.maxHeight = '0';
                        el.querySelector('.faq-answer').style.padding = '0 1.5rem';
                        el.querySelector('i').style.transform = 'rotate(0deg)';
                        el.querySelector('.faq-question').style.color = 'var(--text-primary)';
                    });
                    
                    if (!isOpen) {
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        answer.style.padding = '0 1.5rem 0';
                        icon.style.transform = 'rotate(180deg)';
                        btn.style.color = 'var(--accent)';
                    }
                }
                </script>
            @else
                <div class="empty-state reveal">
                    <i class="bi bi-question-circle"></i>
                    <p class="fw-semibold fs-5 mb-2" style="color: var(--text-primary);">{{ __('messages.no_faqs') }}</p>
                    <p>{{ __('messages.no_faqs_desc') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <h4>{{ optional($account)->name ?? 'Portfolio' }}</h4>
                <p>{{ __('messages.copyright') }}</p>
            </div>
            <div class="footer-divider"></div>

            <div class="footer-links">
                <a href="#about">{{ __('messages.about') }}</a>
                <a href="#services">{{ __('messages.services') }}</a>
                <a href="#skills">{{ __('messages.skills') }}</a>
                <a href="#projects">{{ __('messages.projects') }}</a>
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
            for (var j = 0; j < s.glyphs.length; j++) {
                var y = (startRow + j) * FONT;
                if (y < -FONT || y > h) continue;
                var distFromHead = s.glyphs.length - 1 - j;
                if (distFromHead === 0) {
                    ctx.fillStyle = 'rgba(180, 255, 210, 0.9)';
                } else {
                    var a = Math.pow(1 - distFromHead / TRAIL, 1.6) * 0.65;
                    ctx.fillStyle = 'rgba(0, 255, 136, ' + a.toFixed(3) + ')';
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
    document.querySelectorAll('a, button, .magnetic, .project-card, .gig-card, .skill-ball, .social-link, .btn-primary-custom, .btn-outline-custom, .freelance-btn').forEach(function(el) {
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
        // Skill circle animation
        [].forEach.call(document.querySelectorAll('.skill-circle-progress'), function(circle) {
            if (circle.dataset.animated) return;
            if (circle.getBoundingClientRect().top < winHeight - 80) {
                circle.dataset.animated = 'true';
                circle.style.strokeDashoffset = circle.getAttribute('data-dashoffset');
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

// ===== PROJECT CARD TILT =====
(function() {
    document.querySelectorAll('.project-card').forEach(function(card) {
        card.addEventListener('mousemove', function(e) {
            var rect = card.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;
            var rotateX = (y - rect.height/2) / 20;
            var rotateY = (rect.width/2 - x) / 20;
            card.style.transform = 'perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) translateY(-8px)';
        });
        card.addEventListener('mouseleave', function() {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
    });
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

// ===== PROJECT FILTER TABS =====
(function() {
    var filterBtns = document.querySelectorAll('.filter-btn');
    var projectCards = document.querySelectorAll('.project-card');
    if (!filterBtns.length || !projectCards.length) return;

    filterBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            filterBtns.forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');
            var filter = this.getAttribute('data-filter');

            projectCards.forEach(function(card) {
                if (filter === 'all') {
                    card.style.display = '';
                    card.style.opacity = '1';
                } else {
                    var techs = (card.getAttribute('data-tech') || '').toLowerCase().split(' ');
                    if (techs.indexOf(filter) > -1) {
                        card.style.display = '';
                        card.style.opacity = '1';
                    } else {
                        card.style.display = 'none';
                    }
                }
                // Re-trigger reveal animation
                card.classList.remove('active');
                setTimeout(function() { card.classList.add('active'); }, 50);
            });
        });
    });
})();

// ===== THUNDER / LIGHTNING EFFECT FOR SKILLS (HOVER-TRIGGERED) =====
(function() {
    var section = document.querySelector('.skills-section');
    if (!section) return;

    var allCards = document.querySelectorAll('.skills-grid .skill-card');
    if (!allCards.length) return;

    var originalCount = Math.ceil(allCards.length / 2);
    var cards = [];
    for (var i = 0; i < originalCount; i++) {
        cards.push(allCards[i]);
    }

    var dupCards = [];
    for (var i = originalCount; i < allCards.length; i++) {
        dupCards.push(allCards[i]);
    }

    function getPair(index) {
        return { orig: cards[index], dup: dupCards[index] };
    }

    function createSparks(card) {
        var count = 8;
        for (var i = 0; i < count; i++) {
            var spark = document.createElement('div');
            spark.className = 'spark';
            var angle = (i / count) * 360;
            var dist = 30 + Math.random() * 40;
            spark.style.setProperty('--spark-x', Math.cos(angle * Math.PI / 180) * dist + 'px');
            spark.style.setProperty('--spark-y', Math.sin(angle * Math.PI / 180) * dist + 'px');
            var size = 2 + Math.random() * 3;
            spark.style.width = size + 'px';
            spark.style.height = size + 'px';
            var hue = 200 + Math.random() * 40;
            spark.style.background = 'hsl(' + hue + ', 100%, 70%)';
            spark.style.boxShadow = '0 0 ' + (4 + Math.random() * 6) + 'px hsla(' + hue + ', 100%, 70%, 0.8)';
            card.appendChild(spark);
            setTimeout(function() {
                spark.classList.add('spark-active');
                setTimeout(function() { spark.remove(); }, 800);
            }, i * 30);
        }
    }

    function strikeCard(card) {
        if (!card) return;
        card.classList.add('thunder-strike', 'thunder-shake');
        var flash = card.querySelector('.thunder-flash');
        var electric = card.querySelector('.electric-ring');
        var bolt = card.querySelector('.skill-lightning');
        [flash, electric, bolt].forEach(function(el) {
            if (!el) return;
            var cls = el === flash ? 'flash-active' : el === electric ? 'arc-active' : 'thunder-active';
            el.classList.remove(cls);
            el.offsetWidth;
            el.classList.add(cls);
        });
        createSparks(card);
        setTimeout(function() {
            card.classList.remove('thunder-strike', 'thunder-shake');
            card.querySelectorAll('.skill-circle-progress').forEach(function(c) { c.style.filter = ''; });
        }, 1000);
    }

    function triggerLightning(index) {
        var pair = getPair(index);
        strikeCard(pair.orig);
        if (pair.dup) strikeCard(pair.dup);
    }

    function triggerBgFlash() {
        if (!section) return;
        section.classList.remove('thunder-bg-flash');
        section.offsetWidth;
        section.classList.add('thunder-bg-flash');
        setTimeout(function() { section.classList.remove('thunder-bg-flash'); }, 700);
    }

    // Throttle helper to prevent rapid re-triggers (1.5s cooldown)
    var hoverTimers = {};

    function isThrottled(index) {
        var now = Date.now();
        if (hoverTimers[index] && now - hoverTimers[index] < 1500) return true;
        hoverTimers[index] = now;
        return false;
    }

    // Attach hover listeners to each card
    cards.forEach(function(card, index) {
        card.addEventListener('mouseenter', function() {
            if (isThrottled(index)) return;
            triggerLightning(index);
            triggerBgFlash();
        });
    });

    // Also attach hover to duplicate cards for seamless scroll continuity
    dupCards.forEach(function(dup, index) {
        dup.addEventListener('mouseenter', function() {
            if (isThrottled(index)) return;
            triggerLightning(index);
            triggerBgFlash();
        });
    });
})();
// ===== THUNDER / LIGHTNING EFFECT FOR SKILLS =====
(function() {
    var section = document.querySelector('.skills-section');
    if (!section) return;

    var allCards = document.querySelectorAll('.skills-grid .skill-card');
    if (!allCards.length) return;

    var originalCount = Math.ceil(allCards.length / 2);
    var cards = [];
    for (var i = 0; i < originalCount; i++) {
        cards.push(allCards[i]);
    }

    var dupCards = [];
    for (var i = originalCount; i < allCards.length; i++) {
        dupCards.push(allCards[i]);
    }

    function getPair(index) {
        return { orig: cards[index], dup: dupCards[index] };
    }

    function createSparks(card) {
        var count = 8;
        for (var i = 0; i < count; i++) {
            var spark = document.createElement('div');
            spark.className = 'spark';
            var angle = (i / count) * 360;
            var dist = 30 + Math.random() * 40;
            spark.style.setProperty('--spark-x', Math.cos(angle * Math.PI / 180) * dist + 'px');
            spark.style.setProperty('--spark-y', Math.sin(angle * Math.PI / 180) * dist + 'px');
            var size = 2 + Math.random() * 3;
            spark.style.width = size + 'px';
            spark.style.height = size + 'px';
            var hue = 200 + Math.random() * 40;
            spark.style.background = 'hsl(' + hue + ', 100%, 70%)';
            spark.style.boxShadow = '0 0 ' + (4 + Math.random() * 6) + 'px hsla(' + hue + ', 100%, 70%, 0.8)';
            card.appendChild(spark);
            setTimeout(function() {
                spark.classList.add('spark-active');
                setTimeout(function() { spark.remove(); }, 800);
            }, i * 30);
        }
    }

    function strikeCard(card) {
        if (!card) return;
        card.classList.add('thunder-strike', 'thunder-shake');
        var flash = card.querySelector('.thunder-flash');
        var electric = card.querySelector('.electric-ring');
        var bolt = card.querySelector('.skill-lightning');
        [flash, electric, bolt].forEach(function(el) {
            if (!el) return;
            var cls = el === flash ? 'flash-active' : el === electric ? 'arc-active' : 'thunder-active';
            el.classList.remove(cls);
            void el.offsetWidth;
            el.classList.add(cls);
        });
        createSparks(card);
        setTimeout(function() {
            card.classList.remove('thunder-strike', 'thunder-shake');
            card.querySelectorAll('.skill-circle-progress').forEach(function(c) { c.style.filter = ''; });
        }, 1000);
    }

    function triggerLightning(index) {
        var pair = getPair(index);
        strikeCard(pair.orig);
        if (pair.dup) strikeCard(pair.dup);
    }

    function triggerBgFlash() {
        section.classList.remove('thunder-bg-flash');
        void section.offsetWidth;
        section.classList.add('thunder-bg-flash');
        setTimeout(function() { section.classList.remove('thunder-bg-flash'); }, 700);
    }

    function randomThunder() {
        if (!cards.length) return;
        var index = Math.floor(Math.random() * cards.length);
        triggerLightning(index);
        if (Math.random() < 0.2) triggerBgFlash();
    }

    var isVisible = false;
    var timeoutId = null;

    function scheduleNext() {
        if (timeoutId) { clearTimeout(timeoutId); timeoutId = null; }
        if (!isVisible) return;
        timeoutId = setTimeout(function() {
            if (isVisible) { randomThunder(); scheduleNext(); }
        }, 2000 + Math.random() * 6000);
    }

    if (window.IntersectionObserver) {
        new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                isVisible = entry.isIntersecting;
                if (isVisible) scheduleNext();
                else if (timeoutId) { clearTimeout(timeoutId); timeoutId = null; }
            });
        }, { threshold: 0.1 }).observe(section);
    } else {
        window.addEventListener('scroll', function() {
            var rect = section.getBoundingClientRect();
            isVisible = rect.top < window.innerHeight + 100 && rect.bottom > -100;
            if (isVisible) scheduleNext();
        });
    }

    setTimeout(function() { if (isVisible) randomThunder(); }, 1000);
})();

// ===== GLASS CARD SHINE EFFECT (all glass cards) =====
(function() {
    var selectors = '.cs-step, .timeline-card, .project-card, .gig-card, .testimonial-card, .faq-item, .wave-service, .contact-info-card, .contact-item, .casestudy-card, .edu-card';
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

