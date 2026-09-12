@extends('backend.app')

@section('content')
<style>
    @media (max-width: 767.98px) {
        .ae-page-header { padding: 12px 12px; gap: 0.6rem !important; }
        .ae-page-header .header-ico { width: 40px !important; height: 40px !important; border-radius: 11px !important; }
        .ae-page-header .header-ico i { font-size: 1.05rem !important; }
        .ae-page-header .ae-title { font-size: 1rem; }
        .ae-page-header .ae-sub { font-size: 0.72rem; }
        .ae-page-header .ae-badge { font-size: 0.62rem; padding: 0.2rem 0.55rem; }
        .ae-page-header .ae-header-right { margin-left: auto; }

        .search-bar { flex-wrap: wrap; row-gap: 0.5rem; }
        .search-bar .input-group { flex: 1 1 100%; max-width: 100% !important; }

        .faq-table { min-width: 0 !important; }
        .faq-table thead { display: none; }
        .faq-table, .faq-table tbody, .faq-table tr, .faq-table td { display: block; }
        .faq-table tr { padding: 0.9rem 1rem; border-bottom: 1px solid var(--admin-border); }
        .faq-table tr:last-child { border-bottom: 0; }
        .faq-table td { padding: 0 !important; border-bottom: 0 !important; text-align: left !important; }
        .faq-table td[colspan] { padding: 2.5rem 1rem !important; text-align: center !important; }
        .faq-table .c-num { display: none; }
        .faq-table .c-question { font-size: 0.85rem; line-height: 1.35; word-break: break-word; }
        .faq-table .c-question .c-question-text { max-width: 100% !important; white-space: normal !important; overflow: visible !important; display: block !important; }
        .faq-table .c-answer { margin-top: 0.3rem; font-size: 0.75rem; line-height: 1.4; }
        .faq-table .c-answer .c-answer-text { max-width: 100% !important; white-space: normal !important; overflow: hidden !important; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
        .faq-table .c-order { display: inline-block; margin-top: 0.6rem; }
        .faq-table .c-status { display: inline-block; margin-top: 0.6rem; margin-left: 0.5rem; }
        .faq-table .c-order .ae-order-badge { font-size: 0.7rem; padding: 0.25rem 0.6rem; }
        .faq-table .c-status .ae-status-badge { font-size: 0.7rem; padding: 0.25rem 0.6rem; }
        .faq-table .c-actions { margin-top: 0.7rem; }
        .faq-table .c-actions .d-flex { gap: 0.5rem; }
        .faq-table .c-actions .ae-action-btn { width: 38px; height: 38px; font-size: 0.95rem; }
    }
</style>
<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="ae-page-header mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.dashboard.index') }}" class="ae-btn ae-btn-ghost" style="padding:0.5rem 0.75rem;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;" class="header-ico">
                <i class="bi bi-question-circle" style="font-size:1.5rem;color:#00d9ff;"></i>
            </div>
            <div class="d-flex flex-column align-items-start gap-1">
                <div class="ae-title">FAQs</div>
                <p class="ae-sub">Manage frequently asked questions.</p>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 ae-header-right">
            <span class="ae-badge"><span class="ae-dot"></span> {{ $faqs->count() }} FAQs</span>
            <a href="{{ route('admin.faqs.create') }}" class="ae-btn ae-btn-primary">
                <i class="bi bi-plus-lg"></i> Add FAQ
            </a>
        </div>
    </div>

    {{-- Live Search --}}
    <div class="mb-4">
        <div class="d-flex gap-2 align-items-center search-bar">
            <div class="input-group" style="max-width:500px;">
                <span class="input-group-text ae-search-icon"><i class="bi bi-search"></i></span>
                <input type="text" id="liveSearch" name="q" value="{{ $query ?? '' }}"
                       class="form-control ae-search border-start-0 ps-0"
                       placeholder="Search by question or answer..."
                       autocomplete="off">
                <span class="input-group-text ae-search-icon-end" id="searchSpinner">
                    <span class="spinner-border spinner-border-sm d-none" role="status" id="searchLoading"></span>
                </span>
            </div>
            @if(request()->has('q') && request()->q != '')
                <a href="{{ route('admin.faqs.index') }}" class="ae-btn ae-btn-ghost" style="padding:0.5rem 0.7rem;">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </div>
        <div class="mt-2" id="searchInfo">
            @if($query ?? false)
                <small class="ae-note">
                    <i class="bi bi-info-circle me-1"></i>
                    Showing results for "<strong>{{ $query }}</strong>" —
                    <span id="resultCount">{{ $faqs->count() }}</span> FAQ(s) found
                </small>
            @endif
        </div>
    </div>

    {{-- Table --}}
    @if($faqs->isEmpty() && !request()->ajax())
        <div class="ae-table-card">
            <div class="text-center py-5">
                <i class="bi bi-question-circle" style="font-size:3rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
                <p class="ae-note mb-2">No FAQs found.</p>
                <a href="{{ route('admin.faqs.create') }}" class="ae-btn ae-btn-primary">
                    <i class="bi bi-plus-lg"></i> Add FAQ
                </a>
            </div>
        </div>
    @else
        <div class="ae-table-card">
            <div class="table-responsive">
                <table class="table table-hover align-middle faq-table" style="min-width:850px;">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width:50px;">#</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th style="width:70px;">Order</th>
                            <th style="width:90px;">Status</th>
                            <th class="pe-4" style="width:110px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="faqsTableBody">
                        @include('backend.faq._table_rows', ['faqs' => $faqs])
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

@section('scripts')
<script>
(function() {
    function bindFaqEvents() {
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const title = this.dataset.title;
                Swal.fire({
                    title: 'Delete FAQ?',
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

    bindFaqEvents();
    window.bindFaqEvents = bindFaqEvents;
})();

(function() {
    var searchInput = document.getElementById('liveSearch');
    var tableBody = document.getElementById('faqsTableBody');
    var searchInfo = document.getElementById('searchInfo');
    var searchLoading = document.getElementById('searchLoading');

    if (!searchInput || !tableBody) return;

    var debounceTimer;

    function performSearch(query) {
        if (searchLoading) searchLoading.classList.remove('d-none');

        var url = '{{ route('admin.faqs.index') }}' + '?q=' + encodeURIComponent(query);

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
                countBadge.innerHTML = '<span class="ae-dot"></span> ' + data.count + ' FAQs';
            }

            if (searchInfo) {
                if (query) {
                    searchInfo.innerHTML = '<small class="ae-note"><i class="bi bi-info-circle me-1"></i>Showing results for "<strong>' + escapeHtml(query) + '</strong>" — ' + data.count + ' FAQ(s) found</small>';
                } else {
                    searchInfo.innerHTML = '';
                }
            }

            if (window.bindFaqEvents) window.bindFaqEvents();
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