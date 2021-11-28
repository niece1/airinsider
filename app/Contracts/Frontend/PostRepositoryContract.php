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
     * Get the specified post from the database.
     *
     * @param \App\Post  $slug
     * @return \App\Post
     */
    public function getOne($slug);

    /**
     * Fetch 5 posts associated with the category one's viewing now.
     *
     * @param  \App\Post  $post
     * @return \App\Post[]
     */
    public function getRelated($post);

    /**
     * Get the specified category from the database.
     *
     * @param \App\Category  $category
     * @return \App\Category
     */
    public function getCategory($category);

    /**
     * Fetch all posts associated with specified category.
     *
     * @param  \App\Category  $category
     * @return \App\Post[]
     */
    public function getAllByCategory($category);

    /**
     * Get the specified tag from the database.
     *
     * @param \App\Tag  $tag
     * @return \App\Tag
     */
    public function getTag($tag);

    /**
     * Fetch all tags from the database.
     *
     * @return \App\Tag[]
     */
    public function getTags();

    /**
     * Fetch all posts associated with specified tag.
     *
     * @param  \App\Tag  $tag
     * @return \App\Post[]
     */
    public function getAllByTag($tag);

    /**
     * Get the specified user from the database.
     *
     * @param \App\User  $user
     * @return \App\User
     */
    public function getUser($user);

    /**
     * Fetch all posts associated with specified user.
     *
     * @param  \App\User  $user
     * @return \App\Post[]
     */
    public function getAllByUser($user);

    /**
     * Fetch 5 posts in random order published within last 20 days.
     *
     * @return \App\Post[]
     */
    public function getRandom();
}
