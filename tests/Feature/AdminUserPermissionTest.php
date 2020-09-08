<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Permission;

class AdminUserPermissionTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createAdminUser());
    }
    
    /** @test */
    public function permission_can_be_added_to_the_table_through_the_form()
    {
        $this->post('/dashboard/permissions', [
            'title' => 'user_edit',
        ])
                ->assertSessionHas('success_message')
                ->assertStatus(302)
                ->assertRedirect('/dashboard/permissions');
        //because 32 permissions generated by default via seed
        $this->assertCount(33, Permission::all());
    }
    
    /** @test */
    public function title_field_is_required()
    {
        $this->post('/dashboard/permissions', [
            'title' => '',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'Данное поле обязательно.');
    }
    
    /** @test */
    public function title_field_should_be_at_least_two_characters()
    {
        $this->post('/dashboard/permissions', [
            'title' => 'u',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'Поле должно быть мин 2 символа(ов).');
    }
    
    /** @test */
    public function title_field_should_be_max_thirty_characters()
    {
        $this->post('/dashboard/permissions', [
            'title' => 'user_access_role_add_permission_delete',
        ])
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'Поле не должно быть больше 30 символа(ов).');
    }
    
    /** @test */
    public function admin_user_can_see_user_page_and_edit_user_button()
    {
        $this->get('/dashboard/users/')
                ->assertStatus(200)
                ->assertSee('User List')
                ->assertSee('Edit');
    }
    
    /** @test */
    public function admin_user_can_see_category_page_and_add_category_button()
    {
        $this->get('/dashboard/categories/')
                ->assertStatus(200)
                ->assertSee('Category List')
                ->assertSee('Add Category');
    }
    
    /** @test */
    public function admin_user_can_see_tag_page_and_add_tag_button()
    {
        $this->get('/dashboard/tags/')
                ->assertStatus(200)
                ->assertSee('Tag List')
                ->assertSee('Add Tag');
    }
    
    /** @test */
    public function admin_user_can_see_permission_page_and_add_permission_button()
    {
        $this->get('/dashboard/permissions/')
                ->assertStatus(200)
                ->assertSee('Permission List')
                ->assertSee('Add Permission');
    }
    
    /** @test */
    public function admin_user_can_see_trash_page()
    {
        $this->get('/dashboard/trashed/')
                ->assertStatus(200)
                ->assertSee('Trashed');
    }
 
    /** @test */
    public function admin_user_can_see_post_page_add_post_button()
    {
        $this->get('/dashboard/posts/')
                ->assertStatus(200)
                ->assertSee('Post List')
                ->assertSee('Add Post');
    }
    
    /** @test */
    public function admin_user_can_see_role_page_and_add_role_button()
    {
        $this->get('/dashboard/roles/')
                ->assertStatus(200)
                ->assertSee('Role List')
                ->assertSee('Add Role');
    }
    
    /** @test */
    public function admin_user_can_see_comments_page()
    {
        $this->get('/dashboard/comments/')
                ->assertStatus(200)
                ->assertSee('Comments List');
    }
    
    /** @test */
    public function admin_user_can_see_subscription_page()
    {
        $this->get('/dashboard/subscriptions/')
                ->assertStatus(200)
                ->assertSee('Subscription List');
    }
}
