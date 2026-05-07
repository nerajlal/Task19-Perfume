<header class="store-header">
    <div class="header-container">
        <button id="mobile-menu-toggle" class="mobile-toggle">
            <i class="fa-solid fa-bars"></i>
        </button>
        <a href="{{ route('home') }}" class="logo">
            Task19 Perfumes
        </a>

        <div class="search-bar">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" class="search-input" placeholder="Search for luxury fragrances, oils, or collections...">
        </div>

        <div class="header-actions">
            @auth
                <a href="{{ route('account.index') }}" class="action-btn">
                    <i class="fa-regular fa-user"></i>
                    <span class="action-text">Account</span>
                </a>
            @else
                <button class="action-btn" onclick="document.getElementById('login-modal').style.display='flex'">
                    <i class="fa-regular fa-user"></i>
                    <span class="action-text">Log In</span>
                </button>
            @endauth

            <a href="{{ route('cart') }}" class="action-btn cart-btn">
                <i class="fa-solid fa-cart-shopping"></i>
                <span id="cart-count">{{ \App\Models\Cart::where('user_id', auth()->id())->count() }}</span>
            </a>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="login-modal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <button class="modal-close" onclick="document.getElementById('login-modal').style.display='none'">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="modal-header">
                <h2 class="modal-title">Welcome Back</h2>
                <p class="modal-subtitle">Log in to your Task19 account to continue.</p>
            </div>
            <form action="{{ route('login') }}" method="POST" class="modal-form">
                @csrf
                <div class="form-group-modal" style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.5rem;">Email Address</label>
                    <input type="email" name="email" required placeholder="name@example.com" style="width: 100%; padding: 0.75rem; border-radius: 0.75rem; border: 1px solid var(--border-color);">
                </div>
                <div class="form-group-modal" style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.5rem;">Password</label>
                    <input type="password" name="password" required placeholder="Your password" style="width: 100%; padding: 0.75rem; border-radius: 0.75rem; border: 1px solid var(--border-color);">
                </div>
                <button type="submit" class="btn-primary" style="width: 100%; border: none; margin-top: 1rem;">Log In</button>
            </form>
            <div class="modal-footer-box" style="margin-top: 2rem; text-align: center; font-size: 0.9rem; color: var(--text-muted);">
                <span>New to Task19? <a href="{{ route('register') }}" style="color: var(--accent-color); font-weight: 700;">Create an account</a></span>
            </div>
        </div>
    </div>
</header>
