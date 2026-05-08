<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Velvet | High-End Fragrance')</title>
    <link rel="stylesheet" href="{{ asset('css/velvet.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header class="velvet-header">
        <div class="header-container-v">
            <a href="{{ route('velvet.home') }}" class="logo-v">VELVET</a>
            
            <div class="search-bar-v">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search the collection...">
            </div>

            <div class="header-actions-v">
                <button class="action-btn-v"><i class="fa-solid fa-user"></i></button>
                <button class="action-btn-v" style="position: relative;">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="cart-count-v">0</span>
                </button>
            </div>
        </div>
    </header>

    <div class="velvet-layout">
        <!-- Sidebar -->
        <aside class="velvet-sidebar">
            <div class="sidebar-section-v">
                <h3 class="sidebar-title-v">Luxury Catalog</h3>
                <ul class="sidebar-links-v">
                    <li><a href="{{ route('velvet.all-products') }}" class="{{ request()->routeIs('velvet.all-products') ? 'active' : '' }}"><i class="fa-solid fa-gem"></i> All Products</a></li>
                    <li><a href="{{ route('velvet.combos') }}" class="{{ request()->routeIs('velvet.combos') || request()->routeIs('velvet.combo') ? 'active' : '' }}"><i class="fa-solid fa-layer-group"></i> Exclusive Combos</a></li>
                </ul>
            </div>

            <div class="sidebar-section-v">
                <h3 class="sidebar-title-v">Our Collections</h3>
                <ul class="sidebar-links-v">
                    @foreach($collections ?? [] as $col)
                        <li>
                            <a href="{{ route('velvet.collection', ['slug' => $col->slug]) }}" 
                               class="{{ (isset($collection) && $collection->id == $col->id) ? 'active' : '' }}">
                                {{ $col->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="sidebar-footer-v">
                <a href="#"><i class="fa-solid fa-circle-info"></i> Our Legacy</a>
                <a href="#"><i class="fa-solid fa-headset"></i> Concierge</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="velvet-main-content">
            @yield('content')
            
            <footer class="velvet-mini-footer">
                <p>&copy; {{ date('Y') }} VELVET FRAGRANCES. LUXURY DEFINED.</p>
            </footer>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
