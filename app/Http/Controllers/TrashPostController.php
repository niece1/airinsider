<?php

namespace App\Http\Controllers;

use App\Post;
use App\Photo;
use RealRashid\SweetAlert\Facades\Alert;

class TrashPostController extends Controller
{
    public function trashed()
    {
        abort_unless(\Gate::allows('post_trash_list'), 403);
        $posts = Post::with(['photo', 'category'])->onlyTrashed()->get();
        if (session('success_message')) {
            Alert::success(session('success_message'))->toToast();
        }

        return view('backend.post.trashed', compact('posts'));
    }

    public function expunge($id, Photo $photo)
    {
        abort_unless(\Gate::allows('post_delete'), 403);
        $post = Post::withTrashed()->where('id', $id)->first();
        if ($post->photo) {
            $photo->deletePhoto($post->photo->id);
        }
        $post->forceDelete();

        return redirect()->back()->withSuccessMessage('Deleted permanently!');
    }

    public function restore($id)
    {
        abort_unless(\Gate::allows('post_restore'), 403);
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        return redirect('dashboard/posts')->withSuccessMessage('Restored Successfully!');
    }
}
