<?php

namespace App\Http\ViewComposers;

use App\Post;
use Illuminate\View\View;

class FooterComposer {

    public function compose(View $view) {
        $view->with(['popular' => Post::with(['photo'])
                    ->where('published', 1)
                    ->orderBy('viewed', 'desc')
                    ->limit(3)
                    ->get()]);
    }

}
