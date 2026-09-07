@forelse($educations as $education)
    <tr>
        <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
        <td class="fw-semibold" style="color:var(--admin-text);">{{ $education->degree_name }}</td>
        <td style="color:var(--admin-text);">{{ $education->institution }}
            @if($education->board_or_university)
                <br><small class="text-muted">{{ $education->board_or_university }}</small>
            @endif
        </td>
        <td><span class="ae-order-badge"><i class="bi bi-calendar-range me-1" style="color:#00d9ff;"></i>{{ $education->duration }}</span></td>
        <td>
            @if($education->result)
                <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:rgba(0,217,255,0.12); color:#00d9ff; border:1px solid rgba(0,217,255,0.25);">
                    <i class="bi bi-patch-check me-1"></i>{{ $education->result }}
                </span>
            @else
                <span class="text-muted small">—</span>
            @endif
        </td>
        <td><span class="ae-order-badge">{{ $education->display_order }}</span></td>
        <td>
            <a href="{{ route('admin.education.toggleStatus', $education->id) }}"
               class="text-decoration-none ae-status-badge status-badge {{ $education->is_active ? '' : 'inactive' }}"
               data-title="{{ $education->degree_name }}">
                <i class="bi {{ $education->is_active ? 'bi-check-circle' : 'bi-circle' }}"></i>
                {{ $education->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.education.edit', $education->id) }}"
                   class="ae-action-btn edit" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button"
                        class="ae-action-btn delete delete-btn"
                        data-id="{{ $education->id }}"
                        data-title="{{ $education->degree_name }}" title="Delete">
                    <i class="bi bi-trash"></i>
                </button>
                <form id="delete-form-{{ $education->id }}"
                      action="{{ route('admin.education.destroy', $education->id) }}"
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
            <div class="fw-semibold mb-2" style="color:var(--admin-text);">No Qualifications Found</div>
            <p class="ae-note">Try adjusting your search terms.</p>
        </td>
    </tr>
@endforelse