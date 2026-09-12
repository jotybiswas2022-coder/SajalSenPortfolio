@forelse($skills as $skill)
    <tr>
        <td class="ps-4 fw-semibold c-num">#{{ $loop->iteration }}</td>
        <td class="c-name">
            <div class="d-flex align-items-center gap-2">
                <span class="c-qnum">#{{ $loop->iteration }}</span>
                <span class="skill-ico">
                    @if($skill->icon)
                        <i class="bi {{ $skill->icon }}" style="text-shadow:0 0 12px rgba(0,217,255,0.4);"></i>
                    @else
                        <i class="bi bi-code-slash"></i>
                    @endif
                </span>
                <span class="fw-semibold text-nowrap c-name-text" style="color:var(--admin-text);overflow:hidden;text-overflow:ellipsis;max-width:200px;">{{ $skill->name }}</span>
            </div>
        </td>
        <td class="c-level">
            <span class="ae-status-badge"><i class="bi bi-percent"></i> {{ $skill->percentage }}%</span>
        </td>
        <td class="c-progress">
            <div class="d-flex align-items-center gap-2">
                <div class="progress flex-grow-1" style="height:8px;border-radius:10px;background:rgba(0,217,255,0.1);min-width:80px;">
                    <div class="progress-bar rounded-pill" style="width:{{ $skill->percentage }}%;background:linear-gradient(90deg,#00d9ff,#7ce6ff);box-shadow:0 0 10px rgba(0,217,255,0.4);" role="progressbar"></div>
                </div>
                <span class="percent-label">{{ $skill->percentage }}%</span>
            </div>
        </td>
        <td class="c-order"><span class="ae-order-badge">{{ $skill->sort_order }}</span></td>
        <td class="c-status">
            <a href="{{ route('admin.skills.toggleStatus', $skill->id) }}"
               class="ae-status-badge status-badge {{ $skill->is_active ? '' : 'inactive' }}"
               data-title="{{ $skill->name }}">
                <span class="ae-dot"></span> {{ $skill->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td class="pe-4 c-actions">
            <div class="d-flex gap-1 justify-content-end">
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
        <td colspan="7" class="text-center py-5">
            <i class="bi bi-search" style="font-size:2rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
            <p class="ae-note mb-0">No skills found. Try adjusting your search.</p>
        </td>
    </tr>
@endforelse