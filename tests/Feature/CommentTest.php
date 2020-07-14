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

    /** @test */
    public function authenticated_users_can_post_a_comment()
    {  
        $this->actingAs(factory(User::class)->create());
        factory(Category::class)->create();
        factory(Post::class)->create([
            'title' => 'First post',
            'slug' => 'first-post',
        ]);
        $this->post('/comments/1', [
            'body' => 'Very interesting post!',
            'post_id' => 1,
            'user_id' => 1,
        ]);
        $this->assertCount(1, Comment::all());
    }
    
    /** @test */
    public function unauthenticated_users_cannot_see_a_comment_form()
    {  
        factory(User::class)->create();
        factory(Category::class)->create();
        factory(Post::class)->create([
            'title' => 'First post',
            'slug' => 'first-post',
        ]);
        $response = $this->get('/post/first-post');
        $response->assertDontSee('Ваш комментарий'); 
    }
    
    /** @test */
    public function to_post_a_comment_body_should_be_at_least_two_characters()
    {
        $this->actingAs(factory(User::class)->create());
        factory(Category::class)->create();
        factory(Post::class)->create([
            'title' => 'First post',
            'slug' => 'first-post',
        ]);
        $this->post('/comments/1', [
            'body' => 'V',
            'post_id' => 1,
            'user_id' => 1,
        ])->assertSessionHas('errors'); 
        $this->assertCount(0, Comment::all());
    }
}
