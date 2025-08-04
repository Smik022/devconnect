<!DOCTYPE html>
<html>
<head>
    <title>DevConnect - @yield('title')</title>
    <style>
        /* Simple navigation bar styling */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .navbar {
            background-color: #333;
            color: white;
            padding: 15px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
