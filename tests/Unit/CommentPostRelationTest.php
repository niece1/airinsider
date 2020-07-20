<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\PostFactory;
use App\Category;
use App\Comment;
use App\User;
use App\Post;

class CommentPostRelationTest extends TestCase
{
    use RefreshDatabase, PostFactory;
    
    /** @test */
    public function a_comment_belongs_to_user()
    {
        $this->createFactoryPost();
        $comment = factory(Comment::class)->create();
        $this->assertInstanceOf(User::class, $comment->user);
        $this->assertTrue($comment->user()->exists());
    }
    
    /** @test */
    public function a_user_has_many_comments()
    {
        $user = factory(User::class)->create();
        factory(Category::class)->create();
        factory(Post::class)->create();
        $comment = factory(Comment::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->comments);
        $this->assertTrue($user->comments->contains($comment));
    }
    
    /** @test */
    public function a_comment_has_many_replies()
    {
        $this->createFactoryPost();
        $comment = factory(Comment::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $comment->replies);
       // $this->assertTrue($user->comments->contains($comment));
        $this->assertTrue($comment->replies()->exists());
    }
}
