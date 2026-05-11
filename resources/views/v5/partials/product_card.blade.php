@php
    $mainImage = $product->images->where('order', 0)->first() ?? $product->images->first();
    $hoverImage = $product->images->where('order', 1)->first() ?? $product->images->skip(1)->first();
    $price = $product->starting_price;
    $comparePrice = $product->compare_at_price;
    $discount = 0;
    if($comparePrice > $price) {
        $discount = round((($comparePrice - $price) / $comparePrice) * 100);
    }
@endphp

<div class="af-p-card">
    <div class="af-p-media">
        <a href="{{ route('v5.product', ['id' => $product->id]) }}">
            <img src="{{ $mainImage ? asset('storage/' . $mainImage->path) : asset('images/g-load.webp') }}" alt="{{ $product->title }}" class="af-p-main-img">
            @if($hoverImage)
                <img src="{{ asset('storage/' . $hoverImage->path) }}" alt="{{ $product->title }}" class="af-p-hover-img">
            @endif
        </a>

        @if($discount > 0)
            <div class="af-p-badge">-{{ $discount }}%</div>
        @elseif($product->created_at > now()->subDays(30))
            <div class="af-p-badge af-badge-new">NEW</div>
        @endif
    </div>

    <div class="af-p-info">
        <div class="af-p-meta">{{ $product->olfactory_family ?? 'Luxury Fragrance' }}</div>
        <h3 class="af-p-title"><a href="{{ route('v5.product', ['id' => $product->id]) }}">{{ $product->title }}</a></h3>
        <div class="af-p-price">
            @if($comparePrice > $price)
                <span class="af-price-old">₹{{ number_format($comparePrice, 0) }}</span>
            @endif
            <span class="af-price-new">₹{{ number_format($price, 0) }}</span>
        </div>
        
        <button class="af-quick-add" onclick="quickAddV5({{ $product->id }})">
            <span>+ ADD TO BAG</span>
        </button>
    </div>
</div>

<style>
    .af-p-card {
        background: #fff;
        padding: 20px;
        border-right: 1px solid var(--af-border);
        border-bottom: 1px solid var(--af-border);
        display: flex;
        flex-direction: column;
        transition: 0.3s;
        position: relative;
    }

    .af-p-media {
        position: relative;
        aspect-ratio: 0.9;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .af-p-media img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .af-p-hover-img {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .af-p-card:hover .af-p-hover-img { opacity: 1; }
    .af-p-card:hover .af-p-main-img { opacity: 0; }

    .af-p-badge {
        position: absolute;
        top: 0;
        left: 0;
        background: var(--af-red);
        color: #fff;
        font-size: 9px;
        font-weight: 700;
        padding: 4px 10px;
        letter-spacing: 1px;
    }

    .af-badge-new { background: #000; }

    .af-quick-add {
        display: block;
        width: 100%;
        background: var(--af-black);
        color: #fff;
        border: none;
        padding: 10px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 12px;
    }

    .af-quick-add:hover { background: var(--af-red); }

    .af-p-info { text-align: center; }
    .af-p-meta { font-size: 9px; color: var(--af-gray); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; font-weight: 600; }
    .af-p-title { font-size: 14px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1.2; }
    .af-p-title a { text-decoration: none; color: inherit; }
    .af-p-title a:hover { color: var(--af-red); }

    .af-p-price { display: flex; align-items: center; justify-content: center; gap: 8px; }
    .af-price-old { text-decoration: line-through; color: #999; font-size: 12px; }
    .af-price-new { font-size: 14px; font-weight: 700; color: var(--af-black); }

    @media (max-width: 768px) {
        .af-p-card { padding: 12px; border-right: none; }
        .af-quick-add { 
            padding: 8px;
            font-size: 9px;
            margin-top: 10px;
        }
        .af-p-title { font-size: 12px; }
        .af-p-meta { font-size: 8px; }
    }
</style>
