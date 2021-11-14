<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        }
        if ($this->app->environment('production')) {
            $this->app->bind(PostRepositoryContract::class, fn () => new CachedPostRepository());
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
