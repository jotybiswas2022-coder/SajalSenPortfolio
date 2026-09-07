@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .education-page h4 { font-size: 0.9rem; }
    .education-page p.text-muted { font-size: 0.75rem; }
    .education-page .badge { font-size: 0.65rem; padding: 0.2rem 0.5rem !important; }
    .education-page .btn { font-size: 0.72rem; padding: 0.25rem 0.6rem; }
    .education-page .form-control { font-size: 0.78rem; padding: 0.35rem 0.5rem; }
    .education-page .input-group-text { font-size: 0.78rem; padding: 0.35rem 0.5rem; }
    .education-page .small.text-muted { font-size: 0.7rem; }
    .education-page .table thead th { font-size: 0.65rem !important; padding: 0.35rem 0.4rem !important; }
    .education-page .table tbody td { font-size: 0.72rem; padding: 0.35rem 0.4rem; }
    .education-page .table tbody td .btn { font-size: 0.65rem; padding: 0.15rem 0.4rem; }
    .education-page .card-header { padding: 0.6rem 0.8rem !important; }
    .education-page .card-body { padding: 0.6rem !important; }
}
</style>

<div class="container-fluid py-3 education-page">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1"><i class="bi bi-mortarboard me-2" style="color:#00d9ff;"></i>Education</h4>
            <p class="text-muted small mb-0">Manage your educational qualifications</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill px-3 py-2" style="background:rgba(0,217,255,0.1); color:#00d9ff; font-weight:500;">
                <i class="bi bi-database me-1"></i> {{ $educations->count() }} Qualifications
            </span>
            <a href="{{ route('admin.education.create') }}" class="btn btn-primary rounded-3 px-3" style="background:#00d9ff; border-color:#00d9ff;">
                <i class="bi bi-plus-lg me-1"></i> Add Qualification
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
                       placeholder="Live search by degree or institution..."
                       style="border-color:#e2e8f0; box-shadow:none;"
                       autocomplete="off">
                <span class="input-group-text bg-white border-start-0 rounded-end-3" style="border-color:#e2e8f0;" id="searchSpinner">
                    <span class="spinner-border spinner-border-sm d-none" role="status" id="searchLoading"></span>
                </span>
            </div>
            @if(request()->has('q') && request()->q != '')
                <a href="{{ route('admin.education.index') }}" class="btn btn-outline-secondary rounded-3" style="border-color:#e2e8f0;">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </div>
        <div class="mt-2" id="searchInfo">
            @if($query ?? false)
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Showing results for "<strong>{{ $query }}</strong>" — 
                    <span id="resultCount">{{ $educations->count() }}</span> qualification(s) found
                </small>
            @endif
        </div>
    </div>

    {{-- Table Card --}}
    @if($educations->isEmpty() && !request()->ajax())
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-mortarboard"></i>
                <div class="fw-semibold mb-2">No Qualifications Found</div>
                <p class="text-muted small">Add your educational qualifications to showcase your academic background!</p>
                <a href="{{ route('admin.education.create') }}" class="btn btn-primary rounded-3 px-4" style="background:#00d9ff; border-color:#00d9ff;">
                    <i class="bi bi-plus-lg me-1"></i> Add Qualification
                </a>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width:750px;">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-semibold" style="width:50px;">#</th>
                            <th class="py-3 text-muted small fw-semibold">Degree</th>
                            <th class="py-3 text-muted small fw-semibold">Institution</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:100px;">Duration</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:120px;">Result</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:65px;">Order</th>
                            <th class="py-3 text-muted small fw-semibold" style="width:90px;">Status</th>
                            <th class="pe-4 py-3 text-muted small fw-semibold" style="width:120px;">Actions</th>
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

<style>
.status-badge { transition: all 0.2s; }
.status-badge:hover { transform: scale(1.05); }
.active-badge { background: rgba(16,185,129,0.12); color: #059669; }
.inactive-badge { background: #f1f5f9; color: #94a3b8; }
</style>

@section('scripts')
<script>
// ===== SUCCESS TOAST =====
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

// ===== DELETE CONFIRMATION & STATUS TOGGLE =====
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

    bindEducationEvents();
    window.bindEducationEvents = bindEducationEvents;
})();

// ===== LIVE SEARCH (AJAX) =====
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

            var countBadge = document.querySelector('.badge.rounded-pill.px-3.py-2');
            if (countBadge) {
                countBadge.innerHTML = '<i class="bi bi-database me-1"></i> ' + data.count + ' Qualifications';
            }

            if (searchInfo) {
                if (query) {
                    searchInfo.innerHTML = '<small class="text-muted"><i class="bi bi-info-circle me-1"></i>Showing results for "<strong>' + escapeHtml(query) + '</strong>" — ' + data.count + ' qualification(s) found</small>';
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
