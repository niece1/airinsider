<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('dashboard_access'), 403);

        $posts = Post::with(['photo', 'category'])->orderBy('id', 'desc')->paginate(25);

        if (session('success_message')) {
            Alert::success(session('success_message'))->toToast();
        }
        return view('backend.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('post_create'), 403);

        $categories = Category::all();
        $tags = Tag::all();
        $post = new Post();

        return view('backend.post.create', compact('categories', 'tags', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());

        $this->generateSlug($request, $post);
        $this->getUser($post);
        $this->storeImage($request, $post);
        $this->syncTags($post);

        return redirect('dashboard/posts')->withSuccessMessage('Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        abort_unless(\Gate::allows('post_view'), 403);

        $post = Post::where('id', $post->id)->firstOrFail();

        return view('backend.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        abort_unless(\Gate::allows('post_edit'), 403);

        $categories = Category::all();
        $tags = Tag::all();

        return view('backend.post.edit', compact('categories', 'tags', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());

        $this->storeImage($request, $post);
        $this->generateSlug($request, $post);
        $this->getUser($post);
        $this->syncTags($post);

        return redirect('dashboard/posts')->withSuccessMessage('Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        abort_unless(\Gate::allows('post_trash'), 403);

        $post->delete();

        return redirect('dashboard/posts')->withSuccessMessage('Trashed Successfully!');
    }

    public function trashed()
    {
        abort_unless(\Gate::allows('post_trash_list'), 403);

        $posts = Post::with(['photo', 'category'])->onlyTrashed()->get();

        if (session('success_message')) {
            Alert::success(session('success_message'))->toToast();
        }

        return view('backend.post.trashed', compact('posts'));
    }

    public function expunge($id)
    {
        abort_unless(\Gate::allows('post_delete'), 403);

        $post = Post::withTrashed()->where('id', $id)->first();

        if ($post->photo) {
            $this->deletePhoto($post->photo->id);
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

    private function syncTags($post)
    {
        $post->tags()->sync(request('tag_id'));
    }

    private function generateSlug(Request $request, Post $post)
    {
        $post->update([
            'slug' => Str::slug($request->title, '-'),
        ]);
    }

    private function getUser($post)
    {
        Auth::user()->posts()->save($post);
    }

    private function storeImage(Request $request, Post $post)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            if ($post->photo) {
                $photo = $this->getPhoto($post->photo->id);
                Storage::disk('public')->delete($photo->storagepath);
                $photo->path = $path;
                $this->updatePostPhoto($post, $photo);
            } else {
                $this->createPostPhoto($post, $path);
            }
        }
    }

    public function getPhoto($id)
    {
        return Photo::find($id);
    }

    public function createPostPhoto($post, $path)
    {
        $photo = new Photo;
        $photo->path = $path;
        $post->photo()->save($photo);
    }

    public function updatePostPhoto(Post $post, Photo $photo)
    {
        return $post->photo()->save($photo);
    }

    public function deletePhoto($id)
    {
        $photo = $this->getPhoto($id);

        Storage::disk('public')->delete($photo->storagepath);
        $photo->delete($id);

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        
        $posts = Post::with(['photo', 'category'])
        ->where('title', 'like', "%$keyword%")
        ->orWhere('body', 'like', "%$keyword%")
        ->limit(10)
        ->get();

        return view('backend.post.search-results', compact('posts'));
    }
}
