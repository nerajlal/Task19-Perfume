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
        // Prevent infinite recursion when loading the authenticated user
        if ($model instanceof \App\Models\User) {
            return;
        }

        if (auth()->check()) {
            $user = auth()->user();
            
            // Super admins see everything
            if ($user->type === 'super_admin') {
                return;
            }

            // For customers, if they don't have a tenant_id, default to the main store (Tenant 1)
            // This ensures they see products and categories upon registration
            $tenantId = $user->tenant_id ?? 1;
            
            $builder->where($model->getTable() . '.tenant_id', $tenantId);
        }
    }
}
