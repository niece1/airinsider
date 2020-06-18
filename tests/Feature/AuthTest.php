<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */      
    
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
        $response->assertSee('Logout');
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
}
