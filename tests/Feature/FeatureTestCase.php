<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Role;
use PermissionRoleTableSeeder;
use RoleUserTableSeeder;
use RolesTableSeeder;
use PermissionsTableSeeder;
use Illuminate\Support\Facades\Gate;

abstract class FeatureTestCase extends TestCase
{
    public function create_admin_user() 
    {
        $this->seed(PermissionsTableSeeder::class);
        $this->seed(RolesTableSeeder::class);
        factory(User::class)->create();
        $this->seed(PermissionRoleTableSeeder::class);
        $this->seed(RoleUserTableSeeder::class);
        $user = User::findOrFail(1);
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
        return $user;
    }
}
