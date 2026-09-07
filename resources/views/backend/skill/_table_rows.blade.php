@forelse($skills as $skill)
    <tr>
        <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
        <td class="text-center" style="font-size:1.3rem;">
            @if($skill->icon)
                <span style="color:#00d9ff;"><i class="bi {{ $skill->icon }}"></i></span>
            @else
                <span class="text-muted small">—</span>
            @endif
        </td>
        <td class="fw-semibold">{{ $skill->name }}</td>
        <td>
            <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:rgba(0,217,255,0.1); color:#00d9ff;">{{ $skill->percentage }}%</span>
        </td>
        <td style="min-width:150px;">
            <div class="progress" style="height:7px; border-radius:10px; background:#e2e8f0;">
                <div class="progress-bar rounded-pill" style="width:{{ $skill->percentage }}%; background:linear-gradient(90deg,#00d9ff,#7ce6ff);" role="progressbar"></div>
            </div>
        </td>
        <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $skill->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.skills.toggleStatus', $skill->id) }}"
               class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $skill->is_active ? 'active-badge' : 'inactive-badge' }}"
               data-title="{{ $skill->name }}">
                {{ $skill->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.skills.edit', $skill->id) }}"
                   class="btn btn-sm btn-outline-primary rounded-3 px-2">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button"
                        class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                        data-id="{{ $skill->id }}"
                        data-title="{{ $skill->name }}">
                    <i class="bi bi-trash"></i>
                </button>
                <form id="delete-form-{{ $skill->id }}"
                      action="{{ route('admin.skills.destroy', $skill->id) }}"
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
                <div class="fw-semibold mb-2">No Skills Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </td>
    </tr>
@endforelse
