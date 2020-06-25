<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_users_cannot_get_dashboard()
    {  
        $response = $this->get('/dashboard/posts');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    
    /** @test */
    public function authenticated_users_without_role_cannot_get_dashboard()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/dashboard/posts');
        $response->assertForbidden();
    }
    
    /** @test */
    public function authenticated_users_without_role_cannot_see_link_dashboard()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/');
        $response->assertDontSee('Dashboard');
        $response->assertSee('Выйти');
    }
    
    /** @test */
    public function login_redirects_successfully()
    {
        $this->actingAs(factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('passw'),
        ]));
        $response=$this->get('/login', ['email'=>'admin@admin.com', 'password'=>'passw']);        
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
    
    /** @test */
    public function a_user_can_be_added_through_register_form()
    {
        $response = $this->post('/register', [
            'name' => 'Anna',
            'email' => 'anna@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        $response->assertRedirect('/');
        $this->assertCount(1, User::all());
    }
    
    /** @test */
    public function email_is_required_while_registering_through_the_form()
    {
        $response = $this->post('/register', [
            'name' => 'Anna',
            'email' => '',
            'password' => 'passw',
            'password_confirmation' => 'passw',
        ]);
        $response->assertSessionHasErrors('email');
        $this->assertCount(0, User::all());
    }
    
    /** @test */
    public function password_is_required_while_registering_through_the_form()
    {
        $response = $this->post('/register', [
            'name' => 'Anna',
            'email' => 'anna@gmail.com',
            'password' => '',
        ]);
        $response->assertSessionHasErrors('password');
        $this->assertCount(0, User::all());
    }
    
    /** @test */
    public function one_cannot_register_without_password_confirmation()
    {
        $response = $this->post('/register', [
            'name' => 'Anna',
            'email' => 'anna@gmail.com',
            'password' => 'passw',
            'password_confirmation' => '',
        ]);
        $response->assertSessionHasErrors('password');
        $this->assertCount(0, User::all());
    }
}
