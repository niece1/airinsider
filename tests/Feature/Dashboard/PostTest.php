<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Category;
use App\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
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
        $this->assertEquals($messages['title'][0], 'Поле должно быть мин 2 символа(ов).');
        $this->assertEquals($messages['body'][0], 'Данное поле обязательно.');
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
        $post = factory(Post::class)->create();
        $this->patch('/dashboard/posts/' . $post->id, $this->createPostAttributes())
                ->assertSessionHas('success_message')
                ->assertRedirect('/dashboard/posts/');
        $this->assertEquals('New Title', Post::first()->title);
        $this->assertEquals('New body', Post::first()->body);
        $this->assertEquals(session('success_message'), 'Updated Successfully!');
        $this->assertDatabaseMissing('posts', $post->toArray());
        $this->assertDatabaseHas('posts', ['title' => 'New Title']);
    }

    /** @test */
    public function aPostCanBeTrashed()
    {
        $post = factory(Post::class)->create();
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
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
        ];
    }
}
