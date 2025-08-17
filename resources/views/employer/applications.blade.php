<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Job Applications - DevConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .status-badge {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }
        .status-pending { background-color: #ffc107; color: #000; }
        .status-accepted { background-color: #28a745; color: #fff; }
        .status-rejected { background-color: #dc3545; color: #fff; }
        .status-shortlisted { background-color: #17a2b8; color: #fff; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">DevConnect</a>
            <div class="d-flex">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light me-2">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">Employer Dashboard</h1>
        <p>Welcome, <strong>{{ auth()->user()->name }}</strong>!</p>
        <p>Your role: <strong>{{ auth()->user()->role }}</strong></p>

        <div class="mt-4 mb-4">
            <a href="{{ route('jobposts.create') }}" class="btn btn-success me-2 mb-2">➕ Create a Job Post</a>
            <a href="{{ route('jobposts.index') }}" class="btn btn-info me-2 mb-2">📋 View All Job Posts</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-clipboard-list me-2"></i>Job Applications
                </h5>
                <small>Manage applications for your posted jobs</small>
            </div>
            <div class="card-body">
                @if($jobPosts->count() > 0)
                    @foreach($jobPosts as $jobPost)
                        @if($jobPost->applications->count() > 0)
                            <div class="mb-4">
                                <h6 class="text-primary">{{ $jobPost->title }} - {{ $jobPost->company_name }}</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Job Title</th>
                                                <th>Applicant</th>
                                                <th>Status</th>
                                                <th>Applied Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($jobPost->applications as $application)
                                                <tr>
                                                    <td>
                                                        <div>{{ $application->jobPost->title }}</div>
                                                        <small class="text-muted">{{ $application->jobPost->company_name }}</small>
                                                    </td>
                                                    <td>
                                                        <div>{{ $application->user->name }}</div>
                                                        <small class="text-muted">{{ $application->user->email }}</small>
                                                    </td>
                                                    <td>
                                                        <span class="badge status-{{ $application->status }} status-badge">
                                                            {{ ucfirst($application->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $application->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary me-1" 
                                                                onclick="viewApplication({{ $application->id }})">
                                                            <i class="fas fa-eye"></i> View
                                                        </button>
                                                        @if($application->status === 'pending')
                                                            <button class="btn btn-sm btn-success me-1" 
                                                                    onclick="updateStatus({{ $application->id }}, 'accepted')">
                                                                <i class="fas fa-check"></i> Accept
                                                            </button>
                                                            <button class="btn btn-sm btn-danger me-1" 
                                                                    onclick="updateStatus({{ $application->id }}, 'rejected')">
                                                                <i class="fas fa-times"></i> Reject
                                                            </button>
                                                            <button class="btn btn-sm btn-info" 
                                                                    onclick="updateStatus({{ $application->id }}, 'shortlisted')">
                                                                <i class="fas fa-star"></i> Shortlist
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No job applications yet</h5>
                        <p class="text-muted">When developers apply to your job posts, they will appear here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Application Modal -->
    <div class="modal fade" id="applicationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Application Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="applicationModalBody">
                    <!-- Content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateStatus(applicationId, status) {
            if (confirm(`Are you sure you want to ${status} this application?`)) {
                fetch(`/application/${applicationId}/status`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ status: status })
                })
                .then(response => response.json())
                .then(data => {
                    location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the status.');
                });
            }
        }

        function viewApplication(applicationId) {
    // Open the modal
    var myModal = new bootstrap.Modal(document.getElementById('applicationModal'));
    myModal.show();

    // Fetch the application details
    fetch(`/application/${applicationId}/details`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Show only the proposal in the modal body
        document.getElementById('applicationModalBody').innerHTML = `
            <p>${data.proposal || 'No proposal provided'}</p>
        `;
    })
    .catch(error => {
        console.error('Error fetching application details:', error);
        document.getElementById('applicationModalBody').innerHTML = '<p>Sorry, an error occurred while loading the proposal.</p>';
    });
}
    </script>
</body>
</html>
