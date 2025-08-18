<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>DevConnect</title>
        <meta name="description" content="">
        <meta name="keywords" content="">

        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="assets/css/main.css" rel="stylesheet">
        
        <style>

            html::-webkit-scrollbar {
              width: 0px;       
              background: transparent;
            }

            html {
              scrollbar-width: none; 
              -ms-overflow-style: none;
              overflow: auto;
            }

            html, body {
              height: 100%;
              margin: 0;
              padding: 0;
            }
            
        </style>
        
    </head>

    <body class="index-page">

        <header id="header" class="header d-flex align-items-center fixed-top">
            <div class="container position-relative d-flex align-items-center justify-content-between">

                <!-- Logo -->
                <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                    <h1 class="sitename">DevConnect</h1>
                </a>

                <!-- Navigation -->
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="#hero" class="active">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#call-to-action">Get Started</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

<!-- CTAs -->
<div class="d-flex gap-3 align-items-center">
    @guest
        <a class="btn-getstarted" href="{{ route('login') }}">Sign In</a>
    @endguest

    @auth
        <span class="text-black fw-semibold">
            Hello, {{ Auth::user()->name }}!
        </span>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-dark btn-sm">
            Go to Dashboard
        </a>
    @endauth
</div>


        </header>

        <main class="main">
            
            <!-- Hero Section -->
            <section id="hero" class="hero section">
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row align-items-center">
                        <!-- Hero Text -->
                        <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="200">
                            <div class="hero-content">
                                <h1 class="hero-title">Empowering Developers & Employers</h1>
                                <p class="hero-description">
                                    DevConnect bridges the gap between top tech talent and innovative projects. Discover jobs, connect with skilled developers, and collaborate seamlessly.
                                </p>
                                <div class="hero-actions">
                                    <a href="{{ route('register') }}" class="btn-primary">Join Now</a>
                                    <a href="{{ route('login') }}" class="btn-secondary"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                                </div>
                            </div>
                        </div>
                        <!-- Hero Visual -->
                        <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="300">
                            <div class="hero-visual">
                                <div class="hero-image-wrapper">
                                    <img src="assets/img/illustration/illustration-15.webp" class="img-fluid hero-image" alt="Hero Illustration">
                                    <div class="floating-elements">
                                        <div class="floating-card card-1">
                                            <i class="bi bi-person-badge"></i>
                                            <span>User Registration</span>
                                        </div>
                                        <div class="floating-card card-2">
                                            <i class="bi bi-briefcase-fill"></i>
                                            <span>Job Posting</span>
                                        </div>
                                        <div class="floating-card card-3">
                                            <i class="bi bi-people-fill"></i>
                                            <span>Collaboration Workspace</span>
                                        </div>
                                        <div class="floating-card card-4">
                                            <i class="bi bi-calendar-check"></i>
                                            <span>Interview Scheduling</span>
                                        </div>
                                        <div class="floating-card card-5">
                                            <i class="bi bi-github"></i>
                                            <span>GitHub Integration</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Hero Section -->
            
            <!-- About Section -->
            <section id="about" class="about section">

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row gy-5">

                        <!-- About Text -->
                        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                            <div class="content-wrapper">
                                <div class="section-header">
                                    <span class="section-badge">ABOUT DEVCONNECT</span>
                                    <h2>Connecting Talent with Opportunity</h2>
                                </div>

                                <p class="lead-text">
                                 DevConnect bridges skilled developers and innovative employers. Our platform simplifies hiring, job discovery, and project collaboration.
                                </p>
                                <p class="description-text">
                                    With secure registration, role-based dashboards, directories, API integrations, and collaboration tools, we make talent discovery and project management effortless.
                                </p>
                                <div class="stats-grid">
                                    <div class="stat-item">
                                        <div class="stat-number">500+</div>
                                        <div class="stat-label">Developers Registered</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">200+</div>
                                        <div class="stat-label">Jobs Posted</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">100+</div>
                                        <div class="stat-label">Employers Served</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number">24/7</div>
                                        <div class="stat-label">Support Available</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- About Visuals -->
                        <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                            <div class="visual-section">
                                <div class="main-image-container">
                                    <img src="assets/img/about/about-8.webp" alt="Professional team collaboration" class="img-fluid main-visual">
                                    <div class="overlay-card">
                                        <div class="card-content">
                                            <h4>Smart Collaboration</h4>
                                            <p>We ensure developers and employers connect efficiently for every opportunity.</p>
                                            <div class="card-icon">
                                                <i class="bi bi-diagram-3-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="secondary-images">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <img src="assets/img/about/about-11.webp" alt="Developer collaboration" class="img-fluid secondary-img">
                                        </div>
                                        <div class="col-6">
                                            <img src="assets/img/about/about-5.webp" alt="Employer workspace" class="img-fluid secondary-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Features -->
                    <div class="row mt-5">
                        <div class="col-12" data-aos="fade-up" data-aos-delay="400">
                            <div class="features-section">
                                <div class="row gy-4">
                                    <div class="col-md-4">
                                        <div class="feature-box">
                                            <div class="feature-icon">
                                                <i class="bi bi-person-plus-fill"></i>
                                            </div>
                                            <h5>User & Role Management</h5>
                                            <p>Secure registration, authentication, and role-based dashboards for developers and employers.</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="feature-box">
                                            <div class="feature-icon">
                                                <i class="bi bi-search"></i>
                                            </div>
                                            <h5>Directories & Profiles</h5>
                                            <p>Developer and employer directories with search functionality and profile management.</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="feature-box">
                                            <div class="feature-icon">
                                                <i class="bi bi-geo-alt-fill"></i>
                                            </div>
                                            <h5>Maps & Location</h5>
                                            <p>Open Street Map integration to visualize talent and opportunities geographically.</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="feature-box">
                                            <div class="feature-icon">
                                                <i class="bi bi-briefcase-fill"></i>
                                            </div>
                                            <h5>Jobs & Applications</h5>
                                            <p>Post jobs, apply, track proposals, and save favorites using a convenient wishlist.</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="feature-box">
                                            <div class="feature-icon">
                                                <i class="bi bi-people-fill"></i>
                                            </div>
                                            <h5>Collaboration & GitHub</h5>
                                            <p>Project workspaces, file sharing, messaging, and GitHub API integration for smooth collaboration.</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="feature-box">
                                            <div class="feature-icon">
                                                <i class="bi bi-calendar-check-fill"></i>
                                            </div>
                                            <h5>Scheduling & Notifications</h5>
                                            <p>Calendar management, interview scheduling, and real-time notifications for jobs and messages.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- /About Section -->
            
            <!-- Features Section -->
            <section id="features" class="features section">
                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <span class="description-title">Features</span>
                    <h2>Platform Features</h2>
                    <p>Empowering developers and employers with seamless tools and collaboration.</p>
                </div>

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="tabs-wrapper">
                            <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">

                                <!-- User & Role Management -->
                                <li class="nav-item">
                                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                                        <div class="tab-icon">
                                            <i class="bi bi-person-check"></i>
                                        </div>
                                        <div class="tab-content">
                                            <h5>User Roles</h5>
                                            <span>Secure registration & access</span>
                                        </div>
                                    </a>
                                </li>

                                <!-- Developer & Employer Directory -->
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                                        <div class="tab-icon">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="tab-content">
                                            <h5>Directory</h5>
                                            <span>Find and connect easily</span>
                                        </div>
                                    </a>
                                </li>

                                <!-- Jobs & Applications -->
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                                        <div class="tab-icon">
                                            <i class="bi bi-briefcase-fill"></i>
                                        </div>
                                        <div class="tab-content">
                                            <h5>Jobs & Applications</h5>
                                            <span>Post, apply, and manage jobs</span>
                                        </div>
                                    </a>
                                </li>

                                <!-- Collaboration & Tools -->
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4">
                                        <div class="tab-icon">
                                            <i class="bi bi-tools"></i>
                                        </div>
                                        <div class="tab-content">
                                            <h5>Collaboration</h5>
                                            <span>Workspace & tools</span>
                                        </div>
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
                                <!-- User & Role Management -->
                                <div class="tab-pane fade active show" id="features-tab-1">
                                    <div class="row align-items-center">
                                        <div class="col-lg-5">
                                            <div class="content-wrapper">
                                                <div class="icon-badge">
                                                    <i class="bi bi-person-check"></i>
                                                </div>
                                                <h3>User Registration & Role-Based Access</h3>
                                                <p>Secure onboarding for developers and employers with role-based dashboards to provide tailored experiences and permissions.</p>
                                                <div class="feature-grid">
                                                    <div class="feature-item">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>Secure user registration & authentication</span>
                                                    </div>
                                                    <div class="feature-item">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>Separate dashboards for developers & employers</span>
                                                    </div>
                                                    <div class="feature-item">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>Role-based access control for all platform sections</span>
                                                    </div>
                                                    <div class="feature-item">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>Job & Project Management Analytics</span>
                                                    </div>
                                                </div>
                                                <a href="#" class="btn-primary">Learn More <i class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="visual-content">
                                                <div class="main-image">
                                                    <img src="assets/img/features/features-4.webp" alt="User & Role Management" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Developer & Employer Directory -->
                                <div class="tab-pane fade" id="features-tab-2">
                                    <div class="row align-items-center">
                                        <div class="col-lg-5">
                                            <div class="content-wrapper">
                                                <div class="icon-badge">
                                                    <i class="bi bi-people"></i>
                                                </div>
                                                <h3>Developer & Employer Directory</h3>
                                                <p>Find and connect with developers or employers easily using powerful search filters and detailed profiles.</p>
                                                <div class="feature-grid">
                                                    <div class="feature-item">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>Developer and employer listings</span>
                                                    </div>
                                                    <div class="feature-item">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>Advanced Search and Filter Options</span>
                                                    </div>
                                                    <div class="feature-item">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>Profile details for informed decisions</span>
                                                    </div>
                                                    <div class="feature-item">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>OpenStreetMap integration for location-based search</span>
                                                    </div>
                                                </div>
                                                <a href="#" class="btn-primary">Learn More <i class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="visual-content">
                                                <div class="main-image">
                                                    <img src="assets/img/features/features-2.webp" alt="Developer & Employer Directory" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Jobs & Applications -->
                                <div class="tab-pane fade" id="features-tab-3">
                                    <div class="row align-items-center">
                                        <div class="col-lg-5">
                                            <div class="content-wrapper">
                                                <div class="icon-badge">
                                                    <i class="bi bi-briefcase-fill"></i>
                                                </div>
                                                <h3>Jobs, Applications & Wishlists</h3>
                                                <p>Employers can post jobs and manage applications while developers can apply, propose, and save favorite jobs.</p>
                                                <div class="feature-grid">
                                                <div class="feature-item">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    <span>Job Posting and Application Management</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    <span>Apply to jobs and submit proposals</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    <span>Job wishlists for future opportunities</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    <span>Track job status and notifications</span>
                                                </div>
                                                </div>
                                                <a href="#" class="btn-primary">Learn More <i class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="visual-content">
                                                <div class="main-image">
                                                  <img src="assets/img/features/features-6.webp" alt="Jobs & Applications" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Collaboration & Tools -->
                                <div class="tab-pane fade" id="features-tab-4">
                                    <div class="row align-items-center">
                                        <div class="col-lg-5">
                                            <div class="content-wrapper">
                                                <div class="icon-badge">
                                                    <i class="bi bi-tools"></i>
                                                </div>
                                                <h3>Collaboration & Productivity Tools</h3>
                                                <p>Enhance teamwork with project workspace, GitHub integration, messaging, scheduling, and notifications all in one place.</p>
                                                <div class="feature-grid">
                                                    <div class="feature-item">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>Project collaboration workspace</span>
                                                    </div>
                                                    <div class="feature-item">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>GitHub API Service Integration Platform</span>
                                                    </div>
                                                    <div class="feature-item">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>Messaging and Alert Notifications</span>
                                                    </div>
                                                    <div class="feature-item">
                                                        <i class="bi bi-check-circle-fill"></i>
                                                        <span>Calendar and interview scheduling</span>
                                                    </div>
                                                </div>
                                                <a href="#" class="btn-primary">Learn More <i class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="visual-content">
                                                <div class="main-image">
                                                 <img src="assets/img/features/features-1.webp" alt="Collaboration & Tools" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </section>            
            <!-- /Features Section -->
            
            <!-- /Features Cards Section -->
            <section id="features-cards" class="features-cards section">

                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="row g-4">
                        <!-- First row with two larger cards -->
                        <div class="col-lg-6" data-aos="flip-left" data-aos-delay="100">
                            <div class="feature-card">
                                <div class="icon-box">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                                <h3>User Registration & Authentication</h3>
                                <p>Securely register and log in to the platform. Access personalized dashboards and manage profiles with confidence.</p>
                                <ul class="feature-list">
                                    <li><i class="bi bi-check-circle"></i> Email & social authentication</li>
                                    <li><i class="bi bi-check-circle"></i> Password recovery system</li>
                                    <li><i class="bi bi-check-circle"></i> Role-based access control</li>
                                </ul>
                                <a href="#" class="read-more">Get Started <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-6" data-aos="flip-left" data-aos-delay="200">
                            <div class="feature-card">
                                <div class="icon-box">
                                    <i class="bi bi-diagram-3"></i>
                                </div>
                                <h3>Developer & Employer Dashboards</h3>
                                <p>Access tailored dashboards for developers and employers to manage projects, applications, and collaborations efficiently.</p>
                                <ul class="feature-list">
                                    <li><i class="bi bi-check-circle"></i> Personalized interface for each role</li>
                                    <li><i class="bi bi-check-circle"></i> Overview of jobs, applications, and collaborations</li>
                                    <li><i class="bi bi-check-circle"></i> Notifications & activity tracking</li>
                                </ul>
                                <a href="#" class="read-more">View Dashboards <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>

                        <!-- Second row with four smaller cards -->
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="compliance-card">
                                <h4>Directories</h4>
                                <p class="status in-progress">Search & Connect</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="compliance-card">
                                <h4>OpenStreetMap Integration</h4>
                                <p class="status compliant">Location-based features</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="compliance-card">
                                <h4>Job Applications & Proposals</h4>
                                <p class="status compliant">Implemented</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="compliance-card">
                                <h4>Collaboration Workspace</h4>
                                <p class="status planned">Upcoming</p>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- /Features Cards Section -->
            
            <!-- /Features 2 Section -->
            <section id="features-2" class="features-2 section">

                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="row g-4">
                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="150">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="bi bi-person-lines-fill"></i>
                                </div>
                                <h3>Profile & Job Management</h3>
                                <p>Developers can manage profiles and portfolios, while employers can post jobs and maintain a wishlist of preferred candidates.</p>
                                <ul class="feature-benefits">
                                    <li><i class="bi bi-check-circle-fill"></i> Developer profile updates</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Job postings & wishlist</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Portfolio & project showcases</li>
                                </ul>
                                <div class="feature-image">
                                  <img src="assets/img/features/features-1.webp" alt="Dashboard Interface" class="img-fluid" loading="lazy">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-card highlighted">
                                <div class="feature-icon">
                                    <i class="bi bi-chat-left-text"></i>
                                </div>
                                <h3>Messaging & Scheduling</h3>
                                <p>Communicate directly with developers or employers, schedule interviews, and keep track of important deadlines and meetings.</p>
                                <ul class="feature-benefits">
                                    <li><i class="bi bi-check-circle-fill"></i> Instant messaging system</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Calendar & interview scheduling</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Automated notifications</li>
                                </ul>
                                <div class="feature-image">
                                 <img src="assets/img/features/features-2.webp" alt="Engagement Tools" class="img-fluid" loading="lazy">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="250">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="bi bi-github"></i>
                                </div>
                                <h3>GitHub & Collaboration</h3>
                                <p>Integrate GitHub for project tracking, proposals, and seamless collaboration between developers and employers.</p>
                                <ul class="feature-benefits">
                                    <li><i class="bi bi-check-circle-fill"></i> GitHub repository sync</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Collaborative workspace tools</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Project progress notifications</li>
                                </ul>
                                <div class="feature-image">
                                  <img src="assets/img/features/features-3.webp" alt="Security Features" class="img-fluid" loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /Features 2 Section -->

            <!-- Call To Action Section -->
            <section id="call-to-action" class="call-to-action section dark-background">
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row align-items-lg-center">
                        
                            <div class="col-lg-5 order-lg-2" data-aos="fade-left" data-aos-delay="200">
                                <div class="image-wrapper position-relative">
                                    <div class="floating-card">
                                        <i class="bi bi-diagram-3"></i>
                                        <h4>Smart Job & Project Management</h4>
                                        <p>From posting jobs to collaborating on projects, DevConnect makes hiring and teamwork seamless for both developers and employers.</p>
                                    </div>
                                    <img src="assets/img/misc/misc-6.webp" alt="DevConnect Dashboard" class="img-fluid main-image">
                                </div>
                            </div>

                            <div class="col-lg-6 offset-lg-1 order-lg-1" data-aos="fade-right" data-aos-delay="100">
                                <div class="content-area">
                                    <h2>Where Developers & Employers Connect</h2>
                                    <p>DevConnect brings together discovery, collaboration, and project management into one simple platform.</p>

                                    <ul class="feature-list">
                                        <li>
                                            <i class="bi bi-person-plus"></i>
                                            <span>Secure registration & role-based dashboards</span>
                                        </li>
                                        <li>
                                            <i class="bi bi-search"></i>
                                            <span>Developer & employer directory with advanced search</span>
                                        </li>
                                        <li>
                                            <i class="bi bi-briefcase"></i>
                                            <span>Job postings, applications & wish lists</span>
                                        </li>
                                        <li>
                                            <i class="bi bi-columns-gap"></i>
                                            <span>Collaboration workspace with GitHub integration</span>
                                        </li>
                                        <li>
                                            <i class="bi bi-calendar-event"></i>
                                            <span>Messaging, notifications & interview scheduling</span>
                                        </li>
                                    </ul>
                                    <div class="cta-wrapper">
                                        <a href="{{ route('register') }}" class="btn btn-cta">Get Started with DevConnect</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </section>
            <!-- /Call To Action Section -->

            <!-- Testimonials Section -->
            <section id="testimonials" class="testimonials section">
                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <span class="description-title">Testimonials</span>
                    <h2>What Our Users Say</h2>
                    <p>Discover how DevConnect empowers developers and employers through seamless collaboration, hiring, and project management.</p>
                    
                </div><!-- End Section Title -->

                <div class="container">
                    <div class="testimonial-masonry">
                        <div class="testimonial-item" data-aos="fade-up">
                            <div class="testimonial-content">
                                <div class="quote-pattern">
                                    <i class="bi bi-quote"></i>
                                </div>
                                <p>Signing up was simple, and the authentication system gave me a secure way to manage my profile. The role-based dashboard really personalizes the experience.</p>
                                <div class="client-info">
                                    <div class="client-image">
                                        <img src="assets/img/person/person-f-7.webp" alt="Client">
                                    </div>
                                    <div class="client-details">
                                        <h3>Rachel Bennett</h3>
                                        <span class="position">Full Stack Developer</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="100">
                            <div class="testimonial-content">
                                <div class="quote-pattern">
                                    <i class="bi bi-quote"></i>
                                </div>
                                <p>The employer dashboard makes it easy to post jobs, review proposals, and connect with skilled developers. It’s streamlined our hiring process tremendously.</p>
                                <div class="client-info">
                                    <div class="client-image">
                                        <img src="assets/img/person/person-m-7.webp" alt="Client">
                                    </div>
                                    <div class="client-details">
                                        <h3>Daniel Morgan</h3>
                                        <span class="position">CTO</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="testimonial-content">
                                <div class="quote-pattern">
                                    <i class="bi bi-quote"></i>
                                </div>
                                <p>The developer directory and advanced search tools help me showcase my skills and get discovered by employers faster than ever before.</p>
                                <div class="client-info">
                                    <div class="client-image">
                                        <img src="assets/img/person/person-f-8.webp" alt="Client">
                                    </div>
                                    <div class="client-details">
                                        <h3>Emma Thompson</h3>
                                        <span class="position">Software Engineer</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial-item" data-aos="fade-up" data-aos-delay="300">
                            <div class="testimonial-content">
                                <div class="quote-pattern">
                                    <i class="bi bi-quote"></i>
                                </div>
                                <p>The integration with OpenStreetMap makes finding local talent and collaboration opportunities incredibly convenient.</p>
                                <div class="client-info">
                                    <div class="client-image">
                                        <img src="assets/img/person/person-m-8.webp" alt="Client">
                                    </div>
                                    <div class="client-details">
                                        <h3>Michael Thompson</h3>
                                        <span class="position">CTO, TechSolutions</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="400">
                            <div class="testimonial-content">
                                <div class="quote-pattern">
                                    <i class="bi bi-quote"></i>
                                </div>
                                <p>Linking my GitHub profile directly to my DevConnect account lets employers see my projects instantly. It’s a game-changer for showcasing real work.</p>
                                <div class="client-info">
                                    <div class="client-image">
                                        <img src="assets/img/person/person-f-9.webp" alt="Client">
                                    </div>
                                    <div class="client-details">
                                        <h3>Sarah Williams</h3>
                                        <span class="position">Lead Developer, CodeHub</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial-item" data-aos="fade-up" data-aos-delay="500">
                            <div class="testimonial-content">
                                <div class="quote-pattern">
                                    <i class="bi bi-quote"></i>
                                </div>
                                <p>Between the built-in messaging, notifications, and calendar scheduling, collaborating with developers has never been this organized and efficient.</p>
                                <div class="client-info">
                                    <div class="client-image">
                                        <img src="assets/img/person/person-m-13.webp" alt="Client">
                                    </div>
                                    <div class="client-details">
                                        <h3>David Lee</h3>
                                        <span class="position">HR Manager, InnovateTech</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /Testimonials Section -->

            <!-- FAQ Section -->
            <section id="faq" class="faq section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
                            <div class="faq-container">
                                <div class="faq-item faq-active">
                                    <h3>What is DevConnect?</h3>
                                    <div class="faq-content">
                                       <p>DevConnect is a collaborative platform that bridges developers and employers. It offers role-based dashboards, job postings, profile management, and tools to simplify hiring and project collaboration.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->

                                <div class="faq-item">
                                    <h3>How does registration and authentication work?</h3>
                                    <div class="faq-content">
                                        <p>Users can sign up as either a developer or an employer with secure authentication. Once logged in, each user has access to a personalized dashboard tailored to their role.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->

                                <div class="faq-item">
                                    <h3>How can employers and developers find each other?</h3>
                                    <div class="faq-content">
                                        <p>DevConnect features searchable directories for both developers and employers. Advanced filters make it easy to find the right match for skills, expertise, or project requirements.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->

                                <div class="faq-item">
                                    <h3>What job-related features are included?</h3>
                                    <div class="faq-content">
                                        <p>Employers can post jobs, manage listings, and track applications. Developers can apply to jobs, save them to a wishlist, and submit tailored proposals directly through the platform.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->

                                <div class="faq-item">
                                    <h3>Does DevConnect support project collaboration?</h3>
                                    <div class="faq-content">
                                        <p>Yes! DevConnect provides a workspace for project collaboration, messaging, and GitHub API integration, enabling smooth teamwork between employers and developers.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->

                                <div class="faq-item">
                                    <h3>Are there tools for scheduling and notifications?</h3>
                                    <div class="faq-content">
                                        <p>Absolutely. Our calendar and interview scheduling system helps coordinate meetings, while real-time notifications keep both employers and developers updated at every step.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->

                                <div class="faq-item">
                                    <h3>Does DevConnect use any external APIs?</h3>
                                    <div class="faq-content">
                                      <p>Yes. The platform integrates with OpenStreetMap for location-based features and GitHub API for showcasing developer projects and repositories directly on profiles.</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->
                            </div>
                        </div><!-- End Faq Column-->
                    </div>
                </div>                
            </section>
            <!-- /FAQ Section -->

            <!-- Contact Section -->
            <section id="contact" class="contact section light-background">
                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <span class="description-title">Contact</span>
                    <h2>Get in Touch with DevConnect</h2>
                    <p>Have questions, need support, or want to share feedback? Our team is here to help developers and employers make the most of DevConnect.</p>
                </div><!-- End Section Title -->

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <div class="content" data-aos="fade-up" data-aos-delay="200">
                                <div class="section-category mb-3">Contact DevConnect</div>
                                <h2 class="display-5 mb-4">Support for Developers & Employers</h2>
                                <p class="lead mb-4">Whether you’re posting a job, applying for one, or need help with your profile or workspace, our dedicated support team is ready to assist you promptly.</p>

                                <div class="contact-info mt-5">
                                    <div class="info-item d-flex mb-3" data-aos="fade-up" data-aos-delay="300">
                                        <i class="bi bi-envelope-open me-3"></i>
                                        <span>support@devconnect.com</span>
                                    </div>

                                    <div class="info-item d-flex mb-3" data-aos="fade-up" data-aos-delay="400">
                                        <i class="bi bi-telephone-outbound me-3"></i>
                                        <span>+1 800 123 4567</span>
                                    </div>

                                    <div class="info-item d-flex mb-4" data-aos="fade-up" data-aos-delay="500">
                                        <i class="bi bi-geo-alt-fill me-3"></i>
                                        <span>123 DevConnect Ave, Silicon Valley, CA 94043</span>
                                    </div>

                                    <a href="#" class="map-link d-inline-flex align-items-center" data-aos="fade-up" data-aos-delay="600">
                                        View on Map
                                        <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="contact-form card" data-aos="fade-up" data-aos-delay="300">
                                <div class="card-body p-4 p-lg-5">

                                    <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="600">
                                        <div class="row gy-4">

                                            <div class="col-12">
                                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                                            </div>

                                            <div class="col-12">
                                             <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                                            </div>

                                            <div class="col-12">
                                              <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                                            </div>

                                            <div class="col-12">
                                             <textarea class="form-control" name="message" rows="6" placeholder="Your Message" required></textarea>
                                            </div>

                                            <div class="col-12 text-center">
                                                <div class="loading">Loading</div>
                                                <div class="error-message"></div>
                                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                                <button type="submit" class="btn btn-submit w-100">Send Message</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /Contact Section -->
            
        </main>
        
        <footer id="footer" class="footer position-relative dark-background">

            <div class="container footer-top">
                <div class="row gy-4">

                    <div class="col-lg-5 col-md-12 footer-about">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <span class="sitename">DevConnect</span>
                        </a>
                        <p>Connecting developers and employers seamlessly. Post jobs, apply for positions, manage profiles, and collaborate effectively with DevConnect.</p>
                        <div class="social-links d-flex mt-4">
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Terms of service</a></li>
                            <li><a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-6 footer-links">
                        <h4>Help Center</h4>
                        <ul>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Documentation</a></li>
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Community Forum</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                        <h4>Contact Us</h4>
                        <p>123 DevConnect Ave</p>
                        <p>Silicon Valley, CA 94043</p>
                        <p>United States</p>
                        <p class="mt-4"><strong>Phone:</strong> <span>+1 800 123 4567</span></p>
                        <p><strong>Email:</strong> <span>support@devconnect.com</span></p>
                    </div>

                </div>
            </div>

            <div class="container copyright text-center mt-4">
            <p>© <span>2025</span> <strong class="px-1 sitename">DevConnect</strong>. All Rights Reserved.</p>
            <div class="credits">
            Built with ❤️ by the <strong>DevConnect</strong> Team
            </div>
            </div>

        </footer>
        
        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        <!-- Vendor JS Files -->
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <!-- Main JS File -->
        <script src="assets/js/main.js"></script>
        
        <script>
            if (window.location.hash) {
            window.scrollTo(0, 0);
            history.replaceState(null, null, window.location.pathname);
            }
        </script>
        
        </body>
</html>