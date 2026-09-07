@forelse($caseStudies as $caseStudy)
    <tr>
        <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
        <td>
            @if($caseStudy->image)
                <img src="{{ config('app.storage_url') }}{{ $caseStudy->image }}"
                     alt="{{ $caseStudy->title }}"
                     class="rounded"
                     style="width:50px; height:40px; object-fit:cover; border:1px solid rgba(0,217,255,0.3);">
            @else
                <div class="d-inline-flex align-items-center justify-content-center fw-bold text-white"
                     style="width:50px; height:40px; border-radius:10px; background:linear-gradient(135deg, rgba(0,217,255,0.25), rgba(0,255,136,0.15)); border:1px solid rgba(0,217,255,0.3); font-size:0.9rem;">
                    <i class="bi bi-image"></i>
                </div>
            @endif
        </td>
        <td class="fw-semibold" style="color:var(--admin-text);">{{ $caseStudy->title }}</td>
        <td><span class="text-muted small">{{ $caseStudy->client ?: '—' }}</span></td>
        <td>
            @if($caseStudy->category)
                <span class="badge rounded-pill px-2 py-1" style="background:rgba(0,217,255,0.12); color:#00d9ff; font-weight:500; font-size:0.7rem; border:1px solid rgba(0,217,255,0.25);">
                    <i class="bi bi-tag me-1"></i>{{ $caseStudy->category }}
                </span>
            @else
                <span class="text-muted small">—</span>
            @endif
        </td>
        <td>
            <div style="max-width:185px; white-space:normal; word-break:break-word;">
                @foreach($caseStudy->tech_list as $tech)
                    <span class="badge rounded-pill px-2 py-1 me-1 mb-1" style="background:rgba(255,255,255,0.07); color:#94a3b8; font-weight:500; font-size:0.68rem; border:1px solid rgba(255,255,255,0.08);">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
        </td>
        <td><span class="ae-order-badge">{{ $caseStudy->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.casestudies.toggleStatus', $caseStudy->id) }}"
               class="text-decoration-none ae-status-badge status-badge {{ $caseStudy->is_active ? '' : 'inactive' }}"
               data-title="{{ $caseStudy->title }}">
                <i class="bi {{ $caseStudy->is_active ? 'bi-check-circle' : 'bi-circle' }}"></i>
                {{ $caseStudy->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.casestudies.edit', $caseStudy->id) }}"
                   class="ae-action-btn edit" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button"
                        class="ae-action-btn delete delete-btn"
                        data-id="{{ $caseStudy->id }}"
                        data-title="{{ $caseStudy->title }}" title="Delete">
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
            <i class="bi bi-search" style="font-size:2rem; color:var(--admin-text-muted); display:block; margin-bottom:0.75rem;"></i>
            <div class="fw-semibold mb-2" style="color:var(--admin-text);">No Case Studies Found</div>
            <p class="ae-note">Try adjusting your search terms.</p>
        </td>
    </tr>
@endforelse