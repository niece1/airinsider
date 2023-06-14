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

class PostController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);
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
        $this->authorize('create', Post::class);
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
        $this->authorize('create', Post::class);
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
        $this->authorize('view', Post::class);
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
        $this->authorize('update', $post);
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
        $this->authorize('update', $post);
        PostRepository::update($postRequest, $post);
        $postPhotoUploadService->store($postPhotoRequest, $post);
        $slugService->generateSlug($postRequest, $post);
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
        $this->authorize('delete', $post);
        PostRepository::removeToTrash($post);

        return redirect('dashboard/posts')->withSuccessMessage('Trashed Successfully!');
    }
}
