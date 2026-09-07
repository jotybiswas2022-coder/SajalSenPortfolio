@forelse($faqs as $faq)
    <tr>
        <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
        <td class="fw-semibold" style="max-width:250px;">
            <span class="text-truncate d-inline-block" style="max-width:250px;">{{ $faq->question }}</span>
        </td>
        <td style="max-width:300px;">
            <span class="text-muted small text-truncate d-inline-block" style="max-width:300px;">
                {{ Str::limit(strip_tags($faq->answer), 100) }}
            </span>
        </td>
        <td><span class="badge rounded-pill px-3 py-1" style="background:#f1f5f9; color:#475569; font-weight:500;">{{ $faq->sort_order }}</span></td>
        <td>
            <a href="{{ route('admin.faqs.toggleStatus', $faq->id) }}"
               class="badge rounded-pill px-3 py-1 text-decoration-none status-badge {{ $faq->is_active ? 'active-badge' : 'inactive-badge' }}"
               data-title="{{ $faq->question }}">
                {{ $faq->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.faqs.edit', $faq->id) }}"
                   class="btn btn-sm btn-outline-primary rounded-3 px-2">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button"
                        class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-btn"
                        data-id="{{ $faq->id }}"
                        data-title="{{ $faq->question }}">
                    <i class="bi bi-trash"></i>
                </button>
                <form id="delete-form-{{ $faq->id }}"
                      action="{{ route('admin.faqs.destroy', $faq->id) }}"
                      method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-search" style="font-size:2rem; color:#94a3b8; display:block; margin-bottom:0.5rem;"></i>
                <div class="fw-semibold mb-2">No FAQs Found</div>
                <p class="text-muted small">Try adjusting your search terms.</p>
            </div>
        </td>
    </tr>
@endforelse
