@extends('backend.app')

@section('content')
<style>
    @media (max-width: 767.98px) {
        .ae-page-header { padding: 12px 12px; }
        .ae-page-header .header-ico { width: 40px !important; height: 40px !important; border-radius: 11px !important; }
        .ae-page-header .header-ico i { font-size: 1.05rem !important; }
        .ae-page-header .ae-title { font-size: 1rem; }
        .ae-page-header .ae-sub { font-size: 0.72rem; }
        .ae-page-header .ae-badge { font-size: 0.62rem; padding: 0.2rem 0.55rem; }

        .inbox-table { min-width: 0 !important; }
        .inbox-table thead { display: none; }
        .inbox-table, .inbox-table tbody, .inbox-table tr, .inbox-table td { display: block; }
        .inbox-table tr { padding: 0.9rem 1rem; border-bottom: 1px solid var(--admin-border); }
        .inbox-table tr:last-child { border-bottom: 0; }
        .inbox-table td { padding: 0 !important; border-bottom: 0 !important; text-align: left !important; }
        .inbox-table .c-client { display: flex; align-items: center; gap: 0.7rem; }
        .inbox-table .c-client-info { flex: 1; min-width: 0; }
        .inbox-table .c-name { font-size: 0.85rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .inbox-table .c-email { font-size: 0.72rem !important; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .inbox-table .c-status { display: inline-block; margin-top: 0.55rem; }
        .inbox-table .c-status .ae-status-badge { font-size: 0.68rem; padding: 0.2rem 0.55rem; }
        .inbox-table .c-time { display: inline-block; margin-top: 0.55rem; margin-left: 0.5rem; font-size: 0.72rem !important; }
        .inbox-table .c-subject { margin-top: 0.6rem; font-size: 0.85rem; line-height: 1.35; word-break: break-word; }
        .inbox-table .c-preview {
            margin-top: 0.3rem; font-size: 0.75rem;
            max-width: none !important; white-space: normal !important; overflow: hidden !important;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
        }
        .inbox-table .c-package { margin-top: 0.6rem; }
        .inbox-table .c-package .ae-status-badge {
            max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
            font-size: 0.7rem; padding: 0.25rem 0.6rem;
        }
        .inbox-table .c-action { margin-top: 0.75rem; }
        .inbox-table .c-action .ae-btn { width: 100%; padding: 0.55rem; font-size: 0.8rem; }
    }
</style>
<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="ae-page-header mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
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

    @if($conversations->isEmpty())
        <div class="ae-table-card">
            <div class="text-center py-5">
                <i class="bi bi-envelope-open" style="font-size:3rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
                <p class="ae-note mb-0">No conversations yet.</p>
            </div>
        </div>
    @else
        <div class="ae-table-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle inbox-table" style="min-width:900px;">
                    <thead>
                        <tr>
                            <th class="ps-4">Client</th>
                            <th>Subject</th>
                            <th style="width:180px;">Package</th>
                            <th style="width:90px;">Status</th>
                            <th style="width:130px;">Last Activity</th>
                            <th class="text-end pe-4" style="width:110px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($conversations as $conv)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-2 c-client">
                                        <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#00d9ff,#00ff88);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:0.85rem;box-shadow:0 0 12px rgba(0,217,255,0.3);flex-shrink:0;">
                                            {{ substr($conv->user->name, 0, 1) }}
                                        </div>
                                        <div class="c-client-info">
                                            <div class="fw-semibold c-name" style="color:var(--admin-text);">{{ $conv->user->name }}</div>
                                            <div class="c-email" style="font-size:0.75rem;color:var(--admin-text-muted);">{{ $conv->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="c-subject" style="font-weight:600;color:var(--admin-text);">{{ $conv->subject }}</div>
                                    @if($conv->lastMessage)
                                        <div class="c-preview" style="font-size:0.78rem;color:var(--admin-text-muted);max-width:250px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                            {{ $conv->lastMessage->message ?: '(image)' }}
                                        </div>
                                    @endif
                                </td>
                                <td class="c-package">
                                    @if($conv->package_name)
                                        <span class="ae-status-badge"><span class="ae-dot"></span> {{ $conv->package_name }} - {{ $conv->package_price }} USD</span>
                                    @else
                                        <span style="color:var(--admin-text-muted);font-size:0.85rem;">—</span>
                                    @endif
                                </td>
                                <td class="c-status">
                                    @if($conv->status == 'open')
                                        <span class="ae-status-badge" style="background:rgba(34,197,94,0.1);border-color:rgba(34,197,94,0.25);color:#22c55e;"><span class="ae-dot"></span> Open</span>
                                    @else
                                        <span class="ae-status-badge inactive"><span class="ae-dot"></span> Closed</span>
                                    @endif
                                </td>
                                <td class="c-time" style="font-size:0.82rem;color:var(--admin-text-muted);">
                                    {{ $conv->updated_at->diffForHumans() }}
                                </td>
                                <td class="text-end pe-4 c-action">
                                    <a href="{{ route('admin.inbox.show', $conv->id) }}" class="ae-btn ae-btn-ghost">
                                        <i class="bi bi-chat-dots"></i> Reply
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>
@endsection