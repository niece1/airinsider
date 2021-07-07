<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Permission;
use Tests\Traits\AdminUser;
use App\Traits\SyncPermissions;
use App\Models\Role;

class PermissionRoleRelationTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;
    use SyncPermissions;

    /** @test */
    public function permissionRoleManyToManyRelations()
    {
        $this->actingAs($this->createAdminUser());
        $permission = Permission::factory()->create();
        $this->post('/dashboard/roles', [
            'title' => 'Guest',
            'permission_id' => $permission->id,
        ]);
        $role = Role::where('title', 'Guest')->first();
        $role->SyncPermissions($role);
        $this->assertDatabaseHas('permission_role', [
            'role_id' => $role->id,
            'permission_id' => $permission->id,
        ]);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $role->permissions);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $permission->roles);
        $this->assertTrue($role->permissions()->exists());
        $this->assertTrue($permission->roles()->exists());
    }
}
