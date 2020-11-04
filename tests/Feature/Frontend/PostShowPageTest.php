<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Post;
use App\User;
use App\Category;

class PostShowPageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        factory(Category::class)->create();
    }

    /** @test */
    public function aUserCanSeeShowPage()
    {
        factory(Post::class)->create([
            'title' => 'First post',
            'slug' => 'first-post',
        ]);
        $this->get('/post/first-post')->assertSee('First post');
    }
}
