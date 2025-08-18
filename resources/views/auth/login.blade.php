@extends('layouts.app')

@section('title', 'Login - DevConnect')

@section('content')
<style>
    .login-container {
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-login {
        border-radius: 20px;
        background: #1a2a50;
        box-shadow: 0 8px 30px rgba(0,0,0,0.5);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }

    .card-login:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.7);
    }

    .card-login .card-header {
        background: linear-gradient(90deg, #0055ff, #00ccff);
        color: #fff;
        text-align: center;
        font-weight: 700;
        font-size: 1.5rem;
        border-bottom: none;
        border-radius: 20px 20px 0 0;
    }

    .card-login .form-control {
        border-radius: 12px;
        background: #0e1b3a;
        color: #00ccff;
        border: 1px solid #004aad;
    }

    .card-login .form-control::placeholder {
        color: rgba(0,204,255,0.6);
    }

    .card-login .form-control:focus {
        background: #13294d;
        color: #00ccff;
        border-color: #00ccff;
        box-shadow: 0 0 10px rgba(0,204,255,0.5);
    }

    .card-login .btn-primary {
        border-radius: 12px;
        background: linear-gradient(90deg, #00ccff, #0055ff);
        border: none;
        font-weight: 600;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-login .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,204,255,0.5);
    }

    .card-login .form-label,
    .card-login .form-check-label {
        color: #00ccff;
        font-weight: 600;
    }

    .dont-have-account,
    .dont-have-account a {
        color: #ffffff !important;
        font-weight: 600;
        text-decoration: none;
    }

    .dont-have-account a:hover {
        color: #00ccff !important;
        text-decoration: underline;
    }

    .alert-danger {
        background: rgba(255,0,0,0.2);
        border: none;
        color: #ff6666;
    }
</style>

<div class="login-container">
    <div class="col-md-6 col-lg-5">
        <div class="card card-login shadow-lg">
            <div class="card-header">
                🔐 DevConnect Login
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

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your email" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Login</button>
                    </div>
                </form>

                <p class="mt-3 text-center dont-have-account">
                    Don't have an account? <a href="{{ route('register') }}">Register here</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
