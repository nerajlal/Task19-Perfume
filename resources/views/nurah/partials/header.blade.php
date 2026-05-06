<header class="store-header">
    <div class="header-container">
        <a href="{{ route('home') }}" class="logo">
            NURAH
        </a>

        <div class="search-bar">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" class="search-input" placeholder="Search for luxury fragrances, oils, or collections...">
        </div>

        <div class="header-actions">
            @auth
                <a href="{{ route('account.index') }}" class="action-btn">
                    <i class="fa-regular fa-user"></i>
                    <span>Account</span>
                </a>
            @else
                <button class="action-btn" onclick="document.getElementById('login-modal').style.display='flex'">
                    <i class="fa-regular fa-user"></i>
                    <span>Log In</span>
                </button>
            @endauth

            <a href="{{ route('cart') }}" class="action-btn cart-btn">
                <i class="fa-solid fa-cart-shopping"></i>
                <span id="cart-count">{{ \App\Models\Cart::where('user_id', auth()->id())->count() }}</span>
            </a>
        </div>
    </div>
</header>