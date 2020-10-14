<?php

namespace App\Traits;

trait SyncTags
{
    /**
     * Synchronize tags associated with specific post.
     *
     * @param \App\Post $post
     */
    public function syncTags($post)
    {
        $post->tags()->sync(request('tag_id'));
    }
}
