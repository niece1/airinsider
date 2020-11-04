<?php

namespace App\Http\Controllers\Dashboard;

use App\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\SlugService;
use App\Services\PostPhotoUploader;
use App\Repositories\Dashboard\PostRepository;
use App\Repositories\Dashboard\CategoryRepository;
use App\Repositories\Dashboard\TagRepository;
use Illuminate\Support\Facades\Gate;

class PostController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('dashboard_access'), 403);
        $posts = PostRepository::getAll();

        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('post_create'), 403);
        $categories = CategoryRepository::getAll();
        $tags = TagRepository::getAll();
        $post = new Post();

        return view('dashboard.post.create', compact('categories', 'tags', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @param  \App\Services\SlugService  $slugService
     * @param  \App\Services\PostPhotoUploader  $postPhotoUploader
     * @return \Illuminate\Http\Response
     */
    public function store(
        StorePostRequest $request,
        SlugService $slugService,
        PostPhotoUploader $postPhotoUploader
    ) {
        $post = PostRepository::save($request);
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
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        abort_unless(Gate::allows('post_view'), 403);
        $post_item = PostRepository::show($post);

        return view('dashboard.post.show', compact('post_item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        abort_unless(Gate::allows('post_edit'), 403);
        $categories = CategoryRepository::getAll();
        $tags = TagRepository::getAll();

        return view('dashboard.post.edit', compact('categories', 'tags', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Post  $post
     * @param  \App\Services\SlugService  $slugService
     * @param  \App\Services\PostPhotoUploader  $postPhotoUploader
     * @return \Illuminate\Http\Response
     */
    public function update(
        UpdatePostRequest $request,
        Post $post,
        SlugService $slugService,
        PostPhotoUploader $postPhotoUploader
    ) {
        PostRepository::update($request, $post);
        $postPhotoUploader->store($request, $post);
        $slugService->generateSlug($request, $post);
        $post->saveUserWithPost($post);
        $post->syncTags($post);

        return redirect('dashboard/posts')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource to trash.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        abort_unless(Gate::allows('post_trash'), 403);
        PostRepository::removeToTrash($post);

        return redirect('dashboard/posts')->withSuccessMessage('Trashed Successfully!');
    }
}
