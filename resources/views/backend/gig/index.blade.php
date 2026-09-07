@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .gigs-page h4 { font-size: 0.9rem; }
    .gigs-page p.text-muted { font-size: 0.75rem; }
    .gigs-page .badge { font-size: 0.65rem; padding: 0.2rem 0.5rem !important; }
    .gigs-page .btn { font-size: 0.72rem; padding: 0.25rem 0.6rem; }
    .gigs-page .form-control { font-size: 0.78rem; padding: 0.35rem 0.5rem; }
    .gigs-page .input-group-text { font-size: 0.78rem; padding: 0.35rem 0.5rem; }
    .gigs-page .small.text-muted { font-size: 0.7rem; }
    .gigs-page .gigs-grid { grid-template-columns: 1fr; gap: 0.8rem; }
    .gigs-page .gig-card { border-radius: 12px; }
    .gigs-page .gig-card-top { padding: 0.8rem 0.8rem 0.5rem; }
    .gigs-page .gig-card-top h6 { font-size: 0.82rem; }
    .gigs-page .gig-card-top .text-muted { font-size: 0.7rem; }
    .gigs-page .gig-card-top small { font-size: 0.65rem; }
    .gigs-page .gig-card-pricing { padding: 0.5rem 0.8rem 0.8rem; }
    .gigs-page .gig-card-pricing .badge { font-size: 0.6rem; padding: 0.15rem 0.4rem !important; }
    .gigs-page .gig-card-actions { padding: 0.5rem 0.8rem; }
    .gigs-page .gig-card-actions .btn { font-size: 0.65rem; padding: 0.2rem 0.5rem; }
    .gigs-page .gig-card .fs-5 { font-size: 0.9rem !important; }
}
</style>

