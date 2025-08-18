@extends('layouts.app')

@section('title', 'Manage Developer Portfolio - DevConnect')

@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #0f1c3f, #13294d, #1a3660);
        color: #00ccff;
    }

    .container {
        max-width: 800px;
        margin-top: 50px;
    }

    h1 {
        font-weight: 700;
        margin-bottom: 2rem;
        text-align: center;
    }

    .form-label {
        font-weight: 600;
        color: #00ccff;
    }

    .form-control {
        background: #0e1b3a;
        border: 1px solid #004aad;
        border-radius: 12px;
        color: #00ccff;
    }

    .form-control::placeholder {
        color: rgba(0,204,255,0.6);
    }

    .form-control:focus {
        background: #13294d;
        color: #00ccff;
        border-color: #00ccff;
        box-shadow: 0 0 10px rgba(0,204,255,0.5);
    }

    .btn-primary {
        background: linear-gradient(90deg, #00ccff, #0055ff);
        border: none;
        border-radius: 12px;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,204,255,0.5);
        color: #fff;
    }

    .btn-secondary {
        background: #1a2a50;
        border: 1px solid #0055ff;
        border-radius: 12px;
        color: #00ccff;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,204,255,0.5);
        color: #00ccff;
    }

    .alert-success, .alert-danger {
        border-radius: 12px;
        font-weight: 600;
        background: rgba(0,204,255,0.1);
        color: #00ccff;
        border: 1px solid #00ccff;
    }

    .resume-link a {
        color: #00ccff;
        text-decoration: underline;
    }
</style>

<div class="container">
    <h1>Manage Developer Portfolio</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('developer.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="bio" class="form-label">Bio:</label>
            <textarea id="bio" name="bio" rows="4" class="form-control" placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="skills" class="form-label">Skills:</label>
            <textarea id="skills" name="skills" rows="3" class="form-control" placeholder="List your skills separated by commas...">{{ old('skills', $user->skills) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="experience" class="form-label">Experience:</label>
            <textarea id="experience" name="experience" rows="4" class="form-control" placeholder="Describe your experience...">{{ old('experience', $user->experience) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="education" class="form-label">Education:</label>
            <textarea id="education" name="education" rows="3" class="form-control" placeholder="Your educational background...">{{ old('education', $user->education) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="github" class="form-label">GitHub (username or full URL):</label>
            <input id="github" type="text" name="github" class="form-control" placeholder="https://github.com/username" value="{{ old('github', $user->github) }}">
        </div>

        <div class="mb-3">
            <label for="stackoverflow" class="form-label">StackOverflow URL:</label>
            <input id="stackoverflow" type="url" name="stackoverflow" class="form-control" placeholder="https://stackoverflow.com/users/..." value="{{ old('stackoverflow', $user->stackoverflow) }}">
        </div>

        <div class="mb-3">
            <label for="portfolio" class="form-label">Portfolio URL:</label>
            <input id="portfolio" type="url" name="portfolio" class="form-control" placeholder="https://yourportfolio.com" value="{{ old('portfolio', $user->portfolio) }}">
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Resume (PDF, DOC, DOCX):</label>
            @if ($user->resume)
                <p class="resume-link">
                    <a href="{{ route('resume.view', ['filename' => $user->resume]) }}" target="_blank">View current resume</a>
                </p>
            @endif
            <input id="resume" type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx">
        </div>

        <div class="d-flex justify-content-center gap-2">
            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
