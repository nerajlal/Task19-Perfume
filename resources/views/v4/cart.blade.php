@extends('v4.layouts.app')

@section('title', 'Your Shopping Bag | Task19 Luxury Fragrance')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <nav class="v4-breadcrumb">
            <a href="{{ route('v4.home') }}">Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Shopping Bag</span>
        </nav>

        <header class="v4-page-header" style="margin-top: 50px; margin-bottom: 50px;">
            <h1 class="cursive aj-title">YOUR <span class="sketch-under">BAG</span></h1>
        </header>

        @if(count($cart) > 0)
            <div class="v4-cart-layout">
                <!-- Cart Items -->
                <div class="v4-cart-items-col">
                    @foreach($cart as $id => $item)
                        <div class="v4-cart-item" id="item-{{ $id }}">
                            <div class="v4-cart-item-img">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" onerror="this.src='{{ asset('images/g-load.webp') }}'">
                            </div>
                            <div class="v4-cart-item-info">
                                <div class="v4-item-header">
                                    <div>
                                        <h3 class="serif">{{ $item['name'] }}</h3>
                                        @if($item['size'])
                                            <span class="v4-item-variant">{{ $item['size'] }}</span>
                                        @endif
                                    </div>
                                    <button class="v4-item-remove" onclick="removeCartItem('{{ $id }}')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                                <div class="v4-item-footer">
                                    <div class="v4-item-qty">
                                        <button onclick="updateCartQty('{{ $id }}', -1)">-</button>
                                        <input type="number" value="{{ $item['quantity'] }}" readonly id="qty-{{ $id }}">
                                        <button onclick="updateCartQty('{{ $id }}', 1)">+</button>
                                    </div>
                                    <div class="v4-item-price">
                                        <span id="total-{{ $id }}">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary Sidebar -->
                <div class="v4-cart-summary-col">
                    <div class="v4-summary-card">
                        <h3 class="serif">ORDER SUMMARY</h3>
                        <div class="v4-summary-row">
                            <span>Subtotal</span>
                            <span id="cart-subtotal">₹{{ number_format($subtotal, 0) }}</span>
                        </div>
                        <div class="v4-summary-row">
                            <span>Savings</span>
                            <span id="cart-savings" style="color: #10B981;">-₹{{ number_format($savings, 0) }}</span>
                        </div>
                        <div class="v4-summary-row">
                            <span>Shipping</span>
                            <span style="color: #10B981;">FREE</span>
                        </div>
                        <div class="v4-summary-row total">
                            <span>Total</span>
                            <span id="cart-total">₹{{ number_format($total, 0) }}</span>
                        </div>

                        <a href="{{ route('v4.checkout') }}" class="v4-checkout-btn">
                            PROCEED TO CHECKOUT
                        </a>

                        <div class="v4-summary-trust">
                            <div class="trust-item"><i class="fa-solid fa-shield-check"></i> Secure Checkout</div>
                            <div class="trust-item"><i class="fa-solid fa-truck"></i> Fast Delivery</div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="v4-empty-cart text-center" style="padding: 100px 0;">
                <i class="fa-solid fa-bag-shopping" style="font-size: 80px; color: #eee; margin-bottom: 30px;"></i>
                <h2 class="serif">YOUR BAG IS EMPTY</h2>
                <p style="color: var(--aj-gray); margin-bottom: 40px;">Looks like you haven't added anything to your bag yet.</p>
                <a href="{{ route('v4.all-products') }}" class="v4-checkout-btn" style="max-width: 300px; margin: 0 auto;">START SHOPPING</a>
            </div>
        @endif
    </div>

    <style>
        .v4-breadcrumb { display: flex; align-items: center; gap: 10px; font-size: 11px; text-transform: uppercase; font-weight: 700; letter-spacing: 1px; color: var(--aj-gray); }
        .v4-breadcrumb a { text-decoration: none; color: inherit; transition: 0.3s; }
        .v4-breadcrumb a:hover { color: var(--aj-gold); }
        .v4-breadcrumb i { font-size: 8px; opacity: 0.5; }

        .v4-cart-layout { display: grid; grid-template-columns: 1fr 400px; gap: 50px; margin-bottom: 100px; }

        .v4-cart-item { display: grid; grid-template-columns: 120px 1fr; gap: 30px; padding: 30px 0; border-bottom: 1px solid #eee; }
        .v4-cart-item:first-child { padding-top: 0; }
        .v4-cart-item-img { aspect-ratio: 1; background: #f9f9f9; border-radius: 8px; overflow: hidden; border: 1px solid #eee; }
        .v4-cart-item-img img { width: 100%; height: 100%; object-fit: cover; }

        .v4-item-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; }
        .v4-item-header h3 { font-size: 20px; color: var(--aj-dark); margin-bottom: 5px; }
        .v4-item-variant { font-size: 12px; font-weight: 700; color: var(--aj-gray); text-transform: uppercase; }
        .v4-item-remove { background: none; border: none; color: #ccc; cursor: pointer; transition: 0.3s; font-size: 18px; }
        .v4-item-remove:hover { color: #e74c3c; }

        .v4-item-footer { display: flex; justify-content: space-between; align-items: center; }
        .v4-item-qty { display: flex; align-items: center; border: 1.5px solid #eee; border-radius: 4px; overflow: hidden; }
        .v4-item-qty button { background: #fff; border: none; width: 35px; height: 35px; cursor: pointer; font-weight: 700; transition: 0.3s; }
        .v4-item-qty button:hover { background: #f5f5f5; }
        .v4-item-qty input { width: 40px; text-align: center; border: none; border-left: 1.5px solid #eee; border-right: 1.5px solid #eee; font-weight: 700; font-size: 14px; outline: none; }
        .v4-item-price { font-size: 18px; font-weight: 800; color: var(--aj-dark); }

        .v4-summary-card { background: #fff; border: 1px solid #eee; border-radius: 12px; padding: 40px; position: sticky; top: 120px; }
        .v4-summary-card h3 { font-size: 14px; letter-spacing: 2px; margin-bottom: 30px; font-weight: 800; }
        .v4-summary-row { display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 15px; font-weight: 600; color: var(--aj-gray); }
        .v4-summary-row.total { border-top: 1px solid #eee; margin-top: 20px; padding-top: 20px; color: var(--aj-dark); font-size: 20px; font-weight: 800; }
        .v4-checkout-btn { display: block; width: 100%; background: #000; color: #fff; text-decoration: none; text-align: center; padding: 20px; border-radius: 4px; font-weight: 800; font-size: 14px; letter-spacing: 1px; transition: 0.3s; margin-top: 30px; }
        .v4-checkout-btn:hover { background: var(--aj-gold); transform: translateY(-5px); box-shadow: 0 15px 30px rgba(176, 141, 87, 0.2); }

        .v4-summary-trust { display: flex; flex-direction: column; gap: 15px; margin-top: 30px; }
        .trust-item { font-size: 12px; font-weight: 700; color: #999; display: flex; align-items: center; gap: 10px; }
        .trust-item i { color: var(--aj-gold); font-size: 16px; }

        @media (max-width: 991px) {
            .v4-cart-layout { grid-template-columns: 1fr; gap: 40px; }
            .v4-cart-summary-col { order: -1; }
            .v4-summary-card { position: static; padding: 30px; }
        }
    </style>

    <script>
        function updateCartQty(id, delta) {
            const input = document.getElementById('qty-' + id);
            let val = parseInt(input.value) + delta;
            if(val < 1) return;
            
            $.ajax({
                url: "{{ route('cart.update') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    quantity: val
                },
                success: function(response) {
                    if(response.success) {
                        input.value = val;
                        $('#total-' + id).text('₹' + response.itemTotal.toLocaleString());
                        $('#cart-total').text('₹' + response.cartTotal.toLocaleString());
                        $('#cart-subtotal').text('₹' + response.subtotal.toLocaleString());
                        $('#cart-savings').text('-₹' + response.savings.toLocaleString());
                        $('#cart-count').text(response.cartCount);
                    }
                }
            });
        }

        function removeCartItem(id) {
            if(!confirm('Remove this item from your bag?')) return;
            
            $.ajax({
                url: "{{ route('cart.remove') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    if(response.success) {
                        if(response.isEmpty) {
                            location.reload();
                        } else {
                            $('#item-' + id).fadeOut(300, function() { $(this).remove(); });
                            $('#cart-total').text('₹' + response.cartTotal.toLocaleString());
                            $('#cart-subtotal').text('₹' + response.subtotal.toLocaleString());
                            $('#cart-savings').text('-₹' + response.savings.toLocaleString());
                            $('#cart-count').text(response.cartCount);
                        }
                    }
                }
            });
        }
    </script>
@endsection
