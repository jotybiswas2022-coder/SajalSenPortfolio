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
                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#00d9ff;"></i>Add a New Case Study</h4>
                    <p class="text-muted small mb-0">Document an IT project with Problem → Solution → Result</p>
                </div>
                <a href="{{ route('admin.casestudies.index') }}" class="btn btn-outline-secondary rounded-3 px-3">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.casestudies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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
                                       value="{{ old('title') }}" placeholder="e.g. Enterprise CRM Migration" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="client" class="form-label fw-medium">Client</label>
                                <input type="text" id="client" name="client"
                                       class="form-control @error('client') is-invalid @enderror"
                                       value="{{ old('client') }}" placeholder="e.g. ABC Corp">
                                @error('client')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="category" class="form-label fw-medium">Category</label>
                                <input type="text" id="category" name="category"
                                       class="form-control @error('category') is-invalid @enderror"
                                       value="{{ old('category') }}" placeholder="e.g. Cloud Migration">
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
                                          placeholder="What challenge did the client face?" required>{{ old('problem') }}</textarea>
                                @error('problem')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="solution" class="form-label fw-medium">Solution <span class="text-danger">*</span></label>
                                <textarea id="solution" name="solution" rows="5"
                                          class="form-control @error('solution') is-invalid @enderror"
                                          placeholder="How did Infinite IT solve it?" required>{{ old('solution') }}</textarea>
                                @error('solution')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label for="result" class="form-label fw-medium">Result <span class="text-danger">*</span></label>
                                <textarea id="result" name="result" rows="5"
                                          class="form-control @error('result') is-invalid @enderror"
                                          placeholder="What measurable outcomes were achieved?" required>{{ old('result') }}</textarea>
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
                                       value="{{ old('technologies') }}" placeholder="e.g. Laravel, React, AWS, Docker">
                                @error('technologies')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="url" class="form-label fw-medium">Project URL</label>
                                <input type="url" id="url" name="url"
                                       class="form-control @error('url') is-invalid @enderror"
                                       value="{{ old('url') }}" placeholder="https://...">
                                @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label for="sort_order" class="form-label fw-medium">Sort Order</label>
                                <input type="number" id="sort_order" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
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
                                <div id="previewPlaceholder"
                                     class="rounded d-inline-flex align-items-center justify-content-center"
                                     style="width:120px; height:80px; background:#f1f5f9; color:#94a3b8; font-size:2rem;">
                                    <i class="bi bi-image"></i>
                                </div>
                                <img id="preview" src="" style="display:none; width:120px; height:80px; object-fit:cover;"
                                     class="rounded shadow-sm">
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
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label fw-medium" for="is_active">Active</label>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.casestudies.index') }}" class="btn btn-light border rounded-3 px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-5" style="background:#00d9ff; border-color:#00d9ff;">
                        <i class="bi bi-check-circle me-1"></i> Create Case Study
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
</script>
@endsection

@endsection
