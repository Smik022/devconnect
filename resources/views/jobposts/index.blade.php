<!DOCTYPE html>
<html>
<head>
    <title>Job Listings</title>
</head>
<body>
    <p><a href="{{ route('dashboard') }}">Back to Employer Dashboard</a></p>

    <h1>All Jobs</h1>

    @foreach($jobs as $job)
        <div style="border:1px solid #ccc; padding:10px; margin:10px;">
            <h2>{{ $job->title }}</h2>
            <p><strong>Company:</strong> {{ $job->company_name }}</p>
            <p><strong>Category:</strong> {{ $job->category }}</p>
            <p><strong>Location:</strong> {{ $job->location }}</p>
            <p><strong>Type:</strong> {{ $job->job_type }}</p>
            <p><strong>Salary:</strong> {{ $job->salary }}</p>
            <p>{{ $job->description }}</p>
        </div>
    @endforeach

    {{ $jobs->links() }}
</body>
</html>
