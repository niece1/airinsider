<?php

namespace App\Repositories\Frontend;

use Illuminate\Support\Facades\Cache;
use App\Contracts\Frontend\PostRepositoryContract;

class CachedPostRepository implements PostRepositoryContract
{
    /**
     * Create a new instance.
     *
     * @param App\Contracts\Frontend\PostRepositoryContract $next
     */
    public function __construct(
        private PostRepositoryContract $next
    ) {
    }

    /**
     * Get cached last published post from the database.
     *
     * @return \App\Post
     */
    public function getFeatured()
    {
        return Cache::tags('posts')
                ->remember(
                    'post_featured',
                    now()->addSeconds(config('app.cache')),
                    fn() => $this->next->getFeatured()
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
        return Cache::tags('posts')
                ->remember(
                    'post_home_page_' . request('page', 1),
                    now()->addSeconds(config('app.cache')),
                    fn() => $this->next->getAll($featured)
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
            fn() => $this->next->getTags()
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
            fn() => $this->next->getRandom()
        );
    }
}
