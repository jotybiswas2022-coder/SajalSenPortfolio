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
            <div class="gig-card-actions">
                <a href="{{ route('admin.gigs.edit', $gig->id) }}" class="btn-icon" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button" class="btn-icon danger delete-btn"
                        data-id="{{ $gig->id }}"
                        data-title="{{ $gig->title }}" title="Delete">
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
            <div class="footer-left">
                <span class="order-badge"><i class="bi bi-sort-numeric-up"></i> Order {{ $gig->sort_order }}</span>
            </div>
            <a href="{{ route('admin.gigs.toggleStatus', $gig->id) }}"
               class="status-toggle {{ $gig->is_active ? 'active' : 'inactive' }}"
               data-title="{{ $gig->title }}">
                <i class="bi bi-{{ $gig->is_active ? 'check-circle-fill' : 'circle' }} me-1"></i>
                {{ $gig->is_active ? 'Active' : 'Inactive' }}
            </a>
        </div>
    </div>
@empty
    <div class="text-center py-5" style="grid-column:1/-1;">
        <div class="empty-state">
            <div style="width:72px;height:72px;border-radius:18px;background:rgba(0,217,255,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 1.2rem;">
                <i class="bi bi-search" style="font-size:2rem;color:#00d9ff;"></i>
            </div>
            <div class="fw-semibold fs-5 mb-2" style="color:#111827;">No Gigs Found</div>
            <p class="text-muted mb-0" style="font-size:0.9rem;">Try adjusting your search terms.</p>
        </div>
    </div>
@endforelse
