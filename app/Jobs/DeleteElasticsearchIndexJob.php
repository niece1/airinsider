<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use Elasticsearch\Client;
use Illuminate\Support\Facades\Log;
use Elasticsearch\Common\Exceptions\Missing404Exception;

class DeleteElasticsearchIndexJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Post model.
     *
     * @var object
     */
    public $post;

    /**
     * Create a new job instance.
     *
     * @param Post $post
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Delete index from Elasticsearch.
     *
     * @param Client $client
     * @return void
     */
    public function handle(Client $client)
    {
        try {
            $client->delete($this->post->params());
        } catch (Missing404Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
