@if(count($cart) > 0)
    <div class="v4-cart-drawer-items">
        @foreach($cart as $id => $item)
            <div class="v4-drawer-item">
                <div class="v4-drawer-item-img">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" onerror="this.src='{{ asset('images/g-load.webp') }}'">
                </div>
                <div class="v4-drawer-item-info">
                    <h4>{{ $item['name'] }}</h4>
                    <span class="v4-drawer-item-variant">{{ $item['size'] ?? 'Combo' }} × {{ $item['quantity'] }}</span>
                    <div class="v4-drawer-item-price">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="v4-drawer-footer">
        <div class="v4-drawer-subtotal">
            <span>Subtotal</span>
            <strong>₹{{ number_format($total, 0) }}</strong>
        </div>
        <a href="{{ route('v4.cart') }}" class="v4-drawer-btn secondary">VIEW BAG</a>
        <a href="{{ route('v4.checkout') }}" class="v4-drawer-btn">CHECKOUT NOW</a>
    </div>
@else
    <div class="v4-drawer-empty">
        <i class="fa-solid fa-bag-shopping"></i>
        <p>Your bag is empty</p>
        <a href="{{ route('v4.all-products') }}" class="v4-drawer-btn">START SHOPPING</a>
    </div>
@endif

<style>
    .v4-cart-drawer-items { display: flex; flex-direction: column; gap: 20px; padding: 20px 0; overflow-y: auto; flex: 1; }
    .v4-drawer-item { display: flex; gap: 15px; align-items: center; }
    .v4-drawer-item-img { width: 70px; height: 70px; background: #f9f9f9; border-radius: 6px; overflow: hidden; border: 1px solid #eee; flex-shrink: 0; }
    .v4-drawer-item-img img { width: 100%; height: 100%; object-fit: cover; }
    .v4-drawer-item-info h4 { font-size: 14px; margin-bottom: 4px; color: var(--aj-dark); }
    .v4-drawer-item-variant { font-size: 11px; color: var(--aj-gray); font-weight: 700; text-transform: uppercase; }
    .v4-drawer-item-price { font-size: 13px; font-weight: 800; color: var(--aj-gold); margin-top: 5px; }

    .v4-drawer-footer { padding: 20px 0; border-top: 1px solid #eee; }
    .v4-drawer-subtotal { display: flex; justify-content: space-between; margin-bottom: 20px; font-weight: 700; }
    .v4-drawer-btn { display: block; width: 100%; padding: 15px; text-align: center; text-decoration: none; font-weight: 800; font-size: 12px; border-radius: 4px; margin-bottom: 10px; transition: 0.3s; }
    .v4-drawer-btn { background: #000; color: #fff; }
    .v4-drawer-btn.secondary { background: #fff; color: #000; border: 1px solid #000; }
    .v4-drawer-btn:hover { background: var(--aj-gold); color: #fff; border-color: var(--aj-gold); }

    .v4-drawer-empty { text-align: center; padding: 50px 0; }
    .v4-drawer-empty i { font-size: 50px; color: #eee; margin-bottom: 20px; }
</style>
