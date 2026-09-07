@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .experience-form-page h4 { font-size: 0.9rem; }
    .experience-form-page p.text-muted { font-size: 0.75rem; }
    .experience-form-page h6 { font-size: 0.82rem; }
    .experience-form-page .form-label { font-size: 0.75rem; }
    .experience-form-page .form-control { font-size: 0.78rem; padding: 0.4rem 0.6rem; }
    .experience-form-page .form-text { font-size: 0.7rem; }
    .experience-form-page .btn { font-size: 0.72rem; padding: 0.3rem 0.7rem; }
    .experience-form-page .card-body { padding: 0.8rem !important; }
    .experience-form-page .card-header { padding: 0.6rem 0.8rem !important; }
    .experience-form-page .invalid-feedback { font-size: 0.72rem; }
}
</style>

<div class="container-fluid py-3 experience-form-page">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-pencil-square me-2" style="color:#00d9ff;"></i>Edit Experience</h4>
                    <p class="text-muted small mb-0">Update details for <strong>{{ $experience->position }} @ {{ $experience->company }}</strong>.</p>
                </div>
                <a href="{{ route('admin.experiences.index') }}" class="btn btn-outline-secondary rounded-3 px-3">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Company & Position --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-building me-2" style="color:#00d9ff;"></i>Company & Position</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Company <span class="text-danger">*</span></label>
                                <input type="text" name="company"
                                       class="form-control @error('company') is-invalid @enderror"
                                       value="{{ old('company', $experience->company) }}" required>
                                @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">Position <span class="text-danger">*</span></label>
                                <input type="text" name="position"
                                       class="form-control @error('position') is-invalid @enderror"
                                       value="{{ old('position', $experience->position) }}" required>
                                @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-medium">Description</label>
                                <textarea name="description" rows="4"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Describe your responsibilities and achievements...">{{ old('description', $experience->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Dates --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-calendar3 me-2" style="color:#00d9ff;"></i>Duration</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-medium">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="start_date"
                                       class="form-control @error('start_date') is-invalid @enderror"
                                       value="{{ old('start_date', $experience->start_date ? $experience->start_date->format('Y-m-d') : '') }}" required>
                                @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-medium">End Date</label>
                                <input type="date" name="end_date" id="end_date"
                                       class="form-control @error('end_date') is-invalid @enderror"
                                       value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}"
                                       {{ $experience->is_current ? 'disabled' : '' }}>
                                @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_current" name="is_current"
                                           value="1" {{ old('is_current', $experience->is_current) ? 'checked' : '' }}
                                           onchange="toggleEndDate(this)">
                                    <label class="form-check-label fw-medium" for="is_current">Currently Working</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Location & Settings --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-sliders me-2" style="color:#00d9ff;"></i>Location & Settings</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium"><i class="bi bi-geo-alt me-1"></i> Location</label>
                                <input type="text" name="location"
                                       class="form-control @error('location') is-invalid @enderror"
                                       value="{{ old('location', $experience->location) }}" placeholder="e.g. Dhaka, Bangladesh">
                                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-medium">Sort Order</label>
                                <input type="number" name="sort_order" min="0"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       value="{{ old('sort_order', $experience->sort_order) }}">
                                @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 d-flex align-items-end pb-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                           {{ old('is_active', $experience->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.experiences.index') }}" class="btn btn-light border rounded-3 px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-5" style="background:#00d9ff; border-color:#00d9ff;">
                        <i class="bi bi-check-circle me-1"></i> Update Experience
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
