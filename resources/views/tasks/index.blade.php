@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Add Task Button (for Employers only) -->
    @if(auth()->user()->role == 'Employer')
        <button id="add-task-btn" class="btn btn-success mb-3" style="border-radius: 50px; padding: 10px 30px; font-size: 18px;" data-bs-toggle="modal" data-bs-target="#addTaskModal">
            Add New Task
        </button>
    @endif

    <!-- Modal for Add Task Form -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #007bff; color: white;">
                    <h5 class="modal-title" id="addTaskModalLabel">Create a New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <!-- Task Title -->
                        <div class="form-group mb-3">
                            <label for="title">Task Title</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter the task title" required style="border-radius: 10px;">
                        </div>

                        <!-- Developer Assignment -->
                        <div class="form-group mb-3">
                            <label for="assigned_to">Assign to Developer</label>
                            <select id="assigned_to" name="assigned_to" class="form-control" required style="border-radius: 10px;">
                                <option value="" disabled selected>Select a developer</option>
                                @foreach($developers as $developer)
                                    <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Deadline -->
                        <div class="form-group mb-3">
                            <label for="deadline">Deadline</label>
                            <input type="datetime-local" id="deadline" name="deadline" class="form-control" required style="border-radius: 10px;">
                        </div>

                        <!-- Description -->
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter a brief description of the task" required style="border-radius: 10px;"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary" style="border-radius: 50px; padding: 10px 30px; font-size: 18px;">Create Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row" style="display: flex; justify-content: space-between; gap: 15px;">
        <!-- To-Do Column -->
        <div class="col-md-3" style="background-color: #b3e0ff; border-radius: 8px; padding: 15px;">
            <h3 style="color: #007bff;">To-Do</h3>
            <div class="task-list" id="todo">
                @foreach($tasks as $task)
                    @if($task->status == 'To-Do')
                        <div class="task-card card mb-3" style="background-color: #e9f7fe; border-left: 5px solid #007bff;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->title }}</h5>
                                <p><strong>Assigned to:</strong> {{ $task->user->name }}</p>
                                @if($task->assignedBy)
                                    <p><strong>Assigned by:</strong> {{ $task->assignedBy->name }}</p>
                                @else
                                    <p><strong>Assigned by:</strong> Not Assigned</p>
                                @endif
                                <p><strong>Deadline:</strong> {{ $task->deadline->format('M d, Y') }}</p>

                                <!-- Status Dropdown -->
                                <div class="form-group">
                                    <label for="status-{{ $task->id }}">Status</label>
                                    <select id="status-{{ $task->id }}" class="form-control" onchange="updateStatus({{ $task->id }})">
                                        <option value="To-Do" {{ $task->status == 'To-Do' ? 'selected' : '' }}>To-Do</option>
                                        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </div>

                                <!-- Delete Button (Only Employer) -->
                                @if(auth()->user()->role == 'Employer')
                                    <button class="btn btn-danger" onclick="deleteTask({{ $task->id }})">Delete Task</button>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- In Progress Column -->
        <div class="col-md-3" style="background-color: #fff3b3; border-radius: 8px; padding: 15px;">
            <h3 style="color: #ff9800;">In Progress</h3>
            <div class="task-list" id="in-progress">
                @foreach($tasks as $task)
                    @if($task->status == 'In Progress')
                        <div class="task-card card mb-3" style="background-color: #fff9e6; border-left: 5px solid #ff9800;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->title }}</h5>
                                <p><strong>Assigned to:</strong> {{ $task->user->name }}</p>
                                <p><strong>Assigned by:</strong> {{ $task->assignedBy->name ?? 'Not Assigned' }}</p>
                                <p><strong>Deadline:</strong> {{ $task->deadline->format('M d, Y') }}</p>

                                <!-- Status Dropdown -->
                                <div class="form-group">
                                    <label for="status-{{ $task->id }}">Status</label>
                                    <select id="status-{{ $task->id }}" class="form-control" onchange="updateStatus({{ $task->id }})">
                                        <option value="To-Do" {{ $task->status == 'To-Do' ? 'selected' : '' }}>To-Do</option>
                                        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </div>

                                <!-- Approve Button (For Employer) -->
                                @if(auth()->user()->role == 'Employer' && !$task->approved_by_employer)
                                    <button class="btn btn-success" onclick="approveTask({{ $task->id }})">Approve</button>
                                @elseif(auth()->user()->role == 'Employer' && $task->approved_by_employer)
                                    <p><strong>Status:</strong> Approved</p>
                                @endif

                                <!-- Delete Button (Only Employer) -->
                                @if(auth()->user()->role == 'Employer')
                                    <button class="btn btn-danger" onclick="deleteTask({{ $task->id }})">Delete Task</button>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Done Column -->
        <div class="col-md-3" style="background-color: #e8f5e9; border-radius: 8px; padding: 15px;">
            <h3 style="color: #4caf50;">Done</h3>
            <div class="task-list" id="done">
                @foreach($tasks as $task)
                    @if($task->status == 'Done' && $task->approved_by_employer)
                        <div class="task-card card mb-3" style="background-color: #c8e6c9; border-left: 5px solid #4caf50;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->title }}</h5>
                                <p><strong>Assigned to:</strong> {{ $task->user->name }}</p>
                                <p><strong>Assigned by:</strong> {{ $task->assignedBy->name ?? 'Not Assigned' }}</p>
                                <p><strong>Deadline:</strong> {{ $task->deadline->format('M d, Y') }}</p>
                                <p><strong>Status:</strong> Done</p>

                                <!-- Status Dropdown -->
                                <div class="form-group">
                                    <label for="status-{{ $task->id }}">Status</label>
                                    <select id="status-{{ $task->id }}" class="form-control" onchange="updateStatus({{ $task->id }})">
                                        <option value="To-Do" {{ $task->status == 'To-Do' ? 'selected' : '' }}>To-Do</option>
                                        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </div>

                                <!-- Delete Button (Only Employer) -->
                                @if(auth()->user()->role == 'Employer')
                                    <button class="btn btn-danger" onclick="deleteTask({{ $task->id }})">Delete Task</button>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    // Update task status via dropdown
    function updateStatus(taskId) {
        const status = document.getElementById(`status-${taskId}`).value;

        fetch(`/tasks/${taskId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token for security
            },
            body: JSON.stringify({ status: status })
        }).then(response => response.json())
          .then(data => {
              if (data.message) {
                  alert(data.message); // Show success message
                  window.location.reload();  // Reload the page to reflect updated status
              } else if (data.error) {
                  alert(data.error); // Show error message if any
              }
          });
    }

    // Approve task (Only Employer)
    function approveTask(taskId) {
        fetch(`/tasks/${taskId}/approve`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        }).then(response => response.json())
          .then(data => {
              if (data.message) {
                  alert(data.message); // Show success message
                  window.location.reload();  // Reload the page to reflect updated status
              } else if (data.error) {
                  alert(data.error); // Show error message if any
              }
          });
    }

    // Delete task via AJAX (only for Employer)
    function deleteTask(taskId) {
        if (confirm('Are you sure you want to delete this task?')) {
            fetch(`/tasks/${taskId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            }).then(response => response.json())
              .then(data => {
                  if (data.message) {
                      alert(data.message); // Show success message
                      document.getElementById(`task-card-${taskId}`).remove(); // Remove task card from UI
                  } else if (data.error) {
                      alert(data.error); // Show error message if any
                  }
              });
        }
    }
</script>
@endsection
