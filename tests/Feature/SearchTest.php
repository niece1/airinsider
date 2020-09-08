<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Category;
use App\Post;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
    }
    
    /** @test */
    public function search_on_title_keyword_is_successfull()
    {
        factory(Post::class)->create([
            'title' => 'Airbus',
            'body' => 'Airbus is a new market winner.',
        ]);
        $this->get('/dashboard/search', [
            'keyword' => 'Airbus',
        ])
                ->assertStatus(200)
                ->assertSee('Airbus');
    }
    
    /** @test */
    public function search_on_body_keyword_is_successfull()
    {
        factory(Post::class)->create([
            'title' => 'Boeing',
            'body' => 'Airbus is a new market winner.',
        ]);
        $this->get('/dashboard/search', [
            'keyword' => 'Airbus',
        ])
                ->assertStatus(200)
                ->assertSee('Boeing');
    }
}
