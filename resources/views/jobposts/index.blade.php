<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Job Listings - DevConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .wishlist-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .wishlist-btn:hover {
            transform: scale(1.1);
        }
        .wishlist-btn.active {
            color: #dc3545;
        }
        .wishlist-btn:not(.active) {
            color: #6c757d;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">DevConnect</a>
        <div>
            @auth
            @if(auth()->user()->role === 'Developer')
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light me-2">Dashboard</a>
                <a href="{{ route('wishlist.index') }}" class="btn btn-outline-light me-2">
                    <i class="fas fa-heart"></i> My Wishlist
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light">Back to Employer Dashboard</a>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
        @endauth
        </div>
    </div>
</nav>

<div class="container">
    <h1 class="mb-4">All Jobs</h1>

    @if ($jobs->count())
        <div class="row gy-4">
            @foreach($jobs as $job)
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title">{{ $job->title }}</h5>
                                @auth
                                    @if(auth()->user()->role === 'Developer')
                                        <button class="btn btn-sm wishlist-btn {{ $job->wishlists->where('user_id', auth()->id())->count() > 0 ? 'active' : '' }}" 
                                                onclick="toggleWishlist({{ $job->id }}, this)">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    @endif
                                @endauth
                            </div>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $job->company_name }}</h6>
                            <p class="mb-1"><strong>Category:</strong> {{ $job->category }}</p>
                            <p class="mb-1"><strong>Location:</strong> {{ $job->location }}</p>
                            <p class="mb-1"><strong>Type:</strong> {{ $job->job_type }}</p>
                            <p class="mb-1"><strong>Salary:</strong> {{ $job->salary }}</p>
                            <p class="card-text mt-3">{{ Str::limit($job->description, 150, '...') }}</p>
                            <div class="mt-3">
                                <a href="{{ route('jobposts.show', $job->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $jobs->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info">No job posts found.</div>
    @endif
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleWishlist(jobId, button) {
            fetch(`/wishlist/${jobId}/toggle`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.action === 'added') {
                    button.classList.add('active');
                    button.style.color = '#dc3545';
                } else {
                    button.classList.remove('active');
                    button.style.color = '#6c757d';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
