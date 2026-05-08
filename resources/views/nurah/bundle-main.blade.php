@extends('layouts.storefront')

@section('title', $bundle->title . ' | Exclusive Combo | Task19 Perfumes')

@section('content')
<div class="product-page-container">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <i class="fa-solid fa-chevron-right"></i>
        <a href="{{ route('combos') }}">Combos</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span>{{ $bundle->title }}</span>
    </div>

    <div class="product-core-grid">
        <!-- Gallery -->
        <div class="product-gallery">
            <div class="main-image-display">
                @php 
                    $mainImg = $bundle->image ? Storage::url($bundle->image) : asset('images/g-load.webp');
                @endphp
                <img src="{{ $mainImg }}" id="p-main-img" alt="{{ $bundle->title }}" onerror="this.src='{{ asset('images/g-load.webp') }}'">
            </div>
        </div>

        <!-- Info -->
        <div class="product-details-panel">
            <div style="background: var(--accent-color); color: var(--primary-color); display: inline-block; padding: 0.25rem 1rem; border-radius: 9999px; font-weight: 700; font-size: 0.8rem; margin-bottom: 1rem; text-transform: uppercase; letter-spacing: 0.05em;">
                Exclusive Savings
            </div>
            <h1 class="p-title-lg">{{ $bundle->title }}</h1>
            <p class="p-vendor-lg">Curated Performance Set</p>
            
            <div class="p-price-block-lg">
                <span class="p-price-lg">₹{{ number_format($bundle->total_price, 2) }}</span>
                @php
                    $originalPrice = $bundle->products->sum(function($p) {
                        return $p->variants->min('price') ?? 0;
                    });
                @endphp
                @if($originalPrice > $bundle->total_price)
                    <span class="p-compare-lg">₹{{ number_format($originalPrice, 2) }}</span>
                    <div style="color: #10B981; font-weight: 700; font-size: 1rem;">
                        Save ₹{{ number_format($originalPrice - $bundle->total_price, 0) }}
                    </div>
                @endif
            </div>

            <div class="p-tabs" style="border-top: none; padding-top: 0; margin-bottom: 3rem;">
                <h3 class="p-section-title">Description</h3>
                <p style="color: var(--text-muted); line-height: 1.8;">{{ $bundle->description }}</p>
            </div>

            <div class="bundle-contents" style="margin-bottom: 3rem;">
                <h3 class="p-section-title">Products Included</h3>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @foreach($bundle->products as $product)
                        <div class="bundle-product-item" style="background: var(--section-bg); border-radius: 1rem; border: 1px solid var(--border-color); overflow: hidden;">
                            <div style="display: flex; align-items: center; gap: 1.5rem; padding: 1rem;">
                                <img src="{{ $product->main_image_url }}" alt="{{ $product->title }}" onerror="this.src='{{ asset('images/g-load.webp') }}'" style="width: 60px; height: 60px; border-radius: 0.5rem; object-fit: cover;">
                                <div style="flex-grow: 1;">
                                    <h4 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.25rem;">{{ $product->title }}</h4>
                                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem;">{{ $product->type }} • {{ $product->olfactory_family }}</p>
                                    <div style="font-weight: 700; color: var(--primary-color); font-size: 0.9rem;">₹{{ number_format($product->starting_price, 2) }}</div>
                                </div>
                                <button onclick="toggleProductDetails({{ $product->id }})" style="background: none; border: none; font-size: 0.85rem; font-weight: 600; color: var(--accent-color); cursor: pointer; display: flex; align-items: center; gap: 0.5rem;">
                                    <span id="text-{{ $product->id }}">View Details</span> <i class="fa-solid fa-chevron-down" id="chevron-{{ $product->id }}" style="transition: transform 0.3s ease;"></i>
                                </button>
                            </div>
                            <div id="details-{{ $product->id }}" style="display: none; padding: 0 1rem 1rem 1rem; border-top: 1px solid var(--border-color); background: #fff;">
                                <div style="margin-top: 1rem;">
                                    <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 1rem;">{{ $product->description }}</p>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; font-size: 0.8rem; background: var(--section-bg); padding: 1rem; border-radius: 0.75rem;">
                                        <div><strong style="display: block; color: var(--primary-color); margin-bottom: 0.25rem;">Top Notes</strong> {{ $product->notes_top }}</div>
                                        <div><strong style="display: block; color: var(--primary-color); margin-bottom: 0.25rem;">Heart Notes</strong> {{ $product->notes_heart }}</div>
                                        <div><strong style="display: block; color: var(--primary-color); margin-bottom: 0.25rem;">Base Notes</strong> {{ $product->notes_base }}</div>
                                    </div>
                                    <div style="margin-top: 1.5rem;">
                                        <a href="{{ route('product', ['id' => $product->id]) }}" class="btn-primary" style="padding: 0.6rem 1.5rem; font-size: 0.85rem; border-radius: 9999px; display: inline-flex; align-items: center; gap: 0.5rem; background: var(--primary-color); color: #fff;">
                                            Full Product Page <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="p-actions-lg">
                <div class="p-qty-selector">
                    <button onclick="changePageQty(-1)"><i class="fa-solid fa-minus"></i></button>
                    <span id="page-qty">1</span>
                    <button onclick="changePageQty(1)"><i class="fa-solid fa-plus"></i></button>
                </div>
                <button class="add-to-cart-lg btn-primary" id="add-to-cart-bundle-btn">
                    <span>Add Combo to Cart</span>
                    <span class="btn-divider"></span>
                    <span id="btn-price-display">₹{{ number_format($bundle->total_price, 0) }}</span>
                </button>
            </div>

            <div style="margin-top: 3rem; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 1.5rem; border-radius: 1.5rem; display: flex; align-items: center; gap: 1rem;">
                <i class="fa-solid fa-shield-check" style="color: #16a34a; font-size: 1.5rem;"></i>
                <p style="font-size: 0.95rem; color: #166534; font-weight: 500;">This exclusive combo is backed by Task19's Authenticity Guarantee.</p>
            </div>
        </div>
    </div>

    <!-- Related Combos -->
    @if(isset($relatedBundles) && $relatedBundles->count() > 0)
    <div class="department-section" style="margin-top: 5rem;">
        <div class="section-header">
            <h2 class="section-title">Other Exclusive Combos</h2>
        </div>
        <div class="product-grid">
            @foreach($relatedBundles as $relBundle)
                @include('nurah.partials.bundle_card', ['bundle' => $relBundle])
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

    .p-title-lg { font-size: 3rem; font-weight: 800; color: var(--primary-color); line-height: 1.1; margin-bottom: 0.5rem; }
    .p-vendor-lg { color: var(--text-muted); font-size: 1.1rem; margin-bottom: 2rem; font-weight: 500; }

    .p-price-block-lg { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 3rem; flex-wrap: wrap; }
    .p-price-lg { font-size: 2.25rem; font-weight: 800; color: var(--primary-color); }
    .p-compare-lg { font-size: 1.5rem; text-decoration: line-through; color: var(--text-muted); }

    .p-actions-lg { display: flex; gap: 2rem; margin-bottom: 4rem; }
    .p-qty-selector { display: flex; align-items: center; border: 1px solid var(--border-color); border-radius: 9999px; padding: 0.5rem 1.5rem; gap: 2rem; }
    .p-qty-selector button { border: none; background: none; font-size: 1.5rem; color: var(--text-muted); cursor: pointer; }
    .p-qty-selector span { font-weight: 700; font-size: 1.25rem; min-width: 30px; text-align: center; }

    .add-to-cart-lg { flex-grow: 1; display: flex; align-items: center; justify-content: center; gap: 1rem; padding: 0 2rem; border: none; }
    .btn-divider { width: 1px; height: 24px; background: rgba(0,0,0,0.1); }

    @media (max-width: 1200px) {
        .product-core-grid { grid-template-columns: 1fr; gap: 3rem; }
        .product-details-panel { max-width: 800px; }
    }
