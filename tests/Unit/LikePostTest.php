<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Category;
use App\Post;
use App\User;
use App\Like;

class LikePostTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->category = factory(Category::class)->create();
        $this->post = factory(Post::class)->create();
    }
    
    /** @test */
    public function auth_users_can_like_a_post()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->post->id . '/up', $this->createLikePostAttributes());
        $like = Like::first();
        $this->assertDatabaseHas('likes', [
            'type' => $like->type,
            'likeable_type' => 'App\Post',
            'likeable_id' => $this->post->id,
            'user_id' => $this->user->id,
        ]);
        $this->assertInstanceOf(Post::class, $like->likeable);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->post->likes);
        $this->assertTrue($this->post->likes()->exists());
    }
   
    /** @test */
    public function auth_users_can_dislike_already_liked_post()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->post->id . '/up', $this->createLikePostAttributes());
        $this->assertDatabaseHas('likes', [
            'type' => 'up',
        ]);
        $this->post('/likes/' . $this->post->id . '/down', array_merge($this->createLikePostAttributes(), [
                    'type' => 'down',
                ]));
        $this->assertDatabaseHas('likes', [
            'type' => 'down',
        ]);
        $this->assertDatabaseMissing('likes', [
            'type' => 'up',
        ]);
    }
    
    /** @test */
    public function auth_users_can_like_already_disliked_post()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->post->id . '/down', array_merge($this->createLikePostAttributes(), [
                    'type' => 'down',
                ]));
        $this->assertDatabaseHas('likes', [
            'type' => 'down',
        ]);
        $this->post('/likes/' . $this->post->id . '/up', $this->createLikePostAttributes());
        $this->assertDatabaseHas('likes', [
            'type' => 'up',
        ]);
        $this->assertDatabaseMissing('likes', [
            'type' => 'down',
        ]);
    }
    
    /** @test */
    public function unauthenticated_users_cannot_like_a_post()
    {
        $this->post('/likes/' . $this->post->id . '/up', $this->createLikePostAttributes());
        $this->assertDatabaseCount('likes', 0);
        $this->assertFalse($this->post->likes()->exists());
    }
    
    /**
     * Creates post attributes for Like entity
     *
     * @return array
     */
    private function createLikePostAttributes()
    {
        return [
            'type' => 'up',
            'likeable_type' => 'App\Post',
            'likeable_id' => $this->post->id,
            'user_id' => $this->user->id,
        ];
    }
}
