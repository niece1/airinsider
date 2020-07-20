<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\PostFactory;
use App\Category;
use App\User;
use App\Post;

class CategoryPostRelationTest extends TestCase
{
    use RefreshDatabase, PostFactory;
    
    /** @test */
    public function a_post_belongs_to_category()
    {
        $post = $this->createFactoryPost();
        $this->assertInstanceOf(Category::class, $post->category);
        $this->assertTrue($post->category()->exists());
    }
    
    /** @test */
    public function a_category_has_many_posts()
    {
        factory(User::class)->create();
        $category = factory(Category::class)->create();
        $post = factory(Post::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $category->posts);
        $this->assertTrue($category->posts->contains($post));
    }
}
