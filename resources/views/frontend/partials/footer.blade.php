<style>
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

    /* Light-theme polish */
    html.light-theme .footer::before {
        background: linear-gradient(90deg, transparent, #0891b2, #059669, #0891b2, transparent);
    }
    html.light-theme .footer-brand h4 {
        background: linear-gradient(135deg, #0891b2, #0d9488, #059669);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    html.light-theme .footer-divider {
        background: linear-gradient(90deg, transparent, #0891b2, transparent);
    }
    html.light-theme .footer-links a::before { color: #0891b2; }
    html.light-theme .footer-links a:hover {
        color: #0e7490;
        border-color: rgba(8, 145, 178, 0.25);
        background: rgba(8, 145, 178, 0.06);
    }
    html.light-theme .social-icon { border-color: rgba(8, 145, 178, 0.18); }
    html.light-theme .social-icon::before {
        background: linear-gradient(135deg, rgba(8, 145, 178, 0.12), rgba(5, 150, 105, 0.08));
    }
    html.light-theme .social-icon:hover {
        border-color: #0891b2; color: #0891b2;
        box-shadow: 0 10px 30px rgba(8, 145, 178, 0.22);
    }
    html.light-theme .footer-bottom { border-top-color: rgba(8, 145, 178, 0.15); }
    html.light-theme .back-top { color: #0891b2; }
    html.light-theme .back-top:hover { color: #0e7490; }

    @media (max-width: 768px) {
        .footer { padding: 2.5rem 1.5rem; }
        .footer-inner { max-width: 100%; }
        .footer-links { gap: 1.2rem; }
        .footer-links a { font-size: 0.82rem; }
        .social-icon { width: 38px; height: 38px; font-size: 1rem; }
        .footer-bottom { flex-direction: column; gap: 0.5rem; text-align: center; }
    }
    @media (max-width: 480px) {
        .footer { padding: 2rem 1rem; }
        .footer-inner { max-width: 100%; }
        .footer-links { gap: 0.8rem; flex-direction: column; align-items: center; }
        .footer-bottom { flex-direction: column; gap: 0.4rem; text-align: center; }
        .footer p, .footer-bottom p, .footer-bottom span { font-size: 0.78rem; }
        .social-icon { width: 36px; height: 36px; font-size: 0.95rem; }
        .back-top { font-size: 0.75rem; }
    }
</style>

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
            <a href="{{ url('/') }}#about">{{ __('messages.about') }}</a>
            <a href="{{ url('/') }}#services">{{ __('messages.services') }}</a>
            <a href="{{ url('/') }}#skills">{{ __('messages.skills') }}</a>
            <a href="{{ url('/') }}#faq">FAQ</a>
            <a href="{{ url('/') }}#contact">{{ __('messages.contact') }}</a>
        </div>

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
            <a href="#" onclick="window.scrollTo({top:0,behavior:'smooth'}); return false;" class="back-top"><i class="bi bi-arrow-up"></i> {{ __('messages.back_to_top') }}</a>
        </div>
    </div>
</footer>