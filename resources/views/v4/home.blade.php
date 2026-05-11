@extends('v4.layouts.app')

@section('title', 'Task19 Perfumes | Luxury Fragrance House Since 1951')

@section('content')
    <!-- Hero Slider -->
    <div class="aj-hero-slider">
        <div class="aj-slides-container">
            @if($sliders->count() > 0)
                @foreach($sliders as $index => $slide)
                    <div class="aj-slide {{ $index == 0 ? 'active' : '' }}">
                        <picture>
                            <source media="(max-width: 768px)" srcset="{{ Storage::url($slide->image_mobile) }}">
                            <img src="{{ Storage::url($slide->image_desktop) }}" alt="{{ $slide->title ?? 'Task19 Perfumes' }}" class="hero-img" {{ $index == 0 ? '' : 'loading=lazy' }}>
                        </picture>
                        {{-- Text removed as per request --}}
                    </div>
                @endforeach
            @else
                <!-- Fallback Slider -->
                <div class="aj-slide active">
                    <picture>
                        <source media="(max-width: 768px)" srcset="https://ajmalperfume.com/cdn/shop/files/Mother_s_Day_Banner_Mobile.jpg">
                        <img src="https://ajmalperfume.com/cdn/shop/files/Mother_s_Day_Banner_Desktop.jpg" alt="Mother's Day" class="hero-img">
                    </picture>
                </div>
                <div class="aj-slide">
                    <picture>
                        <source media="(max-width: 768px)" srcset="https://ajmalperfume.com/cdn/shop/files/Aureum_Banner_Mobile.jpg">
                        <img src="https://ajmalperfume.com/cdn/shop/files/Aureum_Banner_Desktop.jpg" alt="Signature Oudh" class="hero-img">
                    </picture>
                </div>
            @endif
        </div>
        
        @if($sliders->count() > 1 || $sliders->count() == 0)
        <div class="aj-slider-arrows">
            <button class="aj-arrow prev" onclick="goToSlide(currentSlide - 1)"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="aj-arrow next" onclick="goToSlide(currentSlide + 1)"><i class="fa-solid fa-chevron-right"></i></button>
        </div>

        <div class="aj-slider-dots">
            @php $slideCount = $sliders->count() > 0 ? $sliders->count() : 2; @endphp
            @for($i = 0; $i < $slideCount; $i++)
                <div class="aj-dot {{ $i == 0 ? 'active' : '' }}" onclick="goToSlide({{ $i }})"></div>
            @endfor
        </div>
        @endif
    </div>

    <!-- OUR BESTSELLERS -->
    <section class="aj-section">
        <div class="container">
            <div class="aj-section-header">
                <div class="aj-header-flex">
                    <h2 class="aj-title">OUR <span class="gold-under">BESTSELLERS</span></h2>
                    <div class="aj-tabs">
                        <button class="active">ALL</button>
                        <button>EDP</button>
                        <button>ATTAR</button>
                        <button>GIFTING</button>
                        <a href="{{ route('v4.all-products') }}" class="view-all">View All</a>
                    </div>
                </div>
            </div>

            <div class="aj-product-grid">
                @foreach($products->take(4) as $product)
                    @include('v4.partials.product_card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    <!-- LOVED BY CELEBRITIES -->
    <section class="aj-section bg-soft">
        <div class="container text-center">
            <h2 class="aj-title cursive">LOVED BY <span class="sketch-under">CELEBRITIES</span></h2>
            
            <div class="video-grid">
                <div class="video-card">
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/167AIKitcZs?autoplay=1&mute=1&loop=1&playlist=167AIKitcZs&controls=0&modestbranding=1&rel=0&playsinline=1" title="Fragrance Story 1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="video-info">
                        <a href="{{ route('v4.all-products') }}" class="video-btn">Shop Collection</a>
                    </div>
                </div>
                <div class="video-card">
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/QM18rD-zrCs?autoplay=1&mute=1&loop=1&playlist=QM18rD-zrCs&controls=0&modestbranding=1&rel=0&playsinline=1" title="Fragrance Story 2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="video-info">
                        <a href="{{ route('v4.all-products') }}" class="video-btn">Shop Collection</a>
                    </div>
                </div>
                <div class="video-card">
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/P7MxjMYwU_g?autoplay=1&mute=1&loop=1&playlist=P7MxjMYwU_g&controls=0&modestbranding=1&rel=0&playsinline=1" title="Fragrance Story 3" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="video-info">
                        <a href="{{ route('v4.all-products') }}" class="video-btn">Shop Collection</a>
                    </div>
                </div>
                <div class="video-card">
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/UujTjwkuqbE?autoplay=1&mute=1&loop=1&playlist=UujTjwkuqbE&controls=0&modestbranding=1&rel=0&playsinline=1" title="Fragrance Story 4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="video-info">
                        <a href="{{ route('v4.all-products') }}" class="video-btn">Shop Collection</a>
                    </div>
                </div>
                <div class="video-card">
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/WamyeDrjaVA?autoplay=1&mute=1&loop=1&playlist=WamyeDrjaVA&controls=0&modestbranding=1&rel=0&playsinline=1" title="Fragrance Story 5" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                    </div>
                    <div class="video-info">
                        <a href="{{ route('v4.all-products') }}" class="video-btn">Shop Collection</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CATEGORIES -->
    <section class="aj-section">
        <div class="container">
            <h2 class="aj-title text-center" style="margin-bottom: 50px;">CATEGORIES</h2>
            <div class="aj-cat-layout">
                @php $colls = $collections->take(4); @endphp
                
                @if($colls->count() >= 1)
                <a href="{{ route('v4.collection', ['slug' => $colls[0]->slug]) }}" class="aj-cat-big" style="background-image: url('{{ $colls[0]->image ? asset('storage/' . $colls[0]->image) : 'https://ajmalperfume.com/cdn/shop/files/Perfume_Category.jpg' }}'); background-color: #f4f4f4;">
                    <div class="aj-cat-info">
                        <h3>{{ $colls[0]->name }}</h3>
                        <p>Discover Collection</p>
                    </div>
                </a>
                @endif

                <div class="aj-cat-right">
                    @if($colls->count() >= 2)
                    <a href="{{ route('v4.collection', ['slug' => $colls[1]->slug]) }}" class="aj-cat-small" style="background-image: url('{{ $colls[1]->image ? asset('storage/' . $colls[1]->image) : 'https://ajmalperfume.com/cdn/shop/files/Attar_Category.jpg' }}'); background-color: #eee;">
                        <div class="aj-cat-info">
                            <h3>{{ $colls[1]->name }}</h3>
                            <p>Pure Essence</p>
                        </div>
                    </a>
                    @endif

                    @if($colls->count() >= 3)
                    <a href="{{ route('v4.collection', ['slug' => $colls[2]->slug]) }}" class="aj-cat-small" style="background-image: url('{{ $colls[2]->image ? asset('storage/' . $colls[2]->image) : 'https://ajmalperfume.com/cdn/shop/files/Dakhoon_Category.jpg' }}'); background-color: #ddd;">
                        <div class="aj-cat-info">
                            <h3>{{ $colls[2]->name }}</h3>
                            <p>Traditional Blends</p>
                        </div>
                    </a>
                    @endif
                </div>

                @if($colls->count() >= 4)
                <a href="{{ route('v4.collection', ['slug' => $colls[3]->slug]) }}" class="aj-cat-wide" style="background-image: url('{{ $colls[3]->image ? asset('storage/' . $colls[3]->image) : 'https://ajmalperfume.com/cdn/shop/files/Gifting_Category.jpg' }}'); background-color: #ccc;">
                    <div class="aj-cat-info">
                        <h3>{{ $colls[3]->name }}</h3>
                        <p>Luxury Gift Sets</p>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- SHOP BY PRICE -->
    <section class="aj-section">
        <div class="container text-center">
            <h2 class="aj-title cursive">SHOP BY <span class="sketch-under">PRICE</span></h2>
            
            <div class="aj-tabs-center" style="margin: 40px 0;">
                <button class="active">UNDER 1999</button>
                <button>FROM 2000 TO 2999</button>
                <button>FROM 3000 TO 3999</button>
                <button>FROM 4000 TO 4999</button>
                <button>ABOVE 5000</button>
            </div>

            <div class="aj-product-grid">
                @foreach($products->shuffle()->take(4) as $product)
                    @include('v4.partials.product_card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    <!-- NEW ARRIVALS -->
    <section class="aj-section bg-soft">
        <div class="container">
            <div class="aj-section-header">
                <div class="aj-header-flex">
                    <h2 class="aj-title">NEW <span class="gold-under">ARRIVALS</span></h2>
                    <a href="{{ route('v4.all-products') }}" class="view-all">View All</a>
                </div>
            </div>
            <div class="aj-product-grid">
                @foreach($products->skip(4)->take(4) as $product)
                    @include('v4.partials.product_card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    <!-- USP ROW -->
    <section class="aj-usp-section">
        <div class="container">
            <div class="aj-usp-grid">
                <div class="aj-usp-item">
                    <div class="aj-usp-icon"><img src="https://ajmalperfume.com/cdn/shop/files/60_Countries.png" alt="60+ Countries"></div>
                    <h3>60+ Countries</h3>
                    <p>Global Presence</p>
                </div>
                <div class="aj-usp-item">
                    <div class="aj-usp-icon"><img src="https://ajmalperfume.com/cdn/shop/files/240_Stores.png" alt="240+ Stores"></div>
                    <h3>240+ Stores</h3>
                    <p>Exclusive Outlets</p>
                </div>
                <div class="aj-usp-item">
                    <div class="aj-usp-icon"><img src="https://ajmalperfume.com/cdn/shop/files/7_Decades.png" alt="7 Decades"></div>
                    <h3>70+ Years</h3>
                    <p>Of Craftsmanship</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SHOP BY OCCASIONS -->
    <section class="aj-section">
        <div class="container">
            <h2 class="aj-title text-center">SHOP BY <span class="gold-under">OCCASIONS</span></h2>
            <div class="aj-tabs-center">
                <button class="active">PARTY WEAR</button>
                <button>DAY NIGHT</button>
                <button>OFFICE</button>
                <button>WEDDING</button>
                <button>LUXURY GIFTING</button>
            </div>
            <div class="aj-product-grid" style="margin-top: 40px;">
                @foreach($products->skip(8)->take(4) as $product)
                    @include('v4.partials.product_card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    <!-- PROCESS OF MANUFACTURING -->
    <section class="aj-section bg-soft">
        <div class="container">
            <div class="aj-manufacturing">
                <div class="aj-man-media">
                    <div class="video-container" style="padding-bottom: 56.25%; border-radius: 4px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        <iframe src="https://www.youtube.com/embed/QM18rD-zrCs?autoplay=0&mute=1&rel=0&modestbranding=1" title="Manufacturing Process" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="aj-man-text">
                    <h2 class="aj-title">PROCESS OF <span class="gold-under">MANUFACTURING</span></h2>
                    <p>Our state-of-the-art facility in Dubai is where magic happens. We combine traditional art with modern science to create fragrances that last forever.</p>
                    <a href="#" class="aj-btn-outline">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .aj-section { padding: 80px 0; }
        .bg-soft { background: #FBFBFB; }
        
        .aj-title {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .gold-under {
            position: relative;
            display: inline-block;
        }
        .gold-under::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 3px;
            background: #B08D57;
        }

        .sketch-under {
            position: relative;
            display: inline-block;
        }
        .sketch-under::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: 10px;
            background: url('https://ajmalperfume.com/cdn/shop/t/106/assets/title_bg.png') no-repeat center;
            background-size: contain;
        }

        /* Hero Slider */
        .aj-hero-slider {
            position: relative;
            height: 650px;
            overflow: hidden;
            background: #000;
        }

        .aj-slides-container {
            width: 100%;
            height: 100%;
        }

        .aj-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            z-index: 1;
            overflow: hidden;
        }

        .hero-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .aj-slide.active {
            opacity: 1;
            z-index: 2;
        }

        .aj-hero-box {
            text-align: center;
            color: #fff;
            transform: translateY(30px);
            transition: 0.8s 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            opacity: 0;
        }

        .aj-slide.active .aj-hero-box {
            transform: translateY(0);
            opacity: 1;
        }

        .aj-hero-box h2 { font-size: 64px; margin-bottom: 10px; }
        .aj-hero-box p { font-size: 14px; letter-spacing: 3px; margin-bottom: 30px; }

        .aj-slider-dots {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .aj-dot {
            width: 10px;
            height: 10px;
            background: rgba(255,255,255,0.4);
            border-radius: 50%;
            cursor: pointer;
            transition: 0.3s;
        }

        .aj-dot.active {
            background: #fff;
            transform: scale(1.3);
        }

        .aj-slider-arrows {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            padding: 0 40px;
            z-index: 10;
        }

        .aj-arrow {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.3);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            transition: 0.3s;
            backdrop-filter: blur(5px);
        }

        .aj-arrow:hover {
            background: #fff;
            color: #000;
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .aj-slider-arrows { display: none; }
        }
        /* Header Flex */
        .aj-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .aj-btn-white {
            display: inline-block;
            padding: 15px 40px;
            background: #fff;
            color: #000;
            text-decoration: none;
            font-weight: 800;
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: 0.3s;
        }
        .aj-btn-white:hover { background: var(--aj-gold); color: #fff; }

        /* Video Grid */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-top: 50px;
        }

        .video-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .video-card:hover { transform: translateY(-5px); }

        .video-container {
            position: relative;
            padding-bottom: 177.77%; /* 9:16 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .video-info { padding: 15px; }

        .video-btn {
            display: block;
            text-align: center;
            background: var(--aj-dark);
            color: #fff;
            text-decoration: none;
            padding: 10px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 4px;
            transition: 0.3s;
        }

        .video-btn:hover { background: var(--aj-gold); }

        @media (max-width: 991px) {
            .video-grid {
                display: flex;
                overflow-x: auto;
                scroll-snap-type: x mandatory;
                padding-bottom: 20px;
                gap: 15px;
            }
            .video-card {
                min-width: 250px;
                scroll-snap-align: start;
            }
        }

        .aj-tabs { display: flex; gap: 30px; align-items: center; }
        .aj-tabs button {
            background: none;
            border: none;
            font-weight: 700;
            font-size: 12px;
            color: #999;
            cursor: pointer;
            text-transform: uppercase;
        }
        .aj-tabs button.active { color: #000; position: relative; }
        .aj-tabs button.active::after {
            content: '';
            position: absolute;
            bottom: -17px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--aj-gold);
        }
        .view-all {
            text-decoration: none;
            color: #000;
            font-weight: 800;
            font-size: 12px;
            border: 1px solid #000;
            padding: 8px 20px;
        }

        /* Category Layout */
        .aj-cat-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .aj-cat-big {
            grid-column: 1;
            grid-row: 1;
            height: 620px;
            background-size: cover;
            background-position: center;
            border-radius: 4px;
            display: flex;
            align-items: flex-end;
            padding: 40px;
            color: #fff;
            text-decoration: none;
        }
        .aj-cat-right {
            grid-column: 2;
            grid-row: 1;
            display: grid;
            grid-template-rows: 1fr 1fr;
            gap: 20px;
        }
        .aj-cat-small {
            background-size: cover;
            background-position: center;
            border-radius: 4px;
            display: flex;
            align-items: flex-end;
            padding: 30px;
            color: #fff;
            text-decoration: none;
        }
        .aj-cat-wide {
            grid-column: span 2;
            height: 300px;
            background-size: cover;
            background-position: center;
            border-radius: 4px;
            display: flex;
            align-items: flex-end;
            padding: 40px;
            color: #fff;
            text-decoration: none;
        }
        .aj-cat-info h3 { font-size: 28px; margin-bottom: 5px; }
        .aj-cat-info p { font-size: 14px; opacity: 0.8; }

        /* USP */
        .aj-usp-section { padding: 60px 0; border-top: 1px solid #eee; border-bottom: 1px solid #eee; }
        .aj-usp-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; }
        .aj-usp-item { text-align: center; }
        .aj-usp-icon img { height: 60px; margin-bottom: 20px; }
        .aj-usp-item h3 { font-size: 18px; margin-bottom: 5px; }
        .aj-usp-item p { color: #777; font-size: 14px; }

        /* Occasions Tabs */
        .aj-tabs-center {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 30px;
        }
        .aj-tabs-center button {
            background: none;
            border: none;
            font-weight: 800;
            font-size: 11px;
            color: #999;
            cursor: pointer;
            letter-spacing: 1px;
        }
        .aj-tabs-center button.active { color: #B08D57; border-bottom: 2px solid #B08D57; padding-bottom: 10px; }

        /* Manufacturing */
        .aj-manufacturing {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 60px;
            align-items: center;
        }
        .aj-man-media { position: relative; }
        .aj-man-media img { width: 100%; border-radius: 4px; }
        .play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #B08D57;
        }

        .aj-product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        @media (max-width: 991px) {
            .aj-hero-slider { height: auto; aspect-ratio: 4/5; }
            .aj-hero-box h2 { font-size: 36px; }
            .aj-hero-box p { font-size: 11px; letter-spacing: 1.5px; }
            .aj-btn-white { padding: 12px 25px; font-size: 10px; }

            .aj-product-grid { 
                grid-template-columns: repeat(2, 1fr); 
                gap: 15px; 
            }
            .aj-section { padding: 40px 0; }
            .aj-title { font-size: 20px; }

            .aj-header-flex { flex-direction: column; gap: 15px; align-items: flex-start; }
            .aj-tabs { width: 100%; overflow-x: auto; padding-bottom: 10px; }
            .view-all { display: none; }

            .aj-cat-layout { grid-template-columns: 1fr; }
            .aj-cat-big { height: 400px; grid-column: 1; grid-row: auto; }
            .aj-cat-right { grid-column: 1; grid-row: auto; }
            .aj-cat-wide { grid-column: 1; height: 250px; }

            .aj-usp-grid { grid-template-columns: 1fr; gap: 30px; }
            .aj-manufacturing { grid-template-columns: 1fr; gap: 30px; }
            .aj-man-text { text-align: center; }

            .aj-tabs-center { gap: 15px; overflow-x: auto; justify-content: flex-start; padding-bottom: 10px; }
            .aj-tabs-center button { white-space: nowrap; font-size: 10px; }
        }
    </style>
    @push('scripts')
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.aj-slide');
        const dots = document.querySelectorAll('.aj-dot');
        const totalSlides = slides.length;

        function goToSlide(n) {
            slides[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            currentSlide = (n + totalSlides) % totalSlides;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }

        function nextSlide() {
            goToSlide(currentSlide + 1);
        }

        if(totalSlides > 1) {
            setInterval(nextSlide, 5000);
        }
    </script>
    @endpush
@endsection
