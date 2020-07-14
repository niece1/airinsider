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
    /** @test */
    public function all_users_can_see_index_page()
    {      
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Последние новости');
    }
    
    /** @test */
    public function authenticated_user_can_see_index_page()
    {
        $user = factory(User::class)->create();        
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
    }
 
    /** @test */
    public function contact_page_works_correctly()
    {      
        $response = $this->get('/contact');
        $response->assertSeeText('Заполните форму');
        $response->assertSeeText('Напишите нам');
    }      
    
    /** @test */
    public function no_posts_on_index_page_when_database_empty()
    {
        $response = $this->get('/');
        $response->assertSeeText('Временно недоступны');
    }
    
    /** @test */
    public function see_one_post_on_index_page_when_there_is_one_in_database()
    {
        factory(User::class)->create();
        factory(Category::class)->create();
        factory(Post::class)->create([
            'title' => 'New title',
            'body' => 'New body',
            'time_to_read' => 1,
            'user_id' => 1,
            'category_id' => 1,
            'published' => true,
        ]);
        $response = $this->get('/');
        $response->assertSeeText('New title');
        $this->assertDatabaseHas('posts', [
            'title' => 'New title'
        ]);
    }
    
    /** @test */
    public function a_user_can_see_a_show_page()
    {  
        $this->actingAs(factory(User::class)->create());
        factory(Category::class)->create();
        factory(Post::class)->create([
            'title' => 'First post',
            'slug' => 'first-post',
        ]);
        $response = $this->get('/post/first-post');
        $response->assertSee('First post');
    }               
}
