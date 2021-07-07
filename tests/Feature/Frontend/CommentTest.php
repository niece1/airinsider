<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        $this->category = Category::factory()->create();
        $this->post = Post::factory()->create([
            'title' => 'First post',
            'slug' => 'first-post',
        ]);
    }

    /** @test */
    public function authUsersCanPostAComment()
    {
        $this->post('/comments/' . $this->post->id, $this->createCommentAttributes());
        $this->assertCount(1, Comment::all());
    }

    /** @test */
    public function unauthenticatedUsersCannotSeeACommentForm()
    {
        $this->get('/post/first-post')->assertDontSee('Ваш комментарий');
    }

    /** @test */
    public function toPostACommentBodyShouldBeAtLeastTwoCharacters()
    {
        $this->post('/comments/' . $this->post->id, array_merge($this->createCommentAttributes(), [
                    'body' => 'V',
                ]))
                ->assertSessionHas('errors');
        $this->assertCount(0, Comment::all());
    }

    /** @test */
    public function authenticatedUsersCanPostACommentReply()
    {
        $comment = Comment::factory()->create();
        $this->post('/comments/' . $this->post->id, array_merge($this->createCommentAttributes(), [
                    'comment_id' => $comment->id,
                ]));
        $this->assertDatabaseCount('comments', 2);
        $this->assertDatabaseHas('comments', ['comment_id' => $comment->id]);
    }

    /**
     * Creates attributes for Comment entity
     *
     * @return array
     */
    private function createCommentAttributes()
    {
        return [
            'body' => 'Very interesting post!',
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
        ];
    }
}
