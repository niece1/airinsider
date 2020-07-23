<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Category;
use App\Post;

class SearchTest extends TestCase
{
    use RefreshDatabase, AdminUser;
    
    /** @test */
    public function search_on_title_keyword_is_successfull() 
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        factory(Post::class)->create([
            'title' => 'Airbus',
            'body' => 'Airbus is a new market winner.',
        ]);
        $response = $this->get('/dashboard/search', [
            'keyword' => 'Airbus',
        ]);
        $response->assertStatus(200);
        $response->assertSee('Airbus'); 
    }
    
    /** @test */
    public function search_on_body_keyword_is_successfull() 
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        factory(Post::class)->create([
            'title' => 'Boeing',
            'body' => 'Airbus is a new market winner.',
        ]);
        $response = $this->get('/dashboard/search', [
            'keyword' => 'Airbus',
        ]);
        $response->assertStatus(200);
        $response->assertSee('Boeing'); 
    }
}
