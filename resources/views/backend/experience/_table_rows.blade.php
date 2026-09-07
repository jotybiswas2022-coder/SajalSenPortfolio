@forelse($experiences as $exp)
    <tr>
        <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
        <td class="fw-semibold" style="color:var(--admin-text);">
            {{ $exp->company }}
            @if($exp->is_current)
                <span class="badge rounded-pill px-2 py-1 ms-1" style="background:rgba(0,255,136,0.12); color:#00ff88; font-size:0.6rem; font-weight:600; border:1px solid rgba(0,255,136,0.3);">
                    <i class="bi bi-suitcase-lg-fill me-1"></i>Current
                </span>
            @endif
        </td>
        <td style="color:var(--admin-text);">{{ $exp->position }}</td>
        <td class="small text-muted"><i class="bi bi-calendar-range me-1" style="color:#00d9ff;"></i>{{ $exp->duration }}</td>
        <td class="small text-muted">{{ $exp->location ?: '—' }}</td>
        <td><span class="ae-order-badge">{{ $exp->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.experiences.toggleStatus', $exp->id) }}"
               class="text-decoration-none ae-status-badge status-badge {{ $exp->is_active ? '' : 'inactive' }}"
               data-title="{{ $exp->company }}">
                <i class="bi {{ $exp->is_active ? 'bi-check-circle' : 'bi-circle' }}"></i>
                {{ $exp->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.experiences.edit', $exp->id) }}"
                   class="ae-action-btn edit" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button"
                        class="ae-action-btn delete delete-btn"
                        data-id="{{ $exp->id }}"
                        data-title="{{ $exp->company }}" title="Delete">
                    <i class="bi bi-trash"></i>
                </button>
                <form id="delete-form-{{ $exp->id }}"
                      action="{{ route('admin.experiences.destroy', $exp->id) }}"
                      method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center py-5">
            <i class="bi bi-search" style="font-size:2rem; color:var(--admin-text-muted); display:block; margin-bottom:0.75rem;"></i>
            <div class="fw-semibold mb-2" style="color:var(--admin-text);">No Experiences Found</div>
            <p class="ae-note">Try adjusting your search terms.</p>
        </td>
    </tr>
@endforelse