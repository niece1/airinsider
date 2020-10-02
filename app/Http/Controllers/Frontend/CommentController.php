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
    
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    
    public function index(Post $post)
    {
        return $this->commentRepository->getAll($post);
    }

    public function store(CommentRequest $request, Post $post)
    {
        return $this->commentRepository->save($request, $post);
    }

    public function showReplies(Comment $comment)
    {
        return $this->commentRepository->getReplies($comment);
    }
}
