<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use RealRashid\SweetAlert\Facades\Alert; 

class CommentController extends Controller
{
    public function index(Post $post)
    {        
    	return $post->comments()->with(['replies'])->paginate(10);
    }

    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
          'body' => 'bail|min:2|max:300'
        ]);
    	
        return auth()->user()->comments()->create([
            'body' => $request->body,
            'post_id' => $post->id,
            'comment_id' => $request->comment_id
        ])->fresh();
    }

    public function show(Comment $comment)
    {
    	return $comment->replies()->paginate(10);
    }

    public function list()
    {
        abort_unless(\Gate::allows('comment_access'), 403);

        $comments = Comment::with(['post', 'replies'])->orderBy('id', 'desc')->paginate(50);

        if(session('success_message')){
            Alert::success( session('success_message'))->toToast();
        }

        return view('backend.comment.list', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        abort_unless(\Gate::allows('comment_delete'), 403);

        $comment->delete();      
   
        return redirect('dashboard/comments')->withSuccessMessage('Deleted Successfully!');
    }

}
