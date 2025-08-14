<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>DevConnect</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

        <style>
            * {
                box-sizing: border-box;
            }
            body, html {
                margin: 0; padding: 0; height: 100%;
                font-family: Arial, sans-serif;
                background: #fff;
                color: #000;
            }

            header.main-header {
                position: fixed;
                top: 0; left: 0; right: 0;
                height: 50px;
                background: #000;
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 20px;
                font-weight: bold;
                z-index: 1001;
            }

            header.main-header .logo {
                font-size: 20px;
            }

            header.main-header nav {
                display: flex;
                align-items: center;
                gap: 20px;
            }

            header.main-header nav a:hover, header.main-header nav a:hover i {
                color: #1E90FF;
            }

            header.main-header nav a.user-profile:hover, header.main-header nav a.user-profile:hover i {
                color: #32CD32;
            }

            header.main-header nav a.notifications {
                position: relative;
                color: #fff;
                font-size: 20px;
                text-decoration: none;
            }

            header.main-header nav a.notifications span.badge {
                position: absolute;
                top: -6px;
                right: -10px;
                background: #ff0000;
                color: white;
                font-size: 10px;
                padding: 1px 5px;
                border-radius: 10px;
                font-weight: bold;
                line-height: 1;
                animation: pulseBadge 2s infinite ease-in-out;
            }

            @keyframes pulseBadge {
                0%, 100% {
                    background-color: #ff0000;
                    transform: scale(1);
                    box-shadow: none;
                }
                50% {
                    background-color: #cc0000;
                    transform: scale(1.05);
                    box-shadow: none;
                }
            }

            header.main-header nav a.user-profile {
                color: #fff;
                display: flex;
                align-items: center;
                gap: 6px;
                font-weight: 600;
                font-size: 14px;
                text-decoration: none;
            }

            header.main-header nav a.user-profile i {
                font-size: 20px;
            }

            .logout-btn {
                background-color: #fff;
                color: #000;
                border: 1px solid #ccc;
                padding: 2px 6px;
                border-radius: 4px;
                font-weight: 600;
                font-size: 0.85rem;
                cursor: pointer;
                transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .logout-btn i {
                font-size: 0.85rem;
            }

            .logout-btn:hover {
                background-color: #f2f2f2;
                color: #000;
                border-color: #aaa;
            }

            aside {
                position: fixed;
                top: 50px;
                left: 0;
                width: 180px;
                height: calc(100% - 50px);
                background: #f0f0f0;
                padding: 20px 10px;
                border-right: 1px solid #ccc;
            }

            aside nav a {
                display: flex;
                align-items: center;
                gap: 10px;
                color: #000;
                text-decoration: none;
                padding: 10px 15px;
                margin-bottom: 6px;
                border-left: 4px solid transparent;
                transition: background 0.2s, border-color 0.2s;
                font-weight: normal;
            }

            aside nav a.active,
            aside nav a:hover {
                background: #ddd;
                border-left: 4px solid #000;
                font-weight: bold;
            }

            aside nav i {
                font-size: 18px;
            }

            main {
                margin-left: 180px;
                padding: 80px 30px 30px;
            }

            aside nav a:nth-child(1):hover { color: #1E90FF; }
            aside nav a:nth-child(2):hover { color: #32CD32; }
            aside nav a:nth-child(3):hover { color: #6A5ACD; }
            aside nav a:nth-child(4):hover { color: #FF69B4; }
            aside nav a:nth-child(5):hover { color: #FF8C00; }
            aside nav a:nth-child(6):hover { color: #DAA520; }
            aside nav a:nth-child(7):hover { color: #FFA500; }
            aside nav a:nth-child(8):hover { color: #FF4500; }
            aside nav a:nth-child(9):hover { color: #8A2BE2; }

            aside nav a:nth-child(1):hover i { color: #1E90FF; }
            aside nav a:nth-child(2):hover i { color: #32CD32; }
            aside nav a:nth-child(3):hover i { color: #6A5ACD; }
            aside nav a:nth-child(4):hover i { color: #FF69B4; }
            aside nav a:nth-child(5):hover i { color: #FF8C00; }
            aside nav a:nth-child(6):hover i { color: #DAA520; }
            aside nav a:nth-child(7):hover i { color: #FFA500; }
            aside nav a:nth-child(8):hover i { color: #FF4500; }
            aside nav a:nth-child(9):hover i { color: #8A2BE2; }

            @keyframes brightGlowWhite {
                0%, 100% {
                    color: #fff;
                    text-shadow:
                    0 0 15px #fff,
                    0 0 30px #fff,
                    0 0 45px #fff,
                    0 0 60px #fff,
                    0 0 90px #fff;
                }
                50% {
                    color: #fff;
                    text-shadow:
                    0 0 30px #fff,
                    0 0 60px #fff,
                    0 0 90px #fff,
                    0 0 120px #fff,
                    0 0 150px #fff;
                }
            }

            @keyframes brightGlowGreen {
                0%, 100% {
                    color: #32CD32;
                    text-shadow:
                    0 0 15px #32CD32,
                    0 0 30px #32CD32,
                    0 0 45px #32CD32,
                    0 0 60px #008000,
                    0 0 90px #008000,
                    0 0 120px #008000;
                }
                50% {
                    color: #7CFC00;
                    text-shadow:
                    0 0 30px #32CD32,
                    0 0 60px #32CD32,
                    0 0 90px #008000,
                    0 0 120px #008000,
                    0 0 150px #008000,
                    0 0 180px #008000;
                }
            }

            .glow-white {
                animation: brightGlowWhite 2s ease-in-out infinite;
            }

            .glow-green {
                animation: brightGlowGreen 2s ease-in-out infinite;
            }

            .search-form {
                display: flex;
                align-items: center;
                position: relative;
            }

            .search-form input.form-control {
                padding: 4px 12px;
                font-size: 14px;
                height: 30px;
                background: #fff;
                color: #333;
                border: none;
                outline: none;
                transition: box-shadow 0.3s ease;
            }

            .search-form button.btn {
                padding: 0 10px;
                height: 30px;
                background: #fff;
                border: none;
                color: #666;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                outline: none;
                border-left: 1px solid #ccc;
                transition: color 0.3s ease, box-shadow 0.3s ease;
                position: relative;
            }

            .search-form .input-group {
                display: flex;
                align-items: center;
                border-radius: 25px;
                overflow: hidden;
                background-color: #fff;
                border: 1.5px solid #ccc;
                transition: box-shadow 0.3s ease, border-color 0.3s ease;
                box-shadow: none;
            }

            .search-form .input-group:hover, .search-form .input-group:focus-within {
                border-color: #b3d7ff;
                box-shadow: 0 0 4px rgba(0, 123, 255, 0.25);
            }



            .search-form input.form-control::placeholder {
                color: #888;
            }


            .search-form button.btn i {
                transition: color 0.3s ease, text-shadow 0.3s ease;
            }

            .search-form .input-group:hover button.btn i, .search-form .input-group:focus-within button.btn i {
                color: #007bff;
                text-shadow: none;
            }

            .search-form .input-group:hover button.btn {
                background-color: #f9f9f9;
                color: #007bff;
            }

            input.error::placeholder {
                color: #dc3545 !important;
            }
            input.error::-webkit-input-placeholder {
                color: #dc3545 !important;
            }
            input.error::-moz-placeholder {
                color: #dc3545 !important;
            }
            input.error:-ms-input-placeholder {
                color: #dc3545 !important;
            }
            input.error::-ms-input-placeholder {
                color: #dc3545 !important;
            }
            .search-form .input-group:hover button.btn {
                background-color: #f9f9f9;
            }

        </style>
    </head>
    <body>

        <header class="main-header">
            <div class="logo">
                <span class="glow-white">Dev</span><span class="glow-green">Connect</span>
            </div>
            <nav>
                <a href="#" class="notifications" title="Notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge">3</span>
                </a>
                <form class="search-form" role="search" action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        @php
                        $searchError = session('searchError');
                        @endphp

                        <input type="text" name="q" id="searchInput" class="form-control {{ $searchError ? 'error' : '' }}"
                        placeholder="{{ $searchError ?? 'Search...' }}" onfocus="clearSearchPlaceholder()"/>
                        <button class="btn" type="submit" aria-label="Search">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <a href="{{ route('admin_profile') }}" class="user-profile" style="display: flex; align-items: center; gap: 6px;">
                    <i class="bi bi-person-circle" style="font-size: 20px;"></i>
                    {{ Auth::guard('admin')->user()->name }}
                </a>

                <form method="POST" action="{{ route('admin_logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </nav>
        </header>

        <aside>
            <nav>
                <a href="{{ route('admin_dashboard') }}" class="{{ request()->routeIs('admin_dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('admin_profile') }}" class="{{ request()->routeIs('admin_profile') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i> Profile
                </a>
                <a href="{{ route('admin_developers') }}" class="{{ request()->routeIs('admin_developers') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Developers
                </a>
                <a href="{{ route('admin_employers') }}" class="{{ request()->routeIs('admin_employers') ? 'active' : '' }}">
                    <i class="bi bi-building"></i> Employers
                </a>
                <a href="{{ route('job_postings') }}" class="{{ request()->routeIs('job_postings') ? 'active' : '' }}">
                    <i class="bi bi-briefcase"></i> Postings
                </a>
                <a href="{{ route('pending_approvals') }}" class="{{ request()->routeIs('pending_approvals') ? 'active' : '' }}">
                    <i class="bi bi-hourglass-split"></i> Pending
                </a>
                <a href="#" class="{{ request()->routeIs('messages.index') ? 'active' : '' }}">
                    <i class="bi bi-chat-dots"></i> Messages
                </a>

                <a href="#" class="{{ request()->routeIs('help') ? 'active' : '' }}">
                    <i class="bi bi-question-circle"></i> Help
                </a>
            </nav>
        </aside>

        <main>
            @yield('content')
        </main>

        <script>
            function setSearchError(message) {
                const input = document.getElementById('searchInput');
                input.value = '';
                input.placeholder = message;
                input.classList.add('error');
            }

            function clearSearchPlaceholder() {
                const input = document.getElementById('searchInput');
                input.placeholder = 'Search...';
                input.classList.remove('error');
            }

            document.addEventListener('DOMContentLoaded', function () {
                @if(session('searchError'))
                setSearchError(@json(session('searchError')));
                @endif
            });
        </script>
    </body>
</html>
