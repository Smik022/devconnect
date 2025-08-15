<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Employer Dashboard - DevConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">DevConnect</a>
            <div class="d-flex">
                <a href="{{ url('/tasks') }}" class="btn btn-outline-light ms-3" style="border-radius: 5px; font-size: 18px;">
                TaskBoard
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light ms-3" style="border-radius: 5px;">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="mb-4">Employer Dashboard</h1>

        <p>Welcome, <strong>{{ $user->name }}</strong>!</p>
        <p>Your role: <strong>{{ $user->role }}</strong></p>

        <div class="mt-4">
            <a href="{{ route('jobposts.create') }}" class="btn btn-success me-2 mb-2">➕ Create a Job Post</a>
            <a href="{{ route('jobposts.index') }}" class="btn btn-info me-2 mb-2">📋 View All Job Posts</a>
            <a href="{{ route('employer.applications') }}" class="btn btn-warning me-2 mb-2">
                <i class="fas fa-clipboard-list me-2"></i>Job Applications
                @if(isset($jobCount) && $jobCount > 0)
                    <span class="badge bg-light text-dark ms-1">{{ $jobCount }}</span>
                @endif
            </a>
        </div>

        <div class="text-center mt-4">
            <a href="{{ url('/tasks') }}" class="btn btn-info" style="border-radius: 50px; padding: 10px 30px; font-size: 18px;">
                Go to TaskBoard 
            </a>
        </div>
    </div>

</body>
</html>
