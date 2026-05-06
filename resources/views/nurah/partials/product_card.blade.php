<div class="product-card">
    <a href="{{ route('product', ['id' => $product->id]) }}" class="card-img">
        @php 
            $imagePath = $product->image;
            if (Str::startsWith($imagePath, 'http')) {
                // External URL
            } elseif (Str::startsWith($imagePath, 'images/')) {
                // Local public/images folder
                $imagePath = asset($imagePath);
            } else {
                // Storage folder (uploaded via admin)
                $imagePath = \Illuminate\Support\Facades\Storage::url($imagePath);
            }
        @endphp
        <img src="{{ $imagePath }}" alt="{{ $product->title }}" onerror="this.src='{{ asset('images/g-load.webp') }}'">
    </a>
    <div class="card-info">
        <span class="p-price">₹{{ number_format($product->price, 2) }}</span>
        <a href="{{ route('product', ['id' => $product->id]) }}" class="p-name">{{ $product->title }}</a>
        <span class="p-meta">{{ $product->olfactory_family }} • {{ $product->type }}</span>
    </div>
    <button class="cart-add-btn" data-product-id="{{ $product->id }}">
        <i class="fa-solid fa-plus"></i>
    </button>
</div>
