<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\GuestUser;

class GuestUserPermissionTest extends TestCase
{
    use RefreshDatabase;
    use GuestUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createGuestUser());
    }

    /** @test */
    public function guestUserCanSeePostPage()
    {
        $this->get('/dashboard/posts/')
                ->assertStatus(200)
                ->assertSee('Post List');
    }

    /** @test */
    public function guestUserCannotSeeAddPostButton()
    {
        $this->get('/dashboard/posts/')
                ->assertStatus(200)
                ->assertDontSee('Add Post');
    }

    /** @test */
    public function guestUserCannotSeeRolePage()
    {
        $this->get('/dashboard/roles/')
                ->assertForbidden();
    }
}
