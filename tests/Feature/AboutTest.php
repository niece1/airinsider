<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AboutTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function about_page_works_correctly()
    {      
        $this->get('/about')
                ->assertStatus(200)
                ->assertSeeText('Стать автором публикаций.');
    }
}
