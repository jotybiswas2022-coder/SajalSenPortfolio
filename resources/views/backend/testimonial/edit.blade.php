@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .testimonial-form-page h4 { font-size: 0.9rem; }
    .testimonial-form-page p.text-muted { font-size: 0.75rem; }
    .testimonial-form-page h6 { font-size: 0.82rem; }
    .testimonial-form-page .form-label { font-size: 0.75rem; }
    .testimonial-form-page .form-control, .testimonial-form-page .form-select { font-size: 0.78rem; padding: 0.4rem 0.6rem; }
    .testimonial-form-page .form-text { font-size: 0.7rem; }
    .testimonial-form-page .btn { font-size: 0.72rem; padding: 0.3rem 0.7rem; }
    .testimonial-form-page .card-body { padding: 0.8rem !important; }
    .testimonial-form-page .card-header { padding: 0.6rem 0.8rem !important; }
    .testimonial-form-page .invalid-feedback { font-size: 0.72rem; }
}
</style>

<div class="container-fluid py-3 testimonial-form-page">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-pencil-square me-2" style="color:#00d9ff;"></i>Edit Testimonial</h4>
                    <p class="text-muted small mb-0">Update details for <strong>{{ $testimonial->name }}</strong>.</p>
                </div>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary rounded-3 px-3">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            {{-- Delete Avatar Form (outside the main form to avoid nested form issue) --}}
            @if($testimonial->avatar)
                <form action="{{ route('admin.testimonials.deleteImage', $testimonial->id) }}" method="POST" id="deleteImageForm" style="display:none;">
                    @csrf
                </form>
            @endif

            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Client Info --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-person me-2" style="color:#00d9ff;"></i>Client Information</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-medium">Client Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $testimonial->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="designation" class="form-label fw-medium">Designation</label>
                                <input type="text" id="designation" name="designation"
                                       class="form-control @error('designation') is-invalid @enderror"
                                       value="{{ old('designation', $testimonial->designation) }}" placeholder="e.g. CEO">
                                @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="company" class="form-label fw-medium">Company</label>
                                <input type="text" id="company" name="company"
                                       class="form-control @error('company') is-invalid @enderror"
                                       value="{{ old('company', $testimonial->company) }}" placeholder="e.g. Acme Inc.">
                                @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Review --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-chat-quote me-2" style="color:#00d9ff;"></i>Review</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="message" class="form-label fw-medium">Review Message <span class="text-danger">*</span></label>
                                <textarea id="message" name="message" rows="4"
                                          class="form-control @error('message') is-invalid @enderror"
                                          required>{{ old('message', $testimonial->message) }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium">Rating</label>
                                <div class="star-picker" id="starPicker">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill star-btn" data-value="{{ $i }}"
                                           style="color: {{ old('rating', $testimonial->rating) >= $i ? '#f59e0b' : '#d1d5db' }}; font-size:1.5rem; cursor:pointer; transition:all 0.15s;"></i>
                                    @endfor
                                    <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', $testimonial->rating) }}">
                                </div>
                                @error('rating')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="sort_order" class="form-label fw-medium">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $testimonial->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Avatar --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-image me-2" style="color:#00d9ff;"></i>Client Avatar</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div>
                                @if($testimonial->avatar)
                                    <div class="d-flex align-items-start gap-2">
                                        <img src="{{ asset('storage/' . $testimonial->avatar) }}"
                                             alt="{{ $testimonial->name }}"
                                             class="rounded-circle shadow-sm"
                                             style="width:80px; height:80px; object-fit:cover;">
                                        <button type="button" onclick="confirmDeleteImage()" class="btn btn-sm btn-outline-danger rounded-3">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                @else
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                         style="width:80px; height:80px; background:#f1f5f9; color:#94a3b8; font-size:2rem;">
                                        <i class="bi bi-person"></i>
                                    </div>
                                @endif
                                <img id="preview" src="" style="display:none; width:80px; height:80px; object-fit:cover;"
                                     class="rounded-circle shadow-sm mt-2">
                            </div>
                            <div>
                                <input type="file" accept="image/*" id="avatar" name="avatar"
                                       class="form-control @error('avatar') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                @error('avatar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light border rounded-3 px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-5" style="background:#00d9ff; border-color:#00d9ff;">
                        <i class="bi bi-check-circle me-1"></i> Update Testimonial
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
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'inline-block';
    }
}
function confirmDeleteImage() {
    Swal.fire({
        title: 'Delete Client Avatar?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="bi bi-trash3 me-1"></i> Yes, delete it!',
        cancelButtonText: '<i class="bi bi-x-lg me-1"></i> Cancel',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-4',
            confirmButton: 'btn btn-danger rounded-3 px-4 py-2',
            cancelButton: 'btn btn-light border rounded-3 px-4 py-2',
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.isConfirmed) {
            document.getElementById('deleteImageForm').submit();
        }
    });
}

document.querySelectorAll('.star-btn').forEach(function(star) {
    star.addEventListener('click', function() {
        var value = parseInt(this.getAttribute('data-value'));
        document.getElementById('ratingInput').value = value;
        document.querySelectorAll('.star-btn').forEach(function(s) {
            var v = parseInt(s.getAttribute('data-value'));
            s.style.color = v <= value ? '#f59e0b' : '#d1d5db';
        });
    });
    star.addEventListener('mouseenter', function() {
        var value = parseInt(this.getAttribute('data-value'));
        document.querySelectorAll('.star-btn').forEach(function(s) {
            var v = parseInt(s.getAttribute('data-value'));
            s.style.color = v <= value ? '#fbbf24' : '#d1d5db';
        });
    });
    star.addEventListener('mouseleave', function() {
        var current = parseInt(document.getElementById('ratingInput').value);
        document.querySelectorAll('.star-btn').forEach(function(s) {
            var v = parseInt(s.getAttribute('data-value'));
            s.style.color = v <= current ? '#f59e0b' : '#d1d5db';
        });
    });
});
</script>
@endsection

@endsection
