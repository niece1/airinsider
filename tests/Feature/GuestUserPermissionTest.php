<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\GuestUser;

class GuestUserPermissionTest extends TestCase
{
    use RefreshDatabase, GuestUser;
    
    public function setUp(): void
    {
        parent::setUp();        
        $this->actingAs($this->createGuestUser());
    }
    
    /** @test */
    public function guest_user_can_see_post_page() 
    {     
        $this->get('/dashboard/posts/')
                ->assertStatus(200)
                ->assertSee('Post List');
    }
    
    /** @test */
    public function guest_user_cannot_see_add_post_button() 
    {    
        $this->get('/dashboard/posts/')
                ->assertStatus(200)
                ->assertDontSee('Add Post');
    }
    
    /** @test */
    public function guest_user_cannot_see_role_page() 
    {  
        $this->get('/dashboard/roles/')
                ->assertForbidden();
    }
}
