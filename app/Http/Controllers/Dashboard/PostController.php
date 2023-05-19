<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Http\Requests\Dashboard\PostRequest;
use App\Http\Requests\Dashboard\PostPhotoRequest;
use App\Services\SlugService;
use App\Services\PostPhotoUploadService;
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
     * @param  \App\Http\Requests\PostRequest  $postRequest
     * @param  \App\Http\Requests\PostPhotoRequest $postPhotoRequest
     * @param  \App\Services\SlugService  $slugService
     * @param  \App\Services\PostPhotoUploadService  $postPhotoUploadService
     * @return \Illuminate\Http\Response
     */
    public function store(
        PostRequest $postRequest,
        PostPhotoRequest $postPhotoRequest,
        SlugService $slugService,
        PostPhotoUploadService $postPhotoUploadService
    ) {
        $post = PostRepository::save($postRequest);
        $slugService->generateSlug($postRequest, $post);
        $post->saveUserWithPost($post);
        $postPhotoUploadService->store($postPhotoRequest, $post);
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
     * @param  \App\Http\Requests\PostRequest  $postRequest
     * @param  \App\Http\Requests\PostPhotoRequest $postPhotoRequest
     * @param  \App\Post  $post
     * @param  \App\Services\SlugService  $slugService
     * @param  \App\Services\PostPhotoUploadService  $postPhotoUploadService
     * @return \Illuminate\Http\Response
     */
    public function update(
        PostRequest $postRequest,
        PostPhotoRequest $postPhotoRequest,
        Post $post,
        SlugService $slugService,
        PostPhotoUploadService $postPhotoUploadService
    ) {
        PostRepository::update($postRequest, $post);
        $postPhotoUploadService->store($postPhotoRequest, $post);
        $slugService->generateSlug($postRequest, $post);
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
