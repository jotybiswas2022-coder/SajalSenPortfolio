@extends('backend.app')

@section('content')
<style>
    .min-w-0 { min-width: 0; }

    .stat-mini {
        background: var(--admin-card-bg);
        border: 1px solid var(--admin-border);
        border-radius: 16px;
        padding: 1.1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 2px 14px rgba(0,0,0,0.05);
        transition: transform .25s ease, border-color .25s ease, box-shadow .25s ease;
        height: 100%;
    }
    .stat-mini:hover {
        transform: translateY(-2px);
        border-color: rgba(0,217,255,0.35);
        box-shadow: 0 10px 28px rgba(0,217,255,0.10);
    }
    .stat-mini .sm-ico {
        width: 46px; height: 46px;
        border-radius: 13px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem; flex-shrink: 0;
    }
    .stat-mini .sm-num { font-size: 1.5rem; font-weight: 800; line-height: 1; color: var(--admin-text); letter-spacing: -0.5px; }
    .stat-mini .sm-label { font-size: 0.72rem; color: var(--admin-text-muted); margin-top: 0.3rem; }

    .ms-card {
        background: var(--admin-card-bg);
        border: 1px solid var(--admin-border);
        border-radius: 16px;
        padding: 1.1rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        gap: 0.7rem;
        position: relative;
        overflow: hidden;
        transition: transform .25s ease, border-color .25s ease, box-shadow .25s ease;
    }
    .ms-card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 2px;
        background: linear-gradient(90deg, #00d9ff, #00ff88);
        opacity: 0; transition: opacity .25s ease;
    }
    .ms-card:hover {
        transform: translateY(-3px);
        border-color: rgba(0,217,255,0.4);
        box-shadow: 0 14px 36px rgba(0,217,255,0.10);
    }
    .ms-card:hover::before { opacity: 1; }
    .ms-card-top { display: flex; gap: 0.75rem; align-items: center; }
    .ms-avatar {
        width: 44px; height: 44px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 1.05rem; color: #fff;
        text-shadow: 0 1px 3px rgba(0,0,0,0.25);
        flex-shrink: 0;
        box-shadow: 0 4px 14px rgba(0,0,0,0.2);
    }
    .ms-name {
        font-weight: 700; color: var(--admin-text); font-size: 0.92rem;
        display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .ms-email { font-size: 0.75rem; color: var(--admin-text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .new-badge {
        font-size: 0.58rem; font-weight: 700; letter-spacing: 0.5px;
        background: rgba(0,217,255,0.12); color: #00d9ff;
        border: 1px solid rgba(0,217,255,0.3);
        padding: 0.1rem 0.45rem; border-radius: 50px; text-transform: uppercase;
        text-shadow: none;
    }
    .ms-preview {
        font-size: 0.82rem; color: var(--admin-text-muted); line-height: 1.5;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
        overflow: hidden;
        word-break: break-word;
    }
    .ms-chips { display: flex; flex-wrap: wrap; gap: 0.4rem; margin-top: auto; }
    .chip {
        font-size: 0.68rem; font-weight: 600;
        padding: 0.25rem 0.6rem; border-radius: 50px;
        display: inline-flex; align-items: center; gap: 0.35rem;
    }
    .chip-date { background: var(--admin-bg-soft); border: 1px solid var(--admin-border); color: var(--admin-text); }
    .chip-time { background: rgba(0,217,255,0.08); border: 1px solid rgba(0,217,255,0.2); color: #00d9ff; }
    .ms-actions {
        display: flex; gap: 0.5rem;
        border-top: 1px solid var(--admin-border); padding-top: 0.8rem;
    }
    .ms-actions .ae-btn { flex: 1; }

    .ms-modal-header {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border-bottom: 1px solid var(--admin-border);
        padding: 1.25rem 1.5rem;
        display: flex; align-items: center; gap: 1rem;
        position: relative; overflow: hidden;
    }
    .ms-modal-header::after {
        content: '';
        position: absolute; top: -50px; right: -50px;
        width: 160px; height: 160px; border-radius: 50%;
        background: radial-gradient(circle, rgba(0,217,255,0.18), transparent 70%);
        pointer-events: none;
    }
    .ms-modal-avatar {
        width: 56px; height: 56px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 1.4rem; color: #fff;
        text-shadow: 0 1px 3px rgba(0,0,0,0.25);
        flex-shrink: 0;
        box-shadow: 0 6px 18px rgba(0,0,0,0.25);
    }

    @media (max-width: 575.98px) {
        .stat-mini { padding: 0.8rem 1rem; gap: 0.75rem; }
        .stat-mini .sm-ico { width: 40px; height: 40px; font-size: 1.05rem; }
        .stat-mini .sm-num { font-size: 1.2rem; }
        .ae-page-header .header-ico { width: 40px !important; height: 40px !important; border-radius: 11px !important; }
        .ae-page-header .header-ico i { font-size: 1.05rem !important; }
        .ae-page-header .ae-title { font-size: 1rem; }
        .ae-page-header .ae-sub { font-size: 0.72rem; }
        .ms-modal-header { padding: 1rem; gap: 0.75rem; }
        .ms-modal-avatar { width: 48px; height: 48px; font-size: 1.15rem; }
        .ms-actions { flex-direction: column; }
        .ms-actions .ae-btn { width: 100%; }
    }
</style>

<div class="container-fluid pb-3">

    {{-- Header --}}
    <div class="ae-page-header mb-2 d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.dashboard.index') }}" class="ae-btn ae-btn-ghost" style="padding:0.5rem 0.75rem;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;" class="header-ico">
                <i class="bi bi-envelope-paper" style="font-size:1.5rem;color:#00d9ff;"></i>
            </div>
            <div class="d-flex flex-column align-items-start gap-1">
                <div class="ae-title">Messages</div>
                <p class="ae-sub">Manage customer inquiries from one place.</p>
            </div>
        </div>
        <span class="ae-badge"><span class="ae-dot"></span> {{ $stats['total'] }} Messages</span>
    </div>

    {{-- Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-mini">
                <div class="sm-ico" style="background:rgba(0,217,255,0.1);color:#00d9ff;"><i class="bi bi-envelope-paper"></i></div>
                <div class="flex-grow-1 min-w-0">
                    <div class="sm-num">{{ $stats['total'] }}</div>
                    <div class="sm-label">Total Messages</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-mini">
                <div class="sm-ico" style="background:rgba(0,255,136,0.1);color:#00ff88;"><i class="bi bi-calendar-week"></i></div>
                <div class="flex-grow-1 min-w-0">
                    <div class="sm-num">{{ $stats['thisWeek'] }}</div>
                    <div class="sm-label">This Week</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-mini">
                <div class="sm-ico" style="background:rgba(139,92,246,0.12);color:#a78bfa;"><i class="bi bi-lightning-charge"></i></div>
                <div class="flex-grow-1 min-w-0">
                    <div class="sm-num">{{ $stats['today'] }}</div>
                    <div class="sm-label">Today</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Search --}}
    <div class="d-flex align-items-center gap-2 mb-3">
        <div class="input-group" style="max-width:480px;">
            <span class="input-group-text ae-search-icon"><i class="bi bi-search"></i></span>
            <input type="text" id="msgSearch" class="form-control ae-search border-start-0 ps-0"
                   placeholder="Search by name, email or message..." autocomplete="off">
            <span class="input-group-text ae-search-icon-end" id="msgSearchClear" style="cursor:pointer;display:none;" title="Clear search">
                <i class="bi bi-x-lg"></i>
            </span>
        </div>
        <span class="ae-note" id="msgCount"></span>
    </div>

    @if($contacts->isEmpty())
        <div class="ae-table-card">
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size:3rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
                <div class="fw-semibold" style="color:var(--admin-text);">No Messages Found</div>
                <p class="ae-note mb-0">Customer messages will appear here once submitted.</p>
            </div>
        </div>
    @else
        @php
            $palettes = ['#00d9ff,#00ff88', '#8b5cf6,#ec4899', '#f59e0b,#ef4444', '#06b6d4,#3b82f6', '#22c55e,#84cc16'];
        @endphp
        <div class="row g-3" id="msgGrid">
            @foreach ($contacts as $contact)
                @php
                    $created = \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka');
                    $palette = $palettes[$loop->index % count($palettes)];
                    $subject = 'Re: Your message via ' . config('app.name', 'Portfolio');

                    // use RFC 2047-compliant header for the subject
                    $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
                    $mailto = 'mailto:' . $contact->email . '?subject=' . urlencode($encodedSubject);
                @endphp
                <div class="col-md-6 col-xl-4 ms-card-col"
                     data-name="{{ strtolower($contact->name) }}"
                     data-email="{{ strtolower($contact->email) }}"
                     data-msg="{{ strtolower($contact->message) }}">
                    <div class="ms-card">
                        <div class="ms-card-top">
                            <div class="ms-avatar" style="background:linear-gradient(135deg,{{ $palette }});">
                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <div class="ms-name">
                                    {{ $contact->name }}
                                    @if($created->isToday())
                                        <span class="new-badge">New</span>
                                    @endif
                                </div>
                                <div class="ms-email">{{ $contact->email }}</div>
                            </div>
                        </div>

                        <div class="ms-preview">{{ $contact->message }}</div>

                        <div class="ms-chips">
                            <span class="chip chip-date"><i class="bi bi-calendar3"></i> {{ $created->format('d M Y') }}</span>
                            <span class="chip chip-time"><i class="bi bi-clock"></i> {{ $created->format('h:i A') }}</span>
                        </div>

                        <div class="ms-actions">
                            <button type="button" class="ae-btn ae-btn-ghost" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}">
                                <i class="bi bi-eye"></i> View
                            </button>
                            <a href="{{ $mailto }}" class="ae-btn ae-btn-ghost">
                                <i class="bi bi-reply-fill"></i> Reply
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Modal --}}
                <div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content" style="background:var(--admin-bg-soft);border:1.5px solid var(--admin-border);border-radius:16px;">
                            <div class="ms-modal-header">
                                <div class="ms-modal-avatar" style="background:linear-gradient(135deg,{{ $palette }});">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </div>
                                <div class="flex-grow-1 min-w-0" style="position:relative;z-index:1;">
                                    <div class="fw-bold" style="color:#fff;font-size:1rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $contact->name }}</div>
                                    <div class="small" style="color:var(--admin-text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $contact->email }}</div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1);position:relative;z-index:1;"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="chip chip-date"><i class="bi bi-calendar3"></i> {{ $created->format('d M Y') }}</span>
                                    <span class="chip chip-time"><i class="bi bi-clock"></i> {{ $created->format('h:i A') }}</span>
                                </div>
                                <small class="ae-form-label"><i class="bi bi-chat-left-quote me-1"></i> Message</small>
                                <p class="mb-0" style="white-space:pre-wrap;color:var(--admin-text);line-height:1.7;">{{ $contact->message }}</p>
                            </div>
                            <div class="modal-footer" style="border-top:1px solid var(--admin-border);">
                                <a href="{{ $mailto }}" class="ae-btn ae-btn-primary"><i class="bi bi-reply-fill"></i> Reply via Email</a>
                                <button type="button" class="ae-btn ae-btn-ghost" data-copy="{{ $contact->message }}"><i class="bi bi-clipboard"></i> Copy</button>
                                <button type="button" class="ae-btn ae-btn-ghost" data-bs-dismiss="modal">
                                    <i class="bi bi-x-lg"></i> Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="ae-table-card d-none" id="msgEmpty">
            <div class="text-center py-5">
                <i class="bi bi-search" style="font-size:2.2rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
                <div class="fw-semibold" style="color:var(--admin-text);">No matching messages</div>
                <p class="ae-note mb-0">Try a different search term.</p>
            </div>
        </div>
    @endif

</div>
@endsection

@section('scripts')
<script>
(function () {
    var search = document.getElementById('msgSearch');
    var clear = document.getElementById('msgSearchClear');
    var cards = Array.prototype.slice.call(document.querySelectorAll('.ms-card-col'));
    var empty = document.getElementById('msgEmpty');
    var count = document.getElementById('msgCount');

    function applyFilter() {
        var q = search.value.trim().toLowerCase();
        var visible = 0;
        cards.forEach(function (card) {
            var haystack = (card.dataset.name + ' ' + card.dataset.email + ' ' + card.dataset.msg);
            var match = haystack.indexOf(q) !== -1;
            card.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        if (clear) clear.style.display = q ? 'inline-flex' : 'none';
        if (empty) empty.classList.toggle('d-none', visible !== 0);
        if (count) count.textContent = visible ? visible + ' message(s) found' : '';
    }

    if (search) {
        search.addEventListener('input', applyFilter);
    }
    if (clear) {
        clear.addEventListener('click', function () {
            search.value = '';
            applyFilter();
            search.focus();
        });
    }

    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-copy]');
        if (!btn) return;
        e.preventDefault();
        var text = btn.getAttribute('data-copy');
        var done = function () {
            var icon = btn.querySelector('i');
            var old = icon.className;
            icon.className = 'bi bi-check-lg';
            btn.classList.add('ae-btn-primary');
            btn.classList.remove('ae-btn-ghost');
            setTimeout(function () {
                icon.className = old;
                btn.classList.remove('ae-btn-primary');
                btn.classList.add('ae-btn-ghost');
            }, 1400);
        };
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(done).catch(done);
        } else {
            var ta = document.createElement('textarea');
            ta.value = text;
            document.body.appendChild(ta);
            ta.select();
            try { document.execCommand('copy'); } catch (err) {}
            document.body.removeChild(ta);
            done();
        }
    });
})();
</script>
@endsection