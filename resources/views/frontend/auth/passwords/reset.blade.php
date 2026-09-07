<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ config('app.name', 'Portfolio') }} | {{ __('Reset Password') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Space Grotesk + Hind Siliguri Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.add('light-theme');
        }
    </script>

    <style>
    html.light-theme body { background: #f8fafc !important; }
    html.light-theme .login-card { background: rgba(255,255,255,0.85) !important; border-color: rgba(0,217,255,0.2) !important; }
    html.light-theme .login-card:hover { border-color: rgba(0,217,255,0.35) !important; box-shadow: 0 30px 80px rgba(0,0,0,0.1), 0 0 60px rgba(0,217,255,0.15) !important; }
    html.light-theme .login-header { background: linear-gradient(135deg, #f8fafc, #e2e8f0) !important; color: #111827 !important; border-bottom-color: rgba(0,217,255,0.2) !important; }
    html.light-theme .header-icon svg { stroke: #00d9ff !important; }
    html.light-theme .login-label { color: #475569 !important; }
    html.light-theme .login-input { background: #ffffff !important; color: #111827 !important; border-color: rgba(0,217,255,0.2) !important; }
    html.light-theme .login-input:focus { border-color: #00d9ff !important; box-shadow: 0 0 0 5px rgba(0,217,255,0.15) !important; }

    body { font-family: 'Space Grotesk', 'Hind Siliguri', sans-serif; background: #111827; margin:0; padding:0; overflow-x: hidden; }
    .login-container { min-height: 100vh; display: flex; justify-content: center; align-items: center; position: relative; padding: 20px; }
    .login-container::before {
        content:''; position:absolute; top:-50%; left:-50%; width:200%; height:200%;
        background: radial-gradient(ellipse at 20% 50%, rgba(0,217,255,0.12) 0%, transparent 50%),
                    radial-gradient(ellipse at 80% 20%, rgba(0,217,255,0.08) 0%, transparent 50%),
                    radial-gradient(ellipse at 50% 80%, rgba(0,217,255,0.06) 0%, transparent 50%);
        animation: bgPulse 8s ease-in-out infinite alternate; z-index:0;
    }
    @keyframes bgPulse {0%{transform:scale(1) rotate(0deg);}100%{transform:scale(1.1) rotate(3deg);}}
    .particles { position:absolute; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:0; }
    .particle { position:absolute; border-radius:50%; background: rgba(0,217,255,0.4); animation: floatUp linear infinite; }
    @keyframes floatUp {0%{transform:translateY(100vh) scale(0);opacity:0;}10%{opacity:1;}90%{opacity:1;}100%{transform:translateY(-10vh) scale(1);opacity:0;}}
    .login-wrapper { width: 100%; max-width: 420px; z-index:1; padding-bottom: 40px; }
    .login-card {
        background: rgba(20,28,45,0.95); border-radius:36px;
        box-shadow:0 25px 60px rgba(0,0,0,0.6),0 0 40px rgba(0,217,255,0.2);
        transition: all 0.5s cubic-bezier(0.16,1,0.3,1);
        backdrop-filter: blur(28px); border:1px solid rgba(0,217,255,0.2);
        opacity:0; transform: translateY(20px); animation: cardEntry 0.8s forwards;
    }
    .login-card:hover {
        border-color: rgba(0,217,255,0.3) !important;
        box-shadow: 0 30px 80px rgba(0,0,0,0.55), 0 0 60px rgba(0,217,255,0.12) !important;
        transform: translateY(-2px);
    }
    .login-header {
        background: linear-gradient(135deg,#111827,#1e293b); color:#fff;
        text-align:center; font-size:22px; font-weight:700;
        padding:28px 20px; border-radius:36px 36px 0 0;
        border-bottom:1px solid rgba(0,217,255,0.25);
        display:flex; flex-direction:column; align-items:center; gap:16px;
    }
    .header-icon { width:50px; height:50px; background: linear-gradient(135deg,#00d9ff,#00a2c9); border-radius:16px; display:flex; align-items:center; justify-content:center; box-shadow:0 12px 35px rgba(0,217,255,0.4); transition: all 0.3s ease; }
    .header-icon:hover { transform:scale(1.1); }
    .header-icon svg { width:24px; height:24px; }
    .login-body { padding:28px 32px; display:flex; flex-direction:column; gap:18px; }
    .login-label { font-weight:500; color:#94a3b8; font-size:14px; margin-bottom:6px; display:block; line-height:1.6; }
    .login-input {
        border-radius:16px; padding:12px 16px; font-size:15px;
        border:1px solid rgba(0,217,255,0.25);
        background: rgba(17,24,39,0.55);
        color:#ffffff !important;
        width:100%; line-height:1.5;
        transition: all 0.3s ease;
    }
    .login-input:focus {
        border-color:#00d9ff;
        box-shadow:0 0 0 5px rgba(0,217,255,0.2),0 0 20px rgba(0,217,255,0.15);
        background: rgba(17,24,39,0.75);
        color:#f1f5f9;
        outline:none;
    }
    .login-btn {
        background: linear-gradient(135deg,#00d9ff,#00a2c9);
        border:none; color:#fff;
        padding:14px; font-size:15px; border-radius:32px;
        font-weight:600; width:100%;
        display:flex; align-items:center; justify-content:center; gap:8px;
        transition:all 0.3s ease;
    }
    .login-btn:hover {
        transform:scale(1.03);
        box-shadow:0 12px 28px rgba(0,217,255,0.45);
    }
    .input-group-animated {
        animation: inputSlide 0.6s forwards;
        opacity:0; transform:translateY(20px);
    }
    .input-group-animated:nth-child(1) { animation-delay:0.1s; }
    .input-group-animated:nth-child(2) { animation-delay:0.2s; }
    .input-group-animated:nth-child(3) { animation-delay:0.3s; }
    .input-group-animated:nth-child(4) { animation-delay:0.4s; }
    @keyframes inputSlide { to{opacity:1; transform:translateY(0);} }
    @keyframes cardEntry { to{opacity:1; transform:translateY(0);} }
    .invalid-feedback strong { color:#f87171; font-size:13px; }

    @media(max-width:768px){
        .login-wrapper { max-width:92%; padding-bottom:30px; }
        .login-body { padding:24px 24px; gap:16px; }
        .login-header { font-size:20px; padding:22px 16px; }
    }
    @media(max-width:576px){
        .login-wrapper { max-width:95%; }
        .login-card { border-radius:28px; }
        .login-header { font-size:18px; padding:18px 14px; border-radius:28px 28px 0 0; gap:12px; }
        .header-icon { width:44px; height:44px; border-radius:14px; }
        .header-icon svg { width:20px; height:20px; }
        .login-body { padding:18px 16px; gap:14px; }
        .login-input { padding:10px 12px; font-size:14px; border-radius:14px; }
        .login-btn { padding:12px; font-size:14px; border-radius:28px; }
        .login-label { font-size:13px; }
        .particle { display:none; }
    }
    @media(max-width:400px){
        .login-wrapper { max-width:98%; padding-bottom:20px; }
        .login-header { font-size:16px; padding:14px 10px; gap:10px; }
        .header-icon { width:38px; height:38px; border-radius:12px; }
        .header-icon svg { width:18px; height:18px; }
        .login-body { padding:14px 12px; gap:12px; }
        .login-input { padding:8px 10px; font-size:13px; }
        .login-btn { padding:10px; font-size:13px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .login-card { animation: none; }
        .login-container::before { animation: none; }
        .particle { animation: none; }
        .header-icon { transition: none; }
    }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="particles" id="particles"></div>
        <div class="login-wrapper">
            <div class="card login-card">
                <div class="card-header login-header">
                    <div class="header-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            <circle cx="12" cy="16" r="1.5"/>
                            <path d="M12 16v-2"/>
                        </svg>
                    </div>
                    {{ __('Reset Password') }}
                </div>

                <div class="card-body login-body">
                    <form method="POST" action="{{ route('password.update') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-group-animated">
                            <label for="email" class="login-label">Email</label>
                            <input id="email" type="email"
                                   class="form-control login-input @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ $email ?? old('email') }}"
                                   placeholder="you@example.com"
                                   required autofocus>
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group-animated">
                            <label for="password" class="login-label">New Password</label>
                            <input id="password" type="password"
                                   class="form-control login-input @error('password') is-invalid @enderror"
                                   name="password"
                                   placeholder="••••••••"
                                   required>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group-animated">
                            <label for="password-confirm" class="login-label">Confirm Password</label>
                            <input id="password-confirm" type="password"
                                   class="form-control login-input"
                                   name="password_confirmation"
                                   placeholder="••••••••"
                                   required>
                        </div>

                        <div class="input-group-animated">
                            <button type="submit" class="btn login-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
    const particlesContainer=document.getElementById('particles');
    const isMobile=window.innerWidth<=576;
    const particleCount=isMobile?0:30;
    for(let i=0;i<particleCount;i++){
        const p=document.createElement('div');
        p.classList.add('particle');
        const size=Math.random()*5+3;
        p.style.width=size+'px'; p.style.height=size+'px';
        p.style.left=Math.random()*100+'%';
        p.style.animationDuration=(Math.random()*6+6)+'s';
        p.style.animationDelay=(Math.random()*10)+'s';
        p.style.opacity=Math.random()*0.5+0.1;
        particlesContainer.appendChild(p);
    }
    document.querySelectorAll('.login-input').forEach(input=>{
        input.addEventListener('focus',function(){
            this.style.transform='scale(1.02)';
            this.style.transition='transform 0.3s ease';
        });
        input.addEventListener('blur',function(){
            this.style.transform='scale(1)';
        });
    });
    </script>
</body>
</html>
