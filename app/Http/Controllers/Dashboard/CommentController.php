<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Comment;
use App\Repositories\Dashboard\CommentRepository;
use Illuminate\Support\Facades\Gate;

class CommentController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('comment_access'), 403);
        $comments = CommentRepository::getAll();

        return view('dashboard.comment.index', compact('comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        abort_unless(Gate::allows('comment_delete'), 403);
        CommentRepository::delete($comment);

        return redirect('dashboard/comments')->withSuccessMessage('Deleted Successfully!');
    }
}
