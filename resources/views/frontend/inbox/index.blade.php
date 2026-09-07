@extends('frontend.app')

@section('content')
<style>
    /* ===== CSS variables ===== */
    body { font-family: 'Space Grotesk', 'Hind Siliguri', sans-serif; background: #080b12; margin:0; padding:0; }

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
        --border-hover: rgba(0, 217, 255, 0.3);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 20px;
        --radius-xl: 24px;
        --transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* ===== INBOX PAGE — MODERN GLASS DESIGN ===== */
    .inbox-page {
        padding-top: 100px;
        padding-bottom: 4rem;
        min-height: 100vh;
        background: linear-gradient(180deg, var(--bg-primary) 0%, #080b12 100%);
    }
    html.light-theme .inbox-page {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    }
    html.light-theme body { background: #f8fafc; }

    .inbox-container {
        max-width: 820px;
        margin: 0 auto;
        position: relative;
    }

    /* ===== Header section ===== */
    .inbox-header {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .inbox-header-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .inbox-header h1 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        letter-spacing: -0.5px;
    }
    .inbox-header h1 .header-icon {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.2rem;
        box-shadow: 0 8px 25px rgba(0, 217, 255, 0.25);
    }
    .inbox-header .conv-count {
        font-size: 0.85rem;
        color: var(--text-muted);
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-weight: 500;
    }

    /* ===== Search bar ===== */
    .inbox-search {
        position: relative;
        width: 100%;
    }
    .inbox-search .search-icon {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 0.95rem;
        pointer-events: none;
        z-index: 2;
    }
    .inbox-search input {
        width: 100%;
        padding: 0.85rem 1.2rem 0.85rem 3rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        color: var(--text-primary);
        font-size: 0.9rem;
        font-family: 'Space Grotesk', 'Hind Siliguri', sans-serif;
        outline: none;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
    .inbox-search input:focus {
        border-color: #00d9ff;
        box-shadow: 0 0 0 3px rgba(0, 217, 255, 0.08), 0 4px 20px rgba(0, 217, 255, 0.05);
    }
    .inbox-search input::placeholder {
        color: var(--text-muted);
        opacity: 0.6;
    }
    html.light-theme .inbox-search input {
        background: rgba(255, 255, 255, 0.85);
    }

    /* ===== Empty state ===== */
    .inbox-empty {
        text-align: center;
        padding: 5rem 2rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-xl);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
    .inbox-empty::before {
        content: '';
        position: absolute;
        top: -30%;
        left: 50%;
        transform: translateX(-50%);
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(0, 217, 255, 0.06), transparent 70%);
        pointer-events: none;
    }
    .inbox-empty .empty-icon-wrap {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: rgba(0, 217, 255, 0.06);
        border: 1px solid rgba(0, 217, 255, 0.1);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
    }
    .inbox-empty .empty-icon-wrap i {
        font-size: 2.5rem;
        color: var(--text-muted);
    }
    .inbox-empty h3 {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }
    .inbox-empty p {
        color: var(--text-secondary);
        margin-bottom: 1.8rem;
        font-size: 0.95rem;
        position: relative;
        z-index: 1;
    }
    .inbox-empty .btn-browse {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 2rem;
        background: linear-gradient(135deg, #00d9ff, #00a2c9);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 8px 25px rgba(0, 217, 255, 0.25);
        position: relative;
        z-index: 1;
    }
    .inbox-empty .btn-browse:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(0, 217, 255, 0.35);
        color: #fff;
    }

    /* ===== Conversation list ===== */
    .conversation-list {
        display: flex;
        flex-direction: column;
        gap: 0.65rem;
    }

    .conversation-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.1rem 1.4rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
    /* Glass shine overlay */
    .conversation-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at var(--shine-x, 50%) var(--shine-y, 50%), rgba(0, 217, 255, 0.08), transparent 60%);
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.5s ease;
        border-radius: inherit;
    }
    .conversation-item:hover::before {
        opacity: 1;
    }
    .conversation-item:hover {
        border-color: var(--border-hover);
        box-shadow: 0 8px 30px rgba(0, 217, 255, 0.08), 0 2px 8px rgba(0, 0, 0, 0.06);
        transform: translateX(6px) scale(1.01);
    }
    .conversation-item:active {
        transform: translateX(3px) scale(0.99);
    }

    /* Left accent bar */
    .conversation-item::after {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%) scaleY(0);
        width: 3px;
        height: 32px;
        background: linear-gradient(180deg, #00d9ff, #00ff88);
        border-radius: 0 3px 3px 0;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .conversation-item:hover::after {
        transform: translateY(-50%) scaleY(1);
    }
    .conversation-item.unread::after {
        transform: translateY(-50%) scaleY(1);
        opacity: 0.6;
    }

    /* ===== AVATAR ===== */
    .conv-avatar {
        width: 50px;
        height: 50px;
        min-width: 50px;
        border-radius: 16px;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 4px 15px rgba(0, 217, 255, 0.2);
        transition: all 0.4s ease;
        position: relative;
        z-index: 1;
    }
    .conversation-item:hover .conv-avatar {
        transform: scale(1.08) rotate(-3deg);
        box-shadow: 0 6px 20px rgba(0, 217, 255, 0.3);
    }

    /* ===== CONVERSATION INFO ===== */
    .conv-info {
        flex: 1;
        min-width: 0;
        position: relative;
        z-index: 1;
    }
    .conv-info .conv-subject {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0 0 0.15rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .conv-info .conv-subject .unread-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #00d9ff;
        flex-shrink: 0;
        box-shadow: 0 0 8px rgba(0, 217, 255, 0.4);
    }
    .conv-info .conv-preview {
        font-size: 0.84rem;
        color: var(--text-secondary);
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ===== Meta (time and status) ===== */
    .conv-meta {
        text-align: right;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 0.35rem;
        position: relative;
        z-index: 1;
    }
    .conv-meta .conv-time {
        font-size: 0.72rem;
        color: var(--text-muted);
        font-weight: 500;
        white-space: nowrap;
    }
    .conv-status {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.2rem 0.7rem;
        border-radius: 20px;
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.2px;
        text-transform: uppercase;
    }
    .conv-status.open {
        background: rgba(34, 197, 94, 0.1);
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.15);
        box-shadow: 0 0 12px rgba(34, 197, 94, 0.08);
    }
    .conv-status.closed {
        background: rgba(248, 113, 113, 0.08);
        color: #f87171;
        border: 1px solid rgba(248, 113, 113, 0.12);
    }

    /* ===== LOADING / SKELETON ===== */
    .skeleton-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.1rem 1.4rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
    }
    .skeleton-avatar {
        width: 50px;
        height: 50px;
        min-width: 50px;
        border-radius: 16px;
        background: linear-gradient(90deg, rgba(0,217,255,0.04) 25%, rgba(0,217,255,0.08) 50%, rgba(0,217,255,0.04) 75%);
        background-size: 200% 100%;
        animation: skeletonShimmer 1.5s ease infinite;
    }
    .skeleton-lines {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .skeleton-line {
        height: 12px;
        border-radius: 6px;
        background: linear-gradient(90deg, rgba(0,217,255,0.04) 25%, rgba(0,217,255,0.08) 50%, rgba(0,217,255,0.04) 75%);
        background-size: 200% 100%;
        animation: skeletonShimmer 1.5s ease infinite;
    }
    .skeleton-line:first-child { width: 60%; }
    .skeleton-line:last-child { width: 35%; height: 10px; }
    @keyframes skeletonShimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* ===== ANIMATIONS ===== */
    .conversation-item {
        animation: convSlideIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    .conversation-item:nth-child(1) { animation-delay: 0.02s; }
    .conversation-item:nth-child(2) { animation-delay: 0.06s; }
    .conversation-item:nth-child(3) { animation-delay: 0.10s; }
    .conversation-item:nth-child(4) { animation-delay: 0.14s; }
    .conversation-item:nth-child(5) { animation-delay: 0.18s; }
    .conversation-item:nth-child(6) { animation-delay: 0.22s; }
    .conversation-item:nth-child(7) { animation-delay: 0.26s; }
    .conversation-item:nth-child(8) { animation-delay: 0.30s; }
    .conversation-item:nth-child(9) { animation-delay: 0.34s; }
    .conversation-item:nth-child(10) { animation-delay: 0.38s; }

    @keyframes convSlideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .inbox-page { padding-top: 85px; }
        .inbox-header h1 { font-size: 1.4rem; }
        .inbox-header h1 .header-icon { width: 36px; height: 36px; font-size: 1rem; }
        .conversation-item { padding: 1rem 1.1rem; }
        .conv-avatar { width: 42px; height: 42px; min-width: 42px; font-size: 1rem; }
        .conv-info .conv-subject { font-size: 0.9rem; }
        .conv-info .conv-preview { font-size: 0.8rem; }
        .conv-meta .conv-time { font-size: 0.68rem; }
    }
    @media (max-width: 480px) {
        .inbox-page { padding-top: 75px; }
        .inbox-header h1 { font-size: 1.2rem; }
        .inbox-header h1 .header-icon { width: 32px; height: 32px; font-size: 0.85rem; border-radius: 10px; }
        .inbox-header .conv-count { font-size: 0.75rem; padding: 0.3rem 0.8rem; }
        .conversation-item { padding: 0.85rem 0.9rem; gap: 0.75rem; }
        .conv-avatar { width: 36px; height: 36px; min-width: 36px; font-size: 0.85rem; border-radius: 12px; }
        .conv-info .conv-subject { font-size: 0.85rem; }
        .conv-status { font-size: 0.6rem; padding: 0.15rem 0.5rem; }
        .inbox-empty { padding: 3rem 1.5rem; }
        .inbox-empty .empty-icon-wrap { width: 60px; height: 60px; }
        .inbox-empty .empty-icon-wrap i { font-size: 1.8rem; }
        .inbox-empty h3 { font-size: 1.1rem; }
    }
</style>

<div class="inbox-page">
    <div class="container">
        <div class="inbox-container">
            {{-- Header --}}
            <div class="inbox-header">
                <div class="inbox-header-top">
                    <h1>
                        <span class="header-icon"><i class="bi bi-chat-dots"></i></span>
                        {{ __('messages.inbox') }}
                    </h1>                     <span class="conv-count" id="convCount">
                        <i class="bi bi-chat-text me-1"></i> {{ $conversations->count() }} {{ $conversations->count() === 1 ? __('messages.conversation') : __('messages.conversations_count') }}
                    </span>
                </div>

                {{-- Search --}}
                <div class="inbox-search">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" id="inboxSearch" placeholder="{{ __('messages.search_conversations') }}" oninput="filterConversations(this.value)">
                </div>
            </div>

            {{-- Content --}}
            @if($conversations->isEmpty())
                <div class="inbox-empty">
                    <div class="empty-icon-wrap">
                        <i class="bi bi-envelope-open"></i>
                    </div>
                    <h3>{{ __('messages.no_conversations') }}</h3>
                    <p>{{ __('messages.no_conversations_desc') }}</p>
                    <a href="{{ route('home') }}" class="btn-browse">
                        <i class="bi bi-house-fill"></i> {{ __('messages.browse_gigs') }}
                    </a>
                </div>
            @else
                <div class="conversation-list" id="conversationList">
                    @foreach($conversations as $conv)
                        <a href="{{ route('inbox.show', $conv->id) }}"
                           class="conversation-item"
                           data-search="{{ Str::lower($conv->subject) }} {{ Str::lower($conv->lastMessage ? ($conv->lastMessage->message ?? '') : '') }}">
                            <div class="conv-avatar">
                                {{ substr($conv->subject, 0, 1) }}
                            </div>
                            <div class="conv-info">
                                <div class="conv-subject">
                                    {{ $conv->subject }}
                                    @if($conv->status == 'open')
                                        <span class="unread-dot"></span>
                                    @endif
                                </div>
                                <p class="conv-preview">{{ $conv->lastMessage ? Str::limit(strip_tags($conv->lastMessage->message ?? ''), 70) : '' }}</p>
                            </div>
                            <div class="conv-meta">
                                <span class="conv-time">{{ $conv->updated_at->diffForHumans() }}</span>
                                <span class="conv-status {{ $conv->status }}">
                                    <i class="bi bi-{{ $conv->status == 'open' ? 'unlock' : 'lock' }}-fill"></i>
                                    {{ ucfirst($conv->status) }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- No results state --}}
                <div class="inbox-empty" id="noResultsState" style="display:none;">
                    <div class="empty-icon-wrap">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3>{{ __('messages.no_results_found') }}</h3>
                    <p>{{ __('messages.search_conversations') }}</p>
                    <button onclick="document.getElementById('inboxSearch').value=''; filterConversations('');" class="btn-browse" style="background:rgba(0,217,255,0.1); color:var(--accent-light); box-shadow:none;">
                        <i class="bi bi-x-lg"></i> {{ __('messages.clear') }}
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function filterConversations(query) {
        const items = document.querySelectorAll('.conversation-item');
        const noResults = document.getElementById('noResultsState');
        const lowerQuery = query.toLowerCase().trim();
        let visibleCount = 0;

        items.forEach(item => {
            const searchData = item.getAttribute('data-search') || '';
            if (searchData.includes(lowerQuery)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Toggle no-results state
        if (noResults) {
            noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        // Update count
        const countEl = document.getElementById('convCount');
        if (countEl) {
            countEl.innerHTML = '<i class="bi bi-chat-text me-1"></i> ' + visibleCount + ' ' + (visibleCount === 1 ? '{{ __("messages.conversation") }}' : '{{ __("messages.conversations_count") }}');
        }
    }
</script>
@endsection
