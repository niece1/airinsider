<?php

namespace App\Http\Controllers\Dashboard;

use App\Comment;
use App\Repositories\Dashboard\CommentRepository;

class CommentController extends DashboardController
{
    public function index()
    {
        abort_unless(\Gate::allows('comment_access'), 403);
        $comments = CommentRepository::getAll();

        return view('dashboard.comment.index', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        abort_unless(\Gate::allows('comment_delete'), 403);
        CommentRepository::delete($comment);
   
        return redirect('dashboard/comments')->withSuccessMessage('Deleted Successfully!');
    }
}
