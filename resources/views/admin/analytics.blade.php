@extends('layouts.admin')

@section('title', 'Analytics')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-dark">Analytics</h1>
    <div class="dropdown">
        <div class="d-flex align-items-center gap-2 border rounded bg-white px-3 py-1 shadow-sm text-sm cursor-pointer hover-bg-light dropdown-toggle" data-bs-toggle="dropdown">
            <i class="far fa-calendar text-secondary"></i>
            <span class="text-dark">{{ $periodLabel }}</span>
        </div>
        <ul class="dropdown-menu shadow-sm border-0 dropdown-menu-end">
            <li><a class="dropdown-item small {{ $period == '7_days' ? 'active bg-light text-dark fw-bold' : '' }}" href="{{ route('admin.analytics', ['period' => '7_days']) }}">Last 7 days</a></li>
            <li><a class="dropdown-item small {{ $period == '30_days' ? 'active bg-light text-dark fw-bold' : '' }}" href="{{ route('admin.analytics', ['period' => '30_days']) }}">Last 30 days</a></li>
            <li><a class="dropdown-item small {{ $period == '90_days' ? 'active bg-light text-dark fw-bold' : '' }}" href="{{ route('admin.analytics', ['period' => '90_days']) }}">Last 90 days</a></li>
            <li><a class="dropdown-item small {{ $period == 'year' ? 'active bg-light text-dark fw-bold' : '' }}" href="{{ route('admin.analytics', ['period' => 'year']) }}">Last Year</a></li>
        </ul>
    </div>
</div>

