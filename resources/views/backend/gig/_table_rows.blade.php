@forelse($gigs as $gig)
    <tr>
        <td class="ps-4 fw-semibold c-num">#{{ $loop->iteration }}</td>
        <td class="c-gig">
            <div class="d-flex align-items-center gap-2">
                @if($gig->image)
                    <img src="{{ config('app.storage_url') }}{{ $gig->image }}" alt="{{ $gig->title }}" class="gig-thumb-sm">
                @else
                    <span class="gig-thumb-ph"><i class="bi bi-image"></i></span>
                @endif
                <div style="min-width:0;">
                    <div class="fw-semibold c-title" style="color:var(--admin-text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:220px;">{{ $gig->title }}</div>
                    <div style="font-size:0.72rem;color:var(--admin-text-muted);">#{{ $gig->id }}</div>
                </div>
            </div>
        </td>
        <td class="c-packages">
            <div class="pkg-list">
                <span class="pkg">
                    <span class="pkg-name">{{ $gig->basic_name ?: 'Basic' }}</span>
                    <span class="pkg-price basic">{{ $gig->basic_price }} USD</span>
                </span>
                <span class="pkg">
                    <span class="pkg-name">{{ $gig->standard_name ?: 'Standard' }}</span>
                    <span class="pkg-price standard">{{ $gig->standard_price }} USD</span>
                </span>
                <span class="pkg">
                    <span class="pkg-name">{{ $gig->premium_name ?: 'Premium' }}</span>
                    <span class="pkg-price premium">{{ $gig->premium_price }} USD</span>
                </span>
            </div>
        </td>
        <td class="c-order"><span class="ae-order-badge">{{ $gig->sort_order }}</span></td>
        <td class="c-status">
            <a href="{{ route('admin.gigs.toggleStatus', $gig->id) }}"
               class="ae-status-badge status-badge {{ $gig->is_active ? '' : 'inactive' }}"
               data-title="{{ $gig->title }}">
                <span class="ae-dot"></span> {{ $gig->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td class="pe-4 c-actions">
            <div class="d-flex gap-1 justify-content-end">
                <a href="{{ route('admin.gigs.edit', $gig->id) }}" class="ae-action-btn edit" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button" class="ae-action-btn delete delete-btn"
                        data-id="{{ $gig->id }}" data-title="{{ $gig->title }}" title="Delete">
                    <i class="bi bi-trash"></i>
                </button>
                <form id="delete-form-{{ $gig->id }}"
                      action="{{ route('admin.gigs.destroy', $gig->id) }}"
                      method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-5">
            <i class="bi bi-search" style="font-size:2rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
            <p class="ae-note mb-0">No gigs found. Try adjusting your search.</p>
        </td>
    </tr>
@endforelse