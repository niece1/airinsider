<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;
use App\User;
use App\Post;

class PostUserRelationTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        factory(Category::class)->create();
        $this->post = factory(Post::class)->create();
    }
    
    /** @test */
    public function a_post_belongs_to_user()
    {
        $this->assertInstanceOf(User::class, $this->post->user);
        $this->assertTrue($this->post->user()->exists());
    }
    
    /** @test */
    public function a_user_has_many_posts()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->posts);
        $this->assertTrue($this->user->posts->contains($this->post));
    }
}
