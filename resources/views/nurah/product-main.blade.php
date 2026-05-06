@extends('layouts.storefront')

@section('title', $product->title . ' | Task19 Perfumes')

@section('content')
<div class="product-page-container">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="fa-solid fa-chevron-right"></i>
        <a href="{{ route('all-products') }}">Shop</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span>{{ $product->title }}</span>
    </div>

    <div class="product-core-grid">
        <!-- Gallery -->
        <div class="product-gallery">
            <div class="main-image-display">
                @php 
                    $mainImg = $product->main_image_url ?? asset('images/products/p' . $product->id . '.png');
                @endphp
                <img src="{{ $mainImg }}" id="p-main-img" alt="{{ $product->title }}" onerror="this.src='{{ asset('images/g-load.webp') }}'">
            </div>
            <div class="thumb-strip">
                @foreach($product->images as $img)
                    @php 
                        $thumbPath = $img->path;
                        if (Str::startsWith($thumbPath, 'http')) {
                            // External
                        } elseif (Str::startsWith($thumbPath, 'images/')) {
                            $thumbPath = asset($thumbPath);
                        } else {
                            $thumbPath = \Illuminate\Support\Facades\Storage::url($thumbPath);
                        }
                    @endphp
                    <img src="{{ $thumbPath }}" class="t-item {{ $loop->first ? 'active' : '' }}" onclick="updateImg(this.src, this)" alt="Gallery">
                @endforeach
            </div>
        </div>

        <!-- Info -->
        <div class="product-details-panel">
            <h1 class="p-title-lg">{{ $product->title }}</h1>
            <p class="p-vendor-lg">By Task19 Fragrance House</p>
            
            <div class="p-price-block-lg">
                <span class="p-price-lg" id="p-price-display">₹{{ number_format($product->starting_price, 2) }}</span>
                @if($product->compare_at_price > $product->starting_price)
                    <span class="p-compare-lg">₹{{ number_format($product->compare_at_price, 2) }}</span>
                @endif
            </div>

            <div class="p-spec-grid">
                <div class="p-spec-item">
                    <span class="s-label">Family</span>
                    <span class="s-value">{{ $product->olfactory_family }}</span>
                </div>
                <div class="p-spec-item">
                    <span class="s-label">Intensity</span>
                    <span class="s-value">{{ $product->intensity }}</span>
                </div>
                <div class="p-spec-item">
                    <span class="s-label">Type</span>
                    <span class="s-value">{{ $product->type }}</span>
                </div>
            </div>

            <div class="p-selection-section">
                <h3 class="selection-title">Select Volume</h3>
                <div class="size-options-grid">
                    @foreach($product->variants as $index => $variant)
                        <button class="size-btn-lg {{ $index == 0 ? 'active' : '' }}" 
                                data-price="{{ $variant->price }}" 
                                data-size="{{ $variant->size }}"
                                onclick="selectVariant(this)">
                            {{ $variant->size }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="p-action-bar-lg">
                <div class="p-qty-selector">
                    <button onclick="changePageQty(-1)">-</button>
                    <span id="page-qty">1</span>
                    <button onclick="changePageQty(1)">+</button>
                </div>
                <button class="btn-add-primary" id="add-to-cart-page-btn">
                    Add to Cart
                </button>
            </div>

            <div class="p-tabs">
                <div class="tab-headers">
                    <button class="tab-btn active" onclick="switchTab('desc')">Description</button>
                    <button class="tab-btn" onclick="switchTab('notes')">Olfactory Notes</button>
                    <button class="tab-btn" onclick="switchTab('shipping')">Shipping</button>
                </div>
                <div class="tab-content" id="tab-desc">
                    <p>{{ $product->description }}</p>
                </div>
                <div class="tab-content d-none" id="tab-notes">
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;"><strong>Top Notes:</strong> {{ $product->notes_top }}</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Heart Notes:</strong> {{ $product->notes_heart }}</li>
                        <li style="margin-bottom: 0.5rem;"><strong>Base Notes:</strong> {{ $product->notes_base }}</li>
                    </ul>
                </div>
                <div class="tab-content d-none" id="tab-shipping">
                    <p>Free express shipping on all orders over ₹999. Delivered within 3-5 business days across India.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @php $related = \App\Models\Product::where('collection_id', $product->collection_id)->where('id', '!=', $product->id)->take(4)->get(); @endphp
    @if($related->count() > 0)
    <div class="department-section" style="margin-top: 5rem;">
        <div class="section-header">
            <h2 class="section-title">You Might Also Like</h2>
        </div>
        <div class="product-grid">
            @foreach($related as $rel)
                @include('nurah.partials.product_card', ['product' => $rel])
            @endforeach
        </div>
    </div>
    @endif
</div>

<style>
    .product-page-container { padding: 1rem 0; }
    .breadcrumb { display: flex; align-items: center; gap: 0.75rem; font-size: 0.9rem; color: var(--text-muted); margin-bottom: 3rem; }
    .breadcrumb a:hover { color: var(--accent-color); }
    .breadcrumb i { font-size: 0.7rem; opacity: 0.5; }

    .product-core-grid { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 5rem; }

    .main-image-display { background: var(--section-bg); border-radius: 2rem; overflow: hidden; aspect-ratio: 1; margin-bottom: 1.5rem; border: 1px solid var(--border-color); }
    .main-image-display img { width: 100%; height: 100%; object-fit: cover; }
    .thumb-strip { display: flex; gap: 1rem; overflow-x: auto; padding-bottom: 0.5rem; }
    .t-item { width: 90px; height: 90px; border-radius: 1rem; border: 2px solid transparent; cursor: pointer; transition: var(--transition); object-fit: cover; }
    .t-item.active { border-color: var(--accent-color); }

    .p-title-lg { font-size: 3rem; font-weight: 800; color: var(--primary-color); line-height: 1.1; margin-bottom: 0.5rem; }
    .p-vendor-lg { color: var(--text-muted); font-size: 1.1rem; margin-bottom: 2rem; font-weight: 500; }

    .p-price-block-lg { display: flex; align-items: baseline; gap: 1.5rem; margin-bottom: 3rem; }
    .p-price-lg { font-size: 2.25rem; font-weight: 800; color: var(--primary-color); }
    .p-compare-lg { font-size: 1.5rem; text-decoration: line-through; color: var(--text-muted); }

    .p-spec-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 3rem; background: var(--section-bg); padding: 1.5rem; border-radius: 1.5rem; }
    .s-label { display: block; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-bottom: 0.25rem; font-weight: 700; }
    .s-value { font-weight: 600; font-size: 1rem; color: var(--primary-color); }

    .p-selection-section { margin-bottom: 3rem; }
    .selection-title { font-size: 1.1rem; font-weight: 700; margin-bottom: 1.25rem; }
    .size-options-grid { display: flex; gap: 1rem; flex-wrap: wrap; }
    .size-btn-lg { padding: 1rem 2rem; border: 1px solid var(--border-color); border-radius: 1rem; background: #fff; cursor: pointer; font-weight: 600; transition: var(--transition); font-size: 1rem; }
    .size-btn-lg.active { background: var(--primary-color); color: #fff; border-color: var(--primary-color); }

    .p-action-bar-lg { display: flex; gap: 2rem; margin-bottom: 4rem; }
    .p-qty-selector { display: flex; align-items: center; border: 1px solid var(--border-color); border-radius: 9999px; padding: 0.5rem 1.5rem; gap: 2rem; }
    .p-qty-selector button { border: none; background: none; font-size: 1.5rem; color: var(--text-muted); cursor: pointer; }
    .p-qty-selector span { font-weight: 700; font-size: 1.25rem; min-width: 30px; text-align: center; }

    .btn-add-primary { flex-grow: 1; background: var(--accent-color); color: var(--primary-color); border: none; border-radius: 9999px; font-weight: 700; font-size: 1.25rem; cursor: pointer; transition: var(--transition); }
    .btn-add-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 30px rgba(212, 175, 55, 0.3); }

    .p-tabs { border-top: 1px solid var(--border-color); padding-top: 2.5rem; }
    .tab-headers { display: flex; gap: 2.5rem; margin-bottom: 2rem; }
    .tab-btn { background: none; border: none; font-size: 1.1rem; font-weight: 600; color: var(--text-muted); cursor: pointer; padding-bottom: 0.5rem; border-bottom: 2px solid transparent; transition: var(--transition); }
    .tab-btn.active { color: var(--primary-color); border-color: var(--accent-color); }
    .tab-content { line-height: 1.8; color: var(--text-muted); font-size: 1.05rem; }
    .d-none { display: none; }

    @media (max-width: 1200px) {
        .product-core-grid { grid-template-columns: 1fr; gap: 3rem; }
        .product-details-panel { max-width: 800px; }
    }
</style>

<script>
    let qty = 1;

    function updateImg(src, el) {
        document.getElementById('p-main-img').src = src;
        document.querySelectorAll('.t-item').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
    }

    function selectVariant(el) {
        document.querySelectorAll('.size-btn-lg').forEach(b => b.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('p-price-display').innerText = '₹' + new Intl.NumberFormat().format(el.dataset.price);
    }

    function changePageQty(delta) {
        qty = Math.max(1, qty + delta);
        document.getElementById('page-qty').innerText = qty;
    }

    function switchTab(tab) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.add('d-none'));
        
        const targetBtn = Array.from(document.querySelectorAll('.tab-btn')).find(b => b.innerText.toLowerCase().includes(tab));
        if(targetBtn) targetBtn.classList.add('active');
        document.getElementById('tab-' + tab).classList.remove('d-none');
    }

    document.getElementById('add-to-cart-page-btn').addEventListener('click', function() {
        const size = document.querySelector('.size-btn-lg.active').dataset.size;
        $.ajax({
            url: "{{ route('cart.add') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: "{{ $product->id }}",
                quantity: qty,
                size: size
            },
            success: function(response) {
                $('#cart-count').text(response.cartCount);
                alert('Added to cart!');
            }
        });
    });
</script>
@endsection
