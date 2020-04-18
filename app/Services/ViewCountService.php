<?php

namespace App\Services;

use App\Post;

class ViewCountService
{
    public function postViewCount(Post $post)
    {
        $post->viewed += 1;
        $post->timestamps = false;
        return $post->save();
    }
}

