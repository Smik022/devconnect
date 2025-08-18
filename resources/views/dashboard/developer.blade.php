@extends('layouts.app')

@section('title', 'Developer Dashboard')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #0f1c3f, #13294d, #1a3660);
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }
    .dashboard-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    .dashboard-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #00ccff;
    }
    .dashboard-header p {
        font-size: 1rem;
        color: #b0e0ff;
    }
    .card-dashboard {
        background: rgba(255, 255, 255, 0.05);
        border: none;
        border-radius: 15px;
        color: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-dashboard:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 204, 255, 0.5);
    }
    .card-header-dashboard {
        font-weight: 600;
        font-size: 1.2rem;
        color: #00ccff;
        background: rgba(0, 0, 0, 0.2);
        border-radius: 12px 12px 0 0;
        text-align: center;
        padding: 0.8rem;
    }
    .btn-neon {
        border-radius: 12px;
        background: linear-gradient(90deg, #00ccff, #0055ff);
        border: none;
        font-weight: 600;
        color: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .btn-neon:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,204,255,0.5);
    }
    .badge-neon {
        background-color: #00ccff;
        color: #13294d;
        font-weight: 700;
    }
    a {
        color: #00ccff;
        text-decoration: none;
    }
    a:hover {
        color: #00ffea;
    }
</style>

<div class="container py-4">

    <!-- Header -->
    <div class="dashboard-header">
        <h1>🚀 Developer Dashboard</h1>
        <p>Welcome, <strong>{{ $user->name }}</strong>! Your role: <strong>{{ $user->role }}</strong></p>
    </div>

  <!-- GitHub Card Redesigned -->
<div class="card-dashboard shadow-sm mb-4">
    <div class="card-header-dashboard d-flex align-items-center justify-content-center gap-2">
        <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="GitHub Logo" width="30" height="30">
        <span>GitHub Profile</span>
    </div>
    <div class="card-body">
        @if ($githubData)
        <div class="d-flex flex-column flex-md-row align-items-center gap-4">
            <!-- Avatar -->
            <div class="text-center">
                <img src="{{ $githubData['avatar_url'] }}" alt="Avatar" class="rounded-circle border border-info" width="130" height="130">
                <h5 class="mt-2" style="color:#00ccff;">{{ $githubData['login'] }}</h5>
            </div>

            <!-- Info -->
            <div class="flex-grow-1 text-center text-md-start">
                <p><strong>Name:</strong> {{ $githubData['name'] ?? 'N/A' }}</p>
                <p><strong>Bio:</strong> {{ $githubData['bio'] ?? 'N/A' }}</p>
                <p><strong>Company:</strong> {{ $githubData['company'] ?? 'N/A' }}</p>
                <p><strong>Location:</strong> {{ $githubData['location'] ?? 'N/A' }}</p>
                <p><strong>Blog:</strong>
                    @if ($githubData['blog'])
                        <a href="{{ $githubData['blog'] }}" target="_blank">{{ $githubData['blog'] }}</a>
                    @else N/A @endif
                </p>
                <p><strong>Twitter:</strong>
                    @if ($githubData['twitter_username'])
                        <a href="https://twitter.com/{{ $githubData['twitter_username'] }}" target="_blank">
                            @{{ $githubData['twitter_username'] }}
                        </a>
                    @else N/A @endif
                </p>
                <div class="d-flex gap-3 flex-wrap mt-2">
                    <span class="badge badge-neon">Repos: {{ $githubData['public_repos'] }}</span>
                    <span class="badge badge-neon">Followers: {{ $githubData['followers'] }}</span>
                    <span class="badge badge-neon">Following: {{ $githubData['following'] }}</span>
                </div>
                <p class="mt-2"><strong>Joined:</strong> {{ date('F j, Y', strtotime($githubData['created_at'])) }}</p>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="{{ $githubData['html_url'] }}" class="btn btn-neon btn-lg" target="_blank">
                <i class="bi bi-github"></i> View on GitHub
            </a>
        </div>
        @else
        <div class="alert alert-danger text-center mt-3">
            Please update your GitHub link in
            <a href="{{ route('developer.profile.edit') }}" class="alert-link">Edit Profile</a> to fetch your GitHub data.
        </div>
        @endif
    </div>
</div>


    <!-- Quick Links -->
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('employers.search') }}" class="btn btn-neon w-100 py-3">🔍 Explore Employers</a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('jobposts.index') }}" class="btn btn-neon w-100 py-3">💼 Browse Jobs</a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('wishlist.index') }}" class="btn btn-neon w-100 py-3">
                ❤️ My Wishlist 
                @if(isset($wishlistCount) && $wishlistCount > 0)
                    <span class="badge badge-neon ms-1">{{ $wishlistCount }}</span>
                @endif
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ url('/tasks') }}" class="btn btn-neon w-100 py-3">📋 View My Tasks</a>
        </div>
    </div>

    <!-- Footer Buttons -->
    <div class="d-flex justify-content-between mt-4 flex-wrap gap-2">
        <a href="{{ route('developer.profile.edit') }}" class="btn btn-outline-light">✏️ Manage Portfolio</a>
        <a href="{{ route('home') }}" class="btn btn-outline-light">🏠 Go to Home</a>

        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</div>
@endsection
