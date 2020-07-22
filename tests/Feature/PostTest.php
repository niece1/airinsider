<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Category;
use App\Post;
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
        $response = $this->post('/dashboard/posts', $this->createPostAttributes());
        $response->assertRedirect('/dashboard/posts');
        $this->assertCount(1, Post::all());        
    }

    /** @test */
    public function validation_title_is_required() 
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts',
                array_merge($this->createPostAttributes(), [
            'title' => '',
        ]));
        $response->assertSessionHasErrors('title');
    }
    
    /** @test */
    public function store_post_validation_fails() 
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $this->post('/dashboard/posts', array_merge($this->createPostAttributes(), [
            'title' => 'N',
            'body' => '',
        ]))
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
        $response = $this->post('/dashboard/posts',
                array_merge($this->createPostAttributes(), [
            'title' => 'A',
        ]));
        $response->assertSessionHasErrors('title');
        $this->assertCount(0, Post::all());
    }
    
    /** @test */
    public function validation_a_body_is_required()
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts',
                array_merge($this->createPostAttributes(), [
            'body' => '',
        ]));
        $response->assertSessionHasErrors('body');
        $this->assertCount(0, Post::all());
    }
    
    /** @test */
    public function validation_time_to_read_is_required()
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts',
                array_merge($this->createPostAttributes(), [
            'time_to_read' => '',
        ]));
        $response->assertSessionHasErrors('time_to_read');
        $this->assertCount(0, Post::all());
    }
    
    /** @test */
    public function validation_category_id_is_required()
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $response = $this->post('/dashboard/posts',
                array_merge($this->createPostAttributes(), [
            'category_id' => '',
        ]));
        $response->assertSessionHasErrors('category_id');
        $this->assertCount(0, Post::all());
    }

    /** @test */
    public function store_post_validated_successfully() 
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();       
        $this->post('/dashboard/posts', $this->createPostAttributes())
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
        $response = $this->patch('/dashboard/posts/' . $post->id,
                $this->createPostAttributes())
                ->assertSessionHas('success_message');
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
        $this->assertCount(0, Post::all());
        $this->assertSoftDeleted($post);
    }
    
    private function createPostAttributes()
    {
        return [
            'title' => 'New Title',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
        ];
    }
}
