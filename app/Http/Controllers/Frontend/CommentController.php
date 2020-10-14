<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use App\Post;
use App\Comment;
use App\Interfaces\Frontend\CommentRepositoryInterface;

class CommentController extends Controller
{
    private $commentRepository;
    
    /**
     * Create a new Comment instance.
     *
     * @param  \App\Interfaces\Frontend\CommentRepositoryInterface  $commentRepository
     * @return void
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    
    /**
     * Show comments associated with specific post.
     *
     * @param  \App\Post  $post
     * @return \App\Comment[]
     */
    public function index(Post $post)
    {
        return $this->commentRepository->getAll($post);
    }
    
    /**
     * Store comment instance.
     *
     * @param \App\Http\Requests\CommentRequest  $request
     * @param  \App\Post  $post
     * @return \App\Comment
     */
    public function store(CommentRequest $request, Post $post)
    {
        return $this->commentRepository->save($request, $post);
    }
    
    /**
     * Show replies associated with specific comment.
     *
     * @param  \App\Comment  $comment
     * @return \App\Comment[]
     */
    public function showReplies(Comment $comment)
    {
        return $this->commentRepository->getReplies($comment);
    }
}
