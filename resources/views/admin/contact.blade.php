<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Contact - DevConnect</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
            h2 {
                margin-bottom: 20px;
                color: #333;
            }
            .navbar-inverse {
                margin-bottom: 0;
            }


            .contact-container {
                max-width: 600px;
                margin: 50px auto;
                padding: 20px 25px;
                background-color: #f9f9f9;
                border-radius: 12px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                line-height: 1.4;
            }

            .contact-container h2 {
                color: #333;
                margin-bottom: 12px;
                text-align: center;
                font-size: 2.5rem; 
            }

            .contact-container p {
                color: #555;
                font-size: 1.5rem; 
                text-align: center;
                margin-bottom: 12px;
            }

            .contact-container ul {
                list-style: none;
                padding: 0;
                margin-bottom: 30px;
            }

            .contact-container ul li {
                margin-bottom: 10px;
                font-size: 1.4rem; 
                display: flex;
                align-items: center;
                gap: 8px; 
            }

            .contact-container ul li i {
                font-size: 1.4rem; 
            }

            .contact-container .form-group {
                margin-bottom: 10px;
            }

            .contact-container label {
                font-weight: 600;
                margin-bottom: 8px;
                display: block;
                font-size: 1.4rem;
            }

            .contact-container .form-control {
                width: 100%;
                padding: 10px 12px; 
                font-size: 1.4rem;
                border-radius: 8px;
                border: 1px solid #ccc;
                transition: border-color 0.3s, box-shadow 0.3s;
            }

            .contact-container .form-control:focus {
                border-color: #007bff;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
                outline: none;
            }

            .contact-container .btn {
                width: 100%;
                padding: 10px;
                font-size: 1.4rem; 
                border-radius: 8px;
                transition: background-color 0.3s, transform 0.2s;
            }

            .contact-container .btn:hover {
                background-color: #0056b3;
                transform: translateY(-2px);
            }

            @media (max-width: 768px) {
                .contact-container {
                    padding: 30px 20px;
                    margin: 30px 15px;
                }
            }

        </style>

    </head>
    <body>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/" aria-label="DevConnect Home">
                        <span class="glow-dev">Dev</span><span class="glow-connect">Connect</span>
                    </a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/admin/login">Admin Login</a></li>
                    <li class="active"><a href="/admin/contact">Contact</a></li>
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

        <div class="container contact-container">
            <h2>Contact Admin Support</h2>
            <p>If you encounter any issues logging in or managing the admin panel, please use the contact form below or reach out directly:</p>

            <ul>
                <li><i class="bi bi-envelope-fill me-2 text-primary"></i> Email: <a href="mailto:support@devconnect.com">support@devconnect.com</a></li>
                <li><i class="bi bi-telephone-fill me-2 text-success"></i> Phone: +1-234-567-8901</li>
            </ul>

            <div id="alert-placeholder"></div>

            <form id="contactForm">
                <div class="form-group">
                    <label for="name">Your Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>

                <div class="form-group">
                    <label for="email">Your Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="issue">Describe Your Issue:</label>
                    <textarea class="form-control" id="issue" name="issue" rows="5" placeholder="Explain the issue clearly" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Send Message</button>
            </form>
        </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $('#contactForm').submit(function(e) {
            e.preventDefault();
            let success = true; 

            if(success){
                $('#alert-placeholder').html(
                    '<div class="alert alert-success alert-dismissible text-center">' +
                    'Your message has been sent successfully. We will get back to you shortly.' 
                    '</div>'
                );
                $('#contactForm')[0].reset(); 
            } else {
                $('#alert-placeholder').html(
                    '<div class="alert alert-danger alert-dismissible text-center">' +
                    'There was an error sending your message. Please try again later.' 
                    '</div>'
                );
            }
        });
    </script>
    </body>
</html>
