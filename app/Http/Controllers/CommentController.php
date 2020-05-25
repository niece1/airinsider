<?php
namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Post;
use App\Comment; 

class CommentController extends BackendController
{
    public function index(Post $post)
    {        
    	return $post->comments()->with(['replies'])->paginate(10);
    }

    public function store(CommentRequest $request, Post $post)
    {   	
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

        return view('backend.comment.list', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        abort_unless(\Gate::allows('comment_delete'), 403);
        $comment->delete();      
   
        return redirect('dashboard/comments')->withSuccessMessage('Deleted Successfully!');
    }
}
