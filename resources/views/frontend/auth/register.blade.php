<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ config('app.name', 'Portfolio') }} | {{ __('Create Account') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Space Grotesk + Noto Sans Bengali Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&family=Noto+Sans+Bengali:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.add('light-theme');
        }
    </script>

    <style>

    /* ==========================================
       LIGHT THEME OVERRIDES
       ========================================== */
    html.light-theme {
        --login-primary: #f8fafc;
        --login-card-bg: rgba(255, 255, 255, 0.85);
        --login-card-border: rgba(0, 217, 255, 0.2);
        --login-text: #111827;
        --login-text-secondary: #475569;
        --login-text-muted: #94a3b8;
        --login-input-bg: rgba(248, 250, 252, 0.85);
        --login-input-border: rgba(0, 217, 255, 0.2);
    }
    html.light-theme .login-card::before {
        background: linear-gradient(135deg,
            transparent 0%,
            rgba(0, 217, 255, 0.2) 25%,
            rgba(0, 255, 136, 0.2) 50%,
            rgba(0, 217, 255, 0.2) 75%,
            transparent 100%
        );
    }
    html.light-theme .header-text h1 {
        background: linear-gradient(135deg, #111827, #00d9ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    html.light-theme .login-input {
        color: #111827 !important;
    }
    html.light-theme .login-input:focus {
        background: #ffffff;
    }
    html.light-theme .checkbox-custom {
        background: rgba(255, 255, 255, 0.8);
        border-color: rgba(148, 163, 184, 0.4);
    }
    html.light-theme .signup-btn {
        color: var(--login-accent);
        border-color: rgba(0, 217, 255, 0.35);
    }
    html.light-theme .login-input:-webkit-autofill,
    html.light-theme .login-input:-webkit-autofill:hover,
    html.light-theme .login-input:-webkit-autofill:focus {
        -webkit-text-fill-color: #111827;
        -webkit-box-shadow: 0 0 0 1000px #ffffff inset;
    }
    html.light-theme .login-card:hover {
        border-color: rgba(0, 217, 255, 0.35);
        box-shadow:
            0 30px 80px rgba(0, 0, 0, 0.1),
            0 0 60px rgba(0, 217, 255, 0.15);
    }

    /* ==========================================
       ROOT VARIABLES (Dark Theme Default)
       ========================================== */
    :root {
        --login-primary: #080b12;
        --login-card-bg: rgba(17, 24, 39, 0.75);
        --login-card-border: rgba(0, 217, 255, 0.15);
        --login-accent: #00d9ff;
        --login-accent-light: #7ce6ff;
        --login-accent-dark: #00a2c9;
        --login-accent-glow: rgba(0, 217, 255, 0.3);
        --login-text: #f1f5f9;
        --login-text-secondary: #94a3b8;
        --login-text-muted: #64748b;
        --login-input-bg: rgba(11, 18, 32, 0.6);
        --login-input-border: rgba(0, 217, 255, 0.2);
        --login-input-focus: rgba(0, 217, 255, 0.25);
        --login-error: #ef4444;
        --login-success: #22c55e;
        --login-radius: 16px;
        --login-radius-sm: 10px;
    }

    *, *::before, *::after { box-sizing: border-box; }
    html { width: 100%; max-width: 100%; overflow-x: hidden; }
    body {
        margin: 0; padding: 0;
        width: 100%; max-width: 100%; overflow-x: hidden;
        font-family: 'Inter', 'Noto Sans Bengali', system-ui, -apple-system, sans-serif;
        background: var(--login-primary);
    }
    a { text-decoration: none !important; }

    /* ==========================================
       CONTAINER
       ========================================== */
    .login-container {
        min-height: 100vh; min-height: 100dvh;
        display: flex; align-items: center; justify-content: center;
        position: relative; padding: 24px 16px; overflow: hidden;
        background: var(--login-primary);
    }

    .bg-mesh {
        position: absolute; inset: 0; z-index: 0;
        background:
            radial-gradient(ellipse at 20% 50%, rgba(0,217,255,0.08) 0%, transparent 50%),
            radial-gradient(ellipse at 80% 20%, rgba(0,255,136,0.06) 0%, transparent 50%),
            radial-gradient(ellipse at 50% 80%, rgba(0,217,255,0.05) 0%, transparent 50%);
    }

    .bg-orbs { position: absolute; inset: 0; z-index: 0; pointer-events: none; }
    .orb {
        position: absolute; border-radius: 50%;
        filter: blur(60px); will-change: transform;
    }
    .orb-1 {
        top: -15%; right: -10%;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(0,217,255,0.12), transparent 70%);
        animation: orbFloat1 12s ease-in-out infinite;
    }
    .orb-2 {
        bottom: -15%; left: -10%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(0,255,136,0.08), transparent 70%);
        animation: orbFloat2 10s ease-in-out infinite alternate;
    }
    .orb-3 {
        top: 40%; left: 50%;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(0,217,255,0.06), transparent 70%);
        animation: orbFloat3 8s ease-in-out infinite alternate-reverse;
    }

    @keyframes orbFloat1 {
        0%,100%{transform:translate(0,0) scale(1);}
        33%{transform:translate(30px,-40px) scale(1.05);}
        66%{transform:translate(-20px,20px) scale(0.95);}
    }
    @keyframes orbFloat2 {
        0%{transform:translate(0,0) scale(1);}
        100%{transform:translate(40px,-30px) scale(1.1);}
    }
    @keyframes orbFloat3 {
        0%{transform:translate(-50%,-50%) scale(1);}
        100%{transform:translate(-30%,-60%) scale(1.15);}
    }

    .bg-grid {
        position: absolute; inset: 0; z-index: 1;
        background-image:
            linear-gradient(rgba(0,217,255,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0,217,255,0.03) 1px, transparent 1px);
        background-size: 40px 40px;
        animation: gridShift 20s linear infinite;
    }
    @keyframes gridShift {
        0%{background-position:0 0;}
        100%{background-position:40px 40px;}
    }

    /* ==========================================
       CARD
       ========================================== */
    .login-card {
        width: 100%; max-width: 480px;
        border-radius: var(--login-radius);
        background: var(--login-card-bg);
        backdrop-filter: blur(24px) saturate(1.2);
        -webkit-backdrop-filter: blur(24px) saturate(1.2);
        border: 1px solid var(--login-card-border);
        box-shadow:
            0 25px 60px rgba(0,0,0,0.5),
            0 0 40px rgba(0,217,255,0.05),
            inset 0 1px 0 rgba(255,255,255,0.05);
        position: relative; z-index: 5;
        animation: cardEntry 0.6s cubic-bezier(0.16,1,0.3,1);
        transition: all 0.5s cubic-bezier(0.16,1,0.3,1);
    }
    .login-card:hover {
        border-color: rgba(0,217,255,0.3);
        box-shadow:
            0 30px 80px rgba(0,0,0,0.55),
            0 0 60px rgba(0,217,255,0.12),
            inset 0 1px 0 rgba(255,255,255,0.08);
        transform: translateY(-2px);
    }
    .login-card::before {
        content: ''; position: absolute; inset: -1px;
        border-radius: calc(var(--login-radius) + 1px);
        background: linear-gradient(135deg,
            transparent 0%, rgba(0,217,255,0.15) 25%,
            rgba(0,255,136,0.15) 50%, rgba(0,217,255,0.15) 75%, transparent 100%);
        background-size: 200% 200%;
        animation: borderGlow 6s ease-in-out infinite;
        z-index: -1; padding: 1px; pointer-events: none;
    }
    @supports (mask-composite: exclude) or (-webkit-mask-composite: xor) {
        .login-card::before {
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
        }
    }
    @keyframes borderGlow {
        0%,100%{background-position:0% 50%;}
        50%{background-position:100% 50%;}
    }
    @keyframes cardEntry {
        from{opacity:0;transform:translateY(30px) scale(0.96);}
        to{opacity:1;transform:translateY(0) scale(1);}
    }

    /* ==========================================
       HEADER
       ========================================== */
    .login-header { padding: 32px 32px 24px; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 16px; }
    .header-icon {
        width: 56px; height: 56px; border-radius: 16px;
        background: linear-gradient(135deg, rgba(0,217,255,0.15), rgba(0,217,255,0.05));
        border: 1px solid rgba(0,217,255,0.2);
        display: flex; align-items: center; justify-content: center;
        transition: transform 0.3s ease; position: relative;
    }
    .header-icon::after {
        content: ''; position: absolute; inset: -3px; border-radius: 18px;
        background: linear-gradient(135deg, rgba(0,217,255,0.2), transparent, rgba(0,217,255,0.1));
        z-index: -1; animation: iconPulse 3s ease-in-out infinite;
    }
    @keyframes iconPulse { 0%,100%{opacity:0.5;} 50%{opacity:1;} }
    .header-icon svg { width: 26px; height: 26px; color: var(--login-accent-light); }
    .header-text h1 {
        font-size: 24px; font-weight: 700; color: var(--login-text); margin: 0; letter-spacing: -0.3px;
        background: linear-gradient(135deg, #f1f5f9, #94a3b8);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .header-text p { font-size: 14px; color: var(--login-text-muted); margin: 6px 0 0; font-weight: 400; }

    /* ==========================================
       INPUT GROUPS
       ========================================== */
    .input-group-custom { margin-bottom: 18px; position: relative; }
    .input-wrapper { position: relative; }
    .login-input {
        width: 100%; padding: 18px 44px 6px 16px;
        background: var(--login-input-bg);
        border: 1.5px solid var(--login-input-border);
        border-radius: var(--login-radius-sm); color: #ffffff !important;
        font-size: 15px; font-family: 'Inter', 'Noto Sans Bengali', system-ui, -apple-system, sans-serif;
        transition: all 0.25s ease; height: 56px;
        outline: none; box-shadow: none; line-height: 1.5;
    }
    .login-input::placeholder { color: transparent; }
    @media (max-width: 576px) { .login-input::placeholder { color: rgba(148,163,184,0.4); } }
    .login-input:focus {
        border-color: var(--login-accent); background: rgba(10,19,36,0.8);
        box-shadow: 0 0 0 4px rgba(0,217,255,0.12), 0 0 20px rgba(0,217,255,0.05);
    }
    .login-input.is-invalid { border-color: var(--login-error); box-shadow: 0 0 0 4px rgba(239,68,68,0.1); }
    .login-input.is-invalid:focus { box-shadow: 0 0 0 4px rgba(239,68,68,0.1), 0 0 20px rgba(239,68,68,0.05); }

    .input-label {
        position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
        font-size: 14px; color: var(--login-text-muted);
        pointer-events: none; transition: all 0.2s cubic-bezier(0.4,0,0.2,1);
        display: flex; align-items: center; gap: 8px; font-weight: 400; z-index: 1;
    }
    .input-icon { width: 16px; height: 16px; color: var(--login-text-muted); flex-shrink: 0; transition: color 0.2s ease; }
    .login-input:focus ~ .input-label,
    .login-input:not(:placeholder-shown) ~ .input-label {
        top: 10px; transform: translateY(0); font-size: 11px;
        font-weight: 500; letter-spacing: 0.3px; text-transform: uppercase; gap: 6px;
    }
    .login-input:focus ~ .input-label { color: var(--login-accent-light); }
    .login-input:focus ~ .input-label .input-icon { color: var(--login-accent-light); }

    .password-toggle {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        background: none; border: none; color: var(--login-text-muted);
        cursor: pointer; padding: 8px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s ease; z-index: 2;
    }
    .password-toggle:hover { color: var(--login-accent-light); background: rgba(0,217,255,0.08); }
    .password-toggle svg { width: 20px; height: 20px; }

    .error-message {
        display: flex; align-items: center; gap: 6px;
        color: var(--login-error); font-size: 12px; margin-top: 6px; padding-left: 4px;
        animation: errorSlide 0.3s ease;
    }
    .error-message svg { width: 14px; height: 14px; flex-shrink: 0; }
    @keyframes errorSlide {
        from{opacity:0;transform:translateY(-6px);}
        to{opacity:1;transform:translateY(0);}
    }

    /* ==========================================
       BUTTON
       ========================================== */
    .login-btn {
        width: 100%; padding: 14px 24px; border: none; border-radius: var(--login-radius-sm);
        background: linear-gradient(135deg, var(--login-accent), var(--login-accent-dark));
        color: #fff; font-size: 15px; font-weight: 600;
        font-family: 'Inter', 'Noto Sans Bengali', system-ui, -apple-system, sans-serif;
        cursor: pointer; transition: all 0.25s ease;
        position: relative; overflow: hidden;
        display: flex; align-items: center; justify-content: center; gap: 8px; letter-spacing: 0.2px; margin-top: 4px;
    }
    .login-btn::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, transparent 0%, rgba(255,255,255,0.1) 30%, transparent 60%);
        transform: translateX(-100%) skewX(-15deg); transition: transform 0.6s ease;
    }
    .login-btn:hover::before { transform: translateX(150%) skewX(-15deg); }
    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(0,217,255,0.4), 0 0 20px rgba(0,217,255,0.15);
    }
    .login-btn.loading .btn-text { display: none; }
    .login-btn.loading .btn-loader { display: flex !important; align-items: center; gap: 8px; }
    .spinner { width: 18px; height: 18px; animation: spin 0.8s linear infinite; }
    @keyframes spin { from{transform:rotate(0deg);} to{transform:rotate(360deg);} }
    .ripple {
        position: absolute; border-radius: 50%;
        background: rgba(255,255,255,0.3); transform: scale(0);
        animation: rippleAnim 0.6s ease-out; pointer-events: none;
    }
    @keyframes rippleAnim { to{transform:scale(4);opacity:0;} }

    /* ==========================================
       DIVIDER + SIGNUP
       ========================================== */
    .divider {
        display: flex; align-items: center; gap: 14px; margin: 24px 0;
    }
    .divider::before,.divider::after {
        content: ''; flex: 1; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(148,163,184,0.15), transparent);
    }
    .divider span { font-size: 12px; color: var(--login-text-muted); font-weight: 500; letter-spacing: 1.5px; text-transform: uppercase; }

    .signup-section { display: flex; align-items: center; justify-content: center; gap: 12px; flex-wrap: wrap; }
    .signup-text { font-size: 14px; color: var(--login-text-muted); }
    .signup-btn {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 10px 24px; border-radius: var(--login-radius-sm);
        border: 1.5px solid rgba(0,217,255,0.3); color: var(--login-accent-light);
        font-size: 14px; font-weight: 600; text-decoration: none;
        transition: all 0.25s ease; background: rgba(0,217,255,0.05);
    }
    .signup-btn svg { width: 16px; height: 16px; transition: transform 0.25s ease; }
    .signup-btn:hover {
        background: rgba(0,217,255,0.12); border-color: var(--login-accent);
        color: #b3f0ff; transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0,217,255,0.15);
    }
    .signup-btn:hover svg { transform: translateX(3px); }

    .login-input:-webkit-autofill,
    .login-input:-webkit-autofill:hover,
    .login-input:-webkit-autofill:focus {
        -webkit-text-fill-color: var(--login-text);
        -webkit-box-shadow: 0 0 0 1000px rgba(10,19,36,0.9) inset;
        transition: background-color 5000s ease-in-out 0s;
    }

    /* ==========================================
       RESPONSIVE
       ========================================== */
    @media (max-width: 992px) { .login-card { max-width: 460px; } }
    @media (max-width: 768px) {
        .login-container { padding: 20px 12px; }
        .login-header { padding: 28px 24px 20px; gap: 14px; }
        .header-icon { width: 50px; height: 50px; border-radius: 14px; }
        .header-icon svg { width: 24px; height: 24px; }
        .header-text h1 { font-size: 22px; }
        .login-body { padding: 0 24px 28px; }
        .login-input { padding: 16px 40px 6px 14px; font-size: 14px; height: 52px; }
        .login-input:focus ~ .input-label,
        .login-input:not(:placeholder-shown) ~ .input-label { top: 8px; font-size: 10px; }
        .input-label { left: 14px; font-size: 13px; }
        .login-btn { padding: 13px 20px; font-size: 14px; }
        .orb-1 { width: 350px; height: 350px; }
        .orb-2 { width: 280px; height: 280px; }
        .orb-3 { display: none; }
    }
    @media (max-width: 576px) {
        .login-container { padding: 0; min-height: 100dvh; align-items: flex-start; }
        .login-card { max-width: 100%; border-radius: 0; min-height: 100dvh; background: rgba(8,11,18,0.95); backdrop-filter: none; -webkit-backdrop-filter: none; border: none; box-shadow: none; display: flex; flex-direction: column; }
        html.light-theme .login-card { background: rgba(248,250,252,0.98); }
        .login-card::before { display: none; }
        .login-header { padding: 48px 24px 20px; gap: 12px; }
        .header-icon { width: 48px; height: 48px; border-radius: 12px; }
        .header-icon svg { width: 22px; height: 22px; }
        .header-text h1 { font-size: 22px; }
        .header-text p { font-size: 13px; }
        .login-body { padding: 0 20px 32px; flex: 1; display: flex; flex-direction: column; }
        .login-body form { flex: 1; display: flex; flex-direction: column; }
        .login-body form .login-btn { margin-top: auto; }
        .login-input { padding: 16px 40px 6px 14px; font-size: 16px; height: 54px; border-radius: 12px; }
        .login-input:focus ~ .input-label,
        .login-input:not(:placeholder-shown) ~ .input-label { top: 8px; font-size: 10px; }
        .input-label { left: 14px; font-size: 14px; }
        .input-icon { width: 14px; height: 14px; }
        .password-toggle { right: 10px; padding: 6px; }
        .password-toggle svg { width: 18px; height: 18px; }
        .login-btn { padding: 14px 20px; font-size: 15px; border-radius: 12px; min-height: 50px; }
        .divider { margin: 20px 0; }
        .signup-text { font-size: 13px; }
        .signup-btn { padding: 9px 18px; font-size: 13px; }
        .orb-1, .orb-2, .orb-3 { opacity: 0.4; filter: blur(40px); }
        .bg-grid { background-size: 25px 25px; opacity: 0.5; }
        .bg-mesh { opacity: 0.7; }
    }
    @media (max-width: 380px) {
        .login-header { padding: 36px 16px 16px; }
        .login-body { padding: 0 16px 24px; }
        .login-input { padding: 14px 36px 6px 12px; font-size: 15px; height: 50px; }
        .input-label { left: 12px; font-size: 13px; }
        .login-input:focus ~ .input-label,
        .login-input:not(:placeholder-shown) ~ .input-label { top: 6px; font-size: 9px; }
        .header-text h1 { font-size: 19px; }
        .signup-btn { width: 100%; justify-content: center; }
    }
    @media (max-height: 500px) and (orientation: landscape) {
        .login-container { align-items: flex-start; padding: 8px; }
        .login-card { max-width: 500px; border-radius: var(--login-radius); min-height: auto; border: 1px solid var(--login-card-border); background: var(--login-card-bg); }
        .login-header { padding: 16px 20px 10px; flex-direction: row; gap: 12px; }
        .header-icon { width: 36px; height: 36px; }
        .header-icon svg { width: 18px; height: 18px; }
        .header-text h1 { font-size: 18px; }
        .header-text p { display: none; }
        .login-body { padding: 0 20px 16px; }
        .input-group-custom { margin-bottom: 10px; }
        .login-input { height: 44px; padding: 12px 36px 4px 12px; font-size: 13px; }
        .login-input:focus ~ .input-label,
        .login-input:not(:placeholder-shown) ~ .input-label { top: 4px; font-size: 9px; }
        .input-label { left: 12px; font-size: 12px; }
        .login-btn { padding: 10px 16px; font-size: 13px; min-height: 40px; }
        .divider { margin: 12px 0; }
        .signup-btn { padding: 7px 14px; font-size: 12px; }
        .orb-1, .orb-2, .orb-3 { display: none; }
    }

    @media (prefers-reduced-motion: reduce) {
        .login-card { animation: none; }
        .login-card::before { animation: none; }
        .orb-1, .orb-2, .orb-3 { animation: none; }
        .bg-grid { animation: none; }
        .header-icon::after { animation: none; }
        .login-btn::before { transition: none; }
    }
    :focus-visible { outline: 2px solid var(--login-accent); outline-offset: 2px; }
    .login-container ::-webkit-scrollbar { width: 4px; }
    .login-container ::-webkit-scrollbar-track { background: transparent; }
    .login-container ::-webkit-scrollbar-thumb { background: rgba(0,217,255,0.25); border-radius: 10px; }
    .login-container ::-webkit-scrollbar-thumb:hover { background: rgba(0,217,255,0.4); }

            h1, h2, h3, h4, h5, h6 {
            font-family: 'Space Grotesk', 'Noto Sans Bengali', sans-serif;
        }
