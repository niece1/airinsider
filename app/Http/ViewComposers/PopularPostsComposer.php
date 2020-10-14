<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Interfaces\Frontend\PostRepositoryInterface;

class PopularPostsComposer
{
    private $postRepository;
    
    /**
     * Create a new popular posts composer.
     *
     * @param \App\Interfaces\Frontend\PostRepositoryInterface $postRepository
     * @return void
     */
    public function __construct(PostRepositoryInterface $postRepository)
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
        $view->with('popular_post', $this->postRepository->getPopular());
    }
}
