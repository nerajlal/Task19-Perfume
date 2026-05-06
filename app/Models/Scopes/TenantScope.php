<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->tenant_id) {
                $builder->where('tenant_id', $user->tenant_id);
            } else {
                 // If no tenant_id (e.g. Super Admin), maybe show all?
                 // Or maybe Super Admin has their own data (tenant_id = null)?
                 // For now, let's assume NULL tenant_id means "System/Global" or "Super Admin's Own".
                 // But realistically Super Admin wants to see specific tenant data. 
                 // We will skip filtering for Super Admin to let them see everything, OR filter by NULL.
                 // Let's filter by NULL for consistency unless they are viewing "All".
                 // Actually, usually Super Admin wants to see everything.
                 if ($user->type === 'super_admin') {
                     // Do nothing, show all?
                 } else {
                     $builder->whereNull('tenant_id');
                 }
            }
        }
    }
}
