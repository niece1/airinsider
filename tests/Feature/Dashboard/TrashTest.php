<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Category;
use App\Post;

class TrashTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
    }

    /** @test */
    public function aPostCanBeDeleted()
    {
        $post = factory(Post::class)->create();
        $post->forceDelete('/dashboard/posts/' . $post->id);
        $this->assertDeleted($post);
    }

    /** @test */
    public function aPostCanBeRestored()
    {
        $post = factory(Post::class)->create();
        $this->delete('/dashboard/posts/' . $post->id);
        $this->assertCount(0, Post::all());
        $this->post('/dashboard/restore/' . $post->id);
        $this->assertCount(1, Post::all());
    }
}
