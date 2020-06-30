<?php

namespace Tests\Traits;

use App\Category;
use App\Post;
use App\User;

trait PostFactory 
{
    public function createFactoryPost()
    {
        factory(User::class)->create();
        factory(Category::class)->create();
        $post = factory(Post::class)->create();
        return $post;
    }
}
