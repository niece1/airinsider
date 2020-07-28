<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Category;
use App\Post;
use App\User;
use App\Like;
use App\Comment;

class LikeCommentReplyTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();        
        $this->user = factory(User::class)->create();
        $this->category = factory(Category::class)->create();
        $this->post = factory(Post::class)->create();
        $this->comment = factory(Comment::class)->create();
        $this->comment_reply = factory(Comment::class)->create([
            'comment_id' => $this->comment->id,
        ]);
    }
    
    /** @test */
    public function auth_users_can_like_a_comment_reply()
    {        
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->comment_reply->id . '/up',
                $this->createLikeCommentReplyAttributes());
        $this->assertDatabaseHas('comments', [
            'id' => $this->comment_reply->id,
            'comment_id' => $this->comment->id,
        ]);
        $like = Like::first();
        $this->assertDatabaseHas('likes', [
            'type' => $like->type,
            'likeable_type' => 'App\Comment',
            'likeable_id' => $this->comment_reply->id,
            'user_id' => $this->user->id,
        ]);
        $this->assertInstanceOf(Comment::class, $like->likeable);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->comment_reply->likes);
        $this->assertTrue($this->comment_reply->likes()->exists());
    }
    
    /** @test */
    public function auth_users_can_dislike_already_liked_comment_reply()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->comment_reply->id . '/up',
                $this->createLikeCommentReplyAttributes());
        $this->assertDatabaseHas('likes', [
            'type' => 'up',           
        ]);
        $this->post('/likes/' . $this->comment_reply->id . '/down', 
                array_merge($this->createLikeCommentReplyAttributes(), [
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
    public function auth_users_can_like_already_disliked_comment_reply()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->comment_reply->id . '/down',
                array_merge($this->createLikeCommentReplyAttributes(), [
                    'type' => 'down',
                ]));                
        $this->assertDatabaseHas('likes', [
            'type' => 'down',           
        ]);
        $this->post('/likes/' . $this->comment_reply->id . '/up', 
                $this->createLikeCommentReplyAttributes());
        $this->assertDatabaseHas('likes', [
            'type' => 'up',           
        ]);
        $this->assertDatabaseMissing('likes', [
            'type' => 'down',           
        ]);
    }
    
    /** @test */
    public function unauthenticated_users_cannot_like_a_comment_reply()
    {
        $this->post('/likes/' . $this->comment_reply->id . '/up',
                $this->createLikeCommentReplyAttributes());
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
            'likeable_type' => 'App\Comment',
            'likeable_id' => $this->comment_reply->id,
            'user_id' => $this->user->id,
        ];
    }
}