</style>
@endsection

@section('scripts')
<script>
    let qty = 1;

    function toggleProductDetails(id) {
        const details = document.getElementById('details-' + id);
        const chevron = document.getElementById('chevron-' + id);
        const text = document.getElementById('text-' + id);
        
        if (details.style.display === 'none') {
            $(details).slideDown(300);
            chevron.style.transform = 'rotate(180deg)';
            text.innerText = 'Hide Details';
        } else {
            $(details).slideUp(300);
            chevron.style.transform = 'rotate(0deg)';
            text.innerText = 'View Details';
        }
    }

    function changePageQty(delta) {
        qty = Math.max(1, qty + delta);
        document.getElementById('page-qty').innerText = qty;
    }

    function addToCart() {
        const btn = document.getElementById('add-to-cart-bundle-btn');
        const originalText = btn.innerHTML;

        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Adding...';
        btn.disabled = true;

        $.ajax({
            url: "{{ route('cart.add') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: "{{ $bundle->id }}",
                quantity: qty,
                type: 'bundle'
            },
            success: function(response) {
                if(response.success) {
                    $('#cart-count').text(response.cartCount);
                    btn.innerHTML = '<i class="fa-solid fa-check"></i> Added!';
                    btn.style.background = '#10B981';
                    
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.style.background = '';
                        btn.disabled = false;
                    }, 2000);
                } else {
                    alert('Error: ' + response.message);
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            },
            error: function() {
                alert('Something went wrong. Please try again.');
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        });
    }

    document.getElementById('add-to-cart-bundle-btn').addEventListener('click', addToCart);
</script>
@endsection
