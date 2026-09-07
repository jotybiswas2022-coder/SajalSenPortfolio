@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .inbox-page h4 { font-size: 0.9rem; }
    .inbox-page p.text-muted { font-size: 0.75rem; }
    .inbox-page .table thead th { font-size: 0.65rem !important; padding: 0.35rem 0.4rem !important; }
    .inbox-page .table tbody td { font-size: 0.72rem; padding: 0.35rem 0.4rem; }
    .inbox-page .table tbody td .fw-semibold { font-size: 0.78rem !important; }
    .inbox-page .table tbody td [style*="font-size:0.75rem"] { font-size: 0.65rem !important; }
    .inbox-page .table tbody td [style*="font-size:0.9rem"] { font-size: 0.78rem !important; }
    .inbox-page .table tbody td [style*="font-size:0.78rem"] { font-size: 0.68rem !important; }
    .inbox-page .table tbody td [style*="font-size:0.82rem"] { font-size: 0.7rem !important; }
    .inbox-page .badge { font-size: 0.65rem !important; padding: 0.2rem 0.4rem !important; }
    .inbox-page .btn { font-size: 0.65rem; padding: 0.2rem 0.5rem; }
    .inbox-page .card-body { padding: 0 !important; }
    .inbox-page [style*="width:36px"] { width: 28px !important; height: 28px !important; font-size: 0.7rem !important; }
}
</style>

<div class="container-fluid py-3 inbox-page">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-chat-dots me-2" style="color:#00d9ff;"></i>Inbox</h4>
            <p class="text-muted small mb-0">Manage conversations with clients</p>
        </div>
    </div>

    @if($conversations->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-envelope-open" style="font-size:3rem; color:#94a3b8;"></i>
            <p class="text-muted mt-3">No conversations yet.</p>
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Client</th>
                                <th>Subject</th>
                                <th>Package</th>
                                <th>Status</th>
                                <th>Last Activity</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($conversations as $conv)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#00d9ff,#00ff88); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:0.85rem;">
                                                {{ substr($conv->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold" style="font-size:0.9rem;">{{ $conv->user->name }}</div>
                                                <div style="font-size:0.75rem; color:#94a3b8;">{{ $conv->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight:500; font-size:0.9rem;">{{ $conv->subject }}</div>
                                        @if($conv->lastMessage)
                                            <div style="font-size:0.78rem; color:#94a3b8; max-width:250px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                                {{ $conv->lastMessage->message ?: '(image)' }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($conv->package_name)
                                            <span class="badge" style="background:rgba(0,217,255,0.12); color:#00d9ff; font-size:0.78rem; font-weight:500;">
                                                {{ $conv->package_name }} - {{ $conv->package_price }} USD
                                            </span>
                                        @else
                                            <span style="color:#94a3b8; font-size:0.85rem;">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill" style="font-size:0.75rem; font-weight:500;
                                            {{ $conv->status == 'open' ? 'background:rgba(34,197,94,0.12); color:#22c55e;' : 'background:rgba(248,113,113,0.12); color:#f87171;' }}">
                                            {{ ucfirst($conv->status) }}
                                        </span>
                                    </td>
                                    <td style="font-size:0.82rem; color:#64748b;">
                                        {{ $conv->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('admin.inbox.show', $conv->id) }}" class="btn btn-sm" style="background:rgba(0,217,255,0.08); color:#00d9ff; border-radius:8px; font-weight:500;">
                                            <i class="bi bi-chat-dots me-1"></i> Reply
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
