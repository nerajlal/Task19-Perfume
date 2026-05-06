<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        // Share pending orders count with sidebar
        \Illuminate\Support\Facades\View::composer('admin.partials.sidebar', function ($view) {
            $pendingOrdersCount = \App\Models\Order::where('status', 'pending')->count();
            $view->with('pendingOrdersCount', $pendingOrdersCount);
        });
    }
}
