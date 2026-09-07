<style>
    /* ===== Navbar (shared across all pages) ===== */
    .navbar-main {
        position: fixed; top: 0; left: 0; right: 0;
        z-index: 1000;
        background: rgba(8, 11, 18, 0.78);
        backdrop-filter: blur(26px) saturate(1.6);
        -webkit-backdrop-filter: blur(26px) saturate(1.6);
        border-bottom: 1px solid rgba(0, 217, 255, 0.1);
        transition: background 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }
    html.light-theme .navbar-main {
        background: rgba(248, 250, 252, 0.95);
        border-bottom: 1px solid rgba(8, 145, 178, 0.18);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
    }
    .navbar-main::after {
        content: ''; position: absolute; left: 0; right: 0; bottom: -1px; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(0, 217, 255, 0.7), rgba(0, 255, 136, 0.7), transparent);
        opacity: 0; transform: scaleX(0.5);
        transition: opacity 0.4s ease, transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .navbar-main.scrolled { background: rgba(8, 11, 18, 0.97); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4); }
    html.light-theme .navbar-main.scrolled { background: rgba(248, 250, 252, 0.97); box-shadow: 0 10px 40px rgba(15, 23, 42, 0.08); }
    .navbar-main.scrolled::after { opacity: 1; transform: scaleX(1); }
    .navbar-inner {
        max-width: 1280px; margin: 0 auto;
        padding: 0.85rem 2rem;
        display: flex; justify-content: space-between; align-items: center; gap: 1rem;
    }
    .navbar-main.scrolled .navbar-inner { padding: 0.5rem 2rem; }
    .nav-logo {
        display: inline-flex; align-items: center; gap: 0.65rem;
        text-decoration: none; flex-shrink: 0;
    }
    .nav-logo-icon {
        width: 40px; height: 40px; border-radius: 12px;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 1.1rem; color: #06121c;
        background: linear-gradient(135deg, #00d9ff 0%, #00a2c9 55%, #00b35c 100%);
        box-shadow: 0 0 0 1px rgba(0, 217, 255, 0.3), 0 6px 18px rgba(0, 217, 255, 0.25);
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease;
    }
    .nav-logo:hover .nav-logo-icon { transform: rotate(-8deg) scale(1.06); box-shadow: 0 0 0 1px rgba(0, 217, 255, 0.5), 0 8px 26px rgba(0, 217, 255, 0.35); }
    .nav-logo-text, .drawer-logo-text {
        font-family: 'Space Grotesk', 'Noto Sans Bengali', sans-serif;
        font-size: 1.3rem; font-weight: 700; letter-spacing: -0.4px;
        color: #f1f5f9; line-height: 1.15; white-space: nowrap;
    }
    html.light-theme .nav-logo-text, html.light-theme .drawer-logo-text { color: #0f172a; }
    .nav-logo-accent {
        background: linear-gradient(135deg, #7ce6ff 0%, #00ff88 60%, #00d9ff 100%);
        background-size: 200% auto;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: navGradient 5s ease infinite;
    }
    html.light-theme .nav-logo-accent {
        background: linear-gradient(135deg, #0891b2 0%, #0d9488 50%, #059669 100%);
        background-size: 200% auto;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: navGradient 5s ease infinite;
    }
    @keyframes navGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* ===== Desktop nav links ===== */
    .nav-links { display: flex; gap: 0.3rem; list-style: none; align-items: center; margin: 0; padding: 0; }
    .nav-links li { list-style: none; }
    .nav-links a {
        position: relative;
        color: #cbd5e1; font-weight: 500; font-size: 0.88rem;
        padding: 0.55rem 0.95rem; border-radius: 9px;
        text-decoration: none; white-space: nowrap;
        transition: color 0.25s ease, background 0.25s ease;
    }
    html.light-theme .nav-links a { color: #334155; }
    html.light-theme .nav-links a.nav-active { color: #0891b2; background: rgba(8, 145, 178, 0.1); font-weight: 600; }
    /* underline effect disabled */
    .nav-links a:hover { color: #ffffff; background: rgba(0, 217, 255, 0.07); }
    html.light-theme .nav-links a:hover { color: #0f172a; background: rgba(8, 145, 178, 0.06); }
    .nav-links a.nav-active { color: #00d9ff; background: rgba(0, 217, 255, 0.1); }
    html.light-theme .nav-links a.nav-active { color: #0891b2; background: rgba(8, 145, 178, 0.09); }

    .nav-action-login { 
        color: #7ce6ff !important; border: 1px solid rgba(0, 217, 255, 0.25); 
        padding: 0.45rem 1rem !important; border-radius: 8px !important; font-weight: 600 !important;
    }
    html.light-theme .nav-action-login { color: #0891b2 !important; border-color: rgba(8, 145, 178, 0.3) !important; background: rgba(8, 145, 178, 0.06) !important; }
    .nav-action-login:hover { background: rgba(0, 217, 255, 0.12) !important; border-color: #00d9ff !important; }
    .nav-action-signup { 
        background: linear-gradient(135deg, #00d9ff, #00a2c9) !important; color: #fff !important; 
        border: none !important; box-shadow: 0 4px 15px rgba(0, 217, 255, 0.25);
        padding: 0.45rem 1rem !important; border-radius: 8px !important; font-weight: 600 !important;
    }
    .nav-action-signup:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0, 217, 255, 0.4) !important; }
    .nav-action-admin { 
        background: rgba(0, 217, 255, 0.1) !important; color: #7ce6ff !important; 
        border: 1px solid rgba(0, 217, 255, 0.2) !important; font-weight: 600 !important;
    }
    html.light-theme .nav-action-admin { color: #0891b2 !important; border-color: rgba(8, 145, 178, 0.25) !important; background: rgba(8, 145, 178, 0.06) !important; }
    .nav-action-logout { 
        color: #f87171 !important; border: 1px solid rgba(248, 113, 113, 0.2) !important; font-weight: 600 !important;
    }
    html.light-theme .nav-action-logout { color: #dc2626 !important; border-color: rgba(220, 38, 38, 0.25) !important; }
    .nav-action-logout:hover { background: rgba(248, 113, 113, 0.1) !important; }

    /* ===== RIGHT GROUP ===== */
    .nav-right-group {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* Theme Toggle */
    .theme-toggle-btn {
        width: 36px; height: 36px;
        border-radius: 50%; border: 1px solid rgba(0, 217, 255, 0.25);
        background: rgba(0, 217, 255, 0.08);
        color: #7ce6ff; font-size: 1rem;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        padding: 0;
    }
    .theme-toggle-btn:hover {
        background: rgba(0, 217, 255, 0.18);
        transform: scale(1.1);
    }
    html.light-theme .theme-toggle-btn {
        color: #f59e0b;
        border-color: rgba(245, 158, 11, 0.3);
        background: rgba(245, 158, 11, 0.1);
    }
    html.light-theme .theme-toggle-btn:hover {
        background: rgba(245, 158, 11, 0.2);
    }

    /* ===== Hamburger ===== */
    .hamburger {
        display: none; flex-direction: column; gap: 4px;
        cursor: pointer; z-index: 1002; padding: 7px;
        background: rgba(0, 217, 255, 0.08); border: 1px solid rgba(0, 217, 255, 0.15);
        border-radius: 10px; transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hamburger:hover {
        background: rgba(0, 217, 255, 0.15);
        border-color: rgba(0, 217, 255, 0.3);
    }
    .hamburger span {
        display: block; width: 20px; height: 2px;
        background: #e2e8f0; border-radius: 2px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        transform-origin: center;
    }
    html.light-theme .hamburger {
        background: rgba(0, 217, 255, 0.06);
        border-color: rgba(0, 217, 255, 0.15);
    }
    html.light-theme .hamburger:hover {
        background: rgba(0, 217, 255, 0.12);
    }
    html.light-theme .hamburger span { background: #334155; }
    .hamburger.active {
        background: rgba(0, 217, 255, 0.15);
        border-color: rgba(0, 217, 255, 0.25);
    }
    .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(4px, 4px); width: 18px; }
    .hamburger.active span:nth-child(2) { opacity: 0; transform: scaleX(0); }
    .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(4px, -4px); width: 18px; }

    /* ===== Language switcher ===== */
    .lang-switcher { display: flex; align-items: center; gap: 2px; margin: 0 0.3rem; }
    .lang-btn {
        color: #64748b; font-size: 0.78rem; font-weight: 600;
        padding: 3px 6px; border-radius: 4px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        text-decoration: none !important;
        letter-spacing: 0.3px;
    }
    .lang-btn:hover { color: #7ce6ff; }
    .lang-btn.active { color: #00d9ff; background: rgba(0, 217, 255, 0.12); }
    html.light-theme .lang-btn { color: #334155; }
    html.light-theme .lang-btn:hover { color: #0891b2; }
    html.light-theme .lang-btn.active { color: #0891b2; background: rgba(8, 145, 178, 0.1); }
    .lang-divider { color: #475569; font-size: 0.75rem; }
    html.light-theme .lang-divider { color: #94a3b8; }

    /* ===== Mobile drawer and backdrop ===== */
    .mobile-backdrop {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1001;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.35s ease, visibility 0.35s ease;
        cursor: pointer;
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }
    .mobile-backdrop.show {
        opacity: 1;
        visibility: visible;
    }
    html.light-theme .mobile-backdrop {
        background: rgba(0, 0, 0, 0.35);
    }

    .mobile-drawer {
        position: fixed;
        top: 0; right: 0;
        width: 82%; max-width: 340px;
        height: 100vh; height: 100dvh;
        z-index: 1002;
        background: rgba(8, 11, 18, 0.98);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        display: flex;
        flex-direction: column;
        transform: translateX(100%);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: -10px 0 50px rgba(0, 0, 0, 0.5);
        overflow-y: auto;
    }
    html.light-theme .mobile-drawer {
        background: rgba(248, 250, 252, 0.98);
    }
    .mobile-drawer.open {
        transform: translateX(0);
    }

    /* Drawer Header */
    .drawer-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.2rem;
        border-bottom: 1px solid rgba(0, 217, 255, 0.08);
        flex-shrink: 0;
        background: rgba(0, 217, 255, 0.03);
    }
    .drawer-logo {
        display: inline-flex; align-items: center; gap: 0.6rem;
        text-decoration: none; min-width: 0;
    }
    .drawer-logo .nav-logo-icon { width: 34px; height: 34px; font-size: 0.95rem; border-radius: 10px; }
    .drawer-logo-text { font-size: 1.15rem; overflow: hidden; text-overflow: ellipsis; }
    .drawer-close {
        width: 34px; height: 34px;
        border-radius: 10px;
        border: 1px solid rgba(0, 217, 255, 0.2);
        background: rgba(0, 217, 255, 0.06);
        color: var(--text-muted, #64748b);
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
    }
    .drawer-close:hover {
        background: rgba(0, 217, 255, 0.15);
        color: #7ce6ff;
        transform: rotate(90deg);
    }

    /* Drawer Body */
    .drawer-body {
        flex: 1;
        padding: 0.5rem 0.8rem 1rem;
        display: flex;
        flex-direction: column;
    }
    .drawer-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .drawer-nav + .drawer-nav {
        margin-top: 0.3rem;
    }
    .drawer-nav li {
        margin-bottom: 4px;
        opacity: 0;
        transform: translateX(20px);
        transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1), transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .mobile-drawer.open .drawer-nav li {
        opacity: 1;
        transform: translateX(0);
    }
    .mobile-drawer.open .drawer-nav li:nth-child(1) { transition-delay: 0.04s; }
    .mobile-drawer.open .drawer-nav li:nth-child(2) { transition-delay: 0.08s; }
    .mobile-drawer.open .drawer-nav li:nth-child(3) { transition-delay: 0.12s; }
    .mobile-drawer.open .drawer-nav li:nth-child(4) { transition-delay: 0.16s; }
    .mobile-drawer.open .drawer-nav li:nth-child(5) { transition-delay: 0.20s; }
    .mobile-drawer.open .drawer-nav li:nth-child(6) { transition-delay: 0.24s; }
    .mobile-drawer.open .drawer-nav li:nth-child(7) { transition-delay: 0.28s; }

    .drawer-nav a,
    .drawer-nav button {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.7rem 0.85rem;
        border-radius: 10px;
        font-size: 0.92rem;
        font-weight: 500;
        color: var(--text-secondary, #94a3b8);
        text-decoration: none;
        transition: all 0.2s ease;
        width: 100%;
        background: none;
        border: none;
        cursor: pointer;
        font-family: inherit;
        text-align: left;
    }
    .drawer-nav a i,
    .drawer-nav button i {
        width: 20px;
        text-align: center;
        font-size: 1rem;
        color: var(--text-muted, #64748b);
        transition: color 0.2s;
    }
    .drawer-nav a:hover {
        background: rgba(0, 217, 255, 0.08);
        color: #7ce6ff;
    }
    .drawer-nav a:hover i {
        color: #7ce6ff;
    }
    .drawer-nav a.active {
        background: rgba(0, 217, 255, 0.12);
        color: #00d9ff;
    }
    .drawer-nav a.active i {
        color: #00d9ff;
    }

    /* Divider */
    .drawer-divider {
        height: 1px;
        background: rgba(0, 217, 255, 0.1);
        margin: 0.4rem 0.8rem;
    }

    /* Auth buttons in drawer */
    .drawer-login-btn {
        justify-content: center !important;
        background: rgba(0, 217, 255, 0.08) !important;
        border: 1px solid rgba(0, 217, 255, 0.25) !important;
        color: #7ce6ff !important;
        font-weight: 600 !important;
    }
    .drawer-login-btn:hover {
        background: rgba(0, 217, 255, 0.15) !important;
    }
    .drawer-signup-btn {
        justify-content: center !important;
        background: linear-gradient(135deg, #00d9ff, #00a2c9) !important;
        border: none !important;
        color: #fff !important;
        font-weight: 600 !important;
        box-shadow: 0 4px 15px rgba(0, 217, 255, 0.3);
    }
    .drawer-signup-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(0, 217, 255, 0.4) !important;
    }
    .drawer-logout-btn {
        color: #f87171 !important;
    }
    .drawer-logout-btn:hover {
        background: rgba(248, 113, 113, 0.08) !important;
        color: #f87171 !important;
    }
    .drawer-admin-btn {
        color: #7ce6ff !important;
        border: 1px solid rgba(0, 217, 255, 0.2) !important;
    }
    .drawer-admin-btn:hover {
        background: rgba(0, 217, 255, 0.1) !important;
    }

    /* Drawer Footer (lang) */
    .drawer-footer {
        margin-top: auto;
        padding: 0.8rem 0.5rem 0.4rem;
        border-top: 1px solid rgba(0, 217, 255, 0.08);
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    /* ===== Mobile responsive ===== */
    @media (max-width: 768px) {
        .navbar-inner {
            padding: 0.7rem 1rem;
        }
        .navbar-main.scrolled .navbar-inner {
            padding: 0.45rem 1rem;
        }
        .nav-logo-text, .drawer-logo-text {
            font-size: 1.12rem;
        }
        .nav-logo-icon { width: 36px; height: 36px; }
        .nav-links {
            display: none !important;
        }
        .hamburger {
            display: flex;
        }
        .nav-right-group {
            gap: 0.2rem;
        }
        .theme-toggle-btn {
            width: 34px; height: 34px; font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .navbar-inner {
            padding: 0.5rem 0.8rem;
        }
        .navbar-main.scrolled .navbar-inner {
            padding: 0.35rem 0.8rem;
        }
        .nav-logo-text, .drawer-logo-text { font-size: 1rem; }
        .nav-logo-icon { width: 32px; height: 32px; font-size: 0.9rem; border-radius: 9px; }
        .nav-logo { gap: 0.45rem; }
        .hamburger {
            padding: 5px;
        }
        .hamburger span {
            width: 18px;
        }
        .hamburger.active span:nth-child(1),
        .hamburger.active span:nth-child(3) {
            width: 16px;
        }
        .theme-toggle-btn {
            width: 30px; height: 30px; font-size: 0.8rem;
        }
        .lang-btn { font-size: 0.65rem; padding: 2px 4px; }
        .drawer-header {
            padding: 0.8rem 1rem;
        }
        .drawer-logo-text {
            font-size: 0.95rem;
        }
        .drawer-close {
            width: 30px; height: 30px; font-size: 0.85rem;
        }
        .drawer-body {
            padding: 0.3rem 0.6rem 0.8rem;
        }
        .drawer-nav a,
        .drawer-nav button {
            font-size: 0.85rem;
            padding: 0.6rem 0.75rem;
        }
        .drawer-nav a i,
        .drawer-nav button i {
            font-size: 0.9rem;
            width: 18px;
        }
        .drawer-nav li {
            margin-bottom: 3px;
        }
        .drawer-divider {
            margin: 0.3rem 0.6rem;
        }
        .drawer-footer {
            padding: 0.6rem 0.3rem 0.3rem;
        }
    }

    /* ===== BODY SCROLL LOCK ===== */
    body.menu-open {
        overflow: hidden !important;
    }
</style>

<nav class="navbar-main" id="navbar">
    <div class="navbar-inner">
    <!-- Logo -->
    <a href="/" class="nav-logo">
        <span class="nav-logo-icon"><i class="bi bi-shield-fill-check"></i></span>
        <span class="nav-logo-text">Sajal Kumar <span class="nav-logo-accent">Sen</span></span>
    </a>

    <!-- Desktop Nav Links -->
    <ul class="nav-links" id="navLinks">
        <li><a href="/" class="{{ request()->is('/') ? 'nav-active' : '' }}"><i class="bi bi-house-fill me-1"></i>{{ __('messages.home') }}</a></li>
        @auth
            <li><a href="{{ route('inbox.index') }}" class="{{ request()->is('inbox*') ? 'nav-active' : '' }}"><i class="bi bi-chat-dots me-1"></i>{{ __('messages.inbox') }}</a></li>
            @if(auth()->user()->is_admin == 1)
                <li><a href="/admin" class="nav-action-admin">{{ __('messages.admin') }}</a></li>
            @endif
            <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-action-logout" style="background:none; border:none; cursor:pointer; font-family:inherit; font-size:0.88rem; display:inline-flex; align-items:center; gap:0.4rem; padding:0.45rem 1rem; border-radius:8px; font-weight:600;">
                        {{ __('messages.logout') }}
                    </button>
                </form>
            </li>
        @else
            <li><a href="/login" class="nav-action-login">{{ __('messages.login') }}</a></li>
            <li><a href="/register" class="nav-action-signup">{{ __('messages.signup') }}</a></li>
        @endauth
    </ul>

    <!-- Right Group -->
    <div class="nav-right-group">
        <div class="lang-switcher">
            <a href="{{ route('language.switch', 'en') }}" 
               class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}"
               title="{{ __('messages.english') }}">EN</a>
            <span class="lang-divider">|</span>
            <a href="{{ route('language.switch', 'bn') }}" 
               class="lang-btn {{ app()->getLocale() == 'bn' ? 'active' : '' }}"
               title="{{ __('messages.bengali') }}">বাংলা</a>
        </div>
        <button class="theme-toggle-btn" id="themeToggle" aria-label="{{ __('messages.toggle_theme') }}">
            <i class="bi bi-sun-fill"></i>
        </button>
        <button class="hamburger" id="hamburger" aria-label="Toggle navigation menu">
            <span></span><span></span><span></span>
        </button>
    </div>
    </div>
</nav>

<!-- Mobile Backdrop -->
<div class="mobile-backdrop" id="mobileBackdrop"></div>

<!-- Mobile Drawer -->
<div class="mobile-drawer" id="mobileDrawer">
    <!-- Drawer Header -->
    <div class="drawer-header">
        <a href="/" class="drawer-logo">
            <span class="nav-logo-icon"><i class="bi bi-shield-fill-check"></i></span>
            <span class="drawer-logo-text">Sajal Kumar <span class="nav-logo-accent">Sen</span></span>
        </a>
        <button class="drawer-close" id="drawerClose" aria-label="Close menu">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <!-- Drawer Body -->
    <div class="drawer-body">
        <ul class="drawer-nav">
            <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}"><i class="bi bi-house-fill"></i>{{ __('messages.home') }}</a></li>
        </ul>

        <div class="drawer-divider"></div>

        <ul class="drawer-nav">
            @auth
                <li><a href="{{ route('inbox.index') }}" class="{{ request()->is('inbox*') ? 'active' : '' }}"><i class="bi bi-chat-dots"></i>{{ __('messages.inbox') }}</a></li>
                @if(auth()->user()->is_admin == 1)
                    <li><a href="/admin" class="drawer-admin-btn"><i class="bi bi-speedometer2"></i>{{ __('messages.admin') }}</a></li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="drawer-logout-btn">
                            <i class="bi bi-box-arrow-right"></i>{{ __('messages.logout') }}
                        </button>
                    </form>
                </li>
            @else
                <li><a href="/login" class="drawer-login-btn"><i class="bi bi-person-circle"></i>{{ __('messages.login') }}</a></li>
                <li><a href="/register" class="drawer-signup-btn"><i class="bi bi-person-plus"></i>{{ __('messages.signup') }}</a></li>
            @endauth
        </ul>

        <div class="drawer-footer">
            <a href="{{ route('language.switch', 'en') }}" 
               class="lang-btn {{ app()->getLocale() == 'en' ? 'active' : '' }}"
               title="{{ __('messages.english') }}">EN</a>
            <span class="lang-divider">|</span>
            <a href="{{ route('language.switch', 'bn') }}" 
               class="lang-btn {{ app()->getLocale() == 'bn' ? 'active' : '' }}"
               title="{{ __('messages.bengali') }}">বাংলা</a>
        </div>
    </div>
</div>

<script>
// ===== MOBILE MENU TOGGLE =====
(function() {
    var hamburger = document.getElementById('hamburger');
    var drawer = document.getElementById('mobileDrawer');
    var backdrop = document.getElementById('mobileBackdrop');
    var closeBtn = document.getElementById('drawerClose');
    var body = document.body;

    if (!hamburger || !drawer || !backdrop) return;

    function openMenu() {
        drawer.classList.add('open');
        backdrop.classList.add('show');
        hamburger.classList.add('active');
        body.classList.add('menu-open');
    }

    function closeMenu() {
        drawer.classList.remove('open');
        backdrop.classList.remove('show');
        hamburger.classList.remove('active');
        body.classList.remove('menu-open');
    }

    hamburger.addEventListener('click', function(e) {
        e.stopPropagation();
        if (drawer.classList.contains('open')) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeMenu);
    }

    // Click backdrop to close
    backdrop.addEventListener('click', closeMenu);

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && drawer.classList.contains('open')) {
            closeMenu();
        }
    });

    // Close when a nav link is clicked
    drawer.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', closeMenu);
    });

    // Close when logout form is submitted (but allow form to submit)
    drawer.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function() {
            // Small delay to allow form submission
            setTimeout(closeMenu, 100);
        });
    });

    // Prevent clicks inside drawer from closing via backdrop
    drawer.addEventListener('click', function(e) {
        e.stopPropagation();
    });
})();
</script>
