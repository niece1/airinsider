<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;
use App\Comment;
use App\User;
use App\Post;

class CommentPostRelationTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        factory(Category::class)->create();
        $this->post = factory(Post::class)->create();
        $this->comment = factory(Comment::class)->create();
    }
    
    /** @test */
    public function a_comment_belongs_to_user()
    {
        $this->assertInstanceOf(User::class, $this->comment->user);
        $this->assertTrue($this->comment->user()->exists());
    }
    
    /** @test */
    public function a_user_has_many_comments()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->comments);
        $this->assertTrue($this->user->comments->contains($this->comment));
    }
    
    /** @test */
    public function a_comment_has_many_replies()
    {
        factory(Comment::class)->create([
            'comment_id' => 1,
        ]);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->comment->replies);
        $this->assertTrue($this->comment->replies()->exists());
    }
}
