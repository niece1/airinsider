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
        $featured = Cache::remember('featured', now()->addSeconds(300), function() {
            return Post::with(['photo'])
                ->where('published', 1)
                ->orderBy('id', 'desc')
                ->first();
        });
        
        $news = Cache::remember('main_page_news'. \Request::input('page'), now()->addSeconds(300), function() use ($featured) {
            return Post::with(['photo', 'category', 'user', 'comments', 'comments.replies'])
                ->where('published', 1)
                ->where('id', '<>', $featured->id)
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
        $post = Cache::remember('post_show'. $slug, now()->addSeconds(300), function() use ($slug) {
            return Post::where('slug', $slug)->firstOrFail();
        });
        
        $viewCountService->postViewCount($post);

        $related = Cache::remember('related', now()->addSeconds(300), function() use ($post) {
            return Post::with(['photo'])
                ->where('category_id', $post->category_id)
                ->where('published', 1)
                ->limit(5)
                ->get();
        });

        $categories = Cache::remember('categories', now()->addSeconds(300), function() {
            return Category::all();
        });
        
        $tags = Cache::remember('tags', now()->addSeconds(300), function() {
            return Tag::all();
        });

        return view('frontend.show', compact('post', 'categories', 'tags', 'related'));
    }

    public function postsByCategory($category)
    {
        $news_by_category = Cache::remember('news_by_category', now()->addSeconds(300), function() use ($category) {
            return Post::with(['photo', 'category', 'user', 'comments'])
                ->where('category_id', $category)
                ->where('published', 1)
                ->orderBy('id', 'desc')
                ->paginate(12);
        });

        $category = Cache::remember('category'. $category, now()->addSeconds(300), function() use ($category) {
            return Category::find($category);
        });

        return view('frontend.category', compact('news_by_category', 'category'));
    }

    public function postsByTag($tag)
    {
        $news_by_tag = Tag::find($tag)
                ->posts()->where('published', 1)
                ->orderBy('id', 'desc')
                ->paginate(12);
        
        $tag = Tag::find($tag);

        return view('frontend.tag', compact('news_by_tag', 'tag'));
    }

    public function postsByUser($user)
    {
        $news_by_user = Post::with(['photo', 'user', 'category', 'comments'])
                ->where('user_id', $user)
                ->where('published', 1)
                ->orderBy('id', 'desc')
                ->paginate(12);

        $user = User::find($user);

        return view('frontend.user', compact('news_by_user', 'user'));
    }

}
