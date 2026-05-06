@extends('super_admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold text-dark mb-1">Super Admin Dashboard</h1>
        <p class="text-muted small">Manage your tenants and site configurations.</p>
    </div>
    <a href="{{ route('super_admin.create_tenant') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus me-2"></i> Create New Tenant
    </a>
</div>

<div class="card border shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 text-dark fw-bold">Active Tenants</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted small text-uppercase">
                <tr>
                    <th class="px-3 py-2 border-0 fw-medium">ID</th>
                    <th class="px-3 py-2 border-0 fw-medium">Site Name</th>
                    <th class="px-3 py-2 border-0 fw-medium">Admin Name</th>
                    <th class="px-3 py-2 border-0 fw-medium">Email</th>
                    <th class="px-3 py-2 border-0 fw-medium">Created At</th>
                    <th class="px-3 py-2 border-0 fw-medium text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tenants as $tenant)
                <tr>
                    <td class="px-3 py-3 fw-semibold text-dark">#{{ $tenant->id }}</td>
                    <td class="px-3 py-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary">{{ $tenant->site_name ?? 'N/A' }}</span>
                    </td>
                    <td class="px-3 py-3 text-dark fw-medium">{{ $tenant->name }}</td>
                    <td class="px-3 py-3 text-muted">{{ $tenant->email }}</td>
                    <td class="px-3 py-3 text-muted small">{{ $tenant->created_at->format('M d, Y') }}</td>
                    <td class="px-3 py-3 text-end">
                        <button class="btn btn-sm btn-outline-secondary">Manage</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <div class="d-flex flex-column align-items-center">
                            <i class="fas fa-users-slash fs-1 mb-3 opacity-25"></i>
                            <p class="mb-0">No tenants found.</p>
                            <a href="{{ route('super_admin.create_tenant') }}" class="btn btn-link btn-sm text-decoration-none mt-2">Create your first tenant</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
