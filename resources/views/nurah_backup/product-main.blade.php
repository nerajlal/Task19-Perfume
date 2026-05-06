@extends('nurah.layouts.app')

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
            <div class="main-image-frame">
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
            <a href="{{ route('combo', ['id' => $bundle->id]) }}" class="bundle-tease">
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
                    <button class="btn-secondary" onclick="location.href='/checkout'">But It Now</button>
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

        </div>
    </div>
</div>

<!-- Recently Viewed / Related -->
@if(isset($relatedProducts) && $relatedProducts->count() > 0)
<div class="product-wrapper" style="padding-top: 0;">
    <h3 style="font-family: var(--font-display); font-size: 24px; margin-bottom: 30px; border-top: 1px solid var(--color-border); padding-top: 40px;">Recently Viewed</h3>
    
    <div class="related-grid">
        @foreach($relatedProducts as $related)
        <a href="{{ route('product', ['id' => $related->id]) }}" style="text-decoration: none;">
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
</script>
@endpush