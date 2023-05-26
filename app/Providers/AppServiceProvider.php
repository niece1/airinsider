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
            $this->app->singleton(
                PostRepositoryContract::class,
                fn () => new PostRepository()
            );
        }

        if ($this->app->environment('production')) {
            $this->app->singleton(
                PostRepositoryContract::class,
                fn () => new CachedPostRepository(new PostRepository())
            );
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
