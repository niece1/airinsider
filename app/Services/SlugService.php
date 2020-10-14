<?php

namespace App\Services;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Generate slug while creating/updating post
 *
 * @author Volodymyr Zhonchuk
 */
class SlugService
{
    /*
     * Generate slug using post title
     *
     * @param  Illuminate\Http\Request $request
     * @param  \App\Post  $post
     * @return void
     */
    public function generateSlug(Request $request, Post $post)
    {
        $post->update([
            'slug' => Str::slug($request->title, '-'),
        ]);
    }
}
