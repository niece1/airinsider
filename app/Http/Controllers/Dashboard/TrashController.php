<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Photo;
use App\Repositories\Dashboard\PostRepository;

class TrashController extends DashboardController
{
    /**
     * Display a listing of the trashed posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewTrashList', Post::class);
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
        $this->authorize('forceDelete', Post::class);
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
        $this->authorize('restore', Post::class);
        $post = PostRepository::returnFromTrash($id);
        $post->restore();

        return redirect('dashboard/posts')->withSuccessMessage('Restored Successfully!');
    }
}
