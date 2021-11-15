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
     * Fetch 5 cached posts in random order published within last 30 days.
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
