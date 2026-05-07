@extends('layouts.storefront')

@section('title', 'Task19 Perfumes | Luxury Fragrance House')

@section('content')
    <!-- Hero Section -->
    <div class="hero-banner">
        <div class="hero-content">
            <h1 class="hero-title">Elevate Your Presence</h1>
            <p class="hero-subtitle">Discover Task19's curated collection of artisanal fragrances. Crafted for those who appreciate the finer things in life.</p>
            <a href="{{ route('all-products') }}" class="btn-primary">Explore Collection</a>
        </div>
        <img src="{{ asset('images/hero-banner.png') }}" alt="Task19 Perfume" class="hero-image">
    </div>
    
    <!-- USP Trust Bar -->
    <div class="usp-bar">
        <div class="usp-item">
            <i class="fa-solid fa-circle-check"></i>
            <div class="usp-text">
                <span class="usp-title">100% Authentic</span>
                <span class="usp-desc">Direct from Task19</span>
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
                <a href="{{ route('collection', ['category' => $fam['slug']]) }}" style="background: {{ $fam['color'] }}; padding: 2rem; border-radius: 1.5rem; text-align: center; border: 1px solid rgba(0,0,0,0.05);">
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
                <a href="{{ route('collection', ['slug' => $collection->slug]) }}" class="view-all">View all <i class="fa-solid fa-chevron-right ms-1"></i></a>
            </div>
            
            <div class="product-grid">
                @foreach($collection->products as $product)
                    @include('nurah.partials.product_card', ['product' => $product])
                @endforeach
            </div>
        </div>
        @endif
    @endforeach

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