</style>
</head>
<body>

    <div class="login-container">

        <div class="bg-mesh"></div>
        <div class="bg-orbs">
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="orb orb-3"></div>
        </div>
        <div class="bg-grid"></div>

        <div class="container">
            <div class="row justify-content-center w-100 m-0">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 d-flex justify-content-center">
                    <div class="card login-card">

                        <!-- HEADER -->
                        <div class="login-header">
                            <div class="header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z"/>
                                </svg>
                            </div>
                            <div class="header-text">
                                <h1>{{ __('Create Account') }}</h1>
                                <p>{{ __('Join us today — it\'s free!') }}</p>
                            </div>
                        </div>

                        <div class="login-body">

                            <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
                                @csrf

                                <!-- NAME -->
                                <div class="input-group-custom @error('name') has-error @enderror">
                                    <div class="input-wrapper">
                                        <input id="name" type="text"
                                               class="form-control login-input @error('name') is-invalid @enderror"
                                               name="name" value="{{ old('name') }}"
                                               placeholder=" " required autocomplete="name" autofocus
                                               aria-describedby="name-error">
                                        <label for="name" class="input-label">
                                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                            </svg>
                                            {{ __('Full Name') }}
                                        </label>
                                    </div>
                                    @error('name')
                                    <span class="error-message" id="name-error" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- EMAIL -->
                                <div class="input-group-custom @error('email') has-error @enderror">
                                    <div class="input-wrapper">
                                        <input id="email" type="email"
                                               class="form-control login-input @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}"
                                               placeholder=" " required autocomplete="email"
                                               aria-describedby="reg-email-error">
                                        <label for="email" class="input-label">
                                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                                            </svg>
                                            {{ __('Email Address') }}
                                        </label>
                                    </div>
                                    @error('email')
                                    <span class="error-message" id="reg-email-error" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- PASSWORD -->
                                <div class="input-group-custom @error('password') has-error @enderror">
                                    <div class="input-wrapper">
                                        <input id="password" type="password"
                                               class="form-control login-input @error('password') is-invalid @enderror"
                                               name="password" placeholder=" "
                                               required autocomplete="new-password"
                                               aria-describedby="reg-password-error">
                                        <label for="password" class="input-label">
                                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z"/>
                                            </svg>
                                            {{ __('Password') }}
                                        </label>
                                        <button type="button" class="password-toggle" aria-label="Toggle password visibility">
                                            <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                            </svg>
                                            <svg class="eye-closed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="display:none">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/>
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password')
                                    <span class="error-message" id="reg-password-error" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- CONFIRM PASSWORD -->
                                <div class="input-group-custom">
                                    <div class="input-wrapper">
                                        <input id="password-confirm" type="password"
                                               class="form-control login-input"
                                               name="password_confirmation"
                                               placeholder=" " required autocomplete="new-password">
                                        <label for="password-confirm" class="input-label">
                                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                                            </svg>
                                            {{ __('Confirm Password') }}
                                        </label>
                                        <button type="button" class="password-toggle" aria-label="Toggle password visibility">
                                            <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                            </svg>
                                            <svg class="eye-closed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="display:none">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- BUTTON -->
                                <button type="submit" class="login-btn" id="registerBtn">
                                    <span class="btn-text">{{ __('Create Account') }}</span>
                                    <span class="btn-loader" style="display:none">
                                        <svg class="spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" opacity="0.25"/>
                                            <path d="M12 2a10 10 0 0 1 10 10" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                                        </svg>
                                        {{ __('Creating your account...') }}
                                    </span>
                                </button>

                            </form>

                            <!-- DIVIDER -->
                            <div class="divider">
                                <span>{{ __('or') }}</span>
                            </div>

                            <!-- LOGIN LINK -->
                            <div class="signup-section">
                                <span class="signup-text">{{ __('Already have an account?') }}</span>
                                <a href="{{ route('login') }}" class="signup-btn">
                                    {{ __('Sign In') }}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                                    </svg>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.password-toggle').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const input = this.closest('.input-wrapper').querySelector('.login-input');
                const eyeOpen = this.querySelector('.eye-open');
                const eyeClosed = this.querySelector('.eye-closed');
                if (input.type === 'password') {
                    input.type = 'text'; eyeOpen.style.display = 'none'; eyeClosed.style.display = 'flex';
                    this.setAttribute('aria-label', 'Hide password');
                } else {
                    input.type = 'password'; eyeOpen.style.display = 'flex'; eyeClosed.style.display = 'none';
                    this.setAttribute('aria-label', 'Show password');
                }
            });
        });

        const registerBtn = document.getElementById('registerBtn');
        if (registerBtn) {
            registerBtn.addEventListener('click', function(e) {
                if (e.button !== 0) return;
                const rect = this.getBoundingClientRect();
                const ripple = document.createElement('span');
                ripple.classList.add('ripple');
                const size = Math.max(rect.width, rect.height);
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
                ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
                this.appendChild(ripple);
                setTimeout(function() { ripple.remove(); }, 600);
            });
        }

        const registerForm = document.getElementById('registerForm');
        if (registerForm) {
            registerForm.addEventListener('submit', function() {
                const btn = document.getElementById('registerBtn');
                if (btn) { btn.classList.add('loading'); btn.disabled = true; }
            });
        }

        document.querySelectorAll('.login-input').forEach(function(input) {
            if (input.value.trim() !== '') { input.setAttribute('placeholder', ' '); }
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.005)';
                this.parentElement.style.transition = 'transform 0.25s ease';
            });
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        const card = document.querySelector('.login-card');
        if (card && window.innerWidth > 768) {
            card.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                this.style.background = `
                    radial-gradient(circle 350px at ${x}px ${y}px, rgba(0,217,255,0.15) 0%, rgba(0,217,255,0.06) 40%, transparent 70%),
                    var(--login-card-bg, rgba(17,24,39,0.75))
                `;
            });
            card.addEventListener('mouseleave', function() {
                this.style.background = 'var(--login-card-bg, rgba(17,24,39,0.75))';
            });
        }

    });
    </script>
</body>
</html>
