@forelse($services as $service)
    <tr>
        <td class="ps-4 fw-semibold" style="color:var(--admin-text-muted);">{{ $loop->iteration }}</td>
        <td>
            <div class="ae-icon-box">
                @if($service->icon)
                    <i class="bi {{ $service->icon }}"></i>
                @else
                    <span style="font-size:0.8rem;">—</span>
                @endif
            </div>
        </td>
        <td>
            <span class="fw-semibold" style="color:var(--admin-text);">{{ $service->title }}</span>
        </td>
        <td>
            <span style="color:var(--admin-text-muted);font-size:0.83rem;">{{ Str::limit($service->short_description, 60) ?: '—' }}</span>
        </td>
        <td><span class="ae-order-badge">{{ $service->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.services.toggleStatus', $service->id) }}"
               class="ae-status-badge text-decoration-none {{ $service->is_active ? '' : 'inactive' }}"
               data-title="{{ $service->title }}">
                <i class="bi {{ $service->is_active ? 'bi-lightning-charge-fill' : 'bi-pause-fill' }}" style="font-size:0.85rem;"></i>
                {{ $service->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td class="pe-4">
            <div class="d-flex gap-1">
                <a href="{{ route('admin.services.edit', $service->id) }}" class="ae-action-btn edit" title="Edit">
                    <i class="bi bi-pencil" style="font-size:0.82rem;"></i>
                </a>
                <button type="button" class="ae-action-btn delete delete-btn" data-id="{{ $service->id }}" data-title="{{ $service->title }}" title="Delete">
                    <i class="bi bi-trash" style="font-size:0.82rem;"></i>
                </button>
                <form id="delete-form-{{ $service->id }}" action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center py-5">
            <i class="bi bi-search" style="font-size:2.2rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
            <p class="ae-note mb-2">No results found.</p>
        </td>
    </tr>
@endforelse
