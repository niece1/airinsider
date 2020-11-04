<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;
use App\Post;
use App\User;
use App\Services\ViewCountService;

class ViewCountServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function postViewCounterWorksProperly()
    {
        factory(User::class)->create();
        factory(Category::class)->create();
        $post = factory(Post::class)->create([
            'viewed' => 0,
        ]);
        $this->assertDatabaseHas('posts', ['viewed' => 0]);
        $viewCountService = new ViewCountService();
        $viewCountService->postViewCount($post);
        $this->assertDatabaseHas('posts', ['viewed' => 1]);
    }
}
