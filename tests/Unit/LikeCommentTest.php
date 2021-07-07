<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;

class LikeCommentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->post = Post::factory()->create();
        $this->comment = Comment::factory()->create();
    }

    /** @test */
    public function authUsersCanLikeAComment()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->comment->id . '/up', $this->createLikeCommentAttributes());
        $like = Like::first();
        $this->assertDatabaseHas('likes', [
            'type' => $like->type,
            'likeable_type' => 'App\Models\Comment',
            'likeable_id' => $this->comment->id,
            'user_id' => $this->user->id,
        ]);
        $this->assertInstanceOf(Comment::class, $like->likeable);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->comment->likes);
        $this->assertTrue($this->comment->likes()->exists());
    }

    /** @test */
    public function authUsersCanDislikeAlreadyLikedComment()
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
    public function authUsersCanLikeAlreadyDislikedComment()
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
    public function unauthenticatedUsersCannotLikeAComment()
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
            'likeable_type' => 'App\Models\Comment',
            'likeable_id' => $this->comment->id,
            'user_id' => $this->user->id,
        ];
    }
}
