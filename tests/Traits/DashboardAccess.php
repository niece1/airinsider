<?php

namespace Tests\Traits;

use App\User;
use App\Role;
use App\Permission;
use PermissionRoleTableSeeder;
use RoleUserTableSeeder;
use RolesTableSeeder;
use PermissionsTableSeeder;
use Illuminate\Support\Facades\Gate;

trait DashboardAccess
{
    public function create_admin_user() 
    {
        $this->seed(PermissionsTableSeeder::class);
        $this->seed(RolesTableSeeder::class);
        factory(User::class)->create();
        $this->seed(PermissionRoleTableSeeder::class);
        $this->seed(RoleUserTableSeeder::class);
        $user = User::findOrFail(1);
        $this->createMiddleware();
        return $user;
    }
    
    public function create_guest_user() 
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
        $this->createMiddleware();
        return $user;
    }
    
    private function createMiddleware()
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
