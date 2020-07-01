<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;
use App\Comment;
use App\Post;
use App\User;
use App\Tag;
use Tests\Traits\PostFactory;

class RelationTest extends TestCase
{
    use RefreshDatabase, PostFactory;
    
    /** @test */
    public function a_post_belongs_to_category()
    {
        $post = $this->createFactoryPost();
        $this->assertInstanceOf(Category::class, $post->category);
    }
    
    /** @test */
    public function a_category_has_many_posts()
    {
        factory(User::class)->create();
        $category = factory(Category::class)->create();
        factory(Post::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $category->posts);
    }
    
    /** @test */
    public function a_user_has_many_posts()
    {
        $user = factory(User::class)->create();
        factory(Category::class)->create();
        factory(Post::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->posts);
    }
    
    /** @test */
    public function a_post_belongs_to_user()
    {
        $post = $this->createFactoryPost();
        $this->assertInstanceOf(User::class, $post->user);
    }
    
    /** @test */
    public function a_post_has_many_tags()
    {
        $post = $this->createFactoryPost();
        factory(Tag::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $post->tags);
    }
    
    /** @test */
    public function a_tag_has_many_posts()
    {
        $this->createFactoryPost();
        $tag = factory(Tag::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $tag->posts);
    }
    
    /** @test */
    public function a_comment_belongs_to_user()
    {
        $this->createFactoryPost();
        $comment = factory(Comment::class)->create();
        $this->assertInstanceOf(User::class, $comment->user);
    }
    
    /** @test */
    public function a_user_has_many_comments()
    {
        $user = factory(User::class)->create();
        factory(Category::class)->create();
        factory(Post::class)->create();
        factory(Comment::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->comments);
    }
    
    /** @test */
    public function a_comment_has_many_replies()
    {
        $this->createFactoryPost();
        $comment = factory(Comment::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $comment->replies);
    }
}
