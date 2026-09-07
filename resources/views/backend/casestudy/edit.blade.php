@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .casestudy-form-page h4 { font-size: 0.9rem; }
    .casestudy-form-page p.text-muted { font-size: 0.75rem; }
    .casestudy-form-page h6 { font-size: 0.82rem; }
    .casestudy-form-page .form-label { font-size: 0.75rem; }
    .casestudy-form-page .form-control, .casestudy-form-page .form-select { font-size: 0.78rem; padding: 0.4rem 0.6rem; }
    .casestudy-form-page .form-text { font-size: 0.7rem; }
    .casestudy-form-page .btn { font-size: 0.72rem; padding: 0.3rem 0.7rem; }
    .casestudy-form-page .card-body { padding: 0.8rem !important; }
    .casestudy-form-page .card-header { padding: 0.6rem 0.8rem !important; }
    .casestudy-form-page .invalid-feedback { font-size: 0.72rem; }
}
</style>

<div class="container-fluid py-3 casestudy-form-page">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-pencil-square me-2" style="color:#00d9ff;"></i>Edit Case Study</h4>
                    <p class="text-muted small mb-0">Update details for <strong>{{ $caseStudy->title }}</strong>.</p>
                </div>
                <a href="{{ route('admin.casestudies.index') }}" class="btn btn-outline-secondary rounded-3 px-3">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            {{-- Delete Image Form (outside the main form to avoid nested form issue) --}}
            @if($caseStudy->image)
                <form action="{{ route('admin.casestudies.deleteImage', $caseStudy->id) }}" method="POST" id="deleteImageForm" style="display:none;">
                    @csrf
                </form>
            @endif

            <form action="{{ route('admin.casestudies.update', $caseStudy->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Basic Info --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#00d9ff;"></i>Basic Information</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label fw-medium">Title <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title', $caseStudy->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="client" class="form-label fw-medium">Client</label>
                                <input type="text" id="client" name="client"
                                       class="form-control @error('client') is-invalid @enderror"
                                       value="{{ old('client', $caseStudy->client) }}">
                                @error('client')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="category" class="form-label fw-medium">Category</label>
                                <input type="text" id="category" name="category"
                                       class="form-control @error('category') is-invalid @enderror"
                                       value="{{ old('category', $caseStudy->category) }}">
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Problem / Solution / Result --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-diagram-3 me-2" style="color:#00d9ff;"></i>Case Study Details</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="problem" class="form-label fw-medium">Problem <span class="text-danger">*</span></label>
                                <textarea id="problem" name="problem" rows="5"
                                          class="form-control @error('problem') is-invalid @enderror"
                                          required>{{ old('problem', $caseStudy->problem) }}</textarea>
                                @error('problem')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="solution" class="form-label fw-medium">Solution <span class="text-danger">*</span></label>
                                <textarea id="solution" name="solution" rows="5"
                                          class="form-control @error('solution') is-invalid @enderror"
                                          required>{{ old('solution', $caseStudy->solution) }}</textarea>
                                @error('solution')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="result" class="form-label fw-medium">Result <span class="text-danger">*</span></label>
                                <textarea id="result" name="result" rows="5"
                                          class="form-control @error('result') is-invalid @enderror"
                                          required>{{ old('result', $caseStudy->result) }}</textarea>
                                @error('result')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Additional Info --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-gear me-2" style="color:#00d9ff;"></i>Additional Information</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="technologies" class="form-label fw-medium">Technologies</label>
                                <input type="text" id="technologies" name="technologies"
                                       class="form-control @error('technologies') is-invalid @enderror"
                                       value="{{ old('technologies', $caseStudy->technologies) }}">
                                @error('technologies')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="url" class="form-label fw-medium">Project URL</label>
                                <input type="url" id="url" name="url"
                                       class="form-control @error('url') is-invalid @enderror"
                                       value="{{ old('url', $caseStudy->url) }}">
                                @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="sort_order" class="form-label fw-medium">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $caseStudy->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Image --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-image me-2" style="color:#00d9ff;"></i>Case Study Image</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div>
                                @if($caseStudy->image)
                                    <div class="d-flex align-items-start gap-2">
                                        <img src="{{ asset('storage/' . $caseStudy->image) }}"
                                             id="preview"
                                             class="rounded shadow-sm"
                                             style="width:120px; height:80px; object-fit:cover;">
                                        <button type="button" onclick="confirmDeleteImage()" class="btn btn-sm btn-outline-danger rounded-3">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                    <div id="previewPlaceholder" style="display:none;"
                                         class="rounded d-inline-flex align-items-center justify-content-center"
                                         style="width:120px; height:80px; background:#f1f5f9; color:#94a3b8; font-size:2rem;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @else
                                    <div id="previewPlaceholder"
                                         class="rounded d-inline-flex align-items-center justify-content-center"
                                         style="width:120px; height:80px; background:#f1f5f9; color:#94a3b8; font-size:2rem;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                    <img id="preview" src="" style="display:none; width:120px; height:80px; object-fit:cover;"
                                         class="rounded shadow-sm">
                                @endif
                            </div>
                            <div>
                                <input type="file" accept="image/*" id="image" name="image"
                                       class="form-control @error('image') is-invalid @enderror"
                                       onchange="previewImage(event)">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Status --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body px-4 py-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', $caseStudy->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-medium" for="is_active">Active</label>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.casestudies.index') }}" class="btn btn-light border rounded-3 px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-5" style="background:#00d9ff; border-color:#00d9ff;">
                        <i class="bi bi-check-circle me-1"></i> Update Case Study
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
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'inline-block';
        if (placeholder) placeholder.style.display = 'none';
    }
}
function confirmDeleteImage() {
    Swal.fire({
        title: 'Delete Case Study Image?',
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
