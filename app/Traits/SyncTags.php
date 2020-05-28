<?php

namespace App\Traits;

trait SyncTags 
{       
    public function syncTags($post)
    {
        $post->tags()->sync(request('tag_id'));
    }    
}
