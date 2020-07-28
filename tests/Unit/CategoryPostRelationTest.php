<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;
use App\User;
use App\Post;

class CategoryPostRelationTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();        
        factory(User::class)->create();       
        $this->category = factory(Category::class)->create();
        $this->post = factory(Post::class)->create();
    }
    
    /** @test */
    public function a_post_belongs_to_category()
    {
        $this->assertInstanceOf(Category::class, $this->post->category);
        $this->assertTrue($this->post->category()->exists());
    }
    
    /** @test */
    public function a_category_has_many_posts()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->category->posts);
        $this->assertTrue($this->category->posts->contains($this->post));
    }
}
