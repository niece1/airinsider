<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Post;
use App\User;
use App\Category;

class HomePageTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        factory(Category::class)->create();
    }
    
    /** @test */
    public function allUsersCanSeeIndexPage()
    {
        $this->get('/')
                ->assertStatus(200)
                ->assertSee('Последние новости');
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
        $this->get('/')->assertSeeText('Временно недоступны');
    }
    
    /** @test */
    public function seeOnePostOnIndexPageWhenThereIsOneInDatabase()
    {
        factory(Post::class)->create([
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
        factory(Post::class)->create([
            'title' => 'First post',
            'slug' => 'first-post',
        ]);
        $this->get('/post/first-post')->assertSee('First post');
    }
}
