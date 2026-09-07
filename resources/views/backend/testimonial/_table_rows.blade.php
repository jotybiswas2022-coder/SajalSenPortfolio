@forelse($testimonials as $testimonial)
    <tr>
        <td class="ps-4 fw-semibold">#{{ $loop->iteration }}</td>
        <td>
            @if($testimonial->avatar)
                <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                     alt="{{ $testimonial->name }}"
                     class="rounded-circle shadow-sm"
                     style="width:40px;height:40px;object-fit:cover;border:1.5px solid rgba(0,217,255,0.35);">
            @else
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center fw-bold"
                     style="width:40px;height:40px;background:linear-gradient(135deg,#00d9ff,#00ff88);color:#fff;font-size:0.95rem;box-shadow:0 0 12px rgba(0,217,255,0.3);">
                    {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                </div>
            @endif
        </td>
        <td class="fw-semibold">{{ $testimonial->name }}</td>
        <td><span class="text-muted small">{{ $testimonial->designation_display ?: '—' }}</span></td>
        <td>
            <div style="color:#fbbf24;white-space:nowrap;font-size:0.85rem;text-shadow:0 0 8px rgba(251,191,36,0.3);">
                @foreach($testimonial->stars as $filled)
                    <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                @endforeach
            </div>
        </td>
        <td>
            <button class="ae-btn ae-btn-ghost view-msg-btn" style="padding:0.3rem 0.7rem;font-size:0.75rem;"
                    data-bs-toggle="modal" data-bs-target="#msgModal{{ $testimonial->id }}">
                <i class="bi bi-eye me-1"></i> View
            </button>

            <div class="modal fade" id="msgModal{{ $testimonial->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="background:var(--admin-bg-soft);border:1.5px solid var(--admin-border);border-radius:14px;">
                        <div class="modal-header" style="border-bottom:1px solid var(--admin-border);padding:1rem 1.25rem;">
                            <h5 class="modal-title fw-semibold" style="color:var(--admin-text);"><i class="bi bi-chat-quote me-2" style="color:#00d9ff;"></i>{{ $testimonial->name }}'s Review</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1)"></button>
                        </div>
                        <div class="modal-body px-4 py-3">
                            <div class="mb-3 d-flex align-items-center gap-2">
                                @if($testimonial->avatar)
                                    <img src="{{ config('app.storage_url') }}{{ $testimonial->avatar }}"
                                         class="rounded-circle shadow-sm" style="width:48px;height:48px;object-fit:cover;border:1.5px solid rgba(0,217,255,0.35);">
                                @else
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center fw-bold"
                                         style="width:48px;height:48px;background:linear-gradient(135deg,#00d9ff,#00ff88);color:#fff;">
                                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold" style="color:var(--admin-text);">{{ $testimonial->name }}</div>
                                    <div style="color:#fbbf24;font-size:0.85rem;">
                                        @foreach($testimonial->stars as $filled)
                                            <i class="bi {{ $filled ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0" style="font-style:italic;line-height:1.7;color:var(--admin-text);">
                                "{{ $testimonial->message }}"
                            </p>
                        </div>
                        <div class="modal-footer border-0 px-4 pb-4 pt-0">
                            <button type="button" class="ae-btn ae-btn-ghost" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td><span class="ae-order-badge">{{ $testimonial->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.testimonials.toggleStatus', $testimonial->id) }}"
               class="ae-status-badge status-badge {{ $testimonial->is_active ? '' : 'inactive' }}"
               data-title="{{ $testimonial->name }}">
                <span class="ae-dot"></span> {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="ae-action-btn edit" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button" class="ae-action-btn delete delete-btn"
                        data-id="{{ $testimonial->id }}" data-title="{{ $testimonial->name }}" title="Delete">
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
            <i class="bi bi-search" style="font-size:2rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
            <p class="ae-note mb-0">No testimonials found. Try adjusting your search.</p>
        </td>
    </tr>
@endforelse