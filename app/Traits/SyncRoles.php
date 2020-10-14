<?php

namespace App\Traits;

trait SyncRoles
{
    /**
     * Synchronize roles associated with specific user.
     *
     * @param \App\User $user
     */
    public function syncRoles($user)
    {
        $user->roles()->sync(request('role_id'));
    }
}
