<?php

namespace App\Http\Controllers\Frontend;

use App\Services\ViewCountService;
use App\Http\Controllers\Controller;
use App\Interfaces\Frontend\PostRepositoryInterface;

class PostController extends Controller
{
    private $postRepository;
    
    /**
     * Create a new Post instance.
     *
     * @param  \App\Interfaces\Frontend\PostRepositoryInterface  $postRepository
     * @return void
     */
    public function __construct(PostRepositoryInterface $postRepository)
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

        return view('frontend.post.index', compact('featured', 'posts'));
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
        $categories = $this->postRepository->getCategories();
        $tags = $this->postRepository->getTags();
        $viewCountService->postViewCount($post);

        return view('frontend.post.show', compact('post', 'categories', 'tags', 'related'));
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

        return view('frontend.post.post-by-category', compact('posts_by_category', 'chosen_category'));
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

        return view('frontend.post.post-by-tag', compact('posts_by_tag', 'chosen_tag'));
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

        return view('frontend.post.post-by-user', compact('posts_by_user', 'chosen_user'));
    }
    
    /**
     * Display posts in random order in carousel.
     *
     * @return \Illuminate\Http\Response
     */
    public function randomPost()
    {
        $random_posts = $this->postRepository->getRandom();
        
        return view('frontend.contact.index', compact('random_posts'));
    }
}
