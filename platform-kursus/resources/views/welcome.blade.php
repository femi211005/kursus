<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learnify - Learn Coding the Easy Way</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0 40px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo h1 {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .nav-links {
            display: flex;
            gap: 10px;
        }

        .nav-links a {
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            text-align: center;
            color: white;
            margin-bottom: 50px;
            padding: 20px;
        }

        .hero h2 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .hero p {
            font-size: 20px;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Main Card */
        .main-card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            margin-bottom: 30px;
        }

        /* Section */
        .section {
            margin-bottom: 50px;
        }

        .section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            font-size: 28px;
            margin-bottom: 25px;
            color: #1e293b;
            font-weight: 700;
            padding-bottom: 15px;
            border-bottom: 3px solid #667eea;
        }

        /* Resource Grid */
        .resource-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .resource-card {
            padding: 25px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .resource-card:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.15);
            background: white;
        }

        .resource-card h4 {
            color: #667eea;
            margin-bottom: 12px;
            font-size: 20px;
            font-weight: 700;
        }

        .resource-card p {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .resource-card a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .resource-card a:hover {
            color: #764ba2;
        }

        .resource-card a::after {
            content: '→';
            transition: transform 0.3s ease;
        }

        .resource-card a:hover::after {
            transform: translateX(5px);
        }

        /* Links Grid */
        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 30px;
        }

        .link-group {
            padding: 25px;
            background: #f8fafc;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
        }

        .link-group h4 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #1e293b;
            font-weight: 700;
        }

        .link-group ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .link-group li {
            margin-bottom: 10px;
        }

        .link-group a {
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            font-weight: 500;
        }

        .link-group a:hover {
            color: #764ba2;
            transform: translateX(5px);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 30px 20px;
            color: white;
            background: rgba(0,0,0,0.2);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        footer p {
            margin: 0;
            opacity: 0.9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .hero h2 {
                font-size: 36px;
            }

            .hero p {
                font-size: 18px;
            }

            .main-card {
                padding: 30px 20px;
            }

            .section-title {
                font-size: 24px;
            }

            header {
                flex-direction: column;
                gap: 20px;
            }

            .nav-links {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <div class="logo-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z" fill="#667eea"/>
                    </svg>
                </div>
                <h1>Learnify</h1>
            </div>

            @if (Route::has('login'))
                <nav class="nav-links">
                    @auth
                        <a href="{{ url('/dashboard') }}">Dasbor</a>
                    @else
                        <a href="{{ route('login') }}">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrasi</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <section class="hero">
            <h2>Learn Coding the Easy Way</h2>
            <p>Master programming with structured paths, real projects, and progress tracking</p>
        </section>

        <div class="main-card">
            <section class="section">
                <h3 class="section-title">Resources</h3>
                <div class="resource-grid">
                    <div class="resource-card">
                        <h4>Flowbite</h4>
                        <p>Beautiful UI components and templates built with Tailwind CSS for modern web development</p>
                        <a href="https://flowbite.com" target="_blank">Explore Flowbite</a>
                    </div>
                    <div class="resource-card">
                        <h4>Tailwind CSS</h4>
                        <p>A utility-first CSS framework for rapidly building custom user interfaces</p>
                        <a href="https://tailwindcss.com" target="_blank">Explore Tailwind CSS</a>
                    </div>
                </div>
            </section>

            <section class="section">
                <h3 class="section-title">Follow Us</h3>
                <div class="links-grid">
                    <div class="link-group">
                        <h4>💻 Community</h4>
                        <ul>
                            <li><a href="https://github.com" target="_blank">Github</a></li>
                            <li><a href="https://discord.com" target="_blank">Discord</a></li>
                        </ul>
                    </div>
                    <div class="link-group">
                        <h4>📄 Legal</h4>
                        <ul>
                            <li><a href="/privacy">Privacy Policy</a></li>
                            <li><a href="/terms">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>

        <footer>
            <p>&copy; 2024 Codemy. All rights reserved. | Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
        </footer>
    </div>
</body>
</html>