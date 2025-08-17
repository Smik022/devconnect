<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Wishlist - DevConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .job-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .job-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        body, .container, .row, .card, .job-card {
            border: none !important;           
            box-shadow: none !important;       
            background-color: transparent !important; 
        }


        .card {
            border: none !important;
            box-shadow: none !important;
            background-color: transparent !important;
        }


    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">DevConnect</a>
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light me-2">Dashboard</a>
                <a href="{{ route('jobposts.index') }}" class="btn btn-outline-light me-2">Browse Jobs</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">
                <i class="fas fa-heart text-danger me-2"></i>My Wishlist
            </h1>
            <a href="{{ route('jobposts.index') }}" class="btn btn-primary">
                <i class="fas fa-search me-2"></i>Browse More Jobs
            </a>
        </div>

        @if($wishlists->count() > 0)
            <div class="row gy-4">
                @foreach($wishlists as $wishlist)
                    <div class="col-md-6 col-lg-4">
                        <div class="card job-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-1">{{ $wishlist->jobPost->title }}</h5>
                                    <button class="wishlist-btn active" 
                                            onclick="removeFromWishlist({{ $wishlist->jobPost->id }}, this)">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                                
                                <h6 class="card-subtitle mb-2 text-muted">{{ $wishlist->jobPost->company_name }}</h6>
                                
                                <div class="mb-3">
                                    <span class="badge bg-primary me-1">{{ $wishlist->jobPost->category }}</span>
                                    <span class="badge bg-secondary me-1">{{ $wishlist->jobPost->job_type }}</span>
                                    <span class="badge bg-info">{{ $wishlist->jobPost->location }}</span>
                                </div>
                                
                                <p class="card-text text-muted mb-3">
                                    <strong>Salary:</strong> ${{ number_format($wishlist->jobPost->salary) }}
                                </p>
                                
                                <p class="card-text">
                                    {{ Str::limit($wishlist->jobPost->description, 120, '...') }}
                                </p>
                                
                                <div class="mt-auto">
                                    <a href="{{ route('jobposts.show', $wishlist->jobPost->id) }}" 
                                       class="btn btn-outline-primary btn-sm w-100">
                                        <i class="fas fa-eye me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <small>Posted {{ $wishlist->jobPost->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-heart-broken fa-4x text-muted mb-4"></i>
                <h3 class="text-muted mb-3">Your wishlist is empty</h3>
                <p class="text-muted mb-4">
                    Start exploring jobs and add them to your wishlist by clicking the heart icon.
                </p>
                <a href="{{ route('jobposts.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-search me-2"></i>Browse Jobs
                </a>
            </div>
        @endif
    </div>

    <!-- <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© 2025 DevConnect. All rights reserved.</p>
    </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function removeFromWishlist(jobId, button) {
            if (confirm('Remove this job from your wishlist?')) {
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
                    if (data.action === 'removed') {
                        // Remove the card from the DOM
                        const card = button.closest('.col-md-6, .col-lg-4');
                        card.style.animation = 'fadeOut 0.3s ease-out';
                        setTimeout(() => {
                            card.remove();
                            
                            // Check if no more wishlist items
                            const remainingCards = document.querySelectorAll('.job-card');
                            if (remainingCards.length === 0) {
                                location.reload(); // Reload to show empty state
                            }
                        }, 300);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while removing from wishlist.');
                });
            }
        }

        // Add fadeOut animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeOut {
                from { opacity: 1; transform: scale(1); }
                to { opacity: 0; transform: scale(0.9); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
