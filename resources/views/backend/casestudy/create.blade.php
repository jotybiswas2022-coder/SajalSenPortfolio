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
                        <div class="ae-title">Add New Case Study</div>
                        <p class="ae-sub">Document an IT project with Problem → Solution → Result.</p>
                    </div>
                </div>
                <a href="{{ route('admin.casestudies.index') }}" class="ae-btn ae-btn-ghost">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.casestudies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Basic Info --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-info-circle"></i> Basic Information</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="title" class="ae-form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title"
                                       class="form-control ae-input-modern @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" placeholder="e.g. Enterprise CRM Migration" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="client" class="ae-form-label">Client</label>
                                <input type="text" id="client" name="client"
                                       class="form-control ae-input-modern @error('client') is-invalid @enderror"
                                       value="{{ old('client') }}" placeholder="e.g. ABC Corp">
                                @error('client')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="category" class="ae-form-label">Category</label>
                                <input type="text" id="category" name="category"
                                       class="form-control ae-input-modern @error('category') is-invalid @enderror"
                                       value="{{ old('category') }}" placeholder="e.g. Cloud Migration">
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Problem / Solution / Result --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-diagram-3"></i> Case Study Details</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="problem" class="ae-form-label">Problem <span class="text-danger">*</span></label>
                                <textarea id="problem" name="problem" rows="5"
                                          class="form-control ae-input-modern @error('problem') is-invalid @enderror"
                                          placeholder="What challenge did the client face?" required>{{ old('problem') }}</textarea>
                                @error('problem')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="solution" class="ae-form-label">Solution <span class="text-danger">*</span></label>
                                <textarea id="solution" name="solution" rows="5"
                                          class="form-control ae-input-modern @error('solution') is-invalid @enderror"
                                          placeholder="How did Infinite IT solve it?" required>{{ old('solution') }}</textarea>
                                @error('solution')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="result" class="ae-form-label">Result <span class="text-danger">*</span></label>
                                <textarea id="result" name="result" rows="5"
                                          class="form-control ae-input-modern @error('result') is-invalid @enderror"
                                          placeholder="What measurable outcomes were achieved?" required>{{ old('result') }}</textarea>
                                @error('result')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Additional Info --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-gear"></i> Additional Information</div>
                        <span class="ae-head-tag">Optional</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="technologies" class="ae-form-label">Technologies</label>
                                <input type="text" id="technologies" name="technologies"
                                       class="form-control ae-input-modern @error('technologies') is-invalid @enderror"
                                       value="{{ old('technologies') }}" placeholder="e.g. Laravel, React, AWS, Docker">
                                @error('technologies')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="url" class="ae-form-label">Project URL</label>
                                <input type="url" id="url" name="url"
                                       class="form-control ae-input-modern @error('url') is-invalid @enderror"
                                       value="{{ old('url') }}" placeholder="https://...">
                                @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="sort_order" class="ae-form-label">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control ae-input-modern @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Image --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-image"></i> Case Study Image</div>
                        <span class="ae-head-tag">Optional</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div>
                                <div class="d-flex align-items-start gap-2">
                                    <div id="previewPlaceholder"
                                         class="rounded d-inline-flex align-items-center justify-content-center"
                                         style="width:120px; height:80px; background:var(--admin-bg-soft); color:var(--admin-text-muted); font-size:2rem; border:1px dashed var(--admin-border);">
                                        <i class="bi bi-image"></i>
                                    </div>
                                    <img id="preview" src="" style="display:none; width:120px; height:80px; object-fit:cover;"
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

                {{-- Status --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-body py-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label fw-medium" for="is_active" style="color:var(--admin-text);">Active</label>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.casestudies.index') }}" class="ae-btn ae-btn-ghost">Cancel</a>
                    <button type="submit" class="ae-btn ae-btn-primary">
                        <i class="bi bi-check-circle"></i> Create Case Study
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