<div class="container-fluid py-3 gigs-page">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color:var(--text-primary, #111827);">
                <i class="bi bi-music-note-list me-2" style="color:#00d9ff;"></i>Gigs
            </h4>
            <p class="text-muted small mb-0">Manage your service packages</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill px-3 py-2" id="countBadge"
                  style="background:rgba(0,217,255,0.1); color:#00d9ff; font-weight:500; font-size:0.8rem;">
                <i class="bi bi-database me-1"></i> {{ $gigs->count() }} Gigs
            </span>
            <a href="{{ route('admin.gigs.create') }}" class="btn btn-primary rounded-3 px-3" style="background:#00d9ff; border-color:#00d9ff;">
                <i class="bi bi-plus-lg me-1"></i> Add Gig
            </a>
        </div>
    </div>

    {{-- Search --}}
    <div class="mb-4">
        <div class="d-flex gap-2 align-items-center">
            <div class="input-group" style="max-width:500px;">
                <span class="input-group-text bg-white border-end-0 rounded-start-pill" style="border-color:#e2e8f0;">
                    <i class="bi bi-search text-muted" style="font-size:0.9rem;"></i>
                </span>
                <input type="text" id="liveSearch" name="q" value="{{ $query ?? '' }}"
                       class="form-control border-start-0 border-end-0"
                       placeholder="Search gigs by title..."
                       style="border-color:#e2e8f0; box-shadow:none; font-size:0.9rem;"
                       autocomplete="off">
                <span class="input-group-text bg-white border-start-0 rounded-end-pill" style="border-color:#e2e8f0;" id="searchSpinner">
                    <span class="spinner-border spinner-border-sm d-none" role="status" id="searchLoading"></span>
                </span>
            </div>
            @if(request()->has('q') && request()->q != '')
                <a href="{{ route('admin.gigs.index') }}" class="btn btn-outline-secondary rounded-pill" style="border-color:#e2e8f0;">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </div>
        <div class="mt-2" id="searchInfo">
            @if($query ?? false)
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Showing results for "<strong>{{ $query }}</strong>" —
                    <span id="resultCount">{{ $gigs->count() }}</span> gig(s) found
                </small>
            @endif
        </div>
    </div>

    {{-- Gigs Grid --}}
    @if($gigs->isEmpty() && !request()->ajax())
        <div class="text-center py-5">
            <div class="empty-state" style="padding:4rem 2rem;">
                <div style="width:80px;height:80px;border-radius:20px;background:rgba(0,217,255,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;">
                    <i class="bi bi-music-note-list" style="font-size:2.2rem;color:#00d9ff;"></i>
                </div>
                <div class="fw-semibold fs-5 mb-2" style="color:var(--text-primary, #111827);">No Gigs Found</div>
                <p class="text-muted mb-3" style="max-width:400px;margin:0 auto 1.5rem;">Add your service packages to showcase what you offer!</p>
                <a href="{{ route('admin.gigs.create') }}" class="btn btn-primary rounded-pill px-4" style="background:#00d9ff; border-color:#00d9ff;">
                    <i class="bi bi-plus-lg me-1"></i> Add Gig
                </a>
            </div>
        </div>
    @else
        <div class="gigs-grid" id="gigsGrid">
            @include('backend.gig._table_rows', ['gigs' => $gigs])
        </div>
    @endif

</div>

<style>
    .gigs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 1.25rem;
    }

    .gig-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        position: relative;
    }
    .gig-card:hover {
        border-color: #d0d9eb;
        box-shadow: 0 8px 30px rgba(0,217,255,0.1);
        transform: translateY(-3px);
    }

    .gig-card-top {
        display: flex;
        gap: 1rem;
        padding: 1.25rem 1.25rem 0.75rem;
        align-items: flex-start;
    }

    .gig-thumb {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        object-fit: cover;
        flex-shrink: 0;
        background: #f1f5f9;
    }
    .gig-thumb-placeholder {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .gig-card-info {
        flex: 1;
        min-width: 0;
    }
    .gig-card-info h5 {
        font-size: 1rem;
        font-weight: 700;
        margin: 0 0 0.25rem;
        color: #111827;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .gig-card-info .gig-id {
        font-size: 0.75rem;
        color: #94a3b8;
    }

    .gig-card-actions {
        display: flex;
        gap: 0.35rem;
        flex-shrink: 0;
    }
    .gig-card-actions .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        color: #64748b;
        transition: all 0.2s;
        cursor: pointer;
        padding: 0;
    }
    .gig-card-actions .btn-icon:hover {
        border-color: #00d9ff;
        color: #00d9ff;
        background: rgba(0,217,255,0.04);
    }
    .gig-card-actions .btn-icon.danger:hover {
        border-color: #ef4444;
        color: #ef4444;
        background: rgba(239,68,68,0.04);
    }

    .gig-card-body {
        padding: 0 1.25rem 1rem;
    }

    .pricing-chips {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .pricing-chip {
        flex: 1;
        min-width: 0;
        padding: 0.6rem 0.7rem;
        border-radius: 10px;
        text-align: center;
        border: 1px solid #e8edf5;
        background: #fafbff;
        transition: all 0.2s;
        cursor: default;
    }
    .pricing-chip:hover {
        border-color: #d0d9eb;
        background: #f1f4ff;
    }
    .pricing-chip .chip-name {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        color: #94a3b8;
        margin-bottom: 0.15rem;
    }
    .pricing-chip .chip-price {
        font-size: 0.85rem;
        font-weight: 700;
        color: #059669;
    }
    .pricing-chip .chip-price.basic { color: #64748b; }
    .pricing-chip .chip-price.standard { color: #00d9ff; }
    .pricing-chip .chip-price.premium { color: #d97706; }

    .gig-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 1.25rem;
        border-top: 1px solid #f1f5f9;
        background: #fafbff;
    }
    .gig-card-footer .footer-left {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .gig-card-footer .order-badge {
        font-size: 0.75rem;
        color: #64748b;
        background: #f1f5f9;
        padding: 0.15rem 0.6rem;
        border-radius: 6px;
        font-weight: 500;
    }
    .gig-card-footer .order-badge i { margin-right: 0.25rem; }

    .status-toggle {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.8rem;
        border-radius: 20px;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }
    .status-toggle.active {
        background: rgba(16,185,129,0.12);
        color: #059669;
    }
    .status-toggle.active:hover {
        background: rgba(16,185,129,0.2);
    }
    .status-toggle.inactive {
        background: #f1f5f9;
        color: #94a3b8;
    }
    .status-toggle.inactive:hover {
        background: #e2e8f0;
    }

    @media (max-width: 420px) {
        .gigs-grid { grid-template-columns: 1fr; }
        .pricing-chips { flex-direction: column; }
    }

    .empty-state {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 20px;
        padding: 3rem 2rem;
        text-align: center;
    }
</style>

@section('scripts')
<script>
(function() {
    function bindGigEvents() {
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const title = this.dataset.title;
                Swal.fire({
                    title: 'Delete Gig?',
                    text: 'Are you sure you want to delete "' + title + '"?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: '<i class="bi bi-trash me-1"></i> Delete',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });

        document.querySelectorAll('.status-toggle').forEach(badge => {
            badge.addEventListener('click', function (e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                const title = this.dataset.title;
                const current = this.textContent.trim();
                Swal.fire({
                    title: 'Toggle Status?',
                    text: 'Change "' + title + '" from ' + current + ' to ' + (current === 'Active' ? 'Inactive' : 'Active') + '?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#00d9ff',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: '<i class="bi bi-arrow-repeat me-1"></i> Toggle',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    }

    bindGigEvents();
    window.bindGigEvents = bindGigEvents;
})();

(function() {
    var searchInput = document.getElementById('liveSearch');
    var grid = document.getElementById('gigsGrid');
    var searchInfo = document.getElementById('searchInfo');
    var searchLoading = document.getElementById('searchLoading');
    var countBadge = document.getElementById('countBadge');

    if (!searchInput || !grid) return;

    var debounceTimer;

    function performSearch(query) {
        if (searchLoading) searchLoading.classList.remove('d-none');

        var url = '{{ route('admin.gigs.index') }}' + '?q=' + encodeURIComponent(query);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            grid.innerHTML = data.html;

            if (countBadge) {
                countBadge.innerHTML = '<i class="bi bi-database me-1"></i> ' + data.count + ' Gigs';
            }

            if (searchInfo) {
                if (query) {
                    searchInfo.innerHTML = '<small class="text-muted"><i class="bi bi-info-circle me-1"></i>Showing results for "<strong>' + escapeHtml(query) + '</strong>" — ' + data.count + ' gig(s) found</small>';
                } else {
                    searchInfo.innerHTML = '';
                }
            }

            if (window.bindGigEvents) window.bindGigEvents();
        })
        .catch(function(error) {
            console.error('Search error:', error);
        })
        .finally(function() {
            if (searchLoading) searchLoading.classList.add('d-none');
        });
    }

    searchInput.addEventListener('input', function() {
        var query = this.value.trim();
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() {
            performSearch(query);
        }, 300);
    });

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }
})();
</script>
@endsection

@endsection
