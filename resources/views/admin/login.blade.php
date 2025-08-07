<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DevConnect - Login</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <style>
            body {
                background-color: #e9ecef;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            .login-container {
                transform: translate(0%, 14%);
                margin: auto;
                background-color: #ffffff;
                padding: 32px 28px;
                border-radius: 14px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
                width: 360px;
                color: #343a40;
            }

            .login-container h2 {
                font-size: 20px;
                font-weight: 700;
                color: #007bff;
                margin-bottom: 22px;
                text-align: center;
                letter-spacing: 0.6px;
            }

            .form-control.input-lg {
                height: 44px;
                font-size: 15px;
                padding: 10px 12px;
                border: 1.5px solid #ced4da;
                border-radius: 6px;
                transition: border-color 0.3s ease;
            }

            .form-control.input-lg:focus {
                border-color: #007bff;
                box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
                outline: none;
            }

            .btn-lg {
                padding: 11px 16px;
                font-size: 17px;
                border-radius: 8px;
                background-color: #007bff;
                border: none;
                transition: background-color 0.3s ease;
                font-weight: 600;
                color: #fff;
            }

            .btn-lg:hover, .btn-lg:focus {
                background-color: #0056b3;
                color: #fff;
                outline: none;
            }

            .forgot-show-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 13px;
                margin: 16px 0 22px 0;
                color: #495057;
            }

            .forgot-show-container label {
                margin: 0;
                cursor: pointer;
                user-select: none;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .forgot-show-container a {
                color: #007bff;
                text-decoration: none;
                font-weight: 500;
            }

            .forgot-show-container a:hover {
                text-decoration: underline;
            }

            .alert {
                font-size: 13px;
                padding: 8px;
            }

            .social-text {
                text-align: center;
                color: #6c757d;
                margin-top: 22px;
                font-size: 14px;
                letter-spacing: 0.4px;
            }

            .social-icons {
                display: flex;
                justify-content: center;
                margin-top: 12px;
            }

            .social-icons a {
                margin: 0 10px;
                font-size: 20px;
                color: #495057;
                transition: color 0.3s ease;
            }

            .social-icons a[title="Facebook"]:hover {
                color: #3b5998;
            }

            .social-icons a[title="Twitter"]:hover {
                color: #1da1f2;
            }

            .social-icons a[title="Google"]:hover {
                color: #db4437;
            }

            .glow-dev {
                color: white;
                font-weight: bold;
                animation: glowWhite 1s infinite alternate;
            }

            .glow-connect {
                color: #00ff00;
                font-weight: bold;
                animation: glowGreen 1s infinite alternate;
            }

            @keyframes glowWhite {
                from {
                    text-shadow: 0 0 2px white;
                }
                to {
                    text-shadow: 0 0 10px white, 0 0 20px white;
                }
            }

            @keyframes glowGreen {
                from {
                    text-shadow: 0 0 2px #00ff00;
                }
                to {
                    text-shadow: 0 0 10px #00ff00, 0 0 20px #00ff00;
                }
            }

            @media (max-width: 400px) {
                .login-container {
                    width: 90%;
                    padding: 24px 20px;
                }
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#" aria-label="DevConnect Home">
                    <span class="glow-dev">Dev</span><span class="glow-connect">Connect</span>
                    </a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="/login">Login</a></li>
                    <li><a href="#">Register</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <form class="navbar-form navbar-right" role="search" aria-label="Site search">
                    <div class="input-group">
                        <input
                        type="text"
                        class="form-control"
                        placeholder="Search"
                        name="search"
                        aria-label="Search"
                        />
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>

        <div class="login-container" role="main" aria-labelledby="login-heading">
            <h2 id="login-heading">Login</h2>

            @if(session('error'))            
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
            @csrf

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" id="email" class="form-control input-lg" required autofocus placeholder="you@example.com"/>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control input-lg" required placeholder="Enter your password"                    />
                </div>

                <div class="forgot-show-container">
                    <label><input type="checkbox" onclick="togglePassword()" /> Show password</label>
                    <a href="#">Forgot your password?</a>
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block" aria-label="Sign in"> Sign In </button>
            </form>

            <div class="social-text">Or sign in with</div>
            <div class="social-icons" role="region" aria-label="Social media login options">
                <a href="#" title="Facebook" aria-label="Sign in with Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" title="Twitter" aria-label="Sign in with Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" title="Google" aria-label="Sign in with Google"><i class="fab fa-google"></i></a>
            </div>
        </div>

        <script>
            function togglePassword() {
                const pwd = document.getElementById('password');
                pwd.type = pwd.type === 'password' ? 'text' : 'password';
            }
        </script>
    </body>
</html>
