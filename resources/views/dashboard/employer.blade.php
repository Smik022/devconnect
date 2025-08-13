<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Employer Dashboard - DevConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">DevConnect</a>
            <div class="d-flex">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="mb-4">Employer Dashboard</h1>

        <p>Welcome, <strong>{{ $user->name }}</strong>!</p>
        <p>Your role: <strong>{{ $user->role }}</strong></p>

        <div class="mt-4">
            <a href="{{ route('jobposts.create') }}" class="btn btn-success me-2 mb-2">➕ Create a Job Post</a>
        </div>
    </div>

</body>
</html>
