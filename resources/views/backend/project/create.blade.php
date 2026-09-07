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
                        <div class="ae-title">Add a New Project</div>
                        <p class="ae-sub">Create a new project to showcase in your portfolio.</p>
                    </div>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="ae-btn ae-btn-ghost">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Basic Info --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-info-circle"></i> Basic Information</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="ae-form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                       class="form-control ae-input-modern @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" placeholder="e.g. E-Commerce Platform" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="ae-form-label">Category</label>
                                <input type="text" name="category"
                                       class="form-control ae-input-modern @error('category') is-invalid @enderror"
                                       value="{{ old('category') }}" placeholder="e.g. Web App">
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="ae-form-label">Description</label>
                                <textarea name="description" rows="4"
                                          class="form-control ae-input-modern @error('description') is-invalid @enderror"
                                          placeholder="Describe your project...">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tech Stack & Status --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-gear"></i> Tech Stack & Status</div>
                        <span class="ae-head-tag">Optional</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="ae-form-label">Tech Stack</label>
                                <input type="text" name="tech_stack"
                                       class="form-control ae-input-modern @error('tech_stack') is-invalid @enderror"
                                       value="{{ old('tech_stack') }}" placeholder="e.g. Laravel, MySQL, Stripe">
                                <div class="form-text mt-1" style="color:var(--admin-text-muted);">Separate technologies with commas.</div>
                                @error('tech_stack')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label class="ae-form-label">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control ae-input-modern @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label fw-medium" for="is_active" style="color:var(--admin-text);">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Project Links --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-link-45deg"></i> Project Links</div>
                        <span class="ae-head-tag">Optional</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="ae-form-label"><i class="bi bi-globe me-1"></i> Live Link</label>
                                <input type="url" name="live_link"
                                       class="form-control ae-input-modern @error('live_link') is-invalid @enderror"
                                       value="{{ old('live_link') }}" placeholder="https://example.com">
                                @error('live_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="ae-form-label"><i class="bi bi-github me-1"></i> GitHub Link</label>
                                <input type="url" name="github_link"
                                       class="form-control ae-input-modern @error('github_link') is-invalid @enderror"
                                       value="{{ old('github_link') }}" placeholder="https://github.com/username/repo">
                                @error('github_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Project Image --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-image"></i> Project Image</div>
                    </div>
                    <div class="ae-card-body">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div>
                                <div class="d-flex align-items-start gap-2">
                                    <div id="previewPlaceholder"
                                         class="rounded d-inline-flex align-items-center justify-content-center"
                                         style="width:120px;height:80px;background:var(--admin-bg-soft);color:var(--admin-text-muted);font-size:2rem;border:1px dashed var(--admin-border);">
                                        <i class="bi bi-image"></i>
                                    </div>
                                    <img id="preview" src="" style="display:none;width:120px;height:80px;object-fit:cover;"
                                         class="rounded shadow-sm">
                                    <button type="button" onclick="removeImage()" id="removeImageBtn" title="Remove image" style="display:none;"
                                            class="ae-action-btn delete">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
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

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.projects.index') }}" class="ae-btn ae-btn-ghost">Cancel</a>
                    <button type="submit" class="ae-btn ae-btn-primary">
                        <i class="bi bi-check-circle"></i> Create Project
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
    const input = document.getElementById('image');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('previewPlaceholder');
    const removeBtn = document.getElementById('removeImageBtn');
    if (input) input.value = '';
    if (preview) { preview.src = ''; preview.style.display = 'none'; }
    if (placeholder) placeholder.style.display = 'inline-flex';
    if (removeBtn) removeBtn.style.display = 'none';
}
</script>
@endsection

@endsection