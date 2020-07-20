<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Traits\PostFactory;
use App\Category;
use App\User;
use App\Post;

class PostUserRelationTest extends TestCase
{
    use RefreshDatabase, PostFactory;
    
    /** @test */
    public function a_post_belongs_to_user()
    {
        $post = $this->createFactoryPost();
        $this->assertInstanceOf(User::class, $post->user);
        $this->assertTrue($post->user()->exists());
    }
    
    /** @test */
    public function a_user_has_many_posts()
    {
        $user = factory(User::class)->create();
        factory(Category::class)->create();
        $post = factory(Post::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->posts);
        $this->assertTrue($user->posts->contains($post));
    }       
}
