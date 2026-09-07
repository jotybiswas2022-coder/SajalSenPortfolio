@extends('backend.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            {{-- Header --}}
            <div class="ae-page-header mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-plus-circle" style="font-size:1.5rem;color:#00d9ff;"></i>
                    </div>
                    <div class="d-flex flex-column align-items-start gap-1">
                        <div class="ae-title">Add New Qualification</div>
                        <p class="ae-sub">Add a new educational qualification to your portfolio.</p>
                    </div>
                </div>
                <a href="{{ route('admin.education.index') }}" class="ae-btn ae-btn-ghost">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.education.store') }}" method="POST">
                @csrf

                {{-- Qualification Info --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-info-circle"></i> Qualification Information</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="ae-form-label">Degree Name <span class="text-danger">*</span></label>
                                <input type="text" name="degree_name"
                                       class="form-control ae-input-modern @error('degree_name') is-invalid @enderror"
                                       value="{{ old('degree_name') }}" placeholder="e.g. B.Sc. in Computer Science" required>
                                @error('degree_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="ae-form-label">Institution <span class="text-danger">*</span></label>
                                <input type="text" name="institution"
                                       class="form-control ae-input-modern @error('institution') is-invalid @enderror"
                                       value="{{ old('institution') }}" placeholder="e.g. University of Dhaka" required>
                                @error('institution')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="ae-form-label">Board / University</label>
                                <input type="text" name="board_or_university"
                                       class="form-control ae-input-modern @error('board_or_university') is-invalid @enderror"
                                       value="{{ old('board_or_university') }}" placeholder="e.g. Dhaka Board">
                                @error('board_or_university')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="ae-form-label">Duration <span class="text-danger">*</span></label>
                                <input type="text" name="duration"
                                       class="form-control ae-input-modern @error('duration') is-invalid @enderror"
                                       value="{{ old('duration') }}" placeholder="e.g. 2018 - 2022" required>
                                @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="ae-form-label">Result / Grade</label>
                                <input type="text" name="result"
                                       class="form-control ae-input-modern @error('result') is-invalid @enderror"
                                       value="{{ old('result') }}" placeholder="e.g. CGPA 3.80 / 4.00">
                                @error('result')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label class="ae-form-label">Display Order</label>
                                <input type="number" name="display_order" min="0"
                                       class="form-control ae-input-modern @error('display_order') is-invalid @enderror"
                                       value="{{ old('display_order', 0) }}">
                                @error('display_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
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

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.education.index') }}" class="ae-btn ae-btn-ghost">Cancel</a>
                    <button type="submit" class="ae-btn ae-btn-primary">
                        <i class="bi bi-check-circle"></i> Create Qualification
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection