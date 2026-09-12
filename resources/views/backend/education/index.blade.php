@extends('backend.app')

@section('content')
<style>
    .table thead th {
        font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.5px;
        font-weight: 600; color: var(--admin-text-muted); white-space: nowrap;
        border-bottom: 1px solid var(--admin-border); padding: 0.85rem 1rem; background: transparent;
    }
    .table tbody td { padding: 0.8rem 1rem; font-size: 0.82rem; color: var(--admin-text); }
    .c-qnum { display: none; }

    @media (max-width: 767.98px) {
        .contact-table-wrap.ae-table-card { background: transparent !important; border: none !important; box-shadow: none !important; border-radius: 0 !important; overflow: visible !important; padding: 0 !important; }
        .contact-table-wrap .table-responsive { overflow: visible !important; }
        .education-table { width: 100% !important; min-width: 0 !important; max-width: 100% !important; }
        .education-table thead { display: none; }
        .education-table tbody { display: block; width: 100%; }
        .education-table tr {
            display: block !important;
            width: 100% !important;
            background: var(--admin-card-bg);
            border: 1px solid var(--admin-border);
            border-radius: 14px;
            padding: 1.1rem 1rem;
            margin-bottom: 0.9rem;
        }
        .education-table td { display: block; width: 100%; padding: 0 !important; border: 0 !important; text-align: left !important; }
        .education-table td[colspan] { text-align: center !important; padding: 2.5rem 1rem !important; background: transparent !important; border: none !important; margin-bottom: 0 !important; }
        .education-table .c-num { display: none !important; }
        .education-table .c-qnum {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 26px; height: 26px; padding: 0 0.4rem;
            border-radius: 8px; background: rgba(0,217,255,0.1); color: #00d9ff;
            font-size: 0.72rem; font-weight: 700;
            flex-shrink: 0; align-self: flex-start;
        }
        .education-table .c-degree { font-size: 0.92rem; font-weight: 600; line-height: 1.35; word-break: break-word; }
        .education-table .c-degree .c-degree-text {
            white-space: normal !important; overflow: visible !important;
            max-width: 100% !important;
        }
        .education-table .c-institution { margin-top: 0.3rem; font-size: 0.8rem; word-break: break-word; }
        .education-table .c-duration { display: block; margin-top: 0.75rem; font-size: 0.72rem !important; }
        .education-table .c-duration .ae-order-badge { font-size: 0.72rem !important; }
        .education-table .c-result { display: block; margin-top: 0.45rem; }
        .education-table .c-result .text-muted { font-size: 0.75rem; }
        .education-table .c-order { display: none !important; }
        .education-table .c-status { display: inline-block; margin-top: 0.7rem; font-size: 0.7rem; margin-left: 0; }
        .education-table .c-status .ae-status-badge { font-size: 0.7rem; padding: 0.25rem 0.6rem; }
        .education-table .c-actions { margin-top: 0.85rem !important; padding-top: 0.8rem !important; border-top: 1px solid var(--admin-border) !important; }
        .education-table .c-actions .d-flex { width: 100%; gap: 0.6rem; }
        .education-table .c-actions .ae-action-btn { flex: 1 1 0; width: auto; height: 2.6rem; font-size: 0.9rem; border-radius: 10px; }
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
<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="ae-page-header mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-3 msg-hd-left">
            <a href="{{ route('admin.dashboard.index') }}" class="ae-btn ae-btn-ghost" style="padding:0.5rem 0.75rem;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;" class="header-ico">
                <i class="bi bi-mortarboard" style="font-size:1.5rem;color:#00d9ff;"></i>
            </div>
            <div class="d-flex flex-column align-items-start gap-1">
                <div class="ae-title">Education</div>
                <p class="ae-sub">Manage your educational qualifications.</p>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="ae-badge"><span class="ae-dot"></span> {{ $educations->count() }} Qualifications</span>
            <a href="{{ route('admin.education.create') }}" class="ae-btn ae-btn-primary">
                <i class="bi bi-plus-lg"></i> Add Qualification
            </a>
        </div>
    </div>

    {{-- Live Search --}}
    <div class="mb-3">
        <div class="d-flex gap-2 align-items-center search-bar">
            <div class="input-group" style="max-width:500px;">
                <span class="input-group-text ae-search-icon"><i class="bi bi-search"></i></span>
                <input type="text" id="liveSearch" name="q" value="{{ $query ?? '' }}"
                       class="form-control ae-search border-start-0 ps-0"
                       placeholder="Search by degree or institution..."
                       autocomplete="off">
                <span class="input-group-text ae-search-icon-end" id="searchSpinner">
                    <span class="spinner-border spinner-border-sm d-none" role="status" id="searchLoading"></span>
                </span>
            </div>
            @if(request()->has('q') && request()->q != '')
                <a href="{{ route('admin.education.index') }}" class="ae-btn ae-btn-ghost" style="padding:0.5rem 0.7rem;">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </div>
        <div class="mt-2" id="searchInfo">
            @if($query ?? false)
                <small class="ae-note">
                    <i class="bi bi-info-circle me-1"></i>
                    Showing results for "<strong>{{ $query }}</strong>" —
                    <span id="resultCount">{{ $educations->count() }}</span> qualification(s) found
                </small>
            @endif
        </div>
    </div>

    {{-- Table --}}
    @if($educations->isEmpty() && !request()->ajax())
        <div class="ae-table-card">
            <div class="text-center py-5">
                <i class="bi bi-mortarboard" style="font-size:3rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
                <p class="ae-note mb-2">No qualifications found.</p>
                <a href="{{ route('admin.education.create') }}" class="ae-btn ae-btn-primary">
                    <i class="bi bi-plus-lg"></i> Add Qualification
                </a>
            </div>
        </div>
    @else
        <div class="ae-table-card contact-table-wrap">
            <div class="table-responsive">
                <table class="table table-hover align-middle education-table" style="min-width:880px;">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width:50px;">#</th>
                            <th>Degree</th>
                            <th>Institution</th>
                            <th style="width:110px;">Duration</th>
                            <th style="width:120px;">Result</th>
                            <th style="width:70px;">Order</th>
                            <th style="width:90px;">Status</th>
                            <th class="pe-4" style="width:110px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="educationTableBody">
                        @include('backend.education._table_rows', ['educations' => $educations])
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

@section('scripts')
<script>
@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: {!! json_encode(session('success')) !!},
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});
@endif

(function() {
    function bindEducationEvents() {
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const title = this.dataset.title;
                Swal.fire({
                    title: 'Delete Qualification?',
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

    bindEducationEvents();
    window.bindEducationEvents = bindEducationEvents;
})();

(function() {
    var searchInput = document.getElementById('liveSearch');
    var tableBody = document.getElementById('educationTableBody');
    var searchInfo = document.getElementById('searchInfo');
    var searchLoading = document.getElementById('searchLoading');

    if (!searchInput || !tableBody) return;

    var debounceTimer;

    function performSearch(query) {
        if (searchLoading) searchLoading.classList.remove('d-none');

        var url = '{{ route('admin.education.index') }}' + '?q=' + encodeURIComponent(query);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            tableBody.innerHTML = data.html;

            var countBadge = document.querySelector('.ae-badge .ae-dot')?.closest('.ae-badge');
            if (countBadge) {
                countBadge.innerHTML = '<span class="ae-dot"></span> ' + data.count + ' Qualifications';
            }

            if (searchInfo) {
                if (query) {
                    searchInfo.innerHTML = '<small class="ae-note"><i class="bi bi-info-circle me-1"></i>Showing results for "<strong>' + escapeHtml(query) + '</strong>" — ' + data.count + ' qualification(s) found</small>';
                } else {
                    searchInfo.innerHTML = '';
                }
            }

            if (window.bindEducationEvents) window.bindEducationEvents();
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