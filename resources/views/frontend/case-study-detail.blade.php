@extends('frontend.app')

@section('content')
<style>
    :root {
        --bg-primary: #080b12;
        --bg-secondary: #111827;
        --bg-card: rgba(17, 24, 39, 0.8);
        --accent: #00d9ff;
        --accent-light: #7ce6ff;
        --text-primary: #f1f5f9;
        --text-secondary: #94a3b8;
        --text-muted: #94a3b8;
        --border-color: #1e293b;
        --radius-lg: 20px;
        --transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
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

    .cs-detail-page {
        padding-top: 80px;
        padding-bottom: 5rem;
        min-height: 100vh;
        background: var(--bg-primary);
    }

    .cs-container { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; }

    /* ===== Top bar ===== */
    .top-bar {
        display: flex; align-items: center;
        margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
    }
    .back-link {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.6rem 1.4rem; background: var(--bg-card);
        border: 1px solid var(--border-color); border-radius: 50px;
        color: var(--text-secondary); text-decoration: none;
        font-size: 0.85rem; font-weight: 500;
        backdrop-filter: blur(12px); transition: var(--transition);
    }
    .back-link:hover {
        border-color: rgba(0,217,255,0.3); color: var(--accent-light);
        transform: translateX(-4px); box-shadow: 0 4px 20px rgba(0,217,255,0.08);
    }

    /* ===== HERO IMAGE (no text overlay) ===== */
    .cs-image-wrap {
        width: 100%; aspect-ratio: 16 / 9;
        border-radius: 24px; overflow: hidden;
        margin-bottom: 2.5rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 25px 80px rgba(0,0,0,0.3);
        background: var(--bg-secondary);
        position: relative;
    }
    .cs-image-wrap img {
        width: 100%; height: 100%; object-fit: cover;
        display: block;
    }
    .cs-image-wrap .img-fallback {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #1e293b 0%, #111827 50%, #0b1f28 100%);
        display: flex; align-items: center; justify-content: center;
    }
    .cs-image-wrap .img-fallback i { font-size: 5rem; opacity: 0.2; color: var(--accent); }

    /* ===== Hero content (separate from image) ===== */
    .cs-hero-content {
        margin-bottom: 3rem;
        padding: 0 0.5rem;
    }
    .cs-hero-content .hero-meta {
        display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;
        margin-bottom: 1rem;
    }
    .cs-hero-content .hero-category {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        color: #fff; padding: 0.35rem 1.2rem; border-radius: 50px;
        font-size: 0.78rem; font-weight: 700; letter-spacing: 0.3px;
    }
    .cs-hero-content .hero-category i { font-size: 0.7rem; }
    .cs-hero-content .hero-client {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.35rem 1rem; border-radius: 50px;
        font-size: 0.82rem; font-weight: 500;
        background: rgba(0,217,255,0.08); color: var(--accent-light);
    }
    html.light-theme .cs-hero-content .hero-client {
        background: rgba(0,217,255,0.06); color: var(--accent);
    }
    .cs-hero-content .hero-client i { font-size: 0.8rem; }
    .cs-hero-content h1 {
        font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 900;
        color: var(--text-primary); margin: 0; letter-spacing: -1px;
        line-height: 1.15;
    }

    /* ===== Content grid ===== */
    .cs-body {
        display: grid; grid-template-columns: 1fr 320px; gap: 2rem;
        align-items: start;
    }

    /* ===== MAIN CONTENT ===== */
    .cs-main { display: flex; flex-direction: column; gap: 1.5rem; }

    .cs-block {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 20px; padding: 2rem 2.5rem;
        position: relative; overflow: hidden;
        backdrop-filter: blur(12px); transition: var(--transition);
    }
    .cs-block:hover {
        border-color: rgba(0,217,255,0.25);
        box-shadow: 0 20px 60px rgba(0,217,255,0.08), 0 8px 20px rgba(0,0,0,0.12);
        transform: translateY(-4px);
    }
    html.light-theme .cs-block:hover {
        box-shadow: 0 20px 60px rgba(0,217,255,0.1);
    }
    .cs-block .block-header {
        display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;
    }
    .cs-block .block-icon {
        width: 40px; height: 40px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; font-weight: 800; flex-shrink: 0;
    }
    .cs-block .block-icon.ic-problem { background: rgba(239,68,68,0.1); color: #ef4444; }
    .cs-block .block-icon.ic-solution { background: rgba(0,217,255,0.1); color: var(--accent-light); }
    .cs-block .block-icon.ic-result { background: rgba(16,185,129,0.1); color: #10b981; }
    .cs-block .block-label {
        font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .cs-block .block-label.lb-problem { color: #ef4444; }
    .cs-block .block-label.lb-solution { color: var(--accent-light); }
    .cs-block .block-label.lb-result { color: #10b981; }
    .cs-block p {
        color: var(--text-secondary); font-size: 1rem; line-height: 1.8; margin: 0;
    }
    .cs-block .block-accent-line {
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
    }
    .cs-block .block-accent-line.ln-problem { background: linear-gradient(90deg, transparent, #ef4444, transparent); }
    .cs-block .block-accent-line.ln-solution { background: linear-gradient(90deg, transparent, #00d9ff, transparent); }
    .cs-block .block-accent-line.ln-result { background: linear-gradient(90deg, transparent, #10b981, transparent); }

    /* ===== TECH SECTION ===== */
    .cs-tech-wrap {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 20px; padding: 2rem 2.5rem;
        position: relative; overflow: hidden;
        backdrop-filter: blur(12px); transition: var(--transition);
    }
    .cs-tech-wrap:hover {
        border-color: rgba(0,217,255,0.25);
        box-shadow: 0 20px 60px rgba(0,217,255,0.08), 0 8px 20px rgba(0,0,0,0.12);
        transform: translateY(-4px);
    }
    html.light-theme .cs-tech-wrap:hover {
        box-shadow: 0 20px 60px rgba(0,217,255,0.1);
    }
    .cs-tech-wrap .tech-header {
        display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;
    }
    .cs-tech-wrap .tech-header .tech-icon {
        width: 40px; height: 40px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(0,255,136,0.1); color: #6bffb8;
        font-size: 1rem;
    }
    .cs-tech-wrap .tech-header .tech-label {
        font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.5px; color: #6bffb8;
    }
    .cs-tech-list { display: flex; flex-wrap: wrap; gap: 0.5rem; }
    .cs-tech-item {
        font-size: 0.78rem; font-weight: 600; padding: 0.35rem 1.1rem;
        background: linear-gradient(135deg, rgba(0,217,255,0.08), rgba(0,255,136,0.08));
        color: var(--accent-light); border-radius: 50px;
        border: 1px solid rgba(0,217,255,0.06);
        transition: var(--transition);
    }
    .cs-tech-item:hover {
        background: linear-gradient(135deg, rgba(0,217,255,0.15), rgba(0,255,136,0.15));
        border-color: rgba(0,217,255,0.15); transform: translateY(-2px);
    }

    /* ===== Sidebar ===== */
    .cs-sidebar { display: flex; flex-direction: column; gap: 1.5rem; }

    .sidebar-card {
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 20px; padding: 1.8rem; position: relative;
        overflow: hidden; backdrop-filter: blur(12px); transition: var(--transition);
    }
    .sidebar-card:hover {
        border-color: rgba(0,217,255,0.25);
        box-shadow: 0 20px 60px rgba(0,217,255,0.08), 0 8px 20px rgba(0,0,0,0.12);
        transform: translateY(-4px);
    }
    html.light-theme .sidebar-card:hover {
        box-shadow: 0 20px 60px rgba(0,217,255,0.1);
    }
    .sidebar-card .sc-header {
        display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1.2rem;
        padding-bottom: 1rem; border-bottom: 1px solid var(--border-color);
    }
    .sidebar-card .sc-header i {
        font-size: 1.1rem; color: var(--accent-light);
    }
    .sidebar-card .sc-header h4 {
        font-size: 0.85rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.5px; color: var(--text-primary); margin: 0;
    }
    .sidebar-card .sc-row {
        display: flex; align-items: center; gap: 0.75rem;
        padding: 0.6rem 0;
    }
    .sidebar-card .sc-row:not(:last-child) { border-bottom: 1px solid var(--border-color); }
    .sidebar-card .sc-row .sc-label {
        font-size: 0.78rem; color: var(--text-muted); min-width: 80px;
    }
    .sidebar-card .sc-row .sc-value {
        font-size: 0.85rem; font-weight: 600; color: var(--text-primary);
    }

    .sidebar-cta {
        text-align: center; padding: 2rem 1.5rem;
        background: linear-gradient(135deg, rgba(0,217,255,0.06), rgba(0,255,136,0.06));
        border: 1px solid rgba(0,217,255,0.12);
        border-radius: 20px; position: relative; overflow: hidden;
    }
    .sidebar-cta::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, transparent, #00d9ff, #00ff88, transparent);
    }
    .sidebar-cta p {
        font-size: 0.9rem; color: var(--text-secondary); margin-bottom: 1.25rem;
    }
    .sidebar-cta .btn-cta {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.75rem 1.8rem;
        background: linear-gradient(135deg, #00d9ff, #00d9ff, #00ff88);
        background-size: 200% 200%; color: #fff; border: none;
        border-radius: 12px; font-size: 0.9rem; font-weight: 700;
        cursor: pointer; text-decoration: none;
        transition: all 0.4s ease; animation: btnShimmer 3s ease infinite;
    }
    @keyframes btnShimmer {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .sidebar-cta .btn-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 40px rgba(0,217,255,0.3);
    }

    /* ===== Glass Card Shine Effect ===== */
    .cs-block::after,
    .cs-tech-wrap::after,
    .sidebar-card::after {
        content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%),
            rgba(0,217,255,0.35) 0%, rgba(0,217,255,0.12) 30%, transparent 60%);
        pointer-events: none; opacity: 0; transition: opacity 0.5s ease;
        z-index: 1; border-radius: inherit;
    }
    .cs-block:hover::after,
    .cs-tech-wrap:hover::after,
    .sidebar-card:hover::after {
        opacity: 1;
    }

    /* Gradient top border accent on hover for tech-wrap & sidebar */
    .cs-tech-wrap::before,
    .sidebar-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, transparent, #00d9ff, #00ff88, transparent);
        opacity: 0; transition: opacity 0.5s ease; z-index: 2;
    }
    .cs-tech-wrap:hover::before,
    .sidebar-card:hover::before {
        opacity: 1;
    }

    /* ===== Responsive ===== */
    @media (max-width: 968px) {
        .cs-body { grid-template-columns: 1fr; }
        .cs-sidebar { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
    }

    @media (max-width: 768px) {
        .cs-detail-page { padding-top: 70px; padding-bottom: 3rem; }
        .cs-container { padding: 0 1rem; }
        .cs-image-wrap { aspect-ratio: 16 / 9; border-radius: 16px; margin-bottom: 1.5rem; }
        .cs-hero-content { margin-bottom: 2rem; padding: 0; }
        .cs-hero-content h1 { font-size: 1.6rem; }
        .cs-block { padding: 1.5rem; }
        .cs-tech-wrap { padding: 1.5rem; }
        .cs-sidebar { grid-template-columns: 1fr; }
        .sidebar-card { padding: 1.4rem; }
    }

    @media (max-width: 480px) {
        .cs-image-wrap { aspect-ratio: 16 / 9; border-radius: 12px; }
        .cs-hero-content h1 { font-size: 1.3rem; }
        .cs-hero-content .hero-meta { gap: 0.5rem; }
        .cs-hero-content .hero-category { font-size: 0.7rem; padding: 0.25rem 0.9rem; }
        .cs-hero-content .hero-client { font-size: 0.75rem; padding: 0.25rem 0.8rem; }
        .cs-block { padding: 1.2rem; border-radius: 16px; }
        .cs-tech-wrap { padding: 1.2rem; }
        .cs-block .block-icon { width: 34px; height: 34px; font-size: 0.85rem; }
    }
</style>

<div class="cs-detail-page">
    <div class="cs-container">
        <div class="top-bar">
            <a href="/#case-studies" class="back-link">
                <i class="bi bi-arrow-left"></i> {{ __('messages.back') }}
            </a>
        </div>

        <!-- Hero Image (no text overlay - fully visible) -->
        <div class="cs-image-wrap">
            @if($caseStudy->image)
                <img src="{{ config('app.storage_url') }}{{ $caseStudy->image }}" alt="{{ $caseStudy->title }}">
            @else
                <div class="img-fallback">
                    <i class="bi bi-folder2-open"></i>
                </div>
            @endif
        </div>

        <!-- Hero Content (separate from image) -->
        <div class="cs-hero-content">
            <div class="hero-meta">
                @if($caseStudy->category)
                    <span class="hero-category"><i class="bi bi-tag-fill"></i> {{ $caseStudy->category }}</span>
                @endif
                @if($caseStudy->client)
                    <span class="hero-client"><i class="bi bi-building"></i> {{ $caseStudy->client }}</span>
                @endif
            </div>
            <h1>{{ $caseStudy->title }}</h1>
        </div>

        <!-- Content Grid -->
        <div class="cs-body">
            <div class="cs-main">
                @if($caseStudy->problem)
                    <div class="cs-block">
                        <div class="block-accent-line ln-problem"></div>
                        <div class="block-header">
                            <div class="block-icon ic-problem"><i class="bi bi-exclamation-triangle-fill"></i></div>
                            <span class="block-label lb-problem">{{ __('messages.problem') }}</span>
                        </div>
                        <p>{{ $caseStudy->problem }}</p>
                    </div>
                @endif

                @if($caseStudy->solution)
                    <div class="cs-block">
                        <div class="block-accent-line ln-solution"></div>
                        <div class="block-header">
                            <div class="block-icon ic-solution"><i class="bi bi-lightbulb-fill"></i></div>
                            <span class="block-label lb-solution">{{ __('messages.solution') }}</span>
                        </div>
                        <p>{{ $caseStudy->solution }}</p>
                    </div>
                @endif

                @if($caseStudy->result)
                    <div class="cs-block">
                        <div class="block-accent-line ln-result"></div>
                        <div class="block-header">
                            <div class="block-icon ic-result"><i class="bi bi-graph-up-arrow"></i></div>
                            <span class="block-label lb-result">{{ __('messages.result') }}</span>
                        </div>
                        <p>{{ $caseStudy->result }}</p>
                    </div>
                @endif

                @if($caseStudy->technologies)
                    <div class="cs-tech-wrap">
                        <div class="tech-header">
                            <div class="tech-icon"><i class="bi bi-cpu-fill"></i></div>
                            <span class="tech-label">{{ __('messages.technologies_used') }}</span>
                        </div>
                        <div class="cs-tech-list">
                            @foreach($caseStudy->tech_list as $tech)
                                <span class="cs-tech-item">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="cs-sidebar">
                <div class="sidebar-card">
                    <div class="sc-header">
                        <i class="bi bi-info-circle-fill"></i>
                        <h4>{{ __('messages.project_details') }}</h4>
                    </div>
                    @if($caseStudy->client)
                        <div class="sc-row">
                            <span class="sc-label">{{ __('messages.client') }}</span>
                            <span class="sc-value">{{ $caseStudy->client }}</span>
                        </div>
                    @endif
                    @if($caseStudy->category)
                        <div class="sc-row">
                            <span class="sc-label">{{ __('messages.category') }}</span>
                            <span class="sc-value">{{ $caseStudy->category }}</span>
                        </div>
                    @endif
                    <div class="sc-row">
                        <span class="sc-label">{{ __('messages.status') }}</span>
                        <span class="sc-value" style="color: #10b981;">{{ __('messages.completed') }}</span>
                    </div>
                </div>

                @if($caseStudy->url)
                    <div class="sidebar-cta">
                        <p>{{ __('messages.view_project') }}</p>
                        <a href="{{ $caseStudy->url }}" target="_blank" rel="noopener noreferrer" class="btn-cta">
                            <i class="bi bi-box-arrow-up-right"></i> {{ __('messages.live_demo') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
(function() {
    var selectors = '.cs-block, .cs-tech-wrap, .sidebar-card';
    document.querySelectorAll(selectors).forEach(function(card) {
        var rafId = null;
        card.addEventListener('mousemove', function(e) {
            if (rafId) return;
            var self = this;
            rafId = requestAnimationFrame(function() {
                var rect = self.getBoundingClientRect();
                var x = ((e.clientX - rect.left) / rect.width) * 100;
                var y = ((e.clientY - rect.top) / rect.height) * 100;
                self.style.setProperty('--shine-x', x + '%');
                self.style.setProperty('--shine-y', y + '%');
                rafId = null;
            });
        });
        card.addEventListener('mouseleave', function() {
            if (rafId) { cancelAnimationFrame(rafId); rafId = null; }
            this.style.setProperty('--shine-x', '50%');
            this.style.setProperty('--shine-y', '50%');
        });
    });
})();
</script>
@endsection
