@extends('v4.layouts.app')

@section('title', 'Task19 Perfumes | Luxury Fragrance House Since 1951')

@section('content')
    <!-- Hero Split Banner -->
    <div class="aj-hero-split {{ $sliders->count() < 2 ? 'single' : '' }}">
        @if($sliders->count() > 0)
            @foreach($sliders->take(2) as $index => $slide)
                <div class="aj-hero-item" style="background-image: url('{{ asset('storage/' . $slide->image) }}');">
                    <div class="aj-hero-box">
                        <h2 class="serif">{{ $slide->title ?? 'New Collection' }}</h2>
                        <p>{{ $slide->sub_title ?? 'EXCLUSIVE OFFERS' }}</p>
                        @if($slide->link)
                            <a href="{{ $slide->link }}" class="aj-btn-white">Shop Now</a>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <!-- Fallback if no sliders in DB -->
            <div class="aj-hero-item" style="background-image: url('https://ajmalperfume.com/cdn/shop/files/Mother_s_Day_Banner_Desktop.jpg');">
                <div class="aj-hero-box">
                    <h2 class="serif">Mother's Day</h2>
                    <p>GIFTS STARTING AT ₹999</p>
                    <a href="#" class="aj-btn-white">Shop Now</a>
                </div>
            </div>
            <div class="aj-hero-item" style="background-image: url('https://ajmalperfume.com/cdn/shop/files/Aureum_Banner_Desktop.jpg');">
                <div class="aj-hero-box">
                    <h2 class="serif">Signature Oudh</h2>
                    <p>PURE & AUTHENTIC</p>
                    <a href="#" class="aj-btn-white">Explore</a>
                </div>
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
                        <iframe src="https://www.youtube.com/embed/WamyeDrjaVA?autoplay=1&mute=1&loop=1&playlist=WamyeDrjaVA&controls=0&modestbranding=1&rel=0&playsinline=1" title="Fragrance Story 5" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                    <img src="https://ajmalperfume.com/cdn/shop/files/Process_of_Manufacturing.jpg" alt="Manufacturing">
                    <div class="play-overlay"><i class="fa-solid fa-play"></i></div>
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

        /* Hero */
        .aj-hero-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            height: 600px;
        }
        .aj-hero-split.single { grid-template-columns: 1fr; }
        .aj-hero-item {
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 400px;
        }
        .aj-hero-box {
            text-align: center;
            color: #fff;
        }
        .aj-hero-box h2 { font-size: 64px; margin-bottom: 10px; }
        .aj-hero-box p { font-size: 14px; letter-spacing: 3px; margin-bottom: 30px; }
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
            .aj-hero-split, .aj-cat-layout, .aj-usp-grid, .aj-manufacturing, .aj-product-grid { grid-template-columns: 1fr; }
            .aj-cat-layout { grid-template-rows: auto; }
            .aj-cat-big, .aj-cat-wide, .aj-cat-small { height: 300px; }
            .aj-hero-box h2 { font-size: 42px; }
        }
    </style>
@endsection
