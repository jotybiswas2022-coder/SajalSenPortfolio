@extends('frontend.app')

@section('content')
<style>
    :root {
        --accent: #00d9ff;
        --accent-light: #7ce6ff;
        --green: #00ff88;
        --red: #f43f5e;
        --amber: #f59e0b;
        --mono: 'JetBrains Mono', 'Courier New', monospace;
        --border-color: rgba(0, 217, 255, 0.14);
        --transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    html.light-theme {
        --accent: #0891b2;
        --accent-light: #0e7490;
        --green: #059669;
        --red: #dc2626;
        --amber: #b45309;
        --border-color: rgba(8, 145, 178, 0.16);
    }

    .ibx-page {
        position: relative;
        min-height: 620px;
        padding: 5.5rem 1.2rem 5rem;
        overflow: hidden;
        background: linear-gradient(180deg, #080b12, #0a0f18);
    }
    html.light-theme .ibx-page {
        background:
            radial-gradient(1100px 480px at 50% -8%, rgba(8, 145, 178, 0.09), transparent 60%),
            radial-gradient(900px 520px at 88% 55%, rgba(5, 150, 105, 0.05), transparent 60%),
            linear-gradient(180deg, #f8fafc, #eef2f7);
    }

    .ibx-bg { position: absolute; inset: 0; z-index: 0; pointer-events: none; overflow: hidden; }
    .ibx-grid {
        position: absolute; inset: 0;
        background:
            linear-gradient(rgba(0, 217, 255, 0.045) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 217, 255, 0.045) 1px, transparent 1px);
        background-size: 44px 44px;
        -webkit-mask-image: radial-gradient(ellipse 70% 75% at 50% 45%, rgba(0,0,0,0.7), transparent 85%);
        mask-image: radial-gradient(ellipse 70% 75% at 50% 45%, rgba(0,0,0,0.7), transparent 85%);
    }
    .ibx-radar {
        position: absolute; left: 78%; top: 22%; width: 520px; height: 520px;
        transform: translate(-50%, -50%); border-radius: 50%;
        border: 1px solid rgba(0, 217, 255, 0.05);
        animation: ibxSpin 26s linear infinite;
    }
    .ibx-radar::before, .ibx-radar::after {
        content: ''; position: absolute; inset: 14%; border-radius: 50%;
        border: 1px solid rgba(0, 217, 255, 0.04);
    }
    .ibx-radar::after { inset: 32%; border-color: rgba(0, 217, 255, 0.03); }
    html.light-theme .ibx-radar { border-color: rgba(8, 145, 178, 0.07); }
    @keyframes ibxSpin { to { transform: translate(-50%, -50%) rotate(360deg); } }
    .ibx-scan {
        position: absolute; left: 0; right: 0; height: 140px; top: 0;
        background: linear-gradient(180deg, transparent, rgba(0, 217, 255, 0.04), transparent);
        animation: ibxScan 6s linear infinite;
    }
    html.light-theme .ibx-scan { background: linear-gradient(180deg, transparent, rgba(8, 145, 178, 0.05), transparent); }
    @keyframes ibxScan { 0% { top: -20%; } 100% { top: 120%; } }
    .ibx-particle {
        position: absolute; font-family: var(--mono); font-size: 0.66rem;
        letter-spacing: 1.5px; color: rgba(0, 217, 255, 0.4);
    }
    html.light-theme .ibx-particle { color: rgba(8, 145, 178, 0.4); }
    .ibx-particle.p1 { top: 15%; left: 10%; animation: ibxFloat 7s ease-in-out infinite; }
    .ibx-particle.p2 { bottom: 20%; right: 8%; animation: ibxFloat 9s ease-in-out infinite; animation-delay: 1.2s; }
    .ibx-particle.p3 { bottom: 30%; left: 12%; animation: ibxFloat 8s ease-in-out infinite; animation-delay: 0.6s; }
    @keyframes ibxFloat { 0%, 100% { transform: translateY(0); opacity: 0.5; } 50% { transform: translateY(-14px); opacity: 1; } }

    .ibx-inner {
        position: relative; z-index: 2;
        max-width: 980px; margin: 0 auto;
    }

    .ibx-top {
        display: flex; align-items: center; justify-content: space-between;
        gap: 1rem; margin-bottom: 1.6rem;
    }
    .ibx-path {
        display: flex; align-items: center; gap: 0.6rem;
        font-family: var(--mono); font-size: 0.72rem;
        letter-spacing: 1px; color: var(--accent);
    }
    html.light-theme .ibx-path { color: #0e7490; }
    .ibx-live {
        width: 8px; height: 8px; border-radius: 50%;
        background: #00ff88; box-shadow: 0 0 10px rgba(0, 255, 136, 0.7);
        animation: ibxPing 1.6s ease-in-out infinite;
    }
    html.light-theme .ibx-live { background: #059669; box-shadow: 0 0 10px rgba(5, 150, 105, 0.6); }
    @keyframes ibxPing { 0%, 100% { opacity: 1; } 50% { opacity: 0.35; } }
    .ibx-path .sep { color: var(--text-muted, #64748b); }
    .ibx-path span:last-child { color: #00ff88; }
    html.light-theme .ibx-path span:last-child { color: #047857; }
    .ibx-back {
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-family: var(--mono); font-size: 0.75rem; letter-spacing: 1px;
        color: var(--text-secondary, #94a3b8);
        border: 1px solid var(--border-color);
        padding: 0.5rem 1.1rem; border-radius: 10px;
        transition: var(--transition);
    }
    .ibx-back:hover { color: var(--accent); border-color: var(--accent); transform: translateX(-3px); }

    .ibx-conv-head {
        position: relative;
        display: flex; align-items: center; gap: 1rem;
        padding: 1rem 1.4rem; margin-bottom: 1.2rem;
        background: rgba(6, 11, 20, 0.78);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }
    html.light-theme .ibx-conv-head { background: rgba(255, 255, 255, 0.92); }
    .ibx-conv-head::before {
        content: 'CHANNEL' ; position: absolute; right: 1.1rem; top: -8px;
        font-family: var(--mono); font-size: 0.56rem; letter-spacing: 3px;
        color: rgba(0, 217, 255, 0.2);
    }
    html.light-theme .ibx-conv-head::before { color: rgba(8, 145, 178, 0.2); }
    .ibx-avatar {
        width: 50px; height: 50px; min-width: 50px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-family: var(--mono); font-size: 0.9rem; font-weight: 700;
        color: #071018;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        border: 1px solid rgba(0, 217, 255, 0.3);
        box-shadow: 0 4px 14px rgba(0, 217, 255, 0.2);
    }
    html.light-theme .ibx-avatar { color: #fff; box-shadow: 0 4px 14px rgba(8, 145, 178, 0.18); }
    .ibx-conv-info { flex: 1; min-width: 0; }
    .ibx-conv-info h2 {
        font-size: 1.1rem; font-weight: 700; color: #f1f5f9; margin: 0;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    html.light-theme .ibx-conv-info h2 { color: #0f172a; }
    .ibx-conv-info .sub {
        font-family: var(--mono); font-size: 0.7rem; letter-spacing: 0.5px;
        color: var(--text-muted, #64748b); margin-top: 0.2rem;
    }
    .ibx-status {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-family: var(--mono); font-size: 0.7rem; font-weight: 700; letter-spacing: 1px;
        padding: 0.4rem 0.9rem; border-radius: 8px; flex-shrink: 0;
    }
    .ibx-status .st { animation: ibxPing 2s ease-in-out infinite; }
    .ibx-status.open { color: #00ff88; background: rgba(0, 255, 136, 0.07); border: 1px solid rgba(0, 255, 136, 0.2); }
    .ibx-status.closed { color: #f87171; background: rgba(248, 113, 113, 0.07); border: 1px solid rgba(248, 113, 113, 0.2); }
    html.light-theme .ibx-status.open { color: #059669; background: rgba(5, 150, 105, 0.07); border-color: rgba(5, 150, 105, 0.2); }
    html.light-theme .ibx-status.closed { color: #dc2626; background: rgba(220, 38, 38, 0.07); border-color: rgba(220, 38, 38, 0.2); }

    .ibx-meta-card {
        position: relative;
        background: rgba(6, 11, 20, 0.72);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 1.2rem 1.4rem 0.9rem;
        margin-bottom: 1.2rem;
        overflow: hidden;
        backdrop-filter: blur(10px);
    }
    html.light-theme .ibx-meta-card { background: rgba(255, 255, 255, 0.85); }
    .ibx-meta-card::after {
        content: ''; position: absolute; left: 0; right: 0; top: 0; height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        opacity: 0.5;
    }
    .ibx-meta-label {
        display: flex; align-items: center; gap: 0.55rem;
        font-family: var(--mono); font-size: 0.68rem; letter-spacing: 2px;
        color: var(--accent-light); margin-bottom: 0.9rem;
    }
    html.light-theme .ibx-meta-label { color: #0e7490; }
    .ibx-meta-label i { font-size: 0.85rem; }
    .ibx-meta-label .dot {
        margin-left: auto; width: 6px; height: 6px; border-radius: 50%;
        background: #00ff88; animation: ibxPing 1.8s ease-in-out infinite;
    }
    html.light-theme .ibx-meta-label .dot { background: #059669; }
    .ibx-meta-row {
        display: flex; gap: 1.2rem; align-items: baseline; flex-wrap: wrap;
        border-top: 1px dashed rgba(0, 217, 255, 0.12);
        padding: 0.55rem 0;
    }
    html.light-theme .ibx-meta-row { border-top-color: rgba(8, 145, 178, 0.12); }
    .ibx-meta-row:first-of-type { border-top: none; }
    .ibx-meta-row .k {
        font-family: var(--mono); font-size: 0.68rem; letter-spacing: 1px;
        color: var(--text-muted, #64748b); width: 120px; flex-shrink: 0;
    }
    .ibx-meta-row .v { flex: 1; min-width: 0; }
    .ibx-meta-row .v.name { font-size: 1.05rem; font-weight: 700; color: #f1f5f9; }
    html.light-theme .ibx-meta-row .v.name { color: #0f172a; }
    .ibx-meta-row .v.price { font-family: var(--mono); font-size: 1rem; font-weight: 700; color: var(--accent); }
    html.light-theme .ibx-meta-row .v.price { color: #0891b2; }
    .ibx-meta-row .v.details {
        width: 100%; font-size: 0.85rem; line-height: 1.65;
        color: var(--text-secondary, #94a3b8); white-space: pre-line;
    }
    .ibx-meta-row .v.gig { font-family: var(--mono); font-size: 0.8rem; color: #7ce6ff; }
    html.light-theme .ibx-meta-row .v.gig { color: #0e7490; }

    .ibx-msgs {
        position: relative;
        background: rgba(6, 11, 20, 0.58);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 1.4rem;
        max-height: 520px;
        overflow-y: auto;
        display: flex; flex-direction: column; gap: 1rem;
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
    }
    html.light-theme .ibx-msgs { background: rgba(255, 255, 255, 0.72); box-shadow: 0 20px 60px rgba(2, 32, 44, 0.08); }
    .ibx-msgs::-webkit-scrollbar { width: 5px; }
    .ibx-msgs::-webkit-scrollbar-track { background: transparent; }
    .ibx-msgs::-webkit-scrollbar-thumb { background: rgba(0, 217, 255, 0.25); border-radius: 3px; }
    html.light-theme .ibx-msgs::-webkit-scrollbar-thumb { background: rgba(8, 145, 178, 0.25); }

    .ibx-date {
        margin: 0.4rem 0; text-align: center; position: relative;
        font-family: var(--mono); font-size: 0.65rem; letter-spacing: 2px;
        color: var(--text-muted, #64748b);
    }
    .ibx-date::before {
        content: ''; position: absolute; top: 50%; left: 0; right: 0; height: 1px;
        background: var(--border-color);
    }
    .ibx-date span {
        position: relative; z-index: 1; display: inline-block;
        padding: 0.25rem 1rem;
        background: rgba(6, 11, 20, 0.9);
        border: 1px solid var(--border-color); border-radius: 20px;
    }
    html.light-theme .ibx-date span { background: #fff; }

    .ibx-msg { display: flex; gap: 0.75rem; max-width: 85%; animation: ibxIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; transform: translateY(10px); }
    .ibx-msg.incoming { align-self: flex-start; }
    .ibx-msg.outgoing { align-self: flex-end; flex-direction: row-reverse; }
    @keyframes ibxIn { to { opacity: 1; transform: translateY(0); } }
    .ibx-msg-avatar {
        width: 34px; height: 34px; min-width: 34px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-family: var(--mono); font-size: 0.78rem; font-weight: 700;
        color: #071018;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        border: 1px solid rgba(0, 217, 255, 0.3);
    }
    html.light-theme .ibx-msg-avatar { color: #fff; }
    .ibx-msg.outgoing .ibx-msg-avatar { background: linear-gradient(135deg, #0891b2, #059669); color: #fff; }
    .ibx-msg-bubble {
        padding: 0.7rem 1rem;
        border-radius: 14px;
        font-size: 0.92rem; line-height: 1.55; word-break: break-word;
        position: relative;
    }
    .ibx-msg.incoming .ibx-msg-bubble {
        background: rgba(0, 217, 255, 0.06);
        border: 1px solid var(--border-color);
        color: #f1f5f9;
        border-top-left-radius: 4px;
    }
    html.light-theme .ibx-msg.incoming .ibx-msg-bubble { color: #0f172a; background: rgba(8, 145, 178, 0.05); }
    .ibx-msg.outgoing .ibx-msg-bubble {
        background: rgba(0, 217, 255, 0.1);
        border: 1px solid rgba(0, 217, 255, 0.2);
        color: #f1f5f9;
        border-top-right-radius: 4px;
    }
    html.light-theme .ibx-msg.outgoing .ibx-msg-bubble {
        background: rgba(8, 145, 178, 0.08);
        border-color: rgba(8, 145, 178, 0.2);
        color: #0f172a;
    }
    .ibx-msg-label {
        display: flex; align-items: center; gap: 0.35rem;
        font-family: var(--mono); font-size: 0.64rem; font-weight: 700; letter-spacing: 1px;
        margin-bottom: 0.3rem;
    }
    .ibx-msg.incoming .ibx-msg-label { color: #00ff88; }
    .ibx-msg.outgoing .ibx-msg-label { color: var(--accent); }
    html.light-theme .ibx-msg.incoming .ibx-msg-label { color: #059669; }
    html.light-theme .ibx-msg.outgoing .ibx-msg-label { color: #0891b2; }
    .ibx-msg-text { display: block; }
    .ibx-msg-bubble img {
        max-width: 260px; max-height: 260px;
        width: auto; height: auto;
        border-radius: 10px; margin-top: 0.4rem; display: block;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
    }
    .ibx-msg-time {
        display: block; font-family: var(--mono); font-size: 0.62rem; letter-spacing: 0.5px;
        color: var(--text-muted, #64748b); margin-top: 0.4rem; opacity: 0.8;
    }

    .ibx-empty-msgs {
        text-align: center; padding: 3rem 2rem; color: var(--text-muted, #64748b);
        font-family: var(--mono);
    }
    .ibx-empty-msgs i { font-size: 2.4rem; display: block; margin-bottom: 0.8rem; opacity: 0.5; }
    .ibx-empty-msgs p { font-size: 0.82rem; letter-spacing: 1px; }

    .ibx-form {
        position: relative;
        background: rgba(6, 11, 20, 0.78);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 1rem 1.2rem 1.2rem;
        margin-top: 1rem;
        overflow: visible;
        backdrop-filter: blur(10px);
        transition: var(--transition);
    }
    html.light-theme .ibx-form { background: rgba(255, 255, 255, 0.92); }
    .ibx-form:focus-within { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(0, 217, 255, 0.08); }
    html.light-theme .ibx-form:focus-within { box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1); }
    .ibx-form-bar {
        display: flex; align-items: center; gap: 0.5rem;
        font-family: var(--mono); font-size: 0.68rem; letter-spacing: 1.5px;
        color: var(--accent); margin-bottom: 0.8rem;
    }
    html.light-theme .ibx-form-bar { color: #0891b2; }
    .ibx-form-bar .cursor {
        width: 8px; height: 14px; background: var(--accent);
        animation: ibxBlink 1s step-end infinite;
    }
    html.light-theme .ibx-form-bar .cursor { background: #0891b2; }
    @keyframes ibxBlink { 50% { opacity: 0; } }

    .ibx-emoji {
        display: none; padding: 0.6rem 0.5rem 0.5rem;
        gap: 0.25rem; flex-wrap: wrap;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 0.75rem;
    }
    .ibx-emoji.open { display: flex; }
    .ibx-emoji button {
        background: none; border: none; font-size: 1.25rem; cursor: pointer;
        padding: 3px 5px; border-radius: 6px; line-height: 1;
        transition: background 0.2s, transform 0.2s;
    }
    .ibx-emoji button:hover { background: rgba(0, 217, 255, 0.1); transform: scale(1.2); }

    .ibx-preview {
        display: none; padding: 0.55rem 0;
        border-top: 1px solid var(--border-color); margin-top: 0.4rem;
        align-items: center; gap: 0.75rem;
    }
    .ibx-preview img { max-width: 90px; max-height: 90px; border-radius: 10px; border: 1px solid var(--border-color); object-fit: cover; }
    .ibx-preview .remove-image { color: #f87171; cursor: pointer; font-size: 0.8rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.3rem; }
    .ibx-preview .remove-image:hover { color: #ef4444; }

    .ibx-inputrow {
        display: flex; align-items: flex-end; gap: 0.55rem;
        border: 1.5px solid var(--border-color);
        border-radius: 14px;
        padding: 0.5rem 0.5rem 0.5rem 1rem;
        transition: var(--transition);
    }
    .ibx-inputrow:focus-within { border-color: var(--accent); }
    .ibx-inputrow .prompt { font-family: var(--mono); font-size: 0.95rem; font-weight: 700; color: var(--accent); padding-bottom: 0.35rem; }
    html.light-theme .ibx-inputrow .prompt { color: #0891b2; }
    .ibx-inputrow textarea {
        flex: 1; background: transparent; border: none; outline: none;
        color: #f1f5f9; font-size: 0.9rem; font-family: var(--mono);
        resize: none; min-height: 38px; max-height: 120px; padding: 0.4rem 0; line-height: 1.5;
    }
    html.light-theme .ibx-inputrow textarea { color: #0f172a; }
    .ibx-inputrow textarea::placeholder { color: var(--text-muted, #64748b); opacity: 0.7; }
    .ibx-btn {
        width: 42px; height: 42px; flex-shrink: 0;
        border-radius: 11px;
        border: 1.5px solid var(--border-color);
        background: rgba(255, 255, 255, 0.03);
        color: var(--text-secondary, #94a3b8);
        font-size: 1.1rem;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; padding: 0;
        transition: var(--transition); position: relative; overflow: hidden;
    }
    .ibx-btn:hover { border-color: var(--accent); color: var(--accent); background: rgba(0, 217, 255, 0.06); transform: translateY(-2px); }
    html.light-theme .ibx-btn:hover { background: rgba(8, 145, 178, 0.05); }
    .ibx-btn.image-btn input[type="file"] { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
    .ibx-send {
        width: 42px; height: 42px; flex-shrink: 0;
        border-radius: 11px; border: none;
        background: linear-gradient(135deg, #00d9ff, #0891b2);
        color: #fff; font-size: 1.1rem;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; padding: 0;
        box-shadow: 0 4px 15px rgba(0, 217, 255, 0.3);
        transition: var(--transition);
    }
    .ibx-send:hover { transform: translateY(-3px) scale(1.05); box-shadow: 0 8px 25px rgba(0, 217, 255, 0.4); }
    .ibx-send:active { transform: translateY(-1px) scale(0.98); }

    .ibx-closed {
        text-align: center; padding: 1.2rem;
        margin-top: 1rem;
        color: var(--text-muted, #64748b);
        background: rgba(6, 11, 20, 0.6);
        border: 1px solid var(--border-color); border-radius: 14px;
        font-family: var(--mono); font-size: 0.8rem; letter-spacing: 1px;
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
    }
    html.light-theme .ibx-closed { background: rgba(255, 255, 255, 0.8); }
    .ibx-closed i { color: #f87171; }
    html.light-theme .ibx-closed i { color: #dc2626; }

    .form-error { color: #f87171; font-size: 0.78rem; margin-top: 0.5rem; font-family: var(--mono); }
    html.light-theme .form-error { color: #dc2626; }

    @media (max-width: 768px) {
        .ibx-page { padding-top: 4.6rem; }
        .ibx-top { flex-direction: column; align-items: flex-start; gap: 0.8rem; }
        .ibx-msgs { max-height: 440px; padding: 1.1rem; }
        .ibx-msg { max-width: 92%; }
        .ibx-conv-head { padding: 0.85rem 1.1rem; }
        .ibx-meta-row .k { width: 90px; }
    }
    @media (max-width: 480px) {
        .ibx-page { padding-top: 4.2rem; }
        .ibx-msgs { max-height: 380px; padding: 0.9rem; }
        .ibx-msg { max-width: 95%; gap: 0.55rem; }
        .ibx-msg-avatar { width: 28px; height: 28px; min-width: 28px; font-size: 0.68rem; }
        .ibx-msg-bubble { padding: 0.6rem 0.85rem; font-size: 0.85rem; }
        .ibx-avatar { width: 42px; height: 42px; min-width: 42px; }
        .ibx-conv-info h2 { font-size: 0.95rem; }
        .ibx-status { font-size: 0.62rem; padding: 0.3rem 0.65rem; }
        .ibx-btn, .ibx-send { width: 38px; height: 38px; font-size: 1rem; }
    }
</style>

<div class="ibx-page">
    <div class="ibx-bg" aria-hidden="true">
        <div class="ibx-grid"></div>
        <div class="ibx-radar"></div>
        <div class="ibx-scan"></div>
        <div class="ibx-particle p1 mono">CHANNEL</div>
        <div class="ibx-particle p2 mono">0x7E3A</div>
        <div class="ibx-particle p3 mono">SECURE</div>
    </div>

    <div class="ibx-inner">
        <div class="ibx-top">
            <div class="ibx-path">
                <span class="ibx-live"></span>
                <span>HOME</span><span class="sep">/</span>
                <span>SECURE_CHANNEL</span><span class="sep">/</span>
                <span>CHANNEL_{{ str_pad($conversation->id, 3, '0', STR_PAD_LEFT) }}</span>
            </div>
            <a href="{{ route('inbox.index') }}" class="ibx-back"><i class="bi bi-arrow-left"></i> {{ __('messages.back_to_inbox') }}</a>
        </div>

        <div class="ibx-conv-head">
            <span class="ibx-avatar">#{{ str_pad($conversation->id, 3, '0', STR_PAD_LEFT) }}</span>
            <div class="ibx-conv-info">
                <h2>{{ $conversation->subject }}</h2>
                <div class="sub">
                    @if($conversation->gig)<i class="bi bi-layers me-1"></i>{{ $conversation->gig->title }} · @endif
                    {{ $conversation->messages->count() }} {{ $conversation->messages->count() === 1 ? __('messages.message') : __('messages.messages') }}
                </div>
            </div>
            <span class="ibx-status {{ $conversation->status }}">
                <span class="st">&#9679;</span> [{{ Str::upper($conversation->status) }}]
            </span>
        </div>

        @if($conversation->package_name)
        <div class="ibx-meta-card">
            <div class="ibx-meta-label">
                <i class="bi bi-box-seam"></i> {{ __('messages.package_details') }}<span class="dot"></span>
            </div>
            <div class="ibx-meta-row">
                <span class="k">PACKAGE</span>
                <span class="v name">{{ $conversation->package_name }}</span>
            </div>
            <div class="ibx-meta-row">
                <span class="k">PRICE</span>
                <span class="v price">$ {{ number_format($conversation->package_price, 2) }}</span>
            </div>
            @if($conversation->package_details)
            <div class="ibx-meta-row">
                <span class="k">SPECS</span>
                <span class="v details">{{ $conversation->package_details }}</span>
            </div>
            @endif
        </div>
        @endif

        <div class="ibx-msgs" id="messagesBox">
            @forelse($conversation->messages as $msg)
                @php $isMine = $msg->sender_id == auth()->id(); @endphp
                @if(!isset($prevDate) || $msg->created_at->format('Y-m-d') !== $prevDate)
                    <div class="ibx-date"><span>&mdash; {{ $msg->created_at->format('d M Y') }} &mdash;</span></div>
                    @php $prevDate = $msg->created_at->format('Y-m-d'); @endphp
                @endif
                <div class="ibx-msg {{ $isMine ? 'outgoing' : 'incoming' }}">
                    <span class="ibx-msg-avatar">{{ substr($msg->sender->name, 0, 1) }}</span>
                    <div class="ibx-msg-bubble">
                        <span class="ibx-msg-label">
                            @if($msg->sender->is_admin)
                                <i class="bi bi-shield-check"></i> SUPPORT
                            @elseif(!$isMine)
                                <i class="bi bi-person"></i> {{ $msg->sender->name }}
                            @else
                                <i class="bi bi-person-fill"></i> YOU
                            @endif
                        </span>
                        @if($msg->message)
                            <span class="ibx-msg-text">{!! nl2br(e($msg->message)) !!}</span>
                        @endif
                        @if($msg->image)
                            <img src="{{ config('app.storage_url') }}{{ $msg->image }}" alt="Shared image">
                        @endif
                        <span class="ibx-msg-time">{{ $msg->created_at->format('g:i A') }} &middot; {{ $msg->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <div class="ibx-empty-msgs">
                    <i class="bi bi-chat-dots"></i>
                    <p>{{ __('messages.no_messages_yet') }}</p>
                </div>
            @endforelse
        </div>

        @if($conversation->status == 'open')
        <form method="POST" action="{{ route('inbox.send', $conversation->id) }}" enctype="multipart/form-data" class="ibx-form">
            @csrf

            <div class="ibx-form-bar">
                composer &gt; echo &nbsp;--msg<span class="cursor"></span>
            </div>

            <div class="ibx-emoji" id="emojiPicker">
                <button type="button" onclick="insertEmoji('😊')">😊</button>
                <button type="button" onclick="insertEmoji('👍')">👍</button>
                <button type="button" onclick="insertEmoji('😍')">😍</button>
                <button type="button" onclick="insertEmoji('🎉')">🎉</button>
                <button type="button" onclick="insertEmoji('🔥')">🔥</button>
                <button type="button" onclick="insertEmoji('💯')">💯</button>
                <button type="button" onclick="insertEmoji('✅')">✅</button>
                <button type="button" onclick="insertEmoji('❓')">❓</button>
                <button type="button" onclick="insertEmoji('👋')">👋</button>
                <button type="button" onclick="insertEmoji('📸')">📸</button>
                <button type="button" onclick="insertEmoji('🚀')">🚀</button>
                <button type="button" onclick="insertEmoji('💪')">💪</button>
                <button type="button" onclick="insertEmoji('🙏')">🙏</button>
                <button type="button" onclick="insertEmoji('😎')">😎</button>
                <button type="button" onclick="insertEmoji('💰')">💰</button>
            </div>

            <div class="ibx-preview" id="imagePreview">
                <img id="previewImg" src="" alt="Preview">
                <span class="remove-image" onclick="clearImageInput()">
                    <i class="bi bi-x-circle"></i> {{ __('messages.remove') }}
                </span>
            </div>

            <div class="ibx-inputrow">
                <span class="prompt">&gt;_</span>
                <textarea name="message" id="messageInput" rows="1" placeholder="{{ __('messages.type_message') }}" autocomplete="off"></textarea>
                <button type="button" class="ibx-btn" onclick="toggleEmojiPicker()" title="Emoji">
                    <i class="bi bi-emoji-smile"></i>
                </button>
                <label class="ibx-btn image-btn" title="{{ __('messages.send_image') }}">
                    <i class="bi bi-image"></i>
                    <input type="file" name="image" accept="image/*" onchange="previewSelectedImage(event)">
                </label>
                <button type="submit" class="ibx-send" title="{{ __('messages.send') }}">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>

            @error('message')<div class="form-error">{{ $message }}</div>@enderror
            @error('image')<div class="form-error">{{ $message }}</div>@enderror
        </form>
        @else
            <div class="ibx-closed">
                <i class="bi bi-lock-fill"></i> {{ __('messages.conversation_closed') }}
            </div>
        @endif
    </div>
</div>

<script>
    function toggleEmojiPicker() {
        document.getElementById('emojiPicker').classList.toggle('open');
    }
    function insertEmoji(emoji) {
        const input = document.getElementById('messageInput');
        const start = input.selectionStart;
        const end = input.selectionEnd;
        input.value = input.value.substring(0, start) + emoji + input.value.substring(end);
        input.focus();
        input.selectionStart = input.selectionEnd = start + emoji.length;
        autoResize(input);
    }
    function previewSelectedImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'flex';
            };
            reader.readAsDataURL(file);
        }
    }
    function clearImageInput() {
        document.querySelector('input[name="image"]').value = '';
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('previewImg').src = '';
    }
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
    }
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('messageInput');
        if (textarea) {
            textarea.addEventListener('input', function() { autoResize(this); });
            textarea.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    this.closest('form').submit();
                }
            });
        }
        const box = document.getElementById('messagesBox');
        if (box) box.scrollTop = box.scrollHeight;
    });
</script>
@endsection