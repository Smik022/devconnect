@extends('admin.layouts.app')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
        border: none;
        padding: 8px 12px; 
        cursor: pointer;
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
    table tbody tr td:last-child {
        vertical-align: middle;
        display: flex;
        gap: 0.75rem;
        justify-content: center; 
        align-items: center;
        white-space: nowrap;
        padding: 0.75rem 1rem;
    }    
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
    table tbody tr td:last-child > button:hover,
    table tbody tr td:last-child > form > button:hover {
        background-color: rgba(255, 255, 255, 0.5);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        transform: translateY(-1px);
    }    
    table tbody tr td:last-child i {
        pointer-events: none;
    }
    table tbody tr td:last-child .bi-eye {
        color: #0dcaf0; 
        font-size: 1.2rem;
    }
    table tbody tr td:last-child .bi-pencil {
        color: #ffc107;
        font-size: 1.2rem;
    }
    table tbody tr td:last-child .bi-trash {
        color: #dc3545; 
        font-size: 1.2rem;
    }    
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
        color: #495057;
        padding: 20px 0;
        background-color: #f0f0f0 !important;
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
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
</style>

<div class="container py-4">
    <h1 class="mb-4 text-primary">Job Postings</h1>

    <form method="GET" action="{{ route('job_postings') }}" class="mb-3 d-flex" role="search">
        <input
        type="search"
        name="search"
        value="{{ request('search') }}"
        class="form-control me-2 border-primary"
        placeholder="Search job postings..."
        aria-label="Search"
        />
        <button type="submit" class="btn btn-outline-primary">Search</button>
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
                        'job_type'     => 'Job Type',
                        'location'     => 'Location',
                        'company_name' => 'Company Name',
                        'created_at'   => 'Posted At',
                    ];
                    $currentSort = request('sort', 'title');
                    $currentDir = request('direction', 'asc');
                    @endphp

                    @foreach($columns as $col => $label)
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                        'sort' => $col,
                        'direction' => ($currentSort === $col && $currentDir === 'asc') ? 'desc' : 'asc'
                        ]) }}" class="text-decoration-none text-dark"
                        >
                            {{ $label }}
                            @if($currentSort === $col)
                            <i class="bi bi-caret-{{ $currentDir === 'asc' ? 'up' : 'down' }}-fill"></i>
                            @endif
                        </a>
                    </th>
                    @endforeach

                    <th style="width: 140px;">Actions</th>
                </tr>

            </thead>

            <tbody>
                @forelse($job_posts as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($job->description, 20) }}</td>
                    <td>{{ $job->category }}</td>
                    <td>${{ number_format((float)$job->salary, 0) }}</td>
                    <td>{{ $job->job_type }}</td>
                    <td>{{ $job->location }}</td>
                    <td>{{ $job->company_name }}</td>
                    <td>{{ $job->created_at->format('Y-m-d') }}</td>
                    <td>

                        <button
                        class="btn btn-sm btn-info me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#viewModal"
                        data-id="{{ $job->id }}"
                        data-title="{{ $job->title }}"
                        data-description="{{ $job->description }}"
                        data-category="{{ $job->category }}"
                        data-salary="{{ $job->salary }}"
                        data-job_type="{{ $job->job_type }}"
                        data-location="{{ $job->location }}"
                        data-company_name="{{ $job->company_name }}"
                        data-created_at="{{ $job->created_at->format('Y-m-d') }}"
                        title="View"
                        >
                            <i class="bi bi-eye"></i>
                        </button>

                        <button
                        class="btn btn-sm btn-warning me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal"
                        data-id="{{ $job->id }}"
                        data-title="{{ $job->title }}"
                        data-description="{{ $job->description }}"
                        data-category="{{ $job->category }}"
                        data-salary="{{ $job->salary }}"
                        data-job_type="{{ $job->job_type }}"
                        data-location="{{ $job->location }}"
                        data-company_name="{{ $job->company_name }}"
                        title="Edit"
                        >
                            <i class="bi bi-pencil"></i>
                        </button>

                        <form
                        action="{{ route('job_postings.destroy', $job) }}"
                        method="POST"
                        class="d-inline delete-form"
                        >
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="no-data-row">
                    <td colspan="9" class="no-data">No job postings found.</td>
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
                <h5 class="modal-title" id="viewModalLabel">Job Posting Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Job Title:</strong> <span id="view-title"></span></p>
                <p><strong>Description:</strong> <span id="view-description"></span></p>
                <p><strong>Category:</strong> <span id="view-category"></span></p>
                <p><strong>Salary:</strong> <span id="view-salary"></span></p>
                <p><strong>Job Type:</strong> <span id="view-job_type"></span></p>
                <p><strong>Location:</strong> <span id="view-location"></span></p>
                <p><strong>Company Name:</strong> <span id="view-company_name"></span></p>
                <p><strong>Posted At:</strong> <span id="view-created_at"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" id="editForm" class="modal-content border-warning" novalidate>
            @csrf
            @method('PUT')

            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editModalLabel">Edit Job Posting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="edit-title" class="form-label">Job Title</label>
                    <input
                    type="text"
                    name="title"
                    id="edit-title"
                    class="form-control"
                    maxlength="255"
                    required
                    aria-describedby="title-error"
                    />
                    <div class="invalid-feedback" id="title-error" style="color: #dc3545; font-weight: 600; font-size: 0.9rem; margin-top: 0.25rem; font-style: italic;">
                        Required
                    </div>
                </div>

                <div class="mb-3">
                    <label for="edit-description" class="form-label">Description</label>
                    <textarea
                    name="description"
                    id="edit-description"
                    class="form-control"
                    rows="4"
                    required
                    aria-describedby="description-error"
                    ></textarea>
                    <div class="invalid-feedback" id="description-error" style="color: #dc3545; font-weight: 600; font-size: 0.9rem; margin-top: 0.25rem; font-style: italic;">
                        Required
                    </div>
                </div>

                <div class="mb-3">
                    <label for="edit-category" class="form-label">Category</label>
                    <input
                    type="text"
                    name="category"
                    id="edit-category"
                    class="form-control"
                    maxlength="255"
                    required
                    aria-describedby="category-error"
                    />
                    <div class="invalid-feedback" id="category-error" style="color: #dc3545; font-weight: 600; font-size: 0.9rem; margin-top: 0.25rem; font-style: italic;">
                        Required
                    </div>
                </div>

                <div class="mb-3">
                    <label for="edit-salary" class="form-label">Salary</label>
                    <input
                    type="number"
                    name="salary"
                    id="edit-salary"
                    class="form-control"
                    step="5000"
                    min="0"
                    required
                    aria-describedby="salary-error"
                    />
                    <div class="invalid-feedback" id="salary-error" style="color: #dc3545; font-weight: 600; font-size: 0.9rem; margin-top: 0.25rem; font-style: italic;">
                        Required
                    </div>
                </div>

                <div class="mb-3">
                    <label for="edit-job_type" class="form-label">Job Type</label>
                    <input
                    type="text"
                    name="job_type"
                    id="edit-job_type"
                    class="form-control"
                    maxlength="255"
                    required
                    aria-describedby="job_type-error"
                    />
                    <div class="invalid-feedback" id="job_type-error" style="color: #dc3545; font-weight: 600; font-size: 0.9rem; margin-top: 0.25rem; font-style: italic;">
                        Required
                    </div>
                </div>

                <div class="mb-3">
                    <label for="edit-location" class="form-label">Location</label>
                    <input
                    type="text"
                    name="location"
                    id="edit-location"
                    class="form-control"
                    maxlength="255"
                    required
                    aria-describedby="location-error"
                    />
                    <div class="invalid-feedback" id="location-error" style="color: #dc3545; font-weight: 600; font-size: 0.9rem; margin-top: 0.25rem; font-style: italic;">
                        Required
                    </div>
                </div>

                <div class="mb-3">
                    <label for="edit-company_name" class="form-label">Company Name</label>
                    <input
                    type="text"
                    name="company_name"
                    id="edit-company_name"
                    class="form-control"
                    maxlength="255"
                    required
                    aria-describedby="company_name-error"
                    />
                    <div class="invalid-feedback" id="company_name-error" style="color: #dc3545; font-weight: 600; font-size: 0.9rem; margin-top: 0.25rem; font-style: italic;">
                        Required
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    document.addEventListener('DOMContentLoaded', function () {

        function toggleError(input, errorElem, show, message = '') {
            if (show) {
                input.classList.add('is-invalid');
                errorElem.textContent = message;
                errorElem.style.display = 'block';
            } else {
                input.classList.remove('is-invalid');
                errorElem.style.display = 'none';
            }
        }

        function showSwalFlash(type, title, text) {
            Swal.fire({
                icon: type,
                iconColor: type === 'success' ? '#198754' : '#b02a37',
                title,
                text,
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
        }

        const viewModal = document.getElementById('viewModal');
            if (viewModal) {
            viewModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const fields = ['title', 'description', 'category', 'salary', 'job_type', 'location', 'company_name', 'created_at'];
                    fields.forEach(field => {
                        const elem = document.getElementById(`view-${field}`);
                        let value = button.getAttribute(`data-${field}`) || '-';
                        if (field === 'salary' && value !== '-') {
                            value = `$${parseFloat(value).toFixed(0)}`;
                        }
                        elem.textContent = value;
                    });
                });
        }

        function capitalizeWords(str) {
            return str.replace(/\b\w/g, char => char.toUpperCase());
        }

        function toggleError(inputElem, errorElem, show, message = '') {
            if (show) {
                inputElem.classList.add('is-invalid');
                if (errorElem) {
                    errorElem.style.display = 'block';
                    errorElem.textContent = capitalizeWords(message);
                }
            } else {
                inputElem.classList.remove('is-invalid');
                if (errorElem) {
                    errorElem.style.display = 'none';
                    errorElem.textContent = '';
                }
            }
        }


        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        if (editModal && editForm) {

            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                if (!button) return;

                const id = button.getAttribute('data-id');
                editForm.action = '/admin/job_postings/' + id; 

                const fields = ['title', 'description', 'category', 'salary', 'job_type', 'location', 'company_name'];

                fields.forEach(field => {
                    const input = editForm.querySelector(`#edit-${field}`);
                    if (!input) return;
                    input.value = button.getAttribute(`data-${field}`) || '';
                    input.classList.remove('is-invalid');
                    const errorElem = document.getElementById(`${field}-error`);
                    if (errorElem) errorElem.style.display = 'none';
                });
            });

            editForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const fields = ['title', 'description', 'category', 'salary', 'job_type', 'location', 'company_name'];
                let valid = true;

                function formatFieldName(field) {
                    return field
                    .replace(/_/g, ' ')         
                    .split(' ')                   
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1)) 
                    .join(' ');                  
                }

                fields.forEach(field => {
                    const input = editForm.querySelector(`#edit-${field}`);
                    const errorElem = document.getElementById(`${field}-error`);

                    if (!input.value.trim()) {
                        toggleError(input, errorElem, true, `${formatFieldName(field)} is required.`);
                        valid = false;
                    } else {
                        toggleError(input, errorElem, false);
                    }
                });

                if (!valid) return; 
                const formData = new FormData(editForm);

                fetch(editForm.action, {
                    method: 'POST', 
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData,
                })

                .then(response => {
                    if (!response.ok) return response.json().then(errData => Promise.reject(errData));
                    return response.json();
                })

                .then(data => {
                if (data.success) {
                        showSwalFlash('success', 'Success', 'Job posting updated successfully!');
                        const modalInstance = bootstrap.Modal.getInstance(editModal);
                        modalInstance.hide();
                    } else {
                        showSwalFlash('error', 'Error', data.message || 'Failed to update job posting.');
                    }
                })
                .catch(errorData => {
                    if (errorData.errors) {
                        Object.entries(errorData.errors).forEach(([field, messages]) => {
                            const input = editForm.querySelector(`#edit-${field}`);
                            const errorElem = document.getElementById(`${field}-error`);
                            if (input && errorElem) {
                                toggleError(input, errorElem, true, messages.join(' '));
                            }
                        });
                    } else {
                        showSwalFlash('error', 'Error', 'Failed to update job posting.');
                    }
                });
            });
        }

        document.querySelectorAll('form.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const jobTitle = form.closest('tr')?.querySelector('td:first-child')?.textContent.trim() || 'this job posting';

                Swal.fire({
                    title: 'Confirm Delete',
                    html: `Are you sure you want to delete <strong>${jobTitle}</strong>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    focusCancel: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            },
                            body: new URLSearchParams(new FormData(form))
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.json().catch(() => ({}));
                            }
                            throw new Error('Network response was not ok.');
                        })
                        .then(() => {
                            showSwalFlash('success', 'Deleted!', 'The job posting has been deleted.');
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        })
                        .catch(() => {
                            showSwalFlash('error', 'Error', 'Could not delete the job posting.');
                        });
                    }
                });
            });
        });
    });
    
</script>

@endsection
