<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;

class LikeCommentReplyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->post = Post::factory()->create();
        $this->comment = Comment::factory()->create();
        $this->comment_reply = Comment::factory()->create([
            'comment_id' => $this->comment->id,
        ]);
    }

    /** @test */
    public function authUsersCanLikeACommentReply()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->comment_reply->id . '/up', $this->createLikeCommentReplyAttributes());
        $this->assertDatabaseHas('comments', [
            'id' => $this->comment_reply->id,
            'comment_id' => $this->comment->id,
        ]);
        $like = Like::first();
        $this->assertDatabaseHas('likes', [
            'type' => $like->type,
            'likeable_type' => 'App\Models\Comment',
            'likeable_id' => $this->comment_reply->id,
            'user_id' => $this->user->id,
        ]);
        $this->assertInstanceOf(Comment::class, $like->likeable);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->comment_reply->likes);
        $this->assertTrue($this->comment_reply->likes()->exists());
    }

    /** @test */
    public function authUsersCanDislikeAlreadyLikedCommentReply()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->comment_reply->id . '/up', $this->createLikeCommentReplyAttributes());
        $this->assertDatabaseHas('likes', [
            'type' => 'up',
        ]);
        $this->post('/likes/' . $this->comment_reply->id . '/down', array_merge(
            $this->createLikeCommentReplyAttributes(),
            [
                    'type' => 'down',
            ]
        ));
        $this->assertDatabaseHas('likes', [
            'type' => 'down',
        ]);
        $this->assertDatabaseMissing('likes', [
            'type' => 'up',
        ]);
    }

    /** @test */
    public function authUsersCanLikeAlreadyDislikedCommentReply()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->comment_reply->id . '/down', array_merge(
            $this->createLikeCommentReplyAttributes(),
            [
                    'type' => 'down',
            ]
        ));
        $this->assertDatabaseHas('likes', [
            'type' => 'down',
        ]);
        $this->post('/likes/' . $this->comment_reply->id . '/up', $this->createLikeCommentReplyAttributes());
        $this->assertDatabaseHas('likes', [
            'type' => 'up',
        ]);
        $this->assertDatabaseMissing('likes', [
            'type' => 'down',
        ]);
    }

    /** @test */
    public function unauthenticatedUsersCannotLikeACommentReply()
    {
        $this->post('/likes/' . $this->comment_reply->id . '/up', $this->createLikeCommentReplyAttributes());
        $this->assertDatabaseCount('likes', 0);
        $this->assertFalse($this->comment_reply->likes()->exists());
    }

    /**
     * Creates comment's reply attributes for Like entity
     *
     * @return array
     */
    private function createLikeCommentReplyAttributes()
    {
        return [
            'type' => 'up',
            'likeable_type' => 'App\Models\Comment',
            'likeable_id' => $this->comment_reply->id,
            'user_id' => $this->user->id,
        ];
    }
}
