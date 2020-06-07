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
    public function authenticated_user_can_access_posts_table()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }
    
    public function unauthenticated_user_cannot_access_posts_table()
    {
        
        $response=$this->get('/dashboard/posts');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
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
