<?php

namespace App\Repositories\Frontend;

use App\Models\Post;
use App\Models\Comment;

/**
 * Comment entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class CommentRepository
{
    /**
     * Fetch comments from the database.
     *
     * @param  \App\Post  $post
     * @return \App\Comment[]
     */
    public static function getAll(Post $post)
    {
        return $post->comments()->with(['replies', 'likes', 'replies.likes'])->paginate(10);
    }

    /**
     * Save comment instance to the database.
     *
     * @param $request
     * @param  \App\Post  $post
     * @return \App\Comment
     */
    public static function save($request, Post $post)
    {
        return auth()
                ->user()
                ->comments()
                ->create(array_merge($request->getDto(), [
                    'post_id' => $post->id
                ]))
                ->fresh();
    }

    /**
     * Fetch replies from the database.
     *
     * @param  \App\Comment  $comment
     * @return \App\Comment[]
     */
    public static function getReplies(Comment $comment)
    {
        return $comment->replies()->paginate(10);
    }
}
