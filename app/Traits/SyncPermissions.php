<?php

namespace App\Traits;

trait SyncPermissions
{
    public function syncPermissions($role)
    {
       $role->permissions()->sync(request('permission_id'));
    }
}
