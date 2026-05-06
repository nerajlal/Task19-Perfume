<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task19 Perfumes | Luxury Fragrances')</title>
    <link rel="stylesheet" href="{{ asset('css/storefront.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @include('nurah.partials.header')

    <div class="main-wrapper">
        <aside class="sidebar">
            <h2 class="sidebar-title">Categories</h2>
            <ul class="sidebar-menu">
                @php $sidebarCollections = \App\Models\Collection::where('status', 1)->get(); @endphp
                <li class="menu-item">
                    <a href="{{ route('all-products') }}" class="menu-link {{ request()->routeIs('all-products') ? 'active' : '' }}">
                        <i class="fa-solid fa-border-all"></i> All Products
                    </a>
                </li>
                @foreach($sidebarCollections as $col)
                <li class="menu-item">
                    <a href="{{ route('collection', ['slug' => $col->slug]) }}" class="menu-link {{ request()->query('slug') == $col->slug ? 'active' : '' }}">
                        <i class="fa-solid fa-bottle-droplet"></i> {{ $col->name }}
                    </a>
                </li>
                @endforeach
            </ul>

            <h2 class="sidebar-title" style="margin-top: 2rem;">Shop By Gender</h2>
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="{{ route('collection', ['gender' => 'for-him']) }}" class="menu-link">
                        <i class="fa-solid fa-mars"></i> For Him
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('collection', ['gender' => 'for-her']) }}" class="menu-link">
                        <i class="fa-solid fa-venus"></i> For Her
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('collection', ['gender' => 'unisex']) }}" class="menu-link">
                        <i class="fa-solid fa-venus-mars"></i> Unisex
                    </a>
                </li>
            </ul>

            <h2 class="sidebar-title" style="margin-top: 2rem;">Company</h2>
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="{{ route('about') }}" class="menu-link">
                        <i class="fa-solid fa-circle-info"></i> Our Story
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('contact') }}" class="menu-link">
                        <i class="fa-solid fa-paper-plane"></i> Contact
                    </a>
                </li>
            </ul>
        </aside>

        <main class="main-content">
            <div class="content-container">
                @yield('content')
            </div>
            @include('nurah.partials.footer')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>
</html>
