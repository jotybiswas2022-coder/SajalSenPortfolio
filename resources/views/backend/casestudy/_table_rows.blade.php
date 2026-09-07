@forelse($caseStudies as $caseStudy)
    <tr>
        <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
        <td>
            @if($caseStudy->image)
                <img src="{{ config('app.storage_url') }}{{ $caseStudy->image }}"
                     alt="{{ $caseStudy->title }}"
                     class="rounded shadow-sm"
                     style="width:50px; height:40px; object-fit:cover; border:1px solid rgba(0,217,255,0.15);">
            @else
                <div class="rounded d-inline-flex align-items-center justify-content-center fw-bold"
                     style="width:50px; height:40px; background:linear-gradient(135deg,#00d9ff,#00ff88); color:#fff; font-size:0.85rem;">
                    <i class="bi bi-image"></i>
                </div>
            @endif
        </td>
        <td class="fw-semibold">{{ $caseStudy->title }}</td>
        <td><span class="text-muted small">{{ $caseStudy->client ?: '—' }}</span></td>
        <td>
            @if($caseStudy->category)
                <span class="badge rounded-pill px-2 py-1" style="background:rgba(0,217,255,0.1); color:#00d9ff; font-weight:500; font-size:0.7rem;">
                    {{ $caseStudy->category }}
                </span>
            @else
                <span class="text-muted small">—</span>
            @endif
        </td>
        <td>
            <div style="max-width:180px; white-space:normal; word-break:break-word;">
                @foreach($caseStudy->tech_list as $tech)
                    <span class="badge rounded-pill px-2 py-1 me-1 mb-1" style="background:#f1f5f9; color:#475569; font-weight:500; font-size:0.68rem;">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
        </td>
        <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $caseStudy->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.casestudies.toggleStatus', $caseStudy->id) }}"
               class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $caseStudy->is_active ? 'active-badge' : 'inactive-badge' }}"
               data-title="{{ $caseStudy->title }}">
                {{ $caseStudy->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.casestudies.edit', $caseStudy->id) }}"
                   class="btn btn-sm btn-outline-primary rounded-3 px-2">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button"
                        class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                        data-id="{{ $caseStudy->id }}"
                        data-title="{{ $caseStudy->title }}">
                    <i class="bi bi-trash"></i>
                </button>
                <form id="delete-form-{{ $caseStudy->id }}"
                      action="{{ route('admin.casestudies.destroy', $caseStudy->id) }}"
                      method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="9" class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-search" style="font-size:2rem; color:#94a3b8; display:block; margin-bottom:0.5rem;"></i>
                <div class="fw-semibold mb-2">No Case Studies Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </td>
    </tr>
@endforelse
