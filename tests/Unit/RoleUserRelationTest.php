<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Tests\Traits\AdminUser;
use App\Traits\SyncRoles;
use App\Models\Role;

class RoleUserRelationTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;
    use SyncRoles;

    /** @test */
    public function roleUserManyToManyRelations()
    {
        $this->actingAs($this->createAdminUser());
        $role = Role::factory()->create();
        $user = User::factory()->create();
        $this->patch('/dashboard/users/' . $user->id, [
            'role_id' => $role->id,
        ]);
        $user->SyncRoles($user);
        $this->assertDatabaseHas('role_user', [
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $role->users);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->roles);
        $this->assertTrue($role->users()->exists());
        $this->assertTrue($user->roles()->exists());
    }
}
