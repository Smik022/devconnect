@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="mb-4">Explore Employers by Job Postings</h2>
            <p class="lead">Find job opportunities based on your preferred job title, skills, and location.</p>
        </div>
    </div>

    <!-- Search Form Section -->
     <!-- abcd-->
     
    <div class="row justify-content-center mb-5">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Search for Employers</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('employers.search') }}">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="title" class="form-label">Job Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter job title" value="{{ request('title') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" name="location" id="location" class="form-control" placeholder="Enter location" value="{{ request('location') }}">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" name="company" id="company" class="form-control" placeholder="Enter company name" value="{{ request('company') }}">
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success w-100">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Displaying Search Results -->
    <div class="row">
        @forelse($jobPosts as $jobPost)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-lg border-0">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $jobPost->title }}</h5>
                        <p class="card-text"><strong>Employer:</strong> {{ $jobPost->user->name }}</p>
                        <p class="card-text"><strong>Company:</strong> {{ $jobPost->company_name }}</p>
                        <p class="card-text"><strong>Location:</strong> {{ $jobPost->location }}</p>
                        <p class="card-text"><strong>Salary:</strong> 
                            @if($jobPost->salary && $jobPost->salary > 0)
                                ${{ number_format((float)$jobPost->salary, 0, '.', ',') }}
                            @else
                                Salary negotiable
                            @endif
                        </p>

                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-outline-primary w-100">View Job Post</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No employers found matching your search criteria.</p>
        @endforelse
    </div>
</div>
@endsection
