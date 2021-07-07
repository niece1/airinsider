<?php

namespace App\Repositories\Dashboard;

use App\Models\Comment;

/**
 * Comment entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class CommentRepository
{
    /**
     * Fetch all comments from the database.
     *
     * @return \App\Comment[]
     */
    public static function getAll()
    {
        return Comment::with(['post', 'replies'])
                ->orderBy('id', 'desc')
                ->paginate(50);
    }

    /**
     * Delete comment instance from the database.
     *
     * @param  \App\Comment  $comment
     */
    public static function delete(Comment $comment)
    {
        $comment->delete();
    }
}
