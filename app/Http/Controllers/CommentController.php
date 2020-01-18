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

    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
          'body' => 'min:2|max:300'
        ]);
    	
        return auth()->user()->comments()->create([
            'body' => $request->body,
            'post_id' => $post->id,
            'comment_id' => $request->comment_id
        ])->fresh();
    }

    public function show(Comment $comment)
    {
    	return $comment->replies()->paginate(10);
    }

}
