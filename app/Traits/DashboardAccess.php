<?php

namespace App\Traits;

use App\Role;
use Illuminate\Support\Facades\Gate;

trait DashboardAccess
{
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
            Gate::define($title, function (\App\User $user) use ($roles) {
                return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
            });
        }
    }
}
