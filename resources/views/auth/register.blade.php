@extends('layouts.app')

@section('title', 'Register - DevConnect')

@section('content')
<style>
    .register-container {
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-register {
        border-radius: 20px;
        background: #1a2a50;
        box-shadow: 0 8px 30px rgba(0,0,0,0.5);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }

    .card-register:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.7);
    }

    .card-register .card-header {
        background: linear-gradient(90deg, #0055ff, #00ccff);
        color: #fff;
        text-align: center;
        font-weight: 700;
        font-size: 1.5rem;
        border-bottom: none;
        border-radius: 20px 20px 0 0;
    }

    .card-register .form-control,
    .card-register .form-select {
        border-radius: 12px;
        background: #0e1b3a;
        color: #00ccff;
        border: 1px solid #004aad;
    }

    .card-register .form-control::placeholder {
        color: rgba(0,204,255,0.6);
    }

    .card-register .form-control:focus,
    .card-register .form-select:focus {
        background: #13294d;
        color: #00ccff;
        border-color: #00ccff;
        box-shadow: 0 0 10px rgba(0,204,255,0.5);
    }

    .card-register .btn-primary {
        border-radius: 12px;
        background: linear-gradient(90deg, #00ccff, #0055ff);
        border: none;
        font-weight: 600;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-register .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,204,255,0.5);
    }

    .card-register .form-label {
        color: #00ccff;
        font-weight: 600;
    }

    .card-register .dont-have-account,
    .card-register .dont-have-account a {
        color: #ffffff !important;
        font-weight: 600;
        text-decoration: none;
    }

    .card-register .dont-have-account a:hover {
        color: #00ccff !important;
        text-decoration: underline;
    }

    .alert-danger {
        background: rgba(255,0,0,0.2);
        border: none;
        color: #ff6666;
    }
</style>

<div class="register-container">
    <div class="col-md-6 col-lg-5">
        <div class="card card-register shadow-lg">
            <div class="card-header">
                📝 Register
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter your name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="Developer" {{ old('role') == 'Developer' ? 'selected' : '' }}>Developer</option>
                            <option value="Employer" {{ old('role') == 'Employer' ? 'selected' : '' }}>Employer</option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Register</button>
                    </div>
                </form>

            </div>
            <div class="card-footer text-center dont-have-account">
                Already have an account? <a href="{{ route('login') }}">Login here</a>
            </div>
        </div>
    </div>
</div>
@endsection
