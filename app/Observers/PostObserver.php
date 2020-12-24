<?php

namespace App\Observers;

use App\Post;
use Elasticsearch\Client;
use Illuminate\Support\Facades\Log;
use Elasticsearch\Common\Exceptions\Missing404Exception;

class PostObserver
{
    /**
     * Elasticsearch client instance.
     *
     * @var object
     */
    private $client;

    /**
     * Create a new Client instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Handle the post "created" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        if ($post->published) {
            $this->addIndex($post);
        }
    }

    /**
     * Handle the post "updated" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        if ($post->published) {
            return $this->addIndex($post);
        }
        $this->deleteIndex($post);
    }

    /**
     * Handle the post "deleted" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        if ($post->published) {
            $this->deleteIndex($post);
        }
    }

    /**
     * Handle the post "restored" event.
     *
     * @param  \App\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        if ($post->published) {
            $this->addIndex($post);
        }
    }

    /**
     * Add index to Elasticsearch.
     *
     * @param \App\Post $post
     */
    private function addIndex(Post $post)
    {
        $this->client->index(array_merge($this->params($post), [
            'body' => $post->toSearchArray()
        ]));
    }

    /**
     * Delete index from Elasticsearch.
     *
     * @param \App\Post $post
     */
    private function deleteIndex(Post $post)
    {
        try {
            $this->client->delete($this->params($post));
        } catch (Missing404Exception $e) {
            Log::info($e->getMessage());
        }
    }

    /**
     * Elasticsearch query attributes.
     *
     * @param \App\Post $post
     * return array
     */
    private function params(Post $post)
    {
        return [
            'index' => $post->getSearchIndex(),
            'type' => $post->getSearchType(),
            'id' => $post->getKey(),
        ];
    }
}
