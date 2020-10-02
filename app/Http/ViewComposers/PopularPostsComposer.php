<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Interfaces\Frontend\PostRepositoryInterface;

class PopularPostsComposer
{
    private $postRepository;
    
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    
    public function compose(View $view)
    {
        $view->with('popular_post', $this->postRepository->getPopular());
    }
}
