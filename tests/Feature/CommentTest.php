<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Category;
use App\Post;
use App\User;
use App\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();        
        $this->user = factory(User::class)->create(); 
        $this->actingAs($this->user);
        $this->category = factory(Category::class)->create();
        $this->post = factory(Post::class)->create([
            'title' => 'First post',
            'slug' => 'first-post',
        ]);
    }

    /** @test */
    public function auth_users_can_post_a_comment()
    {
        $this->post('/comments/' . $this->post->id, $this->createCommentAttributes());
        $this->assertCount(1, Comment::all());
    }
    
    /** @test */
    public function unauthenticated_users_cannot_see_a_comment_form()
    {  
        $this->get('/post/first-post')->assertDontSee('Ваш комментарий'); 
    }
    
    /** @test */
    public function to_post_a_comment_body_should_be_at_least_two_characters()
    {       
        $this->post('/comments/' . $this->post->id,
                array_merge($this->createCommentAttributes(), [
                    'body' => 'V',
                ]))
                ->assertSessionHas('errors'); 
        $this->assertCount(0, Comment::all());
    }
    
    /** @test */
    public function auth_users_can_post_a_comment_reply()
    {
        $comment = factory(Comment::class)->create();
        $this->post('/comments/' . $this->post->id,
                array_merge($this->createCommentAttributes(), [
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
