@extends('backend.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            {{-- Header --}}
            <div class="ae-page-header mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-plus-circle" style="font-size:1.5rem;color:#00d9ff;"></i>
                    </div>
                    <div class="d-flex flex-column align-items-start gap-1">
                        <div class="ae-title">Add a New Testimonial</div>
                        <p class="ae-sub">Add a new client review to your portfolio.</p>
                    </div>
                </div>
                <a href="{{ route('admin.testimonials.index') }}" class="ae-btn ae-btn-ghost">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Client Info --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-person"></i> Client Information</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="ae-form-label">Client Name <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                       class="form-control ae-input-modern @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" placeholder="e.g. John Doe" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label class="ae-form-label">Designation</label>
                                <input type="text" name="designation"
                                       class="form-control ae-input-modern @error('designation') is-invalid @enderror"
                                       value="{{ old('designation') }}" placeholder="e.g. CEO">
                                @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label class="ae-form-label">Company</label>
                                <input type="text" name="company"
                                       class="form-control ae-input-modern @error('company') is-invalid @enderror"
                                       value="{{ old('company') }}" placeholder="e.g. Acme Inc.">
                                @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Review --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-chat-quote"></i> Review</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="ae-form-label">Review Message <span class="text-danger">*</span></label>
                                <textarea name="message" rows="4"
                                          class="form-control ae-input-modern @error('message') is-invalid @enderror"
                                          placeholder="What did the client say about your work?" required>{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="ae-form-label">Rating</label>
                                <div class="star-picker" id="starPicker" style="display:flex;gap:0.35rem;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill star-btn" data-value="{{ $i }}"
                                           style="color: {{ old('rating', 5) >= $i ? '#fbbf24' : 'var(--admin-border)' }}; font-size:1.5rem; cursor:pointer; transition:all 0.15s; text-shadow:0 0 10px rgba(251,191,36,0.3);"></i>
                                    @endfor
                                    <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', 5) }}">
                                </div>
                                @error('rating')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="ae-form-label">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control ae-input-modern @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label fw-medium" for="is_active" style="color:var(--admin-text);">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Client Avatar --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-image"></i> Client Avatar</div>
                    </div>
                    <div class="ae-card-body">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div>
                                <div class="d-flex align-items-start gap-2">
                                    <div id="previewPlaceholder"
                                         class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                         style="width:80px;height:80px;background:var(--admin-bg-soft);color:var(--admin-text-muted);font-size:2rem;border:1.5px dashed var(--admin-border);">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <img id="preview" src="" style="display:none;width:80px;height:80px;object-fit:cover;"
                                         class="rounded-circle shadow-sm">
                                    <button type="button" onclick="removeImage()" id="removeImageBtn" title="Remove image" style="display:none;"
                                            class="ae-action-btn delete">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <input type="file" accept="image/*" id="avatar" name="avatar"
                                       class="form-control ae-input-modern @error('avatar') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.testimonials.index') }}" class="ae-btn ae-btn-ghost">Cancel</a>
                    <button type="submit" class="ae-btn ae-btn-primary">
                        <i class="bi bi-check-circle"></i> Create Testimonial
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@section('scripts')
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('previewPlaceholder');
    const removeBtn = document.getElementById('removeImageBtn');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'inline-block';
        if (placeholder) placeholder.style.display = 'none';
        if (removeBtn) removeBtn.style.display = 'inline-flex';
    }
}
function removeImage() {
    const input = document.getElementById('avatar');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('previewPlaceholder');
    const removeBtn = document.getElementById('removeImageBtn');
    if (input) input.value = '';
    if (preview) { preview.src = ''; preview.style.display = 'none'; }
    if (placeholder) placeholder.style.display = 'inline-flex';
    if (removeBtn) removeBtn.style.display = 'none';
}

document.querySelectorAll('.star-btn').forEach(function(star) {
    star.addEventListener('click', function() {
        var value = parseInt(this.getAttribute('data-value'));
        document.getElementById('ratingInput').value = value;
        document.querySelectorAll('.star-btn').forEach(function(s) {
            var v = parseInt(s.getAttribute('data-value'));
            s.style.color = v <= value ? '#fbbf24' : 'var(--admin-border)';
        });
    });
    star.addEventListener('mouseenter', function() {
        var value = parseInt(this.getAttribute('data-value'));
        document.querySelectorAll('.star-btn').forEach(function(s) {
            var v = parseInt(s.getAttribute('data-value'));
            s.style.color = v <= value ? '#fbbf24' : 'var(--admin-border)';
        });
    });
    star.addEventListener('mouseleave', function() {
        var current = parseInt(document.getElementById('ratingInput').value);
        document.querySelectorAll('.star-btn').forEach(function(s) {
            var v = parseInt(s.getAttribute('data-value'));
            s.style.color = v <= current ? '#fbbf24' : 'var(--admin-border)';
        });
    });
});
</script>
@endsection

@endsection