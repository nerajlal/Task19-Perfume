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
                <button class="action-btn" onclick="openModal('login-modal')">
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
    <div id="login-modal" class="modal-overlay" style="display: none;" onclick="closeModalOnOverlay(event, 'login-modal')">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('login-modal')">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="modal-header">
                <h2 class="modal-title">Welcome Back</h2>
                <p class="modal-subtitle">Log in to your Task19 account to continue.</p>
            </div>
            
            <form action="{{ route('login') }}" method="POST" class="modal-form">
                @csrf
                <div class="form-group-modal" style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--primary-color);">Email Address</label>
                    <input type="email" name="email" required placeholder="name@example.com" style="width: 100%; padding: 0.85rem 1rem; border-radius: 1rem; border: 1.5px solid var(--border-color); outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--accent-color)'" onblur="this.style.borderColor='var(--border-color)'">
                </div>
                <div class="form-group-modal" style="margin-bottom: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; color: var(--primary-color);">Password</label>
                        <a href="#" style="font-size: 0.75rem; color: var(--accent-color); text-decoration: none; font-weight: 600;">Forgot?</a>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••" style="width: 100%; padding: 0.85rem 1rem; border-radius: 1rem; border: 1.5px solid var(--border-color); outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--accent-color)'" onblur="this.style.borderColor='var(--border-color)'">
                </div>
                <button type="submit" class="btn-primary" style="width: 100%; border: none; margin-top: 1rem; padding: 1rem; border-radius: 1rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Log In</button>
            </form>

            <div style="margin: 2rem 0; display: flex; align-items: center; gap: 1rem; color: var(--text-muted); font-size: 0.8rem;">
                <div style="flex-grow: 1; height: 1px; background: var(--border-color);"></div>
                <span>OR</span>
                <div style="flex-grow: 1; height: 1px; background: var(--border-color);"></div>
            </div>

            <a href="{{ route('google.login') }}" style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; width: 100%; padding: 0.85rem; border-radius: 1rem; border: 1.5px solid var(--border-color); background: #fff; color: var(--primary-color); text-decoration: none; font-weight: 700; font-size: 0.9rem; transition: 0.3s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#fff'">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" width="18">
                Continue with Google
            </a>

            <div class="modal-footer-box" style="margin-top: 2rem; text-align: center; font-size: 0.9rem; color: var(--text-muted);">
                <span>New to Task19? <a href="javascript:void(0)" onclick="switchModal('login-modal', 'register-modal')" style="color: var(--accent-color); font-weight: 700; text-decoration: none;">Create an account</a></span>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="register-modal" class="modal-overlay" style="display: none;" onclick="closeModalOnOverlay(event, 'register-modal')">
        <div class="modal-content" style="max-width: 500px;">
            <button class="modal-close" onclick="closeModal('register-modal')">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="modal-header">
                <h2 class="modal-title">Join Task19</h2>
                <p class="modal-subtitle">Experience the finest luxury fragrances today.</p>
            </div>
            
            <form action="{{ route('register') }}" method="POST" class="modal-form">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
                    <div class="form-group-modal">
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--primary-color);">Full Name</label>
                        <input type="text" name="name" required placeholder="John Doe" style="width: 100%; padding: 0.85rem 1rem; border-radius: 1rem; border: 1.5px solid var(--border-color); outline: none;">
                    </div>
                    <div class="form-group-modal">
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--primary-color);">Phone</label>
                        <input type="text" name="phone" placeholder="+91" style="width: 100%; padding: 0.85rem 1rem; border-radius: 1rem; border: 1.5px solid var(--border-color); outline: none;">
                    </div>
                </div>

                <div class="form-group-modal" style="margin-bottom: 1.25rem;">
                    <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--primary-color);">Email Address</label>
                    <input type="email" name="email" required placeholder="name@example.com" style="width: 100%; padding: 0.85rem 1rem; border-radius: 1rem; border: 1.5px solid var(--border-color); outline: none;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div class="form-group-modal">
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--primary-color);">Password</label>
                        <input type="password" name="password" required placeholder="••••••••" style="width: 100%; padding: 0.85rem 1rem; border-radius: 1rem; border: 1.5px solid var(--border-color); outline: none;">
                    </div>
                    <div class="form-group-modal">
                        <label style="display: block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--primary-color);">Confirm</label>
                        <input type="password" name="password_confirmation" required placeholder="••••••••" style="width: 100%; padding: 0.85rem 1rem; border-radius: 1rem; border: 1.5px solid var(--border-color); outline: none;">
                    </div>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%; border: none; padding: 1rem; border-radius: 1rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Create Account</button>
            </form>

            <div class="modal-footer-box" style="margin-top: 2rem; text-align: center; font-size: 0.9rem; color: var(--text-muted);">
                <span>Already have an account? <a href="javascript:void(0)" onclick="switchModal('register-modal', 'login-modal')" style="color: var(--accent-color); font-weight: 700; text-decoration: none;">Log In here</a></span>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
            document.body.style.overflow = '';
        }

        function closeModalOnOverlay(event, id) {
            if (event.target.id === id) {
                closeModal(id);
            }
        }

        function switchModal(from, to) {
            closeModal(from);
            setTimeout(() => openModal(to), 10);
        }

        // Handle errors and reopening modals
        @if(session('open_login') || $errors->has('email'))
            openModal('login-modal');
        @endif

        @if(session('open_register') || session('register_error'))
            openModal('register-modal');
        @endif
    </script>
</header>
