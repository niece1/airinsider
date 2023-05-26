<?php

namespace App\Contracts\Frontend;

interface PostRepositoryContract
{
    /**
     * Get last published post from the database.
     *
     * @return \App\Post
     */
    public function getFeatured();

    /**
     * Fetch all posts except featured one from the database.
     *
     * @param  \App\Post  $featured
     * @return \App\Post[]
     */
    public function getAll($featured);

    /**
     * Fetch all tags from the database.
     *
     * @return \App\Tag[]
     */
    public function getTags();

    /**
     * Fetch 5 posts in random order published within last 20 days.
     *
     * @return \App\Post[]
     */
    public function getRandom();
}
