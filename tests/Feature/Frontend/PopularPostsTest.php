<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;
use App\User;
use App\Category;
use Tests\TestCase;

class PopularPostsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        factory(Category::class)->create();
        factory(Post::class)->create([
            'title' => 'First post',
            'viewed' => '100',
        ]);
        factory(Post::class)->create([
            'title' => 'Second post',
            'viewed' => '200',
        ]);
        factory(Post::class)->create([
            'title' => 'Third post',
            'viewed' => '300',
        ]);
        factory(Post::class)->create([
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
