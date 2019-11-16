<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class CommentController extends Controller
{
    public function index(Post $post)
    {
    	return $post->comments()->paginate(10);
    }
}
