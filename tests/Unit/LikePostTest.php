<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
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
        $this->actingAs($this->user);
        $this->category = factory(Category::class)->create();
        $this->post = factory(Post::class)->create();
    }
    
    /** @test */
    public function like_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('likes', [
            'id', 'type', 'likeable_type', 'likeable_id', 'user_id'
        ]), 1);
    }
    
    /** @test */
    public function one_can_like_a_post()
    {     
        $this->post('/likes/' . $this->post->id . '/up',
                $this->createLikePostAttributes());
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
    public function one_can_dislike_already_liked_post()
    {     
        $this->post('/likes/' . $this->post->id . '/up',
                $this->createLikePostAttributes());
        $this->assertDatabaseHas('likes', [
            'type' => 'up',           
        ]);
        $this->post('/likes/' . $this->post->id . '/down', 
                array_merge($this->createLikePostAttributes(), [
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
    public function one_can_like_already_disliked_post()
    {     
        $this->post('/likes/' . $this->post->id . '/down',
                array_merge($this->createLikePostAttributes(), [
                    'type' => 'down',
                ]));                
        $this->assertDatabaseHas('likes', [
            'type' => 'down',           
        ]);
        $this->post('/likes/' . $this->post->id . '/up', 
                $this->createLikePostAttributes());
        $this->assertDatabaseHas('likes', [
            'type' => 'up',           
        ]);
        $this->assertDatabaseMissing('likes', [
            'type' => 'down',           
        ]);
    }
    
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
