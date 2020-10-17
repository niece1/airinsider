<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Frontend\CommentRepositoryContract;
use App\Repositories\Frontend\CommentRepository;
use App\Repositories\Frontend\CachedCommentRepository;
use App\Contracts\Frontend\PostRepositoryContract;
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
        if ($this->app->environment('local', 'testing')) {
            $this->app->bind(PostRepositoryContract::class, fn () => new PostRepository());
            $this->app->bind(CommentRepositoryContract::class, fn () => new CommentRepository());
        }
        if ($this->app->environment('production')) {
            $this->app->bind(PostRepositoryContract::class, fn () => new CachedPostRepository());
            $this->app->bind(CommentRepositoryContract::class, fn () => new CachedCommentRepository());
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
