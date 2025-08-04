<!DOCTYPE html>
<html>
<head>
    <title>Developer Dashboard - DevConnect</title>
</head>
<body>
    <h1>Developer Dashboard</h1>

    <p>Welcome, {{ $user->name }}!</p>
    <p>Your role: {{ $user->role }}</p>

    <hr>

    <h2>GitHub Profile</h2>

    @if ($githubData)
        <img src="{{ $githubData['avatar_url'] }}" alt="Avatar" width="120" height="120" style="border-radius:50%;">
        <p><strong>Username:</strong> {{ $githubData['login'] }}</p>
        <p><strong>Name:</strong> {{ $githubData['name'] ?? 'N/A' }}</p>
        <p><strong>Bio:</strong> {{ $githubData['bio'] ?? 'N/A' }}</p>
        <p><strong>Company:</strong> {{ $githubData['company'] ?? 'N/A' }}</p>
        <p><strong>Location:</strong> {{ $githubData['location'] ?? 'N/A' }}</p>
        <p><strong>Blog:</strong>
            @if ($githubData['blog'])
                <a href="{{ $githubData['blog'] }}" target="_blank">{{ $githubData['blog'] }}</a>
            @else
                N/A
            @endif
        </p>
        <p><strong>Twitter:</strong>
            @if ($githubData['twitter_username'])
                <a href="https://twitter.com/{{ $githubData['twitter_username'] }}" target="_blank">@{{ $githubData['twitter_username'] }}</a>
            @else
                N/A
            @endif
        </p>
        <p><strong>Public Repos:</strong> {{ $githubData['public_repos'] }}</p>
        <p><strong>Followers:</strong> {{ $githubData['followers'] }}</p>
        <p><strong>Following:</strong> {{ $githubData['following'] }}</p>
        <p><strong>Account Created:</strong> {{ date('F j, Y', strtotime($githubData['created_at'])) }}</p>
        <p><a href="{{ $githubData['html_url'] }}" target="_blank">View GitHub Profile</a></p>
    @else
        <p style="color: red;">
            Please update your GitHub link in
            <a href="{{ route('developer.profile.edit') }}">Edit Profile</a> to fetch your GitHub data.
        </p>
    @endif

    <br><br>
    <a href="{{ route('developer.profile.edit') }}">✏️ Edit Profile</a><br>
    <a href="{{ route('home') }}">🏠 Go to Home</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
