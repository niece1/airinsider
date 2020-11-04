<?php

namespace Tests\Traits;

use App\User;
use App\Role;
use App\Permission;
use PermissionRoleTableSeeder;
use RoleUserTableSeeder;
use App\Traits\DashboardAccess;

trait GuestUser
{
    use DashboardAccess;

    public function createGuestUser()
    {
        factory(Permission::class)->create([
            'title' => 'dashboard_access',
        ]);
        factory(Role::class)->create([
            'title' => 'Guest',
        ]);
        factory(User::class)->create();
        $this->seed(PermissionRoleTableSeeder::class);
        $this->seed(RoleUserTableSeeder::class);
        $user = User::findOrFail(1);
        $this->getDashboardAccess();
        return $user;
    }
}
