<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ config('app.name', 'Portfolio') }} | {{ __('Sign In') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <script>
        if (localStorage.getItem('theme') === 'light') document.documentElement.classList.add('light-theme');
    </script>

    <style>
        :root {
            --accent: #2dd4bf;
            --accent-strong: #14b8a6;
            --accent-soft: rgba(45, 212, 191, 0.12);
            --bg: #0a0f1c;
            --bg-alt: #0d1322;
            --card: rgba(15, 23, 42, 0.72);
            --line: rgba(148, 163, 184, 0.14);
            --line-hi: rgba(148, 163, 184, 0.28);
            --txt: #f1f5f9;
            --txt-dim: #94a3b8;
            --txt-mute: #64748b;
            --danger: #f87171;
        }
        html.light-theme {
            --accent: #0d9488;
            --accent-strong: #0f766e;
            --accent-soft: rgba(13, 148, 136, 0.1);
            --bg: #f4f6fb;
            --bg-alt: #eef1f8;
            --card: rgba(255, 255, 255, 0.85);
            --line: rgba(15, 23, 42, 0.1);
            --line-hi: rgba(15, 23, 42, 0.22);
            --txt: #0f172a;
            --txt-dim: #475569;
            --txt-mute: #94a3b8;
            --danger: #dc2626;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { min-height: 100%; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--txt);
            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: transparent;
        }
        .mono { font-family: 'JetBrains Mono', monospace; }

        a { text-decoration: none; }

        /* ==================== LAYOUT ==================== */
        .page {
            position: relative;
            display: flex;
            min-height: 100vh;
            min-height: 100dvh;
            background:
                radial-gradient(700px 500px at 100% 0%, rgba(45, 212, 191, 0.06), transparent 60%),
                var(--bg);
        }
        html.light-theme .page {
            background:
                radial-gradient(700px 500px at 100% 0%, rgba(13, 148, 136, 0.05), transparent 60%),
                var(--bg);
        }

        /* live cipher-rain backdrop */
        .rain {
            position: absolute; inset: 0; z-index: 0;
            pointer-events: none;
        }

        /* ---- Left panel ---- */
        .aside {
            position: relative;
            flex: 1;
            display: none;
            flex-direction: column;
            padding: 3rem 3.5rem;
            overflow: hidden;
            background:
                radial-gradient(1000px 600px at 110% -10%, rgba(45, 212, 191, 0.14), transparent 60%),
                radial-gradient(900px 700px at -20% 110%, rgba(56, 189, 248, 0.1), transparent 60%),
                var(--bg-alt);
        }
        @media (min-width: 992px) { .aside { display: flex; } }

        /* subtle grid backdrop */
        .aside::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(rgba(148, 163, 184, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, 0.05) 1px, transparent 1px);
            background-size: 48px 48px;
            -webkit-mask-image: radial-gradient(ellipse 90% 90% at 60% 30%, #000, transparent 80%);
            mask-image: radial-gradient(ellipse 90% 90% at 60% 30%, #000, transparent 80%);
        }

        /* drifting glow orb (subtle) */
        .aside .orb {
            position: absolute;
            width: 420px; height: 420px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(45, 212, 191, 0.16), transparent 65%);
            top: 18%; left: -120px;
            filter: blur(20px);
            animation: orbDrift 16s ease-in-out infinite;
        }
        html.light-theme .aside .orb { background: radial-gradient(circle, rgba(13, 148, 136, 0.14), transparent 65%); }
        .aside .orb.orb2 { top: auto; bottom: -160px; left: 40%; width: 500px; height: 500px; animation-delay: -8s; background: radial-gradient(circle, rgba(56, 189, 248, 0.12), transparent 65%); }
        @keyframes orbDrift {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(60px, 40px) scale(1.08); }
        }

        .aside .brand {
            position: relative; z-index: 2;
            display: flex; align-items: center; gap: 0.75rem;
        }
        .aside .brand-badge {
            width: 42px; height: 42px; border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, var(--accent), #0891b2);
            color: #04211c; font-size: 1.25rem;
            box-shadow: 0 8px 24px rgba(45, 212, 191, 0.25);
        }
        html.light-theme .aside .brand-badge { color: #fff; }
        .aside .brand-name { font-weight: 700; font-size: 1.05rem; letter-spacing: -0.02em; }
        .aside .brand-sub { font-size: 0.72rem; color: var(--txt-mute); }

        .aside .claims { position: relative; z-index: 2; max-width: 420px; margin-top: 4.5rem; margin-bottom: 0.5rem; }
        .aside .claims h2 {
            font-size: 2rem; font-weight: 600; line-height: 1.25;
            letter-spacing: -0.03em; margin-bottom: 1rem;
        }
        .aside .claims h2 em { font-style: normal; color: var(--accent); }
        .aside .claims p { color: var(--txt-dim); font-size: 0.95rem; line-height: 1.7; margin-bottom: 1.75rem; }

        .aside .points { display: flex; flex-direction: column; gap: 0.9rem; }
        .aside .point { display: flex; align-items: center; gap: 0.7rem; font-size: 0.88rem; color: var(--txt-dim); transition: color .25s, transform .25s; }
        .aside .point i { color: var(--accent); font-size: 1rem; transition: transform .25s; }
        .aside .point:hover { color: var(--txt); transform: translateX(4px); }
        .aside .point:hover i { transform: scale(1.2); }

        .aside .foot {
            position: relative; z-index: 2; margin-top: 2.6rem;
            display: inline-flex; align-items: center; gap: 0.6rem;
            font-family: 'JetBrains Mono', monospace; font-size: 0.68rem;
            letter-spacing: 0.06em; color: var(--txt-mute);
            border-top: 1px solid var(--line);
            padding-top: 1.3rem;
            max-width: 420px;
        }
        .aside .foot .dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: var(--accent);
            animation: pulse 2.4s ease-in-out infinite;
        }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.35; } }

        /* ---- Right panel ---- */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            padding: max(3rem, env(safe-area-inset-top)) 1.5rem max(3rem, env(safe-area-inset-bottom));
            position: relative;
            background: transparent;
        }

        .theme-toggle {
            position: absolute;
            top: max(1.1rem, env(safe-area-inset-top)); right: max(1.1rem, env(safe-area-inset-right));
            width: 40px; height: 40px;
            border-radius: 10px;
            border: 1px solid var(--line);
            background: var(--card);
            color: var(--txt-dim);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 1rem; z-index: 5;
            transition: color .25s, border-color .25s, box-shadow .25s;
        }
        .theme-toggle:hover { color: var(--accent); border-color: var(--line-hi); }

        .card-wrap { width: 100%; max-width: 400px; margin: auto; }

        .card {
            width: 100%;
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 2.4rem 2rem 2rem;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.28);
            animation: rise 0.55s cubic-bezier(0.16, 1, 0.3, 1);
        }
        html.light-theme .card { box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08); }
        html.light-theme .card:hover { box-shadow: 0 28px 70px rgba(15, 23, 42, 0.12); }
        @keyframes rise { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
        .card:hover {
            border-color: rgba(45, 212, 191, 0.28);
            box-shadow: 0 28px 70px rgba(0, 0, 0, 0.34), 0 0 0 1px rgba(45, 212, 191, 0.05);
        }

        /* periodic security scan sweep across the card */
        .sweep {
            position: absolute; left: 4%; right: 4%; top: -30%;
            height: 34%;
            background: linear-gradient(180deg, transparent, rgba(45, 212, 191, 0.05), rgba(45, 212, 191, 0.09), transparent);
            border-bottom: 1px solid rgba(45, 212, 191, 0.12);
            animation: sweepPass 7s ease-in-out infinite;
            pointer-events: none;
        }
        html.light-theme .sweep {
            background: linear-gradient(180deg, transparent, rgba(13, 148, 136, 0.05), rgba(13, 148, 136, 0.09), transparent);
            border-bottom-color: rgba(13, 148, 136, 0.14);
        }
        @keyframes sweepPass {
            0%, 55% { transform: translateY(0); opacity: 0; }
            62%, 66% { opacity: 1; }
            95%, 100% { transform: translateY(500px); opacity: 0; }
        }

        .card { overflow: hidden; }

        .card-header { text-align: center; margin-bottom: 1.9rem; }
        .mark-wrap { position: relative; width: 56px; height: 56px; margin: 0 auto 1.1rem; }
        .mark-wrap .ping {
            position: absolute; inset: -6px; border-radius: 18px;
            border: 1px solid rgba(45, 212, 191, 0.35);
            animation: sonar 3.2s cubic-bezier(0, 0.6, 0.4, 1) infinite;
            pointer-events: none;
        }
        .mark-wrap .ping.ping2 { animation-delay: 1.6s; }
        html.light-theme .mark-wrap .ping { border-color: rgba(13, 148, 136, 0.35); }
        @keyframes sonar {
            0% { transform: scale(0.7); opacity: 0; }
            35% { opacity: 0.9; }
            100% { transform: scale(1.6); opacity: 0; }
        }
        .card-header .mark {
            width: 56px; height: 56px;
            border-radius: 15px;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, var(--accent), #0891b2);
            color: #04211c; font-size: 1.6rem;
            box-shadow: 0 10px 28px rgba(45, 212, 191, 0.28);
            animation: float 5s ease-in-out infinite;
        }
        html.light-theme .card-header .mark { color: #fff; }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-5px); } }
        .mark:hover { animation: none; transform: scale(1.06) rotate(-3deg); box-shadow: 0 14px 34px rgba(45, 212, 191, 0.4); }
        .card-header h1 { font-size: 1.5rem; font-weight: 700; letter-spacing: -0.02em; color: #fff; }
        html.light-theme .card-header h1 { color: #0f172a; }
        .card-header p { color: var(--txt-dim); font-size: 0.88rem; margin-top: 0.35rem; }

        /* fields */
        .field { margin-bottom: 1.1rem; }
        .field label {
            display: block;
            font-size: 0.78rem; font-weight: 600; color: var(--txt-dim);
            margin-bottom: 0.45rem;
            transition: color .2s;
        }
        .input-box { position: relative; }
        .input-box .icon {
            position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%);
            color: var(--txt-mute); font-size: 0.95rem; pointer-events: none;
            transition: color .2s;
        }
        .input-box input {
            width: 100%;
            height: 48px;
            background: transparent;
            border: 1px solid var(--line);
            border-radius: 11px;
            color: var(--txt);
            font-size: 0.92rem;
            font-family: inherit;
            padding: 0 2.6rem 0 2.55rem;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .input-box input::placeholder { color: var(--txt-mute); }
        .input-box:hover .icon { color: var(--txt-dim); }
        .input-box:hover input:not(:focus):not(:hover) { border-color: var(--line-hi); }
        .input-box input:hover { border-color: var(--accent); }
        .input-box:focus-within label, .field:focus-within > label { color: var(--accent); }
        .input-box:focus-within .icon { color: var(--accent); }
        .input-box:focus-within input { border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-soft); }

        .toggle-pass {
            position: absolute; right: 0.4rem; top: 50%; transform: translateY(-50%);
            width: 38px; height: 38px; border: none; background: transparent;
            color: var(--txt-mute); border-radius: 9px; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: color .2s;
        }
        .toggle-pass:hover { color: var(--accent); }

        .error-msg {
            display: flex; align-items: center; gap: 0.4rem;
            color: var(--danger); font-size: 0.78rem; margin-top: 0.45rem;
        }

        /* actions row */
        .actions {
            display: flex; align-items: center; justify-content: space-between;
            gap: 0.8rem; margin: 0.2rem 0 1.4rem;
        }
        .check { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; user-select: none; }
        .check input { position: absolute; opacity: 0; }
        .check .box {
            width: 17px; height: 17px; border-radius: 5px;
            border: 1.5px solid var(--line-hi);
            display: inline-flex; align-items: center; justify-content: center;
            color: #fff; font-size: 0.65rem; flex-shrink: 0;
            transition: all .2s;
        }
        .check input:checked + .box { background: var(--accent-strong); border-color: var(--accent-strong); }
        .check:hover .box { border-color: var(--accent); }
        .check:hover span { color: var(--txt); }
        .forgot { font-size: 0.82rem; color: var(--txt-mute); font-weight: 500; transition: color .2s; }
        .forgot:hover { color: var(--accent); }

        /* button */
        .btn-submit {
            width: 100%; height: 50px;
            border: none; border-radius: 11px;
            background: linear-gradient(135deg, var(--accent-strong), #0891b2);
            color: #fff;
            font-size: 0.92rem; font-weight: 600; font-family: inherit;
            letter-spacing: 0.01em;
            display: flex; align-items: center; justify-content: center; gap: 0.55rem;
            cursor: pointer; position: relative; overflow: hidden;
            transition: transform .2s, box-shadow .25s, opacity .2s;
            box-shadow: 0 10px 26px rgba(20, 184, 166, 0.28);
        }
        html.light-theme .btn-submit { color: #fff; }
        .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 14px 32px rgba(20, 184, 166, 0.35); }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit:disabled { opacity: 0.75; cursor: wait; transform: none; }
        .btn-submit .loading { display: none; align-items: center; gap: 0.55rem; }
        .btn-submit.loading .label { display: none; }
        .btn-submit.loading .loading { display: inline-flex; }
        .spin {
            width: 17px; height: 17px; border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.5); border-top-color: #fff;
            animation: spin 0.7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* divider + signup */
        .divider {
            display: flex; align-items: center; gap: 1rem;
            margin: 1.6rem 0 1.3rem;
            color: var(--txt-mute); font-size: 0.72rem;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: var(--line);
        }
        .signup { text-align: center; }
        .signup p { font-size: 0.85rem; color: var(--txt-dim); }
        .signup a { color: var(--accent-strong); font-weight: 600; transition: opacity .2s; }
        .signup a:hover { opacity: 0.8; }

        /* security strip under button */
        .strip {
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            margin-top: 1.5rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.64rem; letter-spacing: 0.05em; color: var(--txt-mute);
        }
        .strip .lock { font-size: 0.72rem; color: var(--accent); }
        .strip::after {
            content: '▍'; margin-left: 2px;
            color: var(--accent); font-size: 0.8rem;
            animation: caretBlink 1.1s step-end infinite;
        }
        @keyframes caretBlink { 50% { opacity: 0; } }
        .enc-live {
            text-align: center; margin-top: 0.55rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.6rem; letter-spacing: 0.06em; color: var(--txt-mute);
            transition: color .2s;
        }
        .enc-live.busy { color: var(--accent); }

        /* autofill */
        input:-webkit-autofill {
            -webkit-text-fill-color: var(--txt);
            -webkit-box-shadow: 0 0 0 1000px var(--bg) inset;
            transition: background-color 5000s;
        }
        html.light-theme input:-webkit-autofill { -webkit-box-shadow: 0 0 0 1000px #fff inset; }

        /* mobile: show small logo above card */
        .mobile-brand { display: none; align-items: center; gap: 0.6rem; margin-bottom: 1.6rem; justify-content: center; }
        @media (max-width: 992px) {
            .mobile-brand { display: flex; }
        }
        .mobile-brand .brand-badge {
            width: 40px; height: 40px; border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, var(--accent), #0891b2);
            color: #04211c; font-size: 1.2rem;
        }
        html.light-theme .mobile-brand .brand-badge { color: #fff; }
        .mobile-brand .brand-name { font-weight: 700; letter-spacing: -0.02em; }
        .mobile-brand .brand-sub { font-size: 0.7rem; color: var(--txt-mute); }

        @media (max-width: 992px) {
            .aside { display: none; }
            .main { padding: max(4.5rem, env(safe-area-inset-top)) 1.5rem max(2.5rem, env(safe-area-inset-bottom)); }
        }
        @media (min-width: 993px) and (max-width: 1180px) {
            .aside { padding: 2.5rem 2.5rem; }
            .aside .claims h2 { font-size: 1.7rem; }
        }

        @media (max-width: 576px) {
            .main { padding: max(4.2rem, env(safe-area-inset-top)) 1rem max(2rem, env(safe-area-inset-bottom)); }
            .card { padding: 1.9rem 1.4rem 1.6rem; border-radius: 16px; }
            .card-header h1 { font-size: 1.4rem; }
            .card-header p { font-size: 0.84rem; }
            .mobile-brand { margin-bottom: 1.3rem; }
            .input-box input { height: 50px; font-size: 16px; }
            .btn-submit { height: 52px; font-size: 1rem; }
            .theme-toggle { width: 38px; height: 38px; top: max(0.9rem, env(safe-area-inset-top)); right: max(0.9rem, env(safe-area-inset-right)); font-size: 0.95rem; }
        }

        @media (max-width: 380px) {
            .main { padding: max(4rem, env(safe-area-inset-top)) 0.75rem max(1.6rem, env(safe-area-inset-bottom)); }
            .card { padding: 1.7rem 1.1rem 1.4rem; }
            .card-header .mark { width: 50px; height: 50px; font-size: 1.4rem; }
            .actions { flex-wrap: wrap; gap: 0.4rem; }
            .input-box input { padding-left: 2.4rem; }
            .input-box .icon { left: 0.75rem; }
            .strip { font-size: 0.56rem; }
            .mobile-brand .brand-badge { width: 36px; height: 36px; font-size: 1.05rem; }
        }

        @media (max-height: 540px) and (orientation: landscape) {
            .main { padding: 3rem 1.5rem; }
            .mobile-brand { margin-bottom: 1rem; }
            .card-header { margin-bottom: 1.2rem; }
            .card-header .mark { width: 44px; height: 44px; margin-bottom: 0.7rem; font-size: 1.2rem; }
            .field { margin-bottom: 0.8rem; }
        }

        /* touch feedback */
        @media (hover: none) {
            .btn-submit:hover, .theme-toggle:hover, .forgot:hover { transform: none; box-shadow: none; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.001s !important; transition-duration: 0.001s !important; }
        }
    </style>
</head>
<body>

    <div class="page">

        <!-- live cipher-rain backdrop -->
        <canvas class="rain" id="rain" aria-hidden="true"></canvas>
        <!-- ======= LEFT / BRAND PANEL ======= -->
        <aside class="aside">
            <div class="orb" aria-hidden="true"></div>
            <div class="orb orb2" aria-hidden="true"></div>

            <div class="brand">
                <div class="brand-badge"><i class="bi bi-shield-check"></i></div>
                <div>
                    <div class="brand-name">{{ config('app.name', 'SecureCore') }}</div>
                    <div class="brand-sub mono">{{ __('Identity & Access Management') }}</div>
                </div>
            </div>

            <div class="claims">
                <h2>{{ __('Secure access,') }} <em>{{ __('built for the modern web.') }}</em></h2>
                <p>{{ __('One account, every layer protected. Your session, devices and data stay safe behind enterprise-grade encryption.') }}</p>
                <div class="points">
                    <div class="point"><i class="bi bi-lock-fill"></i> {{ __('256-bit end-to-end encryption') }}</div>
                    <div class="point"><i class="bi bi-fingerprint"></i> {{ __('Multi-factor authentication ready') }}</div>
                    <div class="point"><i class="bi bi-activity"></i> {{ __('Real-time session monitoring') }}</div>
                    <div class="point"><i class="bi bi-file-earmark-lock2-fill"></i> {{ __('GDPR & HIPAA compliant') }}</div>
                </div>
            </div>

            <div class="foot"><span class="dot"></span> <span>SECURE CHANNEL · TLS 1.3 · ENCRYPTED</span></div>
        </aside>

        <!-- ======= RIGHT / FORM PANEL ======= -->
        <main class="main">
            <button type="button" class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
                <i class="bi bi-sun-fill"></i>
            </button>

            <div class="card-wrap">
                <div class="mobile-brand">
                    <div class="brand-badge"><i class="bi bi-shield-check"></i></div>
                    <div>
                        <div class="brand-name">{{ config('app.name', 'SecureCore') }}</div>
                        <div class="brand-sub mono">{{ __('Identity & Access Management') }}</div>
                    </div>
                </div>

                <div class="card">
                    <div class="sweep" aria-hidden="true"></div>
                    <div class="card-header">
                        <div class="mark-wrap">
                            <span class="ping" aria-hidden="true"></span>
                            <span class="ping ping2" aria-hidden="true"></span>
                            <div class="mark"><i class="bi bi-shield-lock"></i></div>
                        </div>
                        <h1>{{ __('Welcome back') }}</h1>
                        <p>{{ __('Sign in to continue to your account.') }}</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
                        @csrf

                        <!-- EMAIL -->
                        <div class="field">
                            <label for="email">{{ __('Email address') }}</label>
                            <div class="input-box">
                                <i class="bi bi-envelope icon"></i>
                                <input id="email" type="email"
                                       class="@error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}"
                                       placeholder="{{ __('you@example.com') }}"
                                       required autocomplete="email" autofocus
                                       aria-describedby="email-err">
                            </div>
                            @error('email')
                            <span class="error-msg" id="email-err" role="alert">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- PASSWORD -->
                        <div class="field">
                            <label for="password">{{ __('Password') }}</label>
                            <div class="input-box">
                                <i class="bi bi-shield-lock icon"></i>
                                <input id="password" type="password"
                                       class="@error('password') is-invalid @enderror"
                                       name="password"
                                       placeholder="••••••••"
                                       required autocomplete="current-password"
                                       aria-describedby="password-err"
                                       style="padding-right:2.8rem">
                                <button type="button" class="toggle-pass" id="eyeToggle" aria-label="{{ __('Toggle password visibility') }}">
                                    <i class="bi bi-eye" id="eyeOpen"></i>
                                    <i class="bi bi-eye-slash" id="eyeClosed" style="display:none"></i>
                                </button>
                            </div>
                            @error('password')
                            <span class="error-msg" id="password-err" role="alert">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- REMEMBER + FORGOT -->
                        <div class="actions">
                            <label class="check">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="box"><i class="bi bi-check-lg"></i></span>
                                <span>{{ __('Remember me') }}</span>
                            </label>
                            @if (Route::has('password.request'))
                            <a class="forgot" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                            @endif
                        </div>

                        <!-- SUBMIT -->
                        <button type="submit" class="btn-submit" id="loginBtn">
                            <span class="label">{{ __('Sign in') }}</span>
                            <span class="loading"><span class="spin"></span> {{ __('Signing in...') }}</span>
                        </button>
                    </form>

                    <div class="strip"><i class="bi bi-lock-fill lock"></i> <span id="stripStatus">ENCRYPTED · SESSION TRACKED</span></div>
                    <div class="enc-live mono" id="encLive">0x00000000 · KEYSIDE IDLE</div>

                    <div class="divider">{{ __('New here?') }}</div>

                    <div class="signup">
                        <p>
                            {{ __("Don't have an account?") }}
                            <a href="{{ route('register') }}">{{ __('Create one') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // ============ LIVE CIPHER RAIN ============
        var rainEl = document.getElementById('rain');
        var reduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (rainEl && !reduced && rainEl.getContext) {
            var ctx = rainEl.getContext('2d');
            var columns = [], STEP = 14, GLYPHS = '01ABCDEFADBEEF0123456789AC';
            function sizeRain() {
                var dpr = window.devicePixelRatio || 1;
                var w = rainEl.parentElement.clientWidth;
                var h = rainEl.parentElement.clientHeight;
                rainEl.width = w * dpr;
                rainEl.height = h * dpr;
                ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
                columns = [];
                var n = Math.max(20, Math.round(w / STEP));
                for (var i = 0; i < n; i++) {
                    columns.push({
                        x: i * STEP + (Math.random() * 5),
                        y: Math.random() * h,
                        s: 0.5 + Math.random() * 0.8,
                        a: 0.08 + Math.random() * 0.08
                    });
                }
            }
            function drawRain() {
                ctx.clearRect(0, 0, rainEl.width, rainEl.height);
                var h = rainEl.clientHeight;
                ctx.font = '11px "JetBrains Mono", monospace';
                var light = document.documentElement.classList.contains('light-theme');
                ctx.fillStyle = light ? 'rgba(13,148,136,0.7)' : 'rgba(45,212,191,0.7)';
                for (var i = 0; i < columns.length; i++) {
                    var c = columns[i];
                    ctx.globalAlpha = c.a;
                    ctx.fillText(GLYPHS.charAt(Math.floor(Math.random() * GLYPHS.length)), c.x, c.y);
                    c.y += c.s;
                    if (c.y > h + 16) { c.y = -12; c.s = 0.5 + Math.random() * 0.8; }
                }
                ctx.globalAlpha = 1;
                requestAnimationFrame(drawRain);
            }
            sizeRain();
            window.addEventListener('resize', sizeRain);
            drawRain();
        }

        // ============ LIVE KEYSTROKE ENCRYPTION READOUT ============
        var encLive = document.getElementById('encLive');
        var emailIn = document.getElementById('email');
        var passIn = document.getElementById('password');
        if (encLive && emailIn && passIn) {
            var encTimer = null, encIdle = null;
            function fnv(s) {
                var h = 2166136261;
                for (var i = 0; i < s.length; i++) {
                    h ^= s.charCodeAt(i);
                    h = Math.imul(h, 16777619);
                }
                return (h >>> 0);
            }
            function kickEnc() {
                if (encTimer) return;
                encLive.classList.add('busy');
                encTimer = setInterval(function () {
                    var val = emailIn.value + passIn.value;
                    if (val.length === 0) {
                        encLive.textContent = '0x00000000 · KEYSIDE IDLE';
                        return;
                    }
                    var h = fnv(val + Date.now());
                    var len = (val.length * 4) % 512;
                    encLive.textContent = '0x' + h.toString(16).toUpperCase().padStart(8, '0') + ' · ENC ' + val.length + ' BYTES';
                    if (len === 0) len = 512;
                }, 80);
                clearTimeout(encIdle);
            }
            function idleEnc() {
                clearTimeout(encIdle);
                encIdle = setTimeout(function () {
                    if (encTimer) { clearInterval(encTimer); encTimer = null; }
                    encLive.classList.remove('busy');
                }, 1500);
            }
            emailIn.addEventListener('input', function () { kickEnc(); idleEnc(); });
            passIn.addEventListener('input', function () { kickEnc(); idleEnc(); });
        }

        // password visibility
        var eyeToggle = document.getElementById('eyeToggle');
        if (eyeToggle) {
            eyeToggle.addEventListener('click', function () {
                var input = document.getElementById('password');
                var open = document.getElementById('eyeOpen');
                var closed = document.getElementById('eyeClosed');
                if (input.type === 'password') {
                    input.type = 'text';
                    open.style.display = 'none';
                    closed.style.display = 'flex';
                } else {
                    input.type = 'password';
                    open.style.display = 'flex';
                    closed.style.display = 'none';
                }
            });
        }

        // theme toggle
        var themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            if (document.documentElement.classList.contains('light-theme')) {
                themeToggle.innerHTML = '<i class="bi bi-moon"></i>';
            }
            themeToggle.addEventListener('click', function () {
                document.documentElement.classList.toggle('light-theme');
                var light = document.documentElement.classList.contains('light-theme');
                localStorage.setItem('theme', light ? 'light' : 'dark');
                this.innerHTML = light ? '<i class="bi bi-moon"></i>' : '<i class="bi bi-sun"></i>';
            });
        }

        // submit loading
        var form = document.getElementById('loginForm');
        if (form) {
            form.addEventListener('submit', function () {
                var btn = document.getElementById('loginBtn');
                if (btn) { btn.classList.add('loading'); btn.disabled = true; }
            });
        }

        // subtle status rotation
        var strip = document.getElementById('stripStatus');
        var msgs = ['ENCRYPTED · SESSION TRACKED', 'MFA ENABLED · ACTIVE', 'MONITORED · TRUSTED DEVICE'];
        var i = 0;
        if (strip) {
            setInterval(function () { i++; strip.textContent = msgs[i % msgs.length]; }, 3500);
        }
    });
    </script>
</body>
</html>