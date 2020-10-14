<?php

namespace App\Interfaces\Frontend;

use App\Post;
use App\Comment;
use App\Http\Requests\CommentRequest;

interface CommentRepositoryInterface
{
    /**
     * Fetch all comments from the database.
     *
     * @param  \App\Post  $post
     * @return \App\Comment[]
     */
    public function getAll(Post $post);
    
    /**
     * Save comment instance to the database.
     *
     * @param \App\Http\Requests\CommentRequest  $request
     * @param  \App\Post  $post
     * @return \App\Comment[]
     */
    public function save(CommentRequest $request, Post $post);
    
    /**
     * Fetch replies from the database.
     *
     * @param  \App\Comment  $comment
     * @return \App\Comment[]
     */
    public function getReplies(Comment $comment);
}
