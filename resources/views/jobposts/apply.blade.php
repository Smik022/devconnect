<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Apply for {{ $job->title }} - DevConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">DevConnect</a>
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light me-2">Dashboard</a>
                <a href="{{ route('wishlist.index') }}" class="btn btn-outline-light me-2">
                    <i class="fas fa-heart"></i> My Wishlist
                </a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title mb-3">Apply for {{ $job->title }}</h2>
                        <h6 class="text-muted mb-4">{{ $job->company_name }}</h6>

                        <div class="bg-light p-3 rounded mb-4">
                            <h6 class="mb-3">Job Summary:</h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Category:</strong> {{ $job->category }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Job Type:</strong> {{ $job->job_type }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Location:</strong> {{ $job->location }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Salary:</strong> ${{ number_format($job->salary) }}
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('jobposts.apply.store', $job->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="proposal" class="form-label">Why do you want this job?</label>
                                <textarea 
                                    class="form-control @error('proposal') is-invalid @enderror" 
                                    id="proposal" 
                                    name="proposal" 
                                    rows="8" 
                                    placeholder="Write your proposal here... Explain why you're interested in this position, your relevant experience, and how you can contribute to the company."
                                    required
                                >{{ old('proposal') }}</textarea>
                                @error('proposal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    Be specific about your skills and experience that match this job requirement.
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Application
                                </button>
                                <a href="{{ route('jobposts.show', $job->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Job
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
