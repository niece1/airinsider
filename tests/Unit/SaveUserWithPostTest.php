<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Tests\Traits\AdminUser;
use App\Traits\SaveUser;
use App\Models\Category;
use App\Models\Post;

class SaveUserWithPostTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;
    use SaveUser;

    /** @test */
    public function userIdAddedWhileCreatingPost()
    {
        $this->actingAs($this->createAdminUser());
        Category::factory()->create();
        $this->post('/dashboard/posts', [
            'title' => 'New Title',
            'description' => 'New description',
            'body' => 'New body',
            'time_to_read' => 1,
            'published' => true,
            'category_id' => 1,
        ]);
        $user = User::first();
        $post = Post::first();
        $post->saveUserWithPost($post);
        $this->assertSame($user->id, $post->user_id);
        $this->assertTrue($user->posts()->exists());
    }
}
