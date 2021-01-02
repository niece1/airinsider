<?php

namespace Tests\Feature\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Category;
use App\User;
use App\Post;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        factory(Category::class)->create();
        factory(User::class)->create();
    }

    /** @test */
    public function searchOnTitleKeywordIsSuccessfull()
    {
        factory(Post::class)->create([
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
        factory(Post::class)->create([
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
