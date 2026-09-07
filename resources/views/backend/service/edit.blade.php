@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .service-form-page h4 { font-size: 0.9rem; }
    .service-form-page p.text-muted { font-size: 0.75rem; }
    .service-form-page h6 { font-size: 0.82rem; }
    .service-form-page .form-label { font-size: 0.75rem; }
    .service-form-page .form-control { font-size: 0.78rem; padding: 0.4rem 0.6rem; }
    .service-form-page .form-text { font-size: 0.7rem; }
    .service-form-page .btn { font-size: 0.72rem; padding: 0.3rem 0.7rem; }
    .service-form-page .card-body { padding: 0.8rem !important; }
    .service-form-page .card-header { padding: 0.6rem 0.8rem !important; }
    .service-form-page .invalid-feedback { font-size: 0.72rem; }
}
</style>

<div class="container-fluid py-3 service-form-page">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-pencil-square me-2" style="color:#00d9ff;"></i>Edit Service</h4>
                    <p class="text-muted small mb-0">Update details for <strong>{{ $service->title }}</strong></p>
                </div>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary rounded-3 px-3">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Basic Info --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#00d9ff;"></i>Service Information</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-medium">Service Title <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title', $service->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Short Description</label>
                                <textarea name="short_description" rows="3"
                                          class="form-control @error('short_description') is-invalid @enderror"
                                          placeholder="Brief description for the service card">{{ old('short_description', $service->short_description) }}</textarea>
                                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Full Description</label>
                                <textarea name="description" rows="3"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Detailed description of the service">{{ old('description', $service->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Icon & Settings --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-sliders me-2" style="color:#00d9ff;"></i>Icon & Settings</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Icon (Bootstrap Icons class)</label>
                                <input type="text" name="icon" id="iconInput"
                                       class="form-control @error('icon') is-invalid @enderror"
                                       value="{{ old('icon', $service->icon) }}" placeholder="e.g. bi-code-slash">
                                <div class="form-text mt-1">Browse at <a href="https://icons.getbootstrap.com" target="_blank">icons.getbootstrap.com</a></div>
                                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <div class="mt-2 d-flex align-items-center gap-2">
                                    <span class="text-muted small">Preview:</span>
                                    <i class="bi {{ $service->icon ?: 'bi-star' }}" id="iconPreview" style="font-size:1.5rem; color:#00d9ff;"></i>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-medium">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $service->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.services.index') }}" class="btn btn-light border rounded-3 px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-5" style="background:#00d9ff; border-color:#00d9ff;">
                        <i class="bi bi-check-circle me-1"></i> Update Service
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@section('scripts')
<script>
document.getElementById('iconInput').addEventListener('input', function() {
    const preview = document.getElementById('iconPreview');
    preview.className = 'bi ' + (this.value || 'bi-star');
});
</script>
@endsection

@endsection
