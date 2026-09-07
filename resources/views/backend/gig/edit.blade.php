@extends('backend.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-11">

            {{-- Header --}}
            <div class="ae-page-header mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-pencil-square" style="font-size:1.5rem;color:#00d9ff;"></i>
                    </div>
                    <div class="d-flex flex-column align-items-start gap-1">
                        <div class="ae-title">Edit Gig</div>
                        <p class="ae-sub">Update details for <strong style="color:#00d9ff;">{{ $gig->title }}</strong>.</p>
                    </div>
                </div>
                <a href="{{ route('admin.gigs.index') }}" class="ae-btn ae-btn-ghost">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            {{-- Delete Image Form (outside main form) --}}
            @if($gig->image)
                <form action="{{ route('admin.gigs.deleteImage', $gig->id) }}" method="POST" id="deleteImageForm" style="display:none;">
                    @csrf
                </form>
            @endif

            <form action="{{ route('admin.gigs.update', $gig->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Basic Info --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-info-circle"></i> Basic Information</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="ae-form-label">Gig Title <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                       class="form-control ae-input-modern @error('title') is-invalid @enderror"
                                       value="{{ old('title', $gig->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="ae-form-label">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control ae-input-modern @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $gig->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="ae-form-label">Short Description</label>
                                <input type="text" name="short_description"
                                       class="form-control ae-input-modern @error('short_description') is-invalid @enderror"
                                       value="{{ old('short_description', $gig->short_description) }}" placeholder="Brief overview of this gig">
                                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="ae-form-label">Full Description</label>
                                <textarea name="description" rows="4"
                                          class="form-control ae-input-modern @error('description') is-invalid @enderror"
                                          placeholder="Detailed description of what this gig includes">{{ old('description', $gig->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Gig Image --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-image"></i> Gig Image</div>
                    </div>
                    <div class="ae-card-body">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div>
                                @if($gig->image)
                                    <div class="d-flex align-items-start gap-2">
                                        <img src="{{ config('app.storage_url') }}{{ $gig->image }}"
                                             id="preview"
                                             alt="{{ $gig->title }}"
                                             class="rounded shadow-sm"
                                             style="width:120px;height:80px;object-fit:cover;border:1px solid rgba(0,217,255,0.3);">
                                        <button type="button" onclick="confirmDeleteImage()" id="deleteSavedImageBtn" class="ae-action-btn delete" title="Delete saved image">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                    <div id="previewPlaceholder" style="display:none;"
                                         class="rounded d-inline-flex align-items-center justify-content-center"
                                         style="width:120px;height:80px;background:var(--admin-bg-soft);color:var(--admin-text-muted);font-size:2rem;border:1px dashed var(--admin-border);">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @else
                                    <div id="previewPlaceholder"
                                         class="rounded d-inline-flex align-items-center justify-content-center"
                                         style="width:120px;height:80px;background:var(--admin-bg-soft);color:var(--admin-text-muted);font-size:2rem;border:1px dashed var(--admin-border);">
                                        <i class="bi bi-image"></i>
                                    </div>
                                    <img id="preview" src="" style="display:none;width:120px;height:80px;object-fit:cover;"
                                         class="rounded shadow-sm">
                                @endif
                                <button type="button" onclick="removeImage()" id="removeImageBtn" title="Remove selected image" style="display:none;"
                                        class="ae-action-btn delete">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                            <div>
                                <input type="file" accept="image/*" id="image" name="image"
                                       class="form-control ae-input-modern @error('image') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Status --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-body py-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', $gig->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-medium" for="is_active" style="color:var(--admin-text);">Active</label>
                        </div>
                    </div>
                </div>

                {{-- Basic Package --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><span class="ae-tag-tier" style="color:#94a3b8;border-color:rgba(148,163,184,0.35);background:rgba(148,163,184,0.1);">BASIC</span> Package</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="ae-form-label">Plan Name</label>
                                <input type="text" name="basic_name"
                                       class="form-control ae-input-modern @error('basic_name') is-invalid @enderror"
                                       value="{{ old('basic_name', $gig->basic_name) }}">
                                @error('basic_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="ae-form-label">Price <span class="text-danger">*</span></label>
                                <input type="text" name="basic_price"
                                       class="form-control ae-input-modern @error('basic_price') is-invalid @enderror"
                                       value="{{ old('basic_price', $gig->basic_price) }}" required>
                                @error('basic_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="ae-form-label">Features (one per line)</label>
                                <textarea name="basic_features" rows="4"
                                          class="form-control ae-input-modern @error('basic_features') is-invalid @enderror"
                                          placeholder="1 Basic Design&#10;5 Pages&#10;Responsive Layout">{{ old('basic_features', $gig->basic_features) }}</textarea>
                                @error('basic_features')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Standard Package --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><span class="ae-tag-tier" style="color:#00d9ff;border-color:rgba(0,217,255,0.35);background:rgba(0,217,255,0.1);">STANDARD</span> Package</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="ae-form-label">Plan Name</label>
                                <input type="text" name="standard_name"
                                       class="form-control ae-input-modern @error('standard_name') is-invalid @enderror"
                                       value="{{ old('standard_name', $gig->standard_name) }}">
                                @error('standard_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="ae-form-label">Price <span class="text-danger">*</span></label>
                                <input type="text" name="standard_price"
                                       class="form-control ae-input-modern @error('standard_price') is-invalid @enderror"
                                       value="{{ old('standard_price', $gig->standard_price) }}" required>
                                @error('standard_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="ae-form-label">Features (one per line)</label>
                                <textarea name="standard_features" rows="4"
                                          class="form-control ae-input-modern @error('standard_features') is-invalid @enderror"
                                          placeholder="1 Premium Design&#10;10 Pages&#10;Responsive Layout&#10;SEO Optimized">{{ old('standard_features', $gig->standard_features) }}</textarea>
                                @error('standard_features')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Premium Package --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><span class="ae-tag-tier" style="color:#fbbf24;border-color:rgba(251,191,36,0.35);background:rgba(251,191,36,0.1);">PREMIUM</span> Package</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="ae-form-label">Plan Name</label>
                                <input type="text" name="premium_name"
                                       class="form-control ae-input-modern @error('premium_name') is-invalid @enderror"
                                       value="{{ old('premium_name', $gig->premium_name) }}">
                                @error('premium_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="ae-form-label">Price <span class="text-danger">*</span></label>
                                <input type="text" name="premium_price"
                                       class="form-control ae-input-modern @error('premium_price') is-invalid @enderror"
                                       value="{{ old('premium_price', $gig->premium_price) }}" required>
                                @error('premium_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="ae-form-label">Features (one per line)</label>
                                <textarea name="premium_features" rows="4"
                                          class="form-control ae-input-modern @error('premium_features') is-invalid @enderror"
                                          placeholder="1 Custom Design&#10;Unlimited Pages&#10;Responsive Layout&#10;SEO Optimized&#10;E-Commerce Integration">{{ old('premium_features', $gig->premium_features) }}</textarea>
                                @error('premium_features')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.gigs.index') }}" class="ae-btn ae-btn-ghost">Cancel</a>
                    <button type="submit" class="ae-btn ae-btn-primary">
                        <i class="bi bi-check-circle"></i> Update Gig
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@section('scripts')
<script>
const savedImageUrl = {!! json_encode($gig->image ? config('app.storage_url').$gig->image : null) !!};

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
    const input = document.getElementById('image');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('previewPlaceholder');
    const removeBtn = document.getElementById('removeImageBtn');
    const delSavedBtn = document.getElementById('deleteSavedImageBtn');
    if (input) input.value = '';
    if (savedImageUrl) {
        preview.src = savedImageUrl;
        preview.style.display = 'inline-block';
        if (placeholder) placeholder.style.display = 'none';
        if (delSavedBtn) delSavedBtn.style.display = 'inline-flex';
    } else {
        if (preview) { preview.src = ''; preview.style.display = 'none'; }
        if (placeholder) placeholder.style.display = 'inline-flex';
    }
    if (removeBtn) removeBtn.style.display = 'none';
}
function confirmDeleteImage() {
    Swal.fire({
        title: 'Delete Gig Image?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="bi bi-trash3 me-1"></i> Yes, delete it!',
        cancelButtonText: 'Cancel',
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
</script>
@endsection

@endsection