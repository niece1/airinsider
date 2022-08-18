<?php

namespace App\Http\Controllers\Frontend;

use App\Services\ViewCountService;
use App\Http\Controllers\Controller;
use App\Contracts\Frontend\PostRepositoryContract;

class PostController extends Controller
{
    /**
     * PostRepository instance.
     *
     * @var type object
     */
    private $postRepository;

    /**
     * Create a new instance.
     *
     * @param  \App\Contracts\Frontend\PostRepositoryContract  $postRepository
     * @return void
     */
    public function __construct(PostRepositoryContract $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display post listing and featured post.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featured = $this->postRepository->getFeatured();
        $posts = $this->postRepository->getAll($featured);
        $random_posts = $this->postRepository->getRandom();

        return view('index', compact('featured', 'posts', 'random_posts'));
    }

    /*
     * Display the specified post.
     *
     * @param \App\Services\ViewCountService $viewCountService
     * @param \App\Post $slug
     * @return \Illuminate\Http\Response
     */
    public function show(ViewCountService $viewCountService, $slug)
    {
        $post = $this->postRepository->getOne($slug);
        $related = $this->postRepository->getRelated($post);
        $tags = $this->postRepository->getTags();
        $viewCountService->postViewCount($post);

        return view('frontend.post.show', compact('post', 'tags', 'related'));
    }

    /**
     * Display posts associated with specified category.
     *
     * @param \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function postByCategory($category)
    {
        $posts_by_category = $this->postRepository->getAllByCategory($category);
        $chosen_category = $this->postRepository->getCategory($category);

        return view('frontend.post.posts-by-category', compact('posts_by_category', 'chosen_category'));
    }

    /**
     * Display posts associated with specified tag.
     *
     * @param \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function postByTag($tag)
    {
        $posts_by_tag = $this->postRepository->getAllByTag($tag);
        $chosen_tag = $this->postRepository->getTag($tag);

        return view('frontend.post.posts-by-tag', compact('posts_by_tag', 'chosen_tag'));
    }

    /**
     * Display posts associated with specified user.
     *
     * @param \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function postByUser($user)
    {
        $posts_by_user = $this->postRepository->getAllByUser($user);
        $chosen_user = $this->postRepository->getUser($user);

        return view('frontend.post.posts-by-user', compact('posts_by_user', 'chosen_user'));
    }
}
