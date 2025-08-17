<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $job->title }} - DevConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <style>
        .wishlist-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
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
        .status-badge {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }
    </style>
</head>
<body class="bg-light">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">DevConnect</a>
            <div class="d-flex align-items-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-light me-2">Dashboard</a>
                    @if(auth()->user()->role === 'Developer')
                        <a href="{{ route('wishlist.index') }}" class="btn btn-outline-light me-2">
                            <i class="fas fa-heart"></i> My Wishlist
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h1 class="card-title mb-1">{{ $job->title }}</h1>
                                <h5 class="text-muted mb-3">{{ $job->company_name }}</h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary me-2">{{ $job->category }}</span>
                                @auth
                                    @if(auth()->user()->role === 'Developer')
                                        <button class="wishlist-btn {{ $isWishlisted ? 'active' : '' }}" 
                                                data-job-id="{{ $job->id }}" 
                                                onclick="toggleWishlist({{ $job->id }})">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Job Description</h5>
                            <div class="bg-light p-3 rounded">
                                {{ $job->description }}
                            </div>
                        </div>
                        <div class="mb-4">
                            <h5>Job Location</h5>
                            <div id="map" style="width: 100%; height: 400px;"></div> <!-- Map container -->
                        </div>
                        <div id="nearby-jobs">
                            <h4>Nearby Jobs:</h4>
                            <ul id="job-list"></ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Job Details</h5>
                        <div class="mb-3">
                            <strong>Employer:</strong> {{ $job->user->name }}
                        </div>
                        <div class="mb-3">
                            <strong>Job Type:</strong> {{ $job->job_type }}
                        </div>
                        <div class="mb-3">
                            <strong>Location:</strong> {{ $job->location }}
                        </div>
                        <div class="mb-3">
                            <strong>Salary:</strong> ${{ number_format($job->salary) }}
                        </div>
                        <div class="mb-4">
                            <strong>Posted:</strong> {{ $job->created_at->format('M d, Y') }}
                        </div>

                        @auth
                            @if(auth()->user()->role === 'Developer')
                                @if($hasApplied)
                                    <button class="btn btn-success w-100 mb-2" disabled>
                                        <i class="fas fa-check me-2"></i>Already Applied
                                    </button>
                                    <small class="text-muted d-block text-center">
                                        You have already submitted an application for this job.
                                    </small>
                                @else
                                    <a href="{{ route('jobposts.apply', $job->id) }}" class="btn btn-primary w-100">
                                        <i class="fas fa-paper-plane me-2"></i>Apply Now
                                    </a>
                                @endif
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Login to Apply
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© 2025 DevConnect. All rights reserved.</p>
    </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleWishlist(jobId) {
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
                const btn = document.querySelector(`[data-job-id="${jobId}"]`);
                if (data.action === 'added') {
                    btn.classList.add('active');
                    btn.style.color = '#dc3545';
                } else {
                    btn.classList.remove('active');
                    btn.style.color = '#6c757d';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
    <script>
        var jobLat = {{ $job->latitude }};  
        var jobLon = {{ $job->longitude }};

        var map = L.map('map').setView([jobLat, jobLon], 13); 
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        
        L.marker([jobLat, jobLon]).addTo(map)
            .bindPopup('<strong>{{ $job->title }}</strong><br>{{ $job->location }}')
            .openPopup(); 
    </script>

    <script>
        var jobs = @json($jobs);  
        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLat = position.coords.latitude;
                    var userLon = position.coords.longitude;
                    console.log("User Location: " + userLat + ", " + userLon);

                    filterJobsByDistance(userLat, userLon);
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        getUserLocation();

        function filterJobsByDistance(userLat, userLon) {
            var nearbyJobs = [];

            jobs.forEach(function(job) {
                var distance = calculateDistance(userLat, userLon, job.latitude, job.longitude);
                if (distance <= 50) {
                    nearbyJobs.push(job);
                }
            });

            console.log("Nearby Jobs: ", nearbyJobs);
            displayNearbyJobsList(nearbyJobs);
        }

        function calculateDistance(userLat, userLon, jobLat, jobLon) {
            var R = 6371;  
            var dLat = (jobLat - userLat) * Math.PI / 180;
            var dLon = (jobLon - userLon) * Math.PI / 180;
            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(userLat * Math.PI / 180) * Math.cos(jobLat * Math.PI / 180) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c; 
        }

        function displayNearbyJobsList(nearbyJobs) {
            var jobListContainer = document.getElementById('job-list');
            jobListContainer.innerHTML = '';  

            nearbyJobs.forEach(function(job) {
                var jobItem = document.createElement('li');
                jobItem.classList.add('job-item');
                jobItem.innerHTML = `<strong>${job.title}</strong> - ${job.location}`;
                jobListContainer.appendChild(jobItem);
            });
        }
    </script>

</body>
</html>
