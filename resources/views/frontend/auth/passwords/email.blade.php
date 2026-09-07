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

    <!-- Poppins + Hind Siliguri Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
    html.light-theme .login-label { color: #475569 !important; }
    html.light-theme .login-input { background: #ffffff !important; color: #111827 !important; border-color: rgba(0,217,255,0.2) !important; }
    html.light-theme .login-input:focus { border-color: #00d9ff !important; box-shadow: 0 0 0 5px rgba(0,217,255,0.15) !important; }
    html.light-theme .instructions { color: #475569 !important; }

    body { font-family: 'Poppins', 'Hind Siliguri', sans-serif; background: #111827; margin:0; padding:0; overflow-x: hidden; }
    .login-container {
        min-height: 100vh; display: flex; align-items: center; justify-content: center;
        padding: 40px 12px; position: relative;
    }
    .login-container::before,
    .login-container::after {
        content: ''; position: absolute; border-radius: 50%; z-index: 0;
    }
    .login-container::before {
        top: -150px; left: -100px; width: 400px; height: 400px;
        background: rgba(0,217,255,0.08);
        animation: floatBubble1 8s ease-in-out infinite;
    }
    .login-container::after {
        bottom: -120px; right: -80px; width: 500px; height: 500px;
        background: rgba(0,217,255,0.06);
        animation: floatBubble2 10s ease-in-out infinite;
    }
    @keyframes floatBubble1 {0%,100%{transform:translate(0,0) scale(1);}50%{transform:translate(30px,20px) scale(1.05);}}
    @keyframes floatBubble2 {0%,100%{transform:translate(0,0) scale(1);}50%{transform:translate(-40px,-30px) scale(1.08);}}
    .container { position: relative; z-index: 1; }
    .login-card {
        width: 100%; border-radius: 24px;
        background: rgba(30,41,59,0.85); backdrop-filter: blur(15px);
        border: 1px solid rgba(0,217,255,0.25);
        box-shadow: 0 20px 50px rgba(0,0,0,0.45);
        overflow: hidden; position: relative; z-index: 1;
        transition: all 0.5s cubic-bezier(0.16,1,0.3,1);
        opacity:0; transform: translateY(20px); animation: cardEntry 0.8s forwards;
    }
    .login-card:hover {
        border-color: rgba(0,217,255,0.3) !important;
        box-shadow: 0 30px 80px rgba(0,0,0,0.55), 0 0 60px rgba(0,217,255,0.12) !important;
        transform: translateY(-2px);
    }
    .login-header {
        background: linear-gradient(135deg, rgba(17,24,39,0.95), rgba(26,39,68,0.9));
        color: #fff; text-align: center; font-size: 22px; font-weight: 700;
        padding: 22px; border-bottom: 1px solid rgba(0,217,255,0.25);
        border-radius: 24px 24px 0 0;
    }
    .login-body { padding: 32px 36px; display: flex; flex-direction: column; gap: 20px; }
    .instructions { font-size: 14.5px; color: #94a3b8; line-height: 1.6; text-align: center; margin: 0; }
    .alert-success {
        background: rgba(0,217,255,0.12); border: 1px solid rgba(0,217,255,0.25);
        color: #7ce6ff; border-radius: 12px; font-size: 14px;
        text-align: center; padding: 10px 12px;
    }
    .lock-icon {
        width: 64px; height: 64px; margin: 0 auto;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        background: rgba(0,217,255,0.12); border: 2px solid rgba(0,217,255,0.2);
        transition: transform .3s;
    }
    .lock-icon:hover { transform: scale(1.05); }
    .lock-icon svg { width: 28px; height: 28px; color: #00d9ff; }
    .login-label { color: #94a3b8; font-weight: 500; }
    .login-input {
        background: rgba(17,24,39,0.85); color: #ffffff !important;
        border: 1px solid rgba(0,217,255,0.25); border-radius: 12px;
        padding: 12px 16px; width: 100%; transition: all .3s ease;
    }
    .login-input:focus {
        border-color: #00d9ff; box-shadow: 0 0 0 3px rgba(0,217,255,0.15);
        background: rgba(12,19,34,0.95); outline: none;
    }
    .invalid-feedback strong { color: #f87171; font-size: 13px; }
    .login-btn {
        background: linear-gradient(135deg,#00d9ff,#00a2c9); border: none;
        padding: 12px; font-weight: 600; border-radius: 12px;
        color: #fff; transition: all .3s ease;
    }
    .login-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(0,217,255,.35), 0 0 40px rgba(0,217,255,0.1);
    }
    @keyframes cardEntry { to{opacity:1; transform:translateY(0);} }

    @media(max-width:768px){
        .login-body { padding: 25px 24px; gap:16px; }
        .login-header { font-size: 20px; padding: 22px 16px; }
    }
    @media(max-width:576px){
        .login-card { border-radius: 20px; }
        .login-header { font-size: 18px; padding: 18px 14px; border-radius:20px 20px 0 0; }
        .login-body { padding: 18px 16px; gap:14px; }
        .login-input { padding:10px 12px; font-size:14px; border-radius:10px; }
        .login-btn { padding:12px; font-size:14px; }
        .login-label { font-size:13px; }
        .lock-icon { width:52px; height:52px; }
        .lock-icon svg { width:22px; height:22px; }
        .instructions { font-size:13px; }
    }
    @media(max-width:400px){
        .login-header { font-size: 16px; padding: 14px 10px; }
        .login-body { padding: 14px 12px; gap:12px; }
        .login-input { padding:8px 10px; font-size:13px; }
        .login-btn { padding:10px; font-size:13px; }
        .lock-icon { width:44px; height:44px; }
        .lock-icon svg { width:18px; height:18px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .login-card { animation: none; }
        .login-container::before, .login-container::after { animation: none; }
    }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-7 col-lg-5">
                    <div class="card login-card">
                        <div class="card-header login-header text-center">
                            {{ __('Reset Password') }}
                        </div>

                        <div class="card-body login-body">
                            @if (session('status'))
                                <div class="alert alert-success text-center">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="lock-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 11c1.657 0 3 1.343 3 3v2H9v-2c0-1.657 1.343-3 3-3zm6-2V7a6 6 0 10-12 0v2"/>
                                </svg>
                            </div>

                            <p class="text-center instructions">
                                {{ __('Enter your email address and we will send you a password reset link.') }}
                            </p>

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label login-label">
                                        {{ __('Email') }}
                                    </label>
                                    <input id="email" type="email"
                                           class="form-control login-input @error('email') is-invalid @enderror"
                                           name="email"
                                           placeholder="Enter your email"
                                           value="{{ old('email') }}"
                                           required autofocus>
                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn login-btn w-100">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
