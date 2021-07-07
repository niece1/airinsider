<?php

namespace Tests\Feature\Dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminUser;
use App\Models\Category;
use App\Models\Post;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createAdminUser());
        Category::factory()->create();
    }

    /** @test */
    public function searchOnTitleKeywordIsSuccessfull()
    {
        Post::factory()->create([
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
    public function searchOnBodyKeywordIsSuccessfull()
    {
        Post::factory()->create([
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
