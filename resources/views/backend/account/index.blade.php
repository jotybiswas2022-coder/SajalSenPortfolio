@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .account-page h4 { font-size: 0.9rem; }
    .account-page h3 { font-size: 1rem; }
    .account-page h6 { font-size: 0.82rem; }
    .account-page .text-muted { font-size: 0.75rem; }
    .account-page .btn { font-size: 0.72rem; padding: 0.25rem 0.6rem; }
    .account-page .card-body { padding: 0.8rem !important; }
}

/* ===== Account Index — Cyber Admin Dashboard ===== */
.account-page {
    --ae-cyan: #00d9ff;
    --ae-cyan-d: #00a2c9;
    --ae-green: #00ff88;
    --ae-slate: #1e293b;
    --ae-muted: #64748b;
}
.ae-page-header {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0b1220 100%);
    border: 1px solid rgba(0, 217, 255, 0.15);
    border-radius: 18px;
    padding: 22px 24px;
    overflow: hidden;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}
.ae-page-header::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 2px;
    background: linear-gradient(90deg, transparent, var(--ae-green), var(--ae-cyan), transparent);
    background-size: 60% 100%; background-repeat: no-repeat;
    animation: aeSweep 4s linear infinite;
    pointer-events: none;
}
.ae-page-header::after {
    content: ''; position: absolute; top: -40px; right: -40px;
    width: 160px; height: 160px; border-radius: 50%;
    background: radial-gradient(circle, rgba(0,217,255,0.15), transparent 70%);
    pointer-events: none;
}
@keyframes aeSweep { 0% { background-position: -60% 0; } 100% { background-position: 160% 0; } }
.ae-title {
    position: relative; z-index: 1;
    color: #fff; font-weight: 800; font-size: 1.4rem;
    display: flex; align-items: center; gap: 0.7rem;
}
.ae-sub { position: relative; z-index: 1; color: rgba(226, 232, 240, 0.75); font-size: 0.85rem; margin: 0; }
.ae-badge {
    display: inline-flex; align-items: center; gap: 0.4rem;
    background: rgba(0, 255, 136, 0.12); color: var(--ae-green);
    border: 1px solid rgba(0, 255, 136, 0.3);
    font-size: 0.68rem; font-weight: 700; letter-spacing: 0.5px;
    padding: 0.25rem 0.7rem; border-radius: 50px; text-transform: uppercase;
}
.ae-badge .ae-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--ae-green); animation: aeDot 1.8s ease-out infinite; }
@keyframes aeDot { 0% { box-shadow: 0 0 0 0 rgba(0,255,136,0.6);} 100% { box-shadow: 0 0 0 9px rgba(0,255,136,0);} }
.ae-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 0.45rem;
    border-radius: 10px; font-weight: 600; font-size: 0.85rem;
    transition: all .2s ease; border: none; cursor: pointer;
    text-decoration: none;
}
.ae-btn-primary {
    background: linear-gradient(135deg, var(--ae-cyan), var(--ae-cyan-d));
    color: #fff; padding: 0.6rem 1.5rem; box-shadow: 0 6px 20px rgba(0,217,255,0.3);
}
.ae-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,217,255,0.42); color: #fff; }
.ae-btn-ghost { background: var(--admin-card-bg-2); color: var(--admin-text); border: 1.5px solid var(--admin-border); padding: 0.6rem 1.4rem; }
.ae-btn-ghost:hover { border-color: var(--ae-cyan); color: var(--ae-cyan); background: rgba(0,217,255,0.08); }

