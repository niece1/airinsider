<?php

namespace Tests\Traits;

use App\Models\User;
use RoleSeeder;
use PermissionSeeder;
use PermissionRoleSeeder;
use RoleUserSeeder;
use App\Traits\DashboardAccess;

trait AdminUser
{
    use DashboardAccess;

    public function createAdminUser()
    {
        $this->seed(PermissionSeeder::class);
        $this->seed(RoleSeeder::class);
        User::factory()->create();
        $this->seed(PermissionRoleSeeder::class);
        $this->seed(RoleUserSeeder::class);
        $user = User::findOrFail(1);
        $this->getDashboardAccess();
        return $user;
    }
}
