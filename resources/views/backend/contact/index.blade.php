@extends('backend.app')

@section('content')
<style>
    .sum-box { padding: 1rem 0.5rem; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.15rem; }
    .sum-box .sum-ico { font-size: 1rem; line-height: 1; }
    .sum-box .sum-num { font-size: 1.35rem; font-weight: 700; color: var(--admin-text); line-height: 1.1; margin-top: 0.3rem; }
    .sum-box .sum-label { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--admin-text-muted); margin-top: 0.2rem; }
    .sum-row > .col-4 + .col-4 { border-left: 1px solid var(--admin-border); }

    .table thead th {
        font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.5px;
        font-weight: 600; color: var(--admin-text-muted); white-space: nowrap;
        border-bottom: 1px solid var(--admin-border); padding: 0.85rem 1rem; background: transparent;
    }
    .table tbody td { padding: 0.8rem 1rem; font-size: 0.82rem; color: var(--admin-text); }

    .msg-avatar {
        width: 34px; height: 34px; border-radius: 50%;
        background: var(--admin-bg-soft); border: 1px solid var(--admin-border);
        color: var(--admin-text); font-weight: 700; font-size: 0.78rem;
        display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .msg-preview {
        max-width: 240px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        display: inline-block; vertical-align: middle; color: var(--admin-text-muted);
    }
    .new-badge {
        font-size: 0.56rem; font-weight: 700; letter-spacing: 0.4px;
        background: rgba(14,165,233,0.1); color: #0ea5e9;
        border: 1px solid rgba(14,165,233,0.25);
        padding: 0.1rem 0.45rem; border-radius: 50px; text-transform: uppercase;
    }
    .act-btn { padding: 0.3rem 0.55rem !important; font-size: 0.8rem !important; border-radius: 8px !important; }
    .act-txt { display: none; }

    @media (max-width: 767.98px) {
        .contact-table-wrap.ae-table-card { background: transparent !important; border: none !important; box-shadow: none !important; border-radius: 0 !important; overflow: visible !important; padding: 0 !important; }
        #msgTable { min-width: 0 !important; max-width: 100% !important; }
        #msgTable thead { display: none; }
        #msgTable tbody { display: flex; flex-direction: column; gap: 0.9rem; }
        #msgTable tr {
            background: var(--admin-card-bg);
            border: 1px solid var(--admin-border);
            border-radius: 14px;
            padding: 1.1rem 1rem;
            width: 100%;
        }
        #msgTable td { display: block; width: 100%; padding: 0 !important; border: 0 !important; text-align: left !important; }
        .c-num { display: none; }
        .c-name .msg-avatar { width: 38px; height: 38px; font-size: 0.85rem; }
        .c-name .fw-semibold { font-size: 0.95rem; max-width: none; }
        .c-email { margin-top: 0.35rem; }
        .c-email span { font-size: 0.82rem; }
        .c-message { margin-top: 0.75rem; }
        .c-message .msg-preview { max-width: none; white-space: normal; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; font-size: 0.82rem; line-height: 1.55; }
        .c-meta { margin-top: 0.75rem; font-size: 0.74rem; font-weight: 600; }
        .c-actions { margin-top: 0.9rem !important; padding-top: 0.85rem !important; border-top: 1px solid var(--admin-border) !important; }
        .c-actions .d-flex { width: 100%; gap: 0.6rem !important; }
        .c-actions .act-btn { flex: 1 1 0; display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.6rem !important; font-size: 0.85rem !important; }
        .c-actions .act-txt { display: inline; }
    }

    @media (max-width: 575.98px) {
        .sum-box { padding: 0.8rem 0.25rem; gap: 0.2rem; }
        .sum-box .sum-ico { font-size: 0.9rem; }
        .sum-box .sum-num { font-size: 1.15rem; }
        .sum-box .sum-label { font-size: 0.58rem; }
        .msg-hd-left { gap: 0.75rem !important; flex-wrap: nowrap !important; }
        .ae-page-header .header-ico { width: 40px !important; height: 40px !important; border-radius: 11px !important; }
        .ae-page-header .header-ico i { font-size: 1.05rem !important; }
        .ae-page-header .ae-title { font-size: 1.02rem; }
        .ae-page-header .ae-sub { font-size: 0.72rem; }
        .ae-page-header .ae-badge { font-size: 0.7rem; padding: 0.25rem 0.7rem; }
        .msg-search-row { flex-wrap: wrap; row-gap: 0.35rem; }
        .msg-search-row .input-group { max-width: none; flex: 1 1 100%; }
        .msg-search-row .ae-note { font-size: 0.72rem; }
        .modal-header { padding: 0.9rem 1rem !important; }
        .modal-body { padding: 1rem 1rem 1.25rem !important; }
        .modal-footer { flex-wrap: wrap; gap: 0.5rem; padding: 0.85rem 1rem !important; }
        .modal-footer .ae-btn { flex: 1 1 100%; justify-content: center; }
    }
