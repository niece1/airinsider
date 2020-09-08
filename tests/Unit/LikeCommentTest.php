<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Category;
use App\Post;
use App\User;
use App\Like;
use App\Comment;

class LikeCommentTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->category = factory(Category::class)->create();
        $this->post = factory(Post::class)->create();
        $this->comment = factory(Comment::class)->create();
    }
    
    /** @test */
    public function auth_users_can_like_a_comment()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->comment->id . '/up', $this->createLikeCommentAttributes());
        $like = Like::first();
        $this->assertDatabaseHas('likes', [
            'type' => $like->type,
            'likeable_type' => 'App\Comment',
            'likeable_id' => $this->comment->id,
            'user_id' => $this->user->id,
        ]);
        $this->assertInstanceOf(Comment::class, $like->likeable);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->comment->likes);
        $this->assertTrue($this->comment->likes()->exists());
    }
    
    /** @test */
    public function auth_users_can_dislike_already_liked_comment()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->comment->id . '/up', $this->createLikeCommentAttributes());
        $this->assertDatabaseHas('likes', [
            'type' => 'up',
        ]);
        $this->post('/likes/' . $this->comment->id . '/down', array_merge($this->createLikeCommentAttributes(), [
                    'type' => 'down',
                ]));
        $this->assertDatabaseHas('likes', [
            'type' => 'down',
        ]);
        $this->assertDatabaseMissing('likes', [
            'type' => 'up',
        ]);
    }
    
    /** @test */
    public function auth_users_can_like_already_disliked_comment()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->comment->id . '/down', array_merge($this->createLikeCommentAttributes(), [
                    'type' => 'down',
                ]));
        $this->assertDatabaseHas('likes', [
            'type' => 'down',
        ]);
        $this->post('/likes/' . $this->comment->id . '/up', $this->createLikeCommentAttributes());
        $this->assertDatabaseHas('likes', [
            'type' => 'up',
        ]);
        $this->assertDatabaseMissing('likes', [
            'type' => 'down',
        ]);
    }
    
    /** @test */
    public function unauthenticated_users_cannot_like_a_comment()
    {
        $this->post('/likes/' . $this->comment->id . '/up', $this->createLikeCommentAttributes());
        $this->assertDatabaseCount('likes', 0);
        $this->assertFalse($this->comment->likes()->exists());
    }
    
    /**
     * Creates comment attributes for Like entity
     *
     * @return array
     */
    private function createLikeCommentAttributes()
    {
        return [
            'type' => 'up',
            'likeable_type' => 'App\Comment',
            'likeable_id' => $this->comment->id,
            'user_id' => $this->user->id,
        ];
    }
}
