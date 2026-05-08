@extends('layouts.velvet')

@section('title', 'Velvet | Luxury Fragrance Collection')

@section('content')
<!-- Hero Section -->
<div class="hero-mini-v">
    <div class="hero-mini-text">
        <span class="hero-tagline-v" style="color: var(--accent-color);">Premium Experience</span>
        <h1>Artisanal <br> Masterpieces</h1>
        <p>Discover our meticulously crafted scents, designed to leave an unforgettable impression.</p>
        <a href="#" class="btn-v">View Collection</a>
    </div>
</div>

<!-- Collections Section -->
<div style="margin-top: 8rem; margin-bottom: 4rem;">
    <h2 style="font-size: 2.5rem; color: var(--text-primary);">Signature Collections</h2>
    <p style="color: var(--text-secondary); margin-top: 0.5rem;">Explore our curated worlds of scent.</p>
</div>

<div class="v-collection-grid">
    @foreach($collections as $col)
    <a href="{{ route('velvet.collection', ['slug' => $col->slug]) }}" class="v-col-card">
        <div class="v-col-img">
            <img src="{{ $col->image ? asset('storage/' . $col->image) : asset('images/g-load.webp') }}" 
                 onerror="this.src='{{ asset('images/g-load.webp') }}'"
                 alt="{{ $col->name }}">
            <div class="v-col-overlay">
                <h3 class="v-col-name">{{ $col->name }}</h3>
                <span class="v-col-link">Explore Collection <i class="fa-solid fa-arrow-right"></i></span>
            </div>
        </div>
    </a>
    @endforeach
</div>

<!-- Section Header -->
<div style="margin-top: 8rem; margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end;">
    <div>
        <h2 style="font-size: 2.5rem; color: var(--text-primary);">Bestsellers</h2>
        <p style="color: var(--text-secondary); margin-top: 0.5rem;">The fragrances everyone is talking about.</p>
    </div>
    <div style="display: flex; gap: 1rem;">
        <button class="action-btn-v" style="padding: 0.5rem; background: var(--secondary-bg); border-radius: 50%;"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="action-btn-v" style="padding: 0.5rem; background: var(--secondary-bg); border-radius: 50%;"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
</div>

<!-- Product Grid -->
<div class="v-grid">
    @foreach($bestsellers as $item)
    <div class="v-card">
        <div class="v-img-box">
            @if($loop->first)
            <span class="v-badge">Trending</span>
            @endif
            <img src="{{ $item->product->main_image_url ?? asset('images/g-load.webp') }}" 
                 onerror="this.src='{{ asset('images/g-load.webp') }}'"
                 alt="{{ $item->product->title }}">
        </div>
        <div class="v-details">
            <span class="v-family">{{ $item->product->olfactory_family ?? 'Signature' }}</span>
            <h3 class="v-name">{{ $item->product->title }}</h3>
            <p class="v-price">₹{{ number_format($item->product->starting_price, 0) }}</p>
            
            <button class="btn-add-v">
                <i class="fa-solid fa-cart-plus mr-2"></i> Add to Bag
            </button>
        </div>
    </div>
    @endforeach
</div>

<!-- Exclusive Combos Section -->
<div style="margin-top: 8rem; margin-bottom: 4rem;">
    <h2 style="font-size: 2.5rem; color: var(--text-primary);">Exclusive Combos</h2>
    <p style="color: var(--text-secondary); margin-top: 0.5rem;">Luxury sets curated for the ultimate olfactory experience.</p>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
    @foreach($bundles as $bundle)
    <a href="{{ route('velvet.combo', ['slug' => $bundle->slug]) }}" class="v-combo-card">
        <div class="v-combo-img">
            <img src="{{ $bundle->image ? asset('storage/' . $bundle->image) : asset('images/g-load.webp') }}" 
                 onerror="this.src='{{ asset('images/g-load.webp') }}'"
                 alt="{{ $bundle->title }}">
        </div>
        <div class="v-combo-info">
            <span class="v-family" style="color: var(--accent-color);">Hand-Picked Set</span>
            <h3 class="v-name" style="font-size: 1.4rem; margin-top: 0.5rem;">{{ $bundle->title }}</h3>
            <div style="margin-top: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
                <span style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.1em;">Set Includes</span>
                <ul style="list-style: none; margin-top: 0.5rem; color: var(--text-primary); font-size: 0.85rem; opacity: 0.8;">
                    @foreach($bundle->products->take(2) as $p)
                        <li>{{ $p->title }}</li>
                    @endforeach
                    @if($bundle->products->count() > 2)
                        <li>+ {{ $bundle->products->count() - 2 }} more...</li>
                    @endif
                </ul>
            </div>
            <div style="margin-top: auto; padding-top: 2rem; display: flex; justify-content: space-between; align-items: center;">
                <span class="v-price" style="font-size: 1.3rem; color: var(--accent-color);">₹{{ number_format($bundle->total_price, 0) }}</span>
                <span style="font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-primary);">View Set <i class="fa-solid fa-arrow-right ml-2"></i></span>
            </div>
        </div>
    </a>
    @endforeach
</div>

<!-- Newsletter / Membership -->
<div style="margin-top: 8rem; background: var(--secondary-bg); border-radius: 2.5rem; padding: 5rem; text-align: center;">
    <h2 style="font-size: 2.5rem; margin-bottom: 1rem;">The Velvet Circle</h2>
    <p style="color: var(--text-secondary); max-width: 550px; margin: 0 auto 2.5rem;">Subscribe to receive early access to new releases, private events, and exclusive offers.</p>
    <div style="display: flex; max-width: 450px; margin: 0 auto; gap: 1rem;">
        <input type="email" placeholder="Email address" style="background: #fff; border: 1px solid var(--border-color); padding: 1.25rem; border-radius: 0.75rem; color: var(--text-primary); flex-grow: 1; outline: none; box-shadow: var(--shadow-soft);">
        <button class="btn-v" style="padding: 1.25rem 2rem;">Subscribe</button>
    </div>
</div>
@endsection
