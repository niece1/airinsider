<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Tests\TestCase;

class PopularPostsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Category::factory()->create();
        Post::factory()->create([
            'title' => 'First post',
            'viewed' => '100',
        ]);
        Post::factory()->create([
            'title' => 'Second post',
            'viewed' => '200',
        ]);
        Post::factory()->create([
            'title' => 'Third post',
            'viewed' => '300',
        ]);
        Post::factory()->create([
            'title' => 'Fourth post',
            'viewed' => '400',
        ]);
    }

    /** @test */
    public function oneCannotSeePostWithFewestViews()
    {
        $this->get('/about')->assertDontSee('First post');
    }

    /** @test */
    public function oneCanSeeThreePostsWithMaxViews()
    {
        $this->get('/about')
                ->assertSee('Second post')
                ->assertSee('Third post')
                ->assertSee('Fourth post');
    }
}
