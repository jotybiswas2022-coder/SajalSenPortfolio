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

/* ===== Account Edit — Cyber Admin Upgrade ===== */
.account-edit-page {
    --ae-cyan: #00d9ff;
    --ae-cyan-d: #00a2c9;
    --ae-green: #00ff88;
    --ae-slate: #1e293b;
    --ae-muted: #64748b;
}
.ae-page-header {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #0b1220 100%);
    border: 1px solid rgba(0, 217, 255, 0.15);
    border-radius: 18px;
    padding: 22px 24px;
    overflow: hidden;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
}
.ae-page-header::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 2px;
    background: linear-gradient(90deg, transparent, var(--ae-green), var(--ae-cyan), transparent);
    background-size: 60% 100%; background-repeat: no-repeat;
    animation: aeSweep 4s linear infinite;
}
.ae-page-header::after {
    content: ''; position: absolute; top: -40px; right: -40px;
    width: 160px; height: 160px; border-radius: 50%;
    background: radial-gradient(circle, rgba(0,217,255,0.15), transparent 70%);
}
@keyframes aeSweep { 0% { background-position: -60% 0; } 100% { background-position: 160% 0; } }
.ae-page-header .ae-title {
    position: relative; z-index: 1;
    color: #fff; font-weight: 800; font-size: 1.4rem;
    display: flex; align-items: center; gap: 0.7rem;
}
.ae-page-header .ae-sub {
    position: relative; z-index: 1;
    color: rgba(226, 232, 240, 0.75); font-size: 0.85rem; margin: 0;
}
.ae-badge {
    display: inline-flex; align-items: center; gap: 0.4rem;
    background: rgba(0, 255, 136, 0.12);
    color: var(--ae-green);
    border: 1px solid rgba(0, 255, 136, 0.3);
    font-size: 0.68rem; font-weight: 700; letter-spacing: 0.5px;
    padding: 0.25rem 0.7rem; border-radius: 50px; text-transform: uppercase;
}
.ae-badge .ae-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--ae-green); animation: aeDot 1.8s ease-out infinite; }
@keyframes aeDot { 0% { box-shadow: 0 0 0 0 rgba(0,255,136,0.6);} 100% { box-shadow: 0 0 0 9px rgba(0,255,136,0);} }

.ae-card {
    background: var(--admin-card-bg);
    border: 1px solid var(--admin-border);
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(0,0,0,0.05);
    transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
    position: relative;
}
.ae-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 16px 44px rgba(0,217,255,0.10);
    border-color: rgba(0,217,255,0.35);
}
.ae-card .ae-card-head {
    display: flex; align-items: center; justify-content: space-between; gap: 1rem;
    padding: 1rem 1.5rem;
    background: linear-gradient(135deg, var(--admin-card-bg-2), rgba(0,217,255,0.05));
    border-bottom: 1px solid var(--admin-border);
    position: relative;
}
.ae-card .ae-card-head::after {
    content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
    background: linear-gradient(180deg, var(--ae-cyan), var(--ae-green));
}
.ae-card .ae-card-head .ae-head-title {
    font-weight: 700; color: var(--admin-text); font-size: 1rem; margin: 0;
    display: flex; align-items: center; gap: 0.6rem;
}
.ae-card .ae-card-head .ae-head-title i { color: var(--ae-cyan); }
.ae-card .ae-card-head .ae-head-tag {
    font-size: 0.68rem; color: var(--ae-cyan); font-weight: 600;
    background: rgba(0,217,255,0.1); padding: 0.2rem 0.6rem; border-radius: 50px;
}
.ae-card .ae-card-body { padding: 1.5rem; }

