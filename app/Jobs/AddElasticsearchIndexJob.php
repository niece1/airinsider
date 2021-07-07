<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use Elasticsearch\Client;

class AddElasticsearchIndexJob implements ShouldQueue
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
     * Add index to Elasticsearch.
     *
     * @param Client $client
     * @return void
     */
    public function handle(Client $client)
    {
        $client->index(array_merge($this->post->params(), [
            'body' => $this->post->toSearchArray()
        ]));
    }
}
