<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait SaveUser
{
    /**
     * Save user id while creating post
     *
     * @param \App\Post $post
     */
    public function saveUserWithPost($post)
    {
        Auth::user()->posts()->save($post);
    }
}
