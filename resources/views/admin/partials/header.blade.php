<header class="navbar navbar-expand bg-white border-bottom sticky-top px-4 py-2 flex-shrink-0" style="height: 64px;">
    <button class="btn btn-link text-secondary p-1 d-md-none me-3" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
    
    <div class="d-flex align-items-center flex-grow-1" style="max-width: 600px;">
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search small"></i></span>
            <input type="text" class="form-control bg-light border-start-0 shadow-none ps-0" placeholder="Search">
        </div>
    </div>

    <div class="d-flex align-items-center gap-3 ms-auto">
        <button class="btn btn-link text-secondary p-1 position-relative text-decoration-none">
            <i class="fas fa-bell"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                <span class="visually-hidden">New alerts</span>
            </span>
        </button>
        
        <div class="dropdown">
            <div class="d-flex align-items-center gap-2 cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="d-flex align-items-center justify-content-center rounded bg-success text-white fw-medium" style="width: 32px; height: 32px;">SA</div>
                <span class="small fw-medium text-secondary d-none d-sm-block">Admin</span>
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                <li><a class="dropdown-item small" href="#" data-bs-toggle="modal" data-bs-target="#profileModal"><i class="fas fa-user-edit me-2 text-muted"></i> Edit Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item small text-danger" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</header>
    <script src="{{ asset('js/admin-sidebar-toggle.js') }}" defer></script>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" id="profileModalLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <div class="text-center mb-4 mt-2">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 p-3 mb-2">
                        <i class="fas fa-user-edit text-success fs-4"></i>
                    </div>
                    <p class="text-muted small">Update your account details below.</p>
                </div>
                
                <form class="vstack gap-3">
                    <div>
                        <label for="name" class="form-label small fw-medium text-secondary">Name</label>
                        <input type="text" class="form-control" id="name" value="Admin">
                    </div>
                    <div>
                        <label for="email" class="form-label small fw-medium text-secondary">Email</label>
                        <input type="email" class="form-control" id="email" value="admin@nurah.com">
                    </div>
                    <div>
                        <label for="password" class="form-label small fw-medium text-secondary">New Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Leave blank to keep current">
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 bg-light py-2">
                <button type="button" class="btn btn-white border text-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success btn-sm text-white">Save Changes</button>
            </div>
        </div>
    </div>
</div>
