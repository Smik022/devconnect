<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Developer Profile - DevConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">DevConnect</a>
    </div>
</nav>

<div class="container">
    <h1 class="mb-4">Edit Developer Profile</h1>

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

    <form action="{{ route('developer.profile.update') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf

        <div class="mb-3">
            <label for="bio" class="form-label">Bio:</label>
            <textarea id="bio" name="bio" rows="4" class="form-control">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="skills" class="form-label">Skills:</label>
            <textarea id="skills" name="skills" rows="3" class="form-control">{{ old('skills', $user->skills) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="experience" class="form-label">Experience:</label>
            <textarea id="experience" name="experience" rows="4" class="form-control">{{ old('experience', $user->experience) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="education" class="form-label">Education:</label>
            <textarea id="education" name="education" rows="3" class="form-control">{{ old('education', $user->education) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="github" class="form-label">GitHub (username or full URL):</label>
            <input id="github" type="text" name="github" class="form-control" value="{{ old('github', $user->github) }}">
        </div>

        <div class="mb-3">
            <label for="stackoverflow" class="form-label">StackOverflow URL:</label>
            <input id="stackoverflow" type="url" name="stackoverflow" class="form-control" value="{{ old('stackoverflow', $user->stackoverflow) }}">
        </div>

        <div class="mb-3">
            <label for="portfolio" class="form-label">Portfolio URL:</label>
            <input id="portfolio" type="url" name="portfolio" class="form-control" value="{{ old('portfolio', $user->portfolio) }}">
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Resume (PDF, DOC, DOCX):</label>
            @if ($user->resume)
                <p>
                    <a href="{{ route('resume.view', ['filename' => $user->resume]) }}" target="_blank">View current resume</a>
                </p>
            @endif
            <input id="resume" type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>

</body>
</html>
