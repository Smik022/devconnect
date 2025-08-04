<!DOCTYPE html>
<html>
<head>
    <title>Post a Job</title>
</head>
<body>
    <p><a href="{{ route('dashboard') }}">Back to Employer Dashboard</a></p>

    <h1>Post a Job</h1>

    <form action="{{ route('jobposts.store') }}" method="POST">
        @csrf

        <label>Title:</label>
        <input type="text" name="title"><br><br>

        <label>Description:</label>
        <textarea name="description"></textarea><br><br>

        <label>Category:</label>
        <select name="category">
            @foreach($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
            @endforeach
        </select><br><br>

        <label>Salary:</label>
        <input type="text" name="salary"><br><br>

        <label>Job Type:</label>
        <select name="job_type">
            <option value="Remote">Remote</option>
            <option value="Hybrid">Hybrid</option>
            <option value="Onsite">Onsite</option>
        </select><br><br>

        <label>Location:</label>
        <input type="text" name="location"><br><br>

        <label>Company Name:</label>
        <input type="text" name="company_name"><br><br>

        <button type="submit">Post Job</button>
    </form>
</body>
</html>
