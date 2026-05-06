@extends('layouts.admin')

@section('title', 'Bundles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-dark">Bundles</h1>
    <a href="{{ route('admin.bundles.create') }}" class="btn btn-success shadow-sm">Create bundle</a>
</div>

<div class="card border shadow-sm">
    <div class="card-header bg-light border-bottom p-3">
        <div class="d-flex gap-3">
            <div class="flex-grow-1">
                 <form action="{{ route('admin.bundles') }}" method="GET">
                     @foreach(request()->except(['search', 'page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                     @endforeach
                     <div class="input-group shadow-sm">
                         <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                         <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0 ps-0 shadow-none" placeholder="Filter bundles">
                     </div>
                 </form>
            </div>
            
            <!-- Status Filter -->
            <div class="dropdown">
                <button class="btn btn-white border shadow-sm text-secondary bg-white dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-2"></i> {{ request('status') ? ucfirst(request('status')) : 'All Status' }}
                </button>
                <ul class="dropdown-menu shadow-sm border-0">
                    <li><a class="dropdown-item small {{ !request('status') ? 'active bg-light text-dark fw-bold' : '' }}" href="{{ route('admin.bundles', array_merge(request()->query(), ['status' => null, 'page' => 1])) }}">All Status</a></li>
                    <li><a class="dropdown-item small {{ request('status') == 'active' ? 'active bg-light text-dark fw-bold' : '' }}" href="{{ route('admin.bundles', array_merge(request()->query(), ['status' => 'active', 'page' => 1])) }}">Active</a></li>
                    <li><a class="dropdown-item small {{ request('status') == 'draft' ? 'active bg-light text-dark fw-bold' : '' }}" href="{{ route('admin.bundles', array_merge(request()->query(), ['status' => 'draft', 'page' => 1])) }}">Draft</a></li>
                </ul>
            </div>

            <!-- Sort Dropdown -->
            <div class="dropdown">
                <button class="btn btn-white border shadow-sm text-secondary bg-white dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-sort me-2"></i> Sort
                </button>
                <ul class="dropdown-menu shadow-sm border-0 dropdown-menu-end">
                    <li><a class="dropdown-item small {{ !request('sort') || request('sort') == 'newest' ? 'active bg-light text-dark fw-bold' : '' }}" href="{{ route('admin.bundles', array_merge(request()->query(), ['sort' => 'newest', 'page' => 1])) }}">Newest First</a></li>
                    <li><a class="dropdown-item small {{ request('sort') == 'oldest' ? 'active bg-light text-dark fw-bold' : '' }}" href="{{ route('admin.bundles', array_merge(request()->query(), ['sort' => 'oldest', 'page' => 1])) }}">Oldest First</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item small {{ request('sort') == 'title_asc' ? 'active bg-light text-dark fw-bold' : '' }}" href="{{ route('admin.bundles', array_merge(request()->query(), ['sort' => 'title_asc', 'page' => 1])) }}">Title (A-Z)</a></li>
                    <li><a class="dropdown-item small {{ request('sort') == 'title_desc' ? 'active bg-light text-dark fw-bold' : '' }}" href="{{ route('admin.bundles', array_merge(request()->query(), ['sort' => 'title_desc', 'page' => 1])) }}">Title (Z-A)</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 text-secondary">
            <thead class="bg-light text-uppercase small fw-medium text-muted">
                 <tr>
                    <th class="px-3 py-3" style="width: 50px;"><div class="form-check"><input type="checkbox" class="form-check-input"></div></th>
                    <th class="px-3 py-3">Title</th>
                    <th class="px-3 py-3">Status</th>
                    <th class="px-3 py-3">Price</th>
                    <th class="px-3 py-3">Products</th>
                    <th class="px-3 py-3">Total Sales</th>
                    <th class="px-3 py-3" style="width: 80px;"></th>
                 </tr>
            </thead>
            <tbody class="border-top-0" id="bundles-table-body">
                @include('admin.bundles.partials.table')
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search"]');
        const tableBody = document.getElementById('bundles-table-body');
        let debounceTimer;

        searchInput.addEventListener('input', function(e) {
            clearTimeout(debounceTimer);
            const query = e.target.value;
            
            // Update URL without reloading
            const url = new URL(window.location.href);
            if (query) {
                url.searchParams.set('search', query);
            } else {
                url.searchParams.delete('search');
            }
            url.searchParams.set('page', 1);
            window.history.pushState({}, '', url);

            debounceTimer = setTimeout(() => {
                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    tableBody.innerHTML = html;
                })
                .catch(error => console.error('Error:', error));
            }, 300);
        });
    });
</script>
<style>
    .text-decoration-hover-underline:hover { text-decoration: underline !important; }
    .hover-text-primary:hover { color: #008060 !important; }
    .hover-text-danger:hover { color: var(--bs-danger) !important; }

    /* Pagination Overrides */
    .page-link {
        color: #008060;
        border-color: #dee2e6;
    }
    .page-link:hover {
        color: #004d3a;
        background-color: #e6f2f0;
        border-color: #dee2e6;
    }
    .page-item.active .page-link {
        background-color: #008060;
        border-color: #008060;
        color: white;
    }
    .page-item.disabled .page-link {
        color: #6c757d;
    }
</style>
@endsection
