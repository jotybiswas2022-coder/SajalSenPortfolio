@forelse($services as $service)
    <tr>
        <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
        <td class="text-center" style="font-size:1.3rem;">
            @if($service->icon)
                <span style="color:#00d9ff;"><i class="bi {{ $service->icon }}"></i></span>
            @else
                <span class="text-muted small">—</span>
            @endif
        </td>
        <td class="fw-semibold">{{ $service->title }}</td>
        <td>
            <span class="text-muted small">{{ Str::limit($service->short_description, 60) ?: '—' }}</span>
        </td>
        <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $service->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.services.toggleStatus', $service->id) }}"
               class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $service->is_active ? 'active-badge' : 'inactive-badge' }}"
               data-title="{{ $service->title }}">
                {{ $service->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.services.edit', $service->id) }}"
                   class="btn btn-sm btn-outline-primary rounded-3 px-2">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button"
                        class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                        data-id="{{ $service->id }}"
                        data-title="{{ $service->title }}">
                    <i class="bi bi-trash"></i>
                </button>
                <form id="delete-form-{{ $service->id }}"
                      action="{{ route('admin.services.destroy', $service->id) }}"
                      method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-search" style="font-size:2rem; color:#94a3b8; display:block; margin-bottom:0.5rem;"></i>
                <div class="fw-semibold mb-2">No Services Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </td>
    </tr>
@endforelse
