<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="/core/favicon.svg" type="image/svg+xml">
    <link rel="shortcut icon" href="/core/favicon.svg" type="image/svg+xml">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&family=Noto+Sans+Bengali:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-4.0.0.js" integrity="sha256-9fsHeVnKBvqh3FB2HYu7g2xseAZ5MlN6Kz/qnkASV8U=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://junait.com/tiny_pro.js"></script>

    <style>
    :root {
        --admin-sidebar-bg: linear-gradient(180deg, #111827 0%, #1e293b 100%);
        --admin-sidebar-width: 260px;
        --admin-primary: #00d9ff;
        --admin-primary-dark: #00a2c9;
        --admin-bg: #f1f5f9;
        --admin-card-bg: #ffffff;
        --admin-text: #1e293b;
        --admin-text-muted: #64748b;
        --admin-border: #e2e8f0;
        --admin-radius: 12px;
        --admin-topbar-height: 57px;
    }
    html, body { overflow-x: hidden; }
    body {
        font-family: 'Inter', 'Noto Sans Bengali', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: var(--admin-bg);
        color: var(--admin-text);
        -webkit-font-smoothing: antialiased;
    }
    .admin-layout { min-height: calc(100vh - 57px); padding-top: 57px; }
    .admin-main {
        margin-left: 260px !important;
        min-height: calc(100vh - 57px);
        background: var(--admin-bg);
        padding: 1.5rem;
        display: flow-root;
    }
    .sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1039;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    .sidebar-overlay.active {
        opacity: 1;
        pointer-events: auto;
    }
    .page-header {
        background: #fff;
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,.04);
    }
    .admin-table thead {
        background: #f8fafc;
        position: sticky;
        top: 0;
        z-index: 5;
    }
    .admin-table tbody tr:hover {
        background: rgba(0,162,201,.06);
        transition: .18s ease;
    }
    .form-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .form-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    }
    .form-card .card-header {
        background: linear-gradient(135deg, #1e293b, #334155);
        color: #fff;
        padding: 1rem 1.5rem;
    }
    .form-card .card-header h5 { margin: 0; font-weight: 600; }
    .form-card .card-body { padding: 1.5rem; }
    .alert-modern {
        border: none;
        border-radius: 12px;
        font-size: 14px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .card-hover {
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
    }
    .card-hover:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 12px 24px rgba(0,0,0,0.2);
    }
    .empty-state { opacity: .9; }
    .empty-state i {
        font-size: 2.5rem;
        color: var(--admin-text-muted);
        margin-bottom: 0.75rem;
        display: block;
    }
    .badge-count {
        background: rgba(0,217,255,0.1);
        color: var(--admin-primary);
        font-weight: 600;
        border-radius: 20px;
        padding: 0.4rem 0.9rem;
        font-size: 0.82rem;
    }
    .badge-date, .badge-time {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #e2e8f0;
        font-weight: 500;
    }
    @media (prefers-color-scheme: dark) {
        .form-card { background-color: #1c1c1e; }
        .form-card .card-body, .form-card .card-header { color: #f1f1f1; }
        .form-card input.form-control, .form-card textarea.form-control, .form-card select.form-select {
            background-color: #2c2c2e; color: #f1f1f1; border-color: #444;
        }
        .form-card input.form-control:focus, .form-card textarea.form-control:focus, .form-card select.form-select:focus {
            background-color: #2c2c2e; color: #f1f1f1; border-color: #00a2c9; box-shadow: 0 0 0 0.2rem rgba(0,162,201,.25);
        }
    }
    .card-modern {
        background: var(--admin-card-bg);
        border: none;
        border-radius: var(--admin-radius);
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .card-modern:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }
    .card-modern .card-header {
        background: transparent;
        border-bottom: 1px solid var(--admin-border);
        padding: 1.2rem 1.5rem;
        font-weight: 600;
        font-size: 1rem;
    }
    .card-modern .card-body { padding: 1.5rem; }
    .stat-card {
        background: #fff;
        border: none;
        border-radius: var(--admin-radius);
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        opacity: 0.1;
        transform: translate(20px, -20px);
        background: var(--admin-primary);
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.1);
    }
    .stat-card .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--admin-radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 1rem;
    }
    .stat-card .stat-number {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -1px;
        margin-bottom: 0.25rem;
    }
    .stat-card .stat-label {
        color: var(--admin-text-muted);
        font-size: 0.85rem;
        font-weight: 500;
    }
    .table-modern { margin-bottom: 0; }
    .table-modern thead th {
        background: #f8fafc;
        color: var(--admin-text-muted);
        font-weight: 600;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.8rem 1rem;
        border-bottom: 2px solid var(--admin-border);
    }
    .table-modern tbody td {
        padding: 0.8rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--admin-border);
        font-size: 0.88rem;
    }
    .table-modern tbody tr { transition: background 0.2s; }
    .table-modern tbody tr:hover { background: rgba(0,217,255,0.03); }
    .btn-admin {
        padding: 0.5rem 1.2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s;
    }
    .btn-admin-primary {
        background: linear-gradient(135deg, var(--admin-primary), var(--admin-primary-dark));
        color: #fff;
        border: none;
        box-shadow: 0 4px 15px rgba(0,217,255,0.25);
    }
    .btn-admin-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,217,255,0.35);
        color: #fff;
    }
    .btn-admin-outline {
        background: transparent;
        color: var(--admin-primary);
        border: 1.5px solid var(--admin-primary);
    }
    .btn-admin-outline:hover {
        background: rgba(0,217,255,0.08);
        transform: translateY(-1px);
    }
    .form-control-modern {
        padding: 0.7rem 1rem;
        border: 1.5px solid var(--admin-border);
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.2s;
        background: #fff;
    }
    .form-control-modern:focus {
        border-color: var(--admin-primary);
        box-shadow: 0 0 0 3px rgba(0,217,255,0.12);
        outline: none;
    }
    .badge-admin {
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .alert-modern {
        border: none;
        border-radius: var(--admin-radius);
        padding: 1rem 1.2rem;
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .modal-modern .modal-content {
        border: none;
        border-radius: var(--admin-radius);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .modal-modern .modal-header {
        border-bottom: 1px solid var(--admin-border);
        padding: 1.2rem 1.5rem;
    }
    .modal-modern .modal-footer {
        border-top: 1px solid var(--admin-border);
        padding: 1rem 1.5rem;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .slide-up { animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .fade-in { animation: fadeIn 0.3s ease forwards; }
    @media (max-width: 767.98px) {
        .admin-main {
            margin-left: 0 !important;
            padding: 0.6rem;
            width: 100%;
            font-size: 0.78rem;
        }
        .admin-main h1 { font-size: 1.1rem; }
        .admin-main h2 { font-size: 1rem; }
        .admin-main h3 { font-size: 0.92rem; }
        .admin-main h4 { font-size: 0.88rem; }
        .admin-main h5 { font-size: 0.82rem; }
        .admin-main p, .admin-main li, .admin-main td, .admin-main label, .admin-main .form-control, .admin-main .form-select { font-size: 0.76rem; }
        .admin-main .card-modern .card-header { font-size: 0.78rem; padding: 0.6rem 0.8rem; }
        .admin-main .card-modern .card-body { padding: 0.8rem; }
        .admin-main .page-header { padding: 10px 12px; font-size: 0.78rem; }
        .admin-main .table-modern thead th { font-size: 0.65rem; padding: 0.4rem 0.5rem; }
        .admin-main .table-modern tbody td { font-size: 0.72rem; padding: 0.4rem 0.5rem; }
        .admin-main .btn-admin { font-size: 0.72rem; padding: 0.3rem 0.7rem; }
        .admin-main .stat-card .stat-number { font-size: 1.3rem; }
        .admin-main .stat-card .stat-label { font-size: 0.7rem; }
    }
        /* ===== Font System: Space Grotesk / Inter / Noto Sans Bengali / JetBrains Mono ===== */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Space Grotesk', 'Noto Sans Bengali', sans-serif;
        }
        code, pre, kbd, samp, .data-stream {
            font-family: 'JetBrains Mono', 'Courier New', monospace;
        }
    </style>
</head>
<body>

    {{-- Sidebar Overlay (mobile off-canvas) --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- Top Navigation Bar --}}
    @include('backend.partials.topbar')

    {{-- Admin Layout: Sidebar + Content --}}
    <div class="admin-layout">

        {{-- Sidebar --}}
        @include('backend.partials.sidebar')

        {{-- Main Content --}}
        <main class="admin-main">
            @yield('content')
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebarCollapse');
        var overlay = document.getElementById('sidebarOverlay');
        if (!sidebar) return;
        if (sidebar.classList.contains('open')) {
            sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        } else {
            sidebar.classList.add('open');
            if (overlay) overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    (function () {
        'use strict';
        var sidebar = document.getElementById('sidebarCollapse');
        var overlay = document.getElementById('sidebarOverlay');
        var toggleBtn = document.querySelector('.sidebar-toggle-btn');
        var closeBtn = document.querySelector('.sidebar-close button');

        function closeSidebar() {
            if (!sidebar) return;
            sidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function (e) {
                e.preventDefault();
                toggleSidebar();
            });
        }
        if (closeBtn) {
            closeBtn.addEventListener('click', function (e) {
                e.preventDefault();
                closeSidebar();
            });
        }
        if (overlay) {
            overlay.addEventListener('click', function () { closeSidebar(); });
        }
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && sidebar && sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768 && sidebar && sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });
        if (sidebar) {
            sidebar.querySelectorAll('.sidebar-menu a').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth < 768) closeSidebar();
                });
            });
        }
    })();
    </script>

    {{-- SweetAlert2 Global Delete Handler (uses event delegation for AJAX-loaded rows) --}}
    <script>
    document.addEventListener('click', function(e) {
        var btn = e.target.closest('.delete-btn');
        if (!btn) return;
        e.preventDefault();
        var id = btn.getAttribute('data-id');
        var title = btn.getAttribute('data-title') || 'this item';
        var form = document.getElementById('delete-form-' + id);
        if (!form) return;

        Swal.fire({
            title: 'Confirm Deletion',
            text: 'Are you sure you want to delete "' + title + '"? This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: '<i class="bi bi-trash3 me-1"></i> Yes, delete it!',
            cancelButtonText: '<i class="bi bi-x-lg me-1"></i> Cancel',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-4',
                confirmButton: 'btn btn-danger rounded-3 px-4 py-2',
                cancelButton: 'btn btn-light border rounded-3 px-4 py-2',
            },
            buttonsStyling: false
        }).then(function(result) {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
    </script>

    @yield('scripts')
</body>

</html>
