<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait SaveUser
{
    public function saveUserWithPost($post)
    {
        Auth::user()->posts()->save($post);
    }
}
