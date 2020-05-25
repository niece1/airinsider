<?php
namespace App\Traits;

trait SyncRoles
{
    public function syncRoles($user)
    {
        $user->roles()->sync(request('role_id'));
    }
}
