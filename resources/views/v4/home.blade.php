@extends('v4.layouts.app')

@section('title', 'Ajmal Perfumes | Luxury Fragrance House Since 1951')

@section('content')
    <!-- Hero Split Banner -->
    <div class="a-hero-split">
        <div class="a-hero-half" style="background-image: url('https://ajmalperfume.com/cdn/shop/files/Mother_s_Day_Banner_Desktop.jpg');">
            <div class="a-hero-overlay-text">
                <span class="serif" style="font-size: 42px; color: #fff;">Mother's Day</span>
                <p style="color: #fff; letter-spacing: 2px;">GIFTS STARTING AT ₹999</p>
                <a href="#" class="a-btn-hero">Shop Now</a>
            </div>
        </div>
        <div class="a-hero-half" style="background-image: url('https://ajmalperfume.com/cdn/shop/files/Aureum_Banner_Desktop.jpg');">
            <div class="a-hero-overlay-text">
                <span class="serif" style="font-size: 42px; color: #fff;">Signature Oudh</span>
                <p style="color: #fff; letter-spacing: 2px;">PURE & AUTHENTIC</p>
                <a href="#" class="a-btn-hero">Explore</a>
            </div>
        </div>
    </div>

    <!-- OUR BESTSELLERS -->
    <section class="a-section">
        <div class="container">
            <div class="a-section-header">
                <div class="a-title-with-tabs">
                    <h2 class="serif" style="font-size: 32px; border-bottom: 3px solid var(--accent); padding-bottom: 10px;">OUR BESTSELLERS</h2>
                    <div class="a-tabs">
                        <button class="active">ALL</button>
                        <button>EDP</button>
                        <button>ATTAR</button>
                        <button>GIFTING</button>
                    </div>
                </div>
            </div>

            <div class="a-product-grid">
                @foreach($products->take(4) as $product)
                    @include('v4.partials.product_card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    <!-- LOVED BY CELEBRITIES -->
    <section class="a-section" style="background: var(--bg-soft); text-align: center;">
        <div class="container">
            <h2 class="cursive" style="font-family: 'Dancing Script', cursive; font-size: 48px; color: var(--accent);">Loved by Celebrities</h2>
            <div class="a-accent-line" style="width: 100px; height: 3px; background: var(--accent); margin: 10px auto;"></div>
        </div>
    </section>

    <!-- CATEGORIES -->
    <section class="a-section">
        <div class="container">
            <div class="a-section-header" style="text-align: center;">
                <h2 class="serif" style="font-size: 32px;">CATEGORIES</h2>
            </div>
            <div class="a-cat-grid">
                <div class="a-cat-item big" style="background-image: url('https://ajmalperfume.com/cdn/shop/files/Perfume_Category.jpg');">
                    <div class="a-cat-content">
                        <h3>Perfume</h3>
                        <p>Exquisite Sprays</p>
                    </div>
                </div>
                <div class="a-cat-item" style="background-image: url('https://ajmalperfume.com/cdn/shop/files/Attar_Category.jpg');">
                    <div class="a-cat-content">
                        <h3>Attar</h3>
                        <p>Traditional Oils</p>
                    </div>
                </div>
                <div class="a-cat-item" style="background-image: url('https://ajmalperfume.com/cdn/shop/files/Dakhoon_Category.jpg');">
                    <div class="a-cat-content">
                        <h3>Dakhoon</h3>
                        <p>Home Fragrance</p>
                    </div>
                </div>
                <div class="a-cat-item wide" style="background-image: url('https://ajmalperfume.com/cdn/shop/files/Gifting_Category.jpg');">
                    <div class="a-cat-content">
                        <h3>Giftset</h3>
                        <p>Thoughtful Presents</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- USP ICONS -->
    <section class="a-section" style="border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
        <div class="container">
            <div class="a-usp-row">
                <div class="a-usp-item">
                    <div class="a-usp-icon"><i class="fa-solid fa-earth-americas"></i></div>
                    <h4>60+ Countries</h4>
                    <p>Global Presence</p>
                </div>
                <div class="a-usp-item">
                    <div class="a-usp-icon"><i class="fa-solid fa-store"></i></div>
                    <h4>240+ Stores</h4>
                    <p>Exclusive Outlets</p>
                </div>
                <div class="a-usp-item">
                    <div class="a-usp-icon"><i class="fa-solid fa-award"></i></div>
                    <h4>7 Decades</h4>
                    <p>Of Craftsmanship</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SHOP BY OCCASIONS -->
    <section class="a-section bg-soft">
        <div class="container">
            <div class="a-section-header" style="text-align: center;">
                <h2 class="serif" style="font-size: 32px;">SHOP BY OCCASIONS</h2>
                <div class="a-accent-line" style="width: 60px; height: 3px; background: var(--accent); margin: 15px auto;"></div>
                <div class="a-tabs-centered" style="display: flex; justify-content: center; gap: 30px; margin-top: 20px;">
                    <button class="active">PARTY WEAR</button>
                    <button>DAY NIGHT</button>
                    <button>OFFICE</button>
                    <button>WEDDING</button>
                    <button>LUXURY GIFTING</button>
                </div>
            </div>
            <div class="a-product-grid" style="margin-top: 40px;">
                @foreach($products->skip(4)->take(4) as $product)
                    @include('v4.partials.product_card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    <!-- SHOP BY PRICE -->
    <section class="a-section">
        <div class="container">
            <div class="a-section-header" style="text-align: center;">
                <h2 class="serif" style="font-size: 32px;">SHOP BY PRICE</h2>
                <div class="a-accent-line" style="width: 60px; height: 3px; background: var(--accent); margin: 15px auto;"></div>
                <div class="a-tabs-centered" style="display: flex; justify-content: center; gap: 30px; margin-top: 20px;">
                    <button class="active">UNDER ₹1000</button>
                    <button>₹1000 - ₹2000</button>
                    <button>₹2000 - ₹3000</button>
                    <button>₹3000 - ₹5000</button>
                    <button>ABOVE ₹5000</button>
                </div>
            </div>
            <div class="a-product-grid" style="margin-top: 40px;">
                @foreach($products->skip(8)->take(4) as $product)
                    @include('v4.partials.product_card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    <!-- Process of Manufacturing -->
    <section class="a-section bg-soft">
        <div class="container">
            <div class="a-manufacturing-grid">
                <div class="a-manufacturing-content">
                    <h2 class="serif" style="font-size: 36px; margin-bottom: 20px;">Process of <span style="color: var(--accent);">Manufacturing</span></h2>
                    <p style="color: #666; font-size: 16px; line-height: 1.8; margin-bottom: 30px;">
                        Each Ajmal fragrance is a masterpiece, born from a harmonious blend of nature's finest ingredients and scientific precision. Our state-of-the-art manufacturing facility in Dubai spans over 150,000 square feet, where we process rare resins, exotic flowers, and precious woods to create olfactory wonders.
                    </p>
                    <ul style="list-style: none; margin-bottom: 40px;">
                        <li style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-check" style="color: var(--accent);"></i>
                            <span>Ethically sourced raw materials</span>
                        </li>
                        <li style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-check" style="color: var(--accent);"></i>
                            <span>Advanced R&D Laboratory</span>
                        </li>
                        <li style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-check" style="color: var(--accent);"></i>
                            <span>Strict Quality Assurance</span>
                        </li>
                    </ul>
                    <a href="#" class="a-btn-outline">Learn More</a>
                </div>
                <div class="a-manufacturing-media">
                    <div class="a-video-placeholder">
                        <img src="https://ajmalperfume.com/cdn/shop/files/Process_of_Manufacturing.jpg" alt="Manufacturing">
                        <button class="a-play-btn"><i class="fa-solid fa-play"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .a-hero-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            height: 500px;
        }

        .a-hero-half {
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .a-hero-overlay-text {
            text-align: center;
            background: rgba(0,0,0,0.2);
            padding: 40px;
            backdrop-filter: blur(2px);
        }

        .a-btn-hero {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: #fff;
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .a-title-with-tabs {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
            margin-bottom: 40px;
        }

        .a-tabs {
            display: flex;
            gap: 20px;
        }

        .a-tabs button {
            background: none;
            border: none;
            font-weight: 700;
            font-size: 13px;
            color: var(--text-muted);
            cursor: pointer;
            padding-bottom: 15px;
            position: relative;
        }

        .a-tabs button.active { color: var(--primary); }
        .a-tabs button.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--accent);
        }

        .a-cat-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-template-rows: repeat(2, 250px);
            gap: 20px;
        }

        .a-cat-item {
            background-size: cover;
            background-position: center;
            border-radius: 10px;
            position: relative;
            padding: 30px;
            display: flex;
            align-items: flex-end;
            cursor: pointer;
            overflow: hidden;
        }

        .a-cat-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
        }

        .a-cat-content { position: relative; color: #fff; }
        .a-cat-content h3 { font-size: 24px; }

        .a-cat-item.big { grid-row: span 2; }
        .a-cat-item.wide { grid-column: span 1; }

        .a-usp-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            text-align: center;
        }

        .a-usp-icon {
            font-size: 40px;
            color: var(--accent);
            margin-bottom: 15px;
        }

        .a-usp-item h4 { font-size: 18px; margin-bottom: 5px; }
        .a-usp-item p { color: var(--text-muted); font-size: 14px; }

        @media (max-width: 768px) {
            .a-hero-split { grid-template-columns: 1fr; height: auto; }
            .a-hero-half { height: 300px; }
            .a-cat-grid { grid-template-columns: 1fr; grid-template-rows: auto; }
            .a-cat-item { height: 200px; }
            .a-cat-item.big { grid-row: auto; }
            .a-usp-row { grid-template-columns: 1fr; gap: 40px; }
        }
    </style>

    <style>
        .a-section { padding: 100px 0; }
        .bg-soft { background: var(--bg-soft); }

        .a-section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .a-section-title {
            font-size: 36px;
            margin-bottom: 15px;
            letter-spacing: -0.5px;
        }

        .a-section-subtitle {
            color: var(--text-muted);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }

        /* Hero */
        .a-hero {
            height: calc(100vh - 120px);
            background: #f4f4f4;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .a-hero-slide {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            height: 100%;
            width: 100%;
        }

        .a-hero-content {
            padding: 0 10%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }

        .a-hero-tag {
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 3px;
            font-weight: 800;
            color: var(--text-muted);
            margin-bottom: 20px;
            display: block;
        }

        .a-hero-title {
            font-size: 72px;
            line-height: 1.1;
            margin-bottom: 30px;
            font-weight: 800;
        }

        .a-hero-desc {
            font-size: 18px;
            color: var(--text-muted);
            max-width: 500px;
            margin-bottom: 40px;
        }

        .a-hero-actions {
            display: flex;
            gap: 20px;
        }

        .a-hero-image-box {
            position: relative;
            background: #f0f0f0;
        }

        .a-hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Buttons */
        .a-btn-primary {
            background: var(--primary);
            color: #fff;
            padding: 18px 40px;
            text-decoration: none;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .a-btn-primary:hover {
            background: var(--accent);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(197, 160, 89, 0.2);
        }

        .a-btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 16px 40px;
            text-decoration: none;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 1px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .a-btn-outline:hover {
            background: var(--primary);
            color: #fff;
        }

        /* Family Grid */
        .a-family-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .a-family-card {
            position: relative;
            aspect-ratio: 0.8;
            overflow: hidden;
            border-radius: 12px;
            text-decoration: none;
        }

        .a-family-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .a-family-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            display: flex;
            align-items: flex-end;
            padding: 30px;
            transition: 0.3s;
        }

        .a-family-info h3 {
            color: #fff;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .a-family-info span {
            color: var(--accent);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .a-family-card:hover .a-family-img { transform: scale(1.1); }
        .a-family-card:hover .a-family-overlay { background: linear-gradient(to top, var(--accent), transparent); }

        /* Product Grid */
        .a-product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px 30px;
        }

        /* Editorial */
        .a-editorial-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
        }

        .a-editorial-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .a-editorial-content {
            padding: 10%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fff;
        }

        @media (max-width: 1024px) {
            .a-hero-title { font-size: 48px; }
            .a-product-grid, .a-family-grid { grid-template-columns: 1fr 1fr; }
            .a-hero-slide, .a-editorial-grid { grid-template-columns: 1fr; }
            .a-hero-content, .a-editorial-content { padding: 60px 20px; text-align: center; }
            .a-hero-actions { justify-content: center; }
        }

        @media (max-width: 768px) {
            .a-hero-title { font-size: 36px; }
            .a-section { padding: 60px 0; }
        }
    </style>
@endsection