.ae-form-label {
    font-weight: 600; font-size: 0.82rem; color: var(--admin-text); margin-bottom: 0.4rem;
    display: flex; align-items: center; gap: 0.3rem;
}
.ae-input-modern {
    border: 1.5px solid var(--admin-border);
    border-radius: 10px;
    padding: 0.62rem 1rem;
    font-size: 0.9rem;
    transition: border-color .2s, box-shadow .2s;
    background: var(--admin-bg-soft);
    color: var(--admin-text);
}
.ae-input-modern:focus {
    border-color: var(--ae-cyan);
    box-shadow: 0 0 0 3px rgba(0,217,255,0.14);
    outline: none;
    background: var(--admin-bg-soft);
    color: var(--admin-text);
}
.ae-avatar-wrap {
    position: relative;
    width: 118px; height: 118px; flex-shrink: 0;
    border-radius: 50%;
    padding: 4px;
    background: linear-gradient(135deg, var(--ae-cyan), var(--ae-green));
}
.ae-avatar-wrap .ae-avatar-inner {
    width: 100%; height: 100%; border-radius: 50%; overflow: hidden;
    background: var(--admin-bg-soft); display: flex; align-items: center; justify-content: center;
    border: 3px solid var(--admin-card-bg);
}
.ae-avatar-wrap img, .ae-avatar-wrap .ae-avatar-ph {
    width: 100%; height: 100%; object-fit: cover;
}
.ae-avatar-wrap .ae-avatar-ph { color: var(--admin-text-muted); font-size: 2.6rem; display: flex; align-items: center; justify-content: center; }
.ae-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: 0.45rem;
    border-radius: 10px; font-weight: 600; font-size: 0.85rem;
    transition: all .2s ease; border: none; cursor: pointer;
}
.ae-btn-primary {
    background: linear-gradient(135deg, var(--ae-cyan), var(--ae-cyan-d));
    color: #fff; padding: 0.7rem 1.8rem;
    box-shadow: 0 6px 20px rgba(0,217,255,0.3);
}
.ae-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,217,255,0.42); color: #fff; }
.ae-btn-ghost {
    background: var(--admin-card-bg-2); color: var(--admin-text); border: 1.5px solid var(--admin-border);
    padding: 0.7rem 1.4rem;
}
.ae-btn-ghost:hover { border-color: var(--ae-cyan); color: var(--ae-cyan); background: rgba(0,217,255,0.08); }
.ae-divider { border: 0; border-top: 1px dashed var(--admin-border); opacity: 1; margin: 1.2rem 0; }
.ae-note { font-size: 0.72rem; color: var(--admin-text-muted); margin-top: 0.35rem; }

