<?php

namespace App\Traits;

use App\Models\User;
use App\Scopes\TenantScope;

trait BelongsToTenant
{

    protected static function bootBelongsToTenant()
    {
        $superAdmin = false;
        if (session()->has('user_id')) {
            $user = User::find(session()->get('user_id'));
            if ($user->hasRole('super-admin')) {
                $superAdmin = true;
            }
        }
        if (!$superAdmin) {
            static::addGlobalScope(new TenantScope);
            static::creating(function ($model) {
                if (session()->has('tenant_id')) {
                    $model->tenant_id = session()->get('tenant_id');
                }
            });
        }
    }


}
