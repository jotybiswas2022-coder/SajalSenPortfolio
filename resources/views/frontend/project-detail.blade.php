@extends('frontend.app')

@section('content')
<style>
    :root {
        --bg-primary: #080b12;
        --bg-secondary: #111827;
        --bg-card: rgba(17, 24, 39, 0.8);
        --accent: #00d9ff;
        --accent-light: #7ce6ff;
        --accent-purple: #00ff88;
        --text-primary: #f1f5f9;
        --text-secondary: #94a3b8;
        --text-muted: #94a3b8;
        --border-color: #1e293b;
        --radius-lg: 20px;
        --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    html.light-theme {
        --bg-primary: #f8fafc;
        --bg-secondary: #f1f5f9;
        --bg-card: rgba(255, 255, 255, 0.92);
        --text-primary: #111827;
        --text-secondary: #475569;
        --text-muted: #94a3b8;
        --border-color: #e2e8f0;
    }
    html.light-theme body { background: #f8fafc; }
    body {
        font-family: 'Poppins', 'Hind Siliguri', system-ui, -apple-system, sans-serif;
    }

    .project-detail-page {
        padding-top: 80px;
        padding-bottom: 6rem;
        min-height: 100vh;
        background: var(--bg-primary);
        position: relative;
    }
    .project-detail-page::before {
        content: ''; position: fixed; top: -40%; right: -20%;
        width: 700px; height: 700px;
        background: radial-gradient(circle, rgba(0,217,255,0.04) 0%, transparent 70%);
        pointer-events: none; z-index: 0;
    }
    html.light-theme .project-detail-page::before {
        background: radial-gradient(circle, rgba(0,217,255,0.03) 0%, transparent 70%);
    }

    .pd-container { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; position: relative; z-index: 1; }

    /* ===== Back bar ===== */
    .top-bar {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;
    }
    .back-link {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.55rem 1.3rem; background: var(--bg-card);
        border: 1px solid var(--border-color); border-radius: 50px;
        color: var(--text-secondary); text-decoration: none;
        font-size: 0.82rem; font-weight: 500;
        backdrop-filter: blur(12px); transition: var(--transition);
        position: relative; overflow: hidden;
    }
    .back-link::after {
        content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(0,217,255,0.4) 0%, rgba(0,217,255,0.1) 30%, transparent 60%);
        opacity: 0; transition: opacity 0.4s; pointer-events: none;
    }
    .back-link:hover::after { opacity: 1; }
    .back-link:hover {
        border-color: rgba(0,217,255,0.3); color: var(--accent-light);
        transform: translateX(-4px); box-shadow: 0 4px 20px rgba(0,217,255,0.08);
    }
    .back-link i { font-size: 0.9rem; position: relative; z-index: 1; }
    .back-link span { position: relative; z-index: 1; }

    /* ===== Hero image ===== */
    .pd-image-wrap {
        width: 100%; aspect-ratio: 16 / 9;
        border-radius: 24px; overflow: hidden;
        margin-bottom: 3rem;
        position: relative;
        box-shadow: 0 30px 100px rgba(0,0,0,0.35), 0 0 0 1px var(--border-color);
        background: var(--bg-secondary);
    }
    .pd-image-wrap::after {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(0,217,255,0.3) 0%, rgba(0,217,255,0.08) 30%, transparent 60%);
        pointer-events: none; z-index: 1;
        opacity: 0; transition: opacity 0.5s ease;
    }
    .pd-image-wrap:hover::after { opacity: 1; }
    .pd-image-wrap img {
        width: 100%; height: 100%; object-fit: cover;
        display: block; transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .pd-image-wrap:hover img { transform: scale(1.03); }
    .pd-image-wrap .img-fallback {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #1e293b 0%, #111827 50%, #0b1f28 100%);
        display: flex; align-items: center; justify-content: center;
    }
    .pd-image-wrap .img-fallback i { font-size: 5rem; opacity: 0.15; color: var(--accent); }

    /* ===== Hero content ===== */
    .pd-hero-content {
        margin-bottom: 3.5rem;
        padding: 0 0.5rem;
        position: relative;
    }
    .pd-hero-content .hero-meta {
        display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;
        margin-bottom: 1rem;
    }
    .pd-hero-content .hero-category {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        color: #fff; padding: 0.35rem 1.2rem; border-radius: 50px;
        font-size: 0.78rem; font-weight: 700; letter-spacing: 0.3px;
        box-shadow: 0 4px 15px rgba(0,217,255,0.25);
    }
    .pd-hero-content .hero-category i { font-size: 0.7rem; }
    .pd-hero-content h1 {
        font-size: clamp(2rem, 4.5vw, 3.5rem); font-weight: 900;
        color: var(--text-primary); margin: 0; letter-spacing: -1.5px;
        line-height: 1.1;
        background: linear-gradient(135deg, var(--text-primary) 0%, var(--accent-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    html.light-theme .pd-hero-content h1 {
        background: linear-gradient(135deg, #111827 0%, #00d9ff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* ===== Content grid ===== */
    .pd-body {
        display: grid; grid-template-columns: 1fr 340px; gap: 2.5rem;
        align-items: start;
    }

    .pd-main { display: flex; flex-direction: column; gap: 1.5rem; }

    /* ===== Shine effect on all cards ===== */
    .pd-desc-block::after,
    .pd-tech-wrap::after,
    .sidebar-card::after,
    .sidebar-link::after {
        content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(0,217,255,0.5) 0%, rgba(0,217,255,0.15) 25%, rgba(0,217,255,0.04) 45%, transparent 65%);
        pointer-events: none; opacity: 0; transition: opacity 0.4s ease; z-index: 0; border-radius: inherit;
    }
    html.light-theme .pd-desc-block::after,
    html.light-theme .pd-tech-wrap::after,
    html.light-theme .sidebar-card::after,
    html.light-theme .sidebar-link::after {
        background: radial-gradient(circle at var(--shx, 50%) var(--shy, 50%), rgba(0,217,255,0.3) 0%, rgba(0,217,255,0.1) 25%, rgba(0,217,255,0.03) 45%, transparent 65%);
    }
    .pd-desc-block:hover::after,
    .pd-tech-wrap:hover::after,
    .sidebar-card:hover::after,
    .sidebar-link:hover::after { opacity: 1; }

    /* ===== Description block ===== */
    .pd-desc-block {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 20px; padding: 2.5rem;
        position: relative; overflow: hidden;
        backdrop-filter: blur(12px); transition: var(--transition);
    }
    .pd-desc-block:hover {
        border-color: rgba(0,217,255,0.2);
        box-shadow: 0 12px 40px rgba(0,217,255,0.06);
    }
    .pd-desc-block .desc-accent {
        position: absolute; top: 0; left: 0; width: 4px; height: 100%;
        background: linear-gradient(180deg, #00d9ff, #00ff88);
        border-radius: 0 4px 4px 0;
    }
    .pd-desc-block p {
        color: var(--text-secondary); font-size: 1.05rem; line-height: 1.85;
        margin: 0; position: relative; z-index: 1;
    }

    /* ===== TECH SECTION ===== */
    .pd-tech-wrap {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 20px; padding: 2.5rem;
        position: relative; overflow: hidden;
        backdrop-filter: blur(12px); transition: var(--transition);
    }
    .pd-tech-wrap:hover {
        border-color: rgba(0,255,136,0.2);
        box-shadow: 0 12px 40px rgba(0,255,136,0.06);
    }
    .pd-tech-wrap .tech-header {
        display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem;
        position: relative; z-index: 1;
    }
    .pd-tech-wrap .tech-header .tech-icon {
        width: 42px; height: 42px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, rgba(0,255,136,0.12), rgba(0,217,255,0.12));
        color: #6bffb8; font-size: 1.05rem;
    }
    .pd-tech-wrap .tech-header .tech-label {
        font-size: 0.75rem; font-weight: 800; text-transform: uppercase;
        letter-spacing: 0.8px; color: #6bffb8;
    }
    .pd-tech-list {
        display: flex; flex-wrap: wrap; gap: 0.55rem;
        position: relative; z-index: 1;
    }
    .pd-tech-item {
        font-size: 0.78rem; font-weight: 600; padding: 0.4rem 1.2rem;
        background: linear-gradient(135deg, rgba(0,217,255,0.08), rgba(0,255,136,0.08));
        color: var(--accent-light); border-radius: 50px;
        border: 1px solid rgba(0,217,255,0.08);
        transition: var(--transition); cursor: default;
        position: relative; overflow: hidden;
    }
    .pd-tech-item::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(0,217,255,0.12), rgba(0,255,136,0.12));
        opacity: 0; transition: opacity 0.3s;
    }
    .pd-tech-item:hover::after { opacity: 1; }
    .pd-tech-item:hover {
        transform: translateY(-3px) scale(1.04);
        border-color: rgba(0,217,255,0.2);
        box-shadow: 0 6px 20px rgba(0,217,255,0.12);
    }
    .pd-tech-item span { position: relative; z-index: 1; }

    /* ===== Sidebar ===== */
    .pd-sidebar { display: flex; flex-direction: column; gap: 1.5rem; }

    .sidebar-card {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 20px; padding: 2rem;
        position: relative; overflow: hidden;
        backdrop-filter: blur(12px); transition: var(--transition);
    }
    .sidebar-card:hover {
        border-color: rgba(0,217,255,0.2);
        box-shadow: 0 12px 40px rgba(0,217,255,0.06);
    }
    .sidebar-card .sc-accent {
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, #00d9ff, #00ff88, transparent);
    }
    .sidebar-card .sc-header {
        display: flex; align-items: center; gap: 0.65rem; margin-bottom: 1.2rem;
        padding-bottom: 1rem; border-bottom: 1px solid var(--border-color);
        position: relative; z-index: 1;
    }
    .sidebar-card .sc-header i {
        font-size: 1.15rem;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .sidebar-card .sc-header h4 {
        font-size: 0.82rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.5px; color: var(--text-primary); margin: 0;
    }
    .sidebar-card .sc-rows { position: relative; z-index: 1; }
    .sidebar-card .sc-row {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 0.7rem 0;
    }
    .sidebar-card .sc-row:not(:last-child) { border-bottom: 1px solid rgba(0,217,255,0.06); }
    .sidebar-card .sc-row .sc-dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: var(--accent-light); flex-shrink: 0;
    }
    .sidebar-card .sc-row .sc-label {
        font-size: 0.78rem; color: var(--text-muted);
    }
    .sidebar-card .sc-row .sc-value {
        font-size: 0.85rem; font-weight: 600; color: var(--text-primary);
        margin-left: auto;
    }

    .sidebar-links { display: flex; flex-direction: column; gap: 0.85rem; }
    .sidebar-link {
        display: flex; align-items: center; gap: 0.7rem;
        padding: 1rem 1.4rem;
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 16px; color: var(--text-primary);
        text-decoration: none; font-weight: 600; font-size: 0.9rem;
        transition: var(--transition); backdrop-filter: blur(12px);
        position: relative; overflow: hidden;
    }
    .sidebar-link:hover {
        border-color: rgba(0,217,255,0.25);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0,217,255,0.08);
    }
    .sidebar-link i { font-size: 1.15rem; position: relative; z-index: 1; }
    .sidebar-link span { position: relative; z-index: 1; }
    .sidebar-link .link-arrow {
        margin-left: auto; font-size: 0.8rem; opacity: 0;
        transform: translateX(-8px); transition: var(--transition);
        position: relative; z-index: 1;
    }
    .sidebar-link:hover .link-arrow { opacity: 1; transform: translateX(0); }

    @media (max-width: 968px) {
        .pd-body { grid-template-columns: 1fr; }
        .pd-sidebar { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    }

    @media (max-width: 768px) {
        .project-detail-page { padding-top: 70px; padding-bottom: 3rem; }
        .pd-container { padding: 0 1rem; }
        .pd-image-wrap { border-radius: 16px; margin-bottom: 2rem; }
        .pd-hero-content { margin-bottom: 2.5rem; padding: 0; }
        .pd-hero-content h1 { font-size: 1.6rem; }
        .pd-desc-block { padding: 1.5rem; }
        .pd-desc-block p { font-size: 0.95rem; }
        .pd-tech-wrap { padding: 1.5rem; }
        .pd-sidebar { grid-template-columns: 1fr; }
        .sidebar-card { padding: 1.4rem; }
        .sidebar-link { padding: 0.85rem 1.2rem; }
    }

    @media (max-width: 480px) {
        .pd-image-wrap { border-radius: 12px; margin-bottom: 1.5rem; }
        .pd-hero-content h1 { font-size: 1.3rem; }
        .pd-hero-content .hero-meta { gap: 0.5rem; }
        .pd-hero-content .hero-category { font-size: 0.7rem; padding: 0.25rem 0.9rem; }
        .pd-desc-block { padding: 1.2rem; border-radius: 16px; }
        .pd-tech-wrap { padding: 1.2rem; }
        .pd-tech-item { font-size: 0.72rem; padding: 0.3rem 0.9rem; }
        .sidebar-card { padding: 1.2rem; border-radius: 16px; }
        .sidebar-link { padding: 0.75rem 1rem; font-size: 0.82rem; border-radius: 14px; }
    }
</style>

<div class="project-detail-page">
    <div class="pd-container">
        <div class="top-bar">
            <a href="/#projects" class="back-link">
                <i class="bi bi-arrow-left"></i> <span>{{ __('messages.back') }}</span>
            </a>
        </div>

        <div class="pd-image-wrap">
            @if($project->image)
                <img src="{{ config('app.storage_url') }}{{ $project->image }}" alt="{{ $project->title }}">
            @else
                <div class="img-fallback">
                    <i class="bi bi-folder2-open"></i>
                </div>
            @endif
        </div>

        <div class="pd-hero-content">
            <div class="hero-meta">
                @if($project->category)
                    <span class="hero-category"><i class="bi bi-tag-fill"></i> {{ $project->category }}</span>
                @endif
            </div>
            <h1>{{ $project->title }}</h1>
        </div>

        <div class="pd-body">
            <div class="pd-main">
                @if($project->description)
                    <div class="pd-desc-block">
                        <div class="desc-accent"></div>
                        <p>{{ $project->description }}</p>
                    </div>
                @endif

                @if($project->tech_stack)
                    <div class="pd-tech-wrap">
                        <div class="tech-header">
                            <div class="tech-icon"><i class="bi bi-cpu-fill"></i></div>
                            <span class="tech-label">{{ __('messages.technologies_used') }}</span>
                        </div>
                        <div class="pd-tech-list">
                            @foreach($project->getTechStackArray() as $tech)
                                <span class="pd-tech-item"><span>{{ $tech }}</span></span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="pd-sidebar">
                <div class="sidebar-card">
                    <div class="sc-accent"></div>
                    <div class="sc-header">
                        <i class="bi bi-info-circle-fill"></i>
                        <h4>{{ __('messages.project_details') }}</h4>
                    </div>
                    <div class="sc-rows">
                        @if($project->category)
                            <div class="sc-row">
                                <span class="sc-dot"></span>
                                <span class="sc-label">{{ __('messages.category') }}</span>
                                <span class="sc-value">{{ $project->category }}</span>
                            </div>
                        @endif
                        <div class="sc-row">
                            <span class="sc-dot"></span>
                            <span class="sc-label">{{ __('messages.status') }}</span>
                            <span class="sc-value" style="color: #10b981;">{{ __('messages.completed') }}</span>
                        </div>
                    </div>
                </div>

                @if($project->live_link || $project->github_link)
                    <div class="sidebar-links">
                        @if($project->live_link)
                            <a href="{{ $project->live_link }}" target="_blank" rel="noopener noreferrer" class="sidebar-link" style="background: linear-gradient(135deg, rgba(0,217,255,0.06), rgba(0,217,255,0.06));">
                                <i class="bi bi-box-arrow-up-right" style="color: var(--accent-light);"></i>
                                <span>{{ __('messages.live_demo') }}</span>
                                <span class="link-arrow"><i class="bi bi-arrow-right"></i></span>
                            </a>
                        @endif
                        @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer" class="sidebar-link">
                                <i class="bi bi-github" style="color: #94a3b8;"></i>
                                <span>{{ __('messages.source') }}</span>
                                <span class="link-arrow"><i class="bi bi-arrow-right"></i></span>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    var selectors = '.pd-image-wrap, .pd-desc-block, .pd-tech-wrap, .sidebar-card, .sidebar-link, .back-link';
    document.querySelectorAll(selectors).forEach(function(el) {
        var rafId = null;
        el.addEventListener('mousemove', function(e) {
            if (rafId) return;
            var self = this;
            rafId = requestAnimationFrame(function() {
                var rect = self.getBoundingClientRect();
                var x = ((e.clientX - rect.left) / rect.width) * 100;
                var y = ((e.clientY - rect.top) / rect.height) * 100;
                self.style.setProperty('--shx', x + '%');
                self.style.setProperty('--shy', y + '%');
                rafId = null;
            });
        });
        el.addEventListener('mouseleave', function() {
            if (rafId) { cancelAnimationFrame(rafId); rafId = null; }
            this.style.setProperty('--shx', '50%');
            this.style.setProperty('--shy', '50%');
        });
    });
})();
</script>
@endsection
