<?php

namespace App\Traits;

trait SyncPermissions
{
    /**
     * Synchronize permissions associated with specific role.
     *
     * @param \App\Role $role
     */
    public function syncPermissions($role)
    {
        $role->permissions()->sync(request('permission_id'));
    }
}
