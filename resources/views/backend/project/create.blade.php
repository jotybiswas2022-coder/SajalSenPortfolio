@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .project-form-page h4 { font-size: 0.9rem; }
    .project-form-page p.text-muted { font-size: 0.75rem; }
    .project-form-page h6 { font-size: 0.82rem; }
    .project-form-page .form-label { font-size: 0.75rem; }
    .project-form-page .form-control, .project-form-page .form-select { font-size: 0.78rem; padding: 0.4rem 0.6rem; }
    .project-form-page .form-text { font-size: 0.7rem; }
    .project-form-page .btn { font-size: 0.72rem; padding: 0.3rem 0.7rem; }
    .project-form-page .card-body { padding: 0.8rem !important; }
    .project-form-page .card-header { padding: 0.6rem 0.8rem !important; }
    .project-form-page .invalid-feedback { font-size: 0.72rem; }
}
</style>

<div class="container-fluid py-3 project-form-page">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#00d9ff;"></i>Add a New Project</h4>
                    <p class="text-muted small mb-0">Create a new project to showcase in your portfolio.</p>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary rounded-3 px-3">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Basic Info --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#00d9ff;"></i>Basic Information</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="title" class="form-label fw-medium">Title <span class="text-danger">*</span></label>
                                <input type="text" id="title" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}" placeholder="e.g. E-Commerce Platform" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="category" class="form-label fw-medium">Category</label>
                                <input type="text" id="category" name="category"
                                       class="form-control @error('category') is-invalid @enderror"
                                       value="{{ old('category') }}" placeholder="e.g. Web App">
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label fw-medium">Description</label>
                                <textarea id="description" name="description" rows="4"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Describe your project...">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tech Stack & Status --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-gear me-2" style="color:#00d9ff;"></i>Tech Stack & Status</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="tech_stack" class="form-label fw-medium">Tech stack</label>
                                <input type="text" id="tech_stack" name="tech_stack"
                                       class="form-control @error('tech_stack') is-invalid @enderror"
                                       value="{{ old('tech_stack') }}" placeholder="e.g. Laravel, MySQL, Stripe">
                                <div class="form-text mt-1">Separate technologies with commas.</div>
                                @error('tech_stack')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="sort_order" class="form-label fw-medium">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Links --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-link-45deg me-2" style="color:#00d9ff;"></i>Project Links</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="live_link" class="form-label fw-medium"><i class="bi bi-globe me-1"></i> Live Link</label>
                                <input type="url" id="live_link" name="live_link"
                                       class="form-control @error('live_link') is-invalid @enderror"
                                       value="{{ old('live_link') }}" placeholder="https://example.com">
                                @error('live_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="github_link" class="form-label fw-medium"><i class="bi bi-github me-1"></i> GitHub Link</label>
                                <input type="url" id="github_link" name="github_link"
                                       class="form-control @error('github_link') is-invalid @enderror"
                                       value="{{ old('github_link') }}" placeholder="https://github.com/username/repo">
                                @error('github_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Project Image --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-image me-2" style="color:#00d9ff;"></i>Project Image</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <input type="file" accept="image/*" id="image" name="image"
                               class="form-control @error('image') is-invalid @enderror"
                               onchange="previewImage(event)">
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="mt-2">
                            <img id="preview" src="" style="display:none; max-width:300px; max-height:180px; object-fit:cover;"
                                 class="rounded shadow-sm">
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-light border rounded-3 px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-5" style="background:#00d9ff; border-color:#00d9ff;">
                        <i class="bi bi-check-circle me-1"></i> Create Project
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
</script>
@endsection

@endsection
