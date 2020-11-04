<?php

namespace App\Http\Controllers\Dashboard;

use App\Photo;
use App\Repositories\Dashboard\PostRepository;
use Illuminate\Support\Facades\Gate;

class TrashController extends DashboardController
{
    /**
     * Display a listing of the trashed posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('post_trash_list'), 403);
        $posts = PostRepository::getAllTrashed();

        return view('dashboard.trash.index', compact('posts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $id
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Photo $photo)
    {
        abort_unless(Gate::allows('post_delete'), 403);
        PostRepository::expunge($id, $photo);

        return redirect()->back()->withSuccessMessage('Deleted permanently!');
    }

    /**
     * Return post from trash.
     *
     * @param  \App\Post  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        abort_unless(Gate::allows('post_restore'), 403);
        $post = PostRepository::returnFromTrash($id);
        $post->restore();

        return redirect('dashboard/posts')->withSuccessMessage('Restored Successfully!');
    }
}
