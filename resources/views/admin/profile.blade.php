@extends('admin.layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    body {
        background-color: #f8f9fa;
        color: #212529;
    }
    .card {
        background-color: #fff;
        color: #212529;
        border: none;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    .card-header {
        background-color: #563d7c;
        color: #f8f9fa;
        font-weight: 600;
        font-size: 1.4rem;
    }
    .avatar-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: #6f42c1;
        color: #fff;
        font-weight: 700;
        font-size: 34px;
        display: flex;
        justify-content: center;
        align-items: center;
        user-select: none;
        text-transform: uppercase;
        box-shadow: 0 0 8px rgba(111, 66, 193, 0.6);
        margin: 0 auto;
    }
    .profile-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #6f42c1;
        box-shadow: 0 0 10px rgba(111, 66, 193, 0.6);
        margin: 0 auto;
    }
    .badge-super {
        background-color: #198754;
        font-weight: 600;
        color: white;
    }
    .badge-regular {
        background-color: #6c757d;
        font-weight: 600;
        color: white;
    }
    p strong {
        color: #563d7c;
    }
    p i {
        color: #7952b3;
    }
    .btn-light {
        color: #563d7c;
        border-color: #563d7c;
    }
    .btn-light:hover {
        background-color: #563d7c;
        color: #fff;
    }
</style>

<div class="container mt-5">
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: @json(session('success')),
                iconColor: '#198754',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                didOpen: () => {
                    const timerBar = Swal.getTimerProgressBar();
                    if (timerBar) {
                        timerBar.style.background = '#0dcaf0';
                        timerBar.style.boxShadow = 'none';
                        timerBar.style.transition = 'width 0.3s ease';
                    }
                }
            });
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: @json(session('error')),
                iconColor: '#b02a37',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                didOpen: () => {
                    const timerBar = Swal.getTimerProgressBar();
                    if (timerBar) {
                        timerBar.style.background = '#0dcaf0';
                        timerBar.style.boxShadow = 'none';
                        timerBar.style.transition = 'width 0.3s ease';
                    }
                }
            });
        });
    </script>
    @endif

    @if ($admin)
    <div class="card shadow-sm mx-auto text-center" style="max-width: 700px;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i>Admin Profile</h4>
            <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="bi bi-pencil-square me-1"></i>Edit Profile
            </button>
        </div>
        <div class="card-body">
            @php
            function getInitials($name) {
            return strtoupper(substr(trim($name), 0, 1));
            }
            $avatarInitials = getInitials($admin->name);
            @endphp

            @if($admin->profile_photo_url)
            <img src="{{ $admin->profile_photo_url }}" alt="Profile Picture of {{ $admin->name }}" class="profile-img mb-3">
            @else
            <div class="avatar-circle mb-3" aria-label="Avatar with initials {{ $avatarInitials }}">                
                {{ $avatarInitials }}
            </div>
            @endif

            <div class="px-3">
                <p><i class="bi bi-person-fill me-2"></i><strong>Name:</strong> {{ $admin->name }}</p>
                <p><i class="bi bi-envelope-fill me-2"></i><strong>Email:</strong> {{ $admin->email }}</p>
                <p><i class="bi bi-phone-fill me-2"></i><strong>Phone:</strong> {{ $admin->phone ?? 'Not provided' }}</p>
                <p><i class="bi bi-star-fill me-2"></i><strong>Super Admin:</strong>
                    @if($admin->is_super)
                    <span class="badge badge-super">Yes</span>
                    @else
                    <span class="badge badge-regular">No</span>
                    @endif
                </p>
                <p><i class="bi bi-calendar-event-fill me-2"></i><strong>Joined:</strong> {{ $admin->created_at->format('F j, Y') }}</p>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('admin.profile.update') }}" class="modal-content" novalidate>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel"><i class="bi bi-pencil-square me-2"></i>Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $admin->name) }}">
                        @error('name')<div class="invalid-feedback d-block" style="color: #dc3545;          
                        font-weight: 600;        
                        font-size: 0.9rem;       
                        margin-top: 0.25rem;      
                        font-style: italic;">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $admin->email) }}">
                        @error('email')<div class="invalid-feedback d-block" style="color: #dc3545;          
                        font-weight: 600;        
                        font-size: 0.9rem;       
                        margin-top: 0.25rem;      
                        font-style: italic;">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $admin->phone) }}">
                        @error('phone')<div class="invalid-feedback d-block" style="color: #dc3545;          
                        font-weight: 600;        
                        font-size: 0.9rem;       
                        margin-top: 0.25rem;      
                        font-style: italic;">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3 form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="is_super" name="is_super" value="1" {{ old('is_super', $admin->is_super) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_super">Super Admin</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>

    @else
    <div class="alert alert-warning text-center">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> Admin profile data not available.
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editModal = new bootstrap.Modal(document.getElementById('editProfileModal'));
        editModal.show();
    });
</script>
@endif

@endsection
