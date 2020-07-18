<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;
use Tests\Traits\AdminUser;

class SlugServiceTest extends TestCase
{
    use RefreshDatabase, AdminUser;
    
    /** @test */
    public function slug_generated_while_creating_post() 
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $this->post('/dashboard/posts', [
            'title' => 'New Title',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
            'user_id' => 1,
        ]);        
        $this->assertDatabaseHas('posts', [
            'title' => 'New Title',
            'slug' => 'new-title',
        ]);        
    }
}
