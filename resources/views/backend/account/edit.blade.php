@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .account-edit-page h4 { font-size: 0.9rem; }
    .account-edit-page h6 { font-size: 0.82rem; }
    .account-edit-page p.text-muted { font-size: 0.75rem; }
    .account-edit-page .form-label { font-size: 0.75rem; }
    .account-edit-page .form-control { font-size: 0.78rem; padding: 0.4rem 0.6rem; }
    .account-edit-page .form-text { font-size: 0.7rem; }
    .account-edit-page .btn { font-size: 0.72rem; padding: 0.3rem 0.7rem; }
    .account-edit-page .card-body { padding: 0.8rem !important; }
    .account-edit-page .card-header { padding: 0.6rem 0.8rem !important; }
    .account-edit-page .rounded-circle[style*="110px"] { width: 70px !important; height: 70px !important; font-size: 1.5rem !important; }
    .account-edit-page img[style*="110px"] { width: 70px !important; height: 70px !important; }
    .account-edit-page .form-check-label { font-size: 0.72rem; }
}
</style>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-modern mx-3" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid py-3 account-edit-page">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fw-bold mb-1"><i class="bi bi-person-gear me-2" style="color:#00d9ff;"></i>Edit Account</h4>
                    <p class="text-muted small mb-0">Update your profile details and social links.</p>
                </div>
                <a href="{{ route('admin.account.index') }}" class="btn btn-outline-secondary rounded-3 px-3">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            {{-- Delete Image Form (outside the main form to avoid nested form issue) --}}
            @if(isset($account) && $account->image)
                <form action="{{ route('admin.account.deleteImage') }}" method="POST" id="deleteImageForm" style="display:none;">
                    @csrf
                </form>
            @endif

            <form action="{{ route('admin.account.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Basic Info --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#00d9ff;"></i>Basic Information</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-medium">Full Name</label>
                                <input type="text" id="name" name="name"
                                       class="form-control form-control-lg"
                                       value="{{ $account->name ?? '' }}"
                                       placeholder="Enter your name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-medium">
                                    <i class="bi bi-envelope me-1" style="color:#00d9ff;"></i> Email
                                </label>
                                <input type="email" id="email" name="email"
                                       class="form-control form-control-lg"
                                       value="{{ $account->email ?? '' }}"
                                       placeholder="hello@example.com">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-medium">
                                    <i class="bi bi-whatsapp me-1" style="color:#25D366;"></i> WhatsApp Number
                                </label>
                                <input type="text" id="phone" name="phone"
                                       class="form-control form-control-lg"
                                       value="{{ $account->phone ?? '' }}"
                                       placeholder="+8801XXXXXXXXX">
                                <div class="form-text mt-1">Used for the WhatsApp floating button.</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Profile Picture --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-image me-2" style="color:#00d9ff;"></i>Profile Picture</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="d-flex align-items-center gap-4 flex-wrap">
                            <div>
                                <img id="preview"
                                     @if(isset($account) && $account->image)
                                         src="{{ config('app.storage_url') }}{{ $account->image }}"
                                     @else
                                         src=""
                                     @endif
                                     class="rounded-circle border shadow-sm"
                                     style="width:110px; height:110px; object-fit:cover; @if(!isset($account) || !$account->image) display:none; @endif">
                                <div id="previewPlaceholder"
                                     @if(isset($account) && $account->image) style="display:none;" @endif
                                     class="rounded-circle d-inline-flex align-items-center justify-content-center border shadow-sm"
                                     style="width:110px; height:110px; background:#f1f5f9; color:#94a3b8; font-size:2.5rem;">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div>
                                <input type="file" accept="image/*" id="image" name="image"
                                       class="form-control" onchange="previewImage(event)">
                                <div class="form-text mt-1">Recommended: Square image, at least 200x200px.</div>
                                @if(isset($account) && $account->image)
                                    <div class="mt-2">
                                        <button type="button" onclick="confirmDeleteImage()" class="btn btn-sm btn-outline-danger rounded-3">
                                            <i class="bi bi-trash3 me-1"></i> Delete Image
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social Links --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-share me-2" style="color:#00d9ff;"></i>Social Links</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="github" class="form-label fw-medium"><i class="bi bi-github me-1"></i> GitHub</label>
                                <input type="url" id="github" name="github" class="form-control"
                                       value="{{ $account->github ?? '' }}" placeholder="https://github.com/username">
                            </div>
                            <div class="col-md-6">
                                <label for="linkedin" class="form-label fw-medium"><i class="bi bi-linkedin me-1" style="color:#0a66c2;"></i> LinkedIn</label>
                                <input type="url" id="linkedin" name="linkedin" class="form-control"
                                       value="{{ $account->linkedin ?? '' }}" placeholder="https://linkedin.com/in/username">
                            </div>
                            <div class="col-md-6">
                                <label for="facebook" class="form-label fw-medium"><i class="bi bi-facebook me-1" style="color:#1877f2;"></i> Facebook</label>
                                <input type="url" id="facebook" name="facebook" class="form-control"
                                       value="{{ $account->facebook ?? '' }}" placeholder="https://facebook.com/username">
                            </div>
                            <div class="col-md-6">
                                <label for="instagram" class="form-label fw-medium"><i class="bi bi-instagram me-1" style="color:#E4405F;"></i> Instagram</label>
                                <input type="url" id="instagram" name="instagram" class="form-control"
                                       value="{{ $account->instagram ?? '' }}" placeholder="https://instagram.com/username">
                            </div>
                            <div class="col-md-6">
                                <label for="twitter" class="form-label fw-medium"><i class="bi bi-twitter-x me-1"></i> Twitter / X</label>
                                <input type="url" id="twitter" name="twitter" class="form-control"
                                       value="{{ $account->twitter ?? '' }}" placeholder="https://twitter.com/username">
                            </div>
                            <div class="col-md-6">
                                <label for="youtube" class="form-label fw-medium"><i class="bi bi-youtube me-1 text-danger"></i> YouTube</label>
                                <input type="url" id="youtube" name="youtube" class="form-control"
                                       value="{{ $account->youtube ?? '' }}" placeholder="https://youtube.com/@channel">
                            </div>
                            <div class="col-12 mt-2 mb-1">
                                <hr class="m-0 opacity-25">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-medium text-muted small mb-2"><i class="bi bi-briefcase me-1"></i> Freelance Profiles</label>
                            </div>
                            <div class="col-md-6">
                                <label for="fiverr" class="form-label fw-medium"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1em;height:1em;vertical-align:middle;margin-right:0.25rem"><rect width="24" height="24" rx="5" fill="#1DBF73"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="14" font-family="Arial,sans-serif">f</text></svg> Fiverr</label>
                                <input type="url" id="fiverr" name="fiverr" class="form-control"
                                       value="{{ $account->fiverr ?? '' }}" placeholder="https://fiverr.com/username">
                            </div>
                            <div class="col-md-6">
                                <label for="upwork" class="form-label fw-medium"><i class="fab fa-upwork me-1" style="color:#6FDA44;"></i> Upwork</label>
                                <input type="url" id="upwork" name="upwork" class="form-control"
                                       value="{{ $account->upwork ?? '' }}" placeholder="https://upwork.com/freelancers/username">
                            </div>
                            <div class="col-md-6">
                                <label for="freelancer" class="form-label fw-medium"><i class="fas fa-user-tie me-1" style="color:#29B2FE;"></i> Freelancer</label>
                                <input type="url" id="freelancer" name="freelancer" class="form-control"
                                       value="{{ $account->freelancer ?? '' }}" placeholder="https://freelancer.com/u/username">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CV Upload --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-bottom-0 pt-3 px-4">
                        <h6 class="fw-bold mb-0"><i class="bi bi-file-earmark-pdf me-2" style="color:#00d9ff;"></i>CV / Resume</h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <input type="file" accept=".pdf,.doc,.docx" id="cv" name="cv" class="form-control">
                        <div class="form-text mt-1">Maximum 5MB. Accepted: PDF, DOC, DOCX.</div>
                        @if(isset($account) && $account->cv)
                            <div class="mt-3 d-flex align-items-center gap-3 flex-wrap">
                                <a href="{{ config('app.storage_url') }}{{ $account->cv }}"
                                   target="_blank" class="btn btn-sm btn-outline-primary rounded-3 px-3">
                                    <i class="bi bi-eye me-1"></i> View Current CV
                                </a>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remove_cv" id="removeCv" value="1">
                                    <label class="form-check-label text-danger small" for="removeCv">Remove existing CV</label>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.account.index') }}" class="btn btn-light border rounded-3 px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-5" style="background:#00d9ff; border-color:#00d9ff;">
                        <i class="bi bi-check-circle me-1"></i> Update Profile
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

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
function confirmDeleteImage() {
    Swal.fire({
        title: 'Delete Profile Picture?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: '<i class="bi bi-trash3 me-1"></i> Yes, delete it!',
        cancelButtonText: '<i class="bi bi-x-lg me-1"></i> Cancel',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-4',
            confirmButton: 'btn btn-danger rounded-3 px-4 py-2',
            cancelButton: 'btn btn-light border rounded-3 px-4 py-2',
        },
        buttonsStyling: false
    }).then(function(result) {
        if (result.isConfirmed) {
            document.getElementById('deleteImageForm').submit();
        }
    });
}
</script>

@endsection
