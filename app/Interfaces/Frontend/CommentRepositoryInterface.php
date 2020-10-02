<?php

namespace App\Interfaces\Frontend;

use App\Post;
use App\Comment;
use App\Http\Requests\CommentRequest;

/**
 *
 * @author Volodymyr Zhonchuk
 */
interface CommentRepositoryInterface
{
    public function getAll(Post $post);
    public function save(CommentRequest $request, Post $post);
    public function getReplies(Comment $comment);
}
