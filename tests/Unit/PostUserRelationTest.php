<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;

class PostUserRelationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Category::factory()->create();
        $this->post = Post::factory()->create();
    }

    /** @test */
    public function aPostBelongsToUser()
    {
        $this->assertInstanceOf(User::class, $this->post->user);
        $this->assertTrue($this->post->user()->exists());
    }

    /** @test */
    public function aUserHasManyPosts()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->posts);
        $this->assertTrue($this->user->posts->contains($this->post));
    }
}
