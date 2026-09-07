@forelse($testimonials as $testimonial)
    <tr>
        <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
        <td>
            @if($testimonial->avatar)
                <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                     alt="{{ $testimonial->name }}"
                     class="rounded-circle shadow-sm"
                     style="width:40px; height:40px; object-fit:cover; border:2px solid rgba(0,217,255,0.15);">
            @else
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center fw-bold"
                     style="width:40px; height:40px; background:linear-gradient(135deg,#00d9ff,#00ff88); color:#fff; font-size:0.95rem;">
                    {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                </div>
            @endif
        </td>
        <td class="fw-semibold">{{ $testimonial->name }}</td>
        <td><span class="text-muted small">{{ $testimonial->designation_display ?: '—' }}</span></td>
        <td>
            <div style="color:#f59e0b; white-space:nowrap; font-size:0.85rem;">
                @foreach($testimonial->stars as $filled)
                    <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                @endforeach
            </div>
        </td>
        <td>
            <button class="btn btn-sm rounded-3 px-3 view-msg-btn"
                    style="background:rgba(0,217,255,0.08); color:#00d9ff; border:none; font-weight:500; font-size:0.78rem;"
                    data-bs-toggle="modal" data-bs-target="#msgModal{{ $testimonial->id }}">
                <i class="bi bi-eye me-1"></i> View
            </button>

            <div class="modal fade modal-modern" id="msgModal{{ $testimonial->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header" style="background:linear-gradient(135deg,#00d9ff,#00ff88); color:#fff; border-radius:12px 12px 0 0;">
                            <h5 class="modal-title fw-semibold"><i class="bi bi-chat-quote me-2"></i>{{ $testimonial->name }}'s Review</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body px-4 py-3">
                            <div class="mb-3 d-flex align-items-center gap-2">
                                @if($testimonial->avatar)
                                    <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                                         class="rounded-circle shadow-sm" style="width:48px; height:48px; object-fit:cover;">
                                @endif
                                <div>
                                    <div class="fw-bold">{{ $testimonial->name }}</div>
                                    <div style="color:#f59e0b; font-size:0.85rem;">
                                        @foreach($testimonial->stars as $filled)
                                            <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0" style="font-style:italic; line-height:1.7; color:#334155;">
                                "{{ $testimonial->message }}"
                            </p>
                        </div>
                        <div class="modal-footer border-0 px-4 pb-4 pt-0">
                            <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $testimonial->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.testimonials.toggleStatus', $testimonial->id) }}"
               class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $testimonial->is_active ? 'active-badge' : 'inactive-badge' }}"
               data-title="{{ $testimonial->name }}">
                {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                   class="btn btn-sm btn-outline-primary rounded-3 px-2">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button"
                        class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                        data-id="{{ $testimonial->id }}"
                        data-title="{{ $testimonial->name }}">
                    <i class="bi bi-trash"></i>
                </button>
                <form id="delete-form-{{ $testimonial->id }}"
                      action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
                      method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="9" class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-search" style="font-size:2rem; color:#94a3b8; display:block; margin-bottom:0.5rem;"></i>
                <div class="fw-semibold mb-2">No Testimonials Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </td>
    </tr>
@endforelse
