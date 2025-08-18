@extends('layouts.app')

@section('title', 'Employer Dashboard - DevConnect')

@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #0f1c3f, #13294d, #1a3660);
        color: #fff;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .dashboard-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .dashboard-header p {
        margin-bottom: 0.5rem;
        color: #00ccff;
    }

    .card-dashboard {
        background: #1a2a50;
        border-radius: 20px;
        padding: 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-dashboard:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,204,255,0.5);
    }

    .btn-neon {
        background: linear-gradient(90deg, #00ccff, #0055ff);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-neon:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,204,255,0.5);
        color: #fff;
    }

    .badge-neon {
        background: #00ccff;
        color: #0f1c3f;
        font-weight: 600;
        padding: 0.5em 0.8em;
        border-radius: 12px;
    }

    .action-btns .btn {
        margin-bottom: 1rem;
    }

    .navbar-custom {
        background: linear-gradient(90deg, #0055ff, #00ccff);
    }

    .navbar-custom .navbar-brand {
        color: #fff;
        font-weight: 600;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">DevConnect</a>
        <div class="d-flex">
            <a href="{{ url('/tasks') }}" class="btn btn-neon me-2">
                TaskBoard 📋
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="dashboard-header">
        <div>
            <h1>Employer Dashboard</h1>
            <p>Welcome, <strong>{{ $user->name }}</strong> | Role: {{ $user->role }}</p>
        </div>
    </div>

    <!-- Quick Action Buttons -->
    <div class="row g-4 mb-4 action-btns">
        <div class="col-md-4">
            <a href="{{ route('jobposts.create') }}" class="btn-neon w-100">
                ➕ Create a Job Post
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('jobposts.index') }}" class="btn-neon w-100">
                📋 View All Job Posts
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('employer.applications') }}" class="btn-neon w-100">
                📝 Job Applications
                @if(isset($jobCount) && $jobCount > 0)
                    <span class="badge-neon ms-1">{{ $jobCount }}</span>
                @endif
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card-dashboard text-center">
                <h5>Total Job Posts</h5>
                <p class="fs-2 fw-bold">{{ $totalJobs ?? 50 }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-dashboard text-center">
                <h5>Total Applications</h5>
                <p class="fs-2 fw-bold">{{ $totalApplications ?? 15 }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-dashboard text-center">
                <h5>Active Tasks</h5>
                <p class="fs-2 fw-bold">{{ $activeTasks ?? 0 }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
