<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;

class LikePostTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->post = Post::factory()->create();
    }

    /** @test */
    public function authUsersCanLikeAPost()
    {
        $this->actingAs($this->user);
        $this->post('/likes/' . $this->post->id . '/up', $this->createLikePostAttributes());
        $like = Like::first();
        $this->assertDatabaseHas('likes', [
            'type' => $like->type,
            'likeable_type' => 'App\Models\Post',
            'likeable_id' => $this->post->id,
            'user_id' => $this->user->id,
        ]);
        $this->assertInstanceOf(Post::class, $like->likeable);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->post->likes);
        $this->assertTrue($this->post->likes()->exists());
    }

    /** @test */
    public function authUsersCanDislikeAlreadyLikedPost()
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
    public function authUsersCanLikeAlreadyDislikedPost()
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
    public function unauthenticatedUsersCannotLikeAPost()
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
            'likeable_type' => 'App\Models\Post',
            'likeable_id' => $this->post->id,
            'user_id' => $this->user->id,
        ];
    }
}
