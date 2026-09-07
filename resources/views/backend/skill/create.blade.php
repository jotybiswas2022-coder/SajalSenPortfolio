@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .skill-form-page h4 { font-size: 0.9rem; }
    .skill-form-page p.text-muted { font-size: 0.75rem; }
    .skill-form-page h6 { font-size: 0.82rem; }
    .skill-form-page .form-label { font-size: 0.75rem; }
    .skill-form-page .form-control { font-size: 0.78rem; padding: 0.4rem 0.6rem; }
    .skill-form-page .form-text { font-size: 0.7rem; }
    .skill-form-page .btn { font-size: 0.72rem; padding: 0.3rem 0.7rem; }
    .skill-form-page .card-body { padding: 0.8rem !important; }
    .skill-form-page .card-header { padding: 0.6rem 0.8rem !important; }
    .skill-form-page .invalid-feedback { font-size: 0.72rem; }
}
</style>

<div class="container-fluid py-3 skill-form-page">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#00d9ff;"></i>Add a New Skill</h4>
                    <p class="text-muted small mb-0">Add a new technical skill to your portfolio.</p>
                </div>
                <a href="{{ route('admin.skills.index') }}" class="btn btn-outline-secondary rounded-3 px-3">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.skills.store') }}" method="POST">
                @csrf

                {{-- Skill Info --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#00d9ff;"></i>Skill information</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Skill name <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" placeholder="e.g. Laravel" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Icon (Bootstrap Icons class)</label>
                                <input type="text" name="icon" id="iconInput"
                                       class="form-control @error('icon') is-invalid @enderror"
                                       value="{{ old('icon') }}" placeholder="e.g. bi-fire, bi-code-slash">
                                <div class="form-text mt-1">Browse at <a href="https://icons.getbootstrap.com" target="_blank">icons.getbootstrap.com</a></div>
                                @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Level & Settings --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-sliders me-2" style="color:#00d9ff;"></i>Level & Settings</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-medium">Percentage <span class="text-danger">*</span></label>
                                <input type="number" name="percentage" min="0" max="100"
                                       class="form-control @error('percentage') is-invalid @enderror"
                                       value="{{ old('percentage', 80) }}" required>
                                <div class="form-text mt-1">Value between 0 and 100</div>
                                @error('percentage')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Preview --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-eye me-2" style="color:#00d9ff;"></i>Preview</h6>
                    </div>
                    <div class="card-body px-4 pb-4 text-center">
                        <div class="d-inline-flex align-items-center gap-3 p-3 rounded-3" style="background:#f8fafc; border:1px dashed #e2e8f0;">
                            <i class="bi {{ old('icon') ?: 'bi-star' }}" id="iconPreview" style="font-size:2rem; color:#00d9ff;"></i>
                            <div class="text-start">
                                <div class="fw-semibold" id="previewName">{{ old('name') ?: 'Skill Name' }}</div>
                                <div class="progress mt-1" style="width:180px; height:6px; border-radius:10px; background:#e2e8f0;">
                                    <div class="progress-bar rounded-pill" style="width:{{ old('percentage', 80) }}%; background:linear-gradient(90deg,#00d9ff,#7ce6ff);" id="previewBar"></div>
                                </div>
                            </div>
                            <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background:rgba(0,217,255,0.1); color:#00d9ff;" id="previewPercent">{{ old('percentage', 80) }}%</span>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.skills.index') }}" class="btn btn-light border rounded-3 px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-5" style="background:#00d9ff; border-color:#00d9ff;">
                        <i class="bi bi-check-circle me-1"></i> Create Skill
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@section('scripts')
<script>
document.querySelector('input[name="icon"]').addEventListener('input', function() {
    document.getElementById('iconPreview').className = 'bi ' + (this.value || 'bi-star');
});

document.querySelector('input[name="name"]').addEventListener('input', function() {
    document.getElementById('previewName').textContent = this.value || 'Skill Name';
});

document.querySelector('input[name="percentage"]').addEventListener('input', function() {
    const val = Math.min(100, Math.max(0, this.value || 0));
    document.getElementById('previewBar').style.width = val + '%';
    document.getElementById('previewPercent').textContent = val + '%';
});
</script>
@endsection

@endsection
