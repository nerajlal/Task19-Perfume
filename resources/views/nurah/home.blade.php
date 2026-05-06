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

    <!-- Featured Categories Grid (Quick Access) -->
    <div class="department-section">
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
    </div>

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

    <!-- Newsletter / Trust Section -->
    <div class="hero-banner" style="background: var(--section-bg); padding: 3rem; margin-top: 4rem; border: 1px solid var(--border-color);">
        <div style="max-width: 100%; text-align: center;">
            <h2 style="font-size: 2rem; color: var(--primary-color); margin-bottom: 1rem;">Experience Excellence</h2>
            <p style="color: var(--text-muted); margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">Join our exclusive circle and be the first to know about new artisanal launches and limited edition scents.</p>
            <div style="display: flex; gap: 1rem; justify-content: center; max-width: 500px; margin: 0 auto;">
                <input type="email" placeholder="Enter your email" style="flex-grow: 1; padding: 1rem 1.5rem; border-radius: 9999px; border: 1px solid var(--border-color);">
                <button class="btn-primary" style="padding: 1rem 2rem;">Subscribe</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.cart-add-btn').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            const btn = $(this);
            
            $.ajax({
                url: "{{ route('cart.add') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: productId,
                    quantity: 1
                },
                success: function(response) {
                    $('#cart-count').text(response.cartCount);
                    btn.html('<i class="fa-solid fa-check"></i>').addClass('success');
                    setTimeout(() => {
                        btn.html('<i class="fa-solid fa-plus"></i>').removeClass('success');
                    }, 2000);
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Error adding to cart. Please try again.');
                }
            });
        });
    });
</script>
@endsection
