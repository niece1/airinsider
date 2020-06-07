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

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function a_post_can_be_added_to_the_table_through_the_form()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('passw'),
        ]));
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts', [
            'title'=> 'New Title',
            'body'=> 'New body',
            'slug'=> 'new-title',
            'time_to_read'=> 1,
            'category_id'=> 1,
        ]);
        $response->assertRedirect('/dashboard/posts');
        $this->assertCount(1, Post::all());
    }
    
    /** @test */
    public function validation_a_title_is_required()
    {
        $this->actingAs(factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('passw'),
        ]));
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts', [
            'title'=> '',
            'body'=> 'New body',
            'slug'=> 'new-title',
            'time_to_read'=> 1,
            'category_id'=> 1,
        ]);
        $response->assertSessionHasErrors('title');
    }
    
    /** @test */
    public function post_validation_a_title_is_at_least_two_characters()
    {
        $this->actingAs(factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('passw'),
        ]));
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts', [
            'title'=> 'A',
            'body'=> 'New body',
            'slug'=> 'new-title',
            'time_to_read'=> 1,
            'category_id'=> 1,
        ]);
        $response->assertSessionHasErrors('title');
        $this->assertCount(0, Post::all());
    }
    
    /** @test */
    public function store_post_validated()
    {       
        $this->actingAs(factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('passw'),
        ]));
        factory(Category::class)->create();
        
        $params = [
            'title'=> 'New title',
            'body'=> 'New body',
            'slug'=> 'new-title',
            'time_to_read'=> 1,
            'category_id'=> 1,
        ];
        
        $this->post('/dashboard/posts', $params)->assertStatus(302)
                ->assertSessionHas('success_message');
        $this->assertEquals(session('success_message'), 'Created Successfully!');
    }
    
    /** @test */
    public function a_post_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('passw'),
        ]));
        factory(Category::class)->create();
        factory(Post::class)->create();
        $post = Post::first();
        $response = $this->patch('/dashboard/posts/' . $post->id, [
            'title'=> 'New Title',
            'body'=> 'New body',
            'slug'=> 'new-title',
            'time_to_read'=> 1,
            'category_id'=> 1,
        ]);
        $this->assertEquals('New Title', Post::first()->title);
        $this->assertEquals('New body', Post::first()->body);
        $response->assertRedirect('/dashboard/posts/');
    }
    
    /** @test */
    public function a_post_can_be_deleted()
    {
        factory(Permission::class)->create([
            'title' => 'post_trash'
        ]);
        factory(Role::class)->create([
            'title' => 'Admin'
        ]);
        $user = factory(User::class)->create();
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        User::findOrFail(1)->roles()->sync(1);
        $this->actingAs($user);
        
        factory(Category::class)->create();
        factory(Post::class)->create();
        $post = Post::first();
        $this->assertCount(1, Post::all());
        $response = $this->delete('/dashboard/posts/' . $post->id);
        $response->assertOk();
        $this->assertCount(0, Post::all());
        $response->assertRedirect('/dashboard/posts/');//
    }
}
