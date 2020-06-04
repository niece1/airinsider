<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Cache;
use App\Services\ViewCountService;

class FrontendController extends Controller {

    public function index()
    {
        $featured = Cache::remember('featured',
                now()->addSeconds(config('app.cache')), function() {
            return Post::with(['photo'])
                ->where('published', 1)
                ->orderBy('id', 'desc')
                ->first();
        });
        
        $news = Cache::remember('main_page_news'. \Request::input('page'),
                now()->addSeconds(config('app.cache')), function() use ($featured) {
            return Post::with(['photo', 'category', 'user', 'comments', 'comments.replies'])
                ->where('published', 1)
                ->when($featured, function ($query, $featured) {
                    return $query->where('id', '<>', $featured->id);                           
                })
                ->orderBy('id', 'desc')
                ->paginate(8);
        });

        return view('frontend.index', compact('featured', 'news'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Services\ViewCounterService $viewCounterService
     * @return \Illuminate\Http\Response
     */
    public function show($slug, ViewCountService $viewCountService)
    {
        $post = Cache::remember('post_show'. $slug, now()->addSeconds(config('app.cache')), function() use ($slug) {
            return Post::where('slug', $slug)->firstOrFail();
        });
        
        $viewCountService->postViewCount($post);

        $related = Cache::remember('related', now()->addSeconds(config('app.cache')), function() use ($post) {
            return Post::with(['photo'])
                ->where('category_id', $post->category_id)
                ->where('published', 1)
                ->limit(5)
                ->get();
        });

        $categories = Cache::remember('categories', now()->addSeconds(config('app.cache')), function() {
            return Category::all();
        });
        
        $tags = Cache::remember('tags', now()->addSeconds(config('app.cache')), function() {
            return Tag::all();
        });

        return view('frontend.show', compact('post', 'categories', 'tags', 'related'));
    }

    public function postsByCategory($category)
    {
        $news_by_category = Cache::remember('news_by_category', now()->addSeconds(config('app.cache')), function() use ($category) {
            return Post::with(['photo', 'category', 'user', 'comments', 'comments.replies'])
                ->where('category_id', $category)
                ->where('published', 1)
                ->orderBy('id', 'desc')
                ->paginate(12);
        });

        $category = Cache::remember('category'. $category, now()->addSeconds(config('app.cache')), function() use ($category) {
            return Category::find($category);
        });

        return view('frontend.category', compact('news_by_category', 'category'));
    }

    public function postsByTag($tag)
    {
        $news_by_tag = Cache::remember('news_by_tag', now()->addSeconds(config('app.cache')), function() use ($tag) {
            return Tag::find($tag)
                ->posts()
                ->with(['photo', 'category', 'user', 'comments', 'comments.replies'])
                ->where('published', 1)
                ->orderBy('id', 'desc')
                ->paginate(12);
        });
        
        $tag = Cache::remember('tag'. $tag, now()->addSeconds(config('app.cache')), function() use ($tag) {
            return Tag::find($tag);
        });

        return view('frontend.tag', compact('news_by_tag', 'tag'));
    }

    public function postsByUser($user)
    {
        $news_by_user = Cache::remember('news_by_user', now()->addSeconds(config('app.cache')), function() use ($user) {
            return Post::with(['photo', 'user', 'category', 'comments', 'comments.replies'])
                ->where('user_id', $user)
                ->where('published', 1)
                ->orderBy('id', 'desc')
                ->paginate(12);
        });

        $user = Cache::remember('user'. $user, now()->addSeconds(config('app.cache')), function() use ($user) {
            return User::find($user);
        });

        return view('frontend.user', compact('news_by_user', 'user'));
    }
}
