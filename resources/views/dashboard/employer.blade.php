<!DOCTYPE html>
<html>
<head>
    <title>Employer Dashboard - DevConnect</title>
</head>
<body>
    <h1>Employer Dashboard</h1>

    <p>Welcome, {{ $user->name }}!</p>
    <p>Your role: {{ $user->role }}</p>

    <p>
        <a href="{{ route('home') }}">Home</a>
    </p>

    <p>
        <a href="{{ route('jobposts.create') }}">➕ Create a Job Post</a>
    </p>

    <p>
        <a href="{{ route('jobposts.index') }}">📃 View All Job Posts</a>
    </p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
