<?php

namespace Tests\Feature\Dashboard;

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
    public function searchOnTitleKeywordIsSuccessfull()
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
    public function searchOnBodyKeywordIsSuccessfull()
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
