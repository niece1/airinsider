<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function unauthenticated_users_cannot_get_dashboard()
    {
        $this->get('/dashboard/posts')
                ->assertStatus(302)
                ->assertRedirect('/login');
    }
    
    /** @test */
    public function authenticated_users_without_role_cannot_get_dashboard()
    {
        $this->actingAs($this->user);
        $this->get('/dashboard/posts')->assertForbidden();
    }
    
    /** @test */
    public function authenticated_users_without_role_cannot_see_link_dashboard()
    {
        $this->actingAs($this->user);
        $this->get('/')
                ->assertDontSee('Dashboard')
                ->assertSee('Выйти');
    }
    
    /** @test */
    public function login_redirects_successfully()
    {
        $this->actingAs(factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('passw'),
        ]));
        $this->get('/login', ['email' => 'admin@admin.com', 'password' => 'passw'])
                ->assertStatus(302)
                ->assertRedirect('/');
    }
    
    /** @test */
    public function a_user_can_be_added_through_register_form()
    {
        $this->post('/register', $this->createUserAttributes())
                ->assertRedirect('/');
        $this->assertCount(2, User::all());
    }
    
    /** @test */
    public function email_is_required_while_registering_through_the_form()
    {
        $this->post('/register', array_merge($this->createUserAttributes(), [
            'email' => '',
        ]))
                ->assertSessionHasErrors('email');
        $this->assertCount(1, User::all());
    }
    
    /** @test */
    public function password_is_required_while_registering_through_the_form()
    {
        $this->post('/register', array_merge($this->createUserAttributes(), [
            'password' => '',
        ]))
                ->assertSessionHasErrors('password');
        $this->assertCount(1, User::all());
    }
    
    /** @test */
    public function one_cannot_register_without_password_confirmation()
    {
        $this->post('/register', array_merge($this->createUserAttributes(), [
            'password_confirmation' => '',
        ]))
                ->assertSessionHasErrors('password');
        $this->assertCount(1, User::all());
    }
    
    /**
     * Creates attributes for User entity
     *
     * @return array
     */
    private function createUserAttributes()
    {
        return [
            'name' => 'Anna',
            'email' => 'anna@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
    }
}
