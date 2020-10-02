<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Frontend\CommentRepositoryInterface;
use App\Repositories\Frontend\CommentRepository;
use App\Repositories\Frontend\CachedCommentRepository;
use App\Interfaces\Frontend\PostRepositoryInterface;
use App\Repositories\Frontend\PostRepository;
use App\Repositories\Frontend\CachedPostRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (config('app.env') === 'local') {
            $this->app->bind(PostRepositoryInterface::class, fn () => new PostRepository());
            $this->app->bind(CommentRepositoryInterface::class, fn () => new CommentRepository());
        }
        if (config('app.env') === 'production') {
            $this->app->bind(PostRepositoryInterface::class, fn () => new CachedPostRepository());
            $this->app->bind(CommentRepositoryInterface::class, fn () => new CachedCommentRepository());
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