@media (max-width: 767.98px) {
    .ae-page-header { padding: 16px 16px; }
    .ae-card .ae-card-body { padding: 1rem; }
}
</style>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-modern mx-3 mt-2" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container-fluid py-3 account-edit-page">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            {{-- Header --}}
            <div class="ae-page-header mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-person-gear" style="font-size:1.5rem;color:#00d9ff;"></i>
                    </div>
                    <div class="d-flex flex-column align-items-start gap-1">
                        <div class="ae-title">Edit Account</div>
                        <p class="ae-sub">Update your profile details, social links and resume.</p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="ae-badge"><span class="ae-dot"></span> Profile Management</span>
                    <a href="{{ route('admin.account.index') }}" class="ae-btn ae-btn-ghost">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
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
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <h6 class="ae-head-title"><i class="bi bi-info-circle"></i>Basic Information</h6>
                        <span class="ae-head-tag">Identity</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label ae-form-label">Full Name</label>
                                <input type="text" id="name" name="name"
                                       class="form-control ae-input-modern"
                                       value="{{ $account->name ?? '' }}"
                                       placeholder="Enter your name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label ae-form-label">
                                    <i class="bi bi-envelope" style="color:#00d9ff;"></i> Email
                                </label>
                                <input type="email" id="email" name="email"
                                       class="form-control ae-input-modern"
                                       value="{{ $account->email ?? '' }}"
                                       placeholder="hello@example.com">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label ae-form-label">
                                    <i class="bi bi-whatsapp" style="color:#25D366;"></i> WhatsApp Number
                                </label>
                                <input type="text" id="phone" name="phone"
                                       class="form-control ae-input-modern"
                                       value="{{ $account->phone ?? '' }}"
                                       placeholder="+8801XXXXXXXXX">
                                <div class="form-text ae-note">Used for the WhatsApp floating button.</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Profile Picture --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <h6 class="ae-head-title"><i class="bi bi-image"></i>Profile Picture</h6>
                        <span class="ae-head-tag">Avatar</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="d-flex align-items-center gap-4 flex-wrap">
                            <div class="ae-avatar-wrap">
                                <div class="ae-avatar-inner">
                                    <img id="preview"
                                         @if(isset($account) && $account->image)
                                             src="{{ config('app.storage_url') }}{{ $account->image }}"
                                         @else
                                             src=""
                                         @endif
                                         @if(!isset($account) || !$account->image) style="display:none;" @endif
                                         alt="Profile preview">
                                    <div id="previewPlaceholder"
                                         @if(isset($account) && $account->image) style="display:none;" @endif
                                         class="ae-avatar-ph">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <input type="file" accept="image/*" id="image" name="image"
                                       class="form-control" onchange="previewImage(event)">
                                <div class="form-text ae-note">Recommended: Square image, at least 200x200px.</div>
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
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <h6 class="ae-head-title"><i class="bi bi-share"></i>Social Links</h6>
                        <span class="ae-head-tag">Connectivity</span>
                    </div>
                    <div class="ae-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="github" class="form-label ae-form-label"><i class="bi bi-github"></i> GitHub</label>
                                <input type="url" id="github" name="github" class="form-control ae-input-modern"
                                       value="{{ $account->github ?? '' }}" placeholder="https://github.com/username">
                            </div>
                            <div class="col-md-6">
                                <label for="linkedin" class="form-label ae-form-label"><i class="bi bi-linkedin" style="color:#0a66c2;"></i> LinkedIn</label>
                                <input type="url" id="linkedin" name="linkedin" class="form-control ae-input-modern"
                                       value="{{ $account->linkedin ?? '' }}" placeholder="https://linkedin.com/in/username">
                            </div>
                            <div class="col-md-6">
                                <label for="facebook" class="form-label ae-form-label"><i class="bi bi-facebook" style="color:#1877f2;"></i> Facebook</label>
                                <input type="url" id="facebook" name="facebook" class="form-control ae-input-modern"
                                       value="{{ $account->facebook ?? '' }}" placeholder="https://facebook.com/username">
                            </div>
                            <div class="col-md-6">
                                <label for="instagram" class="form-label ae-form-label"><i class="bi bi-instagram" style="color:#E4405F;"></i> Instagram</label>
                                <input type="url" id="instagram" name="instagram" class="form-control ae-input-modern"
                                       value="{{ $account->instagram ?? '' }}" placeholder="https://instagram.com/username">
                            </div>
                            <div class="col-md-6">
                                <label for="twitter" class="form-label ae-form-label"><i class="bi bi-twitter-x"></i> Twitter / X</label>
                                <input type="url" id="twitter" name="twitter" class="form-control ae-input-modern"
                                       value="{{ $account->twitter ?? '' }}" placeholder="https://twitter.com/username">
                            </div>
                            <div class="col-md-6">
                                <label for="youtube" class="form-label ae-form-label"><i class="bi bi-youtube text-danger"></i> YouTube</label>
                                <input type="url" id="youtube" name="youtube" class="form-control ae-input-modern"
                                       value="{{ $account->youtube ?? '' }}" placeholder="https://youtube.com/@channel">
                            </div>
                            <div class="col-12 mt-2 mb-1">
                                <hr class="ae-divider">
                            </div>
                            <div class="col-12">
                                <label class="form-label ae-form-label text-muted small mb-2"><i class="bi bi-briefcase"></i> Freelance Profiles</label>
                            </div>
                            <div class="col-md-6">
                                <label for="fiverr" class="form-label ae-form-label"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:1em;height:1em;vertical-align:middle;margin-right:0.25rem"><rect width="24" height="24" rx="5" fill="#1DBF73"/><text x="12" y="17" text-anchor="middle" fill="white" font-weight="700" font-size="14" font-family="Arial,sans-serif">f</text></svg> Fiverr</label>
                                <input type="url" id="fiverr" name="fiverr" class="form-control ae-input-modern"
                                       value="{{ $account->fiverr ?? '' }}" placeholder="https://fiverr.com/username">
                            </div>
                            <div class="col-md-6">
                                <label for="upwork" class="form-label ae-form-label"><i class="fab fa-upwork me-1" style="color:#6FDA44;"></i> Upwork</label>
                                <input type="url" id="upwork" name="upwork" class="form-control ae-input-modern"
                                       value="{{ $account->upwork ?? '' }}" placeholder="https://upwork.com/freelancers/username">
                            </div>
                            <div class="col-md-6">
                                <label for="freelancer" class="form-label ae-form-label"><i class="fas fa-user-tie me-1" style="color:#29B2FE;"></i> Freelancer</label>
                                <input type="url" id="freelancer" name="freelancer" class="form-control ae-input-modern"
                                       value="{{ $account->freelancer ?? '' }}" placeholder="https://freelancer.com/u/username">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CV Upload --}}
                <div class="ae-card mb-4">
                    <div class="ae-card-head">
                        <h6 class="ae-head-title"><i class="bi bi-file-earmark-pdf"></i>CV / Resume</h6>
                        <span class="ae-head-tag">Credentials</span>
                    </div>
                    <div class="ae-card-body">
                        <input type="file" accept=".pdf,.doc,.docx" id="cv" name="cv" class="form-control">
                        <div class="form-text ae-note">Maximum 5MB. Accepted: PDF, DOC, DOCX.</div>
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
                    <a href="{{ route('admin.account.index') }}" class="ae-btn ae-btn-ghost">
                        <i class="bi bi-x-lg"></i> Cancel
                    </a>
                    <button type="submit" class="ae-btn ae-btn-primary">
                        <i class="bi bi-check-circle"></i> Update Profile
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
        preview.style.display = 'block';
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
