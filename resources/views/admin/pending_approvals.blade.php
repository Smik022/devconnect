@extends('admin.layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    body {
        background-color: #f8f9fa; 
    }

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: auto;
        scrollbar-width: none; 
        -ms-overflow-style: none;  
    }

    body::-webkit-scrollbar {
        display: none;
    }

    .table {
        border-collapse: collapse !important;
        border-spacing: 0 10px;
        background: transparent;
        text-align: center; 
    }


    .table thead tr {
        background-color: #000;  
        color: #fff;
        font-weight: 700;
        letter-spacing: 0.05em;
        border-radius: 8px;
    }

    .table thead th {
        white-space: nowrap;      
        overflow: hidden;
        max-width: 150px;    
        padding: 8px 12px;
        line-height: normal;      
        border: none;
        user-select: none;
        vertical-align: middle;
        text-align: center; 
        font-size: 1rem; 
    }

    .table tbody tr {
        background-color: #fff;
        box-shadow: 0 2px 8px rgb(0 0 0 / 0.05);
        border-radius: 8px;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f4f6f8;
    }

    .table tbody td {
        vertical-align: middle;
        padding: 8px 12px;
        border: none;
        font-size: 1rem;
        color: #212529;
        text-align: center; 
    }

    .alert-success, .alert-danger {
        border-radius: 8px;
        padding: 15px 25px;
        font-weight: 600;
        box-shadow: 0 4px 10px rgb(0 0 0 / 0.05);
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    .actions-cell, table tbody tr td:last-child {
        vertical-align: middle;
        display: flex;
        gap: 0.75rem;
        justify-content: center; 
        align-items: center;
        white-space: nowrap;
        padding: 1rem 1rem;
    }

    .actions-cell button,
    table tbody tr td:last-child > button,
    table tbody tr td:last-child > form > button {
        all: unset;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.25);
        margin: 0 2px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        position: relative;
        font-size: 1.1rem;
    }

    .actions-cell button:hover,
    table tbody tr td:last-child > button:hover,
    table tbody tr td:last-child > form > button:hover {
        background-color: rgba(255, 255, 255, 0.5);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        transform: translateY(-1px);
    }

    .actions-cell button i,
    table tbody tr td:last-child > button i,
    table tbody tr td:last-child > form > button i {
        pointer-events: none;
        font-size: 1.2rem;
    }

    .actions-cell button[title="View"] i,
    table tbody tr td:last-child > button[title="View"] i {
        color: #0dcaf0; 
    }
    .actions-cell button[title="Approve"] i,
    table tbody tr td:last-child > button[title="Approve"] i {
        color: #198754; 
    }
    .actions-cell button[title="Reject"] i,
    table tbody tr td:last-child > button[title="Reject"] i {
        color: #dc3545; 
    }

    .actions-cell button[title]:hover::after,
    table tbody tr td:last-child > button[title]:hover::after,
    table tbody tr td:last-child > form > button[title]:hover::after {
        content: attr(title);
        position: absolute;
        bottom: -24px;
        background-color: #000;
        color: #fff;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 0.7rem;
        white-space: nowrap;
        opacity: 0.9;
        pointer-events: none;
        z-index: 10;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9fafb; 
    }

    .no-data-row,
    .table tbody tr.no-data-row {
        background-color: #f0f0f0 !important;
        box-shadow: none !important;
        border-radius: 8px;
    }

    .no-data-row td.no-data,
    .table tbody tr.no-data-row td.no-data {
        font-style: italic;
        color: #495057;
        font-weight: 600;
        padding: 20px 0;
        text-align: center;
        border: none !important;
        box-shadow: none !important;
        background-color: #f0f0f0 !important;
        white-space: normal !important; 
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .invalid-message {
        color: #dc3545;
        font-weight: 600;
        font-size: 0.9rem;
        margin-top: 0.25rem;
        font-style: italic;
    }

    .skill-badge {
        display: inline-block;
        background-color: #0d6efd; 
        color: #fff;
        padding: 3px 8px;
        margin: 0 3px 3px 0;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: 600;
        user-select: none;
        white-space: nowrap;
    }

    .table tbody .skill-badge,
    .table tbody .badge {
        background-color: #6f42c1 !important;
        color: #fff !important;
        padding: 3px 8px !important;
        margin: 0 3px 3px 0 !important;
        border-radius: 12px !important;
        font-size: 0.85rem !important;
        font-weight: 600 !important;
        user-select: none !important;
        white-space: nowrap !important;
    }

    .description-cell {
        max-width: 320px;
        text-align: left;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .skill-cell {
        text-align: center;
    }

    .date-cell {
        text-align: center;
    }

    .table tbody tr.no-data-row {
        display: table-row !important;
        background-color:  #f0f0f0 !important;
        box-shadow: none !important;
        border-radius: 8px;
        margin: 0 !important;
        border-spacing: 0 !important;
    }

    .table tbody tr.no-data-row td.no-data {
        display: table-cell !important;
        text-align: center !important;
        font-weight: 600;
        font-style: italic !important;
        color: #495057; /* muted */
        padding: 20px 0;
        background-color: #f0f0f0 !important;
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        white-space: normal !important; 
    }
    .modal-body {
        max-height: 400px;
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    .modal-body::-webkit-scrollbar {
        display: none;
    }
</style>

<div class="container py-4">
    <h1 class="mb-4 text-primary">Pending Approvals</h1>

    <form method="GET" action="{{ route('pending_approvals') }}" class="mb-4" role="search">
        <div class="input-group shadow-sm rounded">

            @php
                $columnNames = [
                    ''             => 'All',
                    'title'        => 'Title',
                    'description'  => 'Description',
                    'category'     => 'Category',
                    'salary'       => 'Salary',
                    'job_type'     => 'Job type',
                    'location'     => 'Location',
                    'company_name' => 'Company name',
                    'created_at'   => 'Posted at',
                ];
                $selectedColumn = request('column', '');
            @endphp

            <button class="btn btn-outline-secondary dropdown-toggle rounded-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ $columnNames[$selectedColumn] ?? 'All' }}
            </button>
            <ul class="dropdown-menu">
                @foreach($columnNames as $key => $label)
                    <li><a class="dropdown-item" href="#" data-value="{{ $key }}">{{ $label }}</a></li>
                @endforeach
            </ul>
            <input type="hidden" name="column" id="columnInput" value="{{ request('column') }}">

            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                class="form-control border-primary"
                placeholder="Search pending approvals..."
                aria-label="Search"
            />

            <button type="submit" class="btn btn-primary rounded-end d-flex align-items-center">
                <i class="bi bi-search me-2"></i>Search
            </button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-primary">
                <tr>
                    @php
                    $columns = [
                        'title'        => 'Title',
                        'description'  => 'Description',
                        'category'     => 'Category',
                        'salary'       => 'Salary',
                        'job_type'     => 'Type',
                        'location'     => 'Location',
                        'company_name' => 'Company',
                        'created_at'   => 'Posted',
                    ];
                    @endphp

                    @foreach($columns as $col => $label)
                        <th>{{ $label }}</th>
                    @endforeach

                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingApprovals as $approval)
                <tr>
                    <td>{{ $approval->title }}</td>
                    <td>{{ Str::limit($approval->description, 20) }}</td>
                    <td>{{ $approval->category }}</td>
                    <td>${{ $approval->salary }}</td>
                    <td>{{ $approval->job_type }}</td>
                    <td>{{ $approval->location }}</td>
                    <td>{{ $approval->company_name }}</td>
                    <td>{{ $approval->created_at->format('Y-m-d') }}</td>
                    <td>
                        <button
                        class="btn btn-sm btn-info me-1"
                        type="button"
                        title="View"
                        onclick='openViewModal(@json($approval))'
                        >
                            <i class="bi bi-eye"></i>
                        </button>

                        <button
                        class="btn btn-sm btn-success me-1"
                        type="button"
                        title="Approve"
                        data-id="{{ $approval->id }}"
                        data-title="{{ $approval->title }}"
                        onclick="handleApprove(this)"
                        >
                            <i class="bi bi-check2-circle"></i>
                        </button>

                        <button
                        class="btn btn-sm btn-danger"
                        type="button"
                        title="Reject"
                        data-id="{{ $approval->id }}"
                        data-title="{{ $approval->title }}"
                        onclick="handleReject(this)"
                        >
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr class="no-data-row">
                    <td colspan="9" class="no-data">No pending approvals found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-info">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="viewModalLabel">Pending Approval Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Job Title:</strong> <span id="view-title"></span></p>
                <p><strong>Description:</strong> <span id="view-description"></span></p>
                <p><strong>Category:</strong> <span id="view-category"></span></p>
                <p><strong>Salary:</strong> <span id="view-salary"></span></p>
                <p><strong>Job Type:</strong> <span id="view-job-type"></span></p>
                <p><strong>Location:</strong> <span id="view-location"></span></p>
                <p><strong>Company Name:</strong> <span id="view-company-name"></span></p>
                <p><strong>Posted at:</strong> <span id="view-created-at"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const value = this.getAttribute('data-value');
            const text = this.textContent;
            document.getElementById('columnInput').value = value;
            this.closest('.input-group').querySelector('.dropdown-toggle').textContent = text;
        });
    });
    
    function styleSwalProgressBar() {
        const timerBar = Swal.getTimerProgressBar();
        if (timerBar) {
            timerBar.style.background = '#0dcaf0';
            timerBar.style.boxShadow = 'none';
            timerBar.style.transition = 'width 0.3s ease';
            timerBar.style.height = '6px';
            timerBar.style.borderRadius = '3px';
            timerBar.style.marginTop = '4px';
        }
    }

    function handleApprove(button) {
        const id = button.getAttribute('data-id');
        const jobTitle = button.getAttribute('data-title');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: 'Are you sure?',
            html: `Do you want to approve <strong>${jobTitle}</strong>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/approvals/${id}/approve`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error('Network response was not ok.');
                    return res.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        iconColor: '#198754',
                        title: 'Approved!',
                        text: data.message ?? 'The item has been approved.',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        didOpen: () => {
                            const timerBar = Swal.getTimerProgressBar();
                            if (timerBar) {
                                timerBar.style.background = '#0dcaf0';
                                timerBar.style.boxShadow = 'none';
                                timerBar.style.transition = 'width 0.3s ease';
                                timerBar.style.height = '6px';
                                timerBar.style.borderRadius = '3px';
                                timerBar.style.marginTop = '4px';
                            }
                        }
                    }).then(() => location.reload());
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        iconColor: '#b02a37',
                        title: 'Error!',
                        text: "Failed to approve: " + err.message,
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        didOpen: styleSwalProgressBar
                    });
                });
            }
        });
    }

    function handleReject(button) {
        const id = button.getAttribute('data-id');
        const jobTitle = button.getAttribute('data-title');

        Swal.fire({
            title: 'Are you sure?',
            html: `Do you want to reject <strong>${jobTitle}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, reject it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/pending_approvals/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        iconColor: '#198754',
                        title: 'Rejected!',
                        text: data.message ?? 'The item has been rejected.',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        didOpen: () => {
                            const timerBar = Swal.getTimerProgressBar();
                            if (timerBar) {
                                timerBar.style.background = '#0dcaf0';
                                timerBar.style.boxShadow = 'none';
                                timerBar.style.transition = 'width 0.3s ease';
                                timerBar.style.height = '6px';
                                timerBar.style.borderRadius = '3px';
                                timerBar.style.marginTop = '4px';
                            }
                        }
                    });

                    const row = button.closest('tr');
                    if (row) row.remove();

                    const tbody = document.querySelector('table tbody');
                    if (tbody.children.length === 0) {
                        const totalColumns = document.querySelectorAll('table thead th').length;
                        tbody.innerHTML = `<tr class="no-data-row"><td colspan="${totalColumns}" class="no-data">No pending approvals found.</td></tr>`;
                    }

                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        iconColor: '#b02a37',
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                    console.error('Error:', error);
                });
            }
        });
    }

    function openViewModal(approval) {
        document.getElementById('view-title').textContent = approval.title || '';
        document.getElementById('view-description').textContent = approval.description || '';
        document.getElementById('view-category').textContent = approval.category || '';
        const formattedSalary = parseFloat(approval.salary).toLocaleString('en-US'); 
        document.getElementById('view-salary').textContent = `$${formattedSalary}`;
        document.getElementById('view-job-type').textContent = approval.job_type || '';
        document.getElementById('view-location').textContent = approval.location || '';
        document.getElementById('view-company-name').textContent = approval.company_name || '';

        if (approval.created_at) {
            const date = new Date(approval.created_at);
            document.getElementById('view-created-at').textContent = date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        } else {
            document.getElementById('view-created-at').textContent = '';
        }

        const modal = new bootstrap.Modal(document.getElementById('viewModal'));
        modal.show();
    }

</script>

@endsection
