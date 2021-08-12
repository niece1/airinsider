<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function unauthenticatedUsersCannotGetDashboard()
    {
        $this->get('/dashboard/posts')
                ->assertStatus(302)
                ->assertRedirect('/login');
    }

    /** @test */
    public function authenticatedUsersWithoutRoleCannotGetDashboard()
    {
        $this->actingAs($this->user);
        $this->get('/dashboard/posts')->assertForbidden();
    }

    /** @test */
    public function authenticatedUsersWithoutRoleCannotSeeDashboardLink()
    {
        $this->actingAs($this->user);
        $this->get('/')
                ->assertDontSee('Dashboard')
                ->assertSee('Logout');
    }

    /** @test */
    public function loginRedirectsSuccessfully()
    {
        $this->actingAs(User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('passw'),
        ]));
        $this->get('/login', ['email' => 'admin@admin.com', 'password' => 'passw'])
                ->assertStatus(302)
                ->assertRedirect('/');
    }

    /** @test */
    public function aUserCanBeAddedThroughRegisterForm()
    {
        $this->post('/register', $this->createUserAttributes())
                ->assertRedirect('/');
        $this->assertCount(2, User::all());
    }

    /** @test */
    public function emailIsRequiredWhileRegisteringThroughTheForm()
    {
        $this->post('/register', array_merge($this->createUserAttributes(), [
            'email' => '',
        ]))
                ->assertSessionHasErrors('email');
        $this->assertCount(1, User::all());
    }

    /** @test */
    public function passwordIsRequiredWhileRegisteringThroughTheForm()
    {
        $this->post('/register', array_merge($this->createUserAttributes(), [
            'password' => '',
        ]))
                ->assertSessionHasErrors('password');
        $this->assertCount(1, User::all());
    }

    /** @test */
    public function oneCannotRegisterWithoutPasswordConfirmation()
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
