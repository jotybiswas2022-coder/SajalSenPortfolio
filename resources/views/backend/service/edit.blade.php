@extends('backend.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            {{-- Header --}}
            <div class="ae-page-header mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-pencil-square" style="font-size:1.5rem;color:#00d9ff;"></i>
                    </div>
                    <div class="d-flex flex-column align-items-start gap-1">
                        <div class="ae-title">Edit Service</div>
                        <p class="ae-sub">Update details for <strong style="color:#00d9ff;">{{ $service->title }}</strong></p>
                    </div>
                </div>
                <a href="{{ route('admin.services.index') }}" class="ae-btn ae-btn-ghost">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Basic Info --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-info-circle"></i> Service Information</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="ae-form-label">Service Title <span class="text-danger">*</span></label>
                                <input type="text" name="title"
                                       class="form-control ae-input-modern @error('title') is-invalid @enderror"
                                       value="{{ old('title', $service->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="ae-form-label">Short Description</label>
                                <textarea name="short_description" rows="3"
                                          class="form-control ae-input-modern @error('short_description') is-invalid @enderror"
                                          placeholder="Brief description for the service card">{{ old('short_description', $service->short_description) }}</textarea>
                                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="ae-form-label">Full Description</label>
                                <textarea name="description" rows="3"
                                          class="form-control ae-input-modern @error('description') is-invalid @enderror"
                                          placeholder="Detailed description of the service">{{ old('description', $service->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Icon & Settings --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-sliders"></i> Icon & Settings</div>
                        <span class="ae-head-tag">Optional</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="ae-form-label">Icon (Bootstrap Icons class)</label>
                                <input type="text" name="icon" id="iconInput"
                                       class="form-control ae-input-modern @error('icon') is-invalid @enderror"
                                       value="{{ old('icon', $service->icon) }}" placeholder="e.g. bi-shield-lock">
                                <div class="ae-note mt-1">Browse at <a href="https://icons.getbootstrap.com" target="_blank" style="color:#00d9ff;">icons.getbootstrap.com</a></div>
                                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <div class="mt-3 d-flex align-items-center gap-3">
                                    <div class="ae-icon-box" style="width:56px;height:56px;font-size:1.6rem;">
                                        <i class="bi {{ $service->icon ?: 'bi-shield-lock' }}" id="iconPreview"></i>
                                    </div>
                                    <span class="ae-note">Preview</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="ae-form-label">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control ae-input-modern @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $service->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active" style="color:var(--admin-text);">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.services.index') }}" class="ae-btn ae-btn-ghost">Cancel</a>
                    <button type="submit" class="ae-btn ae-btn-primary">
                        <i class="bi bi-check-circle"></i> Update Service
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
    preview.className = 'bi ' + (this.value || 'bi-shield-lock');
});
</script>
@endsection

@endsection