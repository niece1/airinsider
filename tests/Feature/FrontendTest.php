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
    public function users_can_see_index_page()
    {      
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Последние новости');
    }
    
    /** @test */
    public function only_admin_users_can_see_dashboard()
    {  
        $response = $this->get('/dashboard/posts');
        $response->assertRedirect('/login');
    }
    
    /** @test */
    public function authenticated_users_cannot_see_dashboard()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/dashboard/posts');
        $response->assertForbidden();
    }
    
    /** @test */
    public function paginated_posts_table_doesnt_show_10th_record()
    {
        factory(User::class, 10)->create();
        factory(Category::class, 10)->create();
        $posts = factory(Post::class, 10)->create();
        $response = $this->get('/');
        $response->assertDontSee($posts->last()->title);
    }
    
    
    /** @test */
    public function contact_page_works_correctly()
    {      
        $response = $this->get('/contact');
        $response->assertSeeText('Заполните форму');
        $response->assertSeeText('Напишите нам');
    }      
    
    /** @test */
    public function no_posts_when_there_is_nothing_in_database()
    {
        $response = $this->get('/');
        $response->assertSeeText('Временно недоступны');
    }
    
    /** @test */
    public function see_one_post_when_there_is_one_in_database()
    {
        factory(User::class)->create();
        factory(Category::class)->create();
        factory(Post::class)->create([
            'title'=> 'New Title',
            'published'=> true,
        ]);
        $response = $this->get('/');
        $response->assertSeeText('New Title');
        $this->assertDatabaseHas('posts', [
            'title'=> 'New Title'
        ]);
    }
    
            
}
