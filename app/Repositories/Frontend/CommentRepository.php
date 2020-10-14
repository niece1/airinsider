<?php

namespace App\Repositories\Frontend;

use App\Post;
use App\Comment;
use App\Interfaces\Frontend\CommentRepositoryInterface;
use App\Http\Requests\CommentRequest;

/**
 * Comment entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class CommentRepository implements CommentRepositoryInterface
{
    /**
     * Fetch comments from the database.
     *
     * @param  \App\Post  $post
     * @return \App\Comment[]
     */
    public function getAll(Post $post)
    {
        return $post->comments()->with(['replies'])->paginate(10);
    }
    
    /**
     * Save comment instance to the database.
     *
     * @param \App\Http\Requests\CommentRequest  $request
     * @param  \App\Post  $post
     * @return \App\Comment
     */
    public function save(CommentRequest $request, Post $post)
    {
        return auth()->user()->comments()->create([
            'body' => $request->body,
            'post_id' => $post->id,
            'comment_id' => $request->comment_id
        ])->fresh();
    }
    
    /**
     * Fetch replies from the database.
     *
     * @param  \App\Comment  $comment
     * @return \App\Comment[]
     */
    public function getReplies(Comment $comment)
    {
        return $comment->replies()->paginate(10);
    }
}
