<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use App\Contracts\SearchRepositoryContract;
use App\Repositories\Frontend\SqlSearchRepository;
use App\Repositories\Frontend\ElasticSearchRepository;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindSearchClient();
        if (! config('services.elasticsearch.enabled')) {
            return $this->app->bind(SearchRepositoryContract::class, fn () => new SqlSearchRepository());
        }
        $this->app->bind(SearchRepositoryContract::class, fn () => new ElasticSearchRepository(
            $this->app->make(Client::class)
        ));
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

    /**
     * Bind elasticsearch client.
     *
     * @return void
     */
    private function bindSearchClient()
    {
        $this->app->bind(Client::class, fn ($app) => ClientBuilder::create()
                ->setHosts($app['config']->get('services.elasticsearch.hosts'))
                ->build());
    }
}
