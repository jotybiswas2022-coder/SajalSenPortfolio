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
    body { font-family: 'Inter', 'Noto Sans Bengali', system-ui, -apple-system, sans-serif; }
    .mono { font-family: 'JetBrains Mono', Consolas, monospace; }

    /* ===== Page shell + cyber background ===== */
    .gig-detail-page {
        position: relative;
        padding-top: 90px;
        padding-bottom: 6rem;
        min-height: 100vh;
        background:
            radial-gradient(1200px 480px at 50% -8%, rgba(0, 217, 255, 0.08), transparent 60%),
            radial-gradient(900px 500px at 85% 60%, rgba(0, 255, 136, 0.04), transparent 60%),
            linear-gradient(180deg, #080b12, #080d16);
        overflow: hidden;
    }
    html.light-theme .gig-detail-page {
        background:
            radial-gradient(1200px 480px at 50% -8%, rgba(8, 145, 178, 0.09), transparent 60%),
            radial-gradient(900px 500px at 85% 60%, rgba(5, 150, 105, 0.05), transparent 60%),
            linear-gradient(180deg, #f8fafc, #eef2f7);
    }
    .gd-cyber-bg { position: absolute; inset: 0; z-index: 0; pointer-events: none; overflow: hidden; }
    .gd-cyber-bg .gd-grid {
        position: absolute; inset: 0;
        background:
            linear-gradient(rgba(0, 217, 255, 0.045) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 217, 255, 0.045) 1px, transparent 1px);
        background-size: 44px 44px;
        -webkit-mask-image: radial-gradient(ellipse 70% 75% at 50% 45%, rgba(0,0,0,0.7), transparent 85%);
        mask-image: radial-gradient(ellipse 70% 75% at 50% 45%, rgba(0,0,0,0.7), transparent 85%);
    }
    .gd-radar {
        position: absolute; left: 50%; top: 40%; width: 660px; height: 660px;
        transform: translate(-50%, -50%); border-radius: 50%;
        border: 1px solid rgba(0, 217, 255, 0.07);
    }
    .gd-radar::before {
        content: ''; position: absolute; inset: 0; border-radius: 50%;
        border: 1px dashed rgba(0, 217, 255, 0.12); animation: gdRadarSpin 32s linear infinite;
    }
    .gd-radar::after {
        content: ''; position: absolute; inset: 0; border-radius: 50%;
        background: conic-gradient(from 0deg, rgba(0, 217, 255, 0.12), transparent 70deg, transparent 360deg);
        animation: gdRadarSpin 7s linear infinite;
    }
    .gd-beam {
        position: absolute; left: 50%; top: 0; bottom: 0; width: 1px;
        background: linear-gradient(180deg, transparent, rgba(0, 217, 255, 0.4), transparent);
        transform: translateX(-50%);
        animation: gdBeamMove 9s ease-in-out infinite;
    }
    @keyframes gdBeamMove {
        0%   { left: 6%; opacity: 0; }
        18%  { opacity: 1; }
        50%  { left: 94%; opacity: 1; }
        68%  { opacity: 1; }
        100% { left: 6%; opacity: 0; }
    }
    .gd-scan {
        position: absolute; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.5), transparent);
        animation: gdScanMove 6s ease-in-out infinite; opacity: 0;
    }
    @keyframes gdScanMove {
        0%   { top: 5%; opacity: 0; }
        12%  { opacity: 0.8; }
        50%  { top: 96%; opacity: 0.8; }
        62%  { opacity: 0; }
        100% { top: 5%; opacity: 0; }
    }
    .gd-particle {
        position: absolute; color: rgba(0, 255, 136, 0.4);
        font-size: 0.68rem; font-weight: 700; z-index: 0; opacity: 0;
        animation: gdFloat linear infinite;
    }
    .gd-particle.p1 { left: 5%; top: 30%; animation-duration: 8s; }
    .gd-particle.p2 { right: 7%; top: 52%; animation-duration: 9.5s; animation-delay: 1.2s; }
    .gd-particle.p3 { left: 12%; bottom: 24%; animation-duration: 7.5s; animation-delay: 2s; }
    .gd-particle.p4 { right: 16%; bottom: 18%; animation-duration: 8.8s; animation-delay: 0.6s; }
    @keyframes gdFloat {
        0%   { transform: translateY(0); opacity: 0; }
        12%  { opacity: 1; }
        88%  { opacity: 1; }
        100% { transform: translateY(-80px); opacity: 0; }
    }
    @keyframes gdRadarSpin { to { transform: rotate(360deg); } }

    .gd-container { max-width: 1120px; margin: 0 auto; padding: 0 1.5rem; position: relative; z-index: 2; }

    /* ===== Top HUD bar / back ===== */
    .gd-top {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;
    }
    .gd-path {
        display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap;
        font-size: 0.74rem; letter-spacing: 0.08em; color: var(--text-muted);
    }
    .gd-path .sep { color: rgba(0, 217, 255, 0.7); }
    .gd-path .gd-live { display: inline-block; width: 7px; height: 7px; border-radius: 50%; background: #00ff88; box-shadow: 0 0 10px rgba(0, 255, 136, 0.9); animation: gdBlink 1.6s linear infinite; }
    .back-cyber {
        display: inline-flex; align-items: center; gap: 0.55rem;
        padding: 0.55rem 1.3rem; position: relative; overflow: hidden;
        background: rgba(13, 27, 42, 0.7); border: 1px solid rgba(0, 217, 255, 0.28);
        border-radius: 10px; color: var(--text-secondary); text-decoration: none;
        font-size: 0.8rem; font-weight: 600; letter-spacing: 0.04em;
        backdrop-filter: blur(12px); transition: var(--transition);
    }
    html.light-theme .back-cyber { background: rgba(255, 255, 255, 0.85); }
    .back-cyber i, .back-cyber span { position: relative; z-index: 2; }
    .back-cyber::after {
        content: ''; position: absolute; top: 0; bottom: 0; left: -60px; width: 40px;
        background: linear-gradient(105deg, transparent, rgba(255, 255, 255, 0.18), transparent);
        transform: skewX(-20deg); transition: left 0.5s ease;
    }
    .back-cyber:hover { border-color: rgba(0, 217, 255, 0.6); color: var(--accent-light); transform: translateX(-4px); box-shadow: 0 0 24px rgba(0, 217, 255, 0.12); }
    .back-cyber:hover::after { left: 110%; }

    /* ===== Hero image cyber frame ===== */
    .gd-frame {
        position: relative; border-radius: 20px; overflow: hidden;
        border: 1px solid rgba(0, 217, 255, 0.22);
        padding: 10px;
        background: linear-gradient(165deg, rgba(13, 27, 42, 0.7), rgba(7, 16, 27, 0.7));
        margin-bottom: 2.6rem;
        box-shadow: 0 30px 100px rgba(0, 0, 0, 0.4);
    }
    html.light-theme .gd-frame { background: linear-gradient(165deg, rgba(255, 255, 255, 0.95), rgba(240, 244, 250, 0.95)); }
    .gd-frame-corner { position: absolute; width: 18px; height: 18px; border: 2px solid rgba(0, 217, 255, 0.6); z-index: 4; }
    .gd-frame-corner.tl { top: 6px; left: 6px; border-width: 2px 0 0 2px; border-top-left-radius: 8px; }
    .gd-frame-corner.tr { top: 6px; right: 6px; border-width: 2px 2px 0 0; border-top-right-radius: 8px; }
    .gd-frame-corner.bl { bottom: 6px; left: 6px; border-width: 0 0 2px 2px; border-bottom-left-radius: 8px; animation: gdBlink 2.4s linear infinite; }
    .gd-frame-corner.br { bottom: 6px; right: 6px; border-width: 0 2px 2px 0; border-bottom-right-radius: 8px; }
    .gd-frame-screen { position: relative; border-radius: 12px; overflow: hidden; background: #05080f; }
    .gd-frame-screen img { width: 100%; aspect-ratio: 16 / 9; object-fit: cover; display: block; transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
    .gd-frame:hover .gd-frame-screen img { transform: scale(1.03); }
    .gd-fallback {
        width: 100%; aspect-ratio: 16 / 9;
        background: radial-gradient(circle at 50% 40%, rgba(0, 217, 255, 0.08), transparent 55%), linear-gradient(135deg, #0f1c2b, #0a1220);
        display: flex; align-items: center; justify-content: center; gap: 1.2rem;
    }
    .gd-fallback .fb-icon { position: relative; font-size: 4rem; color: rgba(0, 217, 255, 0.4); }
    .gd-fallback .fb-icon::before, .gd-fallback .fb-icon::after {
        content: ''; position: absolute; left: 50%; top: 50%; border-radius: 50%;
        border: 1px dashed rgba(0, 217, 255, 0.3); animation: gdRadarSpin 12s linear infinite;
    }
    .gd-fallback .fb-icon::before { width: 90px; height: 90px; margin: -45px 0 0 -45px; }
    .gd-fallback .fb-icon::after { width: 150px; height: 150px; margin: -75px 0 0 -75px; animation-direction: reverse; }
    html.light-theme .gd-fallback { background: radial-gradient(circle at 50% 40%, rgba(8, 145, 178, 0.08), transparent 55%), linear-gradient(135deg, #eef3fa, #dfe7f2); }
    .gd-fallback .fb-tags { font-size: 0.72rem; letter-spacing: 0.14em; color: rgba(0, 217, 255, 0.45); }
    .gd-sweep {
        position: absolute; inset: 0; pointer-events: none; z-index: 2;
        background: linear-gradient(115deg, transparent 42%, rgba(0, 217, 255, 0.12) 50%, transparent 58%);
        transform: translateX(-130%);
        animation: gdSweep 4.5s ease-in-out infinite;
    }
    @keyframes gdSweep {
        0%   { transform: translateX(-130%); }
        55%  { transform: translateX(130%); }
        100% { transform: translateX(130%); }
    }
    .gd-hud-label {
        position: absolute; top: 16px; left: 20px; z-index: 3;
        font-size: 0.68rem; letter-spacing: 0.16em; color: rgba(0, 217, 255, 0.75);
        background: rgba(5, 8, 15, 0.55); border: 1px solid rgba(0, 217, 255, 0.2);
        padding: 0.25rem 0.6rem; border-radius: 6px; backdrop-filter: blur(6px);
    }
    html.light-theme .gd-hud-label { color: #0891b2; background: rgba(255, 255, 255, 0.7); }
    .gd-hud-label.pkg { left: auto; right: 20px; }
    .gd-frame-bottom {
        position: relative; margin-top: -1px;
        display: flex; align-items: center; justify-content: space-between; gap: 0.8rem;
        padding: 0.7rem 0.9rem 0.35rem;
        font-size: 0.68rem; letter-spacing: 0.1em; color: rgba(148, 163, 184, 0.9);
    }
    .gd-frame-bottom .bar { flex: 1; height: 4px; border-radius: 4px; background: rgba(148, 163, 184, 0.14); overflow: hidden; }
    .gd-frame-bottom .bar span { display: block; height: 100%; width: 80%; border-radius: 4px; background: linear-gradient(90deg, #00d9ff, #00ff88); animation: gdBarWidth 3s ease-in-out infinite alternate; }
    html.light-theme .gd-frame-bottom .bar { background: rgba(2, 6, 23, 0.08); }
    @keyframes gdBarWidth { from { width: 40%; } to { width: 92%; } }

    /* ===== Hero content ===== */
    .gd-hero {
        margin-bottom: 3.2rem; padding: 0 0.5rem; position: relative;
    }
    .gd-hero-meta { display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap; margin-bottom: 1rem; }
    .gd-chip {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.32rem 0.9rem; border-radius: 8px;
        font-size: 0.72rem; font-weight: 600; letter-spacing: 0.04em;
    }
    .gd-chip.cat { background: rgba(0, 217, 255, 0.1); color: var(--accent-light); border: 1px solid rgba(0, 217, 255, 0.3); }
    .gd-chip.tier { background: rgba(251, 191, 36, 0.08); color: #fbbf24; border: 1px solid rgba(251, 191, 36, 0.28); }
    .gd-chip.live { background: rgba(0, 255, 136, 0.08); color: #00ff88; border: 1px solid rgba(0, 255, 136, 0.3); }
    .gd-chip.live .dot { width: 6px; height: 6px; border-radius: 50%; background: #00ff88; box-shadow: 0 0 8px rgba(0, 255, 136, 0.9); animation: gdBlink 1.6s linear infinite; }
    html.light-theme .gd-chip.cat { color: #075985; }
    html.light-theme .gd-chip.tier { color: #b45309; }
    html.light-theme .gd-chip.live { color: #047857; }
    html.light-theme .gd-chip.live .dot { background: #059669; box-shadow: 0 0 8px rgba(5, 150, 105, 0.8); }
    .gd-hero h1 {
        font-size: clamp(2rem, 4.5vw, 3.4rem); font-weight: 900;
        color: var(--text-primary); margin: 0 0 0.6rem; letter-spacing: -1.5px; line-height: 1.1;
        background: linear-gradient(135deg, var(--text-primary) 40%, var(--accent-light) 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    html.light-theme .gd-hero h1 {
        background: linear-gradient(135deg, #111827 40%, #0891b2 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .gd-hero .hero-sub { font-size: 1.02rem; color: var(--text-secondary); line-height: 1.65; max-width: 620px; margin: 0; }

    /* ===== Terminal description ===== */
    .gd-term { max-width: 800px; margin: 0 auto 3.5rem; position: relative; }
    .gd-term-bar {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.55rem 1.1rem;
        background: rgba(0, 217, 255, 0.05); border: 1px solid rgba(0, 217, 255, 0.18);
        border-bottom: none; border-radius: 12px 12px 0 0;
    }
    .gd-term-bar .t-dot { width: 9px; height: 9px; border-radius: 50%; }
    .gd-term-bar .t-dot.r { background: #f43f5e; }
    .gd-term-bar .t-dot.y { background: #fbbf24; }
    .gd-term-bar .t-dot.g { background: #22c55e; }
    .gd-term-bar .t-title { margin-left: 0.6rem; font-size: 0.74rem; letter-spacing: 0.12em; color: var(--text-muted); }
    .gd-term-body {
        position: relative; overflow: hidden;
        background: rgba(6, 11, 20, 0.75); border: 1px solid rgba(0, 217, 255, 0.18);
        border-radius: 0 0 12px 12px; padding: 1.8rem 1.9rem;
    }
    html.light-theme .gd-term-body { background: rgba(255, 255, 255, 0.85); }
    .gd-term-body::before {
        content: ''; position: absolute; left: 0; right: 0; height: 2px; top: 0;
        background: linear-gradient(90deg, transparent, rgba(0, 217, 255, 0.55), transparent);
        animation: gdScanMove 5s ease-in-out infinite; opacity: 0.6;
    }
    .gd-term-body::after {
        content: ''; position: absolute; inset: 0; pointer-events: none;
        background: repeating-linear-gradient(180deg, transparent 0 3px, rgba(0, 217, 255, 0.03) 3px 4px);
    }
    .gd-term-label {
        display: flex; align-items: center; gap: 0.5rem;
        font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
        color: var(--accent-light); margin-bottom: 0.9rem;
    }
    .gd-term-label .cursor { width: 8px; height: 15px; background: var(--accent-light); animation: gdBlink 1s steps(2) infinite; }
    .gd-term-text { color: var(--text-secondary); font-size: 1rem; line-height: 1.85; margin: 0; white-space: pre-line; position: relative; z-index: 1; }

    /* ===== Pricing heading ===== */
    .gd-price-head { text-align: center; margin-bottom: 2.6rem; }
    .gd-price-head .kicker { font-size: 0.72rem; letter-spacing: 0.22em; color: var(--accent-light); margin-bottom: 0.5rem; }
    .gd-price-head h2 { font-size: 1.8rem; font-weight: 800; color: var(--text-primary); margin-bottom: 0.4rem; letter-spacing: -0.5px; }
    .gd-price-head p { color: var(--text-secondary); font-size: 0.95rem; margin: 0; }
    .gd-price-head .title-line { display: flex; align-items: center; justify-content: center; gap: 0.4rem; margin-top: 0.9rem; }
    .gd-price-head .title-line .seg { height: 3px; border-radius: 2px; }
    .gd-price-head .title-line .seg.a { width: 14px; background: #00d9ff; }
    .gd-price-head .title-line .seg.b { width: 46px; background: linear-gradient(90deg, #00d9ff, #00ff88); animation: gdBarWidth 2.6s ease-in-out infinite alternate; }
    .gd-price-head .title-line .seg.c { width: 14px; background: #00ff88; }

    /* ===== Pricing cyber cards ===== */
    .gd-price-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.6rem; }
    .gd-plan {
        position: relative; display: flex; flex-direction: column;
        background: linear-gradient(170deg, rgba(13, 27, 42, 0.95), rgba(7, 16, 27, 0.92));
        border: 1px solid rgba(0, 217, 255, 0.16);
        border-radius: 18px; overflow: hidden; padding: 0;
        transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.45s, box-shadow 0.45s;
    }
    html.light-theme .gd-plan { background: linear-gradient(170deg, rgba(255, 255, 255, 0.97), rgba(246, 249, 253, 0.95)); }
    .gd-plan:hover {
        transform: translateY(-8px);
        border-color: rgba(0, 217, 255, 0.5);
        box-shadow: 0 22px 55px rgba(0, 0, 0, 0.45), 0 0 26px rgba(0, 217, 255, 0.08);
    }
    html.light-theme .gd-plan:hover { box-shadow: 0 22px 45px rgba(0, 0, 0, 0.12), 0 0 22px rgba(8, 145, 178, 0.15); }
    .gd-plan.featured { border-color: rgba(0, 217, 255, 0.4); }
    .gd-plan-corner { position: absolute; width: 14px; height: 14px; border: 2px solid rgba(0, 217, 255, 0.5); z-index: 3; }
    .gd-plan-corner.tl { top: 8px; left: 8px; border-width: 2px 0 0 2px; border-top-left-radius: 6px; }
    .gd-plan-corner.tr { top: 8px; right: 8px; border-width: 2px 2px 0 0; border-top-right-radius: 6px; }
    .gd-plan-corner.bl { bottom: 8px; left: 8px; border-width: 0 0 2px 2px; border-bottom-left-radius: 6px; animation: gdBlink 2.4s linear infinite; }
    .gd-plan-corner.br { bottom: 8px; right: 8px; border-width: 0 2px 2px 0; border-bottom-right-radius: 6px; }
    .gd-plan-hud {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.5rem 1.1rem;
        font-size: 0.66rem; letter-spacing: 0.14em;
        color: rgba(0, 217, 255, 0.75);
        background: rgba(0, 217, 255, 0.05); border-bottom: 1px solid rgba(0, 217, 255, 0.12);
    }
    .gd-plan-hud .gd-live-dot { display: flex; align-items: center; gap: 0.4rem; }
    .gd-plan-hud .gd-live-dot .dot { width: 6px; height: 6px; border-radius: 50%; background: #00ff88; box-shadow: 0 0 8px rgba(0, 255, 136, 0.9); animation: gdBlink 1.6s linear infinite; }
    html.light-theme .gd-plan-hud { color: #085e78; }
    html.light-theme .gd-plan-hud .gd-live-dot .dot { background: #059669; box-shadow: 0 0 8px rgba(5, 150, 105, 0.8); }
    .gd-plan-hud .tag-featured { color: #fbbf24; }
    .gd-plan-body { text-align: center; padding: 1.9rem 1.7rem 1.5rem; display: flex; flex-direction: column; flex: 1; position: relative; z-index: 2; }
    .gd-plan-hub {
        position: relative; width: 66px; height: 66px; margin: 0 auto 1.1rem;
        display: flex; align-items: center; justify-content: center; border-radius: 50%;
        background: rgba(0, 217, 255, 0.07); border: 1px solid rgba(0, 217, 255, 0.25);
        transition: var(--transition);
    }
    .gd-plan-hub i { font-size: 1.8rem; color: var(--accent-light); filter: drop-shadow(0 0 10px rgba(0, 217, 255, 0.5)); }
    html.light-theme .gd-plan-hub i { color: #0891b2; filter: drop-shadow(0 0 6px rgba(8, 145, 178, 0.4)); }
    .gd-plan:hover .gd-plan-hub { transform: scale(1.06) rotate(-3deg); box-shadow: 0 0 24px rgba(0, 217, 255, 0.2); }
    .gd-plan-hub::before, .gd-plan-hub::after {
        content: ''; position: absolute; border-radius: 50%;
        border: 1px dashed rgba(0, 217, 255, 0.3); animation: gdRadarSpin 14s linear infinite;
    }
    .gd-plan-hub::before { inset: -11px; animation-duration: 14s; }
    .gd-plan-hub::after { inset: -22px; animation-duration: 22s; animation-direction: reverse; }
    .gd-plan-name { font-size: 1.2rem; font-weight: 800; color: var(--text-primary); margin-bottom: 0.25rem; }
    .gd-plan-sub { font-size: 0.76rem; color: var(--text-muted); margin-bottom: 1.3rem; }
    .gd-plan-price { margin-bottom: 0.4rem; display: flex; align-items: baseline; justify-content: center; gap: 0.25rem; }
    .gd-plan-price .cur { font-size: 1rem; color: var(--accent-light); font-weight: 600; }
    .gd-plan-price .amt {
        font-size: 2.6rem; font-weight: 900; line-height: 1;
        color: var(--accent-light);
        text-shadow: 0 0 22px rgba(0, 217, 255, 0.4);
        animation: gdPriceGlow 3s ease-in-out infinite;
    }
    .gd-plan-price .ccy { font-size: 0.78rem; color: var(--text-muted); align-self: flex-end; margin-bottom: 0.45rem; }
    html.light-theme .gd-plan-price .amt { text-shadow: none; animation: none; }
    @keyframes gdPriceGlow {
        0%, 100% { text-shadow: 0 0 22px rgba(0, 217, 255, 0.4); }
        50% { text-shadow: 0 0 30px rgba(0, 217, 255, 0.75); }
    }
    .gd-plan-duration {
        display: inline-flex; align-items: center; gap: 0.4rem; margin: 0 auto 1.2rem;
        font-size: 0.68rem; letter-spacing: 0.08em; color: var(--text-muted);
        padding: 0.28rem 0.8rem; border: 1px solid rgba(148, 163, 184, 0.2); border-radius: 20px;
    }
    .gd-plan-feats { list-style: none; padding: 0; margin: 0 0 1.5rem; flex: 1; text-align: left; }
    .gd-plan-feats li {
        display: flex; align-items: flex-start; gap: 0.6rem;
        padding: 0.55rem 0.1rem; color: var(--text-secondary);
        font-size: 0.86rem; line-height: 1.5;
        border-bottom: 1px dashed rgba(148, 163, 184, 0.14);
    }
    .gd-plan-feats li:last-child { border-bottom: none; }
    .gd-plan-feats li .glyph { color: #00ff88; font-size: 0.8rem; flex-shrink: 0; margin-top: 0.15rem; }
    html.light-theme .gd-plan-feats li .glyph { color: #059669; }
    .gd-order {
        position: relative; overflow: hidden; z-index: 2;
        display: flex; align-items: center; justify-content: center; gap: 0.6rem;
        width: 100%; padding: 0.85rem 1.2rem;
        background: linear-gradient(90deg, rgba(0, 217, 255, 0.16), rgba(0, 255, 136, 0.12));
        border: 1px solid rgba(0, 217, 255, 0.4);
        border-radius: 12px; color: #daf6ff; font-weight: 700; font-size: 0.92rem;
        font-family: 'Inter', 'Noto Sans Bengali', sans-serif; cursor: pointer;
        transition: var(--transition);
    }
    html.light-theme .gd-order { color: #075985; }
    .gd-order i { transition: transform 0.35s ease; }
    .gd-order:hover { background: linear-gradient(90deg, rgba(0, 217, 255, 0.28), rgba(0, 255, 136, 0.2)); border-color: rgba(0, 217, 255, 0.65); box-shadow: 0 0 22px rgba(0, 217, 255, 0.16); }
    .gd-order:hover i { transform: translateX(5px); }
    .gd-order::after {
        content: ''; position: absolute; top: 0; bottom: 0; left: -70px; width: 46px;
        background: linear-gradient(105deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transform: skewX(-20deg); transition: left 0.5s ease;
    }
    .gd-order:hover::after { left: 110%; }
    .gd-plan.featured .gd-plan-hud .gd-live-dot .dot { background: #fbbf24; box-shadow: 0 0 8px rgba(251, 191, 36, 0.9); }

    /* ===== Suggested gigs ===== */
    .gd-suggest { margin-top: 4.5rem; padding-top: 0.5rem; }
    .gd-suggest-mark { display: flex; align-items: center; gap: 0.8rem; justify-content: center; margin-bottom: 1.8rem; }
    .gd-suggest-mark .rule { height: 1px; width: 40px; background: linear-gradient(90deg, transparent, rgba(0, 217, 255, 0.5)); }
    .gd-suggest-mark .rule.r { transform: rotate(180deg); }
    .gd-suggest-mark .code { font-size: 0.7rem; letter-spacing: 0.2em; color: rgba(0, 217, 255, 0.7); }
    .gd-suggest-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
    .gd-s-card {
        display: block; text-decoration: none; position: relative; overflow: hidden;
        background: linear-gradient(170deg, rgba(13, 27, 42, 0.95), rgba(7, 16, 27, 0.92));
        border: 1px solid rgba(0, 217, 255, 0.16); border-radius: 16px;
        transition: var(--transition);
    }
    html.light-theme .gd-s-card { background: linear-gradient(170deg, rgba(255, 255, 255, 0.97), rgba(246, 249, 253, 0.95)); }
    .gd-s-card:hover { transform: translateY(-6px); border-color: rgba(0, 217, 255, 0.5); box-shadow: 0 18px 45px rgba(0, 0, 0, 0.4), 0 0 22px rgba(0, 217, 255, 0.08); }
    html.light-theme .gd-s-card:hover { box-shadow: 0 18px 40px rgba(0, 0, 0, 0.1), 0 0 18px rgba(8, 145, 178, 0.14); }
    .gd-s-card .s-top {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.45rem 1rem; font-size: 0.63rem; letter-spacing: 0.12em; color: rgba(0, 217, 255, 0.7);
        background: rgba(0, 217, 255, 0.05); border-bottom: 1px solid rgba(0, 217, 255, 0.1);
    }
    .gd-s-card .s-img { position: relative; height: 150px; overflow: hidden; background: #0a1220; }
    .gd-s-card .s-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1); }
    .gd-s-card:hover .s-img img { transform: scale(1.08); }
    .gd-s-card .s-img .s-fb { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 2.6rem; color: rgba(0, 217, 255, 0.3); background: radial-gradient(circle at 50% 40%, rgba(0, 217, 255, 0.1), transparent 60%), linear-gradient(135deg, #0f1c2b, #0a1220); }
    html.light-theme .gd-s-card .s-img .s-fb { background: radial-gradient(circle at 50% 40%, rgba(8, 145, 178, 0.1), transparent 60%), linear-gradient(135deg, #eef3fa, #dfe7f2); }
    .gd-s-card .s-img::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(180deg, rgba(7, 16, 27, 0) 55%, rgba(7, 16, 27, 0.7));
    }
    html.light-theme .gd-s-card .s-img::after { background: linear-gradient(180deg, rgba(255, 255, 255, 0) 55%, rgba(246, 249, 253, 0.85)); }
    .gd-s-card .s-body { padding: 1.15rem 1.3rem 1.3rem; position: relative; z-index: 2; }
    .gd-s-card .s-body h3 { font-size: 1.05rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.4rem; line-height: 1.3; }
    .gd-s-card .s-body p { color: var(--text-secondary); font-size: 0.82rem; line-height: 1.5; margin-bottom: 0.9rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
    .gd-s-card .s-long {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.55rem 1rem; border-radius: 10px;
        background: linear-gradient(90deg, rgba(0, 217, 255, 0.1), rgba(0, 255, 136, 0.07));
        border: 1px solid rgba(0, 217, 255, 0.28);
    }
    .gd-s-card .s-long .l-name { font-size: 0.62rem; letter-spacing: 0.12em; color: var(--text-muted); }
    .gd-s-card .s-long .l-price { font-size: 0.95rem; font-weight: 800; color: var(--accent-light); }
    html.light-theme .gd-s-card .s-long .l-price { color: #0891b2; }

    @keyframes gdBlink { 50% { opacity: 0.25; } }

    @media (max-width: 968px) {
        .gd-price-grid { grid-template-columns: repeat(2, 1fr); gap: 1.4rem; }
        .gd-plan.featured { grid-column: 1 / -1; max-width: 500px; margin: 0 auto; }
        .gd-suggest-grid { grid-template-columns: repeat(2, 1fr); gap: 1.2rem; }
    }
    @media (max-width: 768px) {
        .gig-detail-page { padding-top: 72px; padding-bottom: 3.5rem; }
        .gd-container { padding: 0 1rem; }
        .gd-frame { border-radius: 14px; padding: 7px; margin-bottom: 1.6rem; }
        .gd-hero { margin-bottom: 2.4rem; padding: 0; }
        .gd-hero h1 { font-size: 1.6rem; }
        .gd-hero .hero-sub { font-size: 0.92rem; }
        .gd-term-body { padding: 1.3rem 1.2rem; }
        .gd-price-grid { grid-template-columns: 1fr; gap: 1.3rem; }
        .gd-plan.featured { max-width: 100%; }
        .gd-suggest-grid { grid-template-columns: 1fr; }
        .gd-s-card .s-img { height: 165px; }
    }
    @media (max-width: 480px) {
        .gd-frame { border-radius: 12px; }
        .gd-hero h1 { font-size: 1.35rem; }
        .gd-hero-meta { gap: 0.4rem; }
        .gd-plan-body { padding: 1.6rem 1.2rem 1.3rem; }
        .gd-plan-price .amt { font-size: 2.1rem; }
        .gd-price-head h2 { font-size: 1.3rem; }
        .gd-half { display: none; }
    }
</style>

<div class="gig-detail-page">
    <div class="gd-cyber-bg" aria-hidden="true">
        <div class="gd-grid"></div>
        <div class="gd-radar"></div>
        <div class="gd-beam"></div>
        <div class="gd-scan"></div>
        <div class="gd-particle p1 mono">0x7F3A</div>
        <div class="gd-particle p2 mono">TCP:443</div>
        <div class="gd-particle p3 mono">AES-256</div>
        <div class="gd-particle p4 mono">IDS</div>
    </div>

    <div class="gd-container">
        <div class="gd-top">
            <div class="gd-path mono">
                <span class="gd-live"></span>
                <span>HOME</span><span class="sep">/</span>
                <span>PRICING</span><span class="sep">/</span>
                <span>{{ __('messages.pricing_plans') }}</span>
            </div>
            <a href="{{ route('home') }}#gigs" class="back-cyber mono">
                <i class="bi bi-arrow-left"></i> <span>{{ __('messages.back_to_gigs') }}</span>
            </a>
        </div>

        <div class="gd-frame">
            <span class="gd-frame-corner tl"></span>
            <span class="gd-frame-corner tr"></span>
            <span class="gd-frame-corner bl"></span>
            <span class="gd-frame-corner br"></span>
            <div class="gd-hud-label mono">SECURE_VIEW</div>
            <div class="gd-hud-label pkg mono">PKG-{{ str_pad($gig->id, 3, '0', STR_PAD_LEFT) }}</div>
            <div class="gd-frame-screen">
                <div class="gd-sweep"></div>
                @if($gig->image)
                    <img src="{{ config('app.storage_url') }}{{ $gig->image }}" alt="{{ $gig->title }}">
                @else
                    <div class="gd-fallback">
                        <div class="fb-icon"><i class="bi bi-shield-lock-fill"></i></div>
                        <div class="fb-tags mono">SCANNING NETWORK &#60;EOF&#62;</div>
                    </div>
                @endif
            </div>
            <div class="gd-frame-bottom mono">
                <span>SCAN COMPLETE</span>
                <div class="bar"><span></span></div>
                <span>100%</span>
            </div>
        </div>

        <div class="gd-hero">
            <div class="gd-hero-meta">
                <span class="gd-chip cat mono"><i class="bi bi-gear-fill"></i> {{ __('messages.service') }}</span>
                <span class="gd-chip tier mono"><i class="bi bi-star-fill"></i> {{ __('messages.premium_service') }}</span>
                <span class="gd-chip live mono"><span class="dot"></span> ACTIVE</span>
            </div>
            <h1>{{ $gig->title }}</h1>
            @if($gig->short_description)
                <p class="hero-sub">{{ $gig->short_description }}</p>
            @endif
        </div>

        @if($gig->description)
            <div class="gd-term">
                <div class="gd-term-bar mono">
                    <span class="t-dot r"></span><span class="t-dot y"></span><span class="t-dot g"></span>
                    <span class="t-title">{{ __('messages.about_this_gig') }}</span>
                </div>
                <div class="gd-term-body">
                    <div class="gd-term-label mono">
                        <i class="bi bi-terminal"></i> <span>{{ __('messages.about_this_gig') }}</span>
                        <span class="cursor"></span>
                    </div>
                    <p class="gd-term-text">{{ $gig->description }}</p>
                </div>
            </div>
        @endif

        <div class="gd-price-head">
            <div class="kicker mono">AUTHENTICATED SESSION</div>
            <h2>{{ __('messages.pricing_plans') }}</h2>
            <p>{{ __('messages.choose_package') }}</p>
            <div class="title-line"><span class="seg a"></span><span class="seg b"></span><span class="seg c"></span></div>
        </div>

        <div class="gd-price-grid">
            <div class="gd-plan">
                <span class="gd-plan-corner tl"></span>
                <span class="gd-plan-corner tr"></span>
                <span class="gd-plan-corner bl"></span>
                <span class="gd-plan-corner br"></span>
                <div class="gd-plan-hud mono">
                    <span>TIER-01</span>
                    <span class="gd-live-dot"><span class="dot"></span> {{ strtoupper($gig->basic_name ?: 'Basic') }}</span>
                </div>
                <div class="gd-plan-body">
                    <div class="gd-plan-hub"><i class="bi bi-rocket-takeoff"></i></div>
                    <div class="gd-plan-name">{{ $gig->basic_name ?: 'Basic' }}</div>
                    <div class="gd-plan-sub">{{ __('messages.starter_package') }}</div>
                    <div class="gd-plan-price">
                        <span class="cur mono">$</span>
                        <span class="amt mono">{{ number_format($gig->basic_price, 0) }}</span>
                        <span class="ccy mono">USD</span>
                    </div>
                    <span class="gd-plan-duration mono"><i class="bi bi-clock-history"></i> {{ __('messages.one_time') }}</span>
                    @if($gig->basic_features)
                        <ul class="gd-plan-feats">
                            @foreach(explode("\n", $gig->basic_features) as $feature)
                                @if(trim($feature))
                                    <li><span class="glyph mono">&#10095;</span><span>{{ trim($feature) }}</span></li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('inbox.order', [$gig->id, 'basic']) }}" method="POST">
                        @csrf
                        <button type="submit" class="gd-order mono">{{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i></button>
                    </form>
                </div>
            </div>

            <div class="gd-plan featured">
                <span class="gd-plan-corner tl"></span>
                <span class="gd-plan-corner tr"></span>
                <span class="gd-plan-corner bl"></span>
                <span class="gd-plan-corner br"></span>
                <div class="gd-plan-hud mono">
                    <span class="tag-featured">TIER-02</span>
                    <span class="gd-live-dot"><span class="dot"></span> {{ strtoupper($gig->standard_name ?: 'Standard') }} &#9733; {{ __('messages.popular') }}</span>
                </div>
                <div class="gd-plan-body">
                    <div class="gd-plan-hub"><i class="bi bi-stars"></i></div>
                    <div class="gd-plan-name">{{ $gig->standard_name ?: 'Standard' }}</div>
                    <div class="gd-plan-sub">{{ __('messages.best_value') }}</div>
                    <div class="gd-plan-price">
                        <span class="cur mono">$</span>
                        <span class="amt mono">{{ number_format($gig->standard_price, 0) }}</span>
                        <span class="ccy mono">USD</span>
                    </div>
                    <span class="gd-plan-duration mono"><i class="bi bi-clock-history"></i> {{ __('messages.one_time') }}</span>
                    @if($gig->standard_features)
                        <ul class="gd-plan-feats">
                            @foreach(explode("\n", $gig->standard_features) as $feature)
                                @if(trim($feature))
                                    <li><span class="glyph mono">&#10095;</span><span>{{ trim($feature) }}</span></li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('inbox.order', [$gig->id, 'standard']) }}" method="POST">
                        @csrf
                        <button type="submit" class="gd-order mono">{{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i></button>
                    </form>
                </div>
            </div>

            <div class="gd-plan">
                <span class="gd-plan-corner tl"></span>
                <span class="gd-plan-corner tr"></span>
                <span class="gd-plan-corner bl"></span>
                <span class="gd-plan-corner br"></span>
                <div class="gd-plan-hud mono">
                    <span>TIER-03</span>
                    <span class="gd-live-dot"><span class="dot"></span> {{ strtoupper($gig->premium_name ?: 'Premium') }}</span>
                </div>
                <div class="gd-plan-body">
                    <div class="gd-plan-hub"><i class="bi bi-gem"></i></div>
                    <div class="gd-plan-name">{{ $gig->premium_name ?: 'Premium' }}</div>
                    <div class="gd-plan-sub">{{ __('messages.premium_package') }}</div>
                    <div class="gd-plan-price">
                        <span class="cur mono">$</span>
                        <span class="amt mono">{{ number_format($gig->premium_price, 0) }}</span>
                        <span class="ccy mono">USD</span>
                    </div>
                    <span class="gd-plan-duration mono"><i class="bi bi-clock-history"></i> {{ __('messages.one_time') }}</span>
                    @if($gig->premium_features)
                        <ul class="gd-plan-feats">
                            @foreach(explode("\n", $gig->premium_features) as $feature)
                                @if(trim($feature))
                                    <li><span class="glyph mono">&#10095;</span><span>{{ trim($feature) }}</span></li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('inbox.order', [$gig->id, 'premium']) }}" method="POST">
                        @csrf
                        <button type="submit" class="gd-order mono">{{ __('messages.order_now') }} <i class="bi bi-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>

        @if($suggestedGigs->count() > 0)
            <div class="gd-suggest">
                <div class="gd-suggest-mark mono">
                    <span class="rule"></span>
                    <span class="code">OTHER_SECURITY_PACKAGES</span>
                    <span class="rule r"></span>
                </div>
                <div class="gd-suggest-grid">
                    @foreach($suggestedGigs as $suggested)
                        <a href="{{ route('gig.detail', $suggested->id) }}" class="gd-s-card">
                            <div class="s-top mono">
                                <span>PKG-{{ str_pad($suggested->id, 3, '0', STR_PAD_LEFT) }}</span>
                                <span class="gd-live-dot"><span class="dot" style="width:6px;height:6px;border-radius:50%;background:#00ff88;box-shadow:0 0 8px rgba(0,255,136,0.9);display:inline-block;"></span> ONLINE</span>
                            </div>
                            <div class="s-img">
                                @if($suggested->image)
                                    <img src="{{ config('app.storage_url') }}{{ $suggested->image }}" alt="{{ $suggested->title }}">
                                @else
                                    <div class="s-fb"><i class="bi bi-shield-lock-fill"></i></div>
                                @endif
                            </div>
                            <div class="s-body">
                                <h3>{{ $suggested->title }}</h3>
                                @if($suggested->short_description)
                                    <p>{{ $suggested->short_description }}</p>
                                @endif
                                <div class="s-long mono">
                                    <span class="l-name">{{ __('messages.starting_from') }}</span>
                                    <span class="l-price">${{ number_format(min($suggested->basic_price, $suggested->standard_price, $suggested->premium_price), 0) }}</span>
                                </div>
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
    var selectors = '.back-cyber, .gd-frame, .gd-term-body, .gd-plan, .gd-s-card';
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