<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

class CommentPostRelationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Category::factory()->create();
        $this->post = Post::factory()->create();
        $this->comment = Comment::factory()->create();
    }

    /** @test */
    public function aCommentBelongsToUser()
    {
        $this->assertInstanceOf(User::class, $this->comment->user);
        $this->assertTrue($this->comment->user()->exists());
    }

    /** @test */
    public function aUserHasManyComments()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->comments);
        $this->assertTrue($this->user->comments->contains($this->comment));
    }

    /** @test */
    public function aCommentHasManyReplies()
    {
        Comment::factory()->create([
            'comment_id' => 1,
        ]);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->comment->replies);
        $this->assertTrue($this->comment->replies()->exists());
    }
}
