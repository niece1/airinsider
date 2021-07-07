<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostShowPageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Category::factory()->create();
    }

    /** @test */
    public function aUserCanSeeShowPage()
    {
        Post::factory()->create([
            'title' => 'First post',
            'slug' => 'first-post',
        ]);
        $this->get('/post/first-post')->assertSee('First post');
    }
}
