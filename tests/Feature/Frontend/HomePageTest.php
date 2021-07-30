<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Category::factory()->create();
    }

    /** @test */
    public function allUsersCanSeeIndexPage()
    {
        $this->get('/')
                ->assertStatus(200)
                ->assertSee('Latest news');
    }

    /** @test */
    public function authenticatedUserCanSeeIndexPage()
    {
        $this->actingAs($this->user)
                ->get('/')
                ->assertStatus(200);
    }

    /** @test */
    public function noPostsOnIndexPageWhenDatabaseEmpty()
    {
        $this->get('/')->assertSeeText('Temporarily unavailable');
    }

    /** @test */
    public function seeOnePostOnIndexPageWhenThereIsOneInDatabase()
    {
        Post::factory()->create([
            'title' => 'New title',
        ]);
        $this->get('/')->assertSeeText('New title');
        $this->assertDatabaseHas('posts', [
            'title' => 'New title'
        ]);
    }

    /** @test */
    public function aUserCanSeeAShowPage()
    {
        Post::factory()->create([
            'title' => 'First post',
            'slug' => 'first-post',
        ]);
        $this->get('/post/first-post')->assertSee('First post');
    }
}
