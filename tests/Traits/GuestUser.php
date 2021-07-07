<?php

namespace Tests\Traits;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use PermissionRoleSeeder;
use RoleUserSeeder;
use App\Traits\DashboardAccess;

trait GuestUser
{
    use DashboardAccess;

    public function createGuestUser()
    {
        Permission::factory()->create([
            'title' => 'dashboard_access',
        ]);
        Role::factory()->create([
            'title' => 'Guest',
        ]);
        User::factory()->create();
        $this->seed(PermissionRoleSeeder::class);
        $this->seed(RoleUserSeeder::class);
        $user = User::findOrFail(1);
        $this->getDashboardAccess();
        return $user;
    }
}
