<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\AdminUser;
use App\User;
use App\Role;
use App\Permission;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createAdminUser());
    }

    /** @test */
    public function generationAdminUserViaSeedsWorksCorrectly()
    {
        $this->assertCount(1, Role::all());
        $this->assertCount(1, User::all());
        $this->assertCount(32, Permission::all());
    }

    /** @test */
    public function aRoleCanBeAddedToTheTableThroughTheForm()
    {
        $this->post('/dashboard/roles', ['title' => 'Moderator',])
                ->assertSessionHas('success_message')
                ->assertStatus(302)
                ->assertRedirect('/dashboard/roles');
        //because Admin role generated by default via seed
        $this->assertCount(2, Role::all());
    }

    /** @test */
    public function validationTitleIsAtLeastTwoCharacters()
    {
        $this->post('/dashboard/roles', ['title' => 'A',])
                ->assertSessionHasErrors('title');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'Поле должно быть мин 2 символа(ов).');
        $this->assertCount(1, Role::all());
    }

    /** @test */
    public function validationTitleIsRequired()
    {
        $this->post('/dashboard/roles', ['title' => '',])
                ->assertSessionHasErrors('title');
        $this->assertCount(1, Role::all());
    }

    /** @test */
    public function validationTitleShouldBeMax30Characters()
    {
        $this->post('/dashboard/roles', [
            'title' => 'Quaerat qui fuga minima sunt voluptatem id',
            ])
                ->assertSessionHasErrors('title');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'Поле не должно быть больше 30 символа(ов).');
        $this->assertCount(1, Role::all());
    }

    /** @test */
    public function aRoleCanBeUpdated()
    {
        $role = factory(Role::class)->create();
        $this->patch('/dashboard/roles/' . $role->id, ['title' => 'Guest',])
                ->assertSessionHas('success_message')
                ->assertRedirect('/dashboard/roles/');
        $this->assertEquals(session('success_message'), 'Role Updated Successfully!');
        $this->assertDatabaseMissing('roles', $role->toArray());
        $this->assertDatabaseHas('roles', ['title' => 'Guest']);
    }

    /** @test */
    public function aRoleCanBeDeleted()
    {
        $role = factory(Role::class)->create();
        $this->assertCount(2, Role::all());
        $this->delete('/dashboard/roles/' . $role->id);
        $this->assertCount(1, Role::all());
        $this->assertDeleted($role);
    }
}
