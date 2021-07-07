<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Category::factory()->create();
        User::factory()->create();
    }

    /** @test */
    public function searchOnTitleKeywordIsSuccessfull()
    {
        Post::factory()->create([
            'title' => 'Airbus',
            'body' => 'Airbus is a new market winner.',
        ]);
        $this->get('/search', [
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
        $this->get('/search', [
            'keyword' => 'Airbus',
        ])
                ->assertStatus(200)
                ->assertSee('Boeing');
    }
}
