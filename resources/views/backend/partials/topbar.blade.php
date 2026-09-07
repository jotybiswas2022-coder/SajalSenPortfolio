@php
use Illuminate\Support\Str;
@endphp

<style>
.topbar-link:hover { color:#fff !important; background:rgba(255,255,255,0.08) !important; }
.topbar-link.active-link { color:#fff !important; background:rgba(0,217,255,0.2) !important; }

/* Sidebar toggle button (mobile) */
.sidebar-toggle-btn { display:inline-flex; align-items:center; justify-content:center; background:none; border:none; color:rgba(255,255,255,0.7); font-size:1.3rem; padding:0.25rem 0.5rem; border-radius:6px; cursor:pointer; transition:all 0.2s; line-height:1; }
.sidebar-toggle-btn:hover { color:#fff; background:rgba(255,255,255,0.08); }

@media (max-width: 767.98px) {
    .topbar-link { font-size: 0.78rem !important; padding: 0.3rem 0.65rem !important; }
    .navbar-brand { font-size: 0.9rem !important; }
    .navbar-brand i { font-size: 1.2rem !important; }
}
</style>

<nav class="navbar navbar-expand-md py-0" style="height:auto; min-height:57px; background:linear-gradient(180deg,#111827,#1e293b); border-bottom:1px solid rgba(255,255,255,0.06); box-shadow:0 2px 12px rgba(0,0,0,0.15); color:#fff; position:fixed; top:0; left:0; right:0; z-index:1050;">
    <div class="container-fluid px-3">
        {{-- Sidebar Toggle --}}
        <button class="sidebar-toggle-btn" type="button" aria-label="Toggle navigation sidebar">
            <i class="bi bi-list"></i>
        </button>

        {{-- Brand --}}
        <a class="navbar-brand d-flex align-items-center fw-bold fs-5 py-0" href="/admin" style="color:#fff;">
            <i class="bi bi-speedometer2 me-2 fs-3" style="background:linear-gradient(135deg,#7ce6ff,#6bffb8); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;"></i>
            <span class="d-none d-sm-inline">{{ config('app.name', 'Admin') }}</span>
            <span class="d-sm-none">Admin</span>
        </a>

        {{-- Desktop quick links --}}
        <div class="ms-auto">
            <ul class="navbar-nav gap-1 align-items-center flex-row">
                <li class="nav-item">
                    <a class="nav-link topbar-link {{ request()->is('/') ? 'active-link' : '' }}" href="/" style="color:rgba(255,255,255,0.7); font-size:0.85rem; font-weight:500; padding:0.4rem 0.85rem; border-radius:8px; transition:all 0.2s;">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link topbar-link {{ Str::startsWith(request()->path(), 'admin') ? 'active-link' : '' }}" href="/admin" style="color:rgba(255,255,255,0.7); font-size:0.85rem; font-weight:500; padding:0.4rem 0.85rem; border-radius:8px; transition:all 0.2s;">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link fw-semibold topbar-link" style="color:rgba(255,255,255,0.7); font-size:0.85rem; text-decoration:none; font-weight:500; padding:0.4rem 0.85rem; border-radius:8px; transition:all 0.2s; border:none; background:transparent;">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
