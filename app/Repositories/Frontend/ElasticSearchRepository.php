<?php

namespace App\Repositories\Frontend;

use App\Contracts\Frontend\SearchRepositoryContract;
use App\Post;
use Elasticsearch\Client;
use Illuminate\Support\Arr;

/**
 * Display a listing of Post by search criteria.
 *
 * @author Volodymyr Zhonchuk
 */
class ElasticSearchRepository implements SearchRepositoryContract
{
    /**
     * Elasticsearch client instance.
     *
     * @var object
     */
    private $client;

    /**
     * Create a new instance.
     *
     * @param Elasticsearch\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Display a listing of Post by search criteria.
     *
     * @param  $keyword
     * @return \Illuminate\Http\Response
     */
    public function search($keyword)
    {
        $items = $this->searchOnElasticsearch($keyword);

        return $this->buildCollection($items);
    }

    /**
     * Fetch response from search engine.
     *
     * @param string $keyword
     * @return type $items
     */
    private function searchOnElasticsearch($keyword)
    {
        $post = new Post();
        $items = $this->client->search([
            'index' => $post->getSearchIndex(),
            'type' => $post->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title^5', 'body'],
                        'fuzziness' => 'auto',
                        'query' => $keyword ?? '',
                    ],
                ],
            ],
        ]);

        return $items;
    }

    /**
     * Build collection of found posts.
     *
     * @param type $items
     * @return array
     */
    private function buildCollection($items)
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return Post::with(['photo', 'category', 'user', 'comments'])
                ->findMany($ids)
                ->sortBy(fn ($post) => array_search($post->getKey(), $ids));
    }
}
