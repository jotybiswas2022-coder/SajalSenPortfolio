@forelse($gigs as $gig)
    <div class="gig-card">
        <div class="gig-card-top">
            @if($gig->image)
                <img src="{{ config('app.storage_url') }}{{ $gig->image }}" alt="{{ $gig->title }}" class="gig-thumb">
            @else
                <div class="gig-thumb-placeholder">
                    <i class="bi bi-image"></i>
                </div>
            @endif
            <div class="gig-card-info">
                <h5>{{ $gig->title }}</h5>
                <span class="gig-id">#{{ $loop->iteration }}</span>
            </div>
            <div class="d-flex gap-1">
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
        </div>

        <div class="gig-card-body">
            <div class="pricing-chips">
                <div class="pricing-chip">
                    <div class="chip-name">{{ $gig->basic_name ?: 'Basic' }}</div>
                    <div class="chip-price basic">{{ $gig->basic_price }} USD</div>
                </div>
                <div class="pricing-chip">
                    <div class="chip-name">{{ $gig->standard_name ?: 'Standard' }}</div>
                    <div class="chip-price standard">{{ $gig->standard_price }} USD</div>
                </div>
                <div class="pricing-chip">
                    <div class="chip-name">{{ $gig->premium_name ?: 'Premium' }}</div>
                    <div class="chip-price premium">{{ $gig->premium_price }} USD</div>
                </div>
            </div>
        </div>

        <div class="gig-card-footer">
            <span class="order-badge"><i class="bi bi-sort-numeric-up"></i> Order {{ $gig->sort_order }}</span>
            <a href="{{ route('admin.gigs.toggleStatus', $gig->id) }}"
               class="status-toggle {{ $gig->is_active ? 'active' : 'inactive' }}"
               data-title="{{ $gig->title }}">
                <i class="bi bi-{{ $gig->is_active ? 'check-circle-fill' : 'circle' }}"></i>
                {{ $gig->is_active ? 'Active' : 'Inactive' }}
            </a>
        </div>
    </div>
@empty
    <div class="ae-table-card" style="grid-column:1/-1;">
        <div class="text-center py-5">
            <i class="bi bi-search" style="font-size:2rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
            <p class="ae-note mb-0">No gigs found. Try adjusting your search.</p>
        </div>
    </div>
@endforelse