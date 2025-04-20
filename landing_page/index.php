<?php
session_start();
$error = '';
$success = '';
$show_signup_prompt = false;

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

if (isset($_SESSION['show_signup_prompt'])) {
    $show_signup_prompt = $_SESSION['show_signup_prompt'];
    unset($_SESSION['show_signup_prompt']);
}

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}
?>
<div class="alert-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>

            <?php if ($show_signup_prompt): ?>
                <div class="mt-2">
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#registerModal">
                        <i class="bi bi-person-plus"></i> Sign Up
                    </button>
                </div>
            <?php endif; ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARA Gym - Premier Fitness Center in Nepal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.min.js"></script>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <h1>ARA<span>Gym</span></h1>
            </div>
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-menu">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#classes">Classes</a></li>
                <li><a href="#trainers">Trainers</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contact">Contact</a></li>
                <li>
                    <button type="button" class="btn btn-primary join-btn" data-bs-toggle="modal"
                        data-bs-target="#registerModal" aria-label="Open registration form">
                        Join Now
                    </button>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-background">
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                alt="ARA Gym">
        </div>
        <div class="container">
            <div class="hero-content">
                <h1>Transform Your Body <span>Transform Your Life</span></h1>
                <p>Join Nepal's most advanced fitness center with state-of-the-art equipment and expert trainers</p>
                <div class="hero-btns">
                    <a href="#pricing" class="btn-primary">
                        <i data-lucide="tag"></i>
                        View Pricing
                    </a>
                    <a href="#" class="btn btn-primary join-btn" data-bs-toggle="modal" data-bs-target="#registerModal">
                        <i data-lucide="user-plus"></i>
                        Join Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>About <span>ARA Gym</span></h2>
                <p>Nepal's leading fitness destination</p>
            </div>
            <div class="about-content">
                <!-- Video Container (replaced image) -->
                <div class="about-img" data-aos="fade-right" data-aos-delay="200">
                    <div class="video-header">
                        <i data-lucide="dumbbell" class="icon"></i>
                        <h3>Virtual Gym Tour</h3>
                        <i data-lucide="trophy" class="icon"></i>
                    </div>
                    <iframe class="gym-video"
                        src="https://www.youtube.com/embed/mBY68kFvhq8?autoplay=1&mute=1&loop=1&playlist=mBY68kFvhq8"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                    <div class="video-footer">
                        <i data-lucide="sparkles" class="icon"></i>
                        <p>Where Champions Are Made</p>
                        <i data-lucide="sparkles" class="icon"></i>
                    </div>
                </div>
                <div class="about-text" data-aos="fade-left" data-aos-delay="300">
                    <h3>Welcome to ARA Gym</h3>
                    <p>Located in the heart of Nepal, ARA Gym is dedicated to transforming lives through fitness. Our
                        state-of-the-art facilities, expert trainers, and supportive community create the perfect
                        environment for you to achieve your fitness goals and embrace a healthier lifestyle.</p>
                    <div class="features">
                        <div class="feature" data-aos="fade-up" data-aos-delay="100">
                            <div class="feature-icon">
                                <i data-lucide="dumbbell"></i>
                            </div>
                            <h4>State-of-the-art Equipment</h4>
                            <p>Latest fitness machines and equipment for effective workouts</p>
                        </div>

                        <div class="feature" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-icon">
                                <i data-lucide="users"></i>
                            </div>
                            <h4>Expert Trainers</h4>
                            <p>Certified fitness professionals to guide your journey</p>
                        </div>

                        <div class="feature" data-aos="fade-up" data-aos-delay="300">
                            <div class="feature-icon">
                                <i data-lucide="clock"></i>
                            </div>
                            <h4>Flexible Hours</h4>
                            <p>Open early until late to fit your busy schedule</p>
                        </div>

                        <div class="feature" data-aos="fade-up" data-aos-delay="400">
                            <div class="feature-icon">
                                <i data-lucide="calendar"></i>
                            </div>
                            <h4>Diverse Classes</h4>
                            <p>Wide range of fitness classes to keep you motivated</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Classes Section -->
    <section id="classes" class="classes">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Our <span>Classes</span></h2>
                <p>Find the perfect workout for you</p>
            </div>
            <div class="classes-grid">
                <div class="class-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="class-img">
                        <img src="images\stronger-young-muscular-caucasian-athlete-practicing-lunges-gym-with-barbell-male-model-doing-strength-exercises-training-his-lower-body-wellness-healthy-lifestyle-bodybuilding-concept.jpg" alt="Strength Training">
                        <div class="class-overlay">
                            <a href="#" class="btn-primary">Join Class</a>
                        </div>
                    </div>
                    <div class="class-info">
                        <h3>Strength Training</h3>
                        <p>Build muscle and increase your metabolism</p>
                        <div class="class-meta">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-clock">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                60 min
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-flame">
                                    <path
                                        d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z">
                                    </path>
                                </svg>
                                High Intensity
                            </span>
                        </div>
                    </div>
                </div>
                <div class="class-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="class-img">
                        <img src="images\young-bodybuilder-running-cardio-workout-looking-gym-window.jpg" alt="Cardio Blast">
                        <div class="class-overlay">
                            <a href="#" class="btn-primary">Join Class</a>
                        </div>
                    </div>
                    <div class="class-info">
                        <h3>Cardio Blast</h3>
                        <p>Improve heart health and burn calories</p>
                        <div class="class-meta">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-clock">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                45 min
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-flame">
                                    <path
                                        d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z">
                                    </path>
                                </svg>
                                Medium Intensity
                            </span>
                        </div>
                    </div>
                </div>
                <div class="class-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="class-img">
                        <img src="images\yoga-group-classes-inside-gym.jpg" alt="Yoga Flow">
                        <div class="class-overlay">
                            <a href="#" class="btn-primary">Join Class</a>
                        </div>
                    </div>
                    <div class="class-info">
                        <h3>Yoga Flow</h3>
                        <p>Enhance flexibility and reduce stress</p>
                        <div class="class-meta">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-clock">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                75 min
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-flame">
                                    <path
                                        d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z">
                                    </path>
                                </svg>
                                Low Intensity
                            </span>
                        </div>
                    </div>
                </div>
                <div class="class-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="class-img">
                        <img src="images\young-healthy-man-athlete-doing-exercise-with-ropes-gym.jpg" alt="HIIT">
                        <div class="class-overlay">
                            <a href="#" class="btn-primary">Join Class</a>
                        </div>
                    </div>
                    <div class="class-info">
                        <h3>HIIT</h3>
                        <p>Maximum results in minimum time</p>
                        <div class="class-meta">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-clock">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                30 min
                            </span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-flame">
                                    <path
                                        d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z">
                                    </path>
                                </svg>
                                Very High Intensity
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trainers Section -->
    <section id="trainers" class="trainers">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Expert <span>Trainers</span></h2>
                <p>Meet our fitness professionals</p>
            </div>
            <div class="trainers-grid">
                <div class="trainer-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="trainer-img">
                        <img src="images\pexels-pixabay-416754 (1).jpg" style="height: 200px; width: 360px;" alt="Rajesh Sharma">
                        <div class="trainer-social">
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-facebook">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-instagram">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                </svg>
                            </a>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-twitter">
                                    <path
                                        d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="trainer-info">
                        <h3>Rajesh Sharma</h3>
                        <p>Strength & Conditioning</p>
                    </div>
                </div>
                <div class="trainer-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="trainer-img">
                        <img src="images\pexels-pixabay-414029.jpg" style="height: 200px; width: 360px;" alt="Priya Thapa">
                        <div class="trainer-social">
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-facebook">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-instagram">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                </svg>
                            </a>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-twitter">
                                    <path
                                        d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="trainer-info">
                        <h3>Priya Thapa</h3>
                        <p>Yoga & Pilates</p>
                    </div>
                </div>
                <div class="trainer-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="trainer-img">
                        <img src="images\full-shot-woman-yoga-mat.jpg" style="height: 200px; width: 360px;" alt="Rekha Gurung">
                        <div class="trainer-social">
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-facebook">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-instagram">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                </svg>
                            </a>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-twitter">
                                    <path
                                        d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="trainer-info">
                        <h3>Rekha Gurung</h3>
                        <p>Cardio & HIIT</p>
                    </div>
                </div>
                <div class="trainer-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="trainer-img">
                        <img src="images\pexels-thisisengineering-3912516.jpg" style="height: 200px; width: 360px;" alt="Anuj Rai">
                        <div class="trainer-social">
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-facebook">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-instagram">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                </svg>
                            </a>
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-twitter">
                                    <path
                                        d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="trainer-info">
                        <h3>Anuj Rai</h3>
                        <p>Nutrition & Weight Loss</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Membership <span>Plans</span></h2>
                <p>Choose the perfect plan for your fitness journey</p>
            </div>
            <div class="pricing-grid">
                <div class="pricing-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-header">
                        <h3>Basic</h3>
                        <div class="price">
                            <span class="currency">Rs</span>
                            <span class="amount">2,500</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <div class="pricing-features">
                        <ul>
                            <li>
                                <i data-lucide="check" aria-hidden="true"></i>
                                <span>Access to gym floor</span>
                            </li>
                            <li>
                                <i data-lucide="check" aria-hidden="true"></i>
                                <span>2 group classes per week</span>
                            </li>
                            <li>
                                <i data-lucide="x" aria-hidden="true"></i>
                                <span>Personal training session</span>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-check">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                Locker room access
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-x">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                                Group classes
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-x">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                                Nutrition consultation
                            </li>
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a href="#" class="btn-primary join-btn" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Join Now</a>
                    </div>
                </div>
                <div class="pricing-card featured" data-aos="fade-up" data-aos-delay="200">
                    <div class="popular">Most Popular</div>
                    <div class="pricing-header">
                        <h3>Premium</h3>
                        <div class="price">
                            <span class="currency">Rs</span>
                            <span class="amount">4,500</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <div class="pricing-features">
                        <ul>
                            <li>
                                <i data-lucide="check" aria-hidden="true"></i>
                                <span>Access to gym floor</span>
                            </li>
                            <li>
                                <i data-lucide="check" aria-hidden="true"></i>
                                <span>2 group classes per week</span>
                            </li>
                            <li>
                                <i data-lucide="x" aria-hidden="true"></i>
                                <span>Personal training session</span>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-check">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                24/7 Gym access
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-check">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                All equipment use
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-check">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                Locker room access
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-check">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                Unlimited group classes
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-check">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                1 Personal training session/month
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-x">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                                Nutrition consultation
                            </li>
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a href="#" class="btn-primary join-btn" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Join Now</a>
                    </div>
                </div>
                <div class="pricing-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="pricing-header">
                        <h3>Elite</h3>
                        <div class="price">
                            <span class="currency">Rs</span>
                            <span class="amount">7,500</span>
                            <span class="period">/month</span>
                        </div>
                    </div>
                    <div class="pricing-features">
                        <ul>
                            <li>
                                <i data-lucide="check" aria-hidden="true"></i>
                                <span>Access to gym floor</span>
                            </li>
                            <li>
                                <i data-lucide="check" aria-hidden="true"></i>
                                <span>2 group classes per week</span>
                            </li>
                            <li>
                                <i data-lucide="x" aria-hidden="true"></i>
                                <span>Personal training session</span>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-check">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                24/7 Gym access
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-check">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                All equipment use
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-check">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                Premium locker room
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-check">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                Unlimited group classes
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-check">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                4 Personal training sessions/month
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-check">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </svg>
                                Monthly nutrition consultation
                            </li>
                        </ul>
                    </div>
                    <div class="pricing-footer">
                        <a href="#" class="btn-primary join-btn" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Join Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Client <span>Testimonials</span></h2>
                <p>What our members say about us</p>
            </div>
            <div class="testimonial-slider" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-slide active">
                    <div class="testimonial-img">
                        <img src="images\pexels-jonathanborba-3076509.jpg" alt="Client 1">
                    </div>
                    <div class="testimonial-content">
                        <p>"ARA Gym completely transformed my fitness journey. The trainers are knowledgeable and
                            supportive, and the community keeps me motivated. I've lost 15 kg and gained confidence!"
                        </p>
                        <div class="testimonial-author">
                            <h4>Anisha Shrestha</h4>
                            <span>Member for 1 year</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-img">
                        <img src="images\pexels-panther-1547248.jpg" alt="Client 2">
                    </div>
                    <div class="testimonial-content">
                        <p>"As a busy professional in Kathmandu, I needed a gym that fit my schedule. ARA Gym's extended
                            hours and variety of classes have been perfect. The facilities are always clean and the
                            equipment is top-notch."</p>
                        <div class="testimonial-author">
                            <h4>Bikash Tamang</h4>
                            <span>Member for 8 months</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-img">
                        <img src="images\pexels-anush-1229356.jpg" alt="Client 3">
                    </div>
                    <div class="testimonial-content">
                        <p>"I was intimidated by gyms before joining ARA. The staff made me feel welcome from day one,
                            and the trainers created a program specifically for my needs. Now I look forward to my
                            workouts!"</p>
                        <div class="testimonial-author">
                            <h4>Sabin Maharjan</h4>
                            <span>Member for 6 months</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-controls">
                <div class="testimonial-dots">
                    <span class="dot active" data-slide="0"></span>
                    <span class="dot" data-slide="1"></span>
                    <span class="dot" data-slide="2"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Frequently <span>Asked Questions</span></h2>
                <p>Find answers to common questions about ARA Gym</p>
            </div>
            <div class="faq-container" data-aos="fade-up" data-aos-delay="200">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>What are your operating hours?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-down">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </div>
                    <div class="faq-answer">
                        <p>ARA Gym is open Monday through Friday from 5:00 AM to 11:00 PM, and on weekends from 7:00 AM
                            to 9:00 PM. Premium and Elite members have 24/7 access with their membership cards.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Do you offer any trial periods?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-down">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </div>
                    <div class="faq-answer">
                        <p>Yes! We offer a 3-day free trial for new members. This includes access to our facilities and
                            one complimentary group class. Contact our front desk or sign up online to get started.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Can I freeze my membership temporarily?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-down">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, members can freeze their membership for up to 3 months per year. A small maintenance fee
                            applies during the freeze period. Please provide at least 7 days' notice before your billing
                            date.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>What amenities are included with membership?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-down">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </div>
                    <div class="faq-answer">
                        <p>All memberships include access to our main gym floor, locker rooms, and showers. Premium and
                            Elite memberships include additional amenities such as towel service, sauna access, and
                            complimentary fitness assessments.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Do you have parking facilities?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-down">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, we offer free parking for all members in our dedicated parking lot. During peak hours,
                            we also have valet parking available for a small fee.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>How do I cancel my membership?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-down">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </div>
                    <div class="faq-answer">
                        <p>To cancel your membership, please visit our front desk or send an email to
                            memberships@aragym.com.np with your full name and membership ID. We require 30 days' notice
                            for all cancellations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Contact <span>Us</span></h2>
                <p>Get in touch with our team</p>
            </div>
            <div class="contact-content">
                <div class="contact-info" data-aos="fade-right" data-aos-delay="100">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i data-lucide="map-pin"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Visit Us</h4>
                            <p>123 Fitness Street, Kathmandu, Nepal</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-phone">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h4>Phone</h4>
                            <p>+977 1 4123456</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-mail">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h4>Email</h4>
                            <p>info@aragym.com.np</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-clock">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h4>Hours</h4>
                            <p>Monday - Friday: 5AM - 11PM<br>Weekends: 7AM - 9PM</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form" data-aos="fade-left" data-aos-delay="200">
                    <form id="contactForm">
                        <div class="form-group">
                            <input type="text" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea id="message" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h2>ARA<span>Gym</span></h2>
                    <p>Transform your body, transform your life.</p>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home"><i data-lucide="home"></i> Home</a></li>
                        <li><a href="#about"><i data-lucide="info"></i> About</a></li>
                        <li><a href="#classes"><i data-lucide="dumbbell"></i> Classes</a></li>
                        <li><a href="#trainers"><i data-lucide="users"></i> Trainers</a></li>
                        <li><a href="#pricing"><i data-lucide="tag"></i> Pricing</a></li>
                        <li><a href="#faq"><i data-lucide="help-circle"></i> FAQ</a></li>
                        <li><a href="#contact"><i data-lucide="mail"></i> Contact</a></li>
                    </ul>
                </div>
                <div class="footer-classes">
                    <h3>Our Classes</h3>
                    <ul>
                        <li><a href="#"><i data-lucide="dumbbell"></i> Strength Training</a></li>
                        <li><a href="#"><i data-lucide="activity"></i> Cardio Blast</a></li>
                        <li><a href="#"><i data-lucide="sun"></i> Yoga Flow</a></li>
                        <li><a href="#"><i data-lucide="zap"></i> HIIT</a></li>
                        <li><a href="#"><i data-lucide="align-center"></i> Pilates</a></li>
                        <li><a href="#"><i data-lucide="rotate-cw"></i> Spin Class</a></li>
                    </ul>
                </div>
                <div class="footer-newsletter">
                    <h3>Newsletter</h3>
                    <p>Subscribe to get the latest updates and offers.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Your Email" required>
                        <button type="submit" class="btn-primary">Subscribe</button>
                    </form>
                    <div class="social-icons">
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-facebook">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-instagram">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-twitter">
                                <path
                                    d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z">
                                </path>
                            </svg>
                        </a>
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-youtube">
                                <path
                                    d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17">
                                </path>
                                <path d="m10 15 5-3-5-3z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 ARA Gym. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-chevron-up">
            <path d="m18 15-6-6-6 6" />
        </svg>
    </a>


    <!-- Modern Login Modal -->
    <div class="modal fade auth-modal" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Welcome to ARA GYM</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 d-none d-md-block">
                            <h5 class="text-center">Stay Motivated</h5>
                            <p class="text-center"><i data-lucide="zap" style="font-size: 1.2rem;"></i> Achieve your
                                goals with our expert guidance.</p>
                            <p class="text-center"><i data-lucide="heart-pulse" style="font-size: 1.2rem;"></i>
                                Personalized workout plans just for you.</p>
                            <p class="text-center"><i data-lucide="users" style="font-size: 1.2rem;"></i> Join a
                                community of fitness enthusiasts.</p>
                        </div>
                        <div class="col-md-6">
                            <form class="auth-form" action="scripts/login.php" method="POST">
                                <div class="mb-4 input-group">
                                    <span class="input-group-text"><i data-lucide="mail"
                                            style="font-size: 1.2rem;"></i></span>
                                    <input type="email" class="form-control" name="email" placeholder="Email Address"
                                        required>
                                </div>
                                <div class="mb-4 input-group">
                                    <span class="input-group-text"><i data-lucide="lock"
                                            style="font-size: 1.2rem;"></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        required>
                                </div>
                                <button type="submit" class="cta-button w-100">
                                    <i data-lucide="arrow-right" style="font-size: 1.2rem;"></i> SIGN IN
                                </button>

                                <div class="divider text-center my-4">OR CONTINUE WITH</div>

                                <div class="social-login">
                                    <button type="button" class="social-btn google">
                                        <i data-lucide="google" style="font-size: 1.2rem;"></i> Google Account
                                    </button>
                                    <button type="button" class="social-btn facebook">
                                        <i data-lucide="facebook" style="font-size: 1.2rem;"></i> Facebook Account
                                    </button>
                                </div>

                                <div class="text-center mt-4">
                                    <a href="#forgot" class="text-primary">Forgot Password?</a>
                                    <span class="mx-2">|</span>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal"
                                        data-bs-dismiss="modal">Create Account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Registration Modal -->
    <div class="modal fade auth-modal" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Your Account</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 d-none d-md-block">
                            <h5 class="text-center">Join Us Today</h5>
                            <p class="text-center"><i data-lucide="trophy" style="font-size: 1.2rem;"></i> Access to
                                top-notch gym equipment.</p>
                            <p class="text-center"><i data-lucide="calendar" style="font-size: 1.2rem;"></i> Flexible
                                class schedules.</p>
                            <p class="text-center"><i data-lucide="smile" style="font-size: 1.2rem;"></i> Friendly and
                                supportive environment.</p>
                        </div>
                        <div class="col-md-6">
                            <form class="auth-form" action="scripts/signup.php" method="POST">
                                <div class="row mb-3">
                                    <div class="col input-group">
                                        <span class="input-group-text"><i data-lucide="user"
                                                style="font-size: 1.2rem;"></i></span>
                                        <input type="text" class="form-control" name="first_name"
                                            placeholder="First Name" required>
                                    </div>
                                    <div class="col input-group">
                                        <span class="input-group-text"><i data-lucide="user"
                                                style="font-size: 1.2rem;"></i></span>
                                        <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text"><i data-lucide="mail"
                                            style="font-size: 1.2rem;"></i></span>
                                    <input type="email" class="form-control" name="email" placeholder="Email Address"
                                        required>
                                </div>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text"><i data-lucide="phone"
                                            style="font-size: 1.2rem;"></i></span>
                                    <input type="tel" class="form-control" name="phone" placeholder="Phone Number">
                                </div>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text"><i data-lucide="lock"
                                            style="font-size: 1.2rem;"></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        required>
                                </div>
                                <div class="mb-3 input-group">
                                    <span class="input-group-text"><i data-lucide="lock"
                                            style="font-size: 1.2rem;"></i></span>
                                    <input type="password" class="form-control" name="confirm_password"
                                        placeholder="Confirm Password" required>
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="termsCheck" required>
                                    <label class="form-check-label" for="termsCheck">
                                        I agree to the <a href="terms.php" class="text-primary">Terms & Conditions</a>
                                    </label>
                                </div>
                                <button type="submit" class="cta-button w-100">
                                    <i data-lucide="user-plus" style="font-size: 1.2rem;"></i> CREATE ACCOUNT
                                </button>
                                <div class="text-center mt-4">
                                    <span>Already have an account?</span>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"
                                        data-bs-dismiss="modal">Sign In</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show login modal if hash exists
            if (window.location.hash === '#loginModal') {
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
            }

            // Clear URL hash
            history.replaceState(null, null, ' ');
        });
    </script>
</body>

</html>