<div class="product-card">
    <a href="{{ route('product', ['id' => $product->id]) }}" class="card-img">
        @php 
            $imagePath = $product->main_image_url;
            if (!$imagePath) {
                // Fallback to legacy path if it exists or hardcoded images/ folder
                $legacyImg = $product->image ?? 'images/products/p' . $product->id . '.png';
                if (Str::startsWith($legacyImg, 'images/')) {
                    $imagePath = asset($legacyImg);
                } else {
                    $imagePath = asset('images/g-load.webp');
                }
            }
        @endphp
        <img src="{{ $imagePath }}" alt="{{ $product->title }}" onerror="this.src='{{ asset('images/g-load.webp') }}'">
    </a>
    <div class="card-info">
        <span class="p-price">₹{{ number_format($product->starting_price, 2) }}</span>
        <a href="{{ route('product', ['id' => $product->id]) }}" class="p-name">{{ $product->title }}</a>
        <span class="p-meta">{{ $product->olfactory_family }} • {{ $product->type }}</span>
    </div>
    <button class="cart-add-btn" data-product-id="{{ $product->id }}">
        <i class="fa-solid fa-plus"></i>
    </button>
</div>
