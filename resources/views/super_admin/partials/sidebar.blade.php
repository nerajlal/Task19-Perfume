<aside id="adminSidebar" class="sidebar d-none d-md-flex flex-column bg-white border-end h-100">
    <div class="p-3 d-flex align-items-center justify-content-between border-bottom" style="height: 64px;">
        <div class="d-flex align-items-center gap-2">
            <div class="d-flex align-items-center justify-content-center rounded bg-dark text-white fw-bold" style="width: 32px; height: 32px; font-size: 14px;">SA</div>
            <span class="fw-semibold text-secondary">Super Admin</span>
        </div>
    </div>

    <nav class="flex-grow-1 overflow-auto py-2">
        <ul class="list-unstyled mb-0 px-2 d-flex flex-column gap-1">
            <li>
                <a href="{{ route('super_admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('super_admin.dashboard') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-home text-center" style="width: 20px;"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="px-3 pt-3 pb-2 text-uppercase fw-bold text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                Tenants
            </li>
            <li>
                <a href="{{ route('super_admin.create_tenant') }}" class="sidebar-item {{ request()->routeIs('super_admin.create_tenant') ? 'active' : '' }} d-flex align-items-center gap-3 px-3 py-2 rounded text-decoration-none text-secondary small">
                    <i class="fas fa-user-plus text-center" style="width: 20px;"></i>
                    <span>Create Tenant</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="p-3 border-top">
         <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>
