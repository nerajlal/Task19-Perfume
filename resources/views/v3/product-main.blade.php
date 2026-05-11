@extends('v3.layouts.app')

@section('title', $product->title)

@push('styles')
<style>
    /* VARIABLES */
    :root {
        --color-bg: #FFFFFF;
        --color-text: #000000;
        --color-text-muted: #666666;
        --color-gold: #C5A059; 
        --color-border: #EEEEEE;
        
        --font-display: 'Playfair Display', serif;
        --font-body: 'Inter', sans-serif;
    }

    /* GLOBAL RESET */
    body {
        background-color: var(--color-bg);
        color: var(--color-text);
        font-family: var(--font-body);
        -webkit-font-smoothing: antialiased;
    }

    a { text-decoration: none; color: inherit; transition: opacity 0.2s; }
    a:hover { opacity: 0.7; }
    
    button { font-family: var(--font-body); }

    /* LAYOUT - EDITORIAL STYLE */
    .product-wrapper {
        max-width: 1300px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr; /* Image slightly larger */
        gap: 80px; /* Airy spacing */
        align-items: start;
    }

    /* GALLERY - CLEAN */
    .gallery-container {
        position: sticky;
        top: 40px;
    }

    .main-image-frame {
        width: 100%;
        margin-bottom: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        overflow: hidden;
    }

    .main-image {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    .image-promo-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: #000;
        color: #fff;
        padding: 8px 15px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 4px;
        z-index: 10;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        animation: badgePulse 2s infinite;
    }

    @keyframes badgePulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .thumbnails {
        display: flex;
        gap: 15px;
        overflow-x: auto;
        padding-bottom: 10px;
    }

    .thumb {
        width: 80px;
        height: 100px;
        object-fit: cover;
        cursor: pointer;
        opacity: 0.5;
        transition: opacity 0.3s;
        border-radius: 5px;
    }

    .thumb.active, .thumb:hover {
        opacity: 1;
    }

    /* INFO COLUMN */
    .info-container {
        padding-top: 10px;
        max-width: 550px; /* Restrict width for readability */
    }

    .brand-overline {
        font-family: var(--font-body);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--color-text-muted);
        margin-bottom: 20px;
        display: block;
    }

    .product-title {
        font-family: var(--font-display);
        font-size: 48px;
        font-weight: 400; /* Elegant thin weight */
        line-height: 1.1;
        margin: 0 0 20px 0;
        letter-spacing: -0.5px;
    }

    .price-block {
        display: flex;
        align-items: baseline;
        gap: 15px;
        margin-bottom: 40px;
        font-family: var(--font-body);
    }

    .price-current {
        font-size: 24px;
        font-weight: 300;
        color: var(--color-text);
    }

    .price-original {
        font-size: 16px;
        text-decoration: line-through;
        color: #999;
    }

    .discount-badge {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        color: #C5A059;
        letter-spacing: 1px;
    }

    /* PROMO BANNER */
    .promo-banner {
        background: #fdf8ef; /* Very light gold tint */
        color: #8a6d3b;
        border: 1px dashed #C5A059;
        padding: 10px 15px;
        margin-bottom: 30px;
        font-size: 13px;
        font-weight: 500;
        display: inline-block; /* Or block if full width preferred */
        border-radius: 4px;
    }
    
    .promo-code {
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: #fff;
        padding: 2px 6px;
        border: 1px solid #C5A059;
        border-radius: 3px;
        margin: 0 4px;
        color: #000;
    }

    /* BUNDLE PROMO - SLEEK */
    .bundle-tease {
        background: #f9f9f9;
        border: 1px solid #e5e5e5;
        border-right: 4px solid #2c2b2bff;
        padding: 20px;
        margin-bottom: 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 4px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .bundle-tease:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        background: #fff;
    }

    .bundle-info h4 {
        font-family: var(--font-display);
        font-size: 18px;
        margin: 0 0 5px 0;
        font-weight: 600;
        font-style: italic;
    }

    .bundle-info p {
        font-size: 13px;
        color: var(--color-text-muted);
        margin: 0;
    }

    /* SELECTORS - MINIMAL */
    .selector-group {
        margin-bottom: 30px;
    }

    .group-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        margin-bottom: 15px;
        display: block;
    }

    .size-grid {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .size-btn {
        background: transparent;
        border: 1px solid #ddd;
        padding: 12px 25px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        min-width: 80px;
    }

    .size-btn:hover {
        border-color: #000;
    }

    .size-btn.active {
        background: #000;
        color: #fff;
        border-color: #000;
    }

    /* DESCRIPTION BOX */
    .desc-block {
        margin-bottom: 40px;
        font-size: 15px;
        line-height: 1.8;
        color: #444;
    }

    /* NOTES VISUAL */
    .notes-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 40px;
        text-align: center;
    }

    .note-col { border-right: 1px solid var(--color-border); }
    .note-col:last-child { border-right: none; }

    .note-head {
        font-family: var(--font-display);
        font-size: 16px;
        font-style: italic;
        margin-bottom: 8px;
        color: var(--color-text-muted);
    }

    .note-body {
        font-size: 13px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ACTIONS - SHARP & PREMIUM */
    .actions-bar {
        display: flex;
        gap: 20px;
        margin-top: 40px;
    }

    .qty-counter {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        width: 120px;
        justify-content: space-between;
        padding: 0 10px;
        height: 54px; /* Matches button height */
    }

    .qty-control {
        border: none;
        background: transparent;
        font-size: 18px;
        cursor: pointer;
        color: #666;
    }

    .qty-number { font-weight: 600; }

    .btn-main {
        flex: 1;
        background: #000;
        color: #fff;
        border: none;
        height: 54px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-main:hover { background: #333; }

    .btn-secondary {
        flex: 1;
        background: #fff;
        color: #000;
        border: 1px solid #000;
        height: 54px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-secondary:hover { background: #f0f0f0; }

    /* MOBILE ADJUSTMENTS */
    .mobile-back-nav { display: none; }

    @media (max-width: 900px) {
        .product-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .gallery-container { position: static; }
        
        .product-title { font-size: 32px; }

        .mobile-back-nav {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: #666;
            font-size: 14px;
            font-weight: 500;
        }
        
        .thumb {
            width: 60px;
            height: 75px;
        }
        
        /* Sticky bottoms for mobile actions */
        .actions-bar {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            background: #fff;
            padding: 15px 20px;
            margin: 0;
            border-top: 1px solid #eee;
            z-index: 100;
            gap: 10px;
        }
        
        .btn-main, .btn-secondary, .qty-counter { height: 48px; }
        
        /* Add padding to bottom of page so content isn't hidden by sticky bar */
        .product-wrapper { padding-bottom: 100px; }

        /* Related Grid Mobile */
        .related-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 15px !important;
        }
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    /* BUNDLE SECTIONS */
    .bundle-section {
        margin-top: 60px;
        padding-top: 60px;
        border-top: 1px solid var(--color-border);
    }

    .bundle-section-title {
        font-family: var(--font-display);
        font-size: 28px;
        margin-bottom: 30px;
        text-align: center;
    }

    .bundle-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .bundle-card {
        background: #f9f9f9;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s;
        border: 1px solid transparent;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .bundle-card:hover {
        background: #fff;
        border-color: var(--color-gold);
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transform: translateY(-5px);
    }

    .bundle-card img {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .bundle-name {
        font-family: var(--font-display);
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .bundle-price {
        font-size: 16px;
        font-weight: 700;
        color: var(--color-gold);
        margin-bottom: 15px;
    }

    .bundle-btn {
        width: 100%;
        padding: 12px;
        background: #000;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .bundle-btn:hover {
        background: #333;
    }

    @media (max-width: 768px) {
        .bundle-grid {
            grid-template-columns: 1fr;
        }
    }

    /* QUICK BUILD MODAL */
    .modal {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.8);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        padding: 20px;
    }
    
    .modal.active { display: flex; }
    
    .modal-content {
        background: #fff;
        width: 100%;
        max-width: 800px;
        max-height: 90vh;
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        position: relative;
    }
    
    .modal-header {
        padding: 20px 30px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .modal-body {
        padding: 30px;
        overflow-y: auto;
        flex: 1;
    }
    
    .pool-selection-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 15px;
    }

    @media (max-width: 500px) {
        .pool-selection-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .modal-body { padding: 15px; }
    }
    
    .pool-item {
        border: 1px solid #eee;
        border-radius: 12px;
        padding: 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
    }
    
    .pool-item.selected {
        border-color: var(--color-gold);
        background: #fdf8ef;
    }
    
    .pool-item-img {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 8px;
    }
    
    .pool-item-name {
        font-size: 12px;
        font-weight: 600;
        margin: 0;
    }
    
    .selection-badge {
        position: absolute;
        top: 5px;
        right: 5px;
        background: var(--color-gold);
        color: #fff;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        font-size: 12px;
        display: none;
        align-items: center;
        justify-content: center;
    }
    
    .pool-item.selected .selection-badge { display: flex; }
    
    .modal-footer {
        padding: 20px 30px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f9f9f9;
    }
    
    .btn-build {
        background: #000;
        color: #fff;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        cursor: pointer;
    }
    
    .btn-build:disabled {
        background: #ccc;
        cursor: not-allowed;
    }
</style>
@endpush

@section('content')

<div class="product-wrapper">
    
    <!-- Mobile Back (Optional) -->
    <a href="javascript:history.back()" class="mobile-back-nav">
        <i class="fas fa-arrow-left" style="margin-right:8px;"></i> Back
    </a>

    <div class="product-grid">
        
        <!-- LEFT: GALLERY -->
        <div class="gallery-container">
            <div class="main-image-frame" style="position: relative;">
                @if((isset($packBundles) && $packBundles->count() > 0) || isset($bundle))
                    @php
                        $promoBundle = (isset($packBundles) && $packBundles->count() > 0) ? $packBundles->first() : $bundle;
                        $firstProd = $promoBundle->products->first();
                        $qty = $firstProd ? ($firstProd->pivot->quantity ?? $promoBundle->products->count()) : $promoBundle->products->count();
                    @endphp
                    <div class="image-promo-badge">
                        VALUE: {{ $qty }} PACK @ ₹{{ number_format($promoBundle->total_price, 0) }}
                    </div>
                @endif
                <img src="{{ $product->main_image_url }}" alt="{{ $product->title }}" class="main-image" id="mainImage" onerror="handleImageError(this)">
            </div>
            
            <div class="thumbnails">
                 @foreach($product->images as $index => $image)
                <img src="{{ \Illuminate\Support\Facades\Storage::url($image->path) }}" 
                     class="thumb {{ $index === 0 ? 'active' : '' }}" 
                     onclick="swapMain('{{ \Illuminate\Support\Facades\Storage::url($image->path) }}'); setActiveThumb(this)"
                     alt="View {{ $index }}"
                     onerror="handleImageError(this)">
                @endforeach
            </div>
        </div>

        <!-- RIGHT: STORY & ACTIONS -->
        <div class="info-container">
            
            <h1 class="product-title">{{ $product->title }}</h1>
            
            <div class="price-block">
                @if(isset($product->compare_at_price) && $product->compare_at_price > $product->starting_price)
                    <span class="price-current" id="displayPrice">₹{{ number_format($product->starting_price, 0) }}</span>
                    <span class="price-original">₹{{ number_format($product->compare_at_price, 0) }}</span>
                    <span class="discount-badge">Save {{ round((($product->compare_at_price - $product->starting_price)/$product->compare_at_price)*100) }}%</span>
                @else
                    <span class="price-current" id="displayPrice">₹{{ number_format($product->starting_price, 0) }}</span>
                @endif
            </div>

            @if(isset($coupon))
            @php
                $discountVal = $coupon->type == 'percentage' 
                    ? $product->starting_price * ($coupon->value / 100) 
                    : $coupon->value;
                $newPrice = max(0, $product->starting_price - $discountVal);
            @endphp
            <div class="promo-banner">
                <i class="fas fa-tag" style="font-size: 12px; margin-right: 6px;"></i> <strong>{{ $coupon->code }}</strong> coupon will automatically apply at checkout to get extra {{ $coupon->type == 'percentage' ? number_format($coupon->value) . '%' : '₹' . number_format($coupon->value) }} OFF. 
                <strong id="effectivePriceDisplay">Effective Price: ₹{{ number_format($newPrice) }}</strong>
            </div>
            @endif

            <!-- Notes Strip -->
            <div class="notes-grid">
                <div class="note-col">
                    <div class="note-head">Top</div>
                    <div class="note-body">{{ explode(',', $product->notes_top)[0] ?? $product->notes_top }}</div>
                </div>
                <div class="note-col">
                    <div class="note-head">Heart</div>
                    <div class="note-body">{{ explode(',', $product->notes_heart)[0] ?? $product->notes_heart }}</div>
                </div>
                <div class="note-col">
                    <div class="note-head">Base</div>
                    <div class="note-body">{{ explode(',', $product->notes_base)[0] ?? $product->notes_base }}</div>
                </div>
            </div>

            <!-- Extra Details -->
            <div style="display: flex; gap: 40px; margin-bottom: 25px; font-size: 13px;">
                @if($product->olfactory_family)
                <div>
                    <span style="color: #999; display: block; margin-bottom: 4px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Family</span>
                    <span style="font-weight: 500;">{{ $product->olfactory_family }}</span>
                </div>
                @endif
                @if($product->oil_concentration)
                <div>
                    <span style="color: #999; display: block; margin-bottom: 4px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px;">Concentration</span>
                    <span style="font-weight: 500;">{{ $product->oil_concentration }}</span>
                </div>
                @endif
            </div>

            <!-- Description -->
            <div class="desc-block">
                {{ $product->description }}
            </div>

            <!-- Bundle Link -->
            @if(isset($bundle))
            <a href="{{ route('v3.combo', ['id' => $bundle->id]) }}" class="bundle-tease">
                <div class="bundle-info">
                    <h4>Perfect Combo</h4>
                    <p>Upgrade to the <strong>{{ $bundle->title }}</strong> combo to save {{ $bundle->discount_type == 'percentage' ? number_format($bundle->discount_value) . '%' : '₹' . number_format($bundle->discount_value) }}.</p>
                </div>
                <i class="fas fa-arrow-right" style="color: #666;"></i>
            </a>
            @endif

            <!-- Variants -->
            <div class="selector-group">
                <span class="group-label">Select Size</span>
                <div class="size-grid">
                    @foreach($product->variants as $index => $variant)
                    <button class="size-btn {{ $index === 0 ? 'active' : '' }}" 
                            onclick="selectSize(this, {{ $variant->price }})"
                            data-price="{{ $variant->price }}">
                        {{ $variant->size }}
                    </button>
                    @endforeach
                </div>
            </div>
            
            <!-- Intensity -->
            <div class="selector-group">
                <span class="group-label">Intensity: {{ $product->intensity ?? 'Medium' }}</span>
                <div style="height: 2px; background: #eee; width: 100%; position: relative;">
                    @php
                        $intensity = strtolower($product->intensity ?? 'medium');
                        $width = '60%'; 
                        if(str_contains($intensity, 'strong') || str_contains($intensity, 'high')) $width = '100%';
                        elseif(str_contains($intensity, 'light') || str_contains($intensity, 'low')) $width = '30%';
                    @endphp
                    <div style="position: absolute; left: 0; top: 0; height: 100%; background: #000; width: {{ $width }};"></div>
                </div>
            </div>

            <!-- Actions Bar -->
            <div class="actions-bar" style="position: relative;">
                @if($product->variants->sum('stock') > 0)
                    <div class="qty-counter">
                        <button class="qty-control" onclick="updateQty(-1)">−</button>
                        <span class="qty-number" id="qtyVal">1</span>
                        <button class="qty-control" onclick="updateQty(1)">+</button>
                    </div>
                    <button class="btn-main" onclick="addToCart()">Add to Bag</button>
                    <button class="btn-secondary" onclick="location.href='{{ route('v3.checkout') }}'">But It Now</button>
                @else
                    <div style="filter: blur(4px); pointer-events: none; opacity: 0.5; display: flex; gap: 20px; width: 100%;">
                        <div class="qty-counter">
                            <button class="qty-control">−</button>
                            <span class="qty-number">1</span>
                            <button class="qty-control">+</button>
                        </div>
                        <button class="btn-main">Add to Bag</button>
                        <button class="btn-secondary">But It Now</button>
                    </div>
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #000; color: #fff; padding: 10px 20px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; z-index: 101; white-space: nowrap;">
                        Out of Stock
                    </div>
                @endif
            </div>
            
            <p style="text-align: center; margin-top: 15px; font-size: 11px; color: #999; text-transform: uppercase; letter-spacing: 1px;">Free Shipping over ₹399 • 14-Day Returns</p>

            <!-- Bundle & Save Integration -->
            @if((isset($packBundles) && $packBundles->count() > 0) || (isset($poolBundles) && $poolBundles->count() > 0))
            <div class="bundle-save-container" style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #eee;">
                <h3 style="font-family: var(--font-display); font-size: 20px; margin-bottom: 20px;">Bundle & <em>Save</em></h3>
                
                @if(isset($packBundles) && $packBundles->count() > 0)
                <div style="margin-bottom: 25px;">
                    <h3 style="font-size: 14px; font-weight: 700; color: #000; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 1px;">Special Volume Deals</h3>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        @foreach($packBundles as $pack)
                            @php 
                                $pb_prod = $pack->products->first();
                                $pb_variant = $pb_prod ? $pb_prod->variants->firstWhere('id', $pb_prod->pivot->product_variant_id) : null;
                                $originalTotal = ($pb_variant ? $pb_variant->price : $pb_prod->starting_price) * $pb_prod->pivot->quantity;
                                $savings = $originalTotal - $pack->total_price;
                            @endphp
                            @if($pb_prod)
                            <div style="display: flex; align-items: center; justify-content: space-between; background: #fff; border: 1.5px dashed #e5e5e5; padding: 12px 15px; border-radius: 12px; transition: 0.3s;">
                                <div style="display: flex; flex-direction: column; gap: 2px;">
                                    <span style="font-weight: 700; font-size: 15px; color: #000;">Buy {{ $pb_prod->pivot->quantity }} @if($pb_variant) ({{ $pb_variant->size }}) @endif</span>
                                    <span style="font-size: 12px; font-weight: 700; color: #10B981;">Save ₹{{ number_format($savings, 0) }} instantly</span>
                                </div>
                                <button onclick="addBundleToCart({{ $pack->id }}, '{{ addslashes($pack->title) }}', this, {{ $pb_prod->id }}, {{ $pb_prod->pivot->quantity }}, '{{ $pb_variant ? $pb_variant->size : "" }}')" 
                                        style="background: #000; color: #fff; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer; transition: 0.3s;">
                                    Add ₹{{ number_format($pack->total_price, 0) }}
                                </button>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                @if(isset($poolBundles) && $poolBundles->count() > 0)
                <div>
                    <span class="group-label" style="margin-bottom: 15px;">Collections (Build Your Own)</span>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach($poolBundles as $pool)
                        <div style="display: flex; align-items: center; gap: 15px; background: #fdf8ef; padding: 12px; border-radius: 8px; border: 1px solid #C5A059;">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($pool->image) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;" onerror="handleImageError(this)">
                            <div style="flex: 1;">
                                <h4 style="font-size: 14px; margin: 0 0 4px 0; font-weight: 600;">{{ $pool->title }}</h4>
                                <p style="font-size: 13px; color: var(--color-gold); font-weight: 700; margin: 0;">Starts ₹{{ number_format($pool->total_price, 0) }}</p>
                            </div>
                            <button onclick="openQuickBuild({{ $pool->id }}, '{{ addslashes($pool->title) }}', {{ $pool->min_quantity }}, {{ json_encode($pool->products->map(fn($p) => ['id' => $p->id, 'title' => $p->title, 'image' => $p->main_image_url, 'price' => $p->starting_price])) }})" 
                               style="padding: 8px 12px; background: var(--color-gold); color: #fff; border: none; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase; cursor: pointer;">
                                Quick Build
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @endif

        </div>
    </div>
</div>

<!-- QUICK BUILD MODAL -->
<div class="modal" id="quickBuildModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="qbTitle" style="font-family: var(--font-display); margin: 0;">Build Your Collection</h3>
            <button onclick="closeQuickBuild()" style="background:none; border:none; font-size: 24px; cursor:pointer;">&times;</button>
        </div>
        <div class="modal-body">
            <p id="qbSubtitle" style="font-size: 14px; color: var(--color-text-muted); margin-bottom: 20px;"></p>
            <div class="pool-selection-grid" id="poolGrid">
                <!-- Products injected here -->
            </div>
        </div>
        <div class="modal-footer">
            <span id="qbCount" style="font-weight: 600; font-size: 14px;">Selected: 0/0</span>
            <button id="qbAddBtn" class="btn-build" disabled onclick="addQuickBuildToCart()">Add Collection to Bag</button>
        </div>
    </div>
</div>

<!-- Recently Viewed / Related -->
@if(isset($relatedProducts) && $relatedProducts->count() > 0)
<div class="product-wrapper" style="padding-top: 0;">
    <h3 style="font-family: var(--font-display); font-size: 24px; margin-bottom: 30px; border-top: 1px solid var(--color-border); padding-top: 40px;">Recently Viewed</h3>
    
    <div class="related-grid">
        @foreach($relatedProducts as $related)
        <a href="{{ route('v3.product', ['id' => $related->id]) }}" style="text-decoration: none;">
            <div style="background: #f9f9f9; aspect-ratio: 1; margin-bottom: 15px; border-radius: 10px; overflow: hidden;">
                <img src="{{ $related->main_image_url }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onerror="handleImageError(this)">
            </div>
            <div style="display: flex; justify-content: space-between; align-items: start;">
                <h4 style="font-family: var(--font-display); font-size: 15px; margin: 0; font-weight: 500; line-height: 1.3; color: var(--color-text);">{{ $related->title }}</h4>
                <span style="font-size: 14px; font-weight: 600; color: var(--color-text); white-space: nowrap; margin-left: 10px;">₹{{ number_format($related->starting_price) }}</span>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

<div id="toast" style="position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%); background: #000; color: #fff; padding: 15px 30px; font-size: 13px; font-weight: 500; letter-spacing: 1px; opacity: 0; pointer-events: none; transition: opacity 0.3s; z-index: 1000; text-transform: uppercase;">
    Added to Bag
</div>

@endsection

@push('scripts')
<script>
    let currentPrice = {{ $product->starting_price }};
    let quantity = 1;
    
    // Coupon Data
    let couponType = '{{ isset($coupon) ? $coupon->type : "" }}';
    let couponValue = {{ isset($coupon) ? $coupon->value : 0 }};

    function handleImageError(img) {
        img.onerror = null; // Prevent infinite loop
        img.src = '{{ asset("images/g-load.webp") }}';
    }

    function selectSize(btn, price) {
        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        currentPrice = price;
        document.getElementById('displayPrice').innerText = '₹' + new Intl.NumberFormat().format(price);
        
        // Update Effective Price if coupon exists
        if(couponType) {
            let discount = 0;
            if(couponType === 'percentage') {
                discount = price * (couponValue / 100);
            } else {
                discount = couponValue;
            }
            let newPrice = Math.max(0, price - discount);
            let displayEl = document.getElementById('effectivePriceDisplay');
            if(displayEl) {
                displayEl.innerText = 'Effective Price: ₹' + new Intl.NumberFormat().format(newPrice);
            }
        }
    }

    function updateQty(change) {
        if (quantity + change >= 1) {
            quantity += change;
            document.getElementById('qtyVal').innerText = quantity;
        }
    }

    function addToCart() {
        const btn = document.querySelector('.btn-main'); // Disable btn to prevent double click
        btn.disabled = true;
        btn.style.opacity = '0.7';

        const sizeBtn = document.querySelector('.size-btn.active');
        const size = sizeBtn ? sizeBtn.innerText.trim() : null;

        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: {{ $product->id }},
                quantity: quantity,
                size: size
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                const toast = document.getElementById('toast');
                toast.style.opacity = '1';
                setTimeout(() => toast.style.opacity = '0', 2500);
                
                if(navigator.vibrate) navigator.vibrate(50);
                
                const cartBadge = document.querySelector('.cart-count'); 
                if(cartBadge) {
                    cartBadge.innerText = data.cartCount;
                    cartBadge.style.display = 'flex'; // Ensure visible
                }
            } else {
                alert(data.message || 'Error adding to cart');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Something went wrong. Please try again.');
        })
        .finally(() => {
            btn.disabled = false;
            btn.style.opacity = '1';
        });
    }
    
    function swapMain(src) {
        document.getElementById('mainImage').src = src;
    }

    function setActiveThumb(el) {
        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
    }

    function addBundleToCart(id, title, btn, productId, qty, size) {
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '...';

        const multiProducts = [{
            id: productId,
            quantity: qty,
            size: size
        }];

        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                multi_products: multiProducts
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                const toast = document.getElementById('toast');
                toast.innerText = 'Bundle items added to Bag! 🎉';
                toast.style.opacity = '1';
                setTimeout(() => toast.style.opacity = '0', 2500);
                
                if(navigator.vibrate) navigator.vibrate(50);
                
                const cartBadge = document.querySelector('.cart-count'); 
                if(cartBadge) {
                    cartBadge.innerText = data.cartCount;
                    cartBadge.style.display = 'flex';
                }
            } else {
                alert(data.message || 'Error adding to cart');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = originalText;
        });
    }

    // QUICK BUILD LOGIC
    let selectedPoolProducts = [];
    let currentPoolId = null;
    let currentPoolTitle = "";
    let minRequired = 0;

    function openQuickBuild(id, title, min, products) {
        currentPoolId = id;
        currentPoolTitle = title;
        minRequired = min;
        selectedPoolProducts = [];
        
        document.getElementById('qbTitle').innerText = title;
        document.getElementById('qbSubtitle').innerText = "Select " + min + " perfumes to build your collection.";
        document.getElementById('qbCount').innerText = "Selected: 0/" + min;
        
        const grid = document.getElementById('poolGrid');
        grid.innerHTML = "";
        
        products.forEach(p => {
            const item = document.createElement('div');
            item.className = 'pool-item';
            item.onclick = () => togglePoolProduct(p.id, item);
            item.innerHTML = `
                <img src="${p.image}" class="pool-item-img" onerror="handleImageError(this)">
                <p class="pool-item-name">${p.title}</p>
                <p style="font-size: 11px; font-weight: 700; color: var(--color-gold); margin: 3px 0 0 0;">₹${new Intl.NumberFormat().format(p.price)}</p>
                <div class="selection-badge">✓</div>
            `;
            grid.appendChild(item);
        });
        
        document.getElementById('quickBuildModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeQuickBuild() {
        document.getElementById('quickBuildModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    function togglePoolProduct(id, el) {
        const index = selectedPoolProducts.indexOf(id);
        if (index > -1) {
            selectedPoolProducts.splice(index, 1);
            el.classList.remove('selected');
        } else {
            if (selectedPoolProducts.length < minRequired) {
                selectedPoolProducts.push(id);
                el.classList.add('selected');
            } else {
                // Replace last one or just ignore
                const lastId = selectedPoolProducts.pop();
                // Find element for lastId and deselect it (a bit expensive but works)
                // For simplicity, let's just ignore if already full
                // Actually, let's just allow replacing the first one
                // selectedPoolProducts.shift();
                // selectedPoolProducts.push(id);
            }
        }
        
        const countEl = document.getElementById('qbCount');
        countEl.innerText = "Selected: " + selectedPoolProducts.length + "/" + minRequired;
        
        const addBtn = document.getElementById('qbAddBtn');
        addBtn.disabled = (selectedPoolProducts.length < minRequired);
    }

    function addQuickBuildToCart() {
        const btn = document.getElementById('qbAddBtn');
        btn.disabled = true;
        btn.innerHTML = "Processing...";

        const multiProducts = selectedPoolProducts.map(pid => {
            return { id: pid, quantity: 1 };
        });

        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                multi_products: multiProducts
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                closeQuickBuild();
                const toast = document.getElementById('toast');
                toast.innerText = 'Items added to Bag! 🎉';
                toast.style.opacity = '1';
                setTimeout(() => toast.style.opacity = '0', 2500);
                
                const cartBadge = document.querySelector('.cart-count'); 
                if(cartBadge) {
                    cartBadge.innerText = data.cartCount;
                    cartBadge.style.display = 'flex';
                }
            } else {
                alert(data.message || 'Error adding to cart');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = "Add Collection to Bag";
        });
    }
</script>
@endpush