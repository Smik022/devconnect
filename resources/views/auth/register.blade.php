<!DOCTYPE html>
<html>
<head>
    <title>Register - DevConnect</title>
</head>
<body>
    <h1>Register</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="password_confirmation" required><br><br>

        <label>Role:</label><br>
        <select name="role" required>
            <option value="" disabled selected>Select Role</option>
            <option value="Developer" {{ old('role') == 'Developer' ? 'selected' : '' }}>Developer</option>
            <option value="Employer" {{ old('role') == 'Employer' ? 'selected' : '' }}>Employer</option>
        </select><br><br>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
</body>
</html>
