@extends('backend.app')

@section('content')
<style>
    .table thead th {
        font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.5px;
        font-weight: 600; color: var(--admin-text-muted); white-space: nowrap;
        border-bottom: 1px solid var(--admin-border); padding: 0.85rem 1rem; background: transparent;
    }
    .table tbody td { padding: 0.8rem 1rem; font-size: 0.82rem; color: var(--admin-text); }

    .gig-thumb-sm { width: 40px; height: 40px; border-radius: 10px; object-fit: cover; flex-shrink: 0; border: 1px solid var(--admin-border); }
    .gig-thumb-ph {
        width: 40px; height: 40px; border-radius: 10px; flex-shrink: 0;
        background: var(--admin-bg-soft); border: 1px solid var(--admin-border);
        color: var(--admin-text-muted); font-size: 1.05rem;
        display: inline-flex; align-items: center; justify-content: center;
    }

    .pkg {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.18rem 0.55rem; border: 1px solid var(--admin-border);
        border-radius: 50px; background: var(--admin-bg-soft);
        font-size: 0.72rem; margin: 0.15rem 0.3rem 0.15rem 0; white-space: nowrap;
    }
    .pkg-name { color: var(--admin-text-muted); font-weight: 500; }
    .pkg-price { font-weight: 700; }
    .pkg-price.basic { color: #94a3b8; }
    .pkg-price.standard { color: #00d9ff; }
    .pkg-price.premium { color: #fbbf24; }

    @media (max-width: 767.98px) {
        .contact-table-wrap.ae-table-card { background: transparent !important; border: none !important; box-shadow: none !important; border-radius: 0 !important; overflow: visible !important; padding: 0 !important; }
        .contact-table-wrap .table-responsive { overflow: visible !important; }
        .gig-table { width: 100% !important; min-width: 0 !important; max-width: 100% !important; }
        .gig-table thead { display: none; }
        .gig-table tbody { display: block; width: 100%; }
        .gig-table tr {
            display: block !important;
            width: 100% !important;
            background: var(--admin-card-bg);
            border: 1px solid var(--admin-border);
            border-radius: 14px;
            padding: 1.1rem 1rem;
            margin-bottom: 0.9rem;
        }
        .gig-table td { display: block; width: 100%; padding: 0 !important; border: 0 !important; text-align: left !important; }
        .gig-table td[colspan] { text-align: center !important; padding: 2.5rem 1rem !important; background: transparent !important; border: none !important; margin-bottom: 0 !important; }
        .gig-table .c-num { display: none !important; }
        .gig-table .c-gig { display: flex; align-items: center; gap: 0.75rem; }
        .gig-table .c-title {
            font-size: 0.9rem; font-weight: 600; line-height: 1.35;
            white-space: normal !important; overflow: visible !important;
            max-width: 100% !important; word-break: break-word;
        }
        .gig-table .c-packages { margin-top: 0.7rem; }
        .gig-table .pkg-list { display: flex; flex-direction: column; gap: 0.35rem; }
        .gig-table .pkg { display: flex; width: 100%; margin: 0; justify-content: space-between; }
        .gig-table .c-order { display: none !important; }
        .gig-table .c-status { display: inline-block; margin-top: 0.7rem; font-size: 0.7rem; margin-left: 0; }
        .gig-table .c-status .ae-status-badge { font-size: 0.7rem; padding: 0.25rem 0.6rem; }
        .gig-table .c-actions { margin-top: 0.85rem !important; padding-top: 0.8rem !important; border-top: 1px solid var(--admin-border) !important; }
        .gig-table .c-actions .d-flex { width: 100%; gap: 0.6rem; }
        .gig-table .c-actions .ae-action-btn { flex: 1 1 0; width: auto; height: 2.6rem; font-size: 0.9rem; border-radius: 10px; }
    }

    @media (max-width: 575.98px) {
        .msg-hd-left { gap: 0.75rem !important; flex-wrap: nowrap !important; }
        .ae-page-header .header-ico { width: 40px !important; height: 40px !important; border-radius: 11px !important; }
        .ae-page-header .header-ico i { font-size: 1.05rem !important; }
        .ae-page-header .ae-title { font-size: 0.95rem; }
        .ae-page-header .ae-sub { font-size: 0.68rem; }
        .ae-page-header .ae-badge { font-size: 0.68rem; padding: 0.25rem 0.7rem; }
        .search-bar .input-group-text { font-size: 0.85rem; }
        .search-bar #liveSearch { font-size: 0.85rem; }
    }
</style>
<div class="container-fluid pb-3">

    {{-- Header --}}
    <div class="ae-page-header mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-3 msg-hd-left">
            <a href="{{ route('admin.dashboard.index') }}" class="ae-btn ae-btn-ghost" style="padding:0.5rem 0.75rem;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;" class="header-ico">
                <i class="bi bi-music-note-list" style="font-size:1.5rem;color:#00d9ff;"></i>
            </div>
            <div class="d-flex flex-column align-items-start gap-1">
                <div class="ae-title">Gigs</div>
                <p class="ae-sub">Manage your service packages.</p>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 ae-header-actions">
            <span class="ae-badge" id="countBadge"><span class="ae-dot"></span> {{ $gigs->count() }} Gigs</span>
            <a href="{{ route('admin.gigs.create') }}" class="ae-btn ae-btn-primary">
                <i class="bi bi-plus-lg"></i> Add Gig
            </a>
        </div>
    </div>

    {{-- Search --}}
    <div class="mb-3">
        <div class="d-flex gap-2 align-items-center search-bar">
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

    {{-- Table --}}
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
        <div class="ae-table-card contact-table-wrap">
            <div class="table-responsive">
                <table class="table table-hover align-middle gig-table" style="min-width:980px;">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width:50px;">#</th>
                            <th style="width:300px;">Gig</th>
                            <th style="width:280px;">Packages</th>
                            <th style="width:80px;">Order</th>
                            <th style="width:100px;">Status</th>
                            <th class="pe-4" style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="gigsGrid">
                        @include('backend.gig._table_rows', ['gigs' => $gigs])
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

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

        document.querySelectorAll('.status-badge').forEach(badge => {
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