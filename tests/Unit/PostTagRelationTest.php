<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use Tests\Traits\AdminUser;
use App\Traits\SyncTags;
use App\Models\Tag;
use App\Models\Post;

class PostTagRelationTest extends TestCase
{
    use RefreshDatabase;
    use AdminUser;
    use SyncTags;

    /** @test */
    public function postTagManyToManyRelations()
    {
        $this->actingAs($this->createAdminUser());
        Category::factory()->create();
        $tag = Tag::factory()->create();
        $this->post('/dashboard/posts', [
            'title' => 'New Title',
            'body' => 'New body',
            'description' => 'New description',
            'time_to_read' => 1,
            'published' => true,
            'category_id' => 1,
            'tag_id' => $tag->id,
        ]);
        $post = Post::first();
        Tag::find($tag);
        $post->syncTags($post);
        $this->assertDatabaseHas('post_tag', [
            'tag_id' => $tag->id,
            'post_id' => $post->id,
        ]);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $post->tags);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $tag->posts);
        $this->assertTrue($post->tags()->exists());
        $this->assertTrue($tag->posts()->exists());
    }
}
