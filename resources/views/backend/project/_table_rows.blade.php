@forelse($projects as $project)
    <tr>
        <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
        <td>
            @if($project->image)
                <img src="{{ config('app.storage_url') }}{{ $project->image }}"
                     alt="{{ $project->title }}"
                     class="rounded"
                     style="width:48px; height:36px; object-fit:cover;">
            @else
                <div class="rounded d-inline-flex align-items-center justify-content-center"
                     style="width:48px; height:36px; background:#f1f5f9; color:#cbd5e1;">
                    <i class="bi bi-image"></i>
                </div>
            @endif
        </td>
        <td class="fw-semibold">{{ $project->title }}</td>
        <td>
            @if($project->category)
                <span class="badge rounded-pill px-3 py-1" style="background:rgba(0,217,255,0.08); color:#00d9ff; font-weight:500;">
                    {{ $project->category }}
                </span>
            @else
                <span class="text-muted small">—</span>
            @endif
        </td>
        <td>
            <div style="display:flex; flex-wrap:wrap; gap:3px; max-width:220px;">
                @foreach($project->getTechStackArray() as $tech)
                    <span class="tech-tag">{{ $tech }}</span>
                @endforeach
            </div>
        </td>
        <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $project->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.projects.toggleStatus', $project->id) }}"
               class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $project->is_active ? 'active-badge' : 'inactive-badge' }}"
               data-title="{{ $project->title }}">
                {{ $project->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.projects.edit', $project->id) }}"
                   class="btn btn-sm btn-outline-primary rounded-3 px-2">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button"
                        class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                        data-id="{{ $project->id }}"
                        data-title="{{ $project->title }}">
                    <i class="bi bi-trash"></i>
                </button>
                <form id="delete-form-{{ $project->id }}"
                      action="{{ route('admin.projects.destroy', $project->id) }}"
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
                <div class="fw-semibold mb-2">No Projects Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </td>
    </tr>
@endforelse
