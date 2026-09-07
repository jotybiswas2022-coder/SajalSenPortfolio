@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .casestudies-page h4 { font-size: 0.9rem; }
    .casestudies-page p.text-muted { font-size: 0.75rem; }
    .casestudies-page .badge { font-size: 0.65rem; padding: 0.2rem 0.5rem !important; }
    .casestudies-page .btn { font-size: 0.72rem; padding: 0.25rem 0.6rem; }
    .casestudies-page .form-control { font-size: 0.78rem; padding: 0.35rem 0.5rem; }
    .casestudies-page .input-group-text { font-size: 0.78rem; padding: 0.35rem 0.5rem; }
    .casestudies-page .small.text-muted { font-size: 0.7rem; }
    .casestudies-page .table thead th { font-size: 0.65rem !important; padding: 0.35rem 0.4rem !important; }
    .casestudies-page .table tbody td { font-size: 0.72rem; padding: 0.35rem 0.4rem; }
    .casestudies-page .table tbody td .btn { font-size: 0.65rem; padding: 0.15rem 0.4rem; }
    .casestudies-page .card-header { padding: 0.6rem 0.8rem !important; }
    .casestudies-page .card-body { padding: 0.6rem !important; }
}
</style>

<div class="container-fluid py-3 casestudies-page">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-journal-code me-2" style="color:#00d9ff;"></i>Case Studies</h4>
            <p class="text-muted small mb-0">Manage IT project case studies (Problem → Solution → Result)</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill px-3 py-2" style="background:rgba(0,217,255,0.1); color:#00d9ff; font-weight:500;">
                <i class="bi bi-database me-1"></i> {{ $caseStudies->count() }} Total
            </span>
            <a href="{{ route('admin.casestudies.create') }}" class="btn btn-primary rounded-3 px-3" style="background:#00d9ff; border-color:#00d9ff;">
                <i class="bi bi-plus-lg me-1"></i> Add New
            </a>
        </div>
    </div>

    {{-- Live Search Bar --}}
    <div class="mb-4">
        <div class="d-flex gap-2 align-items-center">
            <div class="input-group" style="max-width:600px;">
                <span class="input-group-text bg-white border-end-0 rounded-start-3" style="border-color:#e2e8f0;">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" id="liveSearch" name="q" value="{{ $query ?? '' }}" 
                       class="form-control border-start-0 ps-0" 
                       placeholder="Live search by title, client or category..."
                       style="border-color:#e2e8f0; box-shadow:none;"
                       autocomplete="off">
                <span class="input-group-text bg-white border-start-0 rounded-end-3" style="border-color:#e2e8f0;" id="searchSpinner">
                    <span class="spinner-border spinner-border-sm d-none" role="status" id="searchLoading"></span>
                </span>
            </div>
            @if(request()->has('q') && request()->q != '')
                <a href="{{ route('admin.casestudies.index') }}" class="btn btn-outline-secondary rounded-3" style="border-color:#e2e8f0;">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </div>
        <div class="mt-2" id="searchInfo">
            @if($query ?? false)
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Showing results for "<strong>{{ $query }}</strong>" — 
                    <span id="resultCount">{{ $caseStudies->count() }}</span> case study(ies) found
                </small>
            @endif
        </div>
    </div>

    {{-- Table Card --}}
    @if($caseStudies->isEmpty() && !request()->ajax())
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-journal-code"></i>
                <div class="fw-semibold mb-2">No Case Studies Found</div>
                <p class="text-muted small">Start by adding your first IT case study!</p>
                <a href="{{ route('admin.casestudies.create') }}" class="btn btn-primary rounded-3 px-4" style="background:#00d9ff; border-color:#00d9ff;">
                    <i class="bi bi-plus-lg me-1"></i> Add Case Study
                </a>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width:800px;">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-semibold" style="width:45px;">#</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:55px;">Image</th>
                            <th class="py-3 text-muted small fw-semibold">Title</th>
                            <th class="py-3 text-muted small fw-semibold">Client</th>
                            <th class="py-3 text-muted small fw-semibold">Category</th>
                            <th class="py-3 text-muted small fw-semibold">Technologies</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:60px;">Order</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:90px;">Status</th>
                            <th class="pe-4 py-3 text-muted small fw-semibold" style="width:100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="caseStudiesTableBody">
                        @include('backend.casestudy._table_rows', ['caseStudies' => $caseStudies])
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

<style>
.status-badge { transition: all 0.2s; }
.status-badge:hover { transform: scale(1.05); }
.active-badge { background: rgba(16,185,129,0.12); color: #059669; }
.inactive-badge { background: #f1f5f9; color: #94a3b8; }
</style>

@section('scripts')
<script>
(function() {
    function bindCaseStudyEvents() {
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const title = this.dataset.title;
                Swal.fire({
                    title: 'Delete Case Study?',
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
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    }

    bindCaseStudyEvents();
    window.bindCaseStudyEvents = bindCaseStudyEvents;
})();

(function() {
    var searchInput = document.getElementById('liveSearch');
    var tableBody = document.getElementById('caseStudiesTableBody');
    var searchInfo = document.getElementById('searchInfo');
    var searchLoading = document.getElementById('searchLoading');

    if (!searchInput || !tableBody) return;

    var debounceTimer;

    function performSearch(query) {
        if (searchLoading) searchLoading.classList.remove('d-none');

        var url = '{{ route('admin.casestudies.index') }}' + '?q=' + encodeURIComponent(query);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            tableBody.innerHTML = data.html;

            var countBadge = document.querySelector('.badge.rounded-pill.px-3.py-2');
            if (countBadge) {
                countBadge.innerHTML = '<i class="bi bi-database me-1"></i> ' + data.count + ' Total';
            }

            if (searchInfo) {
                if (query) {
                    searchInfo.innerHTML = '<small class="text-muted"><i class="bi bi-info-circle me-1"></i>Showing results for "<strong>' + escapeHtml(query) + '</strong>" — ' + data.count + ' case study(ies) found</small>';
                } else {
                    searchInfo.innerHTML = '';
                }
            }

            if (window.bindCaseStudyEvents) window.bindCaseStudyEvents();
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
