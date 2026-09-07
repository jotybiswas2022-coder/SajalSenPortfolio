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
                        <div class="ae-title">Edit Experience</div>
                        <p class="ae-sub">Update details for <strong style="color:#00d9ff;">{{ $experience->position }} @ {{ $experience->company }}</strong>.</p>
                    </div>
                </div>
                <a href="{{ route('admin.experiences.index') }}" class="ae-btn ae-btn-ghost">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Company & Position --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-building"></i> Company & Position</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="ae-form-label">Company <span class="text-danger">*</span></label>
                                <input type="text" name="company"
                                       class="form-control ae-input-modern @error('company') is-invalid @enderror"
                                       value="{{ old('company', $experience->company) }}" required>
                                @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="ae-form-label">Position <span class="text-danger">*</span></label>
                                <input type="text" name="position"
                                       class="form-control ae-input-modern @error('position') is-invalid @enderror"
                                       value="{{ old('position', $experience->position) }}" required>
                                @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="ae-form-label">Description</label>
                                <textarea name="description" rows="4"
                                          class="form-control ae-input-modern @error('description') is-invalid @enderror"
                                          placeholder="Describe your responsibilities and achievements...">{{ old('description', $experience->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Dates --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-calendar3"></i> Duration</div>
                        <span class="ae-head-tag">Required</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="ae-form-label">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="start_date"
                                       class="form-control ae-input-modern @error('start_date') is-invalid @enderror"
                                       value="{{ old('start_date', $experience->start_date ? $experience->start_date->format('Y-m-d') : '') }}" required>
                                @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="ae-form-label">End Date</label>
                                <input type="date" name="end_date" id="end_date"
                                       class="form-control ae-input-modern @error('end_date') is-invalid @enderror"
                                       value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}"
                                       {{ $experience->is_current ? 'disabled' : '' }}>
                                @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_current" name="is_current"
                                           value="1" {{ old('is_current', $experience->is_current) ? 'checked' : '' }}
                                           onchange="toggleEndDate(this)">
                                    <label class="form-check-label fw-medium" for="is_current" style="color:var(--admin-text);">Currently Working</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Location & Settings --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <div class="ae-head-title"><i class="bi bi-sliders"></i> Location & Settings</div>
                        <span class="ae-head-tag">Optional</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="ae-form-label"><i class="bi bi-geo-alt me-1"></i> Location</label>
                                <input type="text" name="location"
                                       class="form-control ae-input-modern @error('location') is-invalid @enderror"
                                       value="{{ old('location', $experience->location) }}" placeholder="e.g. Dhaka, Bangladesh">
                                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label class="ae-form-label">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control ae-input-modern @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $experience->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $experience->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active" style="color:var(--admin-text);">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.experiences.index') }}" class="ae-btn ae-btn-ghost">Cancel</a>
                    <button type="submit" class="ae-btn ae-btn-primary">
                        <i class="bi bi-check-circle"></i> Update Experience
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@section('scripts')
<script>
function toggleEndDate(checkbox) {
    document.getElementById('end_date').disabled = checkbox.checked;
    if (checkbox.checked) document.getElementById('end_date').value = '';
}
</script>
@endsection

@endsection