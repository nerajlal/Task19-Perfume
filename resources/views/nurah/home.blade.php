@extends('layouts.storefront')

@section('title', 'VESPR Perfumes | Luxury Fragrance House')
@section('meta_description', 'Experience the art of scent with VESPR Perfumes. Explore our artisanal collection of luxury fragrances, exclusive combos, and signature oils.')
@section('meta_keywords', 'VESPR perfumes, luxury scent, artisanal fragrance, signature perfume, perfume house')

@section('content')
    <!-- Hero Section -->
    <div class="hero-banner">
        <div class="hero-content">
            <h1 class="hero-title">Elevate Your Presence</h1>
            <p class="hero-subtitle">Discover VESPR's curated collection of artisanal fragrances. Crafted for those who appreciate the finer things in life.</p>
            <a href="{{ route('v1.all-products') }}" class="btn-primary">Explore Collection</a>
        </div>
        <img src="{{ asset('images/hero-banner.png') }}" alt="VESPR Perfume" class="hero-image">
    </div>
    
    <!-- USP Trust Bar -->
    <div class="usp-bar">
        <div class="usp-item">
            <i class="fa-solid fa-circle-check"></i>
            <div class="usp-text">
                <span class="usp-title">100% Authentic</span>
                <span class="usp-desc">Direct from VESPR</span>
            </div>
        </div>
        <div class="usp-item">
            <i class="fa-solid fa-truck-fast"></i>
            <div class="usp-text">
                <span class="usp-title">Express Delivery</span>
                <span class="usp-desc">Across all major cities</span>
            </div>
        </div>
        <div class="usp-item">
            <i class="fa-solid fa-lock"></i>
            <div class="usp-text">
                <span class="usp-title">Secure Payment</span>
                <span class="usp-desc">100% Protected transactions</span>
            </div>
        </div>
        <div class="usp-item">
            <i class="fa-solid fa-rotate-left"></i>
            <div class="usp-text">
                <span class="usp-title">Easy Returns</span>
                <span class="usp-desc">14-Day easy window</span>
            </div>
        </div>
    </div>

    <!-- Featured Categories Grid (Quick Access) -->
    <!-- <div class="department-section">
        <div class="section-header">
            <h2 class="section-title">Shop by Family</h2>
        </div>
        <div class="product-grid" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
            @php 
                $families = [
                    ['name' => 'Floral', 'icon' => 'fa-leaf', 'color' => '#fdf2f2', 'slug' => 'floral'],
                    ['name' => 'Fresh', 'icon' => 'fa-wind', 'color' => '#f0fdfa', 'slug' => 'fresh'],
                    ['name' => 'Oriental', 'icon' => 'fa-moon', 'color' => '#fffbeb', 'slug' => 'oriental'],
                    ['name' => 'Woody', 'icon' => 'fa-tree', 'color' => '#fefaf2', 'slug' => 'woody']
                ];
            @endphp
            @foreach($families as $fam)
                <a href="{{ route('v1.collection', ['category' => $fam['slug']]) }}" style="background: {{ $fam['color'] }}; padding: 2rem; border-radius: 1.5rem; text-align: center; border: 1px solid rgba(0,0,0,0.05);">
                    <i class="fa-solid {{ $fam['icon'] }}" style="font-size: 2rem; margin-bottom: 1rem; color: var(--primary-color);"></i>
                    <h3 style="font-size: 1.1rem; font-weight: 700;">{{ $fam['name'] }}</h3>
                </a>
            @endforeach
        </div>
    </div> -->

    <!-- Collections Sections (Department Style) -->
    @php 
        $collections = \App\Models\Collection::with(['products' => function($query) {
            $query->where('status', 'active')->take(8);
        }])->where('status', 1)->get(); 
    @endphp

    @foreach($collections as $collection)
        @if($collection->products->count() > 0)
        <div class="department-section" id="collection-{{ $collection->id }}">
            <div class="section-header">
                <h2 class="section-title">{{ $collection->name }}</h2>
                <a href="{{ route('v1.collection', ['slug' => $collection->slug]) }}" class="view-all">View all <i class="fa-solid fa-chevron-right ms-1"></i></a>
            </div>
            
            <div class="product-grid">
                @foreach($collection->products as $product)
                    @include('nurah.partials.product_card', ['product' => $product])
                @endforeach
            </div>
        </div>
        @endif
    @endforeach
    
    <!-- Exclusive Combos Section -->
    @if(isset($bundles) && $bundles->count() > 0)
    <div class="department-section">
        <div class="section-header">
            <h2 class="section-title">Exclusive Combos</h2>
            <a href="{{ route('v1.combos') }}" class="view-all">View all <i class="fa-solid fa-chevron-right ms-1"></i></a>
        </div>
        
        <div class="product-grid">
            @foreach($bundles as $bundle)
                @include('nurah.partials.bundle_card', ['bundle' => $bundle])
            @endforeach
        </div>
    </div>
    @endif

    <!-- Fragrance Stories (Video Showcase) -->
    <div class="video-section">
        <div class="section-header">
            <h2 class="section-title">Fragrance Stories</h2>
            <p class="section-subtitle" style="margin-top: 0.5rem; color: var(--text-muted);">Experience the essence of VESPR through our visual journey.</p>
        </div>
        
        <div class="video-grid">
            <div class="video-card">
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/167AIKitcZs?autoplay=1&mute=1&loop=1&playlist=167AIKitcZs&controls=0&modestbranding=1&rel=0&playsinline=1" title="Fragrance Story 1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="video-info">
                    <a href="{{ route('v1.all-products') }}" class="video-btn">Shop Collection</a>
                </div>
            </div>
            <div class="video-card">
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/QM18rD-zrCs?autoplay=1&mute=1&loop=1&playlist=QM18rD-zrCs&controls=0&modestbranding=1&rel=0&playsinline=1" title="Fragrance Story 2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="video-info">
                    <a href="{{ route('v1.all-products') }}" class="video-btn">Shop Collection</a>
                </div>
            </div>
            <div class="video-card">
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/P7MxjMYwU_g?autoplay=1&mute=1&loop=1&playlist=P7MxjMYwU_g&controls=0&modestbranding=1&rel=0&playsinline=1" title="Fragrance Story 3" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="video-info">
                    <a href="{{ route('v1.all-products') }}" class="video-btn">Shop Collection</a>
                </div>
            </div>
            <div class="video-card">
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/UujTjwkuqbE?autoplay=1&mute=1&loop=1&playlist=UujTjwkuqbE&controls=0&modestbranding=1&rel=0&playsinline=1" title="Fragrance Story 4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="video-info">
                    <a href="{{ route('v1.all-products') }}" class="video-btn">Shop Collection</a>
                </div>
            </div>
            <div class="video-card">
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/WamyeDrjaVA?autoplay=1&mute=1&loop=1&playlist=WamyeDrjaVA&controls=0&modestbranding=1&rel=0&playsinline=1" title="Fragrance Story 5" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="video-info">
                    <a href="{{ route('v1.all-products') }}" class="video-btn">Shop Collection</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    <div class="newsletter-section">
        <div class="newsletter-content">
            <h2 class="newsletter-title">Experience Excellence</h2>
            <p class="newsletter-subtitle">Join our exclusive circle and be the first to know about new artisanal launches and limited edition scents.</p>
            <form class="newsletter-input-group">
                <input type="email" placeholder="Your email address" class="newsletter-input">
                <button type="button" class="newsletter-btn">Subscribe</button>
            </form>
        </div>
    </div>
@endsection

