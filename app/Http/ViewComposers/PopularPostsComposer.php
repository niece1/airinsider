<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Contracts\Frontend\PostRepositoryContract;

class PopularPostsComposer
{
    /**
     * PostRepository instance.
     *
     * @var type object
     */
    private $postRepository;

    /**
     * Create a new popular posts composer.
     *
     * @param \App\Contracts\Frontend\PostRepositoryContract $postRepository
     * @return void
     */
    public function __construct(PostRepositoryContract $postRepository)
    {
        $this->postRepository = $postRepository;
    }
     /**
      * Bind data to the view.
      *
      * @param \Illuminate\View\View $view
      * @return void
      */
    public function compose(View $view)
    {
        $view->with('popular_posts', $this->postRepository->getPopular());
    }
}
