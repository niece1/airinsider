<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Category;
use Tests\Traits\AdminUser;
use App\Traits\SyncTags;
use App\Tag;
use App\Post;

class PostTagRelationTest extends TestCase
{
    use RefreshDatabase, AdminUser, SyncTags;
    
    /** @test */
    public function post_tag_many_to_many_relations()
    {
        $this->actingAs($this->createAdminUser());
        factory(Category::class)->create();
        $tag=factory(Tag::class)->create();
        $this->post('/dashboard/posts', [
            'title' => 'New Title',
            'body' => 'New body',
            'time_to_read' => 1,
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
