@extends('backend.app')

@section('content')
<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="ae-page-header mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-envelope-paper" style="font-size:1.5rem;color:#00d9ff;"></i>
            </div>
            <div class="d-flex flex-column align-items-start gap-1">
                <div class="ae-title">Messages</div>
                <p class="ae-sub">Manage customer inquiries from one place.</p>
            </div>
        </div>
        <span class="ae-badge"><span class="ae-dot"></span> {{ $contacts->count() }} Messages</span>
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
        <div class="ae-table-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle" style="min-width:800px;">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width:50px;">#</th>
                            <th style="min-width:150px;">Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th style="width:120px;">Date</th>
                            <th style="width:90px;">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td class="ps-4 fw-semibold" style="color:var(--admin-text-muted);">{{ $loop->iteration }}</td>
                                <td class="fw-semibold" style="color:var(--admin-text);">{{ $contact->name }}</td>
                                <td><span style="color:var(--admin-text-muted);">{{ $contact->email }}</span></td>
                                <td>
                                    <button type="button" class="ae-btn ae-btn-ghost" data-bs-toggle="modal" data-bs-target="#messageModal{{ $contact->id }}">
                                        <i class="bi bi-eye"></i> View
                                    </button>

                                    <div class="modal fade" id="messageModal{{ $contact->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content" style="background:var(--admin-bg-soft);border:1.5px solid var(--admin-border);border-radius:14px;">
                                                <div class="modal-header" style="border-bottom:1px solid var(--admin-border);padding:1rem 1.25rem;">
                                                    <h5 class="modal-title fw-semibold" style="color:var(--admin-text);">
                                                        <i class="bi bi-chat-dots me-2" style="color:#00d9ff;"></i> Message from {{ $contact->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1)"></button>
                                                </div>
                                                <div class="modal-body px-4 py-3">
                                                    <div class="mb-3">
                                                        <small class="ae-form-label">From</small>
                                                        <p class="mb-0" style="color:var(--admin-text);">{{ $contact->name }} &lt;{{ $contact->email }}&gt;</p>
                                                    </div>
                                                    <div>
                                                        <small class="ae-form-label">Message</small>
                                                        <p class="mb-0" style="white-space:pre-wrap;color:var(--admin-text);line-height:1.7;">{{ $contact->message }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                                                    <button type="button" class="ae-btn ae-btn-primary" data-bs-dismiss="modal">
                                                        <i class="bi bi-check-lg me-1"></i> Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="ae-status-badge" style="background:var(--admin-bg-soft);border-color:var(--admin-border);color:var(--admin-text);cursor:default;">
                                        {{ \Carbon\Carbon::parse($contact->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="ae-status-badge" style="background:rgba(0,217,255,0.08);border-color:rgba(0,217,255,0.2);color:#00d9ff;cursor:default;">
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