<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task19 Perfume SaaS - Premium Perfume Business Solution</title>
    <meta name="description" content="The ultimate e-commerce SaaS platform for luxury perfume brands. Multi-theme, multi-tenant, and optimized for high-conversion fragrance sales.">
    <meta name="keywords" content="perfume saas, fragrance e-commerce, luxury perfume website, task19, perfume business solution">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-color: #F4F4F4;
            --text-main: #1A1A1A;
            --text-light: #555555;
            --accent-gold: #B88E2F;
            --accent-gold-light: #DFD3BD;
            --white: #FFFFFF;
            --transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            line-height: 1.7;
            overflow-x: hidden;
        }

        h1, h2, h3, .serif {
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 1.5rem 0;
            background: rgba(253, 251, 247, 0.8);
            backdrop-filter: blur(10px);
            z-index: 1000;
            border-bottom: 1px solid rgba(197, 160, 89, 0.1);
            transition: var(--transition);
        }

        .navbar.scrolled {
            padding: 1rem 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            color: var(--text-main);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .logo span {
            color: var(--accent-gold);
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-main);
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
        }

        .nav-link:hover {
            color: var(--accent-gold);
        }

        .menu-toggle {
            display: none;
            font-size: 1.5rem;
            color: var(--text-main);
            cursor: pointer;
            z-index: 1001;
        }

        .btn-premium {
            background: var(--accent-gold);
            color: var(--white);
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
            border: 1px solid var(--accent-gold);
            display: inline-block;
        }

        .btn-premium:hover {
            background: transparent;
            color: var(--accent-gold);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            color: var(--accent-gold);
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
            border: 1px solid var(--accent-gold);
        }

        .btn-outline:hover {
            background: var(--accent-gold);
            color: var(--white);
        }

        footer {
            padding: 8rem 0 4rem;
            background: #F4F1ED;
            border-top: 1px solid rgba(197, 160, 89, 0.1);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 2fr 1.5fr;
            gap: 4rem;
            margin-bottom: 6rem;
        }

        .footer-links-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .footer-logo {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .footer-info p {
            color: var(--text-light);
            font-size: 0.95rem;
            margin-bottom: 2rem;
            max-width: 300px;
        }

        .footer-social {
            display: flex;
            gap: 1.5rem;
        }

        .social-icon {
            color: var(--accent-gold);
            font-size: 1.2rem;
            transition: var(--transition);
        }

        .social-icon:hover {
            transform: translateY(-3px);
            color: var(--text-main);
        }

        .footer-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-nav {
            list-style: none;
        }

        .footer-nav li {
            margin-bottom: 1rem;
        }

        .footer-nav a {
            text-decoration: none;
            color: var(--text-light);
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .footer-nav a:hover {
            color: var(--accent-gold);
            padding-left: 5px;
        }

        .newsletter-form {
            display: flex;
            gap: 0;
            margin-top: 1.5rem;
        }

        .newsletter-input {
            padding: 1rem 1.5rem;
            border: 1px solid var(--accent-gold-light);
            border-radius: 50px 0 0 50px;
            background: var(--white);
            flex-grow: 1;
            font-family: inherit;
            outline: none;
        }

        .newsletter-btn {
            background: var(--accent-gold);
            color: var(--white);
            border: none;
            padding: 0 1.5rem;
            border-radius: 0 50px 50px 0;
            cursor: pointer;
            transition: var(--transition);
        }

        .newsletter-btn:hover {
            background: var(--text-main);
        }

        .footer-bottom {
            padding-top: 3rem;
            border-top: 1px solid rgba(197, 160, 89, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .copyright {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        @media (max-width: 992px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
            .footer-newsletter {
                grid-column: span 2;
            }
        }

        @media (max-width: 768px) {
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 4rem;
            }
            .footer-newsletter {
                grid-column: span 1;
            }
        }

        @media (max-width: 576px) {
            .footer-bottom {
                flex-direction: column;
                gap: 1.5rem;
                text-align: center;
            }
        }

        /* Animations */
        [data-reveal] {
            opacity: 0;
            transform: translateY(30px);
            transition: all 1s ease-out;
        }

        [data-reveal].revealed {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                width: 80%;
                height: 100vh;
                background: var(--bg-color);
                flex-direction: column;
                justify-content: center;
                gap: 2rem;
                padding: 4rem;
                transition: var(--transition);
                box-shadow: -10px 0 30px rgba(0,0,0,0.05);
                display: flex; /* Overriding display:none from previous turn */
            }

            .nav-links.active {
                right: 0;
            }

            .nav-links .btn-premium {
                width: 100%;
                text-align: center;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-content">
                <a href="{{ route('landing') }}" class="logo">TASK19<span>.</span>SAAS</a>
                <div class="menu-toggle" id="menu-toggle">
                    <i class="fa-solid fa-bars-staggered"></i>
                </div>
                <div class="nav-links" id="nav-links">
                    <a href="{{ route('landing') }}#features" class="nav-link">Features</a>
                    <a href="{{ route('landing.templates') }}" class="nav-link">Templates</a>
                    <a href="{{ route('landing') }}#pricing" class="nav-link">Pricing</a>
                    <a href="{{ route('landing') }}#contact" class="nav-link">Enquiry</a>
                    <a href="{{ route('landing') }}#contact" class="btn-premium">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-info">
                    <a href="#" class="logo footer-logo">TASK19<span>.</span>SAAS</a>
                    <p>The ultimate e-commerce solution for the modern fragrance industry. Elevating brands with premium digital experiences.</p>
                    <div class="footer-social">
                        <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="footer-links-row">
                    <div>
                        <h4 class="footer-title">Solutions</h4>
                        <ul class="footer-nav">
                            <li><a href="{{ route('v5.home') }}">Afnan Theme</a></li>
                            <li><a href="{{ route('velvet.home') }}">Velvet Experience</a></li>
                            <li><a href="{{ route('landing.templates') }}">Theme Catalog</a></li>
                            <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="footer-title">Company</h4>
                        <ul class="footer-nav">
                            <li><a href="{{ route('landing') }}#features">Features</a></li>
                            <li><a href="{{ route('landing') }}#pricing">Pricing</a></li>
                            <li><a href="{{ route('landing') }}#contact">Contact Us</a></li>
                            <li><a href="{{ route('landing.templates') }}">Live Demos</a></li>
                        </ul>
                    </div>
                </div>

                <div class="footer-newsletter">
                    <h4 class="footer-title">Stay Inspired</h4>
                    <p style="color: var(--text-light); font-size: 0.9rem;">Receive exclusive insights into the digital fragrance landscape.</p>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Email address" class="newsletter-input">
                        <button class="newsletter-btn"><i class="fa-solid fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="copyright">&copy; {{ date('Y') }} Task19 Perfume SaaS. All rights reserved.</p>
                <div class="footer-nav" style="display: flex; gap: 2rem;">
                    <a href="#" style="margin-bottom: 0;">Privacy Policy</a>
                    <a href="#" style="margin-bottom: 0;">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Reveal Animations
        const revealElements = document.querySelectorAll('[data-reveal]');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                }
            });
        }, { threshold: 0.1 });

        revealElements.forEach(el => observer.observe(el));

        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menu-toggle');
        const navLinks = document.getElementById('nav-links');

        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            const icon = menuToggle.querySelector('i');
            if (navLinks.classList.contains('active')) {
                icon.classList.replace('fa-bars-staggered', 'fa-xmark');
            } else {
                icon.classList.replace('fa-xmark', 'fa-bars-staggered');
            }
        });

        // Close menu on link click
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                menuToggle.querySelector('i').classList.replace('fa-xmark', 'fa-bars-staggered');
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
