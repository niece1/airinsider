<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Models\Category;
use App\Models\Post;

class TrashTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createAdminUser());
        Category::factory()->create();
    }

    /** @test */
    public function aPostCanBeDeleted()
    {
        $post = Post::factory()->create();
        $post->forceDelete('/dashboard/posts/' . $post->id);
        $this->assertModelMissing($post);
    }

    /** @test */
    public function aPostCanBeRestored()
    {
        $post = Post::factory()->create();
        $this->delete('/dashboard/posts/' . $post->id);
        $this->assertCount(0, Post::all());
        $this->post('/dashboard/restore/' . $post->id);
        $this->assertCount(1, Post::all());
    }
}
