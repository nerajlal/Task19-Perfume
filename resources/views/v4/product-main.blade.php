@extends('v4.layouts.app')

@section('title', $product->title . ' | Ajmal Luxury Fragrance')

@section('content')
    <div class="container" style="margin-top: 50px;">
        <div class="a-product-detail-layout">
            <!-- Left: Images -->
            <div class="a-product-media">
                <div class="a-main-image-container">
                    <img src="{{ $product->main_image_url ?? asset('images/g-load.webp') }}" 
                         onerror="this.src='{{ asset('images/g-load.webp') }}'"
                         alt="{{ $product->title }}" 
                         class="a-main-image" id="mainImage">
                    
                    @if($product->compare_at_price > $product->starting_price)
                        <span class="a-detail-discount">SAVE {{ round((($product->compare_at_price - $product->starting_price) / $product->compare_at_price) * 100) }}%</span>
                    @endif
                </div>
                <div class="a-thumbnail-grid">
                    <img src="{{ $product->main_image_url ?? asset('images/g-load.webp') }}" class="a-thumb active" onclick="setMainImage(this.src, this)">
                    @foreach($product->images as $img)
                        <img src="{{ asset('storage/' . $img->image_path) }}" class="a-thumb" onclick="setMainImage(this.src, this)">
                    @endforeach
                </div>
            </div>

            <!-- Right: Details -->
            <div class="a-product-details">
                <div class="a-detail-header">
                    <div class="a-detail-cat">{{ $product->olfactory_family ?? 'Fragrance' }}</div>
                    <h1 class="serif">{{ $product->title }}</h1>
                    <div class="a-detail-price">
                        @if($product->compare_at_price > $product->starting_price)
                            <span class="a-price-old">₹{{ number_format($product->compare_at_price, 0) }}</span>
                        @endif
                        <span class="a-price-new">₹{{ number_format($product->starting_price, 0) }}</span>
                    </div>
                </div>

                <div class="a-detail-description">
                    <p>{{ $product->description ?? 'Experience the essence of luxury with this exquisite fragrance. Designed for long-lasting appeal and perfect for any occasion.' }}</p>
                </div>

                <div class="a-detail-variants">
                    <h3>Select Size</h3>
                    <div class="a-variant-options">
                        @foreach($product->variants as $variant)
                            <button class="a-variant-btn {{ $loop->first ? 'active' : '' }}" 
                                    onclick="selectVariant(this, {{ $variant->price }}, '{{ $variant->size }}')">
                                {{ $variant->size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="a-detail-actions">
                    <div class="a-qty-selector">
                        <button onclick="updateQty(-1)">-</button>
                        <input type="number" value="1" id="productQty" readonly>
                        <button onclick="updateQty(1)">+</button>
                    </div>
                    <button class="a-add-to-cart" id="addToCartBtn" onclick="handleAddToCart()">
                        <i class="fa-solid fa-bag-shopping"></i> Add to Bag
                    </button>
                </div>

                <div class="a-detail-features">
                    <div class="a-feature-item">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span>Free Express Delivery</span>
                    </div>
                    <div class="a-feature-item">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>Easy 7-Day Returns</span>
                    </div>
                    <div class="a-feature-item">
                        <i class="fa-solid fa-shield-check"></i>
                        <span>100% Authentic Product</span>
                    </div>
                </div>

                <div class="social-proof-tag" style="position: relative; left: 0; transform: none; margin-top: 30px; display: inline-flex;">
                    <i class="fa-solid fa-eye"></i>
                    <span>{{ rand(100, 500) }} people are viewing this right now</span>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="a-related-section">
            <h2 class="serif">You May Also Like</h2>
            <div class="a-product-grid">
                @foreach($relatedProducts as $related)
                    @include('v4.partials.product_card', ['product' => $related])
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <style>
        .a-product-detail-layout {
            display: grid;
            grid-template-columns: 1fr 450px;
            gap: 80px;
        }

        .a-product-media {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .a-main-image-container {
            position: relative;
            aspect-ratio: 1;
            background: var(--bg-soft);
            border-radius: 12px;
            overflow: hidden;
        }

        .a-main-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .a-detail-discount {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--accent);
            color: #fff;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: 800;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .a-thumbnail-grid {
            display: flex;
            gap: 15px;
        }

        .a-thumb {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: 0.3s;
            background: var(--bg-soft);
        }

        .a-thumb.active { border-color: var(--accent); }

        .a-detail-header { margin-bottom: 30px; }
        .a-detail-cat {
            font-size: 13px;
            text-transform: uppercase;
            color: var(--accent);
            letter-spacing: 2px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .a-detail-header h1 { font-size: 48px; margin-bottom: 15px; line-height: 1.1; }
        
        .a-detail-price { display: flex; align-items: baseline; gap: 15px; }
        .a-price-new { font-size: 32px; font-weight: 800; color: var(--primary); }
        .a-price-old { font-size: 20px; text-decoration: line-through; color: var(--text-muted); }

        .a-detail-description {
            font-size: 16px;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 40px;
        }

        .a-detail-variants { margin-bottom: 40px; }
        .a-detail-variants h3 { font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; }

        .a-variant-options { display: flex; gap: 12px; }
        .a-variant-btn {
            padding: 12px 25px;
            border: 1.5px solid var(--border);
            background: #fff;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .a-variant-btn.active { border-color: var(--primary); background: var(--primary); color: #fff; }

        .a-detail-actions {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
        }

        .a-qty-selector {
            display: flex;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
            width: 120px;
        }

        .a-qty-selector button {
            width: 40px;
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }
        .a-qty-selector button:hover { background: var(--bg-soft); }

        .a-qty-selector input {
            width: 40px;
            border: none;
            text-align: center;
            font-weight: 700;
            outline: none;
        }

        .a-add-to-cart {
            flex-grow: 1;
            background: var(--gold-gradient);
            color: #fff;
            border: none;
            padding: 18px;
            border-radius: 8px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .a-add-to-cart:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(197, 160, 89, 0.3); }

        .a-detail-features {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            padding-top: 30px;
            border-top: 1px solid var(--border);
        }

        .a-feature-item {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-main);
        }
        .a-feature-item i { color: var(--accent); font-size: 18px; }

        .a-related-section { margin-top: 100px; }
        .a-related-section h2 { font-size: 32px; margin-bottom: 40px; text-align: center; }

        @media (max-width: 1024px) {
            .a-product-detail-layout { grid-template-columns: 1fr; gap: 40px; }
            .a-product-details { max-width: 600px; margin: 0 auto; }
        }
    </style>

    <script>
        function setMainImage(src, thumb) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.a-thumb').forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
        }

        function updateQty(delta) {
            const input = document.getElementById('productQty');
            let val = parseInt(input.value) + delta;
            if(val < 1) val = 1;
            input.value = val;
        }

        function selectVariant(btn, price, size) {
            document.querySelectorAll('.a-variant-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.querySelector('.a-price-new').innerText = '₹' + price.toLocaleString();
        }

        function handleAddToCart() {
            const btn = document.getElementById('addToCartBtn');
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> PROCESSING...';
            btn.disabled = true;

            setTimeout(() => {
                btn.innerHTML = '<i class="fa-solid fa-check"></i> ADDED TO BAG';
                btn.style.background = '#10B981';
                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                    btn.style.background = '';
                    btn.disabled = false;
                }, 2000);
            }, 1000);
        }
    </script>
@endsection
