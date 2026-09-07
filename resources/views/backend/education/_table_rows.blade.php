@forelse($educations as $education)
    <tr>
        <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
        <td class="fw-semibold">{{ $education->degree_name }}</td>
        <td>{{ $education->institution }}
            @if($education->board_or_university)
                <br><small class="text-muted">{{ $education->board_or_university }}</small>
            @endif
        </td>
        <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $education->duration }}</span></td>
        <td>
            @if($education->result)
                <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:rgba(0,217,255,0.1); color:#00d9ff;">{{ $education->result }}</span>
            @else
                <span class="text-muted small">—</span>
            @endif
        </td>
        <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $education->display_order }}</span></td>
        <td>
            <a href="{{ route('admin.education.toggleStatus', $education->id) }}"
               class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $education->is_active ? 'active-badge' : 'inactive-badge' }}"
               data-title="{{ $education->degree_name }}">
                {{ $education->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.education.edit', $education->id) }}"
                   class="btn btn-sm btn-outline-primary rounded-3 px-2">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button"
                        class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                        data-id="{{ $education->id }}"
                        data-title="{{ $education->degree_name }}">
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
            <div class="empty-state">
                <i class="bi bi-search" style="font-size:2rem; color:#94a3b8; display:block; margin-bottom:0.5rem;"></i>
                <div class="fw-semibold mb-2">No Qualifications Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </td>
    </tr>
@endforelse
