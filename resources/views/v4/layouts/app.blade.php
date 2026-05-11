<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ajmal Perfumes | Crafting Memories')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary: #1A1A1A;
            --accent: #B08D57; /* Tan/Gold from screenshot */
            --accent-soft: #fcf8f0;
            --bg: #FFFFFF;
            --bg-soft: #FBFBFB;
            --border: #EEEEEE;
            --text-main: #1A1A1A;
            --text-muted: #777777;
            --gold-gradient: linear-gradient(135deg, #B08D57 0%, #D4AF37 100%);
            --shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        @font-face {
            font-family: 'CursiveSerif';
            src: url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap');
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Outfit', sans-serif; 
            color: var(--text-main); 
            background: var(--bg);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, .serif { font-family: 'Playfair Display', serif; }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Refinement */
        header {
            background: #fff;
            padding: 15px 0;
            border-bottom: 1px solid var(--border);
        }

        .header-top {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            align-items: center;
            gap: 30px;
            margin-bottom: 20px;
        }

        .logo img { height: 50px; }

        .search-container {
            position: relative;
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
        }

        .search-container input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: 1.5px solid var(--border);
            border-radius: 30px;
            background: #F9F9F9;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
        }

        .search-container input:focus { border-color: var(--accent); background: #fff; }

        .search-container i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .nav-actions {
            display: flex;
            justify-content: flex-end;
            gap: 25px;
        }

        .action-link {
            text-decoration: none;
            color: var(--primary);
            font-size: 20px;
            position: relative;
        }

        .action-link span {
            position: absolute;
            top: -8px;
            right: -10px;
            background: var(--accent);
            color: #fff;
            font-size: 10px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .nav-bottom {
            display: flex;
            justify-content: center;
            gap: 40px;
            border-top: 1px solid var(--border);
            padding-top: 15px;
        }

        .nav-link {
            text-decoration: none;
            color: var(--primary);
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .nav-link:hover { color: var(--accent); }

        /* Footer */
        footer {
            background: var(--primary);
            color: #fff;
            padding: 80px 0 40px;
            margin-top: 100px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 50px;
        }

        .footer-logo {
            font-size: 28px;
            color: #fff;
            margin-bottom: 20px;
            display: block;
        }

        .footer-text {
            color: #999;
            font-size: 14px;
            max-width: 300px;
        }

        .footer-col h4 {
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 2px;
            margin-bottom: 25px;
            color: var(--accent);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li { margin-bottom: 12px; }

        .footer-links a {
            color: #999;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .footer-links a:hover { color: #fff; }

        .newsletter-form {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .newsletter-input {
            background: #2A2A2A;
            border: 1px solid #333;
            padding: 12px 15px;
            border-radius: 8px;
            color: #fff;
            flex-grow: 1;
            outline: none;
        }

        .newsletter-btn {
            background: var(--accent);
            color: #fff;
            border: none;
            padding: 0 20px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
        }

        .footer-bottom {
            margin-top: 60px;
            padding-top: 30px;
            border-top: 1px solid #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #666;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .nav-links { display: none; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 20px; text-align: center; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="top-bar">
        Free Shipping on Orders Above ₹399 • Crafting Memories Since 1951
    </div>

    <header>
        <div class="container">
            <div class="header-top">
                <a href="{{ route('v4.home') }}" class="logo">
                    <img src="https://ajmalperfume.com/cdn/shop/files/Ajmal_Logo_1.png?v=1614298135" alt="Ajmal Logo">
                </a>
                
                <div class="search-container">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search for Perfumes, Attars, Dakhoon...">
                </div>

                <div class="nav-actions">
                    <a href="#" class="action-link"><i class="fa-regular fa-user"></i></a>
                    <a href="#" class="action-link"><i class="fa-regular fa-heart"></i></a>
                    <a href="#" class="action-link">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span>0</span>
                    </a>
                </div>
            </div>

            <nav class="nav-bottom">
                <a href="{{ route('v4.home') }}" class="nav-link">Home</a>
                <a href="{{ route('v4.all-products') }}" class="nav-link">Shop All</a>
                <a href="#" class="nav-link">Best Sellers</a>
                <a href="#" class="nav-link">New Arrivals</a>
                <a href="#" class="nav-link">Attars</a>
                <a href="#" class="nav-link">Gifting</a>
                <a href="#" class="nav-link">Our Heritage</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="#" class="logo footer-logo">AJMAL</a>
                    <p class="footer-text">A world-class fragrance house with a legacy of over seven decades in the art of perfumery.</p>
                    <div style="margin-top: 25px; display: flex; gap: 15px;">
                        <a href="#" style="color: #fff; font-size: 18px;"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" style="color: #fff; font-size: 18px;"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" style="color: #fff; font-size: 18px;"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h4>Collections</h4>
                    <ul class="footer-links">
                        <li><a href="#">Signature Oudh</a></li>
                        <li><a href="#">French Collection</a></li>
                        <li><a href="#">Oriental Blends</a></li>
                        <li><a href="#">Gifting Sets</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Customer Care</h4>
                    <ul class="footer-links">
                        <li><a href="#">Track Order</a></li>
                        <li><a href="#">Shipping Policy</a></li>
                        <li><a href="#">Returns & Refunds</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Stay Inspired</h4>
                    <p class="footer-text" style="color: #666;">Subscribe to receive updates, access to exclusive deals, and more.</p>
                    <form class="newsletter-form">
                        <input type="email" class="newsletter-input" placeholder="Enter your email">
                        <button class="newsletter-btn">JOIN</button>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Ajmal Perfumes India. All Rights Reserved.</p>
                <div style="display: flex; gap: 20px;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" height="15" style="filter: grayscale(1) opacity(0.5);">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" height="20" style="filter: grayscale(1) opacity(0.5);">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" height="15" style="filter: grayscale(1) opacity(0.5);">
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
