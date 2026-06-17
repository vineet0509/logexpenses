<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LogExpenses API') }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-blue: #0A369D;
            --secondary-blue: #4472CA;
            --light-blue: #E2E8F0;
            --white: #FFFFFF;
            --text-dark: #1E293B;
            --text-muted: #64748B;
            --bg-color: #F8FAFC;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, .brand {
            font-family: 'Outfit', sans-serif;
        }

        /* Navbar */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 5%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        .brand {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary-blue);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--secondary-blue);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: var(--primary-blue);
            color: var(--white) !important;
            box-shadow: 0 4px 6px -1px rgba(10, 54, 157, 0.2), 0 2px 4px -1px rgba(10, 54, 157, 0.1);
        }

        .btn-primary:hover {
            background-color: var(--secondary-blue);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(10, 54, 157, 0.3), 0 4px 6px -2px rgba(10, 54, 157, 0.15);
        }

        .btn-outline {
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue) !important;
            background: transparent;
        }

        .btn-outline:hover {
            background-color: var(--primary-blue);
            color: var(--white) !important;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 100vh;
            padding: 6rem 5% 2rem;
            background: linear-gradient(135deg, var(--bg-color) 0%, var(--light-blue) 100%);
        }

        .hero-content {
            flex: 1;
            max-width: 600px;
            animation: slideUp 0.8s ease-out forwards;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            color: var(--primary-blue);
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .hero-title span {
            color: var(--secondary-blue);
        }

        .hero-description {
            font-size: 1.125rem;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-left: 2rem;
            animation: fadeIn 1s ease-out 0.4s forwards;
            opacity: 0;
        }

        .hero-image img {
            width: 100%;
            max-width: 600px;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(10, 54, 157, 0.25);
            transition: transform 0.5s ease;
        }

        .hero-image img:hover {
            transform: scale(1.02) rotate(-1deg);
        }

        /* Features Section */
        .features {
            padding: 5rem 5%;
            background-color: var(--white);
            text-align: center;
        }

        .features-title {
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 3rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: var(--bg-color);
            padding: 2.5rem 2rem;
            border-radius: 16px;
            border: 1px solid var(--light-blue);
            transition: all 0.3s ease;
            text-align: left;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: var(--secondary-blue);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: rgba(10, 54, 157, 0.1);
            color: var(--primary-blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .feature-card p {
            color: var(--text-muted);
        }

        /* Animations */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 968px) {
            .hero {
                flex-direction: column;
                text-align: center;
                padding-top: 8rem;
            }
            .hero-content {
                margin-bottom: 3rem;
            }
            .hero-buttons {
                justify-content: center;
            }
            .hero-image {
                padding-left: 0;
            }
        }
    </style>
</head>
<body>

    <nav>
        <a href="/" class="brand">LogExpenses</a>
        <div class="nav-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Manage Construction <br><span>Like a Pro.</span></h1>
            <p class="hero-description">The ultimate, production-ready REST API for tracking projects, managing contractors, and streamlining expenses. Secure, fast, and built for scale.</p>
            <div class="hero-buttons">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary">Start Building</a>
                @endif
                <a href="/api/projects" class="btn btn-outline">Test the API</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="{{ asset('images/hero.png') }}" alt="Futuristic Construction 3D Art">
        </div>
    </section>

    <section class="features">
        <h2 class="features-title">Powerful Core Modules</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3>Project Management</h3>
                <p>Create and track construction projects. Log vital details like location, budget, and timelines. Everything is securely scoped so you only see your own data.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3>Contractor Tracking</h3>
                <p>Maintain a database of contractors and their specialties. Use our optimized geo-search endpoints to instantly find workers near your construction sites.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <h3>Expense Logging</h3>
                <p>Log all generic project costs, categorized cleanly. Calculate your running totals and ensure you never stray past your defined project budgets.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3>Invoice Payments</h3>
                <p>Link direct payments to both specific projects and specific contractors. Keep an immaculate record of exactly who was paid, how much, and when.</p>
            </div>
        </div>
    </section>

</body>
</html>
