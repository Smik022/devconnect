<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevConnect - @yield('title', 'Welcome')</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styling -->
    <style>
        body {
            background-color: #f0f4f8;
        }

        /* Sticky Navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: linear-gradient(90deg, #0d6efd, #0056b3);
            transition: background 0.3s;
        }
        .navbar-brand {
            font-weight: bold;
            color: #ffffff !important;
        }
        .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav-link:hover, .nav-link:focus {
            color: #ffc107 !important;
        }

        /* Footer */
        footer {
            margin-top: 60px;
            background-color: #003366;
            color: #ffffff;
            padding: 30px 20px;
        }
        footer a {
            color: #ffc107;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }

        /* Buttons in Navbar */
        .navbar .btn-link {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
        }
        .navbar .btn-link:hover {
            color: #ffc107;
        }

        /* Container adjustments */
        .container.mt-4 {
            min-height: 80vh;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">DevConnect</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('interviews.index') }}">
                                {{-- <i class="fas fa-calendar-alt me-1"></i> --}}
                                Calendar
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('messages') }}">Messages</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p>&copy; {{ date('Y') }} DevConnect. All rights reserved.</p>
            <p>
                <a href="#">About Us</a> |
                <a href="#">Services</a> |
                <a href="#">Contact</a>
            </p>
            <p>Connect with us on 
                <a href="#">Twitter</a>, 
                <a href="#">LinkedIn</a>, 
                <a href="#">GitHub</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
