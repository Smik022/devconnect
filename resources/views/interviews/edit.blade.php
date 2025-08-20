@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Event</h1>

    <form method="POST" action="{{ route('interviews.update', $interview->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label class="form-label">Developer</label>
            <select name="developer_id" class="form-select" required>
                @foreach($developers as $dev)
                    <option value="{{ $dev->id }}" @selected($interview->developer_id === $dev->id)>
                        {{ $dev->name }} (ID {{ $dev->id }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label class="form-label">Related Job (optional ID)</label>
            <input name="job_post_id" class="form-control" placeholder="e.g. 16" value="{{ $interview->job_post_id }}">
        </div>

        <div class="mb-2">
            <label class="form-label">Title</label>
            <input name="title" class="form-control" value="{{ $interview->title }}" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Type</label>
            <select name="type" class="form-select" required>
                <option value="interview" @selected($interview->type === 'interview')>Interview</option>
                <option value="meeting" @selected($interview->type === 'meeting')>Meeting</option>
                <option value="milestone" @selected($interview->type === 'milestone')>Milestone</option>
            </select>
        </div>

        <div class="mb-2">
            <label class="form-label">Location / Link</label>
            <input name="location" class="form-control" placeholder="Office address or video link" value="{{ $interview->location }}">
        </div>

        <div class="mb-2">
            <label class="form-label">Notes</label>
            <textarea name="notes" rows="3" class="form-control">{{ $interview->notes }}</textarea>
        </div>

        <div class="mb-2">
            <label class="form-label">When</label>
            <input type="datetime-local" name="scheduled_at" class="form-control" value="{{ $interview->scheduled_at->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="row g-2">
            <div class="col">
                <label class="form-label">Duration (min)</label>
                <input type="number" name="duration_minutes" class="form-control" value="{{ $interview->duration_minutes }}">
            </div>
            <div class="col">
                <label class="form-label">Remind before (min)</label>
                <input type="number" name="reminder_minutes_before" class="form-control" value="{{ $interview->reminder_minutes_before }}">
            </div>
        </div>

        <div class="mt-2">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
@endsection
