<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Frontend\SearchRepositoryContract;
use App\Repositories\Frontend\SqlSearchRepository;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SearchRepositoryContract::class, fn () => new SqlSearchRepository());
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
