@forelse($projects as $project)
    <tr>
        <td class="ps-4 fw-semibold">#{{ $loop->iteration }}</td>
        <td>
            @if($project->image)
                <img src="{{ config('app.storage_url') }}{{ $project->image }}"
                     alt="{{ $project->title }}"
                     class="rounded"
                     style="width:48px;height:36px;object-fit:cover;border:1.5px solid var(--admin-border);">
            @else
                <div class="rounded d-inline-flex align-items-center justify-content-center"
                     style="width:48px;height:36px;background:var(--admin-bg-soft);color:var(--admin-text-muted);border:1px dashed var(--admin-border);">
                    <i class="bi bi-image"></i>
                </div>
            @endif
        </td>
        <td class="fw-semibold">{{ $project->title }}</td>
        <td>
            @if($project->category)
                <span class="ae-status-badge"><span class="ae-dot"></span> {{ $project->category }}</span>
            @else
                <span class="text-muted small">—</span>
            @endif
        </td>
        <td>
            <div style="display:flex;flex-wrap:wrap;gap:3px;max-width:260px;">
                @foreach($project->getTechStackArray() as $tech)
                    <span class="tech-tag">{{ $tech }}</span>
                @endforeach
            </div>
        </td>
        <td><span class="ae-order-badge">{{ $project->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.projects.toggleStatus', $project->id) }}"
               class="ae-status-badge status-badge {{ $project->is_active ? '' : 'inactive' }}"
               data-title="{{ $project->title }}">
                <span class="ae-dot"></span> {{ $project->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.projects.edit', $project->id) }}" class="ae-action-btn edit" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button" class="ae-action-btn delete delete-btn"
                        data-id="{{ $project->id }}" data-title="{{ $project->title }}" title="Delete">
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
            <i class="bi bi-search" style="font-size:2rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
            <p class="ae-note mb-0">No projects found. Try adjusting your search.</p>
        </td>
    </tr>
@endforelse