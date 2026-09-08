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
        position: absolute; left: 50%; top: 40%; width: 640px; height: 640px;
        transform: translate(-50%, -50%); border-radius: 50%;
        border: 1px solid rgba(0, 217, 255, 0.06);
        animation: ibxSpin 24s linear infinite;
    }
    .ibx-radar::before, .ibx-radar::after {
        content: ''; position: absolute; inset: 12%; border-radius: 50%;
        border: 1px solid rgba(0, 217, 255, 0.05);
    }
    .ibx-radar::after { inset: 28%; border-color: rgba(0, 217, 255, 0.04); }
    html.light-theme .ibx-radar { border-color: rgba(8, 145, 178, 0.08); }
    @keyframes ibxSpin { to { transform: translate(-50%, -50%) rotate(360deg); } }
    .ibx-scan {
        position: absolute; left: 0; right: 0; height: 160px; top: 0;
        background: linear-gradient(180deg, transparent, rgba(0, 217, 255, 0.04), transparent);
        animation: ibxScan 5s linear infinite;
    }
    html.light-theme .ibx-scan { background: linear-gradient(180deg, transparent, rgba(8, 145, 178, 0.05), transparent); }
    @keyframes ibxScan { 0% { top: -20%; } 100% { top: 120%; } }
    .ibx-particle {
        position: absolute; font-family: var(--mono); font-size: 0.66rem;
        letter-spacing: 1.5px; color: rgba(0, 217, 255, 0.4);
    }
    html.light-theme .ibx-particle { color: rgba(8, 145, 178, 0.4); }
    .ibx-particle.p1 { top: 16%; left: 8%; animation: ibxFloat 7s ease-in-out infinite; }
    .ibx-particle.p2 { top: 22%; right: 10%; animation: ibxFloat 9s ease-in-out infinite; animation-delay: 1.2s; }
    .ibx-particle.p3 { bottom: 18%; left: 14%; animation: ibxFloat 8s ease-in-out infinite; animation-delay: 0.6s; }
    .ibx-particle.p4 { bottom: 26%; right: 12%; animation: ibxFloat 10s ease-in-out infinite; animation-delay: 1.8s; }
    @keyframes ibxFloat { 0%, 100% { transform: translateY(0); opacity: 0.5; } 50% { transform: translateY(-14px); opacity: 1; } }

    .ibx-inner {
        position: relative; z-index: 2;
        max-width: 980px; margin: 0 auto;
    }

    .ibx-top {
        display: flex; align-items: center; justify-content: space-between;
        gap: 1rem; margin-bottom: 2rem;
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

    .ibx-head {
        display: flex; align-items: flex-end; gap: 1.1rem;
        margin-bottom: 1.8rem; flex-wrap: wrap;
    }
    .ibx-headicon {
        width: 52px; height: 52px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; color: #071018;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        box-shadow: 0 10px 30px rgba(0, 217, 255, 0.25);
    }
    html.light-theme .ibx-headicon { color: #fff; box-shadow: 0 10px 30px rgba(8, 145, 178, 0.22); }
    .ibx-title {
        font-size: 2rem; font-weight: 800; letter-spacing: -0.5px;
        color: #f1f5f9; margin: 0;
    }
    html.light-theme .ibx-title { color: #0f172a; }
    .ibx-count {
        margin-left: auto; font-family: var(--mono); font-size: 0.72rem;
        letter-spacing: 1px; color: #00ff88;
        border: 1px solid rgba(0, 255, 136, 0.25);
        background: rgba(0, 255, 136, 0.06);
        padding: 0.45rem 1rem; border-radius: 20px; white-space: nowrap;
    }
    html.light-theme .ibx-count { color: #059669; border-color: rgba(5, 150, 105, 0.25); background: rgba(5, 150, 105, 0.06); }

    .ibx-search {
        position: relative; margin-bottom: 1.8rem;
        display: flex; align-items: center;
        background: rgba(6, 11, 20, 0.78);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        backdrop-filter: blur(10px);
        transition: var(--transition);
    }
    html.light-theme .ibx-search { background: rgba(255, 255, 255, 0.92); }
    .ibx-search:focus-within { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(0, 217, 255, 0.08); }
    html.light-theme .ibx-search:focus-within { box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.08); }
    .ibx-prompt {
        font-family: var(--mono); font-size: 0.9rem; font-weight: 700;
        color: var(--accent); padding: 0 0 0 1.2rem; flex-shrink: 0;
    }
    html.light-theme .ibx-prompt { color: #0891b2; }
    .ibx-search .search-icon { color: var(--text-muted, #64748b); font-size: 0.85rem; margin-left: 0.7rem; }
    .ibx-search input {
        flex: 1; background: transparent; border: none; outline: none;
        padding: 0.95rem 1.2rem; color: #f1f5f9;
        font-size: 0.9rem; font-family: var(--mono);
    }
    html.light-theme .ibx-search input { color: #0f172a; }
    .ibx-search input::placeholder { color: var(--text-muted, #64748b); opacity: 0.7; }

    .ibx-panel {
        position: relative;
        background: rgba(6, 11, 20, 0.58);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: hidden;
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
    }
    html.light-theme .ibx-panel { background: rgba(255, 255, 255, 0.72); box-shadow: 0 20px 60px rgba(2, 32, 44, 0.08); }
    .ibx-panel-bar {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.7rem 1.2rem;
        border-bottom: 1px solid var(--border-color);
        background: rgba(0, 217, 255, 0.03);
    }
    html.light-theme .ibx-panel-bar { background: rgba(8, 145, 178, 0.04); }
    .ibx-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; }
    .ibx-dot.r { background: #f43f5e; } .ibx-dot.y { background: #f59e0b; } .ibx-dot.g { background: #00ff88; }
    html.light-theme .ibx-dot.r { background: #dc2626; }
    html.light-theme .ibx-dot.y { background: #b45309; }
    html.light-theme .ibx-dot.g { background: #059669; }
    .ibx-panel-title {
        font-family: var(--mono); font-size: 0.72rem; letter-spacing: 1px;
        color: #7ce6ff; margin-left: 0.4rem;
    }
    html.light-theme .ibx-panel-title { color: #0e7490; }
    .ibx-panel-right {
        margin-left: auto; font-family: var(--mono); font-size: 0.68rem;
        letter-spacing: 1px; color: var(--text-muted, #64748b);
    }
    .ibx-panel-right .dot { display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: #00ff88; margin-right: 0.4rem; animation: ibxPing 1.6s ease-in-out infinite; }
    html.light-theme .ibx-panel-right .dot { background: #059669; }
    .ibx-panel-body { padding: 0.9rem; }

    .ibx-item {
        position: relative; display: flex; align-items: center; gap: 1rem;
        padding: 1rem 1.2rem; margin-bottom: 0.6rem;
        background: rgba(6, 11, 20, 0.78);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
        text-decoration: none;
        transition: var(--transition);
    }
    html.light-theme .ibx-item { background: rgba(255, 255, 255, 0.92); }
    .ibx-item:last-child { margin-bottom: 0; }
    .ibx-item:hover {
        border-color: var(--accent);
        transform: translateX(5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25), 0 0 18px rgba(0, 217, 255, 0.05);
        text-decoration: none;
    }
    html.light-theme .ibx-item:hover { box-shadow: 0 10px 30px rgba(2, 32, 44, 0.1), 0 0 18px rgba(8, 145, 178, 0.12); }
    .ibx-item-accent {
        position: absolute; left: 0; top: 50%; transform: translateY(-50%) scaleY(0);
        width: 3px; height: 60%;
        background: linear-gradient(180deg, #00d9ff, #00ff88);
        border-radius: 0 3px 3px 0;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    html.light-theme .ibx-item-accent { background: linear-gradient(180deg, #0891b2, #059669); }
    .ibx-item:hover .ibx-item-accent, .ibx-item.open .ibx-item-accent { transform: translateY(-50%) scaleY(1); }

    .ibx-avatar {
        width: 48px; height: 48px; min-width: 48px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-family: var(--mono); font-size: 0.85rem; font-weight: 700;
        color: #071018;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        border: 1px solid rgba(0, 217, 255, 0.3);
        box-shadow: 0 4px 14px rgba(0, 217, 255, 0.2);
    }
    html.light-theme .ibx-avatar { color: #fff; box-shadow: 0 4px 14px rgba(8, 145, 178, 0.18); }
    .ibx-item:hover .ibx-avatar { transform: scale(1.06) rotate(-3deg); }

    .ibx-info { flex: 1; min-width: 0; }
    .ibx-subject {
        display: flex; align-items: center; gap: 0.6rem;
        font-size: 0.98rem; font-weight: 650; color: #f1f5f9;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 0.2rem;
    }
    html.light-theme .ibx-subject { color: #0f172a; }
    .ibx-led {
        width: 7px; height: 7px; border-radius: 50%; background: #00ff88; flex-shrink: 0;
        box-shadow: 0 0 8px rgba(0, 255, 136, 0.6); animation: ibxPing 1.8s ease-in-out infinite;
    }
    html.light-theme .ibx-led { background: #059669; box-shadow: 0 0 8px rgba(5, 150, 105, 0.5); }
    .ibx-preview {
        font-size: 0.82rem; color: var(--text-secondary, #94a3b8);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 0;
    }
    .ibx-meta { flex-shrink: 0; text-align: right; display: flex; flex-direction: column; align-items: flex-end; gap: 0.4rem; }
    .ibx-time {
        font-family: var(--mono); font-size: 0.68rem; letter-spacing: 0.5px;
        color: var(--text-muted, #64748b); white-space: nowrap;
    }
    .ibx-status {
        display: inline-flex; align-items: center; gap: 0.3rem;
        font-family: var(--mono); font-size: 0.68rem; font-weight: 700; letter-spacing: 1px;
        padding: 0.3rem 0.75rem; border-radius: 8px;
    }
    .ibx-status .st { animation: ibxPing 2s ease-in-out infinite; }
    .ibx-status.open { color: #00ff88; background: rgba(0, 255, 136, 0.07); border: 1px solid rgba(0, 255, 136, 0.2); }
    .ibx-status.closed { color: #f87171; background: rgba(248, 113, 113, 0.07); border: 1px solid rgba(248, 113, 113, 0.2); }
    html.light-theme .ibx-status.open { color: #059669; background: rgba(5, 150, 105, 0.07); border-color: rgba(5, 150, 105, 0.2); }
    html.light-theme .ibx-status.closed { color: #dc2626; background: rgba(220, 38, 38, 0.07); border-color: rgba(220, 38, 38, 0.2); }

    .ibx-empty { text-align: center; padding: 4.5rem 2rem; }
    .ibx-empty-radar {
        position: relative; width: 130px; height: 130px; margin: 0 auto 1.6rem;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
    }
    .ibx-empty-radar::before, .ibx-empty-radar::after {
        content: ''; position: absolute; border-radius: 50%; border: 1px solid rgba(0, 217, 255, 0.12);
    }
    html.light-theme .ibx-empty-radar::before, html.light-theme .ibx-empty-radar::after { border-color: rgba(8, 145, 178, 0.14); }
    .ibx-empty-radar::before { inset: 15%; animation: ibxSpin 8s linear infinite; }
    .ibx-empty-radar::after { inset: 30%; animation: ibxSpin 8s linear infinite reverse; }
    .ibx-empty-radar .radar-core {
        width: 46px; height: 46px; border-radius: 50%;
        background: rgba(0, 217, 255, 0.08); border: 1px solid rgba(0, 217, 255, 0.2);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; color: var(--accent);
    }
    html.light-theme .ibx-empty-radar .radar-core { background: rgba(8, 145, 178, 0.06); }
    .ibx-empty h3 {
        font-size: 1.25rem; font-weight: 700; color: #f1f5f9; margin-bottom: 0.4rem;
        font-family: var(--mono); letter-spacing: 0.5px;
    }
    html.light-theme .ibx-empty h3 { color: #0f172a; }
    .ibx-empty .tag { font-family: var(--mono); font-size: 0.62rem; letter-spacing: 2px; color: #f43f5e; margin-bottom: 0.8rem; }
    html.light-theme .ibx-empty .tag { color: #dc2626; }
    .ibx-empty p { color: var(--text-secondary, #94a3b8); font-size: 0.9rem; margin-bottom: 1.8rem; }
    .ibx-empty .btn-browse {
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-family: var(--mono); font-size: 0.78rem; font-weight: 700; letter-spacing: 1px;
        color: #071018;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        border: none; padding: 0.8rem 1.8rem; border-radius: 12px;
        cursor: pointer; transition: var(--transition);
        box-shadow: 0 8px 25px rgba(0, 217, 255, 0.25);
    }
    html.light-theme .ibx-empty .btn-browse { color: #fff; box-shadow: 0 8px 25px rgba(8, 145, 178, 0.2); }
    .ibx-empty .btn-browse:hover { transform: translateY(-3px); box-shadow: 0 12px 35px rgba(0, 217, 255, 0.35); color: #071018; }
    html.light-theme .ibx-empty .btn-browse:hover { color: #fff; box-shadow: 0 12px 35px rgba(8, 145, 178, 0.3); }
    .ibx-empty .btn-clear {
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-family: var(--mono); font-size: 0.78rem; letter-spacing: 1px;
        color: var(--accent); background: rgba(0, 217, 255, 0.05);
        border: 1px solid var(--border-color);
        padding: 0.8rem 1.8rem; border-radius: 12px;
        cursor: pointer; transition: var(--transition);
    }
    html.light-theme .ibx-empty .btn-clear { background: rgba(8, 145, 178, 0.05); }
    .ibx-empty .btn-clear:hover { border-color: var(--accent); transform: translateY(-3px); }

    .ibx-item { animation: ibxIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; transform: translateY(16px); }
    .ibx-item:nth-child(1) { animation-delay: 0.03s; }
    .ibx-item:nth-child(2) { animation-delay: 0.07s; }
    .ibx-item:nth-child(3) { animation-delay: 0.11s; }
    .ibx-item:nth-child(4) { animation-delay: 0.15s; }
    .ibx-item:nth-child(5) { animation-delay: 0.19s; }
    .ibx-item:nth-child(6) { animation-delay: 0.23s; }
    .ibx-item:nth-child(7) { animation-delay: 0.27s; }
    .ibx-item:nth-child(8) { animation-delay: 0.31s; }
    @keyframes ibxIn { to { opacity: 1; transform: translateY(0); } }

    @media (max-width: 768px) {
        .ibx-page { padding-top: 4.6rem; }
        .ibx-title { font-size: 1.5rem; }
        .ibx-headicon { width: 44px; height: 44px; font-size: 1.15rem; }
        .ibx-item { padding: 0.85rem 0.9rem; }
        .ibx-avatar { width: 40px; height: 40px; min-width: 40px; font-size: 0.72rem; }
        .ibx-subject { font-size: 0.88rem; }
        .ibx-preview { font-size: 0.76rem; }
        .ibx-top { flex-direction: column; align-items: flex-start; gap: 0.8rem; }
        .ibx-count { margin-left: 0; }
    }
    @media (max-width: 480px) {
        .ibx-page { padding-top: 4.2rem; }
        .ibx-avatar { width: 34px; height: 34px; min-width: 34px; border-radius: 9px; }
        .ibx-status { font-size: 0.6rem; padding: 0.22rem 0.55rem; }
        .ibx-time { font-size: 0.62rem; }
        .ibx-meta { gap: 0.25rem; }
        .ibx-panel-body { padding: 0.6rem; }
        .ibx-empty { padding: 3rem 1.2rem; }
    }
</style>

<div class="ibx-page">
    <div class="ibx-bg" aria-hidden="true">
        <div class="ibx-grid"></div>
        <div class="ibx-radar"></div>
        <div class="ibx-scan"></div>
        <div class="ibx-particle p1 mono">MSG_QUEUE</div>
        <div class="ibx-particle p2 mono">0x1B0X</div>
        <div class="ibx-particle p3 mono">LINK_OPEN</div>
        <div class="ibx-particle p4 mono">SEC</div>
    </div>

    <div class="ibx-inner">
        <div class="ibx-top">
            <div class="ibx-path">
                <span class="ibx-live"></span>
                <span>HOME</span><span class="sep">/</span>
                <span>SECURE_CHANNEL</span><span class="sep">/</span>
                <span>INBOX</span>
            </div>
            <a href="{{ route('home') }}" class="ibx-back"><i class="bi bi-arrow-left"></i> {{ __('messages.back') }}</a>
        </div>

        <div class="ibx-head">
            <span class="ibx-headicon"><i class="bi bi-chat-dots"></i></span>
            <h1 class="ibx-title">{{ __('messages.inbox') }}</h1>
            <span class="ibx-count" id="convCount">{{ $conversations->count() }} {{ $conversations->count() === 1 ? __('messages.conversation') : __('messages.conversations_count') }}</span>
        </div>

        <div class="ibx-search">
            <span class="ibx-prompt">></span>
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="inboxSearch" placeholder="{{ __('messages.search_conversations') }}" oninput="filterConversations(this.value)">
        </div>

        <div class="ibx-panel">
            <div class="ibx-panel-bar">
                <span class="ibx-dot r"></span><span class="ibx-dot y"></span><span class="ibx-dot g"></span>
                <span class="ibx-panel-title">incoming_transmissions.log</span>
                <span class="ibx-panel-right"><span class="dot"></span><span id="liveStatus">SYNC</span></span>
            </div>
            <div class="ibx-panel-body">
                @if($conversations->isEmpty())
                    <div class="ibx-empty">
                        <div class="ibx-empty-radar">
                            <span class="radar-core"><i class="bi bi-envelope-open"></i></span>
                        </div>
                        <div class="tag">NO_SIGNAL</div>
                        <h3>{{ __('messages.no_conversations') }}</h3>
                        <p>{{ __('messages.no_conversations_desc') }}</p>
                        <a href="{{ route('home') }}" class="btn-browse">
                            <i class="bi bi-house-fill"></i> {{ __('messages.browse_gigs') }}
                        </a>
                    </div>
                @else
                    <div id="conversationList">
                        @foreach($conversations as $conv)
                            <a href="{{ route('inbox.show', $conv->id) }}"
                               class="ibx-item {{ $conv->status }}"
                               data-search="{{ Str::lower($conv->subject) }} {{ Str::lower($conv->lastMessage ? ($conv->lastMessage->message ?? '') : '') }}">
                                <span class="ibx-item-accent"></span>
                                <span class="ibx-avatar">#{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="ibx-info">
                                    <span class="ibx-subject">
                                        {{ $conv->subject }}
                                        @if($conv->status == 'open')<span class="ibx-led"></span>@endif
                                    </span>
                                    <p class="ibx-preview">{{ $conv->lastMessage ? Str::limit(strip_tags($conv->lastMessage->message ?? ''), 70) : '' }}</p>
                                </span>
                                <span class="ibx-meta">
                                    <span class="ibx-time">{{ $conv->updated_at->diffForHumans() }}</span>
                                    <span class="ibx-status {{ $conv->status }}">
                                        <span class="st">&#9679;</span> [{{ Str::upper($conv->status) }}]
                                    </span>
                                </span>
                            </a>
                        @endforeach
                    </div>

                    <div class="ibx-empty" id="noResultsState" style="display:none;">
                        <div class="ibx-empty-radar">
                            <span class="radar-core"><i class="bi bi-search"></i></span>
                        </div>
                        <div class="tag">NO_MATCH</div>
                        <h3>{{ __('messages.no_results_found') }}</h3>
                        <p>{{ __('messages.search_conversations') }}</p>
                        <button type="button" onclick="document.getElementById('inboxSearch').value=''; filterConversations('');" class="btn-clear">
                            <i class="bi bi-x-lg"></i> {{ __('messages.clear') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function filterConversations(query) {
        const items = document.querySelectorAll('.ibx-item');
        const noResults = document.getElementById('noResultsState');
        const lowerQuery = query.toLowerCase().trim();
        let visibleCount = 0;

        items.forEach(item => {
            const searchData = item.getAttribute('data-search') || '';
            if (searchData.includes(lowerQuery)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (noResults) {
            noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        const countEl = document.getElementById('convCount');
        if (countEl) {
            countEl.textContent = visibleCount + ' ' + (visibleCount === 1 ? '{{ __("messages.conversation") }}' : '{{ __("messages.conversations_count") }}');
        }

        const live = document.getElementById('liveStatus');
        if (live) live.textContent = visibleCount === 0 ? 'NO_MATCH' : 'SYNC';
    }
</script>
@endsection