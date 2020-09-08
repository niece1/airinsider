<?php

namespace App\Http\ViewComposers;

use App\Post;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class FooterComposer
{
    public function compose(View $view)
    {
        $view->with(['popular' => Cache::remember(
            'footer_composer',
            now()->addSeconds(config('app.cache')),
            fn() => Post::with(['photo'])
                ->where('published', 1)
                ->orderBy('viewed', 'desc')
                ->limit(3)
                ->get()
        )
        ]);
    }
}
