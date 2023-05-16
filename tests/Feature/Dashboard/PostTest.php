<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Models\Category;
use App\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createAdminUser());
        Category::factory()->create();
    }

    /** @test */
    public function aPostCanBeAddedToTheTableThroughTheForm()
    {
        $this->post('/dashboard/posts', $this->createPostAttributes())
                ->assertRedirect('/dashboard/posts');
        $this->assertCount(1, Post::all());
    }

    /** @test */
    public function validationTitleIsRequired()
    {
        $this->post('/dashboard/posts', array_merge($this->createPostAttributes(), [
            'title' => '',
        ]))
                ->assertSessionHasErrors('title');
    }

    /** @test */
    public function storePostValidationFails()
    {
        $this->post('/dashboard/posts', array_merge($this->createPostAttributes(), [
            'title' => 'N',
            'body' => '',
        ]))
                ->assertStatus(302)
                ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'The title must be at least 2 characters.');
        $this->assertEquals($messages['body'][0], 'The body field is required.');
    }

    /** @test */
    public function validationTitleIsAtLeastTwoCharacters()
    {
        $this->post('/dashboard/posts', array_merge($this->createPostAttributes(), [
            'title' => 'A',
        ]))
                ->assertSessionHasErrors('title');
        $this->assertCount(0, Post::all());
    }
    
    /** @test */
    public function validationDescriptionIsRequired()
    {
        $this->post('/dashboard/posts', array_merge($this->createPostAttributes(), [
            'description' => '',
        ]))
                ->assertSessionHasErrors('description');
        $this->assertCount(0, Post::all());
    }

    /** @test */
    public function validationBodyIsRequired()
    {
        $this->post('/dashboard/posts', array_merge($this->createPostAttributes(), [
            'body' => '',
        ]))
                ->assertSessionHasErrors('body');
        $this->assertCount(0, Post::all());
    }

    /** @test */
    public function validationTimeToReadIsRequired()
    {
        $this->post('/dashboard/posts', array_merge($this->createPostAttributes(), [
            'time_to_read' => '',
        ]))
                ->assertSessionHasErrors('time_to_read');
        $this->assertCount(0, Post::all());
    }

    /** @test */
    public function validationCategoryIdIsRequired()
    {
        $this->post('/dashboard/posts', array_merge($this->createPostAttributes(), [
            'category_id' => '',
        ]))
                ->assertSessionHasErrors('category_id');
        $this->assertCount(0, Post::all());
    }
    
    /** @test */
    public function validationPublishTimeIsRequiredIfPublishedStatusTrue()
    {
        $this->post('/dashboard/posts', array_merge($this->createPostAttributes(), [
            'published' => 1,
            'publish_time' => null,
        ]))
                ->assertSessionHasErrors('publish_time');
        $this->assertCount(0, Post::all());
    }
    
    /** @test */
    public function validationPublishTimeIsNotRequiredIfPublishedStatusFalse()
    {
        $this->post('/dashboard/posts', array_merge($this->createPostAttributes(), [
            'published' => 0,
            'publish_time' => null,
        ]))
                ->assertStatus(302)
                ->assertSessionHas('success_message');
        $this->assertEquals(session('success_message'), 'Created Successfully!');
    }

    /** @test */
    public function storePostValidatedSuccessfully()
    {
        $this->post('/dashboard/posts', $this->createPostAttributes())
                ->assertStatus(302)
                ->assertSessionHas('success_message');
        $this->assertEquals(session('success_message'), 'Created Successfully!');
    }

    /** @test */
    public function aPostCanBeUpdated()
    {
        $post = Post::factory()->create();
        $this->patch('/dashboard/posts/' . $post->id, $this->createPostAttributes())
                ->assertSessionHas('success_message')
                ->assertRedirect('/dashboard/posts/');
        $this->assertEquals('New Title', Post::first()->title);
        $this->assertEquals('New body', Post::first()->body);
        $this->assertEquals('New description', Post::first()->description);
        $this->assertEquals(session('success_message'), 'Updated Successfully!');
        $this->assertDatabaseMissing('posts', $post->toArray());
        $this->assertDatabaseHas('posts', ['title' => 'New Title']);
    }

    /** @test */
    public function aPostCanBeTrashed()
    {
        $post = Post::factory()->create();
        $this->assertCount(1, Post::all());
        $this->delete('/dashboard/posts/' . $post->id);
        $this->assertCount(0, Post::all());
        $this->assertSoftDeleted($post);
    }

    /**
     * Creates attributes for Post entity
     *
     * @return array
     */
    private function createPostAttributes()
    {
        return [
            'title' => 'New Title',
            'description' => 'New description',
            'body' => 'New body',
            'time_to_read' => 1,
            'published' => true,
            'category_id' => 1,
            'publish_time' => '2020-05-16 17:09:00'
        ];
    }
}
