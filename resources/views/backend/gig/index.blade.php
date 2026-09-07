@extends('backend.app')

@section('content')
<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="ae-page-header mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="bi bi-music-note-list" style="font-size:1.5rem;color:#00d9ff;"></i>
            </div>
            <div class="d-flex flex-column align-items-start gap-1">
                <div class="ae-title">Gigs</div>
                <p class="ae-sub">Manage your service packages.</p>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="ae-badge" id="countBadge"><span class="ae-dot"></span> {{ $gigs->count() }} Gigs</span>
            <a href="{{ route('admin.gigs.create') }}" class="ae-btn ae-btn-primary">
                <i class="bi bi-plus-lg"></i> Add Gig
            </a>
        </div>
    </div>

    {{-- Search --}}
    <div class="mb-4">
        <div class="d-flex gap-2 align-items-center">
            <div class="input-group" style="max-width:500px;">
                <span class="input-group-text ae-search-icon"><i class="bi bi-search"></i></span>
                <input type="text" id="liveSearch" name="q" value="{{ $query ?? '' }}"
                       class="form-control ae-search border-start-0 ps-0"
                       placeholder="Search gigs by title..."
                       autocomplete="off">
                <span class="input-group-text ae-search-icon-end" id="searchSpinner">
                    <span class="spinner-border spinner-border-sm d-none" role="status" id="searchLoading"></span>
                </span>
            </div>
            @if(request()->has('q') && request()->q != '')
                <a href="{{ route('admin.gigs.index') }}" class="ae-btn ae-btn-ghost" style="padding:0.5rem 0.7rem;">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </div>
        <div class="mt-2" id="searchInfo">
            @if($query ?? false)
                <small class="ae-note">
                    <i class="bi bi-info-circle me-1"></i>
                    Showing results for "<strong>{{ $query }}</strong>" —
                    <span id="resultCount">{{ $gigs->count() }}</span> gig(s) found
                </small>
            @endif
        </div>
    </div>

    {{-- Gigs Grid --}}
    @if($gigs->isEmpty() && !request()->ajax())
        <div class="ae-table-card">
            <div class="text-center py-5">
                <i class="bi bi-music-note-list" style="font-size:3rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
                <p class="ae-note mb-2">No gigs found.</p>
                <a href="{{ route('admin.gigs.create') }}" class="ae-btn ae-btn-primary">
                    <i class="bi bi-plus-lg"></i> Add Gig
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
        background: var(--admin-bg-soft);
        border: 1.5px solid var(--admin-border);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        position: relative;
    }
    .gig-card:hover {
        border-color: rgba(0,217,255,0.4);
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
        border: 1.5px solid var(--admin-border);
    }
    .gig-thumb-placeholder {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(0,217,255,0.3), rgba(0,255,136,0.2));
        border: 1px solid rgba(0,217,255,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #00d9ff;
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
        color: var(--admin-text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .gig-card-info .gig-id {
        font-size: 0.75rem;
        color: var(--admin-text-muted);
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
        border: 1px solid var(--admin-border);
        background: rgba(0,0,0,0.2);
        transition: all 0.2s;
        cursor: default;
    }
    .pricing-chip:hover {
        border-color: rgba(0,217,255,0.35);
        background: rgba(0,217,255,0.05);
    }
    .pricing-chip .chip-name {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        color: var(--admin-text-muted);
        margin-bottom: 0.15rem;
    }
    .pricing-chip .chip-price {
        font-size: 0.85rem;
        font-weight: 700;
        color: #00ff88;
    }
    .pricing-chip .chip-price.basic { color: #94a3b8; }
    .pricing-chip .chip-price.standard { color: #00d9ff; }
    .pricing-chip .chip-price.premium { color: #fbbf24; }

    .gig-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 1.25rem;
        border-top: 1px solid var(--admin-border);
        background: rgba(0,0,0,0.25);
    }
    .gig-card-footer .footer-left {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .gig-card-footer .order-badge {
        font-size: 0.75rem;
        color: var(--admin-text-muted);
        background: var(--admin-bg);
        border: 1px solid var(--admin-border);
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
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }
    .status-toggle.active {
        background: rgba(0,255,136,0.1);
        border: 1px solid rgba(0,255,136,0.25);
        color: #00ff88;
    }
    .status-toggle.active:hover {
        background: rgba(0,255,136,0.18);
    }
    .status-toggle.inactive {
        background: var(--admin-bg-soft);
        border: 1px solid var(--admin-border);
        color: var(--admin-text-muted);
    }
    .status-toggle.inactive:hover {
        background: rgba(0,217,255,0.05);
        border-color: rgba(0,217,255,0.3);
        color: #00d9ff;
    }

    @media (max-width: 420px) {
        .gigs-grid { grid-template-columns: 1fr; }
        .gig-card-top { flex-wrap: wrap; }
        .pricing-chips { flex-direction: column; }
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
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-4',
                        confirmButton: 'btn btn-danger rounded-3 px-4 py-2',
                        cancelButton: 'btn btn-light border rounded-3 px-4 py-2',
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) document.getElementById('delete-form-' + id).submit();
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
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-4',
                        confirmButton: 'btn btn-info rounded-3 px-4 py-2',
                        cancelButton: 'btn btn-light border rounded-3 px-4 py-2',
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) window.location.href = href;
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
                countBadge.innerHTML = '<span class="ae-dot"></span> ' + data.count + ' Gigs';
            }

            if (searchInfo) {
                if (query) {
                    searchInfo.innerHTML = '<small class="ae-note"><i class="bi bi-info-circle me-1"></i>Showing results for "<strong>' + escapeHtml(query) + '</strong>" — ' + data.count + ' gig(s) found</small>';
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