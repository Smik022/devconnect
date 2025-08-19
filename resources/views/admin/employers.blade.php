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
        padding: 1rem 1rem;
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
    <h1 class="mb-4 text-primary">Employers</h1>
<form method="GET" action="{{ route('admin_employers') }}" class="mb-4" role="search">
    <div class="input-group shadow-sm rounded">

        @php
            $columnNames = [
                ''           => 'All',
                'name'       => 'Name',
                'email'      => 'Email',
                'created_at' => 'Registered At',
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
            placeholder="Search employers..."
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
                        'name' => 'Name',
                        'email' => 'Email',
                        'created_at' => 'Joined',
                    ];
                    @endphp

                    @foreach($columns as $col => $label)
                        <th>{{ $label }}</th>
                    @endforeach

                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employers as $employer)
                <tr>
                    <td>{{ $employer->name }}</td>
                    <td>{{ $employer->email }}</td>
                    <td>{{ $employer->created_at->format('Y-m-d') }}</td>                    
                    <td>
                        <button
                        class="btn btn-sm btn-info me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#viewModal"
                        data-id="{{ $employer->id }}"
                        data-name="{{ $employer->name }}"
                        data-email="{{ $employer->email }}"
                        data-role="{{ $employer->role }}"
                        data-bio="{{ $employer->bio }}"
                        data-skills="{{ $employer->skills }}"
                        data-experience="{{ $employer->experience }}"
                        data-education="{{ $employer->education }}"
                        data-github="{{ $employer->github }}"
                        data-stackoverflow="{{ $employer->stackoverflow }}"
                        data-portfolio="{{ $employer->portfolio }}"
                        data-resume="{{ $employer->resume }}"
                        data-created-at="{{ $employer->created_at }}"
                        title="View"
                        >
                            <i class="bi bi-eye"></i>
                        </button>

                        <button
                        class="btn btn-sm btn-warning me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal"
                        data-id="{{ $employer->id }}"
                        data-name="{{ $employer->name }}"
                        data-email="{{ $employer->email }}"
                        data-bio="{{ $employer->bio }}"
                        data-skills="{{ $employer->skills }}"
                        data-experience="{{ $employer->experience }}"
                        data-education="{{ $employer->education }}"
                        data-github="{{ $employer->github }}"
                        data-stackoverflow="{{ $employer->stackoverflow }}"
                        data-portfolio="{{ $employer->portfolio }}"
                        data-resume="{{ $employer->resume }}"
                        title="Edit"
                        >
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form
                        action="{{ route('admin_employers.destroy', $employer->id) }}"
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
                    <td colspan="4" class="no-data text-center">
                        No employers found.
                    </td>
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
                <h5 class="modal-title" id="viewModalLabel">Employer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="view-name"></span></p>
                <p><strong>Email:</strong> <span id="view-email"></span></p>
                <p><strong>Joined:</strong> <span id="view-created-at"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" id="editForm" class="modal-content border-warning" novalidate>
            @csrf
            @method('PUT')

            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editModalLabel">Edit Employer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="edit-name" class="form-label">Name</label>
                    <input type="text" name="name" id="edit-name" class="form-control" maxlength="255" required aria-describedby="name-error" />
                    <div class="invalid-feedback" id="name-error" style="color: #dc3545; font-weight: 600; font-size: 0.9rem; margin-top: 0.25rem; font-style: italic;"></div>
                </div>

                <div class="mb-3">
                    <label for="edit-email" class="form-label">Email</label>
                    <input type="email" name="email" id="edit-email" class="form-control" maxlength="255" required aria-describedby="email-error" />
                    <div class="invalid-feedback" id="email-error" style="color: #dc3545; font-weight: 600; font-size: 0.9rem; margin-top: 0.25rem; font-style: italic;"></div>
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
    
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const value = this.getAttribute('data-value');
            const text = this.textContent;
            document.getElementById('columnInput').value = value;
            this.closest('.input-group').querySelector('.dropdown-toggle').textContent = text;
        });
    });
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

        function isValidUrl(string) {
            try {
                new URL(string);
                return true;
            } catch (_) {
                return false;  
            }
        }

        const viewModal = document.getElementById('viewModal');
        if (viewModal) {
            viewModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                const urlFields = ['github', 'stackoverflow', 'portfolio', 'resume'];
                const otherFields = [
                'name', 'email', 'bio', 'skills', 'experience', 'education'
                ];

                otherFields.forEach(field => {
                    const elem = document.getElementById(`view-${field}`);
                    if (!elem) return;
                    const value = button.getAttribute(`data-${field}`) || 'Not provided';
                    elem.textContent = value;
                });

                urlFields.forEach(field => {
                    const elem = document.getElementById(`view-${field}`);
                    if (!elem) return;
                    const url = button.getAttribute(`data-${field}`);

                    if (url && isValidUrl(url)) {
                        elem.href = url;
                        elem.textContent = url;
                        elem.style.pointerEvents = 'auto';
                        elem.style.color = ''; 
                    } else {
                        elem.removeAttribute('href');
                        elem.textContent = 'Not provided';
                        elem.style.pointerEvents = 'none';
                        elem.style.color = '#6c757d'; 
                    }
                });

                const createdAtElem = document.getElementById('view-created-at');
                if (createdAtElem) {
                    const createdAt = button.getAttribute('data-created-at');
                    if (createdAt) {
                        const date = new Date(createdAt);
                        const options = { year: 'numeric', month: 'long', day: 'numeric' };
                        createdAtElem.textContent = date.toLocaleDateString(undefined, options);
                    } else {
                        createdAtElem.textContent = '-';
                    }
                }
            });
        }


        function toggleError(inputElem, errorElem, show, message = '') {
        if (show) {
                inputElem.classList.add('is-invalid');
                if (errorElem) {
                    errorElem.style.display = 'block';
                    errorElem.textContent = message;
                }
            } else {
                inputElem.classList.remove('is-invalid');
                if (errorElem) {
                    errorElem.style.display = 'none';
                    errorElem.textContent = '';
                }
            }
        }

        function isValidURL(str) {
            try {
                new URL(str);
                return true;
            } catch {
                return false;
            }
        }

        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');

        if (editModal && editForm) {
            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                if (!button) return;

                const id = button.getAttribute('data-id');
                editForm.action = '/admin/employers/' + id;

                const fields = ['name', 'email'];

                fields.forEach(field => {
                    const input = editForm.querySelector(`#edit-${field}`);
                    if (!input) return;
                    input.value = button.getAttribute(`data-${field}`) || '';
                    input.classList.remove('is-invalid');
                    const errorElem = document.getElementById(`${field}-error`);
                    if (errorElem) errorElem.style.display = 'none';
                });

                setTimeout(() => {
                    document.getElementById('edit-name').focus();
                }, 1);
            });

            editForm.addEventListener('submit', function (e) {
                e.preventDefault();

                let valid = true;

                function formatFieldName(field) {
                    return field
                        .replace(/_/g, ' ')
                        .split(' ')
                        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                        .join(' ');
                }

                ['name', 'email'].forEach(field => {
                    const input = editForm.querySelector(`#edit-${field}`);
                    const errorElem = document.getElementById(`${field}-error`);

                    if (!input.value.trim()) {
                        toggleError(input, errorElem, true, `The ${formatFieldName(field).toLowerCase()} field is required.`);
                        valid = false;
                    } else if (field === 'email' && !/^\S+@\S+\.\S+$/.test(input.value.trim())) {
                        toggleError(input, errorElem, true, 'The email field must be a valid email address.');
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
                        showSwalFlash('success', 'Success', 'Employer updated successfully!');
                        const modalInstance = bootstrap.Modal.getInstance(editModal);
                        modalInstance.hide();
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showSwalFlash('error', 'Error', data.message || 'Failed to update employer.');
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
                        showSwalFlash('error', 'Error', 'Failed to update employer.');
                    }
                });
            });
        }

        document.querySelectorAll('form.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const employerName = form.closest('tr')?.querySelector('td:first-child')?.textContent.trim() || 'this employer';

                Swal.fire({
                    title: 'Confirm Delete',
                    html: `Are you sure you want to delete <strong>${employerName}</strong>?`,
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
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams(new FormData(form))
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.json();
                        })
                        .then(data => {
                            Swal.fire({
                                icon: 'success',
                                iconColor: '#198754',
                                title: 'Deleted!',
                                text: data.message || 'Employer has been deleted.',
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

                            const row = form.closest('tr');
                            if (row) row.remove();

                            const tbody = document.querySelector('table tbody');
                            if (tbody && tbody.querySelectorAll('tr:not(.no-data-row)').length === 0) {
                                tbody.innerHTML = `
                                <tr class="no-data-row">
                                    <td colspan="4" class="no-data">No employers found.</td>
                                </tr>`;
                            }
                        })
                        .catch(error => {
                        Swal.fire({
                                icon: 'error',
                                iconColor: '#b02a37',
                                title: 'Error!',
                                text: 'Failed to delete employer. Please try again.',
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            });
                            console.error('Delete error:', error);
                        });
                    }
                });
            });
        });

        @if(session('success'))
        if (!sessionStorage.getItem('suppressFlash')) {
            showSwalFlash('success', 'Success!', @json(session('success')));
        } else {
            sessionStorage.removeItem('suppressFlash');
        }
        @endif

        @if(session('error'))
        if (!sessionStorage.getItem('suppressError')) {
            showSwalFlash('error', 'Oops...', @json(session('error')));
        } else {
            sessionStorage.removeItem('suppressError');
        }
        @endif
    });
    
</script>

@endsection
