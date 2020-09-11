<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\SlugService;
use App\Services\PostPhotoUploader;

class PostController extends BackendController
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
     *
     * @return \Illuminate\Http\Response
     */
    public function store(
        StorePostRequest $request,
        SlugService $slugService,
        PostPhotoUploader $postPhotoUploader
    ) {
        $post = Post::create($request->all());
        $slugService->generateSlug($request, $post);
        $post->saveUserWithPost($post);
        $postPhotoUploader->store($request, $post);
        $post->syncTags($post);

        return redirect('dashboard/posts')->withSuccessMessage('Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     *
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
     *
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
     *
     * @return \Illuminate\Http\Response
     */
    public function update(
        UpdatePostRequest $request,
        Post $post,
        SlugService $slugService,
        PostPhotoUploader $postPhotoUploader
    ) {
        $post->update($request->all());
        $postPhotoUploader->store($request, $post);
        $slugService->generateSlug($request, $post);
        $post->saveUserWithPost($post);
        $post->syncTags($post);

        return redirect('dashboard/posts')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        abort_unless(\Gate::allows('post_trash'), 403);
        $post->delete();

        return redirect('dashboard/posts')->withSuccessMessage('Trashed Successfully!');
    }
}
