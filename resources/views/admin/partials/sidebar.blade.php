<aside id="adminSidebar" class="sidebar d-none d-md-flex flex-column bg-white border-end h-100">
    <div class="p-3 d-flex align-items-center justify-content-between border-bottom" style="height: 64px;">
        <div class="d-flex align-items-center gap-2">
            <div class="d-flex align-items-center justify-content-center rounded bg-dark text-white fw-bold" style="width: 32px; height: 32px; font-size: 14px;">N</div>
            <span class="fw-semibold text-secondary">xxxx Admin</span>
        </div>
        <button class="btn btn-link text-secondary p-0 text-decoration-none d-md-none" onclick="toggleSidebar()"><i class="fas fa-chevron-left small"></i></button>
    </div>

    <nav class="flex-grow-1 overflow-auto py-2">
        <ul class="list-unstyled mb-0 px-2 d-flex flex-column gap-1">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-home text-center" style="width: 20px;"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders') }}" class="sidebar-item {{ request()->routeIs('admin.orders') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-box-open text-center" style="width: 20px;"></i>
                    <span>Orders</span>
                    @if(isset($pendingOrdersCount) && $pendingOrdersCount > 0)
                        <span class="ms-auto badge bg-danger text-white rounded-pill">{{ $pendingOrdersCount }}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('admin.collections') }}" class="sidebar-item {{ request()->routeIs('admin.collections*') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-layer-group text-center" style="width: 20px;"></i>
                    <span>Collections</span>
                </a>
            </li>
             <li>
                <a href="{{ route('admin.attributes') }}" class="sidebar-item {{ request()->routeIs('admin.attributes*') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-wind text-center" style="width: 20px;"></i>
                    <span>Attributes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products') }}" class="sidebar-item {{ request()->routeIs('admin.products*') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-tag text-center" style="width: 20px;"></i>
                    <span>Products</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.bundles') }}" class="sidebar-item {{ request()->routeIs('admin.bundles*') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-cubes text-center" style="width: 20px;"></i>
                    <span>Bundles</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.customers') }}" class="sidebar-item {{ request()->routeIs('admin.customers') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-users text-center" style="width: 20px;"></i>
                    <span>Customers</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.carts') }}" class="sidebar-item {{ request()->routeIs('admin.carts') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-shopping-basket text-center" style="width: 20px;"></i>
                    <span>Carted Products</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.analytics') }}" class="sidebar-item {{ request()->routeIs('admin.analytics') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-chart-bar text-center" style="width: 20px;"></i>
                    <span>Analytics</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.discounts') }}" class="sidebar-item {{ request()->routeIs('admin.discounts*') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-percent text-center" style="width: 20px;"></i>
                    <span>Discounts</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reviews') }}" class="sidebar-item {{ request()->routeIs('admin.reviews*') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-star text-center" style="width: 20px;"></i>
                    <span>Reviews</span>
                    <i class="fas fa-crown text-warning ms-auto" title="Premium Feature"></i>
                </a>
            </li>

            <li class="px-3 pt-3 pb-2 text-uppercase fw-bold text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                Settings
            </li>
            <li>
                 <a href="{{ route('admin.settings.slider') }}" class="sidebar-item {{ request()->routeIs('admin.settings.slider') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-images text-center" style="width: 20px;"></i>
                    <span>Hero Slider</span>
                </a>
            </li>
            <li>
                 <a href="{{ route('admin.settings.home-products') }}" class="sidebar-item {{ request()->routeIs('admin.settings.home-products*') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-star text-center" style="width: 20px;"></i>
                    <span>Home Products</span>
                </a>
            </li>
            <li>
                 <a href="{{ route('admin.settings.delivery-partners.index') }}" class="sidebar-item {{ request()->routeIs('admin.settings.delivery-partners*') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-truck text-center" style="width: 20px;"></i>
                    <span>Delivery Partners</span>
                </a>
            </li>
            <li>
                 <a href="{{ route('admin.settings.managers') }}" class="sidebar-item {{ request()->routeIs('admin.settings.managers*') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-users-cog text-center" style="width: 20px;"></i>
                    <span>Site Managers</span>
                    <i class="fas fa-crown text-warning ms-auto" title="Premium Feature"></i>
                </a>
            </li>
            <li>
                 <a href="{{ route('admin.blog') }}" class="sidebar-item {{ request()->routeIs('admin.blog*') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-newspaper text-center" style="width: 20px;"></i>
                    <span>Blog & Articles</span>
                    <i class="fas fa-crown text-warning ms-auto" title="Premium Feature"></i>
                </a>
            </li>
        </ul>

    </nav>
</aside>
