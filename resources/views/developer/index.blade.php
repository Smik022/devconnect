@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Developer Directory</h2>

    
    <form method="GET" action="{{ route('developers.index') }}" class="mb-5 p-4 rounded border shadow-sm">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="skills" class="form-control" placeholder="Skills" value="{{ request('skills') }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="experience" class="form-control" placeholder="Min Years" value="{{ request('experience') }}">
            </div>
            
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>

    
    <div class="row">
        @forelse($developers as $dev)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $dev->name }}</h5>
                        <p><strong>Skills:</strong> {{ $dev->skills }}</p>
                        <p><strong>Experience:</strong> {{ $dev->experience }} years</p>
                        <!-- Removed Location and Availability from Developer Card -->
                    </div>
                </div>
            </div>
        @empty
            <p>No developers found.</p>
        @endforelse
    </div>
</div>
@endsection