</style>

<div class="container-fluid pb-3">

    {{-- Header --}}
    <div class="ae-page-header mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.dashboard.index') }}" class="ae-btn ae-btn-ghost" style="padding:0.5rem 0.75rem;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;" class="header-ico">
                <i class="bi bi-envelope-paper" style="font-size:1.5rem;color:#00d9ff;"></i>
            </div>
            <div class="d-flex flex-column align-items-start gap-1">
                <div class="ae-title">Contact Messages</div>
                <p class="ae-sub">Manage customer inquiries from one place.</p>
            </div>
        </div>
        <span class="ae-badge"><span class="ae-dot"></span> {{ $contacts->count() }} Messages</span>
    </div>

    {{-- Stats strip --}}
    <div class="ae-table-card mb-3">
        <div class="row g-0 text-center sum-row">
            <div class="col-4">
                <div class="sum-box">
                    <div class="sum-ico" style="color:#0ea5e9;"><i class="bi bi-envelope"></i></div>
                    <div class="sum-num">{{ $stats['total'] }}</div>
                    <div class="sum-label">Total</div>
                </div>
            </div>
            <div class="col-4">
                <div class="sum-box">
                    <div class="sum-ico" style="color:#10b981;"><i class="bi bi-calendar-week"></i></div>
                    <div class="sum-num">{{ $stats['thisWeek'] }}</div>
                    <div class="sum-label">This Week</div>
                </div>
            </div>
            <div class="col-4">
                <div class="sum-box">
                    <div class="sum-ico" style="color:#f59e0b;"><i class="bi bi-lightning-charge"></i></div>
                    <div class="sum-num">{{ $stats['today'] }}</div>
                    <div class="sum-label">Today</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Search --}}
    <div class="d-flex align-items-center gap-2 mb-3 msg-search-row">
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
        <div class="ae-table-card contact-table-wrap">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="msgTable" style="min-width:900px;">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width:50px;">#</th>
                            <th style="width:220px;">Name</th>
                            <th style="width:230px;">Email</th>
                            <th style="width:110px;">Message</th>
                            <th style="width:160px;">Received</th>
                            <th class="pe-4 text-end" style="width:100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            @php
                                $created = \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka');
                                $subject = 'Re: Your message via ' . config('app.name', 'Portfolio');
                                $mailto = 'mailto:' . $contact->email . '?subject=' . urlencode('=?UTF-8?B?' . base64_encode($subject) . '?=');
                            @endphp
                            <tr data-name="{{ strtolower($contact->name) }}"
                                data-email="{{ strtolower($contact->email) }}"
                                data-msg="{{ strtolower($contact->message) }}">
                                <td class="ps-4 text-muted c-num">{{ $loop->iteration }}</td>
                                <td class="c-name">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="msg-avatar">{{ strtoupper(substr($contact->name, 0, 1)) }}</span>
                                        <div class="d-flex align-items-center flex-wrap gap-1" style="min-width:0;">
                                            <span class="fw-semibold" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:150px;">{{ $contact->name }}</span>
                                            @if($created->isToday())
                                                <span class="new-badge">New</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="c-email"><span class="text-muted" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:inline-block;max-width:100%;">{{ $contact->email }}</span></td>
                                <td class="c-message"><span class="msg-preview" title="{{ $contact->message }}">{{ $contact->message }}</span></td>
                                <td class="c-meta">{{ $created->format('d M Y') }} <span class="text-muted">&middot; {{ $created->format('h:i A') }}</span></td>
                                <td class="pe-4 c-actions">
                                    <div class="d-flex justify-content-end gap-1">
                                        <button type="button" class="ae-btn ae-btn-ghost act-btn" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}" title="View message">
                                            <i class="bi bi-eye"></i><span class="act-txt">View</span>
                                        </button>
                                        <a href="{{ $mailto }}" class="ae-btn ae-btn-ghost act-btn" title="Reply via email">
                                            <i class="bi bi-reply-fill"></i><span class="act-txt">Reply</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal --}}
                            <div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content" style="background:var(--admin-card-bg);border:1px solid var(--admin-border);border-radius:14px;overflow:hidden;">
                                        <div class="modal-header" style="border-bottom:1px solid var(--admin-border);padding:1.1rem 1.4rem;">
