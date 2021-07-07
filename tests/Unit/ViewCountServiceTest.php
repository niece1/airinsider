<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\ViewCountService;

class ViewCountServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function postViewCounterWorksProperly()
    {
        User::factory()->create();
        Category::factory()->create();
        $post = Post::factory()->create([
            'viewed' => 0,
        ]);
        $this->assertDatabaseHas('posts', ['viewed' => 0]);
        $viewCountService = new ViewCountService();
        $viewCountService->postViewCount($post);
        $this->assertDatabaseHas('posts', ['viewed' => 1]);
    }
}
