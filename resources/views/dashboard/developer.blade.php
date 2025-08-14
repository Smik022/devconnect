<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Developer Dashboard - DevConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="text-primary">Developer Dashboard</h1>
            <p>Welcome, <strong>{{ $user->name }}</strong>!</p>
            <p class="text-muted">Your role: {{ $user->role }}</p>
        </div>

        <hr>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">GitHub Profile Details</h4>
            </div>
            <div class="card-body">
                @if ($githubData)
                    <div class="text-center mb-3">
                        <img src="{{ $githubData['avatar_url'] }}" alt="Avatar" class="rounded-circle" width="120" height="120">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Username:</strong> {{ $githubData['login'] }}</p>
                            <p><strong>Name:</strong> {{ $githubData['name'] ?? 'N/A' }}</p>
                            <p><strong>Bio:</strong> {{ $githubData['bio'] ?? 'N/A' }}</p>
                            <p><strong>Company:</strong> {{ $githubData['company'] ?? 'N/A' }}</p>
                            <p><strong>Location:</strong> {{ $githubData['location'] ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Blog:</strong>
                                @if ($githubData['blog'])
                                    <a href="{{ $githubData['blog'] }}" target="_blank">{{ $githubData['blog'] }}</a>
                                @else
                                    N/A
                                @endif
                            </p>
                            <p><strong>Twitter:</strong>
                                @if ($githubData['twitter_username'])
                                    <a href="https://twitter.com/{{ $githubData['twitter_username'] }}" target="_blank">
                                        @{{ $githubData['twitter_username'] }}
                                    </a>
                                @else
                                    N/A
                                @endif
                            </p>
                            <p><strong>Public Repos:</strong> {{ $githubData['public_repos'] }}</p>
                            <p><strong>Followers:</strong> {{ $githubData['followers'] }}</p>
                            <p><strong>Following:</strong> {{ $githubData['following'] }}</p>
                            <p><strong>Joined GitHub:</strong> {{ date('F j, Y', strtotime($githubData['created_at'])) }}</p>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ $githubData['html_url'] }}" class="btn btn-outline-primary" target="_blank">
                            View GitHub Profile
                        </a>
                    </div>
                @else
                    <div class="alert alert-danger text-center">
                        Please update your GitHub link in
                        <a href="{{ route('developer.profile.edit') }}" class="alert-link">Edit Profile</a>
                        to fetch your GitHub data.
                    </div>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-center mb-4 gap-3">
            <a href="{{ route('employers.search') }}" class="btn btn-outline-primary btn-lg rounded-pill me-2">
                <i class="bi bi-search"></i> Explore Employer Directory! 🔍
            </a>
            <a href="{{ route('jobposts.index') }}" class="btn btn-outline-success btn-lg rounded-pill me-2">
                <i class="fas fa-briefcase"></i> Browse Jobs 🔍
            </a>
            <a href="{{ route('wishlist.index') }}" class="btn btn-outline-danger btn-lg rounded-pill">
                <i class="fas fa-heart"></i> My Wishlist 
                @if(isset($wishlistCount) && $wishlistCount > 0)
                    <span class="badge bg-danger ms-1">{{ $wishlistCount }}</span>
                @endif
            </a>
        </div>


        <div class="d-flex justify-content-between">
            <a href="{{ route('developer.profile.edit') }}" class="btn btn-secondary">✏️ Manage Portfolio</a>
            <a href="{{ route('home') }}" class="btn btn-outline-dark">🏠 Go to Home</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
