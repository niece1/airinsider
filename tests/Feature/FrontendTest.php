<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Post;
use App\User;
use App\Category;

class FrontendTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        factory(Category::class)->create();
    }
    
    /** @test */
    public function all_users_can_see_index_page()
    {
        $this->get('/')
                ->assertStatus(200)
                ->assertSee('Последние новости');
    }
    
    /** @test */
    public function authenticated_user_can_see_index_page()
    {
        $this->actingAs($this->user)
                ->get('/')
                ->assertStatus(200);
    }
    
    /** @test */
    public function no_posts_on_index_page_when_database_empty()
    {
        $this->get('/')->assertSeeText('Временно недоступны');
    }
    
    /** @test */
    public function see_one_post_on_index_page_when_there_is_one_in_database()
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
    public function a_user_can_see_a_show_page()
    {
        factory(Post::class)->create([
            'title' => 'First post',
            'slug' => 'first-post',
        ]);
        $this->get('/post/first-post')->assertSee('First post');
    }
}