<!-- Key Metrics (Normal) -->
<div class="row g-3 mb-4">
    <!-- Total Sales -->
    <div class="col-12 col-md-6 col-lg-3">
        <a href="{{ route('admin.analytics.show', 'sales') }}" class="card border shadow-sm p-3 text-decoration-none h-100 hover-shadow transition-base">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3 class="h6 text-muted text-uppercase small fw-bold mb-0">Total Sales</h3>
            </div>
            <div class="h3 fw-bold text-dark mb-1">₹{{ number_format($totalSales, 2) }}</div>
            <div class="small {{ $salesGrowth >= 0 ? 'text-success' : 'text-danger' }} fw-medium">
                 <i class="fas fa-arrow-{{ $salesGrowth >= 0 ? 'up' : 'down' }} me-1"></i> {{ number_format(abs($salesGrowth), 1) }}%
            </div>
            <div class="progress mt-3" style="height: 4px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%"></div>
            </div>
        </a>
    </div>

    <!-- Total Orders -->
    <div class="col-12 col-md-6 col-lg-3">
        <a href="{{ route('admin.analytics.show', 'orders') }}" class="card border shadow-sm p-3 text-decoration-none h-100 hover-shadow transition-base">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3 class="h6 text-muted text-uppercase small fw-bold mb-0">Total Orders</h3>
            </div>
            <div class="h3 fw-bold text-dark mb-1">{{ number_format($totalOrders) }}</div>
            <div class="small {{ $ordersGrowth >= 0 ? 'text-success' : 'text-danger' }} fw-medium">
                 <i class="fas fa-arrow-{{ $ordersGrowth >= 0 ? 'up' : 'down' }} me-1"></i> {{ number_format(abs($ordersGrowth), 1) }}%
            </div>
             <div class="progress mt-3" style="height: 4px;">
                <div class="progress-bar bg-purple" role="progressbar" style="width: 55%"></div>
            </div>
        </a>
    </div>

    <!-- Average Order Value -->
    <div class="col-12 col-md-6 col-lg-3">
        <a href="{{ route('admin.analytics.show', 'aov') }}" class="card border shadow-sm p-3 text-decoration-none h-100 hover-shadow transition-base">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3 class="h6 text-muted text-uppercase small fw-bold mb-0">Avg. Order Value</h3>
            </div>
            <div class="h3 fw-bold text-dark mb-1">₹{{ number_format($avgOrderValue, 2) }}</div>
            <div class="small {{ $aovGrowth >= 0 ? 'text-success' : 'text-danger' }} fw-medium">
                 <i class="fas fa-arrow-{{ $aovGrowth >= 0 ? 'up' : 'down' }} me-1"></i> {{ number_format(abs($aovGrowth), 1) }}%
            </div>
             <div class="progress mt-3" style="height: 4px;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"></div>
            </div>
        </a>
    </div>

    <!-- Online Store Sessions (Static for now) -->
    <div class="col-12 col-md-6 col-lg-3">
        <a href="{{ route('admin.analytics.show', 'sessions') }}" class="card border shadow-sm p-3 text-decoration-none h-100 hover-shadow transition-base">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3 class="h6 text-muted text-uppercase small fw-bold mb-0">Sessions</h3>
            </div>
            <div class="h3 fw-bold text-dark mb-1">--</div>
            <div class="small text-muted fw-medium">
                 Not tracked
            </div>
             <div class="progress mt-3" style="height: 4px;">
                <div class="progress-bar bg-indigo" role="progressbar" style="width: 0%"></div>
            </div>
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    
    <!-- Top Products -->
    <div class="col-12 col-lg-8">
        <div class="card border shadow-sm">
            <div class="card-header bg-light border-bottom p-3 d-flex justify-content-between align-items-center">
                <h3 class="h6 fw-semibold text-secondary mb-0">Top Selling Products</h3>
                <span class="small text-muted">Last 30 days</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-uppercase small fw-medium text-muted border-bottom">
                        <tr>
                            <th class="px-3 py-3">Product</th>
                            <th class="px-3 py-3 text-end">Units Sold</th>
                            <th class="px-3 py-3 text-end">Revenue</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($topProducts as $product)
                        <tr>
                            <td class="px-3 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex align-items-center justify-content-center bg-light border rounded" style="width: 40px; height: 40px; overflow:hidden;">
                                        @if($product->product && $product->product->main_image_url)
                                            <img src="{{ $product->product->main_image_url }}" alt="{{ $product->name }}" style="width:100%; height:100%; object-fit:cover;">
                                        @else
                                            <i class="fas fa-image text-secondary opacity-50"></i>
                                        @endif
                                    </div>
                                    <span class="fw-medium text-dark">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-3 py-3 text-end text-secondary">{{ $product->total_qty }}</td>
                            <td class="px-3 py-3 text-end fw-medium text-dark">₹{{ number_format($product->total_revenue, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">No sales data found for this period.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- <div class="card-footer bg-white border-top p-2 text-center">
                 <a href="{{ route('admin.products', ['sort' => 'best_selling']) }}" class="small text-decoration-none">View all products</a>
            </div> -->
        </div>
    </div>

    <!-- Sales by Location (New Pro) -->
    <div class="col-12 col-lg-4">
        <div class="card border shadow-sm p-3 h-100 position-relative overflow-hidden">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h6 fw-semibold text-secondary mb-0">Sales by Location</h3>
                <i class="fas fa-crown text-warning small" title="Pro Feature"></i>
            </div>
            
            <!-- Blurred Content -->
            <div class="opacity-50 user-select-none" style="filter: blur(4px);">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="small text-secondary">Mumbai</span>
                    <div class="progress w-50" style="height: 8px;"><div class="progress-bar bg-primary" role="progressbar" style="width: 80%"></div></div>
                    <span class="small fw-medium">₹12.5k</span>
                </div>
                 <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="small text-secondary">Delhi</span>
                     <div class="progress w-50" style="height: 8px;"><div class="progress-bar bg-primary" role="progressbar" style="width: 65%"></div></div>
                    <span class="small fw-medium">₹8.2k</span>
                </div>
                 <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="small text-secondary">Bangalore</span>
                     <div class="progress w-50" style="height: 8px;"><div class="progress-bar bg-primary" role="progressbar" style="width: 45%"></div></div>
                    <span class="small fw-medium">₹5.1k</span>
                </div>
                 <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="small text-secondary">Chennai</span>
                     <div class="progress w-50" style="height: 8px;"><div class="progress-bar bg-primary" role="progressbar" style="width: 30%"></div></div>
                    <span class="small fw-medium">₹3.4k</span>
                </div>
            </div>

            <!-- Lock Overlay -->
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center z-10">
                <div class="bg-white bg-opacity-75 p-2 rounded-circle shadow-sm border mb-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-lock text-secondary opacity-50"></i>
                </div>
                <span class="badge bg-white bg-opacity-90 text-secondary border shadow-sm fw-semibold">Upgrade to Pro</span>
            </div>
        </div>
    </div>

</div>

<!-- Pro Features Row -->
<div class="row g-3">

    <!-- Sessions by Device (Pro) -->
     <div class="col-12 col-md-4">
        <div class="card border shadow-sm p-3 position-relative overflow-hidden">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h6 fw-semibold text-secondary mb-0">Sessions by Device</h3>
                <i class="fas fa-crown text-warning small" title="Pro Feature"></i>
            </div>
            <div class="opacity-50 user-select-none" style="filter: blur(8px);">
                <div class="d-flex align-items-center justify-content-center py-4 position-relative">
                    <div class="rounded-circle border border-5 border-primary" style="width: 96px; height: 96px; border-right-color: #dc3545 !important; transform: rotate(45deg);"></div>
                </div>
            </div>
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center z-10">
                 <div class="bg-white bg-opacity-75 p-2 rounded-circle shadow-sm border mb-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-lock text-secondary opacity-50"></i>
                </div>
                <span class="badge bg-white bg-opacity-90 text-secondary border shadow-sm fw-semibold">Upgrade to Pro</span>
            </div>
        </div>
    </div>

    <!-- Returning Customer Rate (Pro) -->
    <div class="col-12 col-md-4">
        <div class="card border shadow-sm p-3 position-relative overflow-hidden">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h6 fw-semibold text-secondary mb-0">Retention Rate</h3>
                <i class="fas fa-crown text-warning small" title="Pro Feature"></i>
            </div>
            <div class="opacity-50 user-select-none" style="filter: blur(8px);">
                 <div class="h3 fw-bold text-dark mb-2">15.45%</div>
                 <div class="bg-light rounded w-100" style="height: 100px;"></div>
            </div>
             <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center z-10">
                 <div class="bg-white bg-opacity-75 p-2 rounded-circle shadow-sm border mb-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-lock text-secondary opacity-50"></i>
                </div>
                <span class="badge bg-white bg-opacity-90 text-secondary border shadow-sm fw-semibold">Upgrade to Pro</span>
            </div>
        </div>
    </div>

    <!-- Profit Margin (New Pro) -->
    <div class="col-12 col-md-4">
        <div class="card border shadow-sm p-3 position-relative overflow-hidden">
            <div class="d-flex justify-content-between align-items-center mb-3">
                 <h3 class="h6 fw-semibold text-secondary mb-0">Profit Margin</h3>
                <i class="fas fa-crown text-warning small" title="Pro Feature"></i>
            </div>
            <div class="opacity-50 user-select-none" style="filter: blur(8px);">
                 <div class="h3 fw-bold text-dark mb-2">22.1%</div>
                 <div class="bg-light rounded w-100" style="height: 100px;"></div>
            </div>
             <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center z-10">
                 <div class="bg-white bg-opacity-75 p-2 rounded-circle shadow-sm border mb-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fas fa-lock text-secondary opacity-50"></i>
                </div>
                <span class="badge bg-white bg-opacity-90 text-secondary border shadow-sm fw-semibold">Upgrade to Pro</span>
            </div>
        </div>
    </div>

</div>
<style>
    .bg-purple { background-color: #a855f7 !important; }
    .bg-indigo { background-color: #6366f1 !important; }
    .bg-orange { background-color: #f97316 !important; }
    .hover-shadow:hover { box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
    .transition-base { transition: all .3s ease; }
    .hover-bg-light:hover { background-color: var(--bs-light) !important; }
</style>
@endsection