<div class="d-flex align-items-center gap-3 msg-hd-left">
                                                <span class="msg-avatar" style="width:42px;height:42px;font-size:0.95rem;">{{ strtoupper(substr($contact->name, 0, 1)) }}</span>
                                                <div style="min-width:0;">
                                                    <h5 class="modal-title fw-semibold mb-0" style="color:var(--admin-text);font-size:1rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $contact->name }}</h5>
                                                    <div class="small text-muted" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $contact->email }}</div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                <span class="chip" style="font-size:0.72rem;font-weight:600;padding:0.28rem 0.7rem;border-radius:50px;background:var(--admin-bg-soft);border:1px solid var(--admin-border);color:var(--admin-text);display:inline-flex;align-items:center;gap:0.35rem;">
                                                    <i class="bi bi-calendar3"></i> {{ $created->format('d M Y') }}
                                                </span>
                                                <span class="chip" style="font-size:0.72rem;font-weight:600;padding:0.28rem 0.7rem;border-radius:50px;background:rgba(14,165,233,0.08);border:1px solid rgba(14,165,233,0.2);color:#0ea5e9;display:inline-flex;align-items:center;gap:0.35rem;">
                                                    <i class="bi bi-clock"></i> {{ $created->format('h:i A') }}
                                                </span>
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
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-none" id="msgEmpty">
            <div class="ae-table-card">
                <div class="text-center py-5">
                    <i class="bi bi-search" style="font-size:2.2rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
                    <div class="fw-semibold" style="color:var(--admin-text);">No matching messages</div>
                    <p class="ae-note mb-0">Try a different search term.</p>
                </div>
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
    var rows = Array.prototype.slice.call(document.querySelectorAll('#msgTable tbody tr'));
    var empty = document.getElementById('msgEmpty');
    var count = document.getElementById('msgCount');

    function applyFilter() {
        var q = search.value.trim().toLowerCase();
        var visible = 0;
        rows.forEach(function (row) {
            var haystack = (row.dataset.name + ' ' + row.dataset.email + ' ' + row.dataset.msg);
            var match = haystack.indexOf(q) !== -1;
            row.style.display = match ? '' : 'none';
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
        var text = btn.getAttribute('data-copy');
        var done = function () {
            var icon = btn.querySelector('i');
            var old = icon.className;
            icon.className = 'bi bi-check-lg';
            setTimeout(function () {
                icon.className = old;
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