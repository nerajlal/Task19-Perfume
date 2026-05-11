@extends('v4.layouts.app')

@section('title', $product->title . ' | Task19 Luxury Fragrance')

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
                    @if($product->main_image_url)
                        <img src="{{ $product->main_image_url }}" class="a-thumb active" onclick="setMainImage(this.src, this)" onerror="this.src='{{ asset('images/g-load.webp') }}'">
                    @endif
                    @foreach($product->images as $img)
                        @php $imgUrl = (strpos($img->path, 'http') === 0) ? $img->path : Storage::url($img->path); @endphp
                        <img src="{{ $imgUrl }}" class="a-thumb" onclick="setMainImage(this.src, this)" onerror="this.src='{{ asset('images/g-load.webp') }}'">
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

                <div class="a-scent-profile">
                    <h3>Fragrance Pyramid</h3>
                    <div class="a-notes-grid">
                        <div class="a-note-item">
                            <div class="a-note-icon">TOP</div>
                            <div class="a-note-text">
                                <strong>Top Notes</strong>
                                <p>Bergamot, Lemon, Pink Pepper</p>
                            </div>
                        </div>
                        <div class="a-note-item">
                            <div class="a-note-icon">HEART</div>
                            <div class="a-note-text">
                                <strong>Heart Notes</strong>
                                <p>Rose, Jasmine, Patchouli</p>
                            </div>
                        </div>
                        <div class="a-note-item">
                            <div class="a-note-icon">BASE</div>
                            <div class="a-note-text">
                                <strong>Base Notes</strong>
                                <p>Oud, Amber, Musk, Vanilla</p>
                            </div>
                        </div>
                    </div>
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

                <div class="a-product-tabs" style="margin-top: 40px;">
                    <div class="a-tab-item active" onclick="toggleTab(this, 'desc')">Description</div>
                    <div class="a-tab-item" onclick="toggleTab(this, 'usage')">How to Use</div>
                    <div class="a-tab-item" onclick="toggleTab(this, 'ingredients')">Ingredients</div>
                </div>
                <div class="a-tab-content active" id="desc">
                    <p>{{ $product->description ?? 'Experience the essence of luxury with this exquisite fragrance. Designed for long-lasting appeal and perfect for any occasion.' }}</p>
                </div>
                <div class="a-tab-content" id="usage">
                    <p>Spray on pulse points: neck, chest, and wrists for a long-lasting fragrance experience. Avoid rubbing the skin after application as it breaks down the scent molecules.</p>
                </div>
                <div class="a-tab-content" id="ingredients">
                    <p>Alcohol Denat, Aqua (Water), Fragrance, Linalool, Limonene, Citronellol, Geraniol, Coumarin, Citral.</p>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="a-related-section">
            <h2 class="aj-title cursive text-center">YOU MAY ALSO <span class="sketch-under">LIKE</span></h2>
            <div class="a-product-grid">
                @foreach($relatedProducts->take(4) as $related)
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
            background: #000;
            color: #fff;
            border: none;
            padding: 18px;
            border-radius: 4px;
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

        .a-add-to-cart:hover { background: var(--aj-gold); }

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
        .a-feature-item i { color: var(--aj-gold); font-size: 18px; }

        /* Scent Profile */
        .a-scent-profile {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid var(--aj-border);
        }
        .a-scent-profile h3 { font-size: 14px; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 20px; font-weight: 800; }
        
        .a-notes-grid { display: flex; flex-direction: column; gap: 20px; }
        .a-note-item { display: flex; align-items: center; gap: 20px; }
        .a-note-icon {
            width: 60px;
            height: 60px;
            border: 1px solid var(--aj-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 900;
            color: var(--aj-gold);
            flex-shrink: 0;
        }
        .a-note-text strong { display: block; font-size: 14px; color: var(--aj-dark); margin-bottom: 4px; }
        .a-note-text p { font-size: 13px; color: var(--aj-gray); margin: 0; }

        .a-related-section { 
            margin-top: 100px; 
            padding-top: 80px;
            border-top: 1px solid #f0f0f0;
        }
        .a-related-section .aj-title { margin-bottom: 50px; }
        
        .a-product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        @media (max-width: 991px) {
            .a-product-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
        }

        @media (max-width: 1024px) {
            .a-product-detail-layout { grid-template-columns: 1fr; gap: 40px; }
            .a-product-details { max-width: 100%; }
            .a-detail-header h1 { font-size: 36px; }
            .a-main-image-container { border-radius: 0; margin: 0 -20px; }
            .a-sticky-mobile-bar { display: flex; }
            .container { padding-bottom: 100px; }
        }

        /* Tabs */
        .a-product-tabs { display: flex; gap: 30px; border-bottom: 1px solid var(--aj-border); margin-bottom: 20px; }
        .a-tab-item { font-size: 13px; font-weight: 700; text-transform: uppercase; padding-bottom: 15px; cursor: pointer; color: var(--aj-gray); transition: 0.3s; position: relative; }
        .a-tab-item.active { color: var(--aj-dark); }
        .a-tab-item.active::after { content: ''; position: absolute; bottom: -1px; left: 0; width: 100%; height: 2px; background: var(--aj-gold); }
        .a-tab-content { display: none; font-size: 14px; line-height: 1.8; color: var(--aj-gray); }
        .a-tab-content.active { display: block; }

        /* Sticky Mobile Bar */
        .a-sticky-mobile-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fff;
            padding: 15px 20px;
            box-shadow: 0 -10px 30px rgba(0,0,0,0.1);
            display: none;
            justify-content: space-between;
            align-items: center;
            z-index: 2000;
        }
        .a-sticky-info h4 { font-size: 14px; font-weight: 700; margin-bottom: 2px; }
        .a-sticky-info p { font-size: 16px; font-weight: 800; color: var(--aj-gold); margin: 0; }
        .a-sticky-btn { background: #000; color: #fff; border: none; padding: 12px 25px; border-radius: 4px; font-weight: 700; text-transform: uppercase; font-size: 12px; }
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
            const priceText = '₹' + price.toLocaleString();
            document.querySelector('.a-price-new').innerText = priceText;
            document.querySelector('.a-sticky-info p').innerText = priceText;
        }

        function toggleTab(btn, tabId) {
            document.querySelectorAll('.a-tab-item').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.a-tab-content').forEach(c => c.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }

        function handleAddToCart() {
            const btns = [document.getElementById('addToCartBtn'), document.querySelector('.a-sticky-btn')];
            btns.forEach(btn => {
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
                btn.disabled = true;
                setTimeout(() => {
                    btn.innerHTML = '<i class="fa-solid fa-check"></i>';
                    btn.style.background = '#10B981';
                    setTimeout(() => {
                        btn.innerHTML = originalHtml;
                        btn.style.background = '';
                        btn.disabled = false;
                    }, 2000);
                }, 1000);
            });
        }
    </script>

    <!-- Sticky Mobile Bar -->
    <div class="a-sticky-mobile-bar">
        <div class="a-sticky-info">
            <h4>{{ $product->title }}</h4>
            <p>₹{{ number_format($product->starting_price, 0) }}</p>
        </div>
        <button class="a-sticky-btn" onclick="handleAddToCart()">Add to Bag</button>
    </div>
@endsection
