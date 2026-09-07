@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .faq-form-page h4 { font-size: 0.9rem; }
    .faq-form-page p.text-muted { font-size: 0.75rem; }
    .faq-form-page .form-label { font-size: 0.75rem; }
    .faq-form-page .form-control { font-size: 0.78rem; padding: 0.4rem 0.6rem; }
    .faq-form-page .btn { font-size: 0.72rem; padding: 0.3rem 0.7rem; }
    .faq-form-page .card-body { padding: 0.8rem !important; }
    .faq-form-page .invalid-feedback { font-size: 0.72rem; }
}
</style>

<div class="container-fluid py-3 faq-form-page">

    <div class="mb-4">
        <h4 class="fw-bold mb-1"><i class="bi bi-pencil-square me-2" style="color:#00d9ff;"></i>Edit FAQ</h4>
        <p class="text-muted small mb-0">Update this frequently asked question</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body px-4 py-4">
            <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Question --}}
                <div class="bg-white" style="border-bottom:1px solid #e9ecef; padding-bottom:1rem; margin-bottom:1.5rem;">
                    <h6 class="fw-semibold mb-1 pb-0" style="color:#00d9ff;">
                        <i class="bi bi-question-lg me-1"></i> Question
                    </h6>
                    <p class="text-muted small mb-3">The question visitors will see</p>
                    <input type="text" name="question"
                           class="form-control form-control-lg @error('question') is-invalid @enderror"
                           value="{{ old('question', $faq->question) }}" required>
                    @error('question')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Answer --}}
                <div class="bg-white" style="border-bottom:1px solid #e9ecef; padding-bottom:1rem; margin-bottom:1.5rem;">
                    <h6 class="fw-semibold mb-1 pb-0" style="color:#00d9ff;">
                        <i class="bi bi-chat-dots me-1"></i> Answer
                    </h6>
                    <p class="text-muted small mb-3">The detailed answer to the question</p>
                    <textarea name="answer" rows="5"
                              class="form-control @error('answer') is-invalid @enderror"
                              required>{{ old('answer', $faq->answer) }}</textarea>
                    @error('answer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Settings --}}
                <div class="bg-white mb-3">
                    <h6 class="fw-semibold mb-3 pb-0" style="color:#00d9ff;">
                        <i class="bi bi-gear me-1"></i> Settings
                    </h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-muted">Sort Order</label>
                            <input type="number" name="sort_order" min="0"
                                   class="form-control form-control-lg"
                                   value="{{ old('sort_order', $faq->sort_order) }}">
                        </div>
                        <div class="col-md-6 d-flex align-items-end pb-1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                       style="width:2.5em; height:1.25em; cursor:pointer;"
                                       {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold ms-1" for="is_active" style="cursor:pointer;">Active</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2 pt-3" style="border-top:1px solid #e9ecef;">
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-light border rounded-3 px-4 py-2">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                    <button type="submit" class="btn rounded-3 px-4 py-2 flex-grow-1 text-white"
                            style="background:#00d9ff; border-color:#00d9ff;">
                        <i class="bi bi-check-circle me-1"></i> Update FAQ
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