/* ===== Profile Hero ===== */
.ae-hero {
    position: relative;
    background: var(--admin-card-bg);
    border: 1px solid var(--admin-border);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 8px 34px rgba(0,0,0,0.06);
}
.ae-hero::before {
    content: '';
    position: absolute; inset: 0; pointer-events: none;
    background:
        linear-gradient(rgba(0,217,255,0.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,217,255,0.035) 1px, transparent 1px);
    background-size: 34px 34px;
    -webkit-mask-image: radial-gradient(ellipse 60% 80% at 20% 30%, rgba(0,0,0,0.6), transparent 80%);
    mask-image: radial-gradient(ellipse 60% 80% at 20% 30%, rgba(0,0,0,0.6), transparent 80%);
}
.ae-hero .ae-hero-strip {
    position: absolute; top: 0; left: 0; right: 0; height: 4px;
    background: linear-gradient(90deg, var(--ae-cyan), var(--ae-green));
}
.ae-hero-body { position: relative; padding: 2rem; }
.ae-avatar-ring {
    width: 140px; height: 140px; flex-shrink: 0;
    border-radius: 50%; padding: 5px;
    background: conic-gradient(from 0deg, var(--ae-cyan), var(--ae-green), var(--ae-cyan));
    box-shadow: 0 12px 30px rgba(0,217,255,0.28);
}
.ae-avatar-inner {
    width: 100%; height: 100%; border-radius: 50%; overflow: hidden;
    background: var(--admin-bg-soft); border: 4px solid var(--admin-card-bg);
    display: flex; align-items: center; justify-content: center;
}
.ae-avatar-inner img { width: 100%; height: 100%; object-fit: cover; display: block; }
.ae-avatar-inner .ae-avatar-ph { color: var(--admin-text-muted); font-size: 3rem; font-weight: 700; }
.ae-hero-name {
    font-weight: 800; font-size: 1.75rem; color: var(--admin-text);
    display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap;
}
.ae-hero-line {
    display: flex; align-items: center; gap: 0.5rem;
    color: var(--admin-text-muted); font-size: 0.9rem; margin-bottom: 0.35rem;
}
.ae-hero-line i { color: var(--ae-cyan); font-size: 1rem; }
.ae-chip {
    display: inline-flex; align-items: center; gap: 0.4rem;
    background: var(--admin-bg-soft); border: 1px solid var(--admin-border); border-radius: 50px;
    padding: 0.4rem 0.9rem; font-size: 0.78rem; font-weight: 600; color: var(--admin-text);
}
.ae-chip i { color: var(--ae-cyan); }

/* ===== Links Grid Tiles ===== */
.ae-panel {
    background: var(--admin-card-bg);
    border: 1px solid var(--admin-border);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(0,0,0,0.05);
    transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
}
.ae-panel:hover { transform: translateY(-3px); box-shadow: 0 16px 44px rgba(0,217,255,0.10); border-color: rgba(0,217,255,0.35); }
.ae-panel .ae-card-head {
    display: flex; align-items: center; justify-content: space-between; gap: 1rem;
    padding: 1rem 1.5rem;
    background: linear-gradient(135deg, var(--admin-card-bg-2), rgba(0,217,255,0.05));
    border-bottom: 1px solid var(--admin-border); position: relative;
}
.ae-panel .ae-card-head::after {
    content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
    background: linear-gradient(180deg, var(--ae-cyan), var(--ae-green));
}
.ae-panel .ae-head-title { font-weight: 700; color: var(--admin-text); font-size: 1rem; margin: 0; display: flex; align-items: center; gap: 0.6rem; }
.ae-panel .ae-head-title i { color: var(--ae-cyan); }
.ae-panel .ae-card-body { padding: 1.5rem; }
.ae-link-tile {
    display: inline-flex; align-items: center; gap: 0.6rem;
    padding: 0.65rem 1.1rem; border-radius: 12px;
    background: var(--admin-bg-soft); border: 1.5px solid var(--admin-border);
    font-weight: 600; font-size: 0.85rem; color: var(--admin-text); text-decoration: none;
    transition: all .2s ease;
}
.ae-link-tile i, .ae-link-tile svg { font-size: 1.05rem; }
.ae-link-tile:hover {
    border-color: var(--ae-cyan); background: rgba(0,217,255,0.08);
    transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,217,255,0.16);
}
.ae-empty-note { color: var(--admin-text-muted); font-size: 0.85rem; }

@media (max-width: 767.98px) {
    .ae-page-header, .ae-hero-body { padding: 16px; }
    .ae-hero-name { font-size: 1.3rem; }
    .ae-avatar-ring { width: 100px; height: 100px; }
    .ae-panel .ae-card-body { padding: 1rem; }
}
</style>

<div class="container-fluid py-3 account-page">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            {{-- Header --}}
            <div class="ae-page-header mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-person-gear" style="font-size:1.5rem;color:#00d9ff;"></i>
                    </div>
                    <div class="d-flex flex-column align-items-start gap-1">
                        <div class="ae-title">Account Profile</div>
                        <p class="ae-sub">Your identity, contact details and online presence.</p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="ae-badge"><span class="ae-dot"></span> Live Profile</span>
                    <a href="{{ route('admin.account.edit') }}" class="ae-btn ae-btn-primary">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                </div>
            </div>

            {{-- Profile Hero --}}
            <div class="ae-hero mb-4">
                <div class="ae-hero-strip"></div>
                <div class="ae-hero-body">
                    <div class="row align-items-center g-4">
                        <div class="col-md-auto text-center d-flex justify-content-center">
                            <div class="ae-avatar-ring">
                                <div class="ae-avatar-inner">
                                    @if(isset($account) && $account->image)
                                        <img src="{{ config('app.storage_url') }}{{ $account->image }}" alt="{{ $account->name ?? 'User' }}">
                                    @else
                                        <div class="ae-avatar-ph">{{ isset($account->name) ? strtoupper(substr($account->name, 0, 1)) : 'U' }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="d-flex flex-wrap gap-2 align-items-center mb-1">
                                <span class="badge" style="background:rgba(0,255,136,0.12);color:var(--ae-green);border:1px solid rgba(0,255,136,0.3);font-weight:600;">
                                    <i class="bi bi-shield-check me-1"></i>Profile Owner
                                </span>
                                <span class="badge" style="background:rgba(0,217,255,0.1);color:var(--ae-cyan-d);border:1px solid rgba(0,217,255,0.3);font-weight:600;">
                                    <i class="bi bi-patch-check-fill me-1"></i>Admin
                                </span>
                            </div>
                            <h3 class="ae-hero-name mb-2">{{ $account->name ?? 'Not set' }}</h3>
                            <div class="d-flex flex-column gap-1 mb-3">
                                @if(isset($account) && $account->email)
                                    <span class="ae-hero-line"><i class="bi bi-envelope-fill"></i>{{ $account->email }}</span>
                                @endif
                                @if(isset($account) && $account->phone)
                                    <span class="ae-hero-line"><i class="bi bi-whatsapp" style="color:#25D366;"></i>{{ $account->phone }}</span>
                                @endif
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                @if(isset($account) && $account->cv)
                                    <a href="{{ config('app.storage_url') }}{{ $account->cv }}" target="_blank"
                                       class="ae-link-tile text-danger">
                                        <i class="bi bi-file-earmark-pdf" style="color:#ef4444;"></i> View CV
                                    </a>
                                @else
                                    <span class="ae-chip"><i class="bi bi-file-earmark"></i> No CV uploaded</span>
                                @endif
                                <span class="ae-chip"><i class="bi bi-calendar-check"></i>Account Active</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Links --}}
            @if(isset($account) && ($account->github || $account->linkedin || $account->facebook || $account->instagram || $account->twitter || $account->youtube))
            <div class="ae-panel mb-4">
                <div class="ae-card-head">
                    <h6 class="ae-head-title"><i class="bi bi-share"></i>Social Links</h6>
                    <span class="ae-badge" style="font-size:0.62rem;">Network</span>
                </div>
                <div class="ae-card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @if($account->github)
                            <a href="{{ $account->github }}" target="_blank" class="ae-link-tile"><i class="bi bi-github"></i> GitHub</a>
                        @endif
                        @if($account->linkedin)
                            <a href="{{ $account->linkedin }}" target="_blank" class="ae-link-tile"><i class="bi bi-linkedin" style="color:#0a66c2;"></i> LinkedIn</a>
                        @endif
                        @if($account->facebook)
                            <a href="{{ $account->facebook }}" target="_blank" class="ae-link-tile"><i class="bi bi-facebook" style="color:#1877f2;"></i> Facebook</a>
                        @endif
                        @if($account->instagram)
                            <a href="{{ $account->instagram }}" target="_blank" class="ae-link-tile"><i class="bi bi-instagram" style="color:#E4405F;"></i> Instagram</a>
                        @endif
                        @if($account->twitter)
                            <a href="{{ $account->twitter }}" target="_blank" class="ae-link-tile"><i class="bi bi-twitter-x"></i> Twitter</a>
                        @endif
                        @if($account->youtube)
                            <a href="{{ $account->youtube }}" target="_blank" class="ae-link-tile"><i class="bi bi-youtube" style="color:#ef4444;"></i> YouTube</a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- Freelance Profiles --}}
            @if(isset($account) && ($account->fiverr || $account->upwork || $account->freelancer))
            <div class="ae-panel mb-4">
                <div class="ae-card-head">
                    <h6 class="ae-head-title"><i class="bi bi-briefcase"></i>Freelance Profiles</h6>
                    <span class="ae-badge" style="font-size:0.62rem;">Marketplace</span>
                </div>
                <div class="ae-card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @if($account->fiverr)
                            <a href="{{ $account->fiverr }}" target="_blank" class="ae-link-tile">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1em;height:1em;vertical-align:middle"><rect width="24" height="24" rx="5" fill="#1DBF73"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="14" font-family="Arial,sans-serif">f</text></svg> Fiverr
                            </a>
                        @endif
                        @if($account->upwork)
                            <a href="{{ $account->upwork }}" target="_blank" class="ae-link-tile"><i class="fab fa-upwork" style="color:#6FDA44;"></i> Upwork</a>
                        @endif
                        @if($account->freelancer)
                            <a href="{{ $account->freelancer }}" target="_blank" class="ae-link-tile"><i class="fas fa-user-tie" style="color:#29B2FE;"></i> Freelancer</a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            @if(!isset($account))
                <div class="ae-panel">
                    <div class="ae-card-body text-center py-5">
                        <i class="bi bi-person-x" style="font-size:3rem;color:#cbd5e1;"></i>
                        <p class="ae-empty-note mt-2">No account data available yet.</p>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
