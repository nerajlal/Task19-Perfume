@extends('layouts.velvet')

@section('title', 'Velvet | Exclusive Combos')

@section('content')
<!-- Page Header -->
<div style="margin-bottom: 4rem;">
    <span class="v-family" style="font-size: 0.8rem; letter-spacing: 0.3em;">The Gift of Scent</span>
    <h1 style="font-size: 3.5rem; color: var(--text-primary); margin-top: 0.5rem;">Exclusive Combos</h1>
    <p style="color: var(--text-secondary); margin-top: 1rem; max-width: 600px; font-size: 1.1rem;">Discover our hand-picked collections, curated by master perfumers to offer a complete olfactory journey.</p>
</div>

<!-- Combos Grid -->
@if($bundles->count() > 0)
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
                        @foreach($bundle->products->take(3) as $p)
                            <li>{{ $p->title }}</li>
                        @endforeach
                        @if($bundle->products->count() > 3)
                            <li>+ {{ $bundle->products->count() - 3 }} more...</li>
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
@else
    <div style="text-align: center; padding: 10rem 2rem; background: var(--secondary-bg); border-radius: 2rem;">
        <i class="fa-solid fa-layer-group" style="font-size: 3rem; color: var(--accent-color); opacity: 0.3; margin-bottom: 2rem;"></i>
        <h2 style="font-size: 1.5rem; color: var(--text-secondary);">No combos available at the moment</h2>
        <a href="{{ route('velvet.all-products') }}" class="btn-v" style="margin-top: 2rem;">Browse All Products</a>
    </div>
@endif
@endsection
