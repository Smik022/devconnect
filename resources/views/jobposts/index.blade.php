<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Job Listings - DevConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">DevConnect</a>
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-light">Back to Employer Dashboard</a>
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
                            <h5 class="card-title">{{ $job->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $job->company_name }}</h6>
                            <p class="mb-1"><strong>Category:</strong> {{ $job->category }}</p>
                            <p class="mb-1"><strong>Location:</strong> {{ $job->location }}</p>
                            <p class="mb-1"><strong>Type:</strong> {{ $job->job_type }}</p>
                            <p class="mb-1"><strong>Salary:</strong> {{ $job->salary }}</p>
                            <p class="card-text mt-3">{{ Str::limit($job->description, 150, '...') }}</p>
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
</body>
</html>
