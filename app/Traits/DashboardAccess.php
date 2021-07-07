<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Support\Facades\Gate;

trait DashboardAccess
{
    /**
     * Associate permission to specific role.
     *
     * @return void
     */

    public function getDashboardAccess()
    {
        $roles = Role::with('permissions')->get();
        $permissionsArray = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $permissions) {
                $permissionsArray[$permissions->title][] = $role->id;
            }
        }
        foreach ($permissionsArray as $title => $roles) {
            Gate::define($title, fn (\App\Models\User $user) => count(array_intersect($user->roles->pluck('id')
                    ->toArray(), $roles)) > 0);
        }
    }
}
