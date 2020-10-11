<?php

namespace App\Repositories\Frontend;

use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Carbon\Carbon;
use App\Interfaces\Frontend\PostRepositoryInterface;

/**
 * Post entity database query class
 *
 * @author Volodymyr Zhonchuk
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * Get last published post from the database
     *
     * @return \App\Post
     */
    public function getFeatured()
    {
        return Post::with(['photo'])
                ->where('published', 1)
                ->orderBy('id', 'desc')
                ->first();
    }
    
    /**
     * Fetch all posts except featured one from the database
     *
     * @param  \App\Post  $featured
     * @return \App\Post[]
     */
    public function getAll($featured)
    {
        return Post::with(['photo', 'category', 'user', 'comments', 'comments.replies'])
                ->where('published', 1)
                ->when($featured, function ($query, $featured) {
                        return $query->where('id', '<>', $featured->id);
                })
                    ->orderBy('id', 'desc')
                    ->paginate(12);
    }
    
    /**
     * Get the specified post from the database
     *
     * @param \App\Post  $slug
     * @return \App\Post
     */
    public function getOne($slug)
    {
        return Post::where('slug', $slug)->firstOrFail();
    }
    
    /**
     * Fetch 5 posts associated with the category one's viewing now
     *
     * @param  \App\Post  $post
     * @return \App\Post[]
     */
    public function getRelated($post)
    {
        return Post::with(['photo'])
                ->where('category_id', $post->category_id)
                ->where('published', 1)
                ->limit(5)
                ->get();
    }
    
    /**
     * Fetch all categories from the database
     *
     * @return \App\Category[]
     */
    public function getCategories()
    {
        return Category::all();
    }
    
    /**
     * Fetch all tags from the database
     *
     * @return \App\Tag[]
     */
    public function getTags()
    {
        return Tag::all();
    }
    
    /**
     * Fetch all posts associated with specified category
     *
     * @param  \App\Category  $category
     * @return \App\Post[]
     */
    public function getAllByCategory($category)
    {
        return Post::with(['photo', 'category', 'user', 'comments', 'comments.replies'])
                ->where('category_id', $category)
                ->orderBy('id', 'desc')
                ->where('published', 1)
                ->paginate(12);
    }
    
    /**
     * Get the specified category from the database
     *
     * @param \App\Category  $category
     * @return \App\Category
     */
    public function getCategory($category)
    {
        return Category::find($category);
    }
    
    /**
     * Fetch all posts associated with specified tag
     *
     * @param  \App\Tag  $tag
     * @return \App\Post[]
     */
    public function getAllByTag($tag)
    {
        return Tag::find($tag)->posts()
                ->with(['photo', 'category', 'user', 'comments', 'comments.replies'])
                ->where('published', 1)
                ->orderBy('id', 'desc')
                ->paginate(12);
    }
    
    /**
     * Get the specified tag from the database
     *
     * @param \App\Tag  $tag
     * @return \App\Tag
     */
    public function getTag($tag)
    {
        return Tag::find($tag);
    }
    
    /**
     * Fetch all posts associated with specified user
     *
     * @param  \App\User  $user
     * @return \App\Post[]
     */
    public function getAllByUser($user)
    {
        return Post::with(['photo', 'user', 'category', 'comments', 'comments.replies'])
                ->where('user_id', $user)
                ->where('published', 1)
                ->orderBy('id', 'desc')
                ->paginate(12);
    }
    
    /**
     * Get the specified user from the database
     *
     * @param \App\User  $user
     * @return \App\User
     */
    public function getUser($user)
    {
        return User::find($user);
    }
    
    /**
     * Fetch 5 posts in random order published within last 20 days
     *
     * @return \App\Post[]
     */
    public function getRandom()
    {
        return Post::with(['photo', 'category', 'user', 'comments', 'comments.replies'])
                ->whereDate('updated_at', '>', Carbon::now()->sub(20, 'days'))
                ->where('published', 1)
                ->inRandomOrder()
                ->limit(5)
                ->get();
    }
    
    /**
     * Fetch 3 most often viewed posts
     *
     * @return \App\Post[]
     */
    public function getPopular()
    {
        return Post::with(['photo'])
                ->where('published', 1)
                ->orderBy('viewed', 'desc')
                ->limit(3)
                ->get();
    }
}
