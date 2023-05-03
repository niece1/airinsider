<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\CommentRequest;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use App\Repositories\Frontend\CommentRepository;

class CommentController extends Controller
{
    /**
     * Show comments associated with specific post.
     *
     * @param  \App\Post  $post
     * @return \App\Comment[]
     */
    public function index(Post $post)
    {
        return CommentRepository::getAll($post);
    }

    /**
     * Store comment instance.
     *
     * @param \App\Http\Requests\Frontend\CommentRequest  $request
     * @param  \App\Post  $post
     * @return \App\Comment
     */
    public function store(CommentRequest $request, Post $post)
    {
        return CommentRepository::save($request, $post);
    }

    /**
     * Show replies associated with specific comment.
     *
     * @param  \App\Comment  $comment
     * @return \App\Comment[]
     */
    public function showReplies(Comment $comment)
    {
        return CommentRepository::getReplies($comment);
    }
}
