@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .contact-page h4 { font-size: 0.9rem; }
    .contact-page p.text-muted { font-size: 0.75rem; }
    .contact-page .badge { font-size: 0.65rem; padding: 0.2rem 0.5rem !important; }
    .contact-page .table thead th { font-size: 0.65rem !important; padding: 0.35rem 0.4rem !important; }
    .contact-page .table tbody td { font-size: 0.72rem; padding: 0.35rem 0.4rem; }
    .contact-page .table tbody td .fw-semibold { font-size: 0.78rem; }
    .contact-page .table tbody td .btn { font-size: 0.65rem; padding: 0.2rem 0.5rem; }
    .contact-page .modal-header h5 { font-size: 0.9rem; }
    .contact-page .modal-body { padding: 0.8rem !important; }
    .contact-page .modal-body p { font-size: 0.78rem; }
    .contact-page .modal-body small { font-size: 0.68rem; }
    .contact-page .modal-footer .btn { font-size: 0.72rem; padding: 0.3rem 0.7rem; }
}
</style>

<div class="container-fluid py-3 contact-page">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-envelope-paper me-2" style="color:#00d9ff;"></i>Messages</h4>
            <p class="text-muted small mb-0">Manage customer inquiries from one place</p>
        </div>
        <div>
            <span class="badge rounded-pill px-3 py-2" style="background:rgba(0,217,255,0.1); color:#00d9ff; font-weight:500;">
                <i class="bi bi-database me-1"></i> {{ $contacts->count() }} Messages
            </span>
        </div>
    </div>

    {{-- Table Card --}}
    @if($contacts->isEmpty())
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <div class="fw-semibold mb-2">No Messages Found</div>
                <p class="text-muted small">Customer messages will appear here once submitted.</p>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width:750px;">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-semibold" style="width:50px;">#</th>
                            <th class="py-3 text-muted small fw-semibold">Name</th>
                            <th class="py-3 text-muted small fw-semibold">Email</th>
                            <th class="py-3 text-muted small fw-semibold">Message</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:120px;">Date</th>
                            <th class="pe-4 py-3 text-muted small fw-semibold" style="width:100px;">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $contact->name }}</td>
                                <td><span class="text-muted small">{{ $contact->email }}</span></td>
                                <td>
                                    <button type="button" class="btn btn-sm rounded-3 px-3" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}"
                                            style="background:rgba(0,217,255,0.08); color:#00d9ff; border:1px solid rgba(0,217,255,0.2); font-weight:500;">
                                        <i class="bi bi-eye me-1"></i> View
                                    </button>

                                    {{-- Message Modal --}}
                                    <div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content border-0 shadow rounded-4">
                                                <div class="modal-header text-white rounded-top-4" style="background: linear-gradient(135deg, #00d9ff, #00ff88);">
                                                    <h5 class="modal-title fw-semibold">
                                                        <i class="bi bi-chat-dots me-2"></i> Message from {{ $contact->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body px-4 py-4">
                                                    <div class="mb-3">
                                                        <small class="text-muted fw-semibold">From</small>
                                                        <p class="mb-0">{{ $contact->name }} &lt;{{ $contact->email }}&gt;</p>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted fw-semibold">Message</small>
                                                        <p class="mb-0" style="white-space: pre-wrap;">{{ $contact->message }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                                                    <button type="button" class="btn rounded-3 px-4 py-2 text-white" data-bs-dismiss="modal"
                                                            style="background:#00d9ff; border-color:#00d9ff;">
                                                        <i class="bi bi-check-lg me-1"></i> Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">
                                        {{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-1" style="background:rgba(0,217,255,0.08); color:#00d9ff; font-weight:500;">
                                        {{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}
                                    </span>
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
