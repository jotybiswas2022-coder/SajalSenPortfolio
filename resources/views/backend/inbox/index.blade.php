@extends('backend.app')

@section('content')
<style>
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
    .msg-email { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%; }
    .msg-preview {
        max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        display: inline-block; vertical-align: middle; color: var(--admin-text-muted);
    }
    .act-btn { padding: 0.3rem 0.55rem !important; font-size: 0.8rem !important; border-radius: 8px !important; }
    .act-txt { display: none; }

    @media (max-width: 767.98px) {
        .contact-table-wrap.ae-table-card { background: transparent !important; border: none !important; box-shadow: none !important; border-radius: 0 !important; overflow: visible !important; padding: 0 !important; }
        #inboxTable { min-width: 0 !important; max-width: 100% !important; }
        #inboxTable thead { display: none; }
        #inboxTable tbody { display: flex; flex-direction: column; gap: 0.9rem; }
        #inboxTable tr {
            background: var(--admin-card-bg);
            border: 1px solid var(--admin-border);
            border-radius: 14px;
            padding: 1.1rem 1rem;
            width: 100%;
        }
        #inboxTable td { display: block; width: 100%; padding: 0 !important; border: 0 !important; text-align: left !important; }
        .inbox-table .c-client { display: flex; align-items: center; gap: 0.7rem; }
        .inbox-table .c-client-info { flex: 1; min-width: 0; }
        .inbox-table .c-name { font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .inbox-table .c-email { font-size: 0.78rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .inbox-table .c-msg { margin-top: 0.7rem; }
        .inbox-table .c-subject { font-size: 0.85rem; font-weight: 600; line-height: 1.35; word-break: break-word; }
        .inbox-table .c-preview {
            margin-top: 0.25rem; font-size: 0.78rem;
            max-width: none !important; white-space: normal !important; overflow: hidden !important;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
        }
        .inbox-table .c-package { margin-top: 0.7rem; }
        .inbox-table .c-package .ae-status-badge {
            max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
            font-size: 0.7rem; padding: 0.25rem 0.6rem;
        }
        .inbox-table .c-status, .inbox-table .c-time { display: inline-block; margin-top: 0.7rem; font-size: 0.7rem !important; }
        .inbox-table .c-time { margin-left: 0.6rem; }
        .inbox-table .c-action { margin-top: 0.85rem !important; padding-top: 0.8rem !important; border-top: 1px solid var(--admin-border) !important; }
        .inbox-table .c-action .ae-btn { width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; padding: 0.55rem !important; font-size: 0.8rem !important; }
        .inbox-table .c-action .act-txt { display: inline; }
    }

    @media (max-width: 575.98px) {
        .msg-hd-left { gap: 0.75rem !important; flex-wrap: nowrap !important; }
        .ae-page-header .header-ico { width: 40px !important; height: 40px !important; border-radius: 11px !important; }
        .ae-page-header .header-ico i { font-size: 1.05rem !important; }
        .ae-page-header .ae-title { font-size: 0.95rem; }
        .ae-page-header .ae-sub { font-size: 0.68rem; }
        .ae-page-header .ae-badge { font-size: 0.68rem; padding: 0.25rem 0.7rem; }
        .msg-search-row { flex-wrap: wrap; row-gap: 0.35rem; }
        .msg-search-row .input-group { max-width: none; flex: 1 1 100%; }
        .msg-search-row .input-group-text { font-size: 0.85rem; }
        .msg-search-row #inboxSearch { font-size: 0.85rem; }
        .msg-search-row .ae-note { font-size: 0.7rem; }
    }
</style>

<div class="container-fluid pb-3">

    {{-- Header --}}
    <div class="ae-page-header mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-3 msg-hd-left">
            <a href="{{ route('admin.dashboard.index') }}" class="ae-btn ae-btn-ghost" style="padding:0.5rem 0.75rem;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;" class="header-ico">
                <i class="bi bi-chat-dots" style="font-size:1.5rem;color:#00d9ff;"></i>
            </div>
            <div class="d-flex flex-column align-items-start gap-1">
                <div class="ae-title">Inbox</div>
                <p class="ae-sub">Manage conversations with clients.</p>
            </div>
        </div>
        <span class="ae-badge"><span class="ae-dot"></span> {{ $conversations->count() }} Conversations</span>
    </div>

    {{-- Search --}}
    <div class="d-flex align-items-center gap-2 mb-3 msg-search-row">
        <div class="input-group" style="max-width:480px;">
            <span class="input-group-text ae-search-icon"><i class="bi bi-search"></i></span>
            <input type="text" id="inboxSearch" class="form-control ae-search border-start-0 ps-0"
                   placeholder="Search by client, subject, package..." autocomplete="off">
            <span class="input-group-text ae-search-icon-end" id="inboxSearchClear" style="cursor:pointer;display:none;" title="Clear search">
                <i class="bi bi-x-lg"></i>
            </span>
        </div>
        <span class="ae-note" id="inboxCount"></span>
    </div>

    @if($conversations->isEmpty())
        <div class="ae-table-card">
            <div class="text-center py-5">
                <i class="bi bi-envelope-open" style="font-size:3rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
                <p class="ae-note mb-0">No conversations yet.</p>
            </div>
        </div>
    @else
        <div class="ae-table-card contact-table-wrap">
            <div class="table-responsive">
                <table class="table table-hover align-middle inbox-table" id="inboxTable" style="min-width:950px;">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width:260px;">Client</th>
                            <th>Subject</th>
                            <th style="width:200px;">Package</th>
                            <th style="width:100px;">Status</th>
                            <th style="width:150px;">Last Activity</th>
                            <th class="text-end pe-4" style="width:110px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($conversations as $conv)
                            <tr data-name="{{ strtolower($conv->user->name) }}"
                                data-email="{{ strtolower($conv->user->email) }}"
                                data-subject="{{ strtolower($conv->subject) }}"
                                data-package="{{ strtolower($conv->package_name ?? '') }}">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-2 c-client">
                                        <span class="msg-avatar">{{ strtoupper(substr($conv->user->name, 0, 1)) }}</span>
                                        <div class="c-client-info">
                                            <div class="fw-semibold c-name" style="color:var(--admin-text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:170px;">{{ $conv->user->name }}</div>
                                            <div class="c-email" style="font-size:0.75rem;color:var(--admin-text-muted);">{{ $conv->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="c-msg">
                                    <div class="c-subject" style="font-weight:600;color:var(--admin-text);">{{ $conv->subject }}</div>
                                    @if($conv->lastMessage)
                                        <div class="c-preview msg-preview">{{ $conv->lastMessage->message ?: '(image)' }}</div>
                                    @endif
                                </td>
                                <td class="c-package">
                                    @if($conv->package_name)
                                        <span class="ae-status-badge"><span class="ae-dot"></span> {{ $conv->package_name }} - {{ $conv->package_price }} USD</span>
                                    @else
                                        <span style="color:var(--admin-text-muted);font-size:0.82rem;">&mdash;</span>
                                    @endif
                                </td>
                                <td class="c-status">
                                    @if($conv->status == 'open')
                                        <span class="ae-status-badge" style="background:rgba(34,197,94,0.1);border-color:rgba(34,197,94,0.25);color:#22c55e;"><span class="ae-dot"></span> Open</span>
                                    @else
                                        <span class="ae-status-badge inactive"><span class="ae-dot"></span> Closed</span>
                                    @endif
                                </td>
                                <td class="c-time" style="font-size:0.8rem;color:var(--admin-text-muted);">
                                    {{ $conv->updated_at->diffForHumans() }}
                                </td>
                                <td class="text-end pe-4 c-action">
                                    <a href="{{ route('admin.inbox.show', $conv->id) }}" class="ae-btn ae-btn-ghost act-btn">
                                        <i class="bi bi-chat-dots"></i> <span class="act-txt">View</span><span class="d-none d-md-inline"> Reply</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-none" id="inboxEmpty">
            <div class="ae-table-card">
                <div class="text-center py-5">
                    <i class="bi bi-search" style="font-size:2.2rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
                    <div class="fw-semibold" style="color:var(--admin-text);">No matching conversations</div>
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
    var search = document.getElementById('inboxSearch');
    var clear = document.getElementById('inboxSearchClear');
    var rows = Array.prototype.slice.call(document.querySelectorAll('#inboxTable tbody tr'));
    var empty = document.getElementById('inboxEmpty');
    var count = document.getElementById('inboxCount');

    function applyFilter() {
        var q = search.value.trim().toLowerCase();
        var visible = 0;
        rows.forEach(function (row) {
            var haystack = (row.dataset.name + ' ' + row.dataset.email + ' ' + row.dataset.subject + ' ' + row.dataset.package);
            var match = haystack.indexOf(q) !== -1;
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        if (clear) clear.style.display = q ? 'inline-flex' : 'none';
        if (empty) empty.classList.toggle('d-none', visible !== 0);
        if (count) count.textContent = visible ? visible + ' conversation(s) found' : '';
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
})();
</script>
@endsection