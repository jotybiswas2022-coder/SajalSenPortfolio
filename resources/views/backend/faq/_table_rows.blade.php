@forelse($faqs as $faq)
    <tr>
        <td class="ps-4 fw-semibold c-num">#{{ $loop->iteration }}</td>
        <td class="fw-semibold c-question">
            <span class="c-qnum">#{{ $loop->iteration }}</span>
            <span class="text-truncate d-inline-block align-middle c-question-text" style="max-width:280px;color:var(--admin-text);">
                <i class="bi bi-question-circle me-1" style="color:#00d9ff;"></i>{{ $faq->question }}
            </span>
        </td>
        <td class="c-answer">
            <span class="text-muted small text-truncate d-inline-block align-middle c-answer-text" style="max-width:320px;color:var(--admin-text-muted);">
                {{ Str::limit(strip_tags($faq->answer), 100) }}
            </span>
        </td>
        <td class="c-order"><span class="ae-order-badge">{{ $faq->sort_order }}</span></td>
        <td class="c-status">
            <a href="{{ route('admin.faqs.toggleStatus', $faq->id) }}"
               class="ae-status-badge status-badge {{ $faq->is_active ? '' : 'inactive' }}"
               data-title="{{ $faq->question }}">
                <span class="ae-dot"></span> {{ $faq->is_active ? 'Active' : 'Inactive' }}
            </a>
        </td>
        <td class="pe-4 c-actions">
            <div class="d-flex gap-1 justify-content-end">
                <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="ae-action-btn edit" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button" class="ae-action-btn delete delete-btn"
                        data-id="{{ $faq->id }}" data-title="{{ $faq->question }}" title="Delete">
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
            <i class="bi bi-search" style="font-size:2rem;color:var(--admin-text-muted);display:block;margin-bottom:0.5rem;"></i>
            <p class="ae-note mb-0">No FAQs found. Try adjusting your search.</p>
        </td>
    </tr>
@endforelse