@extends('backend.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            {{-- Header --}}
            <div class="ae-page-header mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-pencil-square" style="font-size:1.5rem;color:#00d9ff;"></i>
                    </div>
                    <div class="d-flex flex-column align-items-start gap-1">
                        <div class="ae-title">Edit Skill</div>
                        <p class="ae-sub">Update details for <strong style="color:#00d9ff;">{{ $skill->name }}</strong>.</p>
                    </div>
                </div>
                <a href="{{ route('admin.skills.index') }}" class="ae-btn ae-btn-ghost">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Skill Info --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-info-circle"></i> Skill Information</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="ae-form-label">Skill Name <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                       class="form-control ae-input-modern @error('name') is-invalid @enderror"
                                       value="{{ old('name', $skill->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="ae-form-label">Icon (Bootstrap Icons class)</label>
                                <input type="text" name="icon" id="iconInput"
                                       class="form-control ae-input-modern @error('icon') is-invalid @enderror"
                                       value="{{ old('icon', $skill->icon) }}" placeholder="e.g. bi-fire, bi-code-slash">
                                <div class="form-text mt-1" style="color:var(--admin-text-muted);">Browse at <a href="https://icons.getbootstrap.com" target="_blank" style="color:#00d9ff;">icons.getbootstrap.com</a></div>
                                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Level & Settings --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-sliders"></i> Level & Settings</div>
                        <span class="ae-head-tag">Optional</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="ae-form-label">Percentage <span class="text-danger">*</span></label>
                                <input type="number" name="percentage" min="0" max="100"
                                       class="form-control ae-input-modern @error('percentage') is-invalid @enderror"
                                       value="{{ old('percentage', $skill->percentage) }}" required>
                                <div class="form-text mt-1" style="color:var(--admin-text-muted);">Value between 0 and 100</div>
                                @error('percentage')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="ae-form-label">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control ae-input-modern @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $skill->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $skill->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active" style="color:var(--admin-text);">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Preview --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-eye"></i> Preview</div>
                    </div>
                    <div class="ae-card-body text-center">
                        <div class="d-inline-flex align-items-center gap-3 p-3 rounded-3"
                             style="background:rgba(0,217,255,0.05);border:1px dashed rgba(0,217,255,0.3);">
                            <i class="bi {{ $skill->icon ?: 'bi-star' }}" id="iconPreview" style="font-size:2rem;color:#00d9ff;text-shadow:0 0 12px rgba(0,217,255,0.4);"></i>
                            <div class="text-start">
                                <div class="fw-semibold" id="previewName">{{ $skill->name }}</div>
                                <div class="progress mt-1" style="width:180px;height:6px;border-radius:10px;background:rgba(0,217,255,0.1);">
                                    <div class="progress-bar rounded-pill" style="width:{{ $skill->percentage }}%;background:linear-gradient(90deg,#00d9ff,#7ce6ff);box-shadow:0 0 10px rgba(0,217,255,0.4);" id="previewBar"></div>
                                </div>
                            </div>
                            <span class="ae-status-badge" id="previewPercent">{{ $skill->percentage }}%</span>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.skills.index') }}" class="ae-btn ae-btn-ghost">Cancel</a>
                    <button type="submit" class="ae-btn ae-btn-primary">
                        <i class="bi bi-check-circle"></i> Update Skill
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@section('scripts')
<script>
document.getElementById('iconInput').addEventListener('input', function() {
    document.getElementById('iconPreview').className = 'bi ' + (this.value || 'bi-star');
});
</script>
@endsection

@endsection