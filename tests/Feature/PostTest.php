<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Category;
use App\Post;
use App\User;
use App\Role;
use App\Permission;

class PostTest extends TestCase
{
    use RefreshDatabase, AdminUser;

    /** @test */
    public function a_post_can_be_added_to_the_table_through_the_form()
    {
        $this->actingAs($this->createAdminUser());
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
    public function validation_title_is_required() 
    {
        $this->actingAs($this->createAdminUser());
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
    public function store_post_validation_fails() 
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $params = [
            'title' => 'N',
            'body' => '',
            'time_to_read' => 1,
            'category_id' => 1,
        ];
        $this->post('/dashboard/posts', $params)
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'Поле должно быть мин 2 символа(ов).');
        $this->assertEquals($messages['body'][0], 'Данное поле обязательно.');
    }

    /** @test */
    public function validation_title_is_at_least_two_characters() 
    {
        $this->actingAs($this->createAdminUser());
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
    public function validation_a_body_is_required()
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts', [
            'title' => 'New title',
            'body' => '',
            'time_to_read' => 1,
            'category_id' => 1,
        ]);
        $response->assertSessionHasErrors('body');
        $this->assertCount(0, Post::all());
    }
    
    /** @test */
    public function validation_time_to_read_is_required()
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts', [
            'title' => 'New title',
            'body' => 'New body',
            'time_to_read' => '',
            'category_id' => 1,
        ]);
        $response->assertSessionHasErrors('time_to_read');
        $this->assertCount(0, Post::all());
    }
    
    /** @test */
    public function validation_category_id_is_required()
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts', [
            'title' => 'New title',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => '',
        ]);
        $response->assertSessionHasErrors('category_id');
        $this->assertCount(0, Post::all());
    }

    /** @test */
    public function store_post_validated_successfully() 
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $params = [
            'title' => 'New title',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
        ];
        $this->post('/dashboard/posts', $params)
                ->assertStatus(302)
                ->assertSessionHas('success_message');
        $this->assertEquals(session('success_message'), 'Created Successfully!');
    }

    /** @test */
    public function a_post_can_be_updated() 
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        factory(Post::class)->create();
        $post = Post::first();
        $response = $this->patch('/dashboard/posts/' . $post->id, [
            'title' => 'New Title',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
        ])->assertSessionHas('success_message');
        $this->assertEquals('New Title', Post::first()->title);
        $this->assertEquals('New body', Post::first()->body);
        $this->assertEquals(session('success_message'), 'Updated Successfully!');
        $this->assertDatabaseMissing('posts', $post->toArray());
        $this->assertDatabaseHas('posts', ['title' => 'New Title']);
        $response->assertRedirect('/dashboard/posts/');
    }

    /** @test */
    public function a_post_can_be_trashed()
    {
        $this->actingAs($this->createAdminUser());
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
    public function user_id_added_automatically_while_creating_post() 
    {
        $this->actingAs($this->createAdminUser());
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
}
