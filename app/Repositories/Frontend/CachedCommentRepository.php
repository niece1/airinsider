<?php

namespace App\Repositories\Frontend;

use Illuminate\Support\Facades\Cache;
use App\Interfaces\Frontend\CommentRepositoryInterface;
use App\Repositories\Frontend\CommentRepository;
use App\Post;
use App\Comment;
use App\Http\Requests\CommentRequest;

/**
 * Cached comment entity query class
 *
 * @author Volodymyr Zhonchuk
 */
class CachedCommentRepository extends CommentRepository implements CommentRepositoryInterface
{
    /**
     * Fetch cached comments
     *
     * @param  \App\Post  $post
     * @return \App\Comment[]
     */
    public function getAll(Post $post)
    {
        return Cache::remember(
            'comments_show_page',
            now()->addSeconds(config('app.cache')),
            fn() => parent::getAll($post)
        );
    }
    
    /**
     * Save comment instance to the database
     *
     * @param \App\Http\Requests\CommentRequest  $request
     * @param  \App\Post  $post
     * @return \App\Comment
     */
    public function save(CommentRequest $request, Post $post)
    {
        return parent::save($request, $post);
    }
    
    /**
     * Fetch cached replies
     *
     * @param  \App\Comment  $comment
     * @return \App\Comment[]
     */
    public function getReplies(Comment $comment)
    {
        return Cache::remember(
            'replies_show_page',
            now()->addSeconds(config('app.cache')),
            fn() => parent::getReplies($comment)
        );
    }
}
