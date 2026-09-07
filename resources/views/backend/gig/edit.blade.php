@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .gig-form-page h4 { font-size: 0.9rem; }
    .gig-form-page p.text-muted { font-size: 0.75rem; }
    .gig-form-page h6 { font-size: 0.82rem; }
    .gig-form-page .form-label { font-size: 0.75rem; }
    .gig-form-page .form-control, .gig-form-page .form-select { font-size: 0.78rem; padding: 0.4rem 0.6rem; }
    .gig-form-page .form-text { font-size: 0.7rem; }
    .gig-form-page .btn { font-size: 0.72rem; padding: 0.3rem 0.7rem; }
    .gig-form-page .card-body { padding: 0.8rem !important; }
    .gig-form-page .card-header { padding: 0.6rem 0.8rem !important; }
    .gig-form-page .invalid-feedback { font-size: 0.72rem; }
}
</style>

<div class="container-fluid py-3 gig-form-page">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-11">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-pencil-square me-2" style="color:#00d9ff;"></i>Edit Gig</h4>
                    <p class="text-muted small mb-0">Update details for <strong>{{ $gig->title }}</strong></p>
                </div>
                <a href="{{ route('admin.gigs.index') }}" class="btn btn-outline-secondary rounded-3 px-3">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            {{-- Delete Image Form (outside the main form to avoid nested form issue) --}}
            @if($gig->image)
                <form action="{{ route('admin.gigs.deleteImage', $gig->id) }}" method="POST" id="deleteImageForm" style="display:none;">
                    @csrf
                </form>
            @endif

            <form action="{{ route('admin.gigs.update', $gig->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Basic Info --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#00d9ff;"></i>Basic Information</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-medium">Gig Title <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title', $gig->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-medium">Short Description</label>
                                <input type="text" name="short_description"
                                       class="form-control @error('short_description') is-invalid @enderror"
                                       value="{{ old('short_description', $gig->short_description) }}" placeholder="Brief overview of this gig">
                                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-medium">Full Description</label>
                                <textarea name="description" rows="4"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Detailed description of what this gig includes">{{ old('description', $gig->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $gig->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-medium">Gig Image</label>
                                <input type="file" accept="image/*" name="image"
                                       class="form-control @error('image') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <div class="mt-2">
                                    @if($gig->image)
                                        <div class="d-flex align-items-start gap-2">
                                            <img id="preview" src="{{ asset('storage/' . $gig->image) }}"
                                                 style="max-width:300px; max-height:180px; object-fit:cover;" class="rounded shadow-sm">
                                            <button type="button" onclick="confirmDeleteImage()" class="btn btn-sm btn-outline-danger rounded-3">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </div>
                                    @else
                                        <img id="preview" src="" style="display:none; max-width:300px; max-height:180px; object-fit:cover;" class="rounded shadow-sm">
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $gig->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Basic Package --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><span class="badge bg-secondary me-2">Basic</span> Package</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-medium">Plan Name</label>
                                <input type="text" name="basic_name"
                                       class="form-control @error('basic_name') is-invalid @enderror"
                                       value="{{ old('basic_name', $gig->basic_name) }}">
                                @error('basic_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium">Price <span class="text-danger">*</span></label>
                                <input type="text" name="basic_price"
                                       class="form-control @error('basic_price') is-invalid @enderror"
                                       value="{{ old('basic_price', $gig->basic_price) }}" required>
                                @error('basic_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-medium">Features (one per line)</label>
                                <textarea name="basic_features" rows="4"
                                          class="form-control @error('basic_features') is-invalid @enderror"
                                          placeholder="1 Basic Design&#10;5 Pages&#10;Responsive Layout">{{ old('basic_features', $gig->basic_features) }}</textarea>
                                @error('basic_features')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Standard Package --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><span class="badge bg-primary me-2">Standard</span> Package</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-medium">Plan Name</label>
                                <input type="text" name="standard_name"
                                       class="form-control @error('standard_name') is-invalid @enderror"
                                       value="{{ old('standard_name', $gig->standard_name) }}">
                                @error('standard_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium">Price <span class="text-danger">*</span></label>
                                <input type="text" name="standard_price"
                                       class="form-control @error('standard_price') is-invalid @enderror"
                                       value="{{ old('standard_price', $gig->standard_price) }}" required>
                                @error('standard_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-medium">Features (one per line)</label>
                                <textarea name="standard_features" rows="4"
                                          class="form-control @error('standard_features') is-invalid @enderror"
                                          placeholder="1 Premium Design&#10;10 Pages&#10;Responsive Layout&#10;SEO Optimized">{{ old('standard_features', $gig->standard_features) }}</textarea>
                                @error('standard_features')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Premium Package --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><span class="badge bg-warning text-dark me-2">Premium</span> Package</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-medium">Plan Name</label>
                                <input type="text" name="premium_name"
                                       class="form-control @error('premium_name') is-invalid @enderror"
                                       value="{{ old('premium_name', $gig->premium_name) }}">
                                @error('premium_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium">Price <span class="text-danger">*</span></label>
                                <input type="text" name="premium_price"
                                       class="form-control @error('premium_price') is-invalid @enderror"
                                       value="{{ old('premium_price', $gig->premium_price) }}" required>
                                @error('premium_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-medium">Features (one per line)</label>
                                <textarea name="premium_features" rows="4"
                                          class="form-control @error('premium_features') is-invalid @enderror"
                                          placeholder="1 Custom Design&#10;Unlimited Pages&#10;Responsive Layout&#10;SEO Optimized&#10;E-Commerce Integration">{{ old('premium_features', $gig->premium_features) }}</textarea>
                                @error('premium_features')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.gigs.index') }}" class="btn btn-light border rounded-3 px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-5" style="background:#00d9ff; border-color:#00d9ff;">
                        <i class="bi bi-check-circle me-1"></i> Update Gig
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
        title: 'Delete Gig Image?',
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
</script>
@endsection

@endsection
