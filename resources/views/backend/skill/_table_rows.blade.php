@forelse($skills as $skill)
    <tr>
        <td class="ps-4 fw-semibold">#{{ $loop->iteration }}</td>
        <td class="text-center" style="font-size:1.3rem;">
            @if($skill->icon)
                <span style="color:#00d9ff;text-shadow:0 0 12px rgba(0,217,255,0.4);"><i class="bi {{ $skill->icon }}"></i></span>
            @else
                <span class="text-muted small">—</span>
            @endif
        </td>
        <td class="fw-semibold">{{ $skill->name }}</td>
        <td>
            <span class="ae-status-badge"><i class="bi bi-percent"></i> {{ $skill->percentage }}%</span>
        </td>
        <td>
            <div class="d-flex align-items-center" style="min-width:170px;">
                <div class="progress flex-grow-1" style="height:8px;border-radius:10px;background:rgba(0,217,255,0.1);">
                    <div class="progress-bar rounded-pill" style="width:{{ $skill->percentage }}%;background:linear-gradient(90deg,#00d9ff,#7ce6ff);box-shadow:0 0 10px rgba(0,217,255,0.4);" role="progressbar"></div>
                </div>
            </div>
        </td>
        <td><span class="ae-order-badge">{{ $skill->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.skills.toggleStatus', $skill->id) }}"
               class="ae-status-badge status-badge {{ $skill->is_active ? '' : 'inactive' }}"
               data-title="{{ $skill->name }}">
                <span class="ae-dot"></span> {{ $skill->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.skills.edit', $skill->id) }}" class="ae-action-btn edit" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button" class="ae-action-btn delete delete-btn"
                        data-id="{{ $skill->id }}" data-title="{{ $skill->name }}" title="Delete">
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
            <i class="bi bi-search" style="font-size:2rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
            <p class="ae-note mb-0">No skills found. Try adjusting your search.</p>
        </td>
    </tr>
@endforelse