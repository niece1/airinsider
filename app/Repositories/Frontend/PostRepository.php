<?php

namespace App\Repositories\Frontend;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use App\Contracts\Frontend\PostRepositoryContract;

/**
 * Post entity database query class.
 *
 * @author Volodymyr Zhonchuk
 */
class PostRepository implements PostRepositoryContract
{
    /**
     * Get last published post from the database.
     *
     * @return Post
     */
    public function getFeatured()
    {
        return Post::with(['photo'])
                ->where('published', 1)
                ->orderBy('publish_time', 'desc')
                ->first();
    }

    /**
     * Fetch all posts except featured one from the database.
     *
     * @param  Post  $featured
     * @return Post[]
     */
    public function getAll($featured)
    {
        return Post::with(['photo', 'category', 'user'])
                ->where('published', 1)
                ->when($featured, function ($query, $featured) {
                        return $query->where('id', '<>', $featured->id);
                })
                    ->orderBy('publish_time', 'desc')
                    ->paginate(12);
    }

    /**
     * Get the specified post from the database.
     *
     * @param Post  $slug
     * @return Post
     */
    public function getOne($slug)
    {
        return Post::where('slug', $slug)->firstOrFail();
    }

    /**
     * Fetch 5 posts associated with the category one's viewing now.
     *
     * @param  Post  $post
     * @return Post[]
     */
    public function getRelated($post)
    {
        return Post::with(['photo'])
                ->where('published', 1)
                ->where('category_id', $post->category_id)
                ->where('id', '<>', $post->id)
                ->limit(5)
                ->get();
    }

    /**
     * Fetch all tags from the database.
     *
     * @return Tag[]
     */
    public function getTags()
    {
        return Tag::all();
    }

    /**
     * Fetch all posts associated with specified category.
     *
     * @param  Category  $category
     * @return Post[]
     */
    public function getAllByCategory($category)
    {
        return Post::with(['photo', 'category', 'user'])
                ->where('category_id', $category)
                ->orderBy('publish_time', 'desc')
                ->where('published', 1)
                ->paginate(12);
    }

    /**
     * Get the specified category from the database.
     *
     * @param Category  $category
     * @return Category
     */
    public function getCategory($category)
    {
        return Category::find($category);
    }

    /**
     * Fetch all posts associated with specified tag.
     *
     * @param  Tag  $tag
     * @return Post[]
     */
    public function getAllByTag($tag)
    {
        return Tag::find($tag)->posts()
                ->with(['photo', 'category', 'user'])
                ->where('published', 1)
                ->orderBy('publish_time', 'desc')
                ->paginate(12);
    }

    /**
     * Get the specified tag from the database.
     *
     * @param Tag  $tag
     * @return Tag
     */
    public function getTag($tag)
    {
        return Tag::find($tag);
    }

    /**
     * Fetch all posts associated with specified user.
     *
     * @param  User  $user
     * @return Post[]
     */
    public function getAllByUser($user)
    {
        return Post::with(['photo', 'user', 'category'])
                ->where('user_id', $user)
                ->where('published', 1)
                ->orderBy('publish_time', 'desc')
                ->paginate(12);
    }

    /**
     * Get the specified user from the database.
     *
     * @param User  $user
     * @return User
     */
    public function getUser($user)
    {
        return User::find($user);
    }

    /**
     * Fetch 5 posts in random order published within last 500 days.
     *
     * @return Post[]
     */
    public function getRandom()
    {
        return Post::with(['photo', 'category', 'user'])
                ->whereDate('publish_time', '>', Carbon::now()->sub(500, 'days'))
                ->where('published', 1)
                ->inRandomOrder()
                ->limit(5)
                ->get();
    }
}
