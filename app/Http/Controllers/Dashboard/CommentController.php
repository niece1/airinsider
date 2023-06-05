<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Comment;
use App\Repositories\Dashboard\CommentRepository;

class CommentController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Comment::class);
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
        $this->authorize('delete', Comment::class);
        CommentRepository::delete($comment);

        return redirect('dashboard/comments')->withSuccessMessage('Deleted Successfully!');
    }
}
