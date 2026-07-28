<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AI Prompt Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }

        .hero-section {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            max-width: 500px;
        }

        .btn-hero {
            padding: 14px 36px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-hero-white {
            background: white;
            color: #11998e;
        }

        .btn-hero-white:hover {
            background: #f0fdf4;
            color: #0d9488;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .btn-hero-outline {
            background: transparent;
            color: white;
            border: 2px solid rgba(255,255,255,0.6);
        }

        .btn-hero-outline:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            border-color: white;
            transform: translateY(-2px);
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.1);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .feature-card h5 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .feature-card p {
            color: #6b7280;
            font-size: 0.95rem;
            margin: 0;
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 800;
        }

        .section-subtitle {
            color: #6b7280;
            font-size: 1.1rem;
        }

        .navbar-custom {
            background: transparent;
            padding: 20px 0;
            transition: all 0.3s ease;
        }

        .navbar-custom.scrolled {
            background: white;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            padding: 12px 0;
        }

        .nav-link-custom {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            padding: 8px 20px !important;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .navbar-custom.scrolled .nav-link-custom {
            color: #374151 !important;
        }

        .nav-link-custom:hover {
            background: rgba(255,255,255,0.15);
        }

        .navbar-custom.scrolled .nav-link-custom:hover {
            background: #f3f4f6;
        }

        .btn-nav-login {
            background: rgba(255,255,255,0.2);
            color: white !important;
            border: 1px solid rgba(255,255,255,0.4);
        }

        .btn-nav-login:hover {
            background: rgba(255,255,255,0.3);
        }

        .navbar-custom.scrolled .btn-nav-login {
            background: transparent;
            color: #374151 !important;
            border: 1px solid #d1d5db;
        }

        .btn-nav-register {
            background: white;
            color: #11998e !important;
            font-weight: 600;
        }

        .navbar-custom.scrolled .btn-nav-register {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white !important;
        }

        .btn-nav-register:hover {
            transform: translateY(-1px);
        }

        .stats-section {
            background: #f8faf9;
        }

        .stat-item h3 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #11998e;
        }

        .stat-item p {
            color: #6b7280;
            font-weight: 500;
        }

        .footer-section {
            background: linear-gradient(135deg, #0d6b5e 0%, #11998e 50%, #38ef7d 100%);
            color: rgba(255,255,255,0.85);
        }

        .footer-section a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
        }

        .footer-section a:hover {
            color: white;
        }

        /* Screenshots */
        .screenshot-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .screenshot-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.1);
        }

        .screenshot-header {
            background: #f1f5f9;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .screenshot-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .screenshot-body {
            padding: 24px;
            background: #fafbfc;
            min-height: 220px;
        }

        /* Testimonials */
        .testimonial-card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid #f0f0f0;
            height: 100%;
            position: relative;
        }

        .testimonial-card::before {
            content: '\201C';
            font-size: 4rem;
            color: #38ef7d;
            opacity: 0.3;
            position: absolute;
            top: 10px;
            left: 20px;
            font-family: Georgia, serif;
            line-height: 1;
        }

        .testimonial-stars {
            color: #f59e0b;
            font-size: 1.1rem;
            margin-bottom: 12px;
        }

        .testimonial-text {
            color: #4b5563;
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 20px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .testimonial-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 1.1rem;
        }

        .testimonial-name {
            font-weight: 700;
            color: #1f2937;
            margin: 0;
            font-size: 0.95rem;
        }

        .testimonial-role {
            color: #9ca3af;
            font-size: 0.85rem;
            margin: 0;
        }

        /* FAQ */
        .faq-item {
            background: white;
            border-radius: 12px;
            margin-bottom: 12px;
            border: 1px solid #f0f0f0;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .faq-question {
            padding: 20px 24px;
            cursor: pointer;
            font-weight: 600;
            color: #1f2937;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s;
        }

        .faq-question:hover {
            background: #f8faf9;
        }

        .faq-arrow {
            font-size: 0.8rem;
            color: #11998e;
            transition: transform 0.3s;
        }

        .faq-item.active .faq-arrow {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .faq-answer-inner {
            padding: 0 24px 20px;
            color: #6b7280;
            line-height: 1.7;
        }

        .faq-item.active .faq-answer {
            max-height: 300px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-white fs-4" href="/">
                AI Prompt Manager
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-2">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="/prompts">Prompts</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom btn-nav-login" href="{{ route('login') }}">Log in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom btn-nav-register ms-1" href="{{ route('register') }}">Get Started</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-7 text-white">
                    <h1 class="hero-title mb-4">
                        Manage Your AI Prompts Like a Pro
                    </h1>
                    <p class="hero-subtitle mb-5">
                        Organize, search, and copy your favorite AI prompts in one place. Built for ChatGPT users, content creators, and developers.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-hero btn-hero-white">
                                Start for Free
                            </a>
                        @endif
                        <a href="#features" class="btn btn-hero btn-hero-outline">
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <div class="p-5">
                        <div class="bg-white bg-opacity-10 rounded-4 p-4 backdrop-blur" style="backdrop-filter: blur(10px);">
                            <div class="bg-white rounded-3 p-3 mb-3 shadow">
                                <small class="text-muted d-block mb-1">ChatGPT Prompt</small>
                                <p class="mb-0 text-dark fw-medium" style="font-size: 0.9rem;">Write a professional email to request a meeting with a potential client...</p>
                            </div>
                            <div class="bg-white rounded-3 p-3 mb-3 shadow">
                                <small class="text-muted d-block mb-1">Code Assistant</small>
                                <p class="mb-0 text-dark fw-medium" style="font-size: 0.9rem;">Create a Laravel REST API with authentication...</p>
                            </div>
                            <div class="bg-white rounded-3 p-3 shadow">
                                <small class="text-muted d-block mb-1">Image Generation</small>
                                <p class="mb-0 text-dark fw-medium" style="font-size: 0.9rem;">A futuristic city at sunset, cyberpunk style, neon lights...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title">Everything You Need</h2>
                <p class="section-subtitle mt-3">Simple tools to keep your AI prompts organized and accessible.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon" style="background: #ecfdf5; color: #10b981;">
                            &#9998;
                        </div>
                        <h5>Create & Save</h5>
                        <p>Write and save your best AI prompts with titles, categories, and descriptions for easy reference.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon" style="background: #eff6ff; color: #3b82f6;">
                            &#128269;
                        </div>
                        <h5>Quick Search</h5>
                        <p>Find any prompt instantly with powerful search across titles and content. No more scrolling.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon" style="background: #fef3c7; color: #f59e0b;">
                            &#128203;
                        </div>
                        <h5>One-Click Copy</h5>
                        <p>Copy any prompt to your clipboard with a single click. Paste it directly into ChatGPT or any AI tool.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon" style="background: #fce7f3; color: #ec4899;">
                            &#10084;&#65039;
                        </div>
                        <h5>Favorites</h5>
                        <p>Save your most-used prompts to favorites for lightning-fast access when you need them most.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon" style="background: #f3e8ff; color: #a855f7;">
                            &#128193;
                        </div>
                        <h5>Categories</h5>
                        <p>Organize prompts by topic — coding, writing, marketing, images — whatever works for you.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon" style="background: #e0f2fe; color: #0ea5e9;">
                            &#128274;
                        </div>
                        <h5>Private & Secure</h5>
                        <p>Your prompts are stored securely in your private account. Only you can see and manage them.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="stats-section py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title">How It Works</h2>
                <p class="section-subtitle mt-3">Three simple steps to get started.</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="mx-auto mb-3 fw-bold text-white rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;background:linear-gradient(135deg,#11998e,#38ef7d);font-size:1.5rem;">1</div>
                        <h5>Create Account</h5>
                        <p class="text-muted">Sign up for free in seconds. No credit card required.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="mx-auto mb-3 fw-bold text-white rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;background:linear-gradient(135deg,#11998e,#38ef7d);font-size:1.5rem;">2</div>
                        <h5>Add Prompts</h5>
                        <p class="text-muted">Create and organize your AI prompts by category.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="mx-auto mb-3 fw-bold text-white rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;background:linear-gradient(135deg,#11998e,#38ef7d);font-size:1.5rem;">3</div>
                        <h5>Copy & Use</h5>
                        <p class="text-muted">Search, copy, and paste prompts into any AI tool instantly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Screenshots / Demo Section -->
    <section id="demo" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title">See It In Action</h2>
                <p class="section-subtitle mt-3">A clean and simple interface designed for productivity.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="screenshot-card">
                        <div class="screenshot-header">
                            <div class="screenshot-dot" style="background:#ef4444;"></div>
                            <div class="screenshot-dot" style="background:#f59e0b;"></div>
                            <div class="screenshot-dot" style="background:#22c55e;"></div>
                            <span class="ms-2 text-muted" style="font-size:0.8rem;">Prompt List</span>
                        </div>
                        <div class="screenshot-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="fw-bold mb-0">AI Prompts</h6>
                                <span class="badge" style="background:#11998e;">6 Prompts</span>
                            </div>
                            <div class="bg-white rounded-2 p-3 mb-2 shadow-sm">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong style="font-size:0.9rem;">Email Writer</strong>
                                        <br><small class="text-muted">Write a professional cold email...</small>
                                    </div>
                                    <span class="badge bg-primary" style="font-size:0.7rem;">Marketing</span>
                                </div>
                            </div>
                            <div class="bg-white rounded-2 p-3 mb-2 shadow-sm">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong style="font-size:0.9rem;">Blog Outline</strong>
                                        <br><small class="text-muted">Create a detailed blog post outline...</small>
                                    </div>
                                    <span class="badge bg-success" style="font-size:0.7rem;">Writing</span>
                                </div>
                            </div>
                            <div class="bg-white rounded-2 p-3 shadow-sm">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong style="font-size:0.9rem;">Code Review</strong>
                                        <br><small class="text-muted">Review this code for best practices...</small>
                                    </div>
                                    <span class="badge bg-info" style="font-size:0.7rem;">Code</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="screenshot-card">
                        <div class="screenshot-header">
                            <div class="screenshot-dot" style="background:#ef4444;"></div>
                            <div class="screenshot-dot" style="background:#f59e0b;"></div>
                            <div class="screenshot-dot" style="background:#22c55e;"></div>
                            <span class="ms-2 text-muted" style="font-size:0.8rem;">Create Prompt</span>
                        </div>
                        <div class="screenshot-body">
                            <h6 class="fw-bold mb-3">Add New Prompt</h6>
                            <div class="mb-2">
                                <small class="text-muted fw-semibold">Title</small>
                                <div class="bg-white rounded-2 p-2 shadow-sm" style="font-size:0.85rem;">SEO Blog Writer</div>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted fw-semibold">Category</small>
                                <div class="bg-white rounded-2 p-2 shadow-sm" style="font-size:0.85rem;">Content Writing</div>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted fw-semibold">Prompt</small>
                                <div class="bg-white rounded-2 p-2 shadow-sm" style="font-size:0.85rem;min-height:60px;">Write a 1500-word SEO-optimized blog post about...</div>
                            </div>
                            <button class="btn btn-sm w-100 text-white fw-semibold" style="background:linear-gradient(135deg,#11998e,#38ef7d);border-radius:8px;">Save Prompt</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="screenshot-card">
                        <div class="screenshot-header">
                            <div class="screenshot-dot" style="background:#ef4444;"></div>
                            <div class="screenshot-dot" style="background:#f59e0b;"></div>
                            <div class="screenshot-dot" style="background:#22c55e;"></div>
                            <span class="ms-2 text-muted" style="font-size:0.8rem;">Categories</span>
                        </div>
                        <div class="screenshot-body">
                            <h6 class="fw-bold mb-3">Categories</h6>
                            <div class="d-flex align-items-center justify-content-between bg-white rounded-2 p-3 mb-2 shadow-sm">
                                <div class="d-flex align-items-center gap-2">
                                    <span style="font-size:1.2rem;">&#128196;</span>
                                    <span style="font-size:0.9rem;font-weight:600;">ChatGPT Prompts</span>
                                </div>
                                <span class="text-muted" style="font-size:0.8rem;">12 prompts</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between bg-white rounded-2 p-3 mb-2 shadow-sm">
                                <div class="d-flex align-items-center gap-2">
                                    <span style="font-size:1.2rem;">&#127912;</span>
                                    <span style="font-size:0.9rem;font-weight:600;">Image Generation</span>
                                </div>
                                <span class="text-muted" style="font-size:0.8rem;">8 prompts</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between bg-white rounded-2 p-3 mb-2 shadow-sm">
                                <div class="d-flex align-items-center gap-2">
                                    <span style="font-size:1.2rem;">&#128187;</span>
                                    <span style="font-size:0.9rem;font-weight:600;">Code Assistant</span>
                                </div>
                                <span class="text-muted" style="font-size:0.8rem;">15 prompts</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between bg-white rounded-2 p-3 shadow-sm">
                                <div class="d-flex align-items-center gap-2">
                                    <span style="font-size:1.2rem;">&#9998;</span>
                                    <span style="font-size:0.9rem;font-weight:600;">Content Writing</span>
                                </div>
                                <span class="text-muted" style="font-size:0.8rem;">6 prompts</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="stats-section py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title">Loved by Users</h2>
                <p class="section-subtitle mt-3">See what people are saying about AI Prompt Manager.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <p class="testimonial-text">"I used to lose track of my best ChatGPT prompts. Now everything is organized and I can copy any prompt with one click. Game changer!"</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar" style="background:linear-gradient(135deg,#11998e,#38ef7d);">S</div>
                            <div>
                                <p class="testimonial-name">Sarah Chen</p>
                                <p class="testimonial-role">Content Strategist</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <p class="testimonial-text">"As a developer, I have dozens of code prompts. The category system and search make it so easy to find exactly what I need in seconds."</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar" style="background:linear-gradient(135deg,#3b82f6,#8b5cf6);">M</div>
                            <div>
                                <p class="testimonial-name">Marcus Johnson</p>
                                <p class="testimonial-role">Full-Stack Developer</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="testimonial-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                        <p class="testimonial-text">"Simple, clean, and does exactly what I need. I use it every day for my marketing prompts. The favorites feature saves me so much time."</p>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar" style="background:linear-gradient(135deg,#f59e0b,#ef4444);">A</div>
                            <div>
                                <p class="testimonial-name">Aisha Patel</p>
                                <p class="testimonial-role">Digital Marketer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title">Frequently Asked Questions</h2>
                <p class="section-subtitle mt-3">Got questions? We've got answers.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-item active" onclick="toggleFaq(this)">
                        <div class="faq-question">
                            What is AI Prompt Manager?
                            <span class="faq-arrow">&#9660;</span>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                AI Prompt Manager is a web app that helps you organize, store, and quickly access your AI prompts. Whether you use ChatGPT, Midjourney, or any other AI tool, you can save your best prompts in one place.
                            </div>
                        </div>
                    </div>
                    <div class="faq-item" onclick="toggleFaq(this)">
                        <div class="faq-question">
                            Is it free to use?
                            <span class="faq-arrow">&#9660;</span>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Yes! AI Prompt Manager is completely free to use. Sign up, create your account, and start organizing your prompts right away. No credit card required.
                            </div>
                        </div>
                    </div>
                    <div class="faq-item" onclick="toggleFaq(this)">
                        <div class="faq-question">
                            Can I share my prompts with others?
                            <span class="faq-arrow">&#9660;</span>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Currently, prompts are private to your account. You can copy any prompt to your clipboard and share it manually. We're working on a sharing feature for a future update.
                            </div>
                        </div>
                    </div>
                    <div class="faq-item" onclick="toggleFaq(this)">
                        <div class="faq-question">
                            How do categories work?
                            <span class="faq-arrow">&#9660;</span>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Categories help you group related prompts together. For example, you can create categories like "ChatGPT", "Code", "Writing", or "Images". When creating a prompt, simply select the category it belongs to.
                            </div>
                        </div>
                    </div>
                    <div class="faq-item" onclick="toggleFaq(this)">
                        <div class="faq-question">
                            Is my data secure?
                            <span class="faq-arrow">&#9660;</span>
                        </div>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Absolutely. Your prompts are stored securely in our database and are only accessible by you when logged into your account. We use industry-standard security practices to protect your data.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="text-center p-5 rounded-4" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <h2 class="text-white fw-bold mb-3">Ready to organize your AI prompts?</h2>
                <p class="text-white mb-4" style="opacity:0.9; font-size:1.1rem;">Join and start managing your prompts today.</p>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-lg px-5 py-3 rounded-3 fw-bold" style="background:white;color:#11998e;">
                        Get Started Free
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section py-5">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-4">
                    <h5 class="text-white fw-bold mb-3">AI Prompt Manager</h5>
                    <p class="mb-3" style="opacity:0.85;">Organize, search, and copy your favorite AI prompts in one place. Built for creators, developers, and everyone who uses AI.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white fs-5">GitHub</a>
                        <a href="#" class="text-white fs-5">Twitter</a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="text-white fw-bold mb-3">Product</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#features">Features</a></li>
                        <li class="mb-2"><a href="#demo">Demo</a></li>
                        <li class="mb-2"><a href="#faq">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="text-white fw-bold mb-3">Account</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/login">Login</a></li>
                        <li class="mb-2"><a href="/register">Register</a></li>
                        <li class="mb-2"><a href="/dashboard">Dashboard</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="text-white fw-bold mb-3">Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/prompts">Prompts</a></li>
                        <li class="mb-2"><a href="/categories">Categories</a></li>
                        <li class="mb-2"><a href="/favorites">Favorites</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h6 class="text-white fw-bold mb-3">Support</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#faq">Help Center</a></li>
                        <li class="mb-2"><a href="#">Contact</a></li>
                        <li class="mb-2"><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <hr style="border-color:rgba(255,255,255,0.2);">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <span>&copy; {{ date('Y') }} AI Prompt Manager. All rights reserved.</span>
                <span class="mt-2 mt-md-0">Built with Laravel</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        function toggleFaq(el) {
            const isActive = el.classList.contains('active');
            document.querySelectorAll('.faq-item').forEach(function(item) {
                item.classList.remove('active');
            });
            if (!isActive) {
                el.classList.add('active');
            }
        }
    </script>
</body>
</html>
