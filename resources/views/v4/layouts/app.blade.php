<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task19 Perfumes | Luxury Fragrance House')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --aj-gold: #B08D57;
            --aj-dark: #1A1A1A;
            --aj-gray: #777777;
            --aj-border: #EEEEEE;
            --aj-bg: #FFFFFF;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Montserrat', sans-serif; 
            color: var(--aj-dark); 
            background: var(--aj-bg);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .serif { font-family: 'Playfair Display', serif; }
        .cursive { font-family: 'Dancing Script', cursive; text-transform: none !important; }

        .container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Top Bar */
        .top-bar {
            background: #F4F4F4;
            text-align: center;
            padding: 10px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        /* Header */
        header {
            background: #fff;
            padding: 20px 0;
            border-bottom: 1px solid var(--aj-border);
        }

        .header-main {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            align-items: center;
        }

        .logo { 
            text-decoration: none; 
            color: var(--aj-dark); 
            font-size: 24px; 
            font-weight: 900; 
            letter-spacing: -1px;
            text-transform: uppercase;
        }
        .logo span { color: var(--aj-gold); }

        .search-bar {
            position: relative;
            max-width: 550px;
            width: 100%;
            margin: 0 auto;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: 1.5px solid var(--aj-border);
            border-radius: 4px;
            background: #fff;
            font-size: 13px;
            outline: none;
        }

        .search-bar i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .header-actions {
            display: flex;
            justify-content: flex-end;
            gap: 25px;
        }

        .action-item {
            text-decoration: none;
            color: var(--aj-dark);
            font-size: 22px;
            position: relative;
        }

        .action-item span {
            position: absolute;
            top: -5px;
            right: -8px;
            background: var(--aj-gold);
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

        /* Navigation */
        .nav-row {
            display: flex;
            justify-content: center;
            gap: 35px;
            padding: 20px 0 10px;
        }

        .nav-item {
            text-decoration: none;
            color: var(--aj-dark);
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .nav-item:hover { color: var(--aj-gold); }

        /* Footer */
        footer {
            background: #8B6B3F; /* Brown/Gold background from screenshot */
            color: #fff;
            padding: 80px 0 40px;
            margin-top: 50px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.5fr;
            gap: 50px;
        }

        .footer-logo {
            font-size: 24px;
            font-weight: 900;
            color: #fff;
            text-decoration: none;
            margin-bottom: 25px;
            display: block;
            text-transform: uppercase;
        }
        .footer-logo span { color: var(--aj-gold); }

        .footer-col h4 {
            text-transform: uppercase;
            font-size: 14px;
            margin-bottom: 30px;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }
        .footer-links a:hover { color: #fff; padding-left: 5px; }

        .footer-bottom {
            margin-top: 60px;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            text-align: center;
            font-size: 12px;
            color: rgba(255,255,255,0.6);
        }

        @media (max-width: 991px) {
            .header-main { grid-template-columns: 1fr 1fr; }
            .search-bar { display: none; }
            .nav-row { display: none; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="top-bar">
        Free Shipping on Orders Above ₹500 • COD Available • Crafting Memories Since 1951
    </div>

    <header>
        <div class="container">
            <div class="header-main">
                <a href="{{ route('v4.home') }}" class="logo">
                    TASK19 <span>PERFUMES</span>
                </a>

                <div class="search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search for Perfumes, Attars, Gift Sets...">
                </div>

                <div class="header-actions">
                    <a href="#" class="action-item"><i class="fa-regular fa-user"></i></a>
                    <a href="#" class="action-item"><i class="fa-regular fa-heart"></i></a>
                    <a href="#" class="action-item">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span>0</span>
                    </a>
                </div>
            </div>

            <nav class="nav-row">
                <a href="{{ route('v4.home') }}" class="nav-item">Home</a>
                <a href="#" class="nav-item">Bestsellers</a>
                <a href="#" class="nav-item">EDP</a>
                <a href="#" class="nav-item">Attar</a>
                <a href="#" class="nav-item">Gifting</a>
                <a href="#" class="nav-item">New Arrivals</a>
                <a href="#" class="nav-item">Dakhoon</a>
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
                    <a href="{{ route('v4.home') }}" class="footer-logo">
                        TASK19 <span>PERFUMES</span>
                    </a>
                    <p style="opacity: 0.8; font-size: 14px;">A world-class fragrance house with a legacy of excellence in the art of perfumery.</p>
                    <div style="margin-top: 30px; display: flex; gap: 20px;">
                        <a href="#" style="color: #fff; font-size: 20px;"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" style="color: #fff; font-size: 20px;"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" style="color: #fff; font-size: 20px;"><i class="fa-brands fa-youtube"></i></a>
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
                    <h4>Contact Us</h4>
                    <p style="font-size: 14px; opacity: 0.8; line-height: 2;">
                        Customercare@ajmalperfume.com<br>
                        +91 123 456 7890<br>
                        10:00 AM - 7:00 PM (Mon-Sat)
                    </p>
                </div>
            </div>

            <div class="footer-bottom">
                &copy; {{ date('Y') }} TASK19 PERFUMES INDIA. ALL RIGHTS RESERVED.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
