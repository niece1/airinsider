<?php

namespace App\Http\Controllers\Dashboard;

use App\Photo;
use App\Repositories\Dashboard\PostRepository;

class TrashController extends DashboardController
{
    public function index()
    {
        abort_unless(\Gate::allows('post_trash_list'), 403);
        $posts = PostRepository::getAllTrashed();

        return view('dashboard.trash.index', compact('posts'));
    }

    public function destroy($id, Photo $photo)
    {
        abort_unless(\Gate::allows('post_delete'), 403);
        PostRepository::expunge($id, $photo);

        return redirect()->back()->withSuccessMessage('Deleted permanently!');
    }

    public function restore($id)
    {
        abort_unless(\Gate::allows('post_restore'), 403);
        $post = PostRepository::returnFromTrash($id);
        $post->restore();

        return redirect('dashboard/posts')->withSuccessMessage('Restored Successfully!');
    }
}
