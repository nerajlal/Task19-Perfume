@extends('layouts.velvet')

@section('title', 'Velvet | All Fragrances')

@section('content')
<!-- Page Header -->
<div style="margin-bottom: 4rem;">
    <span class="v-family" style="font-size: 0.8rem; letter-spacing: 0.3em;">The Catalog</span>
    <h1 style="font-size: 3.5rem; color: var(--text-primary); margin-top: 0.5rem;">All Fragrances</h1>
    <p style="color: var(--text-secondary); margin-top: 1rem; max-width: 600px; font-size: 1.1rem;">Explore our complete olfactory universe, from deep ouds to ethereal florals.</p>
</div>

<!-- Product Grid -->
<div class="v-grid">
    @foreach($products as $product)
    <div class="v-card">
        <div class="v-img-box">
            <img src="{{ $product->main_image_url ?? asset('images/g-load.webp') }}" 
                 onerror="this.src='{{ asset('images/g-load.webp') }}'"
                 alt="{{ $product->title }}">
        </div>
        <div class="v-details">
            <span class="v-family">{{ $product->olfactory_family ?? 'Signature' }}</span>
            <h3 class="v-name">{{ $product->title }}</h3>
            <p class="v-price">₹{{ number_format($product->starting_price, 0) }}</p>
            
            <button class="btn-add-v">
                <i class="fa-solid fa-cart-plus mr-2"></i> Add to Bag
            </button>
        </div>
    </div>
    @endforeach
</div>
@endsection
