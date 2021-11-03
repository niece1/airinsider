<?php

namespace App\Repositories\Frontend;

use Illuminate\Support\Facades\Cache;
use App\Contracts\Frontend\PostRepositoryContract;
use App\Repositories\Frontend\PostRepository;

/**
 * Cached post entity query class.
 *
 * @author Volodymyr Zhonchuk
 */
class CachedPostRepository extends PostRepository implements PostRepositoryContract
{
    /**
     * Get cached last published post from the database.
     *
     * @return \App\Post
     */
    public function getFeatured()
    {
        return Cache::remember(
            'post_featured',
            now()->addSeconds(config('app.cache')),
            fn() => parent::getFeatured()
        );
    }

    /**
     * Fetch all cached posts except featured one from the database.
     *
     * @param  \App\Post  $featured
     * @return \App\Post[]
     */
    public function getAll($featured)
    {
        return Cache::remember(
            'post_home_page',
            now()->addSeconds(config('app.cache')),
            fn() => parent::getAll($featured)
        );
    }

    /**
     * Get cached specified post from the database.
     *
     * @param \App\Post  $slug
     * @return \App\Post
     */
    public function getOne($slug)
    {
        return Cache::remember(
            'post_show',
            now()->addSeconds(config('app.cache')),
            fn() => parent::getOne($slug)
        );
    }

    /**
     * Fetch 5 cached posts associated with the category one's viewing now.
     *
     * @param  \App\Post  $post
     * @return \App\Post[]
     */
    public function getRelated($post)
    {
        return Cache::remember(
            'post_related',
            now()->addSeconds(config('app.cache')),
            fn() => parent::getRelated($post)
        );
    }

    /**
     * Fetch all cached categories from the database.
     *
     * @return \App\Category[]
     */
    public function getCategories()
    {
        return Cache::remember(
            'categories',
            now()->addSeconds(config('app.cache')),
            fn() => parent::getCategories()
        );
    }

    /**
     * Fetch all cached tags from the database.
     *
     * @return \App\Tag[]
     */
    public function getTags()
    {
        return Cache::remember(
            'tags',
            now()->addSeconds(config('app.cache')),
            fn() => parent::getTags()
        );
    }

    /**
     * Fetch all cached posts associated with specified category.
     *
     * @param  \App\Category  $category
     * @return \App\Post[]
     */
    public function getAllByCategory($category)
    {
        return Cache::remember(
            'post_by_category',
            now()->addSeconds(config('app.cache')),
            fn() => parent::getAllByCategory($category)
        );
    }

    /**
     * Fetch all cached posts associated with specified tag.
     *
     * @param  \App\Tag  $tag
     * @return \App\Post[]
     */
    public function getAllByTag($tag)
    {
        return Cache::remember(
            'post_by_tag',
            now()->addSeconds(config('app.cache')),
            fn() => parent::getAllByTag($tag)
        );
    }

    /**
     * Fetch all cached posts associated with specified user.
     *
     * @param  \App\User  $user
     * @return \App\Post[]
     */
    public function getAllByUser($user)
    {
        return Cache::remember(
            'post_by_user',
            now()->addSeconds(config('app.cache')),
            fn() => parent::getAllByUser($user)
        );
    }

    /**
     * Fetch 5 cached posts in random order published within last 20 days.
     *
     * @return \App\Post[]
     */
    public function getRandom()
    {
        return Cache::remember(
            'post_random',
            now()->addSeconds(config('app.cache')),
            fn() => parent::getRandom()
        );
    }
}
