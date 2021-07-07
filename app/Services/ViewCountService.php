<?php

namespace App\Services;

use App\Models\Post;

/**
 * Count post views
 *
 * @author Volodymyr Zhonchuk
 */
class ViewCountService
{
    /*
     * Count post views
     *
     * @param  \App\Post  $post
     * @return \App\Post
     */
    public function postViewCount(Post $post)
    {
        $post->viewed += 1;
        $post->timestamps = false;
        return $post->save();
    }
}
