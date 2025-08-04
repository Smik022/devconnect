<!DOCTYPE html>
<html>
<head>
    <title>Edit Developer Profile - DevConnect</title>
</head>
<body>
    <h1>Edit Developer Profile</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('developer.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Bio:</label><br>
        <textarea name="bio" rows="4" cols="50">{{ old('bio', $user->bio) }}</textarea><br><br>

        <label>Skills:</label><br>
        <textarea name="skills" rows="3" cols="50">{{ old('skills', $user->skills) }}</textarea><br><br>

        <label>Experience:</label><br>
        <textarea name="experience" rows="4" cols="50">{{ old('experience', $user->experience) }}</textarea><br><br>

        <label>Education:</label><br>
        <textarea name="education" rows="3" cols="50">{{ old('education', $user->education) }}</textarea><br><br>

        <label>GitHub (username or full URL):</label><br>
        <input type="text" name="github" value="{{ old('github', $user->github) }}"><br><br>

        <label>StackOverflow URL:</label><br>
        <input type="url" name="stackoverflow" value="{{ old('stackoverflow', $user->stackoverflow) }}"><br><br>

        <label>Portfolio URL:</label><br>
        <input type="url" name="portfolio" value="{{ old('portfolio', $user->portfolio) }}"><br><br>

        <label>Resume (PDF, DOC, DOCX):</label><br>
        @if ($user->resume)
            <a href="{{ route('resume.view', ['filename' => $user->resume]) }}" target="_blank">View current resume</a><br><br>
        @endif
        <input type="file" name="resume"><br><br>

        <button type="submit">Update Profile</button>
    </form>

    <p><a href="{{ route('dashboard') }}">Back to Dashboard</a></p>
</body>
</html>
