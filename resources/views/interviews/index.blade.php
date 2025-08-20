@extends('layouts.app')

@section('content')
<div class="container">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">My Calendar</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newEvent">New Event</button>
  </div>

  @foreach ($interviews as $iv)
    <div class="card mb-2">
        <div class="card-body d-flex justify-content-between align-items-start">
            <div>
                <div class="fw-bold">
                    {{ $iv->title }}
                    <span class="badge bg-secondary">{{ ucfirst($iv->type) }}</span>
                </div>
                <div>{{ $iv->scheduled_at->format('M d, Y h:i A') }} · {{ $iv->duration_minutes }} min</div>
                <div>With:
                    @if(auth()->id() === $iv->developer_id)
                        {{ $iv->employer->name }} (Employer)
                    @else
                        {{ $iv->developer->name }} (Developer)
                    @endif
                </div>
                <div>Location: {{ $iv->location ?? 'TBD' }}</div>
                @if($iv->notes)
                    <div class="text-muted small mt-1">{{ $iv->notes }}</div>
                @endif
            </div>

            @if(auth()->user()->role === 'Employer')
                <a href="{{ route('interviews.edit', $iv->id) }}" class="btn btn-outline-primary btn-sm">
                    Edit
                </a>

                <form method="post" action="{{ route('interviews.updateStatus', $iv) }}">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select form-select-sm mb-2" style="width: 120px;" onchange="this.form.submit()">
                        @foreach (['scheduled','completed','cancelled'] as $s)
                            <option value="{{ $s }}" @selected($iv->status === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </form>
            @endif

            <a href="{{ route('interviews.ics', $iv) }}" class="btn btn-outline-primary btn-sm" style="width: 120px;">
                Download .ics
            </a>
            @if(in_array($iv->status, ['completed', 'cancelled']))
                <form method="POST" action="{{ route('interviews.destroy', $iv->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            @endif
        </div>
    </div>
@endforeach


  <div class="mt-3">{{ $interviews->links('pagination::bootstrap-5') }}</div>
</div>

{{-- New Event modal --}}
<div class="modal fade" id="newEvent" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{ route('interviews.store') }}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Schedule</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
          <label class="form-label">Developer</label>
          <select name="developer_id" class="form-select" required>
            <option value="" disabled selected>Select developer</option>
            @foreach($developers as $dev)
              <option value="{{ $dev->id }}">{{ $dev->name }} (ID {{ $dev->id }})</option>
            @endforeach
          </select>
        </div>
        <div class="mb-2">
          <label class="form-label">Related Job (optional ID)</label>
          <input name="job_post_id" class="form-control" placeholder="e.g. 16">
        </div>
        <div class="mb-2">
          <label class="form-label">Title</label>
          <input name="title" class="form-control" placeholder="Interview with John" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Type</label>
          <select name="type" class="form-select">
            <option value="interview">Interview</option>
            <option value="meeting">Meeting</option>
            <option value="milestone">Milestone</option>
          </select>
        </div>
        <div class="mb-2">
          <label class="form-label">When</label>
          <input type="datetime-local" name="scheduled_at" class="form-control" required>
        </div>
        <div class="row g-2">
          <div class="col">
            <label class="form-label">Duration (min)</label>
            <input type="number" name="duration_minutes" class="form-control" value="30">
          </div>
          <div class="col">
            <label class="form-label">Remind before (min)</label>
            <input type="number" name="reminder_minutes_before" class="form-control" value="60">
          </div>
        </div>
        <div class="mt-2">
          <label class="form-label">Location / Link</label>
          <input name="location" class="form-control" placeholder="Office address or video link">
        </div>
        <div class="mt-2">
          <label class="form-label">Notes</label>
          <textarea name="notes" rows="3" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Save</button>
      </div>
    </form>
  </div>
</div>
@endsection
