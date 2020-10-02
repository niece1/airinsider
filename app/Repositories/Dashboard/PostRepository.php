<?php

namespace App\Repositories\Dashboard;

use App\Post;
use App\Photo;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

/**
 * Post entity database query class
 *
 * @author Volodymyr Zhonchuk
 */
class PostRepository
{
    /**
     * Fetch all posts from the database
     *
     * @return \App\Post[]
     */
    public static function getAll()
    {
        return Post::with(['photo', 'category'])
                ->orderBy('id', 'desc')
                ->paginate(25);
    }
    
    /**
     * Save post instance to the database
     *
     * @param \App\Http\Requests\PostRequest  $request
     * @return \App\Post
     */
    public static function save(StorePostRequest $request)
    {
        return Post::create($request->all());
    }
    
    /**
     * Get the specified resource from the database
     *
     * @param \App\Post  $post
     * @return \App\Post
     */
    public static function show(Post $post)
    {
        return Post::where('id', $post->id)
                ->firstOrFail();
    }
    
    /**
     * Update post instance in the database
     *
     * @param \App\Http\Requests\PostRequest  $request
     * @param  \App\Post  $post
     */
    public static function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
    }
    
    /**
     * Remove post instance to trash
     *
     * @param  \App\Post  $post
     */
    public static function removeToTrash(Post $post)
    {
        $post->delete();
    }
    
    /**
     * Fetch all trashed posts from the database
     *
     * @return \App\Post[]
     */
    public static function getAllTrashed()
    {
        return Post::with(['photo', 'category'])
                ->onlyTrashed()
                ->get();
    }
    
    /**
     * Delete post instance from the database
     *
     * @param  \App\Post  $id
     * @param  \App\Photo  $photo
     */
    public static function expunge($id, Photo $photo)
    {
        $post = Post::withTrashed()
                ->where('id', $id)
                ->first();
        if ($post->photo) {
            $photo->deletePhoto($post->photo->id);
        }
        $post->forceDelete();
    }
    
    /**
     * Return post instance from trash
     *
     * @param  \App\Post  $id
     * @return \App\Post
     */
    public static function returnFromTrash($id)
    {
        return Post::withTrashed()
                ->where('id', $id)
                ->first();
    }
}
