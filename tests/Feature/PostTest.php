<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Category;
use App\Post;
use App\User;
use App\Role;
use App\Permission;
use PermissionRoleTableSeeder;
use RoleUserTableSeeder;
use UsersTableSeeder;
use RolesTableSeeder;
use PermissionsTableSeeder;
use Illuminate\Support\Facades\Gate;

class PostTest extends TestCase {

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function post_can_be_added_to_the_table_through_the_form() {
        $this->actingAs(factory(User::class)->create());
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts', [
            'title' => 'New Title',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
        ]);
        $response->assertRedirect('/dashboard/posts');
        $this->assertCount(1, Post::all());
    }

    /** @test */
    public function validation_a_title_is_required() {
        $this->actingAs(factory(User::class)->create([
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('passw'),
        ]));
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts', [
            'title' => '',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
        ]);
        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function post_validation_a_title_is_at_least_two_characters() {
        $this->actingAs(factory(User::class)->create());
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts', [
            'title' => 'A',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
        ]);
        $response->assertSessionHasErrors('title');
        $this->assertCount(0, Post::all());
    }

    /** @test */
    public function store_post_validated() {
        $this->actingAs(factory(User::class)->create([
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('passw'),
        ]));
        factory(Category::class)->create();

        $params = [
            'title' => 'New title',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
        ];

        $this->post('/dashboard/posts', $params)->assertStatus(302)
                ->assertSessionHas('success_message');
        $this->assertEquals(session('success_message'), 'Created Successfully!');
    }

    /** @test */
    public function a_post_can_be_updated() {
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());
        factory(Category::class)->create();
        factory(Post::class)->create();
        $post = Post::first();
        $response = $this->patch('/dashboard/posts/' . $post->id, [
            'title' => 'New Title',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
        ]);
        $this->assertEquals('New Title', Post::first()->title);
        $this->assertEquals('New body', Post::first()->body);
        $response->assertRedirect('/dashboard/posts/');
    }

    /** @test */
    public function a_post_can_be_deleted()
    {
        $user = $this->create_admin_user();
        $this->actingAs($user);
        $this->assertCount(1, Role::all());
        $this->assertCount(32, Permission::all());
        factory(Category::class)->create();
        factory(Post::class)->create();
        $post = Post::first();
        $this->assertCount(1, Post::all());
        $this->delete('/dashboard/posts/' . $post->id);
        //   $response->assertOk();//use with GET, PUT only
        $this->assertCount(0, Post::all());
        $this->assertSoftDeleted($post);
    }

    /** @test */
    public function admin_can_see_add_post_button() 
    {
        $user = $this->create_admin_user();
        $response = $this->actingAs($user)->get('/dashboard/posts/');
        $response->assertStatus(200);
        $this->assertCount(32, Permission::all());
        $response->assertSee('Post List');
        $response->assertSee('Add Post');
    }

    /** @test */
    public function user_id_added_automatically_while_creating_post() 
    {
        $this->actingAs(factory(User::class)->create());
        factory(Category::class)->create();
        $this->post('/dashboard/posts', [
            'title' => 'New Title',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
            'user_id' => 1,
        ]);
        $user = User::first();
        $post = Post::first();
        $this->assertEquals($user->id, $post->user_id);
        $this->assertCount(1, User::all());
    }

    public function create_admin_user() 
    {
        $this->seed(PermissionsTableSeeder::class);
        $this->seed(RolesTableSeeder::class);
        factory(User::class)->create();
        $this->seed(PermissionRoleTableSeeder::class);
        $this->seed(RoleUserTableSeeder::class);
        $user = User::findOrFail(1);
        $roles = Role::with('permissions')->get();
        $permissionsArray = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $permissions) {
                $permissionsArray[$permissions->title][] = $role->id;
            }
        }
        foreach ($permissionsArray as $title => $roles) {
            Gate::define($title, function (\App\User $user) use ($roles) {
                return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
            });
        }
        return $user;
    }
}
