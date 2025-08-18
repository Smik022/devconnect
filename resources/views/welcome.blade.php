@extends('layouts.app')

@section('title', 'Welcome to DevConnect')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }
    .hero {
        min-height: 90vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 2rem 1rem;
    }
    .hero h1 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
    }
    .hero p {
        font-size: 1.1rem;
        max-width: 550px;
        margin-bottom: 1rem;
    }
    .section-title {
        text-align: center;
        margin: 2rem 0 1rem;
        font-size: 1.8rem;
        font-weight: bold;
    }
    .card {
        background: rgba(255, 255, 255, 0.05);
        border: none;
        border-radius: 15px;
        color: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.4);
    }
    .stats {
        display: flex;
        justify-content: center;
        gap: 2rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }
    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 1.5rem;
        min-width: 140px;
        text-align: center;
        transition: transform 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: #00d4ff;
    }
    .cta-section {
        text-align: center;
        margin: 3rem 0;
    }
</style>

<div class="container-fluid p-0">
    <!-- Hero Section -->
    <div class="hero">
        <h1>🚀 Welcome to <span class="text-primary">DevConnect</span></h1>
        <p>Your ultimate platform to connect developers, share ideas, and build the future together.</p>

        @auth
            <p class="mt-2">Hello, {{ auth()->user()->name }}! Jump into your 
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>.
            </p>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-outline-light">Logout</button>
            </form>
        @else
            <div class="mt-2">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Register</a>
            </div>
        @endauth
    </div>

    <!-- About Section -->
    <div class="container py-3">
        <h2 class="section-title">🌍 About DevConnect</h2>
        <p class="text-center mx-auto" style="max-width: 500px;">
            DevConnect is a hub where developers and employers come together. Collaborate on projects, learn new skills, and grow in a community of passionate tech enthusiasts.
        </p>
    </div>

    <!-- What We Do -->
    <div class="container py-3">
        <h2 class="section-title">💡 What We Do</h2>
        <div class="row g-3 justify-content-center">
            <div class="col-md-4">
                <div class="card p-3 h-100 text-center">
                    <h5>🤝 Networking</h5>
                    <p>Connect with developers worldwide and collaborate on exciting projects.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 h-100 text-center">
                    <h5>📚 Learning</h5>
                    <p>Access tutorials, resources, and mentorship programs to accelerate growth.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3 h-100 text-center">
                    <h5>🚀 Projects</h5>
                    <p>Work on real-world projects, contribute to open source, and showcase your skills.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="container py-3">
        <h2 class="section-title">📊 Our Achievements</h2>
        <div class="stats">
            <div class="stat-card">
                <div class="stat-number">5,000+</div>
                <div>Developers Onboarded</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">2,000+</div>
                <div>Employers Registered</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">10,000+</div>
                <div>Projects Collaborated</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">50+</div>
                <div>Countries Represented</div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="cta-section">
        <h2>✨ Ready to join the future of development?</h2>
        <a href="{{ route('register') }}" class="btn btn-lg btn-primary mt-2">Get Started</a>
    </div>
</div>
@endsection
