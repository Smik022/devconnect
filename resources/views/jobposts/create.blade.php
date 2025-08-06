<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Post a Job - DevConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">DevConnect</a>
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-light">Back to Employer Dashboard</a>
        </div>
    </div>
</nav>

<div class="container">
    <h1 class="mb-4">Post a Job</h1>

    <form action="{{ route('jobposts.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input id="title" name="title" type="text" class="form-control" required>
            <div class="invalid-feedback">Please enter a job title.</div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
            <div class="invalid-feedback">Please enter a job description.</div>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category:</label>
            <select id="category" name="category" class="form-select" required>
                <option value="" disabled selected>Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select a category.</div>
        </div>

        <div class="mb-3">
            <label for="salary" class="form-label">Salary:</label>
            <input id="salary" name="salary" type="text" class="form-control" required>
            <div class="invalid-feedback">Please enter the salary.</div>
        </div>

        <div class="mb-3">
            <label for="job_type" class="form-label">Job Type:</label>
            <select id="job_type" name="job_type" class="form-select" required>
                <option value="" disabled selected>Select job type</option>
                <option value="Remote">Remote</option>
                <option value="Hybrid">Hybrid</option>
                <option value="Onsite">Onsite</option>
            </select>
            <div class="invalid-feedback">Please select a job type.</div>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location:</label>
            <input id="location" name="location" type="text" class="form-control" required>
            <div class="invalid-feedback">Please enter a location.</div>
        </div>

        <div class="mb-3">
            <label for="company_name" class="form-label">Company Name:</label>
            <input id="company_name" name="company_name" type="text" class="form-control" required>
            <div class="invalid-feedback">Please enter a company name.</div>
        </div>

        <button type="submit" class="btn btn-primary">Post Job</button>
    </form>
</div>

<script>
// Bootstrap validation script
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>

</body>
</html>
