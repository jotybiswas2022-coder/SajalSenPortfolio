@extends('frontend.app')

@section('content')
<style>
    :root {
        --bg-primary: #080b12;
        --bg-card: rgba(17, 24, 39, 0.8);
        --accent: #00d9ff;
        --accent-light: #7ce6ff;
        --green: #00ff88;
        --text-primary: #f1f5f9;
        --text-secondary: #94a3b8;
        --text-muted: #64748b;
        --border-color: #1e293b;
        --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    html.light-theme {
        --bg-card: rgba(255, 255, 255, 0.9);
        --accent: #0891b2;
        --accent-light: #0e7490;
        --green: #059669;
        --text-primary: #111827;
        --text-secondary: #475569;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
    }
    html.light-theme body { background: #f8fafc; }
    body { font-family: 'Inter', 'Noto Sans Bengali', system-ui, -apple-system, sans-serif; }
    .mono { font-family: 'JetBrains Mono', Consolas, monospace; }

    /* ===== Page shell + cyber background ===== */
    .csd-page {
        position: relative;
        padding-top: 90px;
        padding-bottom: 5rem;
        min-height: 100vh;
        overflow: hidden;
        background:
            radial-gradient(1100px 480px at 50% -8%, rgba(0, 217, 255, 0.08), transparent 60%),
            radial-gradient(900px 520px at 88% 55%, rgba(0, 255, 136, 0.04), transparent 60%),
            linear-gradient(180deg, #080b12, #080d16);
    }
    html.light-theme .csd-page {
        background:
            radial-gradient(1100px 480px at 50% -8%, rgba(8, 145, 178, 0.09), transparent 60%),
            radial-gradient(900px 520px at 88% 55%, rgba(5, 150, 105, 0.05), transparent 60%),
            linear-gradient(180deg, #f8fafc, #eef2f7);
    }
    .csd-bg { position: absolute; inset: 0; z-index: 0; pointer-events: none; overflow: hidden; }
    .csd-grid {
        position: absolute; inset: 0;
        background:
            linear-gradient(rgba(0, 217, 255, 0.045) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 217, 255, 0.045) 1px, transparent 1px);
        background-size: 44px 44px;
        -webkit-mask-image: radial-gradient(ellipse 70% 75% at 50% 45%, rgba(0,0,0,0.7), transparent 85%);
        mask-image: radial-gradient(ellipse 70% 75% at 50% 45%, rgba(0,0,0,0.7), transparent 85%);
    }
    .csd-radar {
        position: absolute; left: 50%; top: 38%; width: 660px; height: 660px;
        transform: translate(-50%, -50%); border-radius: 50%;
        border: 1px solid rgba(0, 217, 255, 0.06);
    }
    .csd-radar::before {
        content: ''; position: absolute; inset: 0; border-radius: 50%;
        border: 1px dashed rgba(0, 217, 255, 0.1); animation: csdRadarSpin 32s linear infinite;
    }
    .csd-radar::after {
        content: ''; position: absolute; inset: 0; border-radius: 50%;
        background: conic-gradient(from 0deg, rgba(0, 217, 255, 0.1), transparent 70deg, transparent 360deg);
        animation: csdRadarSpin 7s linear infinite;
    }
    html.light-theme .csd-radar { border-color: rgba(8, 145, 178, 0.12); }
    html.light-theme .csd-radar::before { border-color: rgba(8, 145, 178, 0.16); }
    html.light-theme .csd-radar::after {
        background: conic-gradient(from 0deg, rgba(8, 145, 178, 0.13), transparent 70deg, transparent 360deg);
    }
    @keyframes csdRadarSpin { to { transform: rotate(360deg); } }
    .csd-beam {
        position: absolute; left: 50%; top: 0; bottom: 0; width: 1px;
        background: linear-gradient(180deg, transparent, rgba(0, 217, 255, 0.35), transparent);
        transform: translateX(-50%);
        animation: csdBeamMove 9s ease-in-out infinite;
    }
    html.light-theme .csd-beam {
        background: linear-gradient(180deg, transparent, rgba(8, 145, 178, 0.3), transparent);
    }
    @keyframes csdBeamMove {
        0%   { left: 6%; opacity: 0; }
        18%  { opacity: 1; }
        50%  { left: 94%; opacity: 1; }
        68%  { opacity: 1; }
        100% { left: 6%; opacity: 0; }
    }
    .csd-scan {
        position: absolute; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.45), transparent);
        animation: csdScanMove 6s ease-in-out infinite; opacity: 0;
    }
    html.light-theme .csd-scan {
        background: linear-gradient(90deg, transparent, rgba(5, 150, 105, 0.4), transparent);
    }
    @keyframes csdScanMove {
        0%   { top: 5%; opacity: 0; }
        12%  { opacity: 0.8; }
        50%  { top: 96%; opacity: 0.8; }
        62%  { opacity: 0; }
        100% { top: 5%; opacity: 0; }
    }
    .csd-particle {
        position: absolute; color: rgba(0, 255, 136, 0.35);
        font-size: 0.66rem; font-weight: 700; opacity: 0;
        animation: csdFloat linear infinite;
    }
    html.light-theme .csd-particle { color: rgba(5, 150, 105, 0.4); }
    .csd-particle.p1 { left: 5%; top: 30%; animation-duration: 8s; }
    .csd-particle.p2 { right: 7%; top: 55%; animation-duration: 9.5s; animation-delay: 1.2s; }
    .csd-particle.p3 { left: 11%; bottom: 26%; animation-duration: 7.5s; animation-delay: 2s; }
    .csd-particle.p4 { right: 15%; bottom: 16%; animation-duration: 8.8s; animation-delay: 0.6s; }
    @keyframes csdFloat {
        0%   { transform: translateY(0); opacity: 0; }
        12%  { opacity: 1; }
        88%  { opacity: 1; }
        100% { transform: translateY(-70px); opacity: 0; }
    }

    .csd-container { max-width: 1120px; margin: 0 auto; padding: 0 1.5rem; position: relative; z-index: 2; }

    /* ===== HUD corners (shared) ===== */
    .csd-corner { position: absolute; width: 16px; height: 16px; border: 2px solid rgba(0, 217, 255, 0.55); z-index: 5; }
    html.light-theme .csd-corner { border-color: rgba(8, 145, 178, 0.5); }
    .csd-corner.tl { top: 8px; left: 8px; border-width: 2px 0 0 2px; border-top-left-radius: 8px; }
    .csd-corner.tr { top: 8px; right: 8px; border-width: 2px 2px 0 0; border-top-right-radius: 8px; }
    .csd-corner.bl { bottom: 8px; left: 8px; border-width: 0 0 2px 2px; border-bottom-left-radius: 8px; animation: csdBlink 2.4s linear infinite; }
    .csd-corner.br { bottom: 8px; right: 8px; border-width: 0 2px 2px 0; border-bottom-right-radius: 8px; }
    @keyframes csdBlink { 50% { opacity: 0.25; } }

    /* ===== Top bar ===== */
    .csd-top {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem;
    }
    .csd-path {
        display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap;
        font-size: 0.74rem; letter-spacing: 0.08em; color: var(--text-muted);
    }
    .csd-path .sep { color: var(--accent); }
    html.light-theme .csd-path .sep { color: #0891b2; }
    .csd-live { display: inline-block; width: 7px; height: 7px; border-radius: 50%; background: var(--green); box-shadow: 0 0 10px rgba(0, 255, 136, 0.9); animation: csdBlink 1.6s linear infinite; }
    html.light-theme .csd-live { box-shadow: 0 0 10px rgba(5, 150, 105, 0.7); }
    .csd-back {
        display: inline-flex; align-items: center; gap: 0.55rem;
        padding: 0.55rem 1.25rem; position: relative; overflow: hidden;
        background: rgba(13, 27, 42, 0.7); border: 1px solid rgba(0, 217, 255, 0.28);
        border-radius: 10px; color: var(--text-secondary); text-decoration: none;
        font-size: 0.78rem; font-weight: 600; letter-spacing: 0.04em;
        backdrop-filter: blur(12px); transition: var(--transition);
    }
    html.light-theme .csd-back { background: rgba(255, 255, 255, 0.85); border-color: rgba(8, 145, 178, 0.25); }
    .csd-back i, .csd-back span { position: relative; z-index: 2; }
    .csd-back::after {
        content: ''; position: absolute; top: 0; bottom: 0; left: -60px; width: 40px;
        background: linear-gradient(105deg, transparent, rgba(255, 255, 255, 0.18), transparent);
        transform: skewX(-20deg); transition: left 0.5s ease;
    }
    .csd-back:hover { border-color: rgba(0, 217, 255, 0.6); color: var(--accent-light); transform: translateX(-4px); box-shadow: 0 0 24px rgba(0, 217, 255, 0.12); }
    .csd-back:hover::after { left: 110%; }
    html.light-theme .csd-back:hover { color: #0891b2; border-color: rgba(8, 145, 178, 0.5); box-shadow: 0 0 20px rgba(8, 145, 178, 0.1); }

    /* ===== Hero image cyber frame ===== */
    .csd-frame {
        position: relative; border-radius: 20px; overflow: hidden;
        border: 1px solid rgba(0, 217, 255, 0.2);
        padding: 10px;
        background: linear-gradient(165deg, rgba(13, 27, 42, 0.7), rgba(7, 16, 27, 0.7));
        margin-bottom: 2.6rem;
        box-shadow: 0 30px 100px rgba(0, 0, 0, 0.4);
    }
    html.light-theme .csd-frame {
        background: linear-gradient(165deg, rgba(255, 255, 255, 0.95), rgba(240, 244, 250, 0.95));
        border-color: rgba(8, 145, 178, 0.2);
        box-shadow: 0 30px 90px rgba(0, 0, 0, 0.12);
    }
    .csd-hud {
        position: absolute; top: 16px; left: 20px; z-index: 4;
        font-size: 0.66rem; letter-spacing: 0.16em; color: rgba(0, 217, 255, 0.8);
        background: rgba(5, 8, 15, 0.55); border: 1px solid rgba(0, 217, 255, 0.2);
        padding: 0.25rem 0.6rem; border-radius: 6px; backdrop-filter: blur(6px);
    }
    html.light-theme .csd-hud { color: #0891b2; background: rgba(255, 255, 255, 0.7); border-color: rgba(8, 145, 178, 0.2); }
    .csd-hud.right { left: auto; right: 20px; }
    .csd-screen { position: relative; border-radius: 12px; overflow: hidden; background: #05080f; }
    .csd-screen img { width: 100%; min-height: 220px; object-fit: cover; display: block; transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
    .csd-frame:hover .csd-screen img { transform: scale(1.03); }
    .csd-fallback {
        width: 100%; aspect-ratio: 16 / 9;
        background: radial-gradient(circle at 50% 40%, rgba(0, 217, 255, 0.08), transparent 55%), linear-gradient(135deg, #0f1c2b, #0a1220);
        display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 1.1rem;
    }
    html.light-theme .csd-fallback {
        background: radial-gradient(circle at 50% 40%, rgba(8, 145, 178, 0.08), transparent 55%), linear-gradient(135deg, #eef3fa, #dfe7f2);
    }
    .csd-fallback .fb-icon { position: relative; font-size: 4rem; color: rgba(0, 217, 255, 0.4); }
    html.light-theme .csd-fallback .fb-icon { color: rgba(8, 145, 178, 0.45); }
    .csd-fallback .fb-icon::before, .csd-fallback .fb-icon::after {
        content: ''; position: absolute; left: 50%; top: 50%; border-radius: 50%;
        border: 1px dashed rgba(0, 217, 255, 0.3); animation: csdRadarSpin 12s linear infinite;
    }
    html.light-theme .csd-fallback .fb-icon::before, html.light-theme .csd-fallback .fb-icon::after { border-color: rgba(8, 145, 178, 0.3); }
    .csd-fallback .fb-icon::before { width: 90px; height: 90px; margin: -45px 0 0 -45px; }
    .csd-fallback .fb-icon::after { width: 150px; height: 150px; margin: -75px 0 0 -75px; animation-direction: reverse; }
    .csd-fallback .fb-tags { font-size: 0.7rem; letter-spacing: 0.14em; color: rgba(0, 217, 255, 0.45); }
    html.light-theme .csd-fallback .fb-tags { color: #0e7490; }
    .csd-sweep {
        position: absolute; inset: 0; pointer-events: none; z-index: 2;
        background: linear-gradient(115deg, transparent 42%, rgba(0, 217, 255, 0.12) 50%, transparent 58%);
        transform: translateX(-130%);
        animation: csdSweep 4.5s ease-in-out infinite;
    }
    @keyframes csdSweep {
        0%   { transform: translateX(-130%); }
        55%  { transform: translateX(130%); }
        100% { transform: translateX(130%); }
    }
    .csd-frame-bottom {
        position: relative; margin-top: -1px;
        display: flex; align-items: center; justify-content: space-between; gap: 0.8rem;
        padding: 0.7rem 0.9rem 0.35rem;
        font-size: 0.66rem; letter-spacing: 0.1em; color: rgba(148, 163, 184, 0.9);
    }
    .csd-frame-bottom .bar { flex: 1; height: 4px; border-radius: 4px; background: rgba(148, 163, 184, 0.14); overflow: hidden; }
    html.light-theme .csd-frame-bottom .bar { background: rgba(2, 6, 23, 0.08); }
    .csd-frame-bottom .bar span { display: block; height: 100%; width: 80%; border-radius: 4px; background: linear-gradient(90deg, var(--accent), var(--green)); animation: csdBarWidth 3s ease-in-out infinite alternate; }
    @keyframes csdBarWidth { from { width: 40%; } to { width: 92%; } }

    /* ===== Hero content ===== */
    .csd-hero { margin-bottom: 3rem; padding: 0 0.5rem; }
    .csd-meta { display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap; margin-bottom: 1rem; }
    .csd-chip {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.32rem 0.9rem; border-radius: 8px;
        font-size: 0.7rem; font-weight: 700; letter-spacing: 0.05em; border: 1px solid;
    }
    .csd-chip.cat { background: rgba(0, 217, 255, 0.08); color: var(--accent-light); border-color: rgba(0, 217, 255, 0.3); }
    html.light-theme .csd-chip.cat { background: rgba(8, 145, 178, 0.08); color: #075985; border-color: rgba(8, 145, 178, 0.3); }
    .csd-chip.client { background: rgba(148, 163, 184, 0.08); color: var(--text-secondary); border-color: rgba(148, 163, 184, 0.2); }
    html.light-theme .csd-chip.client { background: rgba(100, 116, 139, 0.08); color: #475569; border-color: rgba(100, 116, 139, 0.22); }
    .csd-chip.flag { background: rgba(0, 255, 136, 0.08); color: var(--green); border-color: rgba(0, 255, 136, 0.3); }
    html.light-theme .csd-chip.flag { background: rgba(5, 150, 105, 0.08); color: #047857; border-color: rgba(5, 150, 105, 0.3); }
    .csd-chip.flag .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--green); box-shadow: 0 0 8px rgba(0, 255, 136, 0.9); animation: csdBlink 1.6s linear infinite; }
    html.light-theme .csd-chip.flag .dot { box-shadow: 0 0 8px rgba(5, 150, 105, 0.8); }
    .csd-title {
        font-size: clamp(2rem, 4.5vw, 3.4rem); font-weight: 900;
        color: var(--text-primary); margin: 0; letter-spacing: -1.5px; line-height: 1.12;
    }
    .csd-title-line { display: flex; align-items: center; gap: 0.35rem; margin-top: 1rem; }
    .csd-title-line .seg { height: 4px; border-radius: 2px; }
    .csd-title-line .seg.a { width: 18px; background: var(--accent); }
    .csd-title-line .seg.b { width: 54px; background: linear-gradient(90deg, var(--accent), var(--green)); animation: csdBarPulse 2.6s ease-in-out infinite alternate; }
    html.light-theme .csd-title-line .seg.b { animation: none; }
    @keyframes csdBarPulse { from { width: 30px; } to { width: 70px; } }
    .csd-title-line .seg.c { width: 18px; background: var(--green); }

    /* ===== Body grid ===== */
    .csd-body { display: grid; grid-template-columns: minmax(0, 1fr) 320px; gap: 2rem; align-items: start; position: relative; z-index: 2; margin-top: 2.2rem; }
    .csd-main { display: flex; flex-direction: column; gap: 1.5rem; min-width: 0; }

    /* ===== Terminal blocks ===== */
    .csd-term {
        position: relative; overflow: hidden;
        background: rgba(6, 11, 20, 0.78); border: 1px solid var(--border-color);
        border-left: 3px solid;
        border-radius: 14px; backdrop-filter: blur(10px); transition: var(--transition);
    }
    html.light-theme .csd-term { background: rgba(255, 255, 255, 0.9); }
    .csd-term:hover { transform: translateY(-4px); border-color: rgba(0, 217, 255, 0.4); box-shadow: 0 16px 45px rgba(0, 0, 0, 0.35), 0 0 24px rgba(0, 217, 255, 0.06); }
    html.light-theme .csd-term:hover { box-shadow: 0 16px 40px rgba(0, 0, 0, 0.08), 0 0 20px rgba(8, 145, 178, 0.12); }
    .csd-term.cs-problem { border-left-color: #f43f5e; }
    .csd-term.cs-solution { border-left-color: #00d9ff; }
    .csd-term.cs-result { border-left-color: #10b981; }
    html.light-theme .csd-term.cs-problem { border-left-color: #dc2626; }
    html.light-theme .csd-term.cs-solution { border-left-color: #0891b2; }
    html.light-theme .csd-term.cs-result { border-left-color: #059669; }
    .csd-term-bar {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 1.1rem; border-bottom: 1px solid var(--border-color);
    }
    .csd-term.cs-problem .csd-term-bar { background: rgba(244, 63, 94, 0.05); }
    .csd-term.cs-solution .csd-term-bar { background: rgba(0, 217, 255, 0.05); }
    .csd-term.cs-result .csd-term-bar { background: rgba(16, 185, 129, 0.05); }
    html.light-theme .csd-term.cs-problem .csd-term-bar { background: rgba(244, 63, 94, 0.04); }
    html.light-theme .csd-term.cs-solution .csd-term-bar { background: rgba(8, 145, 178, 0.05); }
    html.light-theme .csd-term.cs-result .csd-term-bar { background: rgba(5, 150, 105, 0.05); }
    .cdt-dot { width: 9px; height: 9px; border-radius: 50%; }
    .cdt-dot.r { background: #f43f5e; }
    .cdt-dot.y { background: #fbbf24; }
    .cdt-dot.g { background: #22c55e; }
    .cdt-title { margin-left: 0.5rem; font-size: 0.66rem; letter-spacing: 0.14em; color: var(--text-muted); }
    .csd-term-body { position: relative; overflow: hidden; padding: 1.6rem 1.7rem; }
    .csd-term-body::before {
        content: ''; position: absolute; left: 0; right: 0; height: 2px; top: 0;
        background: linear-gradient(90deg, transparent, rgba(0, 217, 255, 0.5), transparent);
        animation: csdScanMove 5s ease-in-out infinite; opacity: 0.6;
    }
    html.light-theme .csd-term-body::before {
        background: linear-gradient(90deg, transparent, rgba(8, 145, 178, 0.5), transparent);
    }
    .csd-term-body::after {
        content: ''; position: absolute; inset: 0; pointer-events: none;
        background: repeating-linear-gradient(180deg, transparent 0 3px, rgba(0, 217, 255, 0.03) 3px 4px);
    }
    .csd-term-label {
        display: flex; align-items: center; gap: 0.5rem;
        font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;
        margin-bottom: 0.9rem;
    }
    .csd-term.cs-problem .csd-term-label { color: #f43f5e; }
    .csd-term.cs-solution .csd-term-label { color: var(--accent-light); }
    .csd-term.cs-result .csd-term-label { color: #10b981; }
    html.light-theme .csd-term.cs-solution .csd-term-label { color: #0891b2; }
    html.light-theme .csd-term.cs-result .csd-term-label { color: #059669; }
    .csd-term-label .cursor { width: 8px; height: 14px; background: currentColor; animation: csdBlink 1s steps(2) infinite; }
    .csd-term-text { color: var(--text-secondary); font-size: 0.98rem; line-height: 1.85; margin: 0; position: relative; z-index: 1; }

    /* ===== Tech stack ===== */
    .csd-tech {
        position: relative; overflow: hidden;
        background: rgba(17, 24, 39, 0.6); border: 1px solid rgba(0, 217, 255, 0.16);
        border-radius: 16px; padding: 1.6rem 1.8rem; backdrop-filter: blur(10px); transition: var(--transition);
    }
    html.light-theme .csd-tech { background: rgba(255, 255, 255, 0.9); border-color: rgba(8, 145, 178, 0.2); }
    .csd-tech:hover { transform: translateY(-4px); border-color: rgba(0, 217, 255, 0.4); box-shadow: 0 16px 45px rgba(0, 0, 0, 0.35), 0 0 24px rgba(0, 217, 255, 0.06); }
    html.light-theme .csd-tech:hover { box-shadow: 0 16px 40px rgba(0, 0, 0, 0.08), 0 0 20px rgba(8, 145, 178, 0.12); }
    .csd-tech-head {
        display: flex; align-items: center; gap: 0.7rem;
        font-size: 0.72rem; font-weight: 800; letter-spacing: 0.16em;
        color: var(--accent-light); margin-bottom: 1.1rem;
    }
    html.light-theme .csd-tech-head { color: #0891b2; }
    .csd-tech-head .tech-live { margin-left: auto; display: inline-flex; align-items: center; gap: 0.4rem; color: var(--green); }
    html.light-theme .csd-tech-head .tech-live { color: #059669; }
    .csd-tech-head .tech-live .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; box-shadow: 0 0 8px rgba(0, 255, 136, 0.9); animation: csdBlink 1.6s linear infinite; }
    html.light-theme .csd-tech-head .tech-live .dot { box-shadow: 0 0 8px rgba(5, 150, 105, 0.8); }
    .csd-tech-list { display: flex; flex-wrap: wrap; gap: 0.55rem; }
    .csd-tech-item {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.76rem; font-weight: 700; letter-spacing: 0.04em;
        padding: 0.4rem 1.1rem; border-radius: 8px;
        color: var(--accent-light); border: 1px solid rgba(0, 217, 255, 0.14);
        background: linear-gradient(135deg, rgba(0, 217, 255, 0.07), rgba(0, 255, 136, 0.07));
        transition: var(--transition);
    }
    html.light-theme .csd-tech-item { color: #0e7490; background: rgba(8, 145, 178, 0.05); border-color: rgba(8, 145, 178, 0.2); }
    .csd-tech-item::before { content: '#'; opacity: 0.55; }
    .csd-tech-item:hover { transform: translateY(-2px); border-color: rgba(0, 217, 255, 0.4); box-shadow: 0 0 16px rgba(0, 217, 255, 0.15); }
    html.light-theme .csd-tech-item:hover { border-color: rgba(8, 145, 178, 0.4); box-shadow: 0 0 14px rgba(8, 145, 178, 0.12); }

    /* ===== Sidebar ===== */
    .csd-side { display: flex; flex-direction: column; gap: 1.5rem; }
    .csd-card {
        position: relative; overflow: hidden;
        background: rgba(13, 27, 42, 0.85); border: 1px solid rgba(0, 217, 255, 0.16);
        border-radius: 18px; padding: 1.7rem 1.5rem 1.5rem; backdrop-filter: blur(10px); transition: var(--transition);
    }
    html.light-theme .csd-card { background: rgba(255, 255, 255, 0.92); border-color: rgba(8, 145, 178, 0.2); }
    .csd-card:hover { transform: translateY(-4px); border-color: rgba(0, 217, 255, 0.4); box-shadow: 0 16px 45px rgba(0, 0, 0, 0.35), 0 0 24px rgba(0, 217, 255, 0.06); }
    html.light-theme .csd-card:hover { box-shadow: 0 16px 40px rgba(0, 0, 0, 0.08), 0 0 20px rgba(8, 145, 178, 0.12); }
    .csd-card-top {
        display: flex; align-items: center; justify-content: space-between;
        font-size: 0.66rem; font-weight: 800; letter-spacing: 0.16em; color: var(--accent-light);
        padding-bottom: 0.9rem; border-bottom: 1px solid rgba(0, 217, 255, 0.12); margin-bottom: 0.4rem;
    }
    html.light-theme .csd-card-top { color: #0891b2; border-bottom-color: rgba(8, 145, 178, 0.15); }
    .csd-row {
        display: flex; justify-content: space-between; align-items: center; gap: 1rem;
        padding: 0.7rem 0; border-bottom: 1px dashed rgba(148, 163, 184, 0.15);
    }
    .csd-row:last-child { border-bottom: none; }
    html.light-theme .csd-row { border-bottom-color: rgba(100, 116, 139, 0.18); }
    .csd-row .k { font-size: 0.66rem; font-weight: 700; letter-spacing: 0.1em; color: var(--text-muted); }
    .csd-row .v { font-size: 0.85rem; font-weight: 600; color: var(--text-primary); text-align: right; }
    .csd-row .v.ok { color: var(--green); }
    html.light-theme .csd-row .v.ok { color: #059669; }
    .csd-card-scan {
        position: absolute; left: 0; right: 0; height: 2px; top: 0;
        background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.55), transparent);
        animation: csdCardScan 5s ease-in-out infinite; opacity: 0; pointer-events: none; z-index: 4;
    }
    html.light-theme .csd-card-scan { background: linear-gradient(90deg, transparent, rgba(5, 150, 105, 0.5), transparent); }
    @keyframes csdCardScan {
        0%   { top: 0; opacity: 0; }
        8%   { opacity: 0.9; }
        90%  { opacity: 0.6; }
        100% { top: 100%; opacity: 0; }
    }

    /* ===== CTA ===== */
    .csd-cta {
        position: relative; overflow: hidden; text-align: center;
        background: linear-gradient(150deg, rgba(0, 217, 255, 0.07), rgba(0, 255, 136, 0.07));
        border: 1px solid rgba(0, 217, 255, 0.14); border-radius: 18px; padding: 1.9rem 1.4rem;
    }
    html.light-theme .csd-cta { background: rgba(255, 255, 255, 0.9); border-color: rgba(8, 145, 178, 0.2); }
    .csd-cta::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, var(--accent), var(--green), transparent);
    }
    .csd-cta .mono-tag { font-size: 0.66rem; font-weight: 700; letter-spacing: 0.18em; color: var(--text-muted); margin-bottom: 0.5rem; }
    .csd-cta p { font-size: 0.86rem; color: var(--text-secondary); margin-bottom: 1.3rem; }
    .csd-btn {
        position: relative; overflow: hidden;
        display: inline-flex; align-items: center; gap: 0.55rem;
        padding: 0.78rem 1.9rem;
        background: linear-gradient(135deg, #00d9ff, #00d9ff, #00ff88);
        background-size: 200% 200%; color: #06121c;
        text-decoration: none; border: none; border-radius: 12px;
        font-size: 0.86rem; font-weight: 800; letter-spacing: 0.04em; cursor: pointer;
        transition: all 0.4s ease; animation: csdBtnGrad 3s ease infinite;
    }
    @keyframes csdBtnGrad {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .csd-btn::after {
        content: ''; position: absolute; top: 0; bottom: 0; left: -70px; width: 46px;
        background: linear-gradient(105deg, transparent, rgba(255, 255, 255, 0.55), transparent);
        transform: skewX(-20deg); transition: left 0.5s ease;
    }
    .csd-btn:hover { transform: translateY(-3px); box-shadow: 0 12px 40px rgba(0, 217, 255, 0.35); }
    .csd-btn:hover::after { left: 110%; }
    .csd-btn i { transition: transform 0.35s ease; }
    .csd-btn:hover i { transform: translateX(4px); }

    /* ===== Glass shine (mouse follow) ===== */
    .csd-term::after, .csd-tech::after, .csd-card::after {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%),
            rgba(0, 217, 255, 0.14) 0%, transparent 60%);
        pointer-events: none; opacity: 0; transition: opacity 0.5s ease; z-index: 1; border-radius: inherit;
    }
    html.light-theme .csd-term::after, html.light-theme .csd-tech::after, html.light-theme .csd-card::after {
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%),
            rgba(8, 145, 178, 0.1) 0%, transparent 60%);
    }
    .csd-term:hover::after, .csd-tech:hover::after, .csd-card:hover::after { opacity: 1; }

    /* ===== Responsive ===== */
    @media (max-width: 968px) {
        .csd-body { grid-template-columns: 1fr; }
        .csd-side { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; align-items: start; }
    }
    @media (max-width: 768px) {
        .csd-page { padding-top: 72px; padding-bottom: 3rem; }
        .csd-container { padding: 0 1rem; }
        .csd-frame { border-radius: 14px; padding: 7px; margin-bottom: 1.6rem; }
        .csd-hero { margin-bottom: 2.4rem; padding: 0; }
        .csd-title { font-size: 1.6rem; }
        .csd-meta { gap: 0.4rem; }
        .csd-term-body { padding: 1.3rem 1.2rem; }
        .csd-tech { padding: 1.4rem 1.2rem; }
    }
    @media (max-width: 480px) {
        .csd-frame { border-radius: 12px; }
        .csd-title { font-size: 1.35rem; }
        .csd-side { grid-template-columns: 1fr; }
        .csd-screen img { min-height: 150px; }
    }
</style>

<div class="csd-page">
    <div class="csd-bg" aria-hidden="true">
        <div class="csd-grid"></div>
        <div class="csd-radar"></div>
        <div class="csd-beam"></div>
        <div class="csd-scan"></div>
        <div class="csd-particle p1 mono">FORENSICS</div>
        <div class="csd-particle p2 mono">0x7E3A</div>
        <div class="csd-particle p3 mono">IDS</div>
        <div class="csd-particle p4 mono">SOC_2</div>
    </div>

    <div class="csd-container">
        <div class="csd-top">
            <div class="csd-path mono">
                <span class="csd-live"></span>
                <span>HOME</span><span class="sep">/</span>
                <span>CASE_FILE</span><span class="sep">/</span>
                <span>CS-{{ str_pad($caseStudy->id, 3, '0', STR_PAD_LEFT) }}</span>
            </div>
            <a href="/#case-studies" class="csd-back mono">
                <i class="bi bi-arrow-left"></i> <span>{{ __('messages.back') }}</span>
            </a>
        </div>

        <div class="csd-frame">
            <span class="csd-corner tl"></span>
            <span class="csd-corner tr"></span>
            <span class="csd-corner bl"></span>
            <span class="csd-corner br"></span>
            <div class="csd-hud mono">CASE_FILE // DECRYPTED</div>
            <div class="csd-hud right mono">CS-{{ str_pad($caseStudy->id, 3, '0', STR_PAD_LEFT) }}</div>
            <div class="csd-screen">
                <div class="csd-sweep"></div>
                @if($caseStudy->image)
                    <img src="{{ config('app.storage_url') }}{{ $caseStudy->image }}" alt="{{ $caseStudy->title }}">
                @else
                    <div class="csd-fallback">
                        <div class="fb-icon"><i class="bi bi-shield-lock-fill"></i></div>
                        <div class="fb-tags mono">RECOVERING_EVIDENCE &#60;EOF&#62;</div>
                    </div>
                @endif
            </div>
            <div class="csd-frame-bottom mono">
                <span>INTEGRITY: OK</span>
                <div class="bar"><span></span></div>
                <span>100%</span>
            </div>
        </div>

        <div class="csd-hero">
            <div class="csd-meta">
                @if($caseStudy->category)
                    <span class="csd-chip cat mono"><i class="bi bi-shield-lock-fill"></i> {{ $caseStudy->category }}</span>
                @endif
                @if($caseStudy->client)
                    <span class="csd-chip client mono"><i class="bi bi-building"></i> {{ $caseStudy->client }}</span>
                @endif
                <span class="csd-chip flag mono"><span class="dot"></span> {{ __('messages.completed') }}</span>
            </div>
            <h1 class="csd-title">{{ $caseStudy->title }}</h1>
            <div class="csd-title-line"><span class="seg a"></span><span class="seg b"></span><span class="seg c"></span></div>
        </div>

        <div class="csd-body">
            <div class="csd-main">
                @if($caseStudy->problem)
                    <div class="csd-term cs-problem">
                        <div class="csd-term-bar mono">
                            <span class="cdt-dot r"></span><span class="cdt-dot y"></span><span class="cdt-dot g"></span>
                            <span class="cdt-title">{{ __('messages.problem') }}_identified.log</span>
                        </div>
                        <div class="csd-term-body">
                            <div class="csd-term-label mono"><i class="bi bi-exclamation-triangle-fill"></i> {{ __('messages.problem') }} <span class="cursor"></span></div>
                            <p class="csd-term-text">{{ $caseStudy->problem }}</p>
                        </div>
                    </div>
                @endif

                @if($caseStudy->solution)
                    <div class="csd-term cs-solution">
                        <div class="csd-term-bar mono">
                            <span class="cdt-dot r"></span><span class="cdt-dot y"></span><span class="cdt-dot g"></span>
                            <span class="cdt-title">{{ __('messages.solution') }}_deployed.log</span>
                        </div>
                        <div class="csd-term-body">
                            <div class="csd-term-label mono"><i class="bi bi-lightbulb-fill"></i> {{ __('messages.solution') }} <span class="cursor"></span></div>
                            <p class="csd-term-text">{{ $caseStudy->solution }}</p>
                        </div>
                    </div>
                @endif

                @if($caseStudy->result)
                    <div class="csd-term cs-result">
                        <div class="csd-term-bar mono">
                            <span class="cdt-dot r"></span><span class="cdt-dot y"></span><span class="cdt-dot g"></span>
                            <span class="cdt-title">{{ __('messages.result') }}_verified.log</span>
                        </div>
                        <div class="csd-term-body">
                            <div class="csd-term-label mono"><i class="bi bi-graph-up-arrow"></i> {{ __('messages.result') }} <span class="cursor"></span></div>
                            <p class="csd-term-text">{{ $caseStudy->result }}</p>
                        </div>
                    </div>
                @endif

                @if($caseStudy->technologies)
                    <div class="csd-tech">
                        <div class="csd-tech-head mono">
                            <i class="bi bi-cpu-fill"></i> {{ __('messages.technologies_used') }}
                            <span class="tech-live"><span class="dot"></span> ACTIVE</span>
                        </div>
                        <div class="csd-tech-list">
                            @foreach($caseStudy->tech_list as $tech)
                                <span class="csd-tech-item mono">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="csd-side">
                <div class="csd-card">
                    <span class="csd-corner tl"></span>
                    <span class="csd-corner tr"></span>
                    <span class="csd-corner bl"></span>
                    <span class="csd-corner br"></span>
                    <div class="csd-card-scan"></div>
                    <div class="csd-card-top mono">FILE_METADATA</div>
                    @if($caseStudy->client)
                        <div class="csd-row">
                            <span class="k mono">{{ __('messages.client') }}</span>
                            <span class="v">{{ $caseStudy->client }}</span>
                        </div>
                    @endif
                    @if($caseStudy->category)
                        <div class="csd-row">
                            <span class="k mono">{{ __('messages.category') }}</span>
                            <span class="v">{{ $caseStudy->category }}</span>
                        </div>
                    @endif
                    <div class="csd-row">
                        <span class="k mono">{{ __('messages.status') }}</span>
                        <span class="v ok mono"><i class="bi bi-check2-circle"></i> {{ __('messages.completed') }}</span>
                    </div>
                </div>

                @if($caseStudy->url)
                    <div class="csd-cta">
                        <div class="mono-tag">LAUNCH LIVE ORBITAL VIEW</div>
                        <p>{{ __('messages.view_project') }}</p>
                        <a href="{{ $caseStudy->url }}" target="_blank" rel="noopener noreferrer" class="csd-btn mono">
                            {{ __('messages.live_demo') }} <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    var selectors = '.csd-term, .csd-tech, .csd-card';
    document.querySelectorAll(selectors).forEach(function(el) {
        var rafId = null;
        el.addEventListener('mousemove', function(e) {
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
        el.addEventListener('mouseleave', function() {
            if (rafId) { cancelAnimationFrame(rafId); rafId = null; }
            this.style.setProperty('--shine-x', '50%');
            this.style.setProperty('--shine-y', '50%');
        });
    });
})();
</script>
@endsection