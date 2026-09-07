<style>
    /* ===== Navbar — Modern Minimal ===== */
    .navbar-main {
        position: fixed; top: 0; left: 0; right: 0;
        z-index: 1000;
        background: rgba(8, 11, 18, 0.72);
        backdrop-filter: blur(32px) saturate(1.8);
        -webkit-backdrop-filter: blur(32px) saturate(1.8);
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        transition: background 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
    }
    html.light-theme .navbar-main {
        background: rgba(255, 255, 255, 0.82);
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    }
    .navbar-main.scrolled {
        background: rgba(8, 11, 18, 0.95);
        box-shadow: 0 1px 0 rgba(255, 255, 255, 0.04), 0 8px 32px rgba(0, 0, 0, 0.3);
    }
    html.light-theme .navbar-main.scrolled {
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.04), 0 8px 32px rgba(0, 0, 0, 0.06);
    }
    .navbar-inner {
        max-width: 1200px; margin: 0 auto;
        padding: 0.75rem 2rem;
        display: flex; justify-content: space-between; align-items: center; gap: 1rem;
    }
    .navbar-main.scrolled .navbar-inner { padding: 0.5rem 2rem; }

    /* Logo */
    .nav-logo {
        display: inline-flex; align-items: center; gap: 0.6rem;
        text-decoration: none; flex-shrink: 0;
    }
    .nav-logo-icon {
        width: 36px; height: 36px; border-radius: 10px;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 1rem; color: #fff;
        background: linear-gradient(135deg, #00d9ff, #00b35c);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .nav-logo:hover .nav-logo-icon { transform: scale(1.08) rotate(-6deg); }
    .nav-logo-text, .drawer-logo-text {
        font-family: 'Space Grotesk', 'Noto Sans Bengali', sans-serif;
        font-size: 1.2rem; font-weight: 700; letter-spacing: -0.5px;
        color: #f1f5f9; line-height: 1; white-space: nowrap;
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

    /* Desktop Nav Links */
    .nav-links { display: flex; gap: 0.2rem; list-style: none; align-items: center; margin: 0; padding: 0; }
    .nav-links li { list-style: none; }
    .nav-links a {
        position: relative;
        color: #94a3b8; font-weight: 500; font-size: 0.875rem;
        padding: 0.5rem 0.85rem; border-radius: 8px;
        text-decoration: none; white-space: nowrap;
        transition: color 0.2s, background 0.2s;
    }
    html.light-theme .nav-links a { color: #475569; }
    .nav-links a:hover { color: #f1f5f9; background: rgba(255, 255, 255, 0.06); }
    html.light-theme .nav-links a:hover { color: #0f172a; background: rgba(0, 0, 0, 0.04); }
    .nav-links a.nav-active { color: #00d9ff; background: rgba(0, 217, 255, 0.08); font-weight: 600; }
    html.light-theme .nav-links a.nav-active { color: #0891b2; background: rgba(8, 145, 178, 0.08); }

    /* Action Buttons */
    .nav-action-login {
        color: #94a3b8 !important; border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 0.4rem 0.9rem !important; border-radius: 8px !important; font-weight: 500 !important;
    }
    .nav-action-login:hover { color: #f1f5f9 !important; background: rgba(255, 255, 255, 0.06) !important; border-color: rgba(255, 255, 255, 0.15) !important; }
    html.light-theme .nav-action-login { color: #475569 !important; border-color: rgba(0, 0, 0, 0.1) !important; }
    html.light-theme .nav-action-login:hover { color: #0f172a !important; background: rgba(0, 0, 0, 0.04) !important; border-color: rgba(0, 0, 0, 0.15) !important; }
    .nav-action-signup {
        background: #00d9ff !important; color: #06121c !important;
        border: none !important; box-shadow: 0 2px 12px rgba(0, 217, 255, 0.3);
        padding: 0.4rem 0.9rem !important; border-radius: 8px !important; font-weight: 600 !important;
        transition: transform 0.2s, box-shadow 0.2s !important;
    }
    .nav-action-signup:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0, 217, 255, 0.4) !important; }
    .nav-action-admin {
        background: rgba(0, 217, 255, 0.08) !important; color: #7ce6ff !important;
        border: 1px solid rgba(0, 217, 255, 0.15) !important; font-weight: 600 !important;
    }
    html.light-theme .nav-action-admin { color: #0891b2 !important; border-color: rgba(8, 145, 178, 0.2) !important; background: rgba(8, 145, 178, 0.06) !important; }
    .nav-action-logout {
        color: #94a3b8 !important; border: 1px solid rgba(255, 255, 255, 0.1) !important; font-weight: 500 !important;
    }
    .nav-action-logout:hover { color: #f87171 !important; background: rgba(248, 113, 113, 0.08) !important; border-color: rgba(248, 113, 113, 0.2) !important; }
    html.light-theme .nav-action-logout { color: #64748b !important; border-color: rgba(0, 0, 0, 0.1) !important; }
    html.light-theme .nav-action-logout:hover { color: #dc2626 !important; border-color: rgba(220, 38, 38, 0.2) !important; }

    /* Right Group */
    .nav-right-group {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* Theme Toggle */
    .theme-toggle-btn {
        width: 34px; height: 34px;
        border-radius: 8px; border: 1px solid rgba(255, 255, 255, 0.08);
        background: transparent;
        color: #64748b; font-size: 0.95rem;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.2s;
        padding: 0;
    }
    .theme-toggle-btn:hover {
        color: #f1f5f9;
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(255, 255, 255, 0.12);
    }
    html.light-theme .theme-toggle-btn {
        color: #64748b;
        border-color: rgba(0, 0, 0, 0.08);
    }
    html.light-theme .theme-toggle-btn:hover {
        color: #f59e0b;
        background: rgba(245, 158, 11, 0.06);
        border-color: rgba(245, 158, 11, 0.15);
    }

    /* Hamburger */
    .hamburger {
        display: none; flex-direction: column; gap: 5px;
        cursor: pointer; z-index: 1002; padding: 6px;
        background: transparent; border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 8px; transition: all 0.2s;
    }
    .hamburger:hover {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(255, 255, 255, 0.12);
    }
    .hamburger span {
        display: block; width: 18px; height: 1.5px;
        background: #94a3b8; border-radius: 2px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        transform-origin: center;
    }
    html.light-theme .hamburger { border-color: rgba(0, 0, 0, 0.1); }
    html.light-theme .hamburger:hover { background: rgba(0, 0, 0, 0.04); border-color: rgba(0, 0, 0, 0.15); }
    html.light-theme .hamburger span { background: #475569; }
    .hamburger.active {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(255, 255, 255, 0.12);
    }
    .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(4.5px, 4.5px); }
    .hamburger.active span:nth-child(2) { opacity: 0; transform: scaleX(0); }
    .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(4.5px, -4.5px); }

    /* Language Switcher */
    .lang-switcher { display: flex; align-items: center; gap: 2px; margin: 0 0.25rem; }
    .lang-btn {
        color: #475569; font-size: 0.75rem; font-weight: 600;
        padding: 3px 7px; border-radius: 6px;
        transition: all 0.2s;
        text-decoration: none !important;
    }
    .lang-btn:hover { color: #94a3b8; }
    .lang-btn.active { color: #00d9ff; background: rgba(0, 217, 255, 0.08); }
    html.light-theme .lang-btn { color: #64748b; }
    html.light-theme .lang-btn:hover { color: #334155; }
    html.light-theme .lang-btn.active { color: #0891b2; background: rgba(8, 145, 178, 0.08); }
    .lang-divider { color: #334155; font-size: 0.7rem; }
    html.light-theme .lang-divider { color: #cbd5e1; }

    /* ===== Mobile Drawer ===== */
    .mobile-backdrop {
        position: fixed; inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1001;
        opacity: 0; visibility: hidden;
        transition: opacity 0.3s, visibility 0.3s;
        cursor: pointer;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    .mobile-backdrop.show { opacity: 1; visibility: visible; }
    html.light-theme .mobile-backdrop { background: rgba(0, 0, 0, 0.3); }

    .mobile-drawer {
        position: fixed;
        top: 0; right: 0;
        width: 80%; max-width: 320px;
        height: 100vh; height: 100dvh;
        z-index: 1002;
        background: rgba(10, 13, 22, 0.98);
        backdrop-filter: blur(32px);
        -webkit-backdrop-filter: blur(32px);
        display: flex; flex-direction: column;
        transform: translateX(100%);
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        border-left: 1px solid rgba(255, 255, 255, 0.04);
    }
    html.light-theme .mobile-drawer {
        background: rgba(255, 255, 255, 0.98);
        border-left: 1px solid rgba(0, 0, 0, 0.06);
    }
    .mobile-drawer.open { transform: translateX(0); }

    .drawer-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 1rem 1.2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        flex-shrink: 0;
    }
    html.light-theme .drawer-header { border-bottom-color: rgba(0, 0, 0, 0.06); }
    .drawer-logo {
        display: inline-flex; align-items: center; gap: 0.55rem;
        text-decoration: none; min-width: 0;
    }
    .drawer-logo .nav-logo-icon { width: 32px; height: 32px; font-size: 0.9rem; border-radius: 9px; }
    .drawer-logo-text { font-size: 1.1rem; overflow: hidden; text-overflow: ellipsis; }
    .drawer-close {
        width: 32px; height: 32px; border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        background: transparent;
        color: #64748b; font-size: 0.9rem;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.2s; padding: 0;
    }
    html.light-theme .drawer-close { border-color: rgba(0, 0, 0, 0.08); }
    .drawer-close:hover {
        background: rgba(255, 255, 255, 0.06);
        color: #f1f5f9;
    }
    html.light-theme .drawer-close:hover { background: rgba(0, 0, 0, 0.04); color: #0f172a; }

    .drawer-body {
        flex: 1; padding: 0.5rem 0.75rem 1rem;
        display: flex; flex-direction: column; overflow-y: auto;
    }
    .drawer-nav { list-style: none; padding: 0; margin: 0; }
    .drawer-nav + .drawer-nav { margin-top: 0.25rem; }
    .drawer-nav li {
        margin-bottom: 2px;
        opacity: 0; transform: translateX(16px);
        transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .mobile-drawer.open .drawer-nav li { opacity: 1; transform: translateX(0); }
    .mobile-drawer.open .drawer-nav li:nth-child(1) { transition-delay: 0.03s; }
    .mobile-drawer.open .drawer-nav li:nth-child(2) { transition-delay: 0.06s; }
    .mobile-drawer.open .drawer-nav li:nth-child(3) { transition-delay: 0.09s; }
    .mobile-drawer.open .drawer-nav li:nth-child(4) { transition-delay: 0.12s; }
    .mobile-drawer.open .drawer-nav li:nth-child(5) { transition-delay: 0.15s; }
    .mobile-drawer.open .drawer-nav li:nth-child(6) { transition-delay: 0.18s; }
    .mobile-drawer.open .drawer-nav li:nth-child(7) { transition-delay: 0.21s; }

    .drawer-nav a,
    .drawer-nav button {
        display: flex; align-items: center; gap: 0.7rem;
        padding: 0.65rem 0.8rem; border-radius: 10px;
        font-size: 0.9rem; font-weight: 500;
        color: #94a3b8; text-decoration: none;
        transition: all 0.15s;
        width: 100%; background: none; border: none;
        cursor: pointer; font-family: inherit; text-align: left;
    }
    html.light-theme .drawer-nav a, html.light-theme .drawer-nav button { color: #475569; }
    .drawer-nav a i, .drawer-nav button i {
        width: 20px; text-align: center; font-size: 1rem;
        color: #475569; transition: color 0.15s;
    }
    html.light-theme .drawer-nav a i, html.light-theme .drawer-nav button i { color: #94a3b8; }
    .drawer-nav a:hover { background: rgba(255, 255, 255, 0.04); color: #f1f5f9; }
    .drawer-nav a:hover i { color: #f1f5f9; }
    html.light-theme .drawer-nav a:hover { background: rgba(0, 0, 0, 0.03); color: #0f172a; }
    html.light-theme .drawer-nav a:hover i { color: #0f172a; }
    .drawer-nav a.active { background: rgba(0, 217, 255, 0.08); color: #00d9ff; }
    .drawer-nav a.active i { color: #00d9ff; }
    html.light-theme .drawer-nav a.active { background: rgba(8, 145, 178, 0.08); color: #0891b2; }
    html.light-theme .drawer-nav a.active i { color: #0891b2; }

    .drawer-divider {
        height: 1px; background: rgba(255, 255, 255, 0.04);
        margin: 0.35rem 0.8rem;
    }
    html.light-theme .drawer-divider { background: rgba(0, 0, 0, 0.06); }

    .drawer-login-btn {
        justify-content: center !important;
        background: rgba(255, 255, 255, 0.04) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        color: #94a3b8 !important; font-weight: 600 !important;
    }
    html.light-theme .drawer-login-btn { background: rgba(0, 0, 0, 0.03) !important; border-color: rgba(0, 0, 0, 0.08) !important; color: #475569 !important; }
    .drawer-login-btn:hover { background: rgba(255, 255, 255, 0.06) !important; color: #f1f5f9 !important; }
    .drawer-signup-btn {
        justify-content: center !important;
        background: #00d9ff !important; border: none !important;
        color: #06121c !important; font-weight: 600 !important;
        box-shadow: 0 2px 12px rgba(0, 217, 255, 0.3);
    }
    .drawer-signup-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0, 217, 255, 0.4) !important; }
    .drawer-logout-btn { color: #94a3b8 !important; }
    html.light-theme .drawer-logout-btn { color: #64748b !important; }
    .drawer-logout-btn:hover { background: rgba(248, 113, 113, 0.06) !important; color: #f87171 !important; }
    .drawer-admin-btn { color: #7ce6ff !important; border: 1px solid rgba(0, 217, 255, 0.12) !important; }
    html.light-theme .drawer-admin-btn { color: #0891b2 !important; border-color: rgba(8, 145, 178, 0.15) !important; }
    .drawer-admin-btn:hover { background: rgba(0, 217, 255, 0.06) !important; }

    .drawer-footer {
        margin-top: auto;
        padding: 0.75rem 0.5rem 0.35rem;
        border-top: 1px solid rgba(255, 255, 255, 0.04);
        display: flex; justify-content: center; gap: 0.4rem;
    }
    html.light-theme .drawer-footer { border-top-color: rgba(0, 0, 0, 0.06); }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .navbar-inner { padding: 0.65rem 1rem; }
        .navbar-main.scrolled .navbar-inner { padding: 0.45rem 1rem; }
        .nav-logo-text, .drawer-logo-text { font-size: 1.1rem; }
        .nav-logo-icon { width: 34px; height: 34px; }
        .nav-links { display: none !important; }
        .hamburger { display: flex; }
        .nav-right-group { gap: 0.15rem; }
        .theme-toggle-btn { width: 32px; height: 32px; font-size: 0.9rem; }
    }
    @media (max-width: 480px) {
        .navbar-inner { padding: 0.55rem 0.75rem; }
        .navbar-main.scrolled .navbar-inner { padding: 0.4rem 0.75rem; }
        .nav-logo-text, .drawer-logo-text { font-size: 1rem; }
        .nav-logo-icon { width: 30px; height: 30px; font-size: 0.85rem; border-radius: 8px; }
        .nav-logo { gap: 0.45rem; }
        .hamburger { padding: 5px; }
        .hamburger span { width: 16px; }
        .hamburger.active span:nth-child(1), .hamburger.active span:nth-child(3) { width: 14px; }
        .theme-toggle-btn { width: 28px; height: 28px; font-size: 0.8rem; }
        .lang-btn { font-size: 0.65rem; padding: 2px 5px; }
        .drawer-header { padding: 0.8rem 1rem; }
        .drawer-logo-text { font-size: 0.95rem; }
        .drawer-close { width: 28px; height: 28px; font-size: 0.8rem; }
        .drawer-body { padding: 0.3rem 0.5rem 0.75rem; }
        .drawer-nav a, .drawer-nav button { font-size: 0.85rem; padding: 0.55rem 0.7rem; }
        .drawer-nav a i, .drawer-nav button i { font-size: 0.9rem; width: 18px; }
        .drawer-nav li { margin-bottom: 2px; }
        .drawer-divider { margin: 0.25rem 0.6rem; }
        .drawer-footer { padding: 0.5rem 0.25rem 0.25rem; }
    }

    body.menu-open { overflow: hidden !important; }
</style>

<nav class="navbar-main" id="navbar">
    <div class="navbar-inner">
    <!-- Logo -->
    <a href="/" class="nav-logo">
        <span class="nav-logo-icon"><i class="bi bi-shield-fill-check"></i></span>
        @php
            $siteName = optional($account)->name ? trim($account->name) : '';
            $nameWords = $siteName !== '' ? explode(' ', $siteName) : [];
            $firstName = $nameWords ? array_shift($nameWords) : '';
            $accentName = $nameWords ? implode(' ', $nameWords) : '';
        @endphp
        <span class="nav-logo-text">@if($siteName !== ''){{ $firstName }}@else Sajal Kumar @endif @if($accentName !== '')<span class="nav-logo-accent">{{ $accentName }}</span>@else<span class="nav-logo-accent">Sen</span>@endif</span>
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
            @php
                $drawerName = optional($account)->name ? trim($account->name) : '';
                $drawerWords = $drawerName !== '' ? explode(' ', $drawerName) : [];
                $drawerFirst = $drawerWords ? array_shift($drawerWords) : '';
                $drawerAccent = $drawerWords ? implode(' ', $drawerWords) : '';
            @endphp
            <span class="drawer-logo-text">@if($drawerName !== ''){{ $drawerFirst }}@else Sajal Kumar @endif @if($drawerAccent !== '')<span class="nav-logo-accent">{{ $drawerAccent }}</span>@else<span class="nav-logo-accent">Sen</span>@endif</span>
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
