<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;
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
}
