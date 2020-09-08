<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use Tests\Traits\AdminUser;
use App\Traits\SaveUser;
use App\Category;
use App\Post;

class SaveUserWithPostTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;
    use SaveUser;
            
    /** @test */
    public function user_id_added_while_creating_post()
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $this->post('/dashboard/posts', [
            'title' => 'New Title',
            'body' => 'New body',
            'time_to_read' => 1,
            'category_id' => 1,
        ]);
        $user = User::first();
        $post = Post::first();
        $post->saveUserWithPost($post);
        $this->assertSame($user->id, $post->user_id);
        $this->assertTrue($user->posts()->exists());
    }
}
