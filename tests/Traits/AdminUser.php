<?php

namespace Tests\Traits;

use App\User;
use RolesTableSeeder;
use PermissionsTableSeeder;
use PermissionRoleTableSeeder;
use RoleUserTableSeeder;
use App\Traits\DashboardAccess;

trait AdminUser
{
    use DashboardAccess;
    
    public function createAdminUser() 
    {
        $this->seed(PermissionsTableSeeder::class);
        $this->seed(RolesTableSeeder::class);
        factory(User::class)->create();
        $this->seed(PermissionRoleTableSeeder::class);
        $this->seed(RoleUserTableSeeder::class);
        $user = User::findOrFail(1);
        $this->getDashboardAccess();
        return $user;
    }
}
