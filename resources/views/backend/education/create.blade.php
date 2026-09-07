@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .education-form-page h4 { font-size: 0.9rem; }
    .education-form-page p.text-muted { font-size: 0.75rem; }
    .education-form-page h6 { font-size: 0.82rem; }
    .education-form-page .form-label { font-size: 0.75rem; }
    .education-form-page .form-control { font-size: 0.78rem; padding: 0.4rem 0.6rem; }
    .education-form-page .form-text { font-size: 0.7rem; }
    .education-form-page .btn { font-size: 0.72rem; padding: 0.3rem 0.7rem; }
    .education-form-page .card-body { padding: 0.8rem !important; }
    .education-form-page .card-header { padding: 0.6rem 0.8rem !important; }
    .education-form-page .invalid-feedback { font-size: 0.72rem; }
}
</style>

<div class="container-fluid py-3 education-form-page">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#00d9ff;"></i>Add New Qualification</h4>
                    <p class="text-muted small mb-0">Add a new educational qualification to your portfolio.</p>
                </div>
                <a href="{{ route('admin.education.index') }}" class="btn btn-outline-secondary rounded-3 px-3">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.education.store') }}" method="POST">
                @csrf

                {{-- Qualification Info --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#00d9ff;"></i>Qualification information</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Degree Name <span class="text-danger">*</span></label>
                                <input type="text" name="degree_name"
                                       class="form-control @error('degree_name') is-invalid @enderror"
                                       value="{{ old('degree_name') }}" placeholder="e.g. B.Sc. in Computer Science" required>
                                @error('degree_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Institution <span class="text-danger">*</span></label>
                                <input type="text" name="institution"
                                       class="form-control @error('institution') is-invalid @enderror"
                                       value="{{ old('institution') }}" placeholder="e.g. University of Dhaka" required>
                                @error('institution')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Board / University</label>
                                <input type="text" name="board_or_university"
                                       class="form-control @error('board_or_university') is-invalid @enderror"
                                       value="{{ old('board_or_university') }}" placeholder="e.g. Dhaka Board">
                                @error('board_or_university')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Duration <span class="text-danger">*</span></label>
                                <input type="text" name="duration"
                                       class="form-control @error('duration') is-invalid @enderror"
                                       value="{{ old('duration') }}" placeholder="e.g. 2018 - 2022" required>
                                @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Result / Grade</label>
                                <input type="text" name="result"
                                       class="form-control @error('result') is-invalid @enderror"
                                       value="{{ old('result') }}" placeholder="e.g. CGPA 3.80 / 4.00">
                                @error('result')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-medium">Display Order</label>
                                <input type="number" name="display_order" min="0"
                                       class="form-control @error('display_order') is-invalid @enderror"
                                       value="{{ old('display_order', 0) }}">
                                @error('display_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
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

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.education.index') }}" class="btn btn-light border rounded-3 px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-5" style="background:#00d9ff; border-color:#00d9ff;">
                        <i class="bi bi-check-circle me-1"></i> Create Qualification
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